<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Official;
use App\Models\PotensiDesa;
use App\Models\WaterPoint;
use App\Models\Wisata;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Route::model('aparatur', Official::class);
        Route::model('berita', News::class);
        Route::model('pengumuman', Announcement::class);
        Route::model('fasilitas', Facility::class);
        Route::model('galeri', Gallery::class);
        Route::model('potensiDesa', PotensiDesa::class);
        Route::model('titikAir', WaterPoint::class);
        Route::model('wisata', Wisata::class);
    }
}
