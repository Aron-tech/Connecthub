<div>
    <label for="image" class="block text-sm font-medium text-gray-700">Kép feltöltése (opcionális)</label>

    <!-- Kép feltöltése -->
    <input type="file" name="image" id="image" wire:model="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700"/>

    <!-- Kép előnézete, csak ha van feltöltött kép -->
    @if ($image)
        <div class="mt-4">
            <p>Előnézet:</p>
            <img src="{{ $image->temporaryUrl() }}" alt="Feltöltött kép" class="border border-gray-300 rounded-lg w-450 h-450 object-cover">
        </div>
    @endif

    <!-- Validációs hibaüzenetek -->
    @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>
