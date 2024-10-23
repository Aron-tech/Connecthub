<x-app>
    <x-slot:title>Regisztráció</x-slot:title>

    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-semibold mb-6 text-center">Regisztráció</h1>

        <div class="bg-white shadow-lg rounded-lg p-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <x-input-field id="name" name="name" type="text" :value="old('name')" label="Név" required autofocus autocomplete="name" />

                <!-- Email Address -->
                <x-input-field id="email" name="email" type="email" :value="old('email')" label="Email" required autocomplete="username" />

                <!-- Password -->
                <x-input-field id="password" name="password" type="password" label="Jelszó" required autocomplete="new-password" />

                <!-- Confirm Password -->
                <x-input-field id="password_confirmation" name="password_confirmation" type="password" label="Jelszó megerősítése" required autocomplete="new-password" />

                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Már regisztráltál?') }}
                    </a>

                    <x-primary-button class="ms-3 bg-purple-600 hover:bg-purple-700 text-white">
                        {{ __('Regisztráció') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app>
