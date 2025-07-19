<x-app-layout>
    <div class="container">
        <h1 class="text-center mt-3 mb-3 h1">Lista pitanja</h1>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tip</th>
                <th>Tekst pitanja</th>
                <th>Pripadajući odgovori</th>
                <th>Kreator</th>
                <th>Status</th>
                <th>Akcije</th>
            </tr>
            </thead>
            <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->type }}</td>
                    <td class="max-w-xl">{{ $question->questionText  }}</td>
                    <td class="max-w-xl">
                        @if($question->type === 'multipleChoice')
                            @php
                                $options = $question->options ?? [];
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
                    <td>{{ $question->user->email }}</td>
                    <td>{{ $question->banned ? 'Banovano' : 'Aktivno' }}</td>
                    <td>
                        <p class="mb-2">
                            <a href="{{ route('admin.questions.edit', $question) }}" class="btn btn-sm btn-warning">Izmeni</a>
                        </p>

                        <form class="mb-2" action="{{ route('admin.questions.ban', $question) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $question->banned ? 'btn-success' : 'btn-danger' }}">
                                {{ $question->banned ? 'Odbanuj' : 'Banuj' }}
                            </button>
                        </form>

                        <p>
                            <form action="{{ route('admin.questions.delete', $question) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovo pitanje?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Obriši</button>
                            </form>
                        </p>

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

