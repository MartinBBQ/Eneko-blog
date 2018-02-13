<div class="informations">
    @php
        $cfs = CFS();
        $authorId = App\getOwnerId();
        $politicalGroup = get_the_author_meta('group',$authorId);
        $linkPolitical = get_the_author_meta('url',$authorId) ?? '#';
        $query = \App\getCustomQuery(['post_type' => 'permanencies', 'posts_per_page' => -1]);
        $hasOne = false;
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' )[0];
        $hasAddress = (int) get_option( 'contactEnabled') !== 0;
        $contact = get_option('dutyAddress');
    @endphp
        @if($query->have_posts())
            @while($query->have_posts() && !$hasOne)
            @php
                $query->the_post();
                $term = get_the_terms(get_the_ID(), 'types')[0];
                $termSlug = $term ? $term->slug : '';
            @endphp
            @if($termSlug=='permanente')
                @php
                    $hasOne = true;
                    $found = false;
                    $fullAddress = get_field('fulladdress');
                    $location = \App\getPermanenceLocation($fullAddress);
                    $schedule = $cfs->get('ouvertures');
                    $nextDay = \App\getNextPermanenceDate($schedule,true);
                    foreach($schedule as $day) {
                        $dayString = reset($day['day']);
                        $isToday = \App\isToday($dayString, $found);
                    }
                @endphp
                <div class="informations__title">
                    @if(!$hasAddress)
                    <span>
                        Permanence de {{get_the_title()}} • {{!empty($nextDay['hour']) ? "ouverte aujourd'hui" : "Fermée"}}
                    </span>
                    @if(!empty($nextDay['hour']))
                    <div class="informations__wrapper">
                        <span class="informations__hours">
                            {{$nextDay['hour']}}
                        </span>
                    </div>
                    @endif
                    @elseif(!empty($contact))
                        <span>
                            Permanence de {{get_the_title()}}
                        </span>
                        <span class="informations__hours informations__hours--small">
                        <a href="mailto:{{$contact}}">Gardons contact</a>
                        </span>
                    @endif
                </div>
            @endif
            @endwhile
        @endif
    @if(!empty($logo))
    <img src="{{$logo}}" class="informations__logo" />
    @endif
</div>