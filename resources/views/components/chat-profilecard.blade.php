<div class="bg-white text-black rounded-lg shadow-md p-4 text-center">
    <img src="{{ asset('storage/' . $user->avatar)}}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full mx-auto mb-4">
    <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
    <p class="text-gray-500">{{'@'. Str::lower(str_replace(' ', '', $user->name)).$user->id}}</p>

    <a href="{{ route('chat.show', $user->id) }}" class="mt-4 inline-block bg-purple-600 text-white px-4 py-2 rounded-md">
        Chat indítása
    </a>
</div>
