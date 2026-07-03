<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Resume Management System</title>

    <link rel="icon" type="image/png" href="{{ asset('images/personal-logo.png') }}?v=2">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/personal-logo.png') }}?v=2">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950 antialiased">

    <div class="min-h-screen flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-md">

            <!-- Logo / Title -->
            <div class="text-center mb-6">
                <div class="mx-auto w-20 h-20 bg-white border-2 border-slate-300 rounded-lg flex items-center justify-center shadow-lg overflow-hidden">
                    <img src="{{ asset('images/personal-logo.png') }}"
                         alt="Personal Logo"
                         class="w-full h-full object-contain p-2">
                </div>

                <h1 class="text-3xl font-extrabold text-white mt-5">
                    Resume Management System
                </h1>

                <p class="text-slate-300 text-sm mt-2">
                    Login to manage your resumes, public links, and analytics.
                </p>
            </div>

            <!-- Login Card -->
            <div class="bg-slate-300 shadow-2xl rounded-lg p-4 border-2 border-slate-500">

                <div class="bg-white border-2 border-slate-300 rounded-lg p-6">

                    <div class="mb-6">
                        <h2 class="text-xl font-extrabold text-slate-900">
                            Login
                        </h2>

                        <p class="text-sm text-slate-600 mt-1">
                            Enter your account credentials to continue.
                        </p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block mb-2 font-bold text-slate-800">
                                Email
                            </label>

                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   autocomplete="username"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Enter your email address">

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div x-data="{ showPassword: false }">
                            <label for="password" class="block mb-2 font-bold text-slate-800">
                                Password
                            </label>

                            <div class="relative">
                                <input id="password"
                                       :type="showPassword ? 'text' : 'password'"
                                       name="password"
                                       required
                                       autocomplete="current-password"
                                       class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 pr-20 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Enter your password">

                                <button type="button"
                                        @click="showPassword = !showPassword"
                                        class="absolute inset-y-0 right-3 flex items-center text-sm font-bold text-blue-600 hover:text-blue-800">
                                    <span x-show="!showPassword">Show</span>
                                    <span x-show="showPassword">Hide</span>
                                </button>
                            </div>

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between gap-3">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me"
                                       type="checkbox"
                                       name="remember"
                                       class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">

                                <span class="ms-2 text-sm text-slate-600">
                                    Remember me
                                </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-sm font-semibold text-blue-600 hover:text-blue-800 hover:underline">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <!-- Cloudflare Turnstile CAPTCHA -->
                        <div class="pt-2">
                            <label class="block mb-2 font-bold text-slate-800">
                                Security Check
                            </label>

                            <div class="cf-turnstile"
                                 data-sitekey="{{ config('services.turnstile.site_key') }}">
                            </div>

                            <x-input-error :messages="$errors->get('cf-turnstile-response')" class="mt-2" />
                        </div>

                        <!-- Submit -->
                        <div class="pt-4 border-t-2 border-slate-200">
                            <button type="submit"
                                    class="w-full inline-flex justify-center px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-bold shadow-sm">
                                Log in
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <p class="text-center text-slate-300 text-sm mt-6">
                Protected access for resume owners and administrators.
            </p>

        </div>
    </div>

    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

</body>
</html>