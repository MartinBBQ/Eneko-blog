@php
    $tempOption = get_option('ephemere');
    $permaOption = get_option('permanence');
    $tempTitle = !empty($tempOption) ? $tempOption : 'Rencontrer le député';
    $permaTitle = !empty($permaOption) ? $permaOption : 'Permanences';
@endphp
<aside class="sidebar">
    <div class="sidebar__group sidebar__group--contact">
        @if(!empty($mail))
        <div class="sidebar__info">
            <a href="mailto:{{$mail}}"><span>✉️</span> Écrire au député</a>
        </div>
        @endif
        {{--<div class="sidebar__info js-trigger-newsletter">--}}
            {{--<a href="#"><span>💡</span> S'inscrire à la newsletter </a>--}}
        {{--</div>--}}
    </div>
    @php
        $authorId = \App\getOwnerId();
        $mail = get_the_author_meta('user_email', $authorId);
        $loop = App\getCustomQuery(['post_type'=> 'employees', 'posts_per_page' => -1])
    @endphp
    @if($loop->have_posts())
        <div class="sidebar__group sidebar__group--team">
            <h4 class="sidebar__title">L'équipe</h4>
            @include('partials.sidebar.contact', ['owner' => true])
            @while ($loop->have_posts()) @php($loop->the_post())
                @if(get_field('isOnSidebar'))
                    @include('partials.sidebar.contact')
                @endif
            @endwhile
        </div>
    @else
        <div class="sidebar__group sidebar__group--team">
            <h4 class="sidebar__title">L'équipe</h4>
            @include('partials.sidebar.contact', ['owner' => true])
        </div>
    @endif
    {{wp_reset_query()}}
    @php($loop = App\getCustomQuery(['post_type'=> 'permanencies', 'posts_per_page' => -1]))
        @if($loop->have_posts())
            <div class="sidebar__group">
                <h3 class="sidebar__title">{{$permaTitle}}</h3>
                @while ($loop->have_posts()) @php($loop->the_post())
                    @php
                        $term = get_the_terms(get_the_ID(), 'types')[0];
                        $termSlug = $term ? $term->slug : '';
                    @endphp
                    @if($termSlug=='permanente')
                        @include('partials.sidebar.permanence', ["isPermanent" => true])
                    @endif
                    @endwhile
            </div>
        @endif
        {{wp_reset_postdata()}}
        @if($loop->have_posts())
            <div class="sidebar__group sidebar__group--temporary">
                <h3 class="sidebar__title">{{$tempTitle}}</h3>
                @while ($loop->have_posts()) @php($loop->the_post())
                    @php
                        $term = get_the_terms(get_the_ID(), 'types')[0];
                        $termSlug = $term ? $term->slug : '';
                    @endphp
                    @if($termSlug=='ephemere')
                        @include('partials.sidebar.permanence')
                    @endif
                    @endwhile
            </div>
        @endif
        {{wp_reset_query()}}
</aside>