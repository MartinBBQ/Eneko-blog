@php
    $tempOption = get_option('ephemere');
    $permaOption = get_option('permanence');
    $tempTitle = !empty($tempOption) ? $tempOption : 'Rencontrer le député';
    $permaTitle = !empty($permaOption) ? $permaOption : 'Permanences';
@endphp
<aside class="sidebar">
    <div class="sidebar__group sidebar__group--contact">

        <div class="sidebar__info">
            <a href="#"><span>
              <img src="{{\App\asset_path('images/crayon.png')}}" alt="">
            </span> Écrire au député</a>
        </div>
        <div class="sidebar__info js-trigger-newsletter">
            <a href="#"><span>
              <img src="{{\App\asset_path('images/mail.svg')}}" alt="">
            </span> Recevez notre newsletter </a>
        </div>
    </div>
    <div class="sidebar__group sidebar__group--twitter">
      <h4 class="sidebar__title">Flux Twitter</h4>
      @php
         echo do_shortcode('[custom-twitter-feeds]');
      @endphp
    </div>


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
                <h3 class="sidebar__title">
                  <!--{{--$tempTitle--}}-->
                  NOUS VENONS À VOTRE RENCONTRE
                </h3>
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
