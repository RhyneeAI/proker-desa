@props(['officials'])

@php
    $byParent = [];
    foreach ($officials as $official) {
        $key = $official->parent_id === null ? 'root' : (string) $official->parent_id;
        $byParent[$key][] = $official;
    }

    $build = function ($items) use (&$build, $byParent) {
        $nodes = collect($items)->sortBy([
            ['display_order', 'asc'],
            ['id', 'asc'],
        ]);

        $html = '<ul>';
        foreach ($nodes as $node) {
            $html .= '<li>';
            $html .= view('components.official-card', ['official' => $node])->render();
            if (! empty($byParent[(string) $node->id] ?? [])) {
                $html .= $build($byParent[(string) $node->id]);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';

        return $html;
    };

    $roots = $byParent['root'] ?? [];
@endphp

@if ($officials->isEmpty())
    <p class="text-slate-500 text-center">Data aparatur belum tersedia.</p>
@else
    <div class="overflow-x-auto pb-2">
        <div class="text-center">
            {!! $build($roots) !!}
        </div>
    </div>
@endif
