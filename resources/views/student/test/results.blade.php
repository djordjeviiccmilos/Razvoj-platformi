@php
    $score = session('score');
    @endphp

<x-app-layout>
    <div class="container">
        <h1 class="text-center mt-4 mb-4 h1">Rezultati testa</h1>

        @if($score >= 30)
            <div class="alert alert-success text-center">
                <h2 class="text-center mt-4 mb-4 h1">
                    <i class="fa-solid fa-face-smile-beam me-2"></i>
                    Čestitamo! Položili ste test sa {{ $score }} poena.
                </h2>
            </div>
        @else
            <div class="alert alert-danger text-center">
                <h2 class="text-center mt-4 mb-4 h1">
                    <i class="fa-solid fa-circle-xmark me-2"></i>
                    Nažalost, niste položili test. Vaš rezultat je {{ $score }} poena.
                </h2>
            </div>
        @endif

        <div class="alert alert-info text-center">
            <i class="fa-solid fa-chart-bar text-primary"></i>
            <strong>Osvojeno poena:</strong> {{ $score }} / <strong>60</strong>
            <br>
            <strong>Procenat uspešnosti:</strong> {{ number_format($score/60 * 100, 2)}}%
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Br.</th>
                <th>Pitanje</th>
                <th>Vaš odgovor</th>
                <th>Tačan odgovor</th>
                <th>Poeni</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stats as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['questionText'] }}</td>
                    <td>{{ $item['studentAnswer'] }}</td>
                    <td>
                        @if($item['type'] === 'multipleChoice')
                            {{ $item['correctAnswer'] }}
                        @else
                            <em>Odgovor je otvorenog tipa</em>
                        @endif
                    </td>
                    <td>{{ $item['points'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Nazad na početnu</a>
        </div>
    </div>
</x-app-layout>
