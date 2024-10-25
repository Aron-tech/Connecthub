<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-semibold mb-6 text-center">{{$title}}</h1>

        <form action="{{ route('follows.select') }}" method="GET" class="mb-6 text-center">
            <input
                type="text"
                name="search"
                placeholder="Keresés felhasználó szerint..."
                class="w-full max-w-md border border-gray-300 rounded-md p-2 shadow-sm focus:border-purple-600 focus:ring-1 focus:ring-purple-600"
            >
        </form>


        <div id="user-list" class="grid grid-cols-4 gap-8">
            @foreach ($users as $user)
                <x-profilcard :user="$user" />
            @endforeach
        </div>
    </div>
    {{ $users->links() }}
</x-app>
