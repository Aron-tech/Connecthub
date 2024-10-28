<x-app>
    <x-slot:title>{{$title}}</x-slot:title>

    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-semibold mb-6 text-center">{{$title}}</h1>

        <div class="mb-6 text-center">
            <form method="GET" action="{{ route('groups.select') }}" class="w-full max-w-md mx-auto">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Keresés csoportnév szerint..."
                    class="w-full border border-gray-300 rounded-md p-2 shadow-sm focus:border-purple-600 focus:ring-1 focus:ring-purple-600"
                >
            </form>
        </div>

        <div class="grid grid-cols-4 gap-8">

            @foreach ($groups as $group)
                <x-group-card :group="$group" />
            @endforeach
        </div>

        <div class="mt-6">
            {{ $groups->links() }}
        </div>
    </div>
</x-app>
