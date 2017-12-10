@php
    $authorId = \App\getOwnerId();
    $fullName = get_the_author_meta('first_name',$authorId).' '.get_the_author_meta('last_name',$authorId);
    $twitter = get_the_author_meta('twitter',$authorId);
    $facebook = get_the_author_meta('facebook',$authorId);
    $imagePath = get_template_directory_uri().'/assets/images/';
    $twitterIcon = $imagePath.'twitter.png';
    $fbIcon = $imagePath.'facebook.png';
@endphp
@if(!empty($twitter) || !empty($facebook))
    <div class="header__rightCol">
        @if(!empty($twitter))
            <a href="{{$twitter}}" target="_blank">
                <img src="{{$twitterIcon}}" alt="Logo Twitter">
            </a>
        @endif
        @if(!empty($facebook))
            <a href="{{$facebook}}" target="_blank">
                <img src="{{$fbIcon}}" alt="Logo Facebook">
            </a>
        @endif
    </div>
@endif