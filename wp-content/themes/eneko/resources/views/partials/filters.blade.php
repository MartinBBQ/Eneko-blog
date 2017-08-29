<div class="filters">
    <div class="filters__group">
        @include('partials.dropdown', [
        'label' => 'Type de publication',
        'options' => [
            ['label' => 'Articles', 'slug' => 'articles'],
            ['label' => 'Vidéos', 'slug' => 'videos'],
            ['label' => 'Presse', 'slug' => 'presse']
        ]
        ])
    </div>
    <div class="filters__group">
        @include('icons.search')
    </div>
</div>