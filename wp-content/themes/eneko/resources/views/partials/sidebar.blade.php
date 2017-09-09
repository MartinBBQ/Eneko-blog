<aside class="sidebar">
    @php($loop = App\getCustomQuery(['post_type'=> 'permanencies', 'posts_per_page' => -1]))
        @if($loop->have_posts())
            <div class="sidebar__group">
                <h3 class="sidebar__title">Permanences</h3>
                @while ($loop->have_posts()) @php($loop->the_post())
                    @include('partials.sidebar.permanence')
                @endwhile
            </div>
        @endif
        {{wp_reset_query()}}
            <div class="sidebar__group">
                <h3 class="sidebar__title">Contact</h3>
    @php($loop = App\getCustomQuery(['post_type'=> 'employees', 'posts_per_page' => -1]))
        @if($loop->have_posts())
            @while ($loop->have_posts()) @php($loop->the_post())
                @if(get_field('isOnSidebar'))
                    @include('partials.sidebar.contact')
                @endif
            @endwhile
        @endif
        {{wp_reset_query()}}
                @php
                    $authorId = \App\getOwnerId();
                    $mail = get_the_author_meta('user_email', $authorId);
                @endphp
                <div class="sidebar__group">
                    <div class="sidebar__info">
                        <a href="mailto:{{$mail}}">Écrire au député</a>
                    </div>
                    <div class="sidebar__info">
                        <a href="/propositions">Faire une proposition</a>
                    </div>
                    <div class="sidebar__info">
                        Rencontrer le député
                    </div>
                </div>
            </div>
</aside>