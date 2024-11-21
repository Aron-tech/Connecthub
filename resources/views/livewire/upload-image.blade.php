<div>
    <!--label for="image" class="block text-sm font-medium text-gray-700">Kép feltöltése</label-->

    <div style="width: 96px" class="mt-1 relative block py-3 px-2 widht-110px rounded-md border-0 text-sm font-medium bg-purple-600 text-white hover:bg-purple-700 cursor-pointer">
        <label for="image">
            Kép feltöltés
        </label>
        <input type="file" name="image" id="image" wire:model="image" accept="image/*"
               class="absolute top-0 left-0 opacity-0 w-full h-full cursor-pointer" />
    </div>



    @if ($image)
        <div class="mt-4">
            <p>Előnézet:</p>
            <img src="{{ $image->temporaryUrl() }}" alt="Feltöltött kép" class="w-[400px] h-[350px] object-cover border border-gray-300 rounded-lg">
        </div>
    @endif

    @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
</div>
