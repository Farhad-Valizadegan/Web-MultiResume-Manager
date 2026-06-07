<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Resume Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950 antialiased">

    <div class="min-h-screen flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-lg">

            <!-- Logo / Title -->
            <div class="text-center mb-6">
                <div class="mx-auto w-16 h-16 bg-white border-2 border-slate-300 rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-9 h-9 text-slate-800"
                         viewBox="0 0 316 316"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor"
                              d="M305.8 81.125C305.77 80.995 305.69 80.885 305.65 80.755C305.56 80.525 305.49 80.285 305.37 80.075C305.29 79.935 305.17 79.815 305.07 79.685C304.94 79.515 304.83 79.325 304.68 79.175C304.55 79.045 304.39 78.955 304.25 78.845C304.09 78.715 303.95 78.575 303.77 78.475L251.32 48.275C249.97 47.495 248.31 47.495 246.96 48.275L194.51 78.475C194.33 78.575 194.18 78.725 194.03 78.845C193.89 78.955 193.73 79.045 193.6 79.175C193.45 79.325 193.34 79.515 193.21 79.685C193.11 79.815 192.99 79.935 192.91 80.075C192.79 80.285 192.71 80.525 192.63 80.755C192.58 80.875 192.51 80.995 192.48 81.125C192.38 81.495 192.33 81.875 192.33 82.265V139.625L148.62 164.795V52.575C148.62 52.185 148.57 51.805 148.47 51.435C148.44 51.305 148.36 51.195 148.32 51.065C148.23 50.835 148.16 50.595 148.04 50.385C147.96 50.245 147.84 50.125 147.74 49.995C147.61 49.825 147.5 49.635 147.35 49.485C147.22 49.355 147.06 49.265 146.92 49.155C146.76 49.025 146.62 48.885 146.44 48.785L93.99 18.585C92.64 17.805 90.98 17.805 89.63 18.585L37.18 48.785C37 48.885 36.85 49.035 36.7 49.155C36.56 49.265 36.4 49.355 36.27 49.485C36.12 49.635 36.01 49.825 35.88 49.995C35.78 50.125 35.66 50.245 35.58 50.385C35.46 50.595 35.38 50.835 35.3 51.065C35.25 51.185 35.18 51.305 35.15 51.435C35.05 51.805 35 52.185 35 52.575V232.235C35 233.795 35.84 235.245 37.18 236.025L142.08 296.425C142.33 296.575 142.6 296.685 142.87 296.775C142.96 296.805 143.05 296.855 143.14 296.875C143.5 296.975 143.87 297.025 144.24 297.025C144.61 297.025 144.98 296.975 145.34 296.875C145.43 296.855 145.52 296.805 145.61 296.775C145.88 296.685 146.15 296.575 146.4 296.425L251.3 236.025C252.64 235.245 253.48 233.795 253.48 232.235V174.875L303.78 145.955C305.12 145.175 305.96 143.725 305.96 142.165V82.265C305.95 81.875 305.9 81.495 305.8 81.125Z"/>
                    </svg>
                </div>

                <h1 class="text-3xl font-extrabold text-white mt-5">
                    Create Account
                </h1>

                <p class="text-slate-300 text-sm mt-2">
                    Register to create, manage, and share professional resumes.
                </p>
            </div>

            <!-- Register Card -->
            <div class="bg-slate-300 shadow-2xl rounded-lg p-4 border-2 border-slate-500">

                <div class="bg-white border-2 border-slate-300 rounded-lg p-6">

                    <div class="mb-6">
                        <h2 class="text-xl font-extrabold text-slate-900">
                            Register
                        </h2>

                        <p class="text-sm text-slate-600 mt-1">
                            Create a new account to start building resumes.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block mb-2 font-bold text-slate-800">
                                Name
                            </label>

                            <input id="name"
                                   type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   autocomplete="name"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Enter your full name">

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block mb-2 font-bold text-slate-800">
                                Email
                            </label>

                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="username"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Enter your email address">

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block mb-2 font-bold text-slate-800">
                                Password
                            </label>

                            <input id="password"
                                   type="password"
                                   name="password"
                                   required
                                   autocomplete="new-password"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Create a password">

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block mb-2 font-bold text-slate-800">
                                Confirm Password
                            </label>

                            <input id="password_confirmation"
                                   type="password"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password"
                                   class="w-full border-2 border-slate-300 rounded-md px-4 py-2.5 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Repeat your password">

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Actions -->
                        <div class="pt-4 border-t-2 border-slate-200">
                            <button type="submit"
                                    class="w-full inline-flex justify-center px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-bold shadow-sm">
                                Register
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('login') }}"
                               class="text-sm font-semibold text-blue-600 hover:text-blue-800 hover:underline">
                                Already registered? Log in
                            </a>
                        </div>
                    </form>

                </div>
            </div>

            <p class="text-center text-slate-300 text-sm mt-6">
                Build, protect, and share resumes through secure public links.
            </p>

        </div>
    </div>

</body>
</html>