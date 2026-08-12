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

{{-- Data flash untuk Notyf --}}
@if (session('success') || session('error'))
    <div id="admin-flash" class="d-none"
        @if (session('success')) data-success="{{ session('success') }}" @endif
        @if (session('error')) data-error="{{ session('error') }}" @endif>
    </div>
@endif

<p class="text-center text-secondary opacity-50 small my-2">KKN Desa Cibulakan — Dikembangkan oleh Luhung Lugina, M. Hasby Ashidiqqie, Vinna Laila Luqiana</p>
