<x-app>
    <x-slot:title>Új Csoport Létrehozása</x-slot:title>

    <div class="container mx-auto py-20 max-w-lg">
        <h2 class="text-3xl font-semibold text-center mb-6">Új Csoport Létrehozása</h2>

        <!-- Hibák megjelenítése -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Csoport létrehozása form -->
        <form action="{{ route('groups.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Csoport név -->
            <x-input-field id="name" name="name" type="text" label="Csoport neve" required autofocus/>

            <!-- Csoport leírás -->
            <x-input-field id="description" name="description" type="text" label="Csoport leírása" required/>


            <div>
                <label for="image" class="block font-semibold mb-2">Csoport kép</label>
                <input type="file" name="image" id="image" class="border border-gray-300 rounded-lg p-2 w-full">
            </div>

            <!-- Létrehozás gomb -->
            <div class="text-center">
                <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700">
                    Csoport Létrehozása
                </button>
            </div>
        </form>
    </div>
</x-app>
