<x-app>
    <x-slot:title>Beállítások</x-slot:title>

    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-semibold mb-6 text-center">Beállítások</h1>

        <div class="bg-white shadow-lg rounded-lg p-8">
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{route('settings.update')}}">
                @csrf
                @method('PATCH')

                <x-input-field
                    id="email"
                    name="email"
                    value=""
                    placeholder="{{old('email', Auth::user()->email)}}"
                    label="Email"
                    type="email"
                />

                
                <x-input-field
                    id="password"
                    name="password"
                    label="Új jelszó (opcionális)"
                    type="password"
                />

                <x-input-field
                    id="password_confirmation"
                    name="password_confirmation"
                    label="Jelszó megerősítése"
                    type="password"
                />

                <div>
                    <button type="submit" class="w-full inline-flex items-center justify-center rounded-md border border-transparent bg-purple-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        Beállítások frissítése
                    </button>
                </div>
            </form>

            <form method="POST" action="{{ route('settings.delete') }}" class="mt-6">
                @csrf
                @method('DELETE')
                <div>
                    <button type="submit" class="w-full inline-flex items-center justify-center rounded-md border border-red-600 py-2 px-4 text-sm font-medium text-red-600 hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Fiók törlése
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app>
