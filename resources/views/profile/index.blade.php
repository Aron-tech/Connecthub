<x-app>
    <x-slot:head>@vite('resources/js/comment.js')</x-slot:head>
    <x-slot:title>Profil</x-slot:title>

    <div class="container mx-auto py-20 flex flex-col items-center">
        <div class="w-32 h-32 mb-6">
            <img src="{{ asset('/storage/'.$user->avatar) }}" alt="Profilkép" class="w-full h-full object-cover rounded-full border-4 border-purple-600">
        </div>

        <div class="text-center">
            <h1 class="text-3xl font-semibold mb-2">{{ $user->name }}</h1>
            <p class="text-gray-700 mb-4">{{'@'. Str::lower(str_replace(' ', '', $user->name)).$user->id}}</p>

            <div class="flex justify-center space-x-10 mb-4">
                <div class="text-center">
                    <a href="/follows/{{ $user->id }}/follower">
                    <span class="text-2xl font-semibold">{{$followingCount}}</span>
                    <p class="text-gray-500">Követő</p>
                    </a>
                </div>
                <div class="text-center">
                    <a href="/follows/{{ $user->id }}/followed">
                    <span class="text-2xl font-semibold">{{$followersCount}}</span>
                    <p class="text-gray-500">Követés</p>
                    </a>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-gray-700">{{ $user->description }}</p>
            </div>

            @if (Auth::user()->id != $user->id)
                <form action="/follows/{{ $user->id }}/remove" method="POST">
                    @csrf
                    @if (Auth::user()->isFollowing($user))

                        <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg">
                            Követed (Kikövetés)
                        </button>
                    </form>
                    @else
                    <form action="/follows/{{ $user->id }}/add" method="POST">
                        @csrf

                        <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded-lg">
                            Követés
                        </button>
                    </form>
                    @endif
            @else

                <a href="{{ route('profile.edit', $user->id) }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-purple-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    Profil Szerkesztése
                </a>
            @endif
        </div>
    </div>

    @if (Auth::user()->id == $user->id)
        <x-newpost />
    @endif

    @foreach ($posts as $post)
        <x-postcard :post="$post" />
    @endforeach
</x-app>
