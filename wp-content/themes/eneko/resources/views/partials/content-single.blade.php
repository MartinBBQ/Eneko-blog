@php
    $articleUrl = CFS()->get('url');
    $videoUrl = get_field('video');
    $thumb = get_the_post_thumbnail_url();
    $title = get_the_title();
    if(!empty($articleUrl) || !empty($videoUrl)) {
        wp_redirect(home_url());
    }
@endphp
<article @php(post_class('article is-single'))>
        @if(!empty($thumb))
            <div class="article__image" style="background-image: url({{$thumb}});">
                <img src="{{$thumb}}" class="visually-hidden">
                <div class="article__titleContainer">
                    <h1 class="article__title">{{ $title }}</h1>
                </div>
            </div>
        @endif
    <div class="article__container">
        <header class="article__head">
            @if(empty($thumb))
            <h1 class="article__title">{{ $title }}</h1>
            @endif
            <div class="article__group">
                @foreach(get_the_terms(get_post(),'category') as $term)
                    <div class="article__buttonContainer">
                        <span class="button button--small button--blue">{{$term->name}}</span>
                    </div>
                @endforeach
                <div class="article__additionnal">
                    {{App\getBottomInformations()}}
                </div>
            </div>
        </header>
        <div class="article__content">
            @php(the_content())
        </div>
        <div class="article__comments">
            @include('partials.comments')
        </div>
    </div>
</article>
