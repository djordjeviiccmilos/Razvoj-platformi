<x-app-layout>
    <div class="container">
        <h2 class="h2 mt-3 mb-3 text-center">Dodaj pitanje</h2>

        <form action="{{ route('teacher.questions.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="questionText" class="form-label">Tekst pitanja</label>
                <input type="text" name="questionText" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tip pitanja</label>
                <select name="type" class="form-select" id="questionType" required onchange="toggleOptions(this.value)">
                    <option value="multipleChoice">Zaokruživanje</option>
                    <option value="open">Otvoreni odgovor</option>
                </select>
            </div>

            <div id="multipleChoiceOptions">
                <label for="options[]" class="form-label">Opcije:</label>
                <input type="text" name="options[]" class="form-control" placeholder="Opcija 1">
                <input type="text" name="options[]" class="form-control" placeholder="Opcija 2">
                <input type="text" name="options[]" class="form-control" placeholder="Opcija 3">
                <input type="text" name="options[]" class="form-control" placeholder="Opcija 4">

                <label for="correctAnswer" class="form-label">Tačan odgovor</label>
                <input type="text" name="correctAnswer" class="form-control">
            </div>

            <button type="submit" class="btn btn-success mt-3">Sačuvaj</button>
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
