<x-app-layout>
    <div class="container py-4">
        <h2 class="text-center mb-4 h2">
            <i class="fa-solid fa-users me-2 text-primary"></i>
            Lista korisnika
        </h2>

        <div class="row g-4">
            @foreach($users as $user)
                <div class="col-md-4 col-lg-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-user fa-lg"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">{{ $user->name }}</h5>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>

                            <p class="mb-2">
                                <i class="fa-solid fa-id-badge me-1 text-secondary"></i>
                                <strong>Rola:</strong> {{ ucfirst($user->role) }}
                            </p>

                            <div class="mt-auto">
                                @if ($user->role === 'student')
                                    <form action="{{ route('admin.users.promote', $user) }}" method="POST" class="d-inline-block mb-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-primary w-100">
                                            <i class="fa-solid fa-chalkboard-teacher me-1"></i> Dodeli rolu nastavnika
                                        </button>
                                    </form>
                                @endif

                                @if ($user->role !== 'admin')
                                    <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="d-inline-block w-100">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm w-100 {{ $user->banned ? 'btn-success' : 'btn-danger' }}">
                                            <i class="fa-solid {{ $user->banned ? 'fa-unlock' : 'fa-ban' }} me-1"></i>
                                            {{ $user->banned ? 'Odbanuj' : 'Banuj' }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
