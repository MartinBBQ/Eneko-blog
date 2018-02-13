@php
    if(empty($post)) {
        global $post;
    }
    $cfs = CFS();
    $fullDate = $cfs->get('date',$post->ID);
    $strTimeFullDate = strtotime($fullDate);
    $day = date('j',$strTimeFullDate);
    $isDisabled = strtotime(date('D')) > $strTimeFullDate ? 'is-disabled' : '';
    $start = $cfs->get('starting_hour',$post->ID);
    $fullAddress = get_field('place',$post->ID) ? get_field('place',$post->ID) : [];
    $end = $cfs->get('ending_hour',$post->ID);
    $month = \App\date_fr('F',$strTimeFullDate);
    $imageUrl = get_the_post_thumbnail_url($post);
    $id = get_the_ID($post);
    $title = get_the_title($post);
    $placeTitle = $cfs->get('place_title', $post-ID);
@endphp
<article data-id="{{$id}}" data-month="{{date('n',$strTimeFullDate)}}" class="event is-closed {{has_post_thumbnail() ? 'has-thumb' : 'is-thumbless'}} {{$isDisabled}}">
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
            <h3 class="event__title">{{$title}}</h3>
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
                    {{!empty($placeTitle) ? $placeTitle : explode(',', $fullAddress['address'])[0]}}
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
                    {{\App\date_fr('l',$strTimeFullDate)}} {{$day}} {{$month}} - {{$start}} - {{$end}}
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
                    {{!empty($placeTitle) ? $placeTitle : explode(',', $fullAddress['address'])[0]}}
                </div>
            </div>
        </div>
    </div>
</article>