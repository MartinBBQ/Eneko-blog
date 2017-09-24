@php
    $tempTitle = !empty(get_option('ephemere')) ? get_option('ephemere') : 'Rencontrer le député';
    $permaTitle = !empty(get_option('permanence')) ? get_option('permanence') : 'Permanences';
@endphp
<aside class="sidebar">
    <div class="sidebar__group">
        @php
            $authorId = \App\getOwnerId();
            $mail = get_the_author_meta('user_email', $authorId);
        @endphp
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
    </div>
    <div class="sidebar__group">
        <div class="sidebar__info">
            <a href="mailto:{{$mail}}">Écrire au député</a>
        </div>
        <div class="sidebar__info">
            <a href="/propositions">Faire une proposition</a>
        </div>
    </div>
        @if($loop->have_posts())
            <div class="sidebar__group">
                <h3 class="sidebar__title">{{$permaTitle}}</h3>
                @while ($loop->have_posts()) @php($loop->the_post())
                    @php
                        $termSlug = get_the_terms(get_the_ID(), 'types')[0]->slug;
                    @endphp
                    @if($termSlug=='permanente')
                        @include('partials.sidebar.permanence', ["isPermanent" => true])
                    @endif
                    @endwhile
            </div>
        @endif
        {{wp_reset_query()}}
    @php($loop = App\getCustomQuery(['post_type'=> 'permanencies', 'posts_per_page' => -1]))
        @if($loop->have_posts())
            <div class="sidebar__group">
                <h3 class="sidebar__title">{{$tempTitle}}</h3>
                @while ($loop->have_posts()) @php($loop->the_post())
                    @php
                        $termSlug = get_the_terms(get_the_ID(), 'types')[0]->slug;
                    @endphp
                    @if($termSlug=='ephemere')
                        @include('partials.sidebar.permanence')
                    @endif
                    @endwhile
            </div>
        @endif
        {{wp_reset_query()}}
</aside>