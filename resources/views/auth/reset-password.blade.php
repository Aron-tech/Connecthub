<x-app>
    <x-slot:title>Jelszó Visszaállítása</x-slot:title>

    <div class="container mx-auto py-10 max-w-md">
        <h2 class="text-3xl font-semibold text-center mb-6">Jelszó Visszaállítása</h2>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-input-field
                label="Email cím"
                id="email"
                name="email"
                type="email"
                placeholder="Add meg az email címed"
                value="{{ old('email', $request->email) }}"
                required
                autofocus
            />

            <x-input-field
                label="Új jelszó"
                id="password"
                name="password"
                type="password"
                placeholder="Add meg az új jelszót"
                required
            />

            <x-input-field
                label="Jelszó megerősítése"
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                placeholder="Add meg újra a jelszót"
                required
            />

            <div class="text-center mt-6">
                <x-primary-button>
                    {{ __('Jelszó visszaállítása') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app>
