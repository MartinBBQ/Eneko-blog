@php
    $terms = !empty($terms)
    ? $terms
    : [];
    $options = [];
    foreach($terms as $term) {
        $option = [
            'label' => $term->name,
            'slug' => $term->slug
        ];
        array_push($options,$option);
    }
@endphp
<div class="filters">
    @if(count($terms) > 0)
    <div class="filters__group">
        @include('partials.dropdown', [
        'label' => 'Type de publication',
        'options' => $options
        ])
    </div>
    @endif
    <div class="filters__group filters__group--search">
        @include('partials.home.search')
    </div>
</div>
