{{--
  Template Name: À l'assemblée nationale
--}}
@php
    $terms = \App\getPageTerms(DIPLOMATIC_WORK_CATEGORY_SLUG);
    $loop = App\getCustomQuery([
    'post_type'=> 'post',
    'posts_per_page' => 10,
    'category_name' => DIPLOMATIC_WORK_CATEGORY_SLUG
    ]);
@endphp
@extends('layouts.app')

@section('content')
    @include('partials.home.main', [
    'terms' => $terms,
    'title' => "À l'assemblée",
    'useLocalLoop' => false
    ])
@endsection
