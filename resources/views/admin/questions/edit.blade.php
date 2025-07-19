<x-app-layout>
    <div class="container">
        <form method="POST" action="{{ route('admin.questions.update', $question) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="type" class="form-label">Tip pitanja</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="multipleChoice" {{ $question->type === 'multipleChoice' ? 'selected' : '' }}>Višestruki izbor</option>
                    <option value="open" {{ $question->type === 'open' ? 'selected' : '' }}>Otvoreni odgovor</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="questionText" class="form-label">Tekst pitanja</label>
                <input type="text" name="questionText" id="questionText" class="form-control" value="{{ $question->questionText }}" required>
            </div>

            <div class="mb-3" id="multipleChoiceFields" style="{{ $question->type === 'multipleChoice' ? '' : 'display:none;' }}">
                <label class="form-label">Opcije odgovora</label>
                @php
                    $options = json_decode($question->options, true) ?? [];
                @endphp
                @foreach($options as $index => $option)
                    <input type="text" name="options[]" class="form-control mb-2" value="{{ $option }}" required>
                @endforeach

                <label class="form-label mt-3">Tačan odgovor</label>
                <input type="text" name="correctAnswer" class="form-control" value="{{ $question->correctAnswer }}">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">Sačuvaj izmene</button>
                <a href="{{ route('admin.questions.index') }}" class="btn btn-secondary">Nazad</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('type').addEventListener('change', function () {
            const type = this.value;
            document.getElementById('multipleChoiceFields').style.display = type === 'multipleChoice' ? 'block' : 'none';
        });
    </script>
</x-app-layout>
