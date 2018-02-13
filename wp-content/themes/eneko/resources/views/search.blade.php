@extends('layouts.app')
@section('content')
    @if(get_query_var('post_type')!=='post')
        @if (!have_posts())
            <div class="alert alert-warning">
                {{  __('Sorry, no results were found.', 'sage') }}
            </div>
            {!! get_search_form(false) !!}
        @endif
        @while(have_posts()) @php(the_post())
        @include('partials.content-search')
        @endwhile
    @else
        @php
            $queryParams = [
                'post_type'=> 'post',
                'posts_per_page' => 10,
            ];
            if(!empty($_GET['s'])) {
                $queryParams['s'] = $_GET['s'];
            }
            $options = [
                'useLocalLoop'=> true,
                'title'=> 'Recherche pour : "'.get_search_query().'"',
                'loop' => App\getCustomQuery($queryParams),
            ];
        @endphp
        @include('partials.home.main',$options)
    @endif
  {!! get_the_posts_navigation() !!}
@endsection
