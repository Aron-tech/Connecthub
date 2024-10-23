<x-app>
    <x-slot:head>@vite(['resources/js/profile-edit.js'])</x-slot:head>
    <x-slot:title>Profil Szerkesztése</x-slot:title>

    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-semibold mb-6 text-center">Profil Szerkesztése</h1>

        <div class="bg-white shadow-lg rounded-lg p-8">
            <form method="POST" action="/update-profile" enctype="multipart/form-data">
                @csrf

                <!-- Jelenlegi profilkép -->
                <div class="mb-6 flex flex-col items-center">
                    <img src="https://via.placeholder.com/100" alt="Profilkép" class="w-24 h-24 object-cover rounded-full border-2 border-purple-600 mb-4" id="current-profile-picture">
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700">Új profilkép</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-purple-600 focus:ring-1 focus:ring-purple-600" onchange="previewProfilePicture(event)">
                </div>

                <!-- Felhasználónév -->
                <x-input-field id="username" name="username" label="Felhasználónév" type="text" placeholder="Felhasználónév" required />

                <!-- Bio -->
                <div class="mb-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                    <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm h-32 text-lg p-2 focus:border-purple-600 focus:ring-1 focus:ring-purple-600" placeholder="Írd ide a bemutatkozásod..."></textarea>
                </div>

                <div>
                    <button type="submit" class="w-full inline-flex items-center justify-center rounded-md border border-transparent bg-purple-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        Profil Frissítése
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewProfilePicture(event) {
    const file = event.target.files[0];
    const img = document.getElementById('current-profile-picture');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

    </script>
</x-app>
