<style>
    .blue-light-blue-theme {
        border: 1px solid #B2D4FD;
        background-color: #F0F7FF;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
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

    .blue-light-blue-theme input[type="password"] {
        padding: 0.5rem 0.75rem;
        border: 1px solid #D1D5DB;
        border-radius: 0.25rem;
        background-color: #F3F4F6;
        color: #374151;
        transition: border-color 0.2s ease-in-out;
    }

    .blue-light-blue-theme input[type="password"]:focus {
        border-color: #60A5FA;
        outline: none;
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.5);
    }

    .blue-light-blue-theme .text-red-600 {
        color: #DC2626;
    }

    .blue-light-blue-theme .text-green-600 {
        color: #10B981;
        font-weight: 600;
    }

    .blue-light-blue-theme .bg-blue-500 {
        background-color: #2563EB;
    }

    .blue-light-blue-theme .bg-blue-500:hover {
        background-color: #1D4ED8;
    }

    .blue-light-blue-theme .bg-blue-600 {
        background-color: #1D4ED8;
    }

    .blue-light-blue-theme .bg-blue-600:hover {
        background-color: #1E40AF;
    }

    .blue-light-blue-theme .bg-gradient-to-r {
        background-image: linear-gradient(90deg, #2563EB 0%, #60A5FA 50%, #93C5FD 100%);
    }

    .blue-light-blue-theme .bg-gradient-to-r:hover {
        background-image: linear-gradient(90deg, #1D4ED8 0%, #2563EB 50%, #60A5FA 100%);
    }

    .blue-light-blue-theme .text-white {
        color: #FFFFFF;
    }

    .blue-light-blue-theme .shadow-md {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* Customize the button style */
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
    .customizeHeader{
color: #0b0fe0;
         }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold customizeHeader">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="blue-light-blue-theme p-6">
                    @livewire('profile.update-profile-information-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="blue-light-blue-theme mt-10 sm:mt-0 p-6">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            {{-- Add attractive style to the Two-Factor Authentication section --}}
            {{--@if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())--}}
            {{--<div class="blue-light-blue-theme mt-10 sm:mt-0 p-6">--}}
            {{--@livewire('profile.two-factor-authentication-form')--}}
            {{--</div>--}}

            {{--<x-section-border />--}}
            {{--@endif--}}

            <div class="blue-light-blue-theme mt-10 sm:mt-0 p-6">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="blue-light-blue-theme mt-10 sm:mt-0 p-6">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
