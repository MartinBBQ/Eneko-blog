@php
    $useLocalLoop = $useLocalLoop ?? false;
    $i = 0;
    $hasFoundFirstContent = false;
    $terms = !empty($terms) ? $terms : [];
    $displayed = false;
    $tplSlug = get_page_template_slug();
    $pressView = 'views/press.blade.php';
    $loop = !empty($loop) ? $loop : App\getCustomQuery(['post_type'=> 'post', 'posts_per_page' => 10]);
@endphp
<section class="section">
    <h1 class="section__title">
        {{ !empty($title) ? $title : "Flux d'actualités" }}
    </h1>
    @if (!have_posts())
        <div class="alert alert-warning">
            Aucun résultat trouvé.
        </div>
        @include('partials.home.search')
    @else
        @include('partials.filters', $terms)
    @endif
    <div class="section__list">
        @while (!$useLocalLoop ? $loop->have_posts() : have_posts()) @php(!$useLocalLoop ? $loop->the_post() : the_post())
           @php
               $predicates = \App\isUrlOrVideo();
               $isUrlOrVideo = $predicates['url'] || $predicates['video'];
           @endphp
            @if(!$useLocalLoop)
                @if($i == 1 && !$displayed)
                    @include('partials.newsletter.subscribe')
                    @php($displayed = true)
                @endif
                @if(!is_front_page() && (\App\postHasFilter($terms) || $isUrlOrVideo) && $tplSlug !== $pressView)
                    @include('partials.content', ['isFirst' => $i == 0])
                @elseif(is_front_page())
                    @include('partials.content', ['isFirst' => $i == 0])
                @elseif($tplSlug === $pressView && (\App\isPressPost() || $isUrlOrVideo))
                    @include('partials.content', ['isFirst' => $i == 0])
                @else
                @endif
                @php($i++)
            @else
                @include('partials.content', ['isFirst' => $i == 0])
                @if($i == 1 && !$displayed)
                    @include('partials.newsletter.subscribe')
                    @php($displayed = true)
                @endif
                @php($i--)
            @endif
        @endwhile
    </div>
    <div class="section__nav">
        @if($loop->max_num_pages > 1)
            {!!
            paginate_links([
                'base' => get_pagenum_link(1) . '%_%',
                'format' => 'page/%#%',
                'current' => get_query_var('page',1),
                'total' => $loop->max_num_pages,
                'prev_text'    => __('←'),
                'next_text'    => __('→'),])
            !!}
        @endif
    </div>
</section>
{{wp_reset_query()}}
@include('partials.sidebar')