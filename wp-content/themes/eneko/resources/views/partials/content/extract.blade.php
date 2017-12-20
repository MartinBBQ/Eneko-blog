@php
    $videoUrl = $videoUrl ?? '';
    $isCustomArticle = $isCustomArticle ?? false;
@endphp
@if(empty($videoUrl) && empty($isCustomArticle))
<p class="article__extract">
    {{wp_trim_words(get_the_content(),30,null)}}
</p>
@endif