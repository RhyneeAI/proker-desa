<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="description" content="{{ $metaDescription ?? 'Website resmi ' . ($profile->village_name ?? 'Desa Cibulakan') . ' — media informasi layanan publik, berita, pengumuman, dan profil desa.' }}">
<meta name="robots" content="index, follow">
<title>{{ $title }} — {{ $profile->village_name ?? 'Desa Cibulakan' }}</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo/logo sugih mukti.png') }}">
<link rel="canonical" href="{{ url()->current() }}">

{{-- Open Graph --}}
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $profile->village_name ?? 'Desa Cibulakan' }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $metaDescription ?? 'Website resmi ' . ($profile->village_name ?? 'Desa Cibulakan') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('images/logo/logo sugih mukti.png') }}">

<script>
    (function () {
        var saved = localStorage.getItem('theme');
        var dark = saved ? saved === 'dark'
            : window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (dark) document.documentElement.setAttribute('data-theme', 'dark');
    })();
</script>
@vite(['resources/css/app.css', 'resources/js/app.js'])
