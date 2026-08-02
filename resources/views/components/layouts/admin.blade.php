<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    @include('layouts.admin.header', ['title' => $title ?? 'Dashboard'])
</head>
<body class="layout layout-fluid">

    {{-- Sidebar --}}
    @include('layouts.admin.sidebar')

    {{-- Area Konten --}}
    <div class="page-wrapper">
        @include('layouts.admin.navbar', ['title' => $title ?? 'Dashboard'])
        @include('layouts.admin.main', ['content' => $slot])
        @include('layouts.admin.footer')
    </div>

    @stack('scripts')
</body>
</html>
