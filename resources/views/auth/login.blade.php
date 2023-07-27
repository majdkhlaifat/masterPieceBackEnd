<x-guest-layout>
<div class="absolute top-0 left-0 mt-4 ml-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="#" onclick="goBack(); return false;">
        {{ __('Return to Previous Page') }}
        </a>
  </div>
    <x-authentication-card>
    <x-slot name="logo">
        <a href="/">
        <img src="{{ asset('assets/imgs/LogoMakr-0qlole.png') }}" alt="logo" width="100px" height="80px">
        </a>
        </x-slot>
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
    <script>
    function goBack() {
      window.history.back();
    }
  </script>
</x-guest-layout>
