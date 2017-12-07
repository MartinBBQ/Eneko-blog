@php
    $articleUrl = CFS()->get('url');
    $isCustomArticle = false;
    $terms = get_the_terms(get_post(),'category');
    $termSlugs = [];
    $termNames = [];
    $siteName = '';
    $thumb = get_the_post_thumbnail_url(get_post(),'full');
    foreach($terms as $term) {
        array_push($termSlugs,$term->slug);
        array_push($termNames,$term->name);
    }
    if(!empty($articleUrl)) {
        $url = $articleUrl;
        $result = wp_remote_get('http://back.eneko.co/api/openGraph/url?url='.$url);
        $parsedUrl = parse_url($articleUrl);
        if(!empty($parsedUrl['host'])) {
           $siteName = $parsedUrl['host'];
        } else {
           $siteName = $parsedUrl['path'];
           $siteName = explode('/',$siteName)[0];
        }
        $siteName = str_replace('www.','', $siteName);
        if(!$result instanceof WP_Error) {
            $title = $result['http_response']->get_response_object()->body;
            $title = json_decode($title)->response->title ?? 'Article de presse';
        } else {
            $title = '';
            $result = false;
        }
        // To get external links.
        $url = '//'.$url;
        $isCustomArticle = true;
    } else {
        $url = get_the_permalink();
        $title = get_the_title();
    }
    $videoUrl = get_field('video');
@endphp
<article
        data-category="{{implode(' ',$termSlugs)}}"
        @php(post_class(\App\getArticleClasses()))>
    @if(empty($videoUrl))
        <a {{$isCustomArticle ? 'target="_blank"' : ''}} href="{{$url}}">
            <div class="article__wrapper">
                @if(!$isCustomArticle)
                    @foreach($termNames as $term)
                        @include('partials.content.buttonContainer', ['label' => $term])
                    @endforeach
                @else
                    @include('partials.content.buttonContainer', ['label' => $siteName])
                @endif
                <h2 class="article__title">{{$title}}</h2>
                <p class="article__extract">
                    {{wp_trim_words(get_the_content(),30,null)}}
                </p>
                <div class="article__bottom">
                    {{App\getArticleNameAndDate(true)}}
                </div>
            </div>
        </a>
    @else
        <iframe src="{{$videoUrl}}" frameborder="0" class="article__video"></iframe>
    @endif
    @if(!empty($thumb) && empty($videoUrl))
        <div class="article__bg" style="background-image: url({{$thumb}});"></div>
    @endif
</article>
