@php
    $mail = get_field('mail');
    $phone = get_field('phone');
@endphp
<div class="contact">
    <h5 class="contact__title">{{get_field('name')}}</h5>
    <div class="contact__group">
        <a href="tel:{{$phone}}" class="contact__info">{{$phone}}</a>
        <a href="mailto:{{$mail}}" class="contact__info">{{$mail}}</a>
    </div>
</div>