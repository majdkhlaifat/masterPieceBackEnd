<x-guest-layout>
    <style>
        /* Style for the background */
        body {
            background-image: url('{{ asset('assets/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Additional style for the content container */
        .container {
            max-width: 100%; /* Adjust the max-width as needed */
            margin: 0 auto; /* Center the container horizontally */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
        }
        .customizeReturn{
            color: #0250c5;
            background-color: white;
        }
    </style>

    <div class="container">
        <div class="absolute top-0 left-0 mt-4 ml-4">
            <a class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 customizeReturn" href="#" onclick="goBack(); return false;">
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
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</x-guest-layout>
