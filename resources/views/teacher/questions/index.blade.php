<x-app-layout>
    <div class="container">
        <h1 class="text-center mt-3 mb-3 h1">Lista pitanja</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Tip</th>
                <th>Tekst pitanja</th>
                <th>Pripadajući odgovori</th>
                <th>Akcije</th>
            </tr>
            </thead>
            <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->type }}</td>
                    <td class="max-w-xl">{{ $question->questionText }}</td>
                    <td class="max-w-xl">
                        @if($question->type === 'multipleChoice')
                            @php
                                $options = $question->options ?? [];

                                if (is_string($options)) {
                                    $decoded = json_decode($options, true);
                                    $options = is_array($decoded) ? $decoded : [];
                                } elseif (!is_array($options)) {
                                    $options = [];
                                }
                            @endphp
                            <ul class="list-group list-group-numbered">
                                @foreach($options as $option)
                                    <li class="list-group-item"
                                        @if($option === $question->correctAnswer)
                                            style="font-weight: bold; color: green;"
                                        @endif
                                    >
                                        {{ $option }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <em>Otvoreni odgovor</em>
                        @endif
                    </td>
                    <td>
                        @if($question->user_id === auth()->id())
                            <p class="mb-2">
                                <a href="{{ route('teacher.questions.edit', $question) }}" class="btn btn-sm btn-warning">Izmeni</a>
                            </p>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4 mb-8 justify-content-center d-flex">
            {{ $questions->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-app-layout>
