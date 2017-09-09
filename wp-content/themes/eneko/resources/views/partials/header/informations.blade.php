<div class="informations">
    @php
        $authorId = get_post()->post_author;
        $politicalGroup = get_the_author_meta('group',$authorId)
    @endphp
    @if(!empty($politicalGroup))
        <div class="informations__group">
            <h5 class="informations__title">Groupe politique</h5>
            <div class="informations__tags">
                <button type="button" class="button button--light-blue button--tag disabled-hover">{{$politicalGroup}}</button>
            </div>
        </div>
    @endif
    @php($loop = App\getCustomQuery(['post_type'=> 'commissions', 'posts_per_page' => -1]))
        <div class="informations__group">
            <h5 class="informations__title">Commission</h5>
            <div class="informations__tags">
                @while ($loop->have_posts()) @php($loop->the_post())
                    <div class="informations__buttonContainer">
                        <button type="button" class="button button--white button--tag disabled-hover">{{get_the_title()}}</button>
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
                                <button type="button" class="button button--white button--tag disabled-hover">{{get_the_title()}}</button>
                            </div>
                        @else
                            <div class="informations__buttonContainer is-hidden">
                                <button type="button" class="button button--white button--tag disabled-hover">{{get_the_title()}}</button>
                            </div>
                        @endif
                        @php($i++)
                            @endwhile
                            {{wp_reset_query()}}
                            <div class="informations__more">Voir plus de statistiques…</div>
            </div>
        </div>
</div>