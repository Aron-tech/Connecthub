<x-app>
    <x-slot:title>Bejegyzések</x-slot:title>

    <div class="container mx-auto py-8">
        <x-newpost/>
        @foreach ($posts as $post)
            <x-postcard :post="$post" />
        @endforeach
    </div>
    {{ $posts->links() }}
</x-app>
