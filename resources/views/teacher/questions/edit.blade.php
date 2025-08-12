<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center rounded-top-4">
                <h3 class="mb-0">
                    <i class="fa-solid fa-pen-to-square me-2"></i> Izmena pitanja
                </h3>
            </div>

            @if($errors->has('correctAnswer'))
                <div class="alert alert-danger mt-2">
                    {{ $errors->first('correctAnswer') }}
                </div>
            @endif

            @error('options')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror

            <div class="card-body p-4">
                <form action="{{ route('teacher.questions.update', $question) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fa-solid fa-question-circle me-1 text-primary"></i> Tekst pitanja
                        </label>
                        <input type="text" name="questionText"
                               class="form-control form-control-lg rounded-3 shadow-sm"
                               value="{{ $question->questionText }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fa-solid fa-list-check me-1 text-primary"></i> Tip pitanja
                        </label>
                        <select name="type" class="form-select form-select-lg rounded-3 shadow-sm"
                                id="questionType" required onchange="toggleOptions(this.value)">
                            <option value="multipleChoice" {{ $question->type == 'multipleChoice' ? 'selected' : '' }}>
                                Zaokruživanje
                            </option>
                            <option value="open" {{ $question->type == 'open' ? 'selected' : '' }}>
                                Otvoreni odgovor
                            </option>
                        </select>
                    </div>

                    <div id="multipleChoiceOptions" class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="fa-solid fa-square-check me-1 text-primary"></i> Opcije
                        </label>
                        @php
                            $options = $question->options ?? [];

                            if (is_string($options)) {
                                $decoded = json_decode($options, true);
                                $options = is_array($decoded) ? $decoded : [];
                            } elseif (!is_array($options)) {
                                $options = [];
                            }
                        @endphp
                        @for ($i = 0; $i < 4; $i++)
                            <input type="text" name="options[]"
                                   class="form-control rounded-3 shadow-sm mb-2"
                                   placeholder="Opcija {{ $i+1 }}"
                                   value="{{ $options[$i] ?? '' }}" required>
                        @endfor

                        <label class="form-label fw-bold mt-3">
                            <i class="fa-solid fa-check me-1 text-success"></i> Tačan odgovor
                        </label>
                        <input type="text" name="correctAnswer"
                               class="form-control rounded-3 shadow-sm"
                               value="{{ $question->correctAnswer }}" required>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success btn-lg rounded-3 shadow-sm px-4">
                            <i class="fa-solid fa-save me-1"></i> Sačuvaj izmene
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleOptions(type) {
            document.getElementById('multipleChoiceOptions').style.display =
                (type === 'multipleChoice') ? 'block' : 'none';
        }
        window.onload = function () {
            toggleOptions(document.getElementById('questionType').value);
        }
    </script>
</x-app-layout>
