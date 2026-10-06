<section>
    <header>
        <h2 class="text-lg font-medium text-ink">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-muted">
            {{ __('Update your account information, contact details, social links, profile photo, and professional summary.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post"
          action="{{ route('profile.update') }}"
          enctype="multipart/form-data"
          class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Profile Photo -->
        <div>
            <x-input-label for="profile_photo" :value="__('Profile Photo')" />

            @if ($user->profile && $user->profile->profile_photo)
                <div class="mt-3 mb-4">
                    <img src="{{ asset('storage/' . $user->profile->profile_photo) }}"
                         alt="{{ $user->name }}"
                         class="w-28 h-28 rounded-full object-cover border border-line shadow-sm">
                </div>
            @else
                <div class="mt-3 mb-4 w-28 h-28 rounded-full bg-surface-soft border border-line flex items-center justify-center text-muted text-sm">
                    No Photo
                </div>
            @endif

            <input id="profile_photo"
                   name="profile_photo"
                   type="file"
                   accept=".jpg,.jpeg,.png,.webp"
                   class="mt-1 block w-full border-line rounded-md shadow-xs">

            <p class="text-sm text-muted mt-1">
                Accepted formats: JPG, JPEG, PNG, WEBP. Maximum size: 2MB.
            </p>

            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />

            <x-text-input id="name"
                          name="name"
                          type="text"
                          class="mt-1 block w-full"
                          :value="old('name', $user->name)"
                          required
                          autofocus
                          autocomplete="name" />

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email"
                          name="email"
                          type="email"
                          class="mt-1 block w-full"
                          :value="old('email', $user->email)"
                          required
                          autocomplete="username" />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-ink">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                                class="underline text-sm text-muted hover:text-ink rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-strong">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Phone')" />

            <x-text-input id="phone"
                          name="phone"
                          type="text"
                          class="mt-1 block w-full"
                          :value="old('phone', $user->profile->phone ?? '')"
                          placeholder="Example: +49 XXX XXXXXXX" />

            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <!-- Address -->
        <div>
            <x-input-label for="address" :value="__('Address / Location')" />

            <x-text-input id="address"
                          name="address"
                          type="text"
                          class="mt-1 block w-full"
                          :value="old('address', $user->profile->address ?? '')"
                          placeholder="Example: City, Country" />

            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <!-- Website -->
        <div>
            <x-input-label for="website" :value="__('Website')" />

            <x-text-input id="website"
                          name="website"
                          type="url"
                          class="mt-1 block w-full"
                          :value="old('website', $user->profile->website ?? '')"
                          placeholder="https://example.com" />

            <x-input-error class="mt-2" :messages="$errors->get('website')" />
        </div>

        <!-- LinkedIn -->
        <div>
            <x-input-label for="linkedin" :value="__('LinkedIn')" />

            <x-text-input id="linkedin"
                          name="linkedin"
                          type="url"
                          class="mt-1 block w-full"
                          :value="old('linkedin', $user->profile->linkedin ?? '')"
                          placeholder="https://www.linkedin.com/in/your-name" />

            <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
        </div>

        <!-- GitHub -->
        <div>
            <x-input-label for="github" :value="__('GitHub')" />

            <x-text-input id="github"
                          name="github"
                          type="url"
                          class="mt-1 block w-full"
                          :value="old('github', $user->profile->github ?? '')"
                          placeholder="https://github.com/your-username" />

            <x-input-error class="mt-2" :messages="$errors->get('github')" />
        </div>

        <!-- Portfolio -->
        <div>
            <x-input-label for="portfolio" :value="__('Portfolio')" />

            <x-text-input id="portfolio"
                          name="portfolio"
                          type="url"
                          class="mt-1 block w-full"
                          :value="old('portfolio', $user->profile->portfolio ?? '')"
                          placeholder="https://your-portfolio.com" />

            <x-input-error class="mt-2" :messages="$errors->get('portfolio')" />
        </div>

        <!-- Xing -->
        <div>
            <x-input-label for="xing" :value="__('Xing')" />

            <x-text-input id="xing"
                          name="xing"
                          type="url"
                          class="mt-1 block w-full"
                          :value="old('xing', $user->profile->xing ?? '')"
                          placeholder="https://www.xing.com/profile/your-name" />

            <x-input-error class="mt-2" :messages="$errors->get('xing')" />
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Bio / Professional Summary')" />

            <textarea id="bio"
                      name="bio"
                      rows="5"
                      class="mt-1 block w-full border-line rounded-md shadow-xs focus:border-indigo-500 focus:ring-indigo-500"
                      placeholder="Write a short professional summary about yourself.">{{ old('bio', $user->profile->bio ?? '') }}</textarea>

            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-muted"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>