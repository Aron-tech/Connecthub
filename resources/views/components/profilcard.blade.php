<div class="bg-white shadow-lg rounded-lg p-4 flex flex-col items-center transition duration-200 hover:border-purple-600 hover:shadow-lg border-2 border-transparent focus:border-purple-600 focus:ring-1 focus:ring-purple-600">
    <img src="{{asset('/storage/'.$user->avatar)}}" alt="Profilkép" class="w-24 h-24 object-cover rounded-full border-2 border-purple-600 mb-2">
    <h2 class="text-xl font-semibold">{{$user->name}}</h2>
    <p class="text-gray-500">{{'@'. Str::lower(str_replace(' ', '', $user->name)).$user->id}}</p>
    <a href="/profile/{{$user->id}}" class="mt-2 inline-flex items-center justify-center rounded-md border border-transparent bg-purple-600 py-1 px-3 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
        Profil Megtekintése
    </a>
</div>
