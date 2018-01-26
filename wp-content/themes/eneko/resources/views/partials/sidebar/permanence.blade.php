@php
    $cfs = CFS();
    $fullAddress = get_field('fulladdress');
    $cityRef = get_field('city_ref');
    $phone = get_field('phone');
    $mail = get_field('mail');
    $imageUrl = get_the_post_thumbnail_url();
    $location = \App\getPermanenceLocation($fullAddress);
    $address =  \App\getPermanenceAddress($fullAddress);
    $dates = $cfs->get('dates');
    $termSlug = get_the_terms(get_the_ID(), 'types')[0]->slug;
    $schedule = $cfs->get('ouvertures');
    if($termSlug=='ephemere') {
        $nextDay = \App\getNextPermanenceDate($dates);
    } else {
        $nextDay = \App\getNextPermanenceDate($schedule,true);
    }
    $lng = $fullAddress['lng'];
    $lat = $fullAddress['lat'];
    $title = get_the_title();
    $hasAddress = (int) get_option( 'contactEnabled') !== 0;
    $contact = get_option('dutyAddress');
@endphp
<div class="permanence" data-lng="{{$lng}}" data-lat="{{$lat}}" style="background-image: url({{$imageUrl}});">
    <img src="{{$imageUrl}}" class="visually-hidden">
    <div class="permanence__wrapper">
        <h5 class="permanence__location">
            {{$title}}
        </h5>
        <p class="permanence__nextDate">
            @if(!$hasAddress)
            {{$nextDay['day']}}
            @if($nextDay['hour'])
                <span class="permanence__hours">
                    {{$nextDay['hour']}}
                </span>
            @endif
            @elseif(!empty($contact))
                {{$title}} -
                <a href="mailto:{{$contact}}">Prenez RDV</a>
            @endif
        </p>
    </div>
    <div class="modal is-marginless">
        <div class="modal__main">
            <div class="modal__inner">
                <div class="cross"></div>
                <div class="modal__content">
                    <div class="modal__top" style="background-image: url({{$imageUrl}});">
                        <div class="modal__map"></div>
                        <img src="{{$imageUrl}}" class="visually-hidden">
                        @if(!empty($lat) && !empty($lng))
                            <a target="_blank" href="//google.com/maps/?q={{$fullAddress['address']}}" class="modal__locate">
                                <div class="modal__cta">
                                    <i class="material-icons">directions_car</i>
                                </div>
                                <span class="modal__mapLabel">Itinéraire</span>
                            </a>
                        @endif
                    </div>
                    <div class="modal__externalContent">
                        <h5 class="modal__location">
                            {{$title}}
                        </h5>
                        <p class="modal__info">
                            <span class="modal__label">Adresse : </span>
                            <span>{{$fullAddress['address']}}</span>
                        </p>
                        @if(!empty($phone))
                        <p class="modal__info">
                            <span class="modal__label">Téléphone : </span>
                            <span>{{$phone}}</span>
                        </p>
                        @endif
                        @if(!empty($mail))
                            <p class="modal__info">
                                <span class="modal__label">Email : </span>
                                <span>{{$mail}}</span>
                            </p>
                        @endif
                        <div class="modal__description">
                            {{get_the_content()}}
                        </div>
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