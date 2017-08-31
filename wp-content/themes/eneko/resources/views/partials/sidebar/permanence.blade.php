@php
    $dates = CFS()->get('dates');
    $fullAddress = get_field('fulladdress');
@endphp
<div class="permanence" style="background-image: url({{get_the_post_thumbnail_url()}});">
    <img src="{{get_the_post_thumbnail_url()}}" class="visually-hidden" alt="Photo de {{$fullName}}">
    <div class="permanence__wrapper">
        <h5 class="permanence__location">
            {{get_the_title()}}
        </h5>
        <p class="permanence__address">
            {{\App\getPermanenceAddress($fullAddress)}}
        </p>
        <p class="permanence__nextDate">
            {{\App\getNextPermanenceDate($dates)}}
        </p>
        @extends('partials.modal')
        @section('modal-content')
            <h1>Bonjour</h1>
        @endsection
    </div>
</div>