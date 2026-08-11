<x-layouts.admin title="Profil Saya">
    <div class="row g-3 mb-3">
        <div class="col-12 col-xl-7 mx-auto">
            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Profil Saya</h3>
                    </div>
                    <div class="card-body">
                        <x-form-input label="Nama" name="name" :value="old('name', $user->name)" required />
                        <x-form-input
                            label="Email"
                            name="email"
                            type="email"
                            :value="old('email', $user->email)"
                            required
                            hint="Jika email diubah, Anda perlu verifikasi ulang."
                        />
                    </div>
                    <div class="card-footer d-flex">
                        <button type="submit" class="btn btn-primary">Simpan Profil</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-xl-7 mx-auto">
            <form method="POST" action="{{ route('admin.profile.password') }}">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ganti Kata Sandi</h3>
                    </div>
                    <div class="card-body">
                        <x-form-input label="Kata Sandi Saat Ini" name="current_password" type="password" required />
                        <x-form-input label="Kata Sandi Baru" name="password" type="password" required hint="Minimal 8 karakter." />
                        <x-form-input label="Ulangi Kata Sandi Baru" name="password_confirmation" type="password" required />
                    </div>
                    <div class="card-footer d-flex">
                        <button type="submit" class="btn btn-primary">Perbarui Kata Sandi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
