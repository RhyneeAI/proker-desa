<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Website resmi Desa Cibulakan — media informasi layanan publik, berita, pengumuman, dan profil desa.">
<title>{{ $title }} — Website Desa</title>
<script>
    (function () {
        var saved = localStorage.getItem('theme');
        var dark = saved ? saved === 'dark'
            : window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (dark) document.documentElement.setAttribute('data-theme', 'dark');
    })();
</script>
@vite(['resources/css/app.css', 'resources/js/app.js'])
