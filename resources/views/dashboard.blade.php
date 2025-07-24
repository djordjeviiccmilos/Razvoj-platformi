<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <h1 class="text-center mb-4 h1">Dobrodošli, {{ auth()->user()->name }}!</h1>

        @auth
            @if (auth()->user()->role === 'student')
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4>Vaša statistika testova</h4>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-4 border-end">
                                        <h5>Ukupno urađenih testova</h5>
                                        <p class="display-5 mb-0">{{ $testCount ?? 0 }}</p>
                                    </div>
                                    <div class="col-4 border-end">
                                        <h5>Najbolji skor</h5>
                                        <p class="display-5 mb-0">{{ $bestScore ?? 0 }} / 60</p>
                                    </div>
                                    <div class="col-4">
                                        <h5>Prosečan skor</h5>
                                        <p class="display-5 mb-0">
                                            {{ $avgScore ? number_format($avgScore, 2) : 0 }} / 60
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <h5>Broj testova sa procentom uspešnosti preko 50%</h5>
                                        <p class="display-5 mb-0">
                                            {{ $above50Count }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                            </div>
                            <div class="card-body d-md-grid">
                                <a href="{{ route('student.test.start') }}" class="btn btn-success">Započni novi test</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        @endauth
    </div>
</x-app-layout>
