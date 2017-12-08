@php
    $mail = get_field('mail');
    $phone = get_field('phone');
    $category = get_the_terms(get_the_ID(),'roles');
    if(!empty($category) && !$category instanceof WP_Error) {
        $categoryName = $category[0]->name;
    } else {
        $categoryName = '';
    }
    $thumb = get_the_post_thumbnail_url(get_post(),'full');
    $name = get_field('name');
    $isOwner = !empty($owner) ? $owner : false;
    $authorId = \App\getOwnerId();
    $fullName = get_the_author_meta('first_name',$authorId).' '.get_the_author_meta('last_name',$authorId);
    $description = get_the_author_meta('description', $authorId);
    if($isOwner) {
        $name = $fullName;
        $categoryName = $description;
    }
@endphp
<div class="contact {{$isOwner ? 'is-owner' : ''}}">
        @if(!empty($thumb))
            <div class="contact__photo" style="background-image: url({{$thumb}});">
                <img src="{{$thumb}}" alt="Photo de {{$name}}">
            </div>
        @endif
    <div class="contact__container">
        <div class="contact__title">
            {{$name}}
            <span class="contact__role"> — {{$categoryName}}</span>
        </div>
        @if(!$isOwner)
            <div class="contact__group">
                <a href="tel:{{$phone}}" class="contact__info">📞</a>
                <a href="mailto:{{$mail}}" class="contact__info">✉️</a>
            </div>
        @endif
    </div>
</div>