<div class="flex items-start mb-2">
    <img src="{{ asset('storage/' . $message->sender->avatar) }}" alt="Profilkép" class="w-8 h-8 rounded-full border-2 border-purple-600 mr-2">
    <div>
        <p class="font-semibold"><a href="/profile/{{ $message->sender->id }}">{{ $message->sender->name }}</a></p>
        <p class="text-gray-700">{{ $message->message }}</p>
    </div>
</div>
