<nav class="bg-white shadow-md fixed top-0 left-0 w-full h-16 flex justify-between items-center px-6 z-50">
    <div class="text-2xl font-semibold text-black">
    </div>
    <ul class="flex items-center space-x-4">
        @auth
      <li>
        <x-nav-link :active="request()->is(['/', 'dashboard'])" href="/">Bejegyzések</x-nav-link>
      </li>
      <li>
        <x-nav-link :active="request()->is(['chat','chat/*'])" href="/chat">Üzenetek</x-nav-link>
      </li>
        <li class="relative group">
            <x-nav-link :active="request()->is(['groups/*','mygroups/*'])" href="/groups">
                Csoportok
            </x-nav-link>

            <ul class="absolute hidden group-hover:block mt-1 w-48 bg-white border border-gray-200 rounded-md shadow-lg transition-opacity duration-300 ease-in-out opacity-0 group-hover:opacity-100 group-hover:delay-150">
                <li>
                    <a href="/groups/in" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-300 hover:text-purple-800">Csoportjaid</a>
                </li>
                <li>
                    <a href="/groups" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-300 hover:text-purple-800">Összes csoport</a>
                </li>
                <li>
                    <a href="/groups/my" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-300 hover:text-purple-800">Saját csoportok</a>
                </li>
            </ul>
    <li>
        <li class="relative group">
            <x-nav-link :active="request()->is('follows/*')" href="#">
                Követők
            </x-nav-link>

            <ul class="absolute hidden group-hover:block mt-1 w-48 bg-white border border-gray-200 rounded-md shadow-lg transition-opacity duration-300 ease-in-out opacity-0 group-hover:opacity-100 group-hover:delay-150">

                <li>
                    <a href="/follows/{{ Auth::user()->id }}/follower" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-300 hover:text-purple-800">Követők</a>
                </li>
                <li>
                    <a href="/follows/{{ Auth::user()->id }}/followed" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-300 hover:text-purple-800">Követések</a>
                </li>
                <li>
                    <a href="/follows/list" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-300 hover:text-purple-800">Profil bekövetése</a>
                </li>
            </ul>
      <li>
        <x-nav-link :active="request()->is('profile/*')" href="/profile/{{ Auth::user()->id}}">Profil</x-nav-link>
      </li>
      <li>
        <x-nav-link :active="request()->is('settings')" href="/settings">Beállítások</x-nav-link>
      </li>
      <li>
        <form action="/logout" method="POST">
          @csrf
          <button class="rounded-md px-3 py-2 text-sm font-medium  text-gray-700 hover:text-blue-600" type="submit">Kijelentkezik</button>
        </form>
      </li>
      @endauth

      @guest
      <li>
        <x-nav-link :active="request()->is('login')" href="/login">Bejelentkezés</x-nav-link>
      </li>
      <li>
        <x-nav-link :active="request()->is('register')" href="/register">Regisztráció</x-nav-link>
      </li>
      @endguest
    </ul>
    <div class="flex items-center">
    </div>
  </nav>
