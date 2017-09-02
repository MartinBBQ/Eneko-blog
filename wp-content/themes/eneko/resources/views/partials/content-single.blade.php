<article @php(post_class('article is-single'))>
    @php($thumb = get_the_post_thumbnail_url())
        @if(!empty($thumb))
            <div class="article__image" style="background-image: url({{$thumb}});">
                <img src="{{$thumb}}" class="visually-hidden">
            </div>
            @endif
    <div class="article__container">
        <header class="article__head">
            @foreach(get_the_terms(get_post(),'category') as $term)
                <div class="article__buttonContainer">
                    <span class="button button--big button--filled-blue">{{$term->name}}</span>
                </div>
            @endforeach
            <h1 class="article__title">{{ get_the_title() }}</h1>
            <div class="article__additionnal">
                {{App\getArticleNameAndDate()}}
            </div>
        </header>
        <div class="article__content">
            @php(the_content())
        </div>
    </div>
</article>
@include('partials.sidebar')
