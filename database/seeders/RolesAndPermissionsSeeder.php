<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    private const PERMISSIONS = [
        'manage profil desa',
        'manage kontak',
        'manage aparatur',
        'manage berita',
        'manage pengumuman',
        'manage umkm',
        'manage fasilitas',
        'manage galeri',
        'manage potensi',
        'manage potensi-desa',
        'manage titik air',
        'manage wisata',
        'manage pengguna',
    ];

    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (self::PERMISSIONS as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Hanya satu peran: admin (guest tidak login sama sekali).
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(self::PERMISSIONS);

        Role::where('name', 'super-admin')->delete();

        User::where('email', 'admin@desa.test')->first()?->assignRole('admin');
    }
}
