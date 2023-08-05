<style>
    .blue-light-blue-theme {
        border: 1px solid #B2D4FD;
        background-color: #F0F7FF;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        --input-border-color: #2563EB;
        --input-border-focus-color: rgba(37, 99, 235, 0.5);
        --input-shadow-color: rgba(0, 0, 0, 0.1);

        --input-placeholder-color: #6B7280;
        --input-text-color: #4B5563;
        --input-background-color: #F0F7FF;
        --input-focus-background-color: #FFFFFF;

        --input-error-color: #DC2626;
        --input-success-color: #047857;

    }

    .blue-light-blue-theme h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2563EB;
        margin-bottom: 0.75rem;
    }

    .blue-light-blue-theme p {
        font-size: 0.875rem;
        color: #4B5563;
    }

    .blue-light-blue-theme label {
        font-size: 0.875rem;
        color: #4B5563;
    }

    .blue-light-blue-theme input[type="text"],
    .blue-light-blue-theme input[type="email"],
    .blue-light-blue-theme input[type="password"] {
        border: 1px solid var(--input-border-color);
        border-radius: 0.375rem;
        background-color: var(--input-background-color);
        color: var(--input-text-color);
        padding: 0.75rem 1rem;
        transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        box-shadow: 0 0 0 0 var(--input-shadow-color);
    }

    .blue-light-blue-theme input[type="text"]:focus,
    .blue-light-blue-theme input[type="email"]:focus,
    .blue-light-blue-theme input[type="password"]:focus {
        border-color: var(--input-border-focus-color);
        box-shadow: 0 0 0 3px var(--input-border-focus-color);
    }

    .blue-light-blue-theme input[type="text"]::placeholder,
    .blue-light-blue-theme input[type="email"]::placeholder,
    .blue-light-blue-theme input[type="password"]::placeholder {
        color: var(--input-placeholder-color);
    }

    .blue-light-blue-theme .text-red-600 {
        color: var(--input-error-color);
    }

    .blue-light-blue-theme .text-green-600 {
        color: var(--input-success-color);
    }
    .blue-light-blue-theme .custom-button {
        background-color: #2563EB;
        color: #FFFFFF;
        border-radius: 0.375rem;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: background-color 0.3s ease-in-out;
    }

    /* Customize the button hover style */
    .blue-light-blue-theme .custom-button:hover {
        background-color: #1D4ED8;
    }
</style>


<x-form-section submit="updateProfileInformation" class="blue-light-blue-theme">
    <x-slot name="title">
        <h2 class="text-2xl font-semibold">{{ __('Profile Information') }}</h2>


    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button class="custom-button">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
