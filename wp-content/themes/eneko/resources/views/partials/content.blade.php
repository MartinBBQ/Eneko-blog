<article @php(post_class('article'))>
    <a href="{{get_the_permalink()}}">
    <div class="article__wrapper">
        @foreach(get_the_terms(get_post(),'category') as $term)
            <span class="button button--small button--filled-blue">{{$term->name}}</span>
        @endforeach
        <h2 class="article__title">{{get_the_title()}}</h2>
        <div class="article__bottom">
            {{App\getArticleBottom()}}
        </div>
    </div>
    @php($thumb = get_the_post_thumbnail_url(get_post(),'full'))
        @isset($thumb)
            <div class="article__image" style="background-image: url({{$thumb}});">
                <img src="{{$thumb}}" class="visually-hidden">
            </div>
        @endisset
    </a>
</article>
