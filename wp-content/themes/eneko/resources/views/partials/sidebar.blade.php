<aside class="sidebar">
    @php($loop = App\getCustomQuery(['post_type'=> 'permanencies', 'posts_per_page' => -1]))
        @if($loop->have_posts())
            <div class="permanencies">
                <h3 class="permanencies__title">Permanences</h3>
                @while ($loop->have_posts()) @php($loop->the_post())
                    @include('partials.sidebar.permanence')
                @endwhile
                {{wp_reset_query()}}
            </div>
        @endif
</aside>