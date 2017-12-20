@php
    $cfs = CFS();
    $url = $cfs->get('url');
    $videoUrl = get_field('video');
    $isCustomArticle = false;
    $terms = get_the_terms(get_post(),'category');
    $termSlugs = [];
    $termNames = [];
    $siteName = '';
    $thumb = get_the_post_thumbnail_url(get_post(),'full');
    $title = get_the_title();
    foreach($terms as $term) {
        $slug = $term->slug;
        $parentId = $term->parent;
        if(!empty($parentId) && $parentId !== 0) {
            $parent = get_term_by('id', $parentId, 'category');
            $slug = $slug.'-'.$parent->slug;
        }
        array_push($termSlugs, $slug);
        array_push($termNames,$term->name);
    }
    if(!empty($url)) {
        $isCustomArticle = true;
        $siteName = $cfs->get('source');
    } elseif (!empty($videoUrl)) {
        $url = $videoUrl;
    } else {
        $url = get_the_permalink();
    }
@endphp
<article
    data-category="{{implode(' ',$termSlugs)}}"
    @php(post_class(\App\getArticleClasses(['is-first' => $isFirst])))>
    <a {{$isCustomArticle || !empty($videoUrl) ? 'target="_blank"' : ''}} href="{{!empty($videoUrl) ? '//'.$url : $url}}">
        <div class="article__wrapper">
            <div class="article__buttonContainer">
            @if(!$isCustomArticle)
                @foreach($termNames as $term)
                <span class="button button--small button--blue">{{$term}}</span>
                @endforeach
            @else
                <span class="button button--small button--blue">{{$siteName}}</span>
            @endif
            </div>
            <h2 class="article__title">{{$title}}</h2>

            @if(!$isFirst || $isCustomArticle || !empty($videoUrl))
                @include('partials.content.extract', ['isCustomArticle' => $isCustomArticle])
                @include('partials.content.bottom')
            @elseif($isFirst)
                @include('partials.content.bottom')
                @include('partials.content.extract', ['isCustomArticle' => $isCustomArticle])
                @include('partials.content.more')
            @endif
        </div>
    </a>
    @if(!empty($thumb))
        <div class="article__bg" style="background-image: url({{$thumb}});"></div>
    @endif
</article>
