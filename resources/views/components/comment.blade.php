<div class="flex items-start mb-2">
<img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="Profilkép" class="w-8 h-8 rounded-full border-2 border-purple-600 mr-2">
<p class="text-gray-700">{{ $comment->user->name }} - {{ $comment->body }}</p>
</div>
