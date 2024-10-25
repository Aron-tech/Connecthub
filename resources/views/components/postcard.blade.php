<div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6 border border-gray-200">

    <div class="p-6 flex items-center">
        <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="Profilkép" class="w-8 h-8 rounded-full border-2 border-purple-600 mr-2">
        <div>
            <h2 class="text-2xl font-semibold mb-1">
                <a href="/profile/{{ $post->user->id }}" class="text-purple-600 hover:text-purple-800">{{ $post->user->name }}</a>
            </h2>
            <p class="text-gray-700">{{ $post->body }}</p>
        </div>
    </div>

    @if ($post->image)
        <div class="px-6 py-4 flex justify-center">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Bejegyzés képe" class="w-[400px] h-[350px] object-cover border border-gray-300 rounded-lg">
        </div>
    @endif

    <div class="flex items-center justify-between px-6 py-4 border-t border-gray-300 bg-gray-50">
        <div class="flex space-x-4">
            <form method="POST" action="/post/{{ $post->id }}/like">
                @csrf
                @method('PATCH')
                <button type="submit" class="flex items-center text-green-600 hover:text-green-800 px-4 py-2 border border-green-600 rounded-full transition">
                    👍 Like ({{ $post->likes }})
                </button>
            </form>

            <form method="POST" action="/post/{{ $post->id }}/dislike">
                @csrf
                @method('PATCH')
                <button type="submit" class="flex items-center text-red-600 hover:text-red-800 px-4 py-2 border border-red-600 rounded-full transition">
                    👎 Dislike ({{ $post->dislikes }})
                </button>
            </form>
        </div>

        <button id="toggle-comments-postid" class="text-purple-600 hover:bg-purple-100 px-4 py-2 border border-purple-600 rounded-full transition focus:outline-none">
            Kommentek ({{ count($post->comments) }})
        </button>
    </div>

    <div id="comments-section-postid" class="hidden px-6 py-4">
        <div class="mb-4">
        </div>
        <form method="POST" action="/posts/{{ $post->id }}/comments">
            @csrf
            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700">Írd meg a kommentet:</label>
                <textarea id="body" name="body" rows="3" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-purple-600 focus:ring-1 focus:ring-purple-600 sm:text-sm" placeholder="Írj egy hozzászólást..."></textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}">
            </div>
            @foreach ($post->comments as $comment)
                <x-comment :comment="$comment" />
            @endforeach
            <div>
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-purple-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    Küldés
                </button>
            </div>
        </form>
    </div>
</div>
