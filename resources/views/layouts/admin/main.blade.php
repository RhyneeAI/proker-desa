<div class="page-body container-fluid py-3">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
            <i class="ti ti-circle-check me-2"></i>
            <div>{{ session('success') }}</div>
            <a class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Tutup"></a>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
            <i class="ti ti-alert-triangle me-2"></i>
            <div>{{ session('error') }}</div>
            <a class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Tutup"></a>
        </div>
    @endif

    {{ $content }}
</div>
