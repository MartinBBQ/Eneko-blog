@php
    $dates = CFS()->get('dates');
    $fullAddress = get_field('fulladdress');
    $cityRef = get_field('city_ref');
    $imageUrl = get_the_post_thumbnail_url();
    $location = \App\getPermanenceLocation($fullAddress);
    $address =  \App\getPermanenceAddress($fullAddress);
    $nextDay = \App\getNextPermanenceDate($dates);
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
                        <div class="modal__group">
                            <p class="modal__nextLabel">Prochaine permanence</p>
                            <p class="modal__nextDate">
                                <span>{{$nextDay['day']}}</span> - {{$nextDay['hour']}}
                            </p>
                        </div>
                        <div class="modal__group">
                            <p class="modal__nextLabel">A venir</p>
                            <ul class="modal__list">
                                @foreach(\App\getPermanenceDates($dates) as $date)
                                    <li class="modal__listItem">
                                        <span>{{$date['day']}}</span> - {{$date['hour']}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>