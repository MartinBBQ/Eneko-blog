@php
    $tempOption = get_option('ephemere');
    $permaOption = get_option('permanence');
    $tempTitle = !empty($tempOption) ? $tempOption : 'Rencontrer le député';
    $permaTitle = !empty($permaOption) ? $permaOption : 'Permanences';
    $displayed = $displayed ?? false;
@endphp
<aside class="sidebar">
  <div class="sidebar__group sidebar__group--contact">
    <div class="button--info">
        <img src="{{\App\asset_path('images/pen.svg')}}" alt="contact">
        <p class="button--text">Écrire au député</p>
    </div>

    @php
      echo do_shortcode('[contact-form-7 id="535" title="Contact form 1"]');
    @endphp
    <div class="button--info js-trigger-newsletter" >
      <img src="{{\App\asset_path('images/mail.svg')}}" alt="newsletter">
      <p class="button--text">Recevez notre newsletter</p>
        @if($i == 1 && !$displayed)
          @include('partials.newsletter.subscribe')
          @php($displayed = true)
        @endif
    </div>
  </div>
  <div class="sidebar__group sidebar__group--twitter">
    <h4 class="sidebar__title">Flux Twitter</h4>
    @php
       echo do_shortcode('[custom-twitter-feeds]');
    @endphp
    <div class="more-twitter-link">
      <a href="{{$twitter}}" target="_blank" class="btn ctf-more" id="twitter_activity">
        <span>Voir toute mon activité sur Twitter</span>
      </a>
    </div>
  </div>

    @php($loop = App\getCustomQuery(['post_type'=> 'permanencies', 'posts_per_page' => -1]))
        @if($loop->have_posts())
            <div class="sidebar__group">
                <h3 class="sidebar__title">
                  {{$permaTitle}}
                </h3>
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
                  PROCHAINE RENCONTRE
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
