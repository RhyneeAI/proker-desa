<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.public.header', ['title' => $title ?? 'Desa Cibulakan'])
</head>
<body class="bg-white text-slate-600 antialiased font-sans overflow-x-hidden">

    {{-- Navbar --}}
    @include('layouts.public.navbar', ['profile' => $profile ?? null])

    {{-- Konten --}}
    @include('layouts.public.main', ['content' => $slot])

    {{-- Footer --}}
    @include('layouts.public.footer')
</body>
</html>
