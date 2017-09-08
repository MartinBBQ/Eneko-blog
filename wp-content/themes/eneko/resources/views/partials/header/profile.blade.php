<div class="headerProfile">
    <div class="headerProfile__container">
        @php
            $authorId = \App\getOwnerId();
            $url = \App\scrapeImage(get_wp_user_avatar($authorId));
            if(empty($url)) {
                $url = get_avatar_url( get_the_author_meta('user_email', $authorId), 'full');
            }
            $fullName = get_the_author_meta('first_name',$authorId).' '.get_the_author_meta('last_name',$authorId);
            $twitter = get_the_author_meta('twitter',$authorId);
            $facebook = get_the_author_meta('facebook',$authorId);
        @endphp
        <div class="headerProfile__avatar" style="background-image: url({{$url}});">
            <img src="{{$url}}" class="visually-hidden" alt="Photo de {{$fullName}}">
        </div>
        <div class="headerProfile__rightCol">
            <h1 class="headerProfile__name">{{$fullName}}</h1>
            <div class="headerProfile__group">
                <div class="headerProfile__description">
                    {{get_the_author_meta('description', $authorId)}}
                </div>
                <div class="headerProfile__socials">
                    @include('partials.socials',['twitter'=> $twitter, 'facebook'=> $facebook])
                </div>
            </div>
        </div>
    </div>
</div>