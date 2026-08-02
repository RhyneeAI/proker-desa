<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title }} — Admin Desa Cibulakan</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo/logo sugih mukti.png') }}">
<script>
    (function () {
        var saved = localStorage.getItem('theme');
        var dark = saved ? saved === 'dark'
            : window.matchMedia('(prefers-color-scheme: dark)').matches;
        document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
    })();
</script>
@vite(['resources/css/admin.css', 'resources/js/admin.js'])
