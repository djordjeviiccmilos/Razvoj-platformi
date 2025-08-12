<x-app-layout>
    <div class="container py-5">
        <h1 class="text-center h1">Dobrodošli, {{ auth()->user()->name }}!</h1>

        @auth
            @if (auth()->user()->role === 'student')

                <div class="container py-5">

                    <div class="mb-5 p-4 bg-light rounded shadow-sm text-center">
                        <h2 class="mb-3">
                            <i class="fa-solid fa-graduation-cap me-2 text-primary"></i>
                            Pripremite se za prijemni!
                        </h2>
                        <p class="fs-5 mb-1">
                            Ova platforma je namenjena budućim studentima
                            <strong>Prirodno-matematičkog fakulteta u Nišu</strong>,
                            smer <strong>Računarske nauke</strong>.
                        </p>
                        <p class="mb-0">
                            Ovde možete raditi testove prilagođene formatu prijemnog ispita, pratiti svoj napredak
                            i uvežbati gradivo iz matematike, logike i informatike.
                        </p>
                        <p class="mt-3 mb-0">
                            Vežbajte, pratite statistiku i povećajte šanse da ostvarite vrhunski rezultat!
                        </p>
                    </div>

                    <div class="row justify-content-center g-4 align-items-stretch">
                        <div class="col-md-8">
                            <div class="card shadow-sm h-100" style="min-height: 220px;">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="mb-0">Vaša statistika testova</h4>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-center">
                                    <div class="row text-center gy-4">
                                        <div class="col-6 col-md-3 border-end">
                                            <h6>Ukupno urađenih testova</h6>
                                            <p class="display-6 mb-0">{{ $testCount ?? 0 }}</p>
                                        </div>
                                        <div class="col-6 col-md-3 border-end">
                                            <h6>Najbolji rezultat</h6>
                                            <p class="display-6 mb-0">{{ $bestScore ?? 0 }} / 60</p>
                                        </div>
                                        <div class="col-6 col-md-3 border-end">
                                            <h6>Prosečan rezultat</h6>
                                            <p class="display-6 mb-0">{{ $avgScore ? number_format($avgScore, 2) : 0 }} / 60</p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <h6>Testovi sa uspešnošću > 50%</h6>
                                            <p class="display-6 mb-0">{{ $above50Count ?? 0 }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex">
                            <div class="card shadow-sm w-100 h-100" style="min-height: 220px;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center h-100">
                                    <div class="mb-3">
                                        <i class="fa-solid fa-play fa-4x text-success"></i>
                                    </div>
                                    <h5 class="card-title mb-2">Započni novi test</h5>
                                    <p class="card-text text-muted px-3 mb-3">
                                        Testirajte svoje znanje i vežbajte za prijemni.
                                    </p>
                                    <a href="{{ route('student.test.start') }}" class="btn btn-success">Započni test</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            @elseif (auth()->user()->role === 'nastavnik')
                <div class="row justify-content-center g-4 mt-5">
                    <!-- Kartica 1 -->
                    <div class="col-md-4">
                        <div class="card shadow-sm" style="height: 220px;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center h-100">
                                <div class="mb-3">
                                    <i class="fas fa-list fa-4x text-info"></i>
                                </div>
                                <h4 class="card-title mb-2">Pregled pitanja</h4>
                                <p class="card-text text-muted mb-3 px-3">
                                    Pogledajte sva svoja nebanovana pitanja.
                                </p>
                                <a href="{{ route('teacher.questions.index') }}" class="btn btn-info">Idi na pitanja</a>
                            </div>
                        </div>
                    </div>

                    <!-- Kartica 2 -->
                    <div class="col-md-4">
                        <div class="card shadow-sm" style="height: 220px;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center h-100">
                                <div class="mb-3">
                                    <i class="fas fa-plus-circle fa-4x text-success"></i>
                                </div>
                                <h4 class="card-title mb-2">Dodaj novo pitanje</h4>
                                <p class="card-text text-muted mb-3 px-3">
                                    Kreirajte novo pitanje za test.
                                </p>
                                <a href="{{ route('teacher.questions.create') }}" class="btn btn-success">Dodaj pitanje</a>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif(auth()->user()->role === 'admin')
                <div class="row justify-content-center g-4 mt-5">
                    <!-- Kartica 1 -->
                    <div class="col-md-4">
                        <div class="card shadow-sm" style="height: 220px;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center h-100">
                                <div class="mb-3">
                                    <i class="fas fa-users-cog fa-4x text-primary"></i>
                                </div>
                                <h4 class="card-title mb-2">Upravljanje korisnicima</h4>
                                <p class="card-text text-muted mb-3 px-3">
                                    Dodajte, izmenite ili uklonite korisnike.
                                </p>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Idi na korisnike</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm" style="height: 220px;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center h-100">
                                <div class="mb-3">
                                    <i class="fas fa-question-circle fa-4x text-success"></i>
                                </div>
                                <h4 class="card-title mb-2">Upravljanje pitanjima</h4>
                                <p class="card-text text-muted mb-3 px-3">
                                    Pregledajte i uredite pitanja.
                                </p>
                                <a href="{{ route('admin.questions.index') }}" class="btn btn-success">Idi na pitanja</a>
                            </div>
                        </div>
                    </div>
                </div>
           @endif
        @endauth
    </div>
</x-app-layout>
