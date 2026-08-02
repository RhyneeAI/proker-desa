<div class="page-body container-fluid py-3">
    {{ $content }}
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
