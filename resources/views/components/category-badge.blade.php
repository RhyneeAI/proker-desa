@props(['category' => null])

@php
    $color = match (strtolower(trim((string) $category))) {
        'kuliner', 'makanan', 'minuman', 'makanan & minuman' => 'bg-orange-lt text-orange',
        'kerajinan', 'seni', 'budaya' => 'bg-purple-lt text-purple',
        'jasa', 'layanan' => 'bg-cyan-lt text-cyan',
        'pertanian', 'perkebunan', 'agro' => 'bg-green-lt text-green',
        'peternakan' => 'bg-lime-lt text-lime',
        'perikanan' => 'bg-blue-lt text-blue',
        'alam', 'wisata alam' => 'bg-green-lt text-green',
        'religi', 'wisata religi' => 'bg-teal-lt text-teal',
        'edukasi', 'wisata edukasi' => 'bg-indigo-lt text-indigo',
        'ekonomi' => 'bg-yellow-lt text-yellow',
        'sumur', 'pam', 'pompa', 'pompa air', 'hidran', 'hidran umum', 'embung', 'mata air' => 'bg-blue-lt text-blue',
        'lainnya' => 'bg-secondary-lt text-secondary',
        default => 'bg-secondary-lt text-secondary',
    };
@endphp

@if ($category)
    <span class="badge text-capitalize {{ $color }}">{{ $category }}</span>
@endif
