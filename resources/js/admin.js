import $ from 'jquery';
import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Chart from 'chart.js/auto';
import DataTable, { util } from 'datatables.net-bs5';
import '@tabler/core/dist/js/tabler.min.js';

window.jQuery = window.$ = $;
window.Alpine = Alpine;
window.Chart = Chart;

util.external($);

// Count-up: angka 0 -> target saat terlihat
Alpine.data('countUp', (target, { duration = 1200, decimals = 0 } = {}) => ({
    value: 0,
    started: false,
    init() {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !this.started) {
                this.started = true;
                this.animate();
                observer.disconnect();
            }
        }, { threshold: 0.3 });
        observer.observe(this.$el);
    },
    animate() {
        const start = performance.now();
        const step = (now) => {
            const p = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            this.value = target * eased;
            if (p < 1) requestAnimationFrame(step);
            else this.value = target;
        };
        requestAnimationFrame(step);
    },
    get formatted() {
        return this.value.toLocaleString('id-ID', {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals,
        });
    },
}));

// Drag & drop file upload (x-file-upload component)
window.fileUpload = (existing = [], multiple = false) => ({
    dragover: false,
    previews: (existing || []).slice(),
    error: '',
    resetInput() {
        this.$refs.input.value = '';
    },
    handleInput() {
        this.setFiles(this.$refs.input.files);
    },
    handleDrop(e) {
        this.setFiles(e.dataTransfer.files);
    },
    setFiles(files) {
        this.error = '';
        const list = Array.from(files).filter((f) => f.type.startsWith('image/'));
        if (!list.length) {
            this.error = 'File harus berupa gambar.';
            return;
        }
        if (!multiple && list.length > 1) {
            this.error = 'Hanya boleh memilih satu file.';
            return;
        }
        const dt = new DataTransfer();
        Array.from(this.$refs.input.files || []).forEach((f) => dt.items.add(f));
        list.forEach((f) => dt.items.add(f));
        this.$refs.input.files = dt.files;
        this.renderPreviews();
    },
    renderPreviews() {
        this.previews = (existing || []).slice();
        Array.from(this.$refs.input.files || []).forEach((f) => {
            this.previews.push(URL.createObjectURL(f));
        });
    },
    remove(i) {
        const newFiles = Array.from(this.$refs.input.files || []);
        const newLen = newFiles.length;
        const offset = this.previews.length - newLen;
        const realIndex = i - offset;
        if (realIndex >= 0) {
            newFiles.splice(realIndex, 1);
            const dt = new DataTransfer();
            newFiles.forEach((f) => dt.items.add(f));
            this.$refs.input.files = dt.files;
        }
        this.previews.splice(i, 1);
    },
});

Alpine.start();

AOS.init({
    duration: 450,
    easing: 'ease-out-cubic',
    once: true,
    offset: 40,
    disable: () => window.matchMedia('(prefers-reduced-motion: reduce)').matches,
});

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
