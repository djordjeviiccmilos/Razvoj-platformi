<x-app-layout>
    <div class="container">
        <h2 class="h2 text-center mt-3 mb-3">Lista korisnika</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Ime</th>
                <th scope="col">Email</th>
                <th scope="col">Rola</th>
                <th scope="col">Promeni rolu u nastavnika</th>
                <th scope="col">Ban</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row"></th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if ($user->role === 'student')
                            <form action="{{ route('admin.users.promote', $user) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">Dodeli rolu nastavnika</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if ($user->role !== 'admin')
                            <form action="{{ route('admin.users.ban', $user) }}" method="POST" style="display:inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $user->banned ? 'btn-danger' : 'btn-success' }}">
                                    {{ $user->banned ? 'Odbanuj' : 'Banuj' }}
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
