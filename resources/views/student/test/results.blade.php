@php
    $score = session('score');
    @endphp

<x-app-layout>
    <div class="container">
        <h1 class="text-center mt-4 mb-4 h1">Rezultati testa</h1>

        <div class="alert alert-info text-center">
            <strong>Osvojeno poena:</strong> {{ $score }} / <strong>60</strong>
            <br>
            <strong>Procenat uspešnosti:</strong> {{ $score/60 }}%
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
