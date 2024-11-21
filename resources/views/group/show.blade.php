<x-app>
    <x-slot:head>@vite('resources/js/comment.js')</x-slot:head>
    <x-slot:title>{{ $group->name }} Csoport</x-slot:title>

    <div class="container mx-auto py-20 flex flex-col items-center">
        <div class="w-32 h-32 mb-6">
            <img src="{{ asset('/storage/'.$group->image) }}" alt="Csoport kép" class="w-full h-full object-cover rounded-full border-4 border-purple-600">
        </div>

        <div class="text-center">
            <h1 class="text-3xl font-semibold mb-2">{{ $group->name }}</h1>
            <p class="text-gray-700 mb-4">{{ $group->description }}</p>

            <div class="flex justify-center space-x-10 mb-4">
                <div class="text-center">
                    <a href="/groups/{{ $group->id }}/members">
                    <span class="text-2xl font-semibold">{{ $group->membersCount()}}</span>
                    <p class="text-gray-500">Tagok</p>
                    </a>
                </div>
                <div class="text-center">
                    <span class="text-2xl font-semibold">{{ $group->postsCount() }}</span>
                    <p class="text-gray-500">Posztok</p>
                </div>
            </div>
            @if (Auth::user()->isAuthorOf($group))
                <form action="/groups/{{ $group->id }}/edit" method="GET" class="py-5">
                    <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded-lg">
                        Csoport szerkesztése
                    </button>
                </form>
            @endif
            @if (Auth::user()->isMemberOf($group) && !Auth::user()->isAuthorOf($group))
                <form action="/groups/{{ $group->id }}/leave" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg">
                        Kilépés a csoportból
                    </button>
                </form>
            @elseif (!Auth::user()->isMemberOf($group))
                <form action="/groups/{{ $group->id }}/join" method="POST">
                    @csrf
                    <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded-lg">
                        Csatlakozás a csoporthoz
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if (Auth::user()->isMemberOf($group))
        <x-newpost-ingroup :group="$group" />
    @endif

    @foreach ($group?->posts as $post)
        <x-postcard :post="$post" />
    @endforeach
</x-app>
