@php
    $cfs = CFS();
    $fullAddress = get_field('fulladdress');
    $cityRef = get_field('city_ref');
    $imageUrl = get_the_post_thumbnail_url();
    $location = \App\getPermanenceLocation($fullAddress);
    $address =  \App\getPermanenceAddress($fullAddress);
    $dates = $cfs->get('dates');
    $nextDay = \App\getNextPermanenceDate($dates);
    $termSlug = get_the_terms(get_the_ID(), 'types')[0]->slug;
    $schedule = $cfs->get('ouvertures');
@endphp
<div class="permanence" style="background-image: url({{$imageUrl}});">
    <img src="{{$imageUrl}}" class="visually-hidden">
    <div class="permanence__wrapper">
        <h5 class="permanence__location">
            {{$location}}
        </h5>
        <p class="permanence__address">
            {{$address}}
        </p>
        <p class="permanence__nextDate">
            {{$nextDay['day']}}  - {{$nextDay['hour']}}
        </p>
    </div>
    <div class="modal is-marginless">
        <div class="modal__main">
            <div class="modal__inner">
                <div class="cross"></div>
                <div class="modal__content">
                    <div class="modal__background" style="background-image: url({{$imageUrl}});">
                        <img src="{{$imageUrl}}" class="visually-hidden">
                    </div>
                    <div class="modal__externalContent">
                        <h5 class="modal__location">
                            {{$location}}
                        </h5>
                        <p class="modal__address">
                            <span>{{$address}}</span>
                            <span>{{$cityRef}} - {{$location}}</span>
                        </p>
                        @if($termSlug=='ephemere')
                            @include('partials.sidebar.permanence.ephemeral', ['nextDay' => $nextDay, 'dates' => $dates])
                        @elseif($termSlug=='permanente')
                            @include('partials.sidebar.permanence.permanent', ['days' => $schedule])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>