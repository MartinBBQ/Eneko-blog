@php
    $cfs = CFS();
    $fullDate = $cfs->get('date');
    $day = date('j',strtotime($fullDate));
    $start = $cfs->get('starting_hour');
    $fullAddress = get_field('place') ? get_field('place') : [];
    $end = $cfs->get('ending_hour');
    $month = \App\date_fr('F',strtotime($fullDate));
    $imageUrl = get_the_post_thumbnail_url();
@endphp
<article data-month="{{date('n',strtotime($fullDate))}}" class="event is-closed {{has_post_thumbnail() ? 'has-thumb' : 'is-thumbless'}}">
    <div class="event__top">
        <div class="event__date">
            <div class="event__day">
                {{$day}}
            </div>
            <div class="event__month">
                {{substr($month,0,3)}}.
            </div>
        </div>
        <div class="event__header">
            <h3 class="event__title">{{get_the_title()}}</h3>
            <div class="event__group">
                <div class="event__hours">
                    <span class="event__icon">
                        <i class="material-icons">query_builder</i>
                    </span>
                    {{$start}} - {{$end}}
                </div>
                <div class="event__place">
                    <span class="event__icon">
                        <i class="material-icons">location_on</i>
                    </span>
                    {{\App\getPermanenceLocation($fullAddress)}}
                </div>
            </div>
        </div>
    </div>
    <div class="event__collapsible">
        @if(!empty($imageUrl))
        <div class="event__background" style="background-image: url({{$imageUrl}});">
            <img src="{{$imageUrl}}" class="visually-hidden">
        </div>
        @endif
        <div class="event__content">
            {!! get_the_content() !!}
        </div>
        <div class="event__bottom">
            <div class="event__col">
                <div class="event__wrapper">
                    <span class="event__icon">
                        <i class="material-icons">query_builder</i>
                    </span>
                    <div class="event__subtitle">DATE</div>
                </div>
                <div class="event__subcontent">
                    {{\App\date_fr('l',strtotime(date('l',$fullDate)))}} {{$day}} {{$month}} - {{$start}} - {{$end}}
                </div>
            </div>
            <div class="event__col">
                <div class="event__wrapper">
                    <span class="event__icon">
                        <i class="material-icons">location_on</i>
                    </span>
                    <div class="event__subtitle">LIEU</div>
                </div>
                <div class="event__subcontent">
                    {{$fullAddress['address']}}
                </div>
            </div>
        </div>
    </div>
</article>