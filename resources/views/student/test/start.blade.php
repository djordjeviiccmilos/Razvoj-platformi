<x-app-layout>
    <div class="container mt-5">
        <h2 class="text-center mb-4 fw-bold h2">
            <i class="fa-solid fa-file-pen me-2 text-primary"></i>Test
        </h2>
        <p class="text-center fs-5 mb-5">
            Test se sastoji od <strong>18 pitanja</strong>. Postoje pitanja na zaokruživanje sa jednim tačnim odgovorom,
            i pitanja otvorenog tipa gde student piše odgovor. <br>
            <span class="text-success fw-semibold">Srećan rad, puno uspeha!</span>
        </p>

        <form method="POST" action="{{ route('student.test.submit') }}">
            @csrf

            @foreach($questions as $index => $question)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light d-flex align-items-center">
                        <h5 class="mb-0 me-auto">Pitanje {{ $index + 1 }}</h5>
                        @if($question->type === 'multipleChoice')
                            <span class="badge bg-primary">
                                <i class="fa-solid fa-check-to-slot me-1"></i> Višestruki izbor
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                <i class="fa-solid fa-pen me-1"></i> Otvoreni odgovor
                            </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-text fs-5 mb-3">{{ $question->questionText }}</p>

                        @if($question->type === 'multipleChoice')
                            @php
                                $options = $question->shuffled_options ?? json_decode($question->options, true);
                            @endphp
                            @foreach($options as $optionIndex => $option)
                                <div class="form-check mb-2">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        id="q{{ $question->id }}_option{{ $optionIndex }}"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $option }}">
                                    <label class="form-check-label" for="q{{ $question->id }}_option{{ $optionIndex }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        @else
                            <textarea
                                name="answers[{{ $question->id }}]"
                                class="form-control"
                                rows="4"
                                placeholder="Unesite odgovor ovde..."></textarea>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="d-grid mt-4 mb-5">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fa-solid fa-paper-plane me-2"></i> Predaj
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
