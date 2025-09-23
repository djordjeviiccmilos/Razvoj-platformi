<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-success text-white text-center rounded-top-4">
                <h3 class="mb-0">
                    <i class="fa-solid fa-plus me-2"></i> Dodaj novo pitanje
                </h3>
            </div>

            @if($errors->has('correctAnswer'))
                <div class="alert alert-danger mt-2">
                    {{ $errors->first('correctAnswer') }}
                </div>
            @endif

            <div class="card-body p-4">
                <form action="{{ route('teacher.questions.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fa-solid fa-question-circle me-1 text-success"></i> Tekst pitanja
                        </label>
                        <input type="text" name="questionText"
                               class="form-control form-control-lg rounded-3 shadow-sm"
                               placeholder="Unesite tekst pitanja" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fa-solid fa-list-check me-1 text-success"></i> Tip pitanja
                        </label>
                        <select name="type" class="form-select form-select-lg rounded-3 shadow-sm"
                                id="questionType" required onchange="toggleOptions(this.value)">
                            <option value="multipleChoice">Zaokruživanje</option>
                            <option value="open">Otvoreni odgovor</option>
                        </select>
                    </div>

                    <div id="multipleChoiceOptions" class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fa-solid fa-square-check me-1 text-success"></i> Opcije
                        </label>
                        <input type="text" name="options[]"
                               class="form-control rounded-3 shadow-sm mb-2 option-input"
                               placeholder="Opcija 1" required>
                        <input type="text" name="options[]"
                               class="form-control rounded-3 shadow-sm mb-2 option-input"
                               placeholder="Opcija 2" required>
                        <input type="text" name="options[]"
                               class="form-control rounded-3 shadow-sm mb-2 option-input"
                               placeholder="Opcija 3" required>
                        <input type="text" name="options[]"
                               class="form-control rounded-3 shadow-sm mb-2 option-input"
                               placeholder="Opcija 4" required>

                        <label class="form-label fw-bold mt-3">
                            <i class="fa-solid fa-check me-1 text-success"></i> Tačan odgovor
                        </label>
                        <input type="text" name="correctAnswer"
                               class="form-control rounded-3 shadow-sm"
                               placeholder="Unesite tačan odgovor">
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success btn-lg rounded-3 shadow-sm px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Sačuvaj
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleOptions(type) {
            const optionsDiv = document.getElementById('multipleChoiceOptions');
            const optionInputs = document.querySelectorAll('.option-input');
            const correctAnswer = document.querySelector('input[name="correctAnswer"]');

            if (type === 'multipleChoice') {
                optionsDiv.style.display = 'block';
                optionInputs.forEach(input => {
                    input.removeAttribute('disabled');
                    input.setAttribute('required', true);
                });
                correctAnswer.removeAttribute('disabled');
            } else {
                optionsDiv.style.display = 'none';
                optionInputs.forEach(input => {
                    input.removeAttribute('required');
                    input.setAttribute('disabled', true); // <<<<< ključna stvar
                    input.value = ''; // očisti vrednost
                });
                correctAnswer.setAttribute('disabled', true); // <<<<< ključna stvar
                correctAnswer.value = '';
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            toggleOptions(document.getElementById('questionType').value);
        });
    </script>

</x-app-layout>

