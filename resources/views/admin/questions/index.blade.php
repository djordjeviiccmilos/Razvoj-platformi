<x-app-layout>
    <div class="container">
        <h1 class="text-center mt-3 mb-3 h1">Lista pitanja</h1>

        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tip</th>
                <th>Tekst pitanja</th>
                <th>Pripadajući odgovori</th>
                <th>Kreator</th>
                <th>Status</th>
                <th style="min-width: 110px;">Akcije</th>
            </tr>
            </thead>
            <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td class="text-capitalize">{{ $question->type }}</td>
                    <td class="max-w-xl text-break">{!! nl2br(e(str_replace('\$', '$', $question->questionText))) !!}</td>
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
                            <ul class="list-group list-group-numbered small">
                                @foreach($options as $option)
                                    <li class="list-group-item px-2 py-1"
                                        @if($option === $question->correctAnswer)
                                            style="font-weight: bold; color: green;"
                                        @endif>
                                        {!! nl2br(e(str_replace('\$', '$', $option))) !!}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <em>Otvoreni odgovor</em>
                        @endif
                    </td>
                    <td>{{ $question->user->email }}</td>
                    <td>
                        <span class="badge {{ $question->banned ? 'bg-danger' : 'bg-success' }}">
                            {{ $question->banned ? 'Banovano' : 'Aktivno' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.questions.edit', $question) }}" class="btn btn-sm btn-warning" style="width: 90px;" title="Izmeni">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            <form action="{{ route('admin.questions.ban', $question) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="btn btn-sm {{ $question->banned ? 'btn-success' : 'btn-danger' }}"
                                        title="{{ $question->banned ? 'Odbanuj' : 'Banuj' }}" style="width: 90px;">
                                    <i class="fa-solid {{ $question->banned ? 'fa-unlock' : 'fa-ban' }}"></i>
                                </button>
                            </form>

                            <form action="{{ route('admin.questions.delete', $question) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovo pitanje?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Obriši" style="width: 90px;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
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

