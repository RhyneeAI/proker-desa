@props(['officials'])

@php
    $kades  = $officials->first(fn ($o) => str_contains($o->position, 'Kepala Desa'));
    $sekdes = $officials->first(fn ($o) => str_contains($o->position, 'Sekretaris'));
    $kasi   = $officials->filter(fn ($o) => str_contains($o->position, 'Kasi'))->sortBy('display_order');
    $kaur   = $officials->filter(fn ($o) => str_contains($o->position, 'Kaur'))->sortBy('display_order');
    $kadus  = $officials->filter(fn ($o) => str_contains($o->position, 'Kepala Dusun'))->sortBy('display_order');
@endphp

@if ($officials->isEmpty())
    <p class="text-slate-500 text-center">Data aparatur belum tersedia.</p>
@else
    <div class="overflow-x-auto pb-2">
        <div class="text-center">
            <ul class="org-tree">
                @if ($kades)
                    <li>
                        <x-official-card :official="$kades" />
                        @if ($sekdes || $kasi->isNotEmpty() || $kadus->isNotEmpty())
                            <ul>
                                @if ($sekdes)
                                    <li>
                                        <x-official-card :official="$sekdes" />
                                        @if ($kaur->isNotEmpty())
                                            <ul>
                                                @foreach ($kaur as $official)
                                                    <li>
                                                        <x-official-card :official="$official" />
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif

                                @foreach ($kasi as $official)
                                    <li>
                                        <x-official-card :official="$official" />
                                    </li>
                                @endforeach

                                @foreach ($kadus as $official)
                                    <li>
                                        <x-official-card :official="$official" />
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @else
                    @foreach ($officials as $official)
                        <li>
                            <x-official-card :official="$official" />
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@endif
