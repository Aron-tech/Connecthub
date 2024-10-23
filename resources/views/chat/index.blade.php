<x-app>
    <x-slot:title>Chat választó</x-slot:title>

    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-semibold mb-6 text-center">Chat választó</h1>

        <div class="mb-6 text-center">
            <form method="GET" action="{{ route('chat.select') }}" class="w-full max-w-md mx-auto">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Keresés felhasználó szerint..."
                    class="w-full border border-gray-300 rounded-md p-2 shadow-sm focus:border-purple-600 focus:ring-1 focus:ring-purple-600"
                >
            </form>
        </div>

        <div class="grid grid-cols-4 gap-8">

            @foreach ($users as $user)
                <x-chat-profilecard :user="$user" />
            @endforeach
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app>
