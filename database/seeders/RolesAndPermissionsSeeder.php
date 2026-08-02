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

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->syncPermissions(self::PERMISSIONS);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(array_values(array_diff(self::PERMISSIONS, ['manage pengguna'])));

        $user = User::where('email', 'admin@desa.test')->first();
        $user?->assignRole('super-admin');
    }
}
