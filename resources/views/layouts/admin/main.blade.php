<div class="page-body container-fluid py-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            @if (! request()->routeIs('admin.dashboard'))
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @endif
        </ol>
    </nav>

    {{ $content }}
</div>

{{-- Lightbox --}}
<div id="admin-lightbox"
    class="d-none position-fixed top-0 start-0 end-0 bottom-0 align-items-center justify-content-center bg-black bg-opacity-75"
    style="z-index:2000" role="dialog" aria-modal="true" aria-label="Pratinjau gambar">
    <button type="button" id="admin-lightbox-close"
        class="position-absolute top-0 end-0 m-3 text-white bg-transparent border-0" aria-label="Tutup">
        <i class="ti ti-x" style="font-size:2rem"></i>
    </button>
    <img id="admin-lightbox-img" src="" alt=""
        class="img-fluid rounded shadow-lg" style="max-height:85vh;max-width:90vw;object-fit:contain">
</div>

{{-- Toast Notifikasi --}}
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:1090">
    @if (session('success'))
        <div class="toast align-items-center text-bg-success border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"><i class="ti ti-circle-check me-1"></i> {{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.closest('.toast').remove()" aria-label="Tutup"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast align-items-center text-bg-danger border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"><i class="ti ti-alert-triangle me-1"></i> {{ session('error') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.closest('.toast').remove()" aria-label="Tutup"></button>
            </div>
        </div>
    @endif
</div>

<p class="text-center text-secondary opacity-50 small my-2">KKN Desa Cibulakan — Dikembangkan oleh Luhung Lugina, M. Hasby Ashidiqqie, Vinna Laila Luqiana</p>
