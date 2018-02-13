@php
    $videoUrl = $videoUrl ?? '';
    $isCustomArticle = $isCustomArticle ?? false;
    $displayExcerpt = true;
    if(empty($videoUrl) && empty($isCustomArticle)) {
        $excerpt = wp_trim_words(get_the_content(),30,null);
    } elseif(has_excerpt()) {
        $excerpt = get_the_excerpt();
    } else {
        $displayExcerpt = false;
    }
@endphp
@if($displayExcerpt)
<p class="article__extract">
    {{$excerpt}}
</p>
@endif
