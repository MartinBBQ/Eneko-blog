<div class="informations">
    @php
        $authorId = get_post()->post_author;
        $politicalGroup = get_the_author_meta('group',$authorId);
        $linkPolitical = get_the_author_meta('url',$authorId) ?? '#';
    @endphp
    @if(!empty($politicalGroup))
        <div class="informations__group">
            <h5 class="informations__title">
                <a href="{{$linkPolitical}}" target="_blank">Groupe politique</a>
            </h5>
            <div class="informations__tags">
                <a href="{{$linkPolitical}}" class="button button--light-blue button--tag disabled-hover">{{$politicalGroup}}</a>
            </div>
        </div>
    @endif
    @php($loop = App\getCustomQuery(['post_type'=> 'commissions', 'posts_per_page' => -1]))
        <div class="informations__group">
            <h5 class="informations__title">Commission</h5>
            <div class="informations__tags">
                @while ($loop->have_posts()) @php($loop->the_post())
                    <div class="informations__buttonContainer">
                        <a target="_blank" href="{{get_the_excerpt()}}" class="button button--white button--tag disabled-hover">{{get_the_title()}}</a>
                    </div>
                    @endwhile
                    {{wp_reset_query()}}
            </div>
        </div>
        @php
            $loop = App\getCustomQuery(['post_type'=> 'stats', 'posts_per_page' => -1]);
            $i = 0;
        @endphp
        <div class="informations__group">
            <h5 class="informations__title">Travail parlementaire</h5>
            <div class="informations__tags">
                @while ($loop->have_posts())
                    @php($loop->the_post())
                        @if($i<2)
                            <div class="informations__buttonContainer">
                                <a target="_blank" href="{{get_the_excerpt()}}" class="button button--white button--tag disabled-hover">{{get_the_title()}}</a>
                            </div>
                        @else
                            <div class="informations__buttonContainer is-hidden">
                                <a target="_blank" href="{{get_the_excerpt()}}" class="button button--white button--tag disabled-hover">{{get_the_title()}}</a>
                            </div>
                        @endif
                        @php($i++)
                            @endwhile
                            {{wp_reset_query()}}
                            <div class="informations__more">Voir plus de statistiques…</div>
            </div>
        </div>
</div>