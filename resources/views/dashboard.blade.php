<x-app>
    <x-slot:head>@vite('resources/js/comment.js')</x-slot:head>
    <x-slot:title>Bejegyzések</x-slot:title>

    <div class="container mx-auto py-8">
        <x-newpost/>
        @foreach ($posts as $post)
            <x-postcard :post="$post" />
        @endforeach
    </div>
    {{ $posts->links() }}
</x-app>
