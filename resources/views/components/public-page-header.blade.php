@props([
    'title' => '',
    'eyebrow' => null,
    'description' => null,
    'crumbs' => [],
])

<section class="bg-[#192E03] pt-24 sm:pt-28 pb-10 sm:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">

        <div class="min-w-0">
            @if ($eyebrow)
                <p class="text-xs font-semibold uppercase tracking-widest text-[#3A5C0A]">{{ $eyebrow }}</p>
            @endif
            <h1 class="mt-1.5 text-3xl sm:text-4xl font-extrabold text-white">{{ $title }}</h1>
            @if ($description)
                <p class="mt-2 text-sm sm:text-base text-white/80 max-w-2xl">{{ $description }}</p>
            @endif
        </div>

        <nav aria-label="Breadcrumb" class="flex flex-wrap items-center gap-2 text-sm font-medium flex-shrink-0">
            <a href="{{ route('home') }}" class="text-white/70 hover:text-white transition">
                {{ __('common.beranda') }}
            </a>
            @foreach ($crumbs as $crumb)
                <span class="text-white/40">/</span>
                @if (! empty($crumb['url']) && ! $loop->last)
                    <a href="{{ $crumb['url'] }}" class="text-white/70 hover:text-white transition">
                        {{ $crumb['label'] }}
                    </a>
                @else
                    <span class="text-white font-semibold truncate max-w-[200px]">
                        {{ $crumb['label'] }}
                    </span>
                @endif
            @endforeach
        </nav>
    </div>
</section>
