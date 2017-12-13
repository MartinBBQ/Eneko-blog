{{--
  Template Name: À l'assemblée nationale
--}}
@php
    $terms = \App\getPageTerms(DIPLOMATIC_WORK_CATEGORY_SLUG);
@endphp
@extends('layouts.app')

@section('content')
    @include('partials.home.main', ['terms' => $terms])
@endsection
