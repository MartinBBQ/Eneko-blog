@php
    $useLocalLoop = $useLocalLoop ?? false;
    $i = 0;
@endphp
<section class="section">
    <h1 class="section__title">
        {{ !empty($title) ? $title : "Flux d'actualités" }}
    </h1>
    @if (!have_posts())
        <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'sage') }}
        </div>
        @include('partials.home.search')
    @else
        @include('partials.filters')
    @endif
    <div class="section__list">
        @php($loop = App\getCustomQuery(['post_type'=> 'post', 'posts_per_page' => 10]))
            @while (!$useLocalLoop ? $loop->have_posts() : have_posts()) @php(!$useLocalLoop ? $loop->the_post() : the_post())
                @if($i == 1)
                    @include('partials.newsletter.subscribe')
                @endif
                @include('partials.content', ['isFirst' => $i == 0])
                @php($i++)
            @endwhile
                {{wp_reset_query()}}
    </div>
    <div class="section__nav">
        @if($loop->max_num_pages > 1)
            {!!
            paginate_links([
                'base' => get_pagenum_link(1) . '%_%',
                'format' => '/page/%#%',
                'current' => get_query_var('page',1),
                'total' => $loop->max_num_pages,
                'prev_text'    => __('←'),
                'next_text'    => __('→'),])
            !!}
        @endif
    </div>
</section>
@include('partials.sidebar')