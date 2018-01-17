{{--
  Template Name: Agenda
--}}

@extends('layouts.app')
@section('content')
    @if (!have_posts())
        <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'sage') }}
        </div>
        {!! get_search_form(false) !!}
    @endif
    <section data-current-month="{{date('n')}}" class="datebook">
        <div class="datebook__head">
            <h2 class="datebook__month">
                <span>{{\App\date_fr('F',time())}}</span>
                {{date('Y')}}
            </h2>
            <div class="datebook__arrows">
                <div class="datebook__arrow is-left">
                    <i class="material-icons">chevron_left</i>
                </div>
                <div class="datebook__arrow is-right">
                    <i class="material-icons">chevron_right</i>
                </div>
            </div>
        </div>
        <div class="datebook__list">
            @php
                $list = get_posts(['post_type'=> 'agenda', 'posts_per_page' => -1]);
                usort($list, function ($a, $b) {
                    $cfs = CFS();
                    $timeA = $cfs->get('date', $a->ID);
                    $timeB = $cfs->get('date', $b->ID);
                    return $timeA > $timeB;
                })
            @endphp
                @foreach($list as $item)
                    @php(setup_postdata($item))
                    @include('partials.content-agenda', ['post' => $item])
                @endforeach
                    {{wp_reset_query()}}
        </div>
    </section>
@endsection
