@php
    $authorId = \App\getOwnerId();
    $fullName = get_the_author_meta('first_name',$authorId).' '.get_the_author_meta('last_name',$authorId);
    $twitter = get_the_author_meta('twitter',$authorId);
    $facebook = get_the_author_meta('facebook',$authorId);
@endphp
@if(!empty($twitter) || !empty($facebook))
    <div class="header__rightCol">
        @if(!empty($twitter))
            <div class="">

            </div>
        @endif
        @if(!empty($facebook))
            <div class="p">

            </div>
        @endif
    </div>
@endif