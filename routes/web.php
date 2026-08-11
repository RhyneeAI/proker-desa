<?php

use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\HeroSlideController as AdminHeroSlideController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OfficialController as AdminOfficialController;
use App\Http\Controllers\Admin\PotensiDesaController as AdminPotensiDesaController;
use App\Http\Controllers\Admin\PotentialController as AdminPotentialController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
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
use App\Http\Controllers\WaterPointController;
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

Route::get('/titik-air/{waterPoint:slug}', [WaterPointController::class, 'show'])->name('titik-air.show');

Route::get('/admin/login', fn () => redirect()->route('login'))->name('admin.login');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nDisallow: /admin\nDisallow: /login\n\nSitemap: ".route('sitemap');

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

        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile');
        Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');

        Route::get('/profil-desa/edit', [AdminVillageProfileController::class, 'edit'])->middleware('can:manage profil desa')->name('profil-desa.edit');
        Route::put('/profil-desa', [AdminVillageProfileController::class, 'update'])->middleware('can:manage profil desa')->name('profil-desa.update');

        Route::get('/kontak/edit', [AdminContactController::class, 'edit'])->middleware('can:manage kontak')->name('kontak.edit');
        Route::put('/kontak', [AdminContactController::class, 'update'])->middleware('can:manage kontak')->name('kontak.update');

        Route::middleware('can:manage aparatur')->resource('aparatur', AdminOfficialController::class)->except('show');

        Route::middleware('can:manage berita')->resource('berita', AdminNewsController::class)->except('show')->parameters(['berita' => 'berita']);
        Route::middleware('can:manage berita')->post('berita/{berita}/toggle', [AdminNewsController::class, 'togglePublish'])->name('berita.toggle');

        Route::middleware('can:manage pengumuman')->resource('pengumuman', AdminAnnouncementController::class)->except('show');
        Route::middleware('can:manage pengumuman')->post('pengumuman/{pengumuman}/toggle', [AdminAnnouncementController::class, 'togglePublish'])->name('pengumuman.toggle');

        Route::middleware('can:manage umkm')->resource('umkm', AdminUmkmController::class)->except('show');
        Route::middleware('can:manage fasilitas')->resource('fasilitas', AdminFacilityController::class)->except('show');
        Route::middleware('can:manage galeri')->resource('galeri', AdminGalleryController::class)->except('show');
        Route::middleware('can:manage hero')->resource('hero', AdminHeroSlideController::class)->except('show')->parameters(['hero' => 'heroSlide']);
        Route::middleware('can:manage potensi')->resource('potensi', AdminPotentialController::class)->except('show')->parameters(['potensi' => 'potential']);
        Route::middleware('can:manage potensi-desa')->resource('potensi-desa', AdminPotensiDesaController::class)->except('show')->parameters(['potensi-desa' => 'potensiDesa']);
        Route::middleware('can:manage titik air')->resource('titik-air', AdminWaterPointController::class)->except('show')->parameters(['titik-air' => 'waterPoint']);
        Route::middleware('can:manage wisata')->resource('wisata', AdminWisataController::class)->except('show')->parameters(['wisata' => 'wisata']);

        Route::prefix('pengguna')->name('pengguna.')->middleware('can:manage pengguna')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::post('/{user}/role', [AdminUserController::class, 'updateRole'])->name('update-role');
        });
    });
});

require __DIR__.'/auth.php';
