<x-app-layout>
    <div class="container">
        <h2 class="h2 mt-3 mb-3 text-center">Izmena pitanja</h2>

        <form action="{{ route('teacher.questions.update', $question) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tekst pitanja</label>
                <input type="text" name="questionText" class="form-control" value="{{ $question->questionText }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tip pitanja</label>
                <select name="type" class="form-select" id="questionType" required onchange="toggleOptions(this.value)">
                    <option value="multipleChoice" {{ $question->type == 'multipleChoice' ? 'selected' : '' }}>Zaokruživanje</option>
                    <option value="open" {{ $question->type == 'open' ? 'selected' : '' }}>Otvoreni odgovor</option>
                </select>
            </div>

            <div id="multipleChoiceOptions">
                <label class="form-label">Opcije</label>
                @php $options = $question->options ?? []; @endphp
                @for ($i = 0; $i < 4; $i++)
                    <input type="text" name="options[]" class="form-control mb-2" value="{{ $options[$i] ?? '' }}">
                @endfor

                <label class="form-label">Tačan odgovor</label>
                <input type="text" name="correctAnswer" class="form-control" value="{{ $question->correctAnswer }}">
            </div>

            <button type="submit" class="btn btn-success mt-3">Sačuvaj izmene</button>
        </form>
    </div>

    <script>
        function toggleOptions(type) {
            document.getElementById('multipleChoiceOptions').style.display = (type === 'multipleChoice') ? 'block' : 'none';
        }

        window.onload = function () {
            toggleOptions(document.getElementById('questionType').value);
        }
    </script>
</x-app-layout>
