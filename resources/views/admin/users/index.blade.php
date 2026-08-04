<x-layouts.admin title="Kelola Pengguna">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Pengguna</h2>
            <p class="text-secondary mb-0">Kelola akun dan peran pengguna dashboard</p>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Peran</th>
                        <th class="text-end">Ubah Peran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-secondary">{{ $loop->iteration }}</td>
                            <td class="fw-medium text-body">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="avatar avatar-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    <div>
                                        <div>{{ $user->name }}</div>
                                        @if ($user->is(auth()->user()))
                                            <span class="badge bg-secondary">Anda</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-secondary">{{ $user->email }}</td>
                            <td class="text-secondary">{{ $user->username ?? '-' }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="badge bg-primary text-white">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-end">
                                <form method="POST" action="{{ route('admin.pengguna.update-role', $user) }}"
                                    class="d-inline-flex align-items-center gap-2">
                                    @csrf
                                    <select name="role" class="form-select form-select-sm bg-body text-body" {{ $user->is(auth()->user()) ? 'disabled' : '' }}>
                                        <option value="" class="text-body">Tanpa peran</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}" class="text-body" {{ $user->hasRole($role) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-primary" {{ $user->is(auth()->user()) ? 'disabled' : '' }}>
                                        Simpan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
