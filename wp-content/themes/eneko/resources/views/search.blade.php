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
            $options = [
                'useLocalLoop'=> true,
                'title'=> 'Recherche pour : "'.get_search_query().'"'
            ]
        @endphp
        @include('partials.home.main',$options)
    @endif
  {!! get_the_posts_navigation() !!}
@endsection
