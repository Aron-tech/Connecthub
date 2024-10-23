<x-app>
    <x-slot:title>Chat</x-slot:title>
    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-semibold mb-6 text-center">Chat</h1>

        <div class="bg-white shadow-lg rounded-lg h-[500px] flex flex-col overflow-hidden">
            <div class="p-4 border-b border-gray-300">
                <h2 class="text-xl font-semibold">Beszélgetés</h2>
            </div>
            <div class="flex-grow h-72 overflow-y-auto p-4">

                <livewire:chatmessage :user="$user" />
            </div>
            <div class="p-4 border-t border-gray-300">
                <form method="POST" action="/chat/{{ $user->id }}" class="flex">
                    @csrf
                    <input type="text" name="message" placeholder="Írj egy üzenetet..." class="flex-grow border border-gray-300 rounded-md p-2 shadow-sm focus:border-purple-600 focus:ring-1 focus:ring-purple-600 mr-2" required>
                    <button type="submit" class="bg-purple-600 text-white rounded-md px-4 py-2 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        Küldés
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app>
