<div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">

    <div class="p-6 flex items-center">
        <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="Profilkép" class="w-8 h-8 rounded-full border-2 border-purple-600 mr-2">
        <div>
            <h2 class="text-2xl font-semibold mb-1"><a href="/profile/{{ $post->user->id }}">{{ $post->user->name }}</a></h2>
            <p class="text-gray-700">{{ $post->body }}</p>
        </div>
    </div>

    @if ($post->image)
        <div class="px-6 py-4">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Bejegyzés képe" style="width: 450px; height: 450px;" class="object-cover border border-gray-300 rounded-lg">
        </div>
    @endif


    <div class="px-6 py-4 flex items-center space-x-4">
        <form method="POST" action="/post/{{ $post->id }}/like">
            @csrf
            @method('PATCH')
            <button type="submit" class="text-green-600 hover:text-green-800">
                👍 Like ({{ $post->likes }})
            </button>
        </form>

        <form method="POST" action="/post/{{ $post->id }}/dislike">
            @csrf
            @method('PATCH')
            <button type="submit" class="text-red-600 hover:text-red-800">
                👎 Dislike ({{ $post->dislikes }})
            </button>
        </form>
    </div>

    <div class="border-t border-gray-300">
        <button id="toggle-comments-postid" class="w-full text-left px-6 py-4 text-purple-600 hover:bg-purple-100 focus:outline-none">
            Kommentek ({{ count($post->comments) }})
        </button>

        <div id="comments-section-postid" class="hidden px-6 py-4">
            <div class="mb-4">
                <!-- Komment szekció -->
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
</div>
