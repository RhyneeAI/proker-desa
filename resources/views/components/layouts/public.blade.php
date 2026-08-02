<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website resmi Desa Cibulakan — media informasi layanan publik, berita, pengumuman, dan profil desa.">
    <title>{{ $title ?? 'Desa Cibulakan' }} — Website Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-600 antialiased font-sans">

    {{-- Navbar --}}
    <x-public-navbar :profile="$profile ?? null" />

    {{-- Konten --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-public-footer />
</body>
</html>
