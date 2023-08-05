<style>
    .red-theme {
        border: 1px solid #FECACA;
        background-color: #FFF5F5;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .red-theme h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #DC2626;
        margin-bottom: 1rem;
    }

    .red-theme p {
        font-size: 0.875rem;
        color: #6B7280;
    }

    .red-theme .text-sm {
        font-size: 0.875rem;
        color: #6B7280;
    }

    .red-theme .text-gray-600 {
        color: #6B7280;
    }

    .red-theme .text-red-600 {
        color: #DC2626;
    }

    .red-theme .bg-red-500 {
        background-color: #DC2626;
    }

    .red-theme .bg-red-500:hover {
        background-color: #B91C1C;
    }

    .red-theme .bg-red-600 {
        background-color: #B91C1C;
    }

    .red-theme .bg-red-600:hover {
        background-color: #991B1B;
    }

    .red-theme .text-white {
        color: #FFFFFF;
    }

    .red-theme .shadow-lg {
        box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.1), 0 2px 4px -1px rgba(220, 38, 38, 0.06);
    }

    .red-theme .border-red-300 {
        border-color: #FECACA;
    }

    .red-theme .border-red-300:focus {
        border-color: #FECACA;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.5);
    }
</style>

<x-action-section class="red-theme">
    <x-slot name="title">
        <h2 class="font-semibold text-xl text-red-600">
            {{ __('Delete Account') }}
        </h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-600">
            {{ __('Permanently delete your account.') }}
        </p>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                <h3 class="font-semibold text-red-600">
                    {{ __('Delete Account') }}
                </h3>
            </x-slot>

            <x-slot name="content">
                <p class="text-gray-600">
                    {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4 border border-red-300 rounded-md"
                             autocomplete="current-password"
                             placeholder="{{ __('Password') }}"
                             x-ref="password"
                             wire:model.defer="password"
                             wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
