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

<x-form-section submit="updatePassword" class="blue-light-blue-theme">

    <x-slot name="title">
        <h2 class="text-2xl font-semibold">{{ __('Update Password') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-sm text-gray-600">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2 text-red-600" />
        </div>

        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="password" value="{{ __('New Password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model.defer="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2 text-red-600" />
        </div>

        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2 text-red-600" />
        </div>
    </x-slot>


    <x-slot name="actions">
        <x-action-message class="mr-3 text-green-600 font-semibold" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button class="custom-button">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
