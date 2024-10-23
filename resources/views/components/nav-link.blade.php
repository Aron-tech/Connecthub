@props(['active' => false])

<a class="{{ $active ? 'text-purple-500': 'text-gray-700 hover:text-blue-600'}} rounded-md px-3 py-2 text-sm font-medium"
   aria-current="{{ $active ? 'page': 'false' }}"
   {{ $attributes }}
>{{ $slot }}</a>
