<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>{{ route('home') }}</loc><changefreq>daily</changefreq><priority>1.0</priority></url>
    <url><loc>{{ route('profile-desa.show') }}</loc><changefreq>monthly</changefreq><priority>0.9</priority></url>
    <url><loc>{{ route('peta-desa.show') }}</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>
    <url><loc>{{ route('aparatur.index') }}</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ route('berita.index') }}</loc><changefreq>daily</changefreq><priority>0.8</priority></url>
    <url><loc>{{ route('pengumuman.index') }}</loc><changefreq>daily</changefreq><priority>0.8</priority></url>
    <url><loc>{{ route('umkm.index') }}</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>
    <url><loc>{{ route('fasilitas.index') }}</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>
    <url><loc>{{ route('galeri.index') }}</loc><changefreq>monthly</changefreq><priority>0.5</priority></url>
    <url><loc>{{ route('kontak.show') }}</loc><changefreq>yearly</changefreq><priority>0.5</priority></url>
    <url><loc>{{ route('potensi.index') }}</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>
    <url><loc>{{ route('wisata.index') }}</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>

    @foreach ($news as $item)
        <url>
            <loc>{{ route('berita.show', $item->slug) }}</loc>
            <lastmod>{{ $item->updated_at?->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    @foreach ($announcements as $item)
        <url>
            <loc>{{ route('pengumuman.show', $item->slug) }}</loc>
            <lastmod>{{ $item->updated_at?->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    @foreach ($umkms as $item)
        <url>
            <loc>{{ route('umkm.show', $item->id) }}</loc>
            <lastmod>{{ $item->updated_at?->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    @foreach ($wisatas as $item)
        <url>
            <loc>{{ route('wisata.show', $item->id) }}</loc>
            <lastmod>{{ $item->updated_at?->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach

    @foreach ($potentials as $item)
        <url>
            <loc>{{ route('potensi.show', $item->id) }}</loc>
            <lastmod>{{ $item->updated_at?->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
