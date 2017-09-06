@php
    $terms = get_terms( array(
        'taxonomy' => 'category'
    ));
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
    <div class="filters__group">
        @include('partials.dropdown', [
        'label' => 'Type de publication',
        'options' => $options
        ])
    </div>
    <div class="filters__group">
        @include('icons.search')
    </div>
</div>