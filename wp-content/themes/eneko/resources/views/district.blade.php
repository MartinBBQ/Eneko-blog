{{--
  Template Name: En circonscription
--}}
@php
    $terms = \App\getPageTerms(DISTRICT_CATEGORY_SLUG);
    $loop = App\getCustomQuery([
    'post_type'=> 'post',
    'posts_per_page' => 10,
    'category_name' => DISTRICT_CATEGORY_SLUG
    ])
@endphp
@extends('layouts.app')

@section('content')
    @include('partials.home.main', [
    'terms' => $terms,
    'title' => "En circonscription",
    'useLocalLoop' => false,
    'loop' => $loop
    ])
@endsection
