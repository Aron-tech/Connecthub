<div class="flex space-x-4">
    <button type="button" wire:click="like({{ $post->id }})" class="flex items-center text-green-600 hover:text-green-800 px-4 py-2 border border-gray-400 rounded-full transition hover:bg-green-100">
        👍 Tetszik ({{ $likeCount }})
    </button>

    <button type="button" wire:click="dislike({{ $post->id }})" class="flex items-center text-red-600 hover:text-red-800 px-4 py-2 border border-gray-400 rounded-full transition hover:bg-red-100">
        👎 Nem tetszik ({{ $dislikeCount }})
    </button>
</div>
