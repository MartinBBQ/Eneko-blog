@php
    $authorId = App\getOwnerId();
    $name = get_the_author_meta('tinyName',$authorId);
@endphp
<div class="header is-secondary">
    <div class="header__container">
        @if(!empty($name))
        <div class="header__customerName">{{$name}}</div>
        @endif
        @include('partials.header.tabs')
    </div>
</div>