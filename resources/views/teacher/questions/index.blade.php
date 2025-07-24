<x-app-layout>
    <div class="container">
        <h1 class="text-center mt-3 mb-4 h1">Test znanja</h1>

        <form action="{{ route('student.test.submit') }}" method="POST">
            @csrf

            @foreach($questions as $index => $question)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>{{ $index + 1 }}. {{ $question->questionText }}</h5>

                        @if($question->type === 'multipleChoice')
                            @foreach($question->shuffled_options as $option)
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $option }}"
                                        id="q{{ $question->id }}_{{ $loop->index }}"
                                    >
                                    <label class="form-check-label" for="q{{ $question->id }}_{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        @else
                            <textarea
                                name="answers[{{ $question->id }}]"
                                class="form-control mt-2"
                                rows="3"
                                placeholder="Unesite svoj odgovor ovde..."></textarea>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="text-center mb-5">
                <button type="submit" class="btn btn-success">Oceni</button>
            </div>
        </form>
    </div>
</x-app-layout>
