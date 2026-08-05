<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class DefaultVillageImages
{
    /**
     * Salin gambar default bertema desa dari public/images/seed
     * ke storage publik dan kembalikan path-nya (sesuai Storage::url).
     */
    public static function put(string $subDir, string $sourceName, string $ext = 'jpg'): string
    {
        $path = "{$subDir}/{$sourceName}.{$ext}";

        if (! Storage::disk('public')->exists($path)) {
            $source = base_path("public/images/seed/{$sourceName}.{$ext}");

            if (is_file($source)) {
                Storage::disk('public')->put($path, file_get_contents($source));
            }
        }

        return $path;
    }
}
