{{--
  Template Name: Presse
--}}

@php
    $loop = App\getCustomQuery([
    'post_type'=> 'post',
    'posts_per_page' => 10,
    'category_name' => PRESS_CATEGORY_SLUG.',presse-'.DISTRICT_CATEGORY_SLUG.',presse-'.DIPLOMATIC_WORK_CATEGORY_SLUG
    ])
@endphp
@extends('layouts.app')

@section('content')
    @include('partials.home.main', ['terms' => [], 'title' => 'Presse', 'useLocalLoop' => false])
@endsection
