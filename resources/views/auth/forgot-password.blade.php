<x-app>
    <x-slot:title>Jelszó Visszaállítása</x-slot:title>

    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-semibold mb-6 text-center">Jelszó Visszaállítása</h1>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Elfelejtetted a jelszavad? Nem probléma. Csak add meg az email címedet, és mi elküldünk neked egy jelszó visszaállító linket, amellyel választhatsz egy újat.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="bg-white shadow-lg rounded-lg p-8">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <x-input-field id="email" name="email" type="email" :value="old('email')" label="Email" required autofocus />

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="bg-purple-600 hover:bg-purple-700 text-white">
                        {{ __('Jelszó Visszaállító Link Küldése') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app>
