<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-auto">
            </a>
        </x-slot>

        <h2 class="text-2xl font-bold text-center mb-8">Bienvenue Back!</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-label for="email" :value="__('E-mail')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-label for="password" :value="__('Mot de passe')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-900">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-between">
                <x-button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md">
                    {{ __('Se connecter') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
