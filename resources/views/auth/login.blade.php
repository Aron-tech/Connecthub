<x-app>
    <x-slot:title>Bejelentkezés</x-slot:title>

    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-semibold mb-6 text-center">Bejelentkezés</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="bg-white shadow-lg rounded-lg p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <x-input-field id="email" name="email" type="email" :value="old('email')" label="Email" required autofocus autocomplete="username" />

                <!-- Password -->
                <x-input-field id="password" name="password" type="password" required autocomplete="current-password" label="Password" />

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring focus:ring-purple-200" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Emlékezz rám') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Elfelejtetted a jelszavad?') }}
                        </a>
                    @endif

                    <x-primary-button>
                        {{ __('Bejelentkezés') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app>
