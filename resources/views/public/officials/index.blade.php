<x-layouts.public title="Aparatur Desa">
    <x-public-page-header title="Aparatur Desa"
        eyebrow="Struktur Organisasi"
        description="Perangkat desa yang melayani dan mengabdi untuk masyarakat Desa Cibulakan."
        :crumbs="[['label' => 'Aparatur']]" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        @if ($officials->isEmpty())
            <p class="text-slate-500 text-center">Data aparatur belum tersedia.</p>
        @else
            <x-officials-tree :officials="$officials" />
        @endif
    </div>
</x-layouts.public>
