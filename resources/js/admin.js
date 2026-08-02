import $ from 'jquery';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import DataTable, { util } from 'datatables.net-bs5';
import '@tabler/core/dist/js/tabler.min.js';

window.jQuery = window.$ = $;
window.Alpine = Alpine;
window.Chart = Chart;

util.external($);

Alpine.start();

// Lightbox: zoom gambar di halaman admin
(function () {
    const lightbox = document.getElementById('admin-lightbox');
    const lightboxImg = document.getElementById('admin-lightbox-img');
    const closeBtn = document.getElementById('admin-lightbox-close');
    if (!lightbox || !lightboxImg || !closeBtn) return;

    const open = (src, alt) => {
        lightboxImg.src = src;
        lightboxImg.alt = alt || '';
        lightbox.classList.remove('d-none');
        lightbox.classList.add('d-flex');
    };
    const close = () => {
        lightbox.classList.add('d-none');
        lightbox.classList.remove('d-flex');
        lightboxImg.src = '';
    };

    document.addEventListener('click', (e) => {
        const t = e.target.closest('[data-lightbox]');
        if (!t) return;
        e.preventDefault();
        open(t.dataset.lightbox, t.getAttribute('alt') || '');
    });

    closeBtn.addEventListener('click', close);
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) close();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') close();
    });
})();

$(function () {
    $('.toast').each(function () {
        const $t = $(this);
        setTimeout(() => $t.addClass('show'), 50);
        setTimeout(() => {
            $t.removeClass('show');
            setTimeout(() => $t.remove(), 300);
        }, 3500);
    });

    $('.datatable').DataTable({
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Semua']],
        order: [],
        language: {
            lengthMenu: 'Tampilkan _MENU_ data per halaman',
            zeroRecords: 'Tidak ada data yang cocok',
            info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data',
            infoFiltered: '(difilter dari _MAX_ total data)',
            search: 'Cari:',
            searchPlaceholder: 'Ketik kata kunci…',
            paginate: { first: '‹‹', previous: '‹', next: '›', last: '››' },
            emptyTable: 'Belum ada data.',
        },
    });
});
