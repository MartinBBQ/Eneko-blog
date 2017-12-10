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
                        if ($found) {
                            return;
                        }
                        $dayString = reset($day['day']);
                        $isToday = \App\isToday($dayString, $found);
                        if ($isToday) {
                            $found = true;
                        }
                    }
                @endphp
                <div class="informations__title">
                    Permanence de {{$location}} • {{$isToday ? "ouverte aujourd'hui" : "Fermée"}}
                    @if(!empty($nextDay['hour']))
                    <span class="informations__hours">
                        {{$nextDay['hour']}}
                    </span>
                    @endif
                </div>
            @endif
            @endwhile
        @endif
    <img src="{{$logo}}" class="informations__logo">
</div>