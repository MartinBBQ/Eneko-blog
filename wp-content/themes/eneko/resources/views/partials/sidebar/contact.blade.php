@php
    $mail = get_field('mail');
    $phone = get_field('phone');
    $category = get_the_terms(get_the_ID(),'roles');
    if(!empty($category)) {
        $categoryName = $category[0]->name;
    } else {
        $categoryName = '';
    }
@endphp
<div class="contact">
    <div class="contact__title">{{get_field('name')}} <span class="contact__role"> — {{$categoryName}}</span></div>
    <div class="contact__group">
        <a href="tel:{{$phone}}" class="contact__info">📞 {{$phone}}</a>
        <a href="mailto:{{$mail}}" class="contact__info">✉️ {{$mail}}</a>
    </div>
</div>