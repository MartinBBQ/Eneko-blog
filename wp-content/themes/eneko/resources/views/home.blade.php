{{--
  Template Name: Home
--}}

@php
    $taxonomy = 'category';
    $district = get_term_by('slug', DISTRICT_CATEGORY_SLUG, $taxonomy);
    $work = get_term_by('slug', DIPLOMATIC_WORK_CATEGORY_SLUG, $taxonomy);
    $press = get_term_by('slug', PRESS_CATEGORY_SLUG, $taxonomy);
    $events = get_term_by('slug', EVENTS_CATEGORY_SLUG, $taxonomy);
    $videos = get_term_by('slug', VIDEO_CATEGORY_SLUG, $taxonomy);
    $terms = [$district, $work, $press, $events, $videos];
@endphp
@extends('layouts.app')

@section('content')
    @include('partials.home.main', ['terms' => $terms])
@endsection
