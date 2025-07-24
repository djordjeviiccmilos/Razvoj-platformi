<x-app-layout>
    <div class="container mt-4">
        <h2 class="mb-3 mt-3 text-center h2">TEST</h2>
        <p class="mb-3 mt-3 text-center h4">Test se sastoji od 18 pitanja. Postoje pitanja na zaokruživanje sa jednim tačnim odgovorom,
        i pitanja koja su otvorenog tipa, gde student piše odgovr. Srećan rad, puno uspeha!</p>
        <form method="POST" action="{{ route('student.test.submit') }}">
            @csrf

            @foreach($questions as $index => $question)
                <div class="mb-4 p-3 border rounded">
                    <h5>Pitanje {{ $index + 1 }} </h5>
                    <p>
                           {{ $question->questionText }}
                    </p>

                    @if($question->type === 'multipleChoice')
                        @php
                            $options = $question->shuffled_options ?? $question->options;
                        @endphp
                        @foreach($options as $optionIndex => $option)
                            <div class="form-check">
                                <input class="form-check-input" type="radio"
                                       name="answers[{{ $question->id }}]"
                                       value="{{ $option }}">
                                <label class="form-check-label" for="q{{ $question->id }}_option{{ $optionIndex }}">
                                    {{ $option }}
                                </label>
                            </div>
                        @endforeach
                    @else
                        <textarea name="answers[{{ $question->id }}]" class="form-control" rows="3" placeholder="Uneste odgovor ovde..."></textarea>
                    @endif
                </div>
            @endforeach

            <div class="d-grid">
                <button type="submit" class="btn btn-primary text-center mb-3 mt-3">Oceni</button>
            </div>

        </form>
    </div>
</x-app-layout>

