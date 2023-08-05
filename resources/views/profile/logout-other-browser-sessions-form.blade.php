<style>
    .blue-light-blue-theme {
        border: 1px solid #B2D4FD;
        background-color: #F0F7FF;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .blue-light-blue-theme h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2563EB;
        margin-bottom: 1rem;
    }

    .blue-light-blue-theme p {
        font-size: 0.875rem;
        color: #4B5563;
    }

    .blue-light-blue-theme .text-sm {
        font-size: 0.875rem;
        color: #4B5563;
    }

    .blue-light-blue-theme .text-xs {
        font-size: 0.75rem;
        color: #6B7280;
    }

    .blue-light-blue-theme .text-gray-500 {
        color: #6B7280;
    }

    .blue-light-blue-theme .text-green-500 {
        color: #10B981;
    }

    .blue-light-blue-theme .text-green-600 {
        color: #047857;
        font-weight: 600;
    }

    .blue-light-blue-theme .text-red-600 {
        color: #DC2626;
    }

    .blue-light-blue-theme .bg-indigo-500 {
        background-color: #2563EB;
    }

    .blue-light-blue-theme .bg-indigo-500:hover {
        background-color: #1D4ED8;
    }

    .blue-light-blue-theme .bg-indigo-600 {
        background-color: #1D4ED8;
    }

    .blue-light-blue-theme .bg-indigo-600:hover {
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

    .blue-light-blue-theme .shadow-lg {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .blue-light-blue-theme .border-indigo-500 {
        border-color: #2563EB;
    }

    .blue-light-blue-theme .border-indigo-500:focus {
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.5);
    }
</style>

<x-action-section class="blue-light-blue-theme">
    <x-slot name="title">
        <h2 class="text-2xl font-semibold">{{ __('Browser Sessions') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-sm text-gray-600">{{ __('Manage and log out your active sessions on other browsers and devices.') }}</p>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            <p>{{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}</p>
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="flex items-center space-x-4">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>

                        <div class="text-sm text-gray-600">
                            <p>
                                {{ $session->agent->platform() ? $session->agent->platform() : __('Unknown') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Unknown') }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $session->ip_address }},

                                @if ($session->is_current_device)
                                    <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                @else
                                    {{ __('Last active') }} {{ $session->last_active }}
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <x-button class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-indigo-600 hover:via-purple-600 hover:to-pink-600 text-white shadow-lg" wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Log Out Other Browser Sessions') }}
            </x-button>

            <x-action-message class="ml-3 text-green-600 font-semibold" on="loggedOut">
                {{ __('Done.') }}
            </x-action-message>
        </div>

        <!-- Log Out Other Devices Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                <h3 class="text-lg font-semibold">{{ __('Log Out Other Browser Sessions') }}</h3>
            </x-slot>

            <x-slot name="content">
                <p>{{ __('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.') }}</p>

                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                             autocomplete="current-password"
                             placeholder="{{ __('Password') }}"
                             x-ref="password"
                             wire:model.defer="password"
                             wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-input-error class="mt-2 text-red-600" for="password" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button class="border border-gray-300 hover:border-indigo-500 text-gray-700 hover:text-indigo-600" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-button class="bg-red-500 hover:bg-red-600 text-white ml-3 shadow-lg"
                          wire:click="logoutOtherBrowserSessions"
                          wire:loading.attr="disabled">
                    {{ __('Log Out Other Browser Sessions') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
