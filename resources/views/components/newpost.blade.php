<x-slot:head>
    @vite('resources/js/emojipicker.js')
</x-slot:head>

<div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
    <div class="p-6 flex">
        <div class="flex-grow mr-4">
            <h2 class="text-2xl font-semibold mb-4">Új Bejegyzés Készítése</h2>

            <form method="POST" action="/posts" enctype="multipart/form-data">
                @csrf
                <livewire:uploadimage />

                <div class="mb-4 relative">
                    <label for="body" class="block text-sm font-medium text-gray-700">Tartalom</label>
                    <textarea id="body" name="body" rows="4" required class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-purple-600 focus:ring-1 focus:ring-purple-600 sm:text-sm pr-10" placeholder="Írd meg a bejegyzés tartalmát..."></textarea>

                    <!-- Emoji button -->
                    <button type="button" id="emoji-button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800">
                        😊
                    </button>

                    <!-- Emoji picker -->
                    <div id="emoji-picker" class="hidden absolute bg-gray-100 p-2 rounded-lg shadow-md">
                        <div class="grid grid-cols-5 gap-2">
                            <button type="button" class="emoji" data-emoji="😀">😀</button>
                            <button type="button" class="emoji" data-emoji="😃">😃</button>
                            <button type="button" class="emoji" data-emoji="😄">😄</button>
                            <button type="button" class="emoji" data-emoji="😁">😁</button>
                            <button type="button" class="emoji" data-emoji="😆">😆</button>
                            <button type="button" class="emoji" data-emoji="😅">😅</button>
                            <button type="button" class="emoji" data-emoji="😂">😂</button>
                            <button type="button" class="emoji" data-emoji="🤣">🤣</button>
                            <button type="button" class="emoji" data-emoji="😊">😊</button>
                            <button type="button" class="emoji" data-emoji="😇">😇</button>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-purple-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        Bejegyzés Készítése
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
