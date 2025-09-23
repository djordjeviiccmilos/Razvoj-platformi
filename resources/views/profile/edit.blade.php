<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Informacije o profilu -->
            <section class="bg-white shadow rounded-lg p-6 border border-blue-200 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-id-card text-blue-500"></i>
                    Informacije o profilu
                </h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            <!-- Promena lozinke -->
            <section class="bg-white shadow rounded-lg p-6 border border-green-200 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-xl font-semibold mb-4 text-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-key text-green-600"></i>
                    Promena lozinke
                </h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            <!-- Brisanje naloga -->
            <section class="bg-white shadow rounded-lg p-6 border border-red-200 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-xl font-semibold mb-4 text-red-600 flex items-center gap-2">
                    <i class="fa-solid fa-trash-can text-red-600"></i>
                    Brisanje naloga
                </h3>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
