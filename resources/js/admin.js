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

$(function () {
    $('.toast').each(function () {
        const $t = $(this);
        setTimeout(() => $t.addClass('show'), 50);
        setTimeout(() => {
            $t.removeClass('show');
            setTimeout(() => $t.remove(), 300);
        }, 3500);
    });
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
