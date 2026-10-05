<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.theme-init')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in · ResumeFolio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/personal-logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-canvas text-ink antialiased">
    <div class="rf-theme-corner">@include('layouts.theme-switch')</div>
    <main class="rf-login">
        <section class="rf-login-story" aria-label="About ResumeFolio">
            <a href="{{ route('login') }}" class="rf-login-brand"><img src="{{ asset('images/personal-logo.png') }}" alt="" width="40" height="40">ResumeFolio</a>
            <div><span class="rf-eyebrow">YOUR NEXT CHAPTER</span><h1>A stronger resume.<br>A clearer path forward.</h1><p>Build, share, and manage your professional story in one place.</p></div>
            <div class="rf-story-features"><p><span>01</span> Create a resume for every opportunity</p><p><span>02</span> Share with control over access</p><p><span>03</span> See when your resume gets noticed</p></div>
        </section>
        <section class="rf-login-panel">
            <div class="rf-login-card">
                <span class="rf-eyebrow">WELCOME BACK</span>
                <h2>Sign in to your workspace</h2>
                <p class="text-muted mt-2 mb-8">Your resumes and opportunities, all in one place.</p>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div><label for="email" class="rf-label">Email address</label><input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full" placeholder="you@example.com" @if($errors->has('email')) aria-invalid="true" @endif><x-input-error :messages="$errors->get('email')" class="mt-2" /></div>
                    <div x-data="{ showPassword: false }">
                        <label for="password" class="rf-label">Password</label>
                        <div class="relative"><input id="password" type="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" class="w-full pr-20" placeholder="Enter your password"><button type="button" @click="showPassword = !showPassword" :aria-pressed="showPassword" :aria-label="showPassword ? 'Hide password' : 'Show password'" class="absolute inset-y-0 right-4 text-blue-strong text-sm font-semibold"><span x-text="showPassword ? 'Hide' : 'Show'">Show</span></button></div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="flex flex-wrap items-center justify-between gap-3 text-sm"><label for="remember_me" class="inline-flex items-center gap-2 text-muted"><input id="remember_me" type="checkbox" name="remember" class="rounded">Remember me</label>@if(Route::has('password.request'))<a href="{{ route('password.request') }}" class="text-blue-strong font-semibold">Forgot password?</a>@endif</div>
                    @if(config('services.turnstile.enabled'))<div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}" data-theme="auto"></div><x-input-error :messages="$errors->get('cf-turnstile-response')" class="mt-2" />@endif
                    <button type="submit" class="rf-button rf-button-primary w-full">Sign in <span aria-hidden="true">→</span></button>
                </form>
                <p class="rf-login-note">Access for resume owners and administrators.</p>
            </div>
        </section>
    </main>
    @if(config('services.turnstile.enabled'))<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>@endif
</body>
</html>
