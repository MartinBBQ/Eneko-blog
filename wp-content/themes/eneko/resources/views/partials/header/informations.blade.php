<div class="informations">
    @php
        $authorId = App\getOwnerId();
        $politicalGroup = get_the_author_meta('group',$authorId);
        $linkPolitical = get_the_author_meta('url',$authorId) ?? '#';
    @endphp

</div>