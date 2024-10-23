<div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
    <div class="p-6">
        <h2 class="text-2xl font-semibold mb-4">Új Bejegyzés Készítése</h2>

        <form method="POST" action="/posts">
            @csrf
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Tartalom</label>
                <textarea id="body" name="body" rows="4" required class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-purple-600 focus:ring-1 focus:ring-purple-600 sm:text-sm" placeholder="Írd meg a bejegyzés tartalmát..."></textarea>
            </div>

            <div>
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-purple-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    Bejegyzés Készítése
                </button>
            </div>
        </form>
    </div>
</div>
