<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];

        if ($this->turnstileIsEnabled()) {
            $rules['cf-turnstile-response'] = ['required', 'string'];
        }

        return $rules;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $this->verifyTurnstile();

        if (! Auth::attempt(array_merge($this->only('email', 'password'), ['status' => 'active']), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Check whether Cloudflare Turnstile should be enforced.
     */
    protected function turnstileIsEnabled(): bool
    {
        return (bool) config('services.turnstile.enabled');
    }

    /**
     * Verify the Cloudflare Turnstile CAPTCHA token.
     *
     * @throws ValidationException
     */
    protected function verifyTurnstile(): void
    {
        if (! $this->turnstileIsEnabled()) {
            return;
        }

        $secretKey = config('services.turnstile.secret_key');
        $turnstileResponse = $this->input('cf-turnstile-response');

        if (empty($secretKey)) {
            throw ValidationException::withMessages([
                'cf-turnstile-response' => 'CAPTCHA is not configured correctly.',
            ]);
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => $secretKey,
            'response' => $turnstileResponse,
            'remoteip' => $this->ip(),
        ]);

        if (! $response->successful() || ! $response->json('success')) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'cf-turnstile-response' => 'CAPTCHA verification failed. Please try again.',
            ]);
        }
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
