{{--
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
    @if (!have_posts())
        <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'sage') }}
        </div>
        {!! get_search_form(false) !!}
    @endif
    <section class="section">
        <h1 class="section__title">Flux d'actualités</h1>
        @include('partials.filters')
        <div class="section__list">
            @php($loop = App\getCustomQuery(['post_type'=> 'post', 'posts_per_page' => 4]))
                @while ($loop->have_posts()) @php($loop->the_post())
                    @include('partials.content')
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
@endsection
