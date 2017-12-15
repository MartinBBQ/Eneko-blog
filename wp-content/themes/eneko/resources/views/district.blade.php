{{--
  Template Name: En circonscription
--}}
@php
    $terms = \App\getPageTerms(DISTRICT_CATEGORY_SLUG);
@endphp
@extends('layouts.app')

@section('content')
    @include('partials.home.main', ['terms' => $terms, 'title' => "En circonscription"])
@endsection
