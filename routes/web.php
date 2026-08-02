<?php

use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OfficialController as AdminOfficialController;
use App\Http\Controllers\Admin\PotensiDesaController as AdminPotensiDesaController;
use App\Http\Controllers\Admin\PotentialController as AdminPotentialController;
use App\Http\Controllers\Admin\UmkmController as AdminUmkmController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VillageProfileController as AdminVillageProfileController;
use App\Http\Controllers\Admin\WaterPointController as AdminWaterPointController;
use App\Http\Controllers\Admin\WisataController as AdminWisataController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\PotentialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\VillageProfileController;
use App\Http\Controllers\WisataController;
use Illuminate\Support\Facades\Route;

// ========================
// HALAMAN PUBLIK
// ========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil-desa', [VillageProfileController::class, 'show'])->name('profile-desa.show');
Route::get('/peta-desa', [VillageProfileController::class, 'map'])->name('peta-desa.show');
Route::get('/aparatur', [OfficialController::class, 'index'])->name('aparatur.index');
Route::get('/berita', [NewsController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show');
Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{slug}', [AnnouncementController::class, 'show'])->name('pengumuman.show');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{umkm}', [UmkmController::class, 'show'])->name('umkm.show');
Route::get('/fasilitas', [FacilityController::class, 'index'])->name('fasilitas.index');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/kontak', [ContactController::class, 'show'])->name('kontak.show');
Route::get('/potensi-desa', [PotentialController::class, 'index'])->name('potensi.index');
Route::get('/potensi-desa/{potential}', [PotentialController::class, 'show'])->name('potensi.show');
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/{wisata}', [WisataController::class, 'show'])->name('wisata.show');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nDisallow: /admin\nDisallow: /login\n\nSitemap: " . route('sitemap');

    return response($content)->header('Content-Type', 'text/plain');
})->name('robots');

// ========================
// AREA ADMIN
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profil-desa/edit', [AdminVillageProfileController::class, 'edit'])->middleware('can:manage profil desa')->name('profil-desa.edit');
        Route::put('/profil-desa', [AdminVillageProfileController::class, 'update'])->middleware('can:manage profil desa')->name('profil-desa.update');

        Route::get('/kontak/edit', [AdminContactController::class, 'edit'])->middleware('can:manage kontak')->name('kontak.edit');
        Route::put('/kontak', [AdminContactController::class, 'update'])->middleware('can:manage kontak')->name('kontak.update');

        Route::prefix('aparatur')->name('aparatur.')->middleware('can:manage aparatur')->group(function () {
            Route::get('/', [AdminOfficialController::class, 'index'])->name('index');
            Route::get('/tambah', [AdminOfficialController::class, 'create'])->name('create');
            Route::post('/', [AdminOfficialController::class, 'store'])->name('store');
            Route::get('/{aparatur}/edit', [AdminOfficialController::class, 'edit'])->name('edit');
            Route::put('/{aparatur}', [AdminOfficialController::class, 'update'])->name('update');
            Route::delete('/{aparatur}', [AdminOfficialController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('berita')->name('berita.')->middleware('can:manage berita')->group(function () {
            Route::get('/', [AdminNewsController::class, 'index'])->name('index');
            Route::get('/tambah', [AdminNewsController::class, 'create'])->name('create');
            Route::post('/', [AdminNewsController::class, 'store'])->name('store');
            Route::get('/{berita}/edit', [AdminNewsController::class, 'edit'])->name('edit');
            Route::put('/{berita}', [AdminNewsController::class, 'update'])->name('update');
            Route::delete('/{berita}', [AdminNewsController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('pengumuman')->name('pengumuman.')->middleware('can:manage pengumuman')->group(function () {
            Route::get('/', [AdminAnnouncementController::class, 'index'])->name('index');
            Route::get('/tambah', [AdminAnnouncementController::class, 'create'])->name('create');
            Route::post('/', [AdminAnnouncementController::class, 'store'])->name('store');
            Route::get('/{pengumuman}/edit', [AdminAnnouncementController::class, 'edit'])->name('edit');
            Route::put('/{pengumuman}', [AdminAnnouncementController::class, 'update'])->name('update');
            Route::delete('/{pengumuman}', [AdminAnnouncementController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('umkm')->name('umkm.')->middleware('can:manage umkm')->group(function () {
            Route::get('/', [AdminUmkmController::class, 'index'])->name('index');
            Route::get('/tambah', [AdminUmkmController::class, 'create'])->name('create');
            Route::post('/', [AdminUmkmController::class, 'store'])->name('store');
            Route::get('/{umkm}/edit', [AdminUmkmController::class, 'edit'])->name('edit');
            Route::put('/{umkm}', [AdminUmkmController::class, 'update'])->name('update');
            Route::delete('/{umkm}', [AdminUmkmController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('fasilitas')->name('fasilitas.')->middleware('can:manage fasilitas')->group(function () {
            Route::get('/', [AdminFacilityController::class, 'index'])->name('index');
            Route::get('/tambah', [AdminFacilityController::class, 'create'])->name('create');
            Route::post('/', [AdminFacilityController::class, 'store'])->name('store');
            Route::get('/{fasilita}/edit', [AdminFacilityController::class, 'edit'])->name('edit');
            Route::put('/{fasilita}', [AdminFacilityController::class, 'update'])->name('update');
            Route::delete('/{fasilita}', [AdminFacilityController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('galeri')->name('galeri.')->middleware('can:manage galeri')->group(function () {
            Route::get('/', [AdminGalleryController::class, 'index'])->name('index');
            Route::get('/tambah', [AdminGalleryController::class, 'create'])->name('create');
            Route::post('/', [AdminGalleryController::class, 'store'])->name('store');
            Route::get('/{galeri}/edit', [AdminGalleryController::class, 'edit'])->name('edit');
            Route::put('/{galeri}', [AdminGalleryController::class, 'update'])->name('update');
            Route::delete('/{galeri}', [AdminGalleryController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('potensi-desa')->name('potensi-desa.')->middleware('can:manage potensi-desa')->group(function () {
            Route::get('/', [AdminPotensiDesaController::class, 'index'])->name('index');
            Route::get('/tambah', [AdminPotensiDesaController::class, 'create'])->name('create');
            Route::post('/', [AdminPotensiDesaController::class, 'store'])->name('store');
            Route::get('/{potensiDesa}/edit', [AdminPotensiDesaController::class, 'edit'])->name('edit');
            Route::put('/{potensiDesa}', [AdminPotensiDesaController::class, 'update'])->name('update');
            Route::delete('/{potensiDesa}', [AdminPotensiDesaController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('potensi')->name('potensi.')->middleware('can:manage potensi')->group(function () {
            Route::get('/', [AdminPotentialController::class, 'index'])->name('index');
            Route::get('/tambah', [AdminPotentialController::class, 'create'])->name('create');
            Route::post('/', [AdminPotentialController::class, 'store'])->name('store');
            Route::get('/{potential}/edit', [AdminPotentialController::class, 'edit'])->name('edit');
            Route::put('/{potential}', [AdminPotentialController::class, 'update'])->name('update');
            Route::delete('/{potential}', [AdminPotentialController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('titik-air')->name('titik-air.')->middleware('can:manage titik air')->group(function () {
            Route::get('/', [AdminWaterPointController::class, 'index'])->name('index');
            Route::get('/tambah', [AdminWaterPointController::class, 'create'])->name('create');
            Route::post('/', [AdminWaterPointController::class, 'store'])->name('store');
            Route::get('/{titikAir}/edit', [AdminWaterPointController::class, 'edit'])->name('edit');
            Route::put('/{titikAir}', [AdminWaterPointController::class, 'update'])->name('update');
            Route::delete('/{titikAir}', [AdminWaterPointController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('wisata')->name('wisata.')->middleware('can:manage wisata')->group(function () {
            Route::get('/', [AdminWisataController::class, 'index'])->name('index');
            Route::get('/tambah', [AdminWisataController::class, 'create'])->name('create');
            Route::post('/', [AdminWisataController::class, 'store'])->name('store');
            Route::get('/{wisata}/edit', [AdminWisataController::class, 'edit'])->name('edit');
            Route::put('/{wisata}', [AdminWisataController::class, 'update'])->name('update');
            Route::delete('/{wisata}', [AdminWisataController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('pengguna')->name('pengguna.')->middleware('can:manage pengguna')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::post('/{user}/role', [AdminUserController::class, 'updateRole'])->name('update-role');
        });
    });
});

require __DIR__.'/auth.php';
