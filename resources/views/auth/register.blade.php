<x-guest-layout>
    <style>
        .customize{
            color: #0250c5;
            background-color: white;
        }
    </style>
    <div class="absolute top-0 left-0 mt-4 ml-4">
        <a class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 customize" href="#" onclick="goBack(); return false;">
        {{ __('Return to Previous Page') }}
        </a>
  </div>
  <x-authentication-card style="background-image: url('https://www.chss.org.uk/wp-content/uploads/apple_tape-web.jpg'); background-size: cover;">
    <x-slot name="logo">
      <a href="/">
        <img src="{{ asset('assets/imgs/LogoMakr-0qlole.png') }}" alt="logo" width="100px" height="80px" style="margin-top:110px">
      </a>
    </x-slot>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div>
        <x-label for="name" value="{{ __('Name') }}" />
        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
        @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mt-4">
        <x-label for="email" value="{{ __('Email') }}" />
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
        @error('email')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <x-label for="phone" value="{{ __('phone') }}" />
        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" autofocus autocomplete="phone" />
        @error('phone')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <x-label for="address" value="{{ __('address') }}" />
        <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" autofocus autocomplete="address" />
        @error('address')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mt-4">
        <x-label for="password" value="{{ __('Password') }}" />
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
        @error('password')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mt-4">
        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
          {{ __('Already registered?') }}
        </a>

        <x-button class="ml-4">
          {{ __('Register') }}
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
