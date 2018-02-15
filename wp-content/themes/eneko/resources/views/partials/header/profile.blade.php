<div class="headerProfile">
    <div class="headerProfile__container">
        @php
            $authorId = \App\getOwnerId();
            $fullName = get_the_author_meta('first_name',$authorId).' '.get_the_author_meta('last_name',$authorId);
        @endphp
        <div class="headerProfile__rightCol">
            <h1 class="headerProfile__name">{{$fullName}}</h1>
            <div class="headerProfile__group">
                <div class="headerProfile__description">
                    {{get_the_author_meta('description', $authorId)}}
                </div>
            </div>
        </div>
    </div>
</div>