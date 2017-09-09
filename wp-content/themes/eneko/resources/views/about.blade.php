{{--
  Template Name: About
--}}

@extends('layouts.app')
@php
    $authorId = \App\getOwnerId();
    $url = get_avatar_url( get_the_author_meta('user_email', $authorId), 'full');
    $fullName = get_the_author_meta('first_name',$authorId).' '.get_the_author_meta('last_name',$authorId);
    $twitter = get_the_author_meta('twitter',$authorId);
    $facebook = get_the_author_meta('facebook',$authorId);
    $imageUrl = get_the_post_thumbnail_url();
    $politicalGroup = get_the_author_meta('group',$authorId)
@endphp
@section('content')
    <article class="bio">
        <div class="bio__bg" style="background-image: url({{$imageUrl}});">
            <img src="{{$imageUrl}}" class="visually-hidden">
        </div>
        <div class="bio__wrapper">
            <div class="bio__content">
                {!! get_post()->post_content !!}
            </div>
            <aside class="bio__sumup">
                <h3 class="bio__name">
                    {{$fullName}}
                </h3>
                <div class="bio__group">
                    <h5 class="bio__label">Fonction</h5>
                    {{get_the_author_meta('description', $authorId)}}
                </div>
                <div class="bio__group">
                    <h5 class="bio__label">Groupe politique</h5>
                    {{$politicalGroup}}
                </div>
                <div class="bio__group">
                    <h5 class="bio__label">Commission</h5>
                    @php($loop = App\getCustomQuery(['post_type'=> 'commissions', 'posts_per_page' => -1]))
                        @while ($loop->have_posts()) @php($loop->the_post())
                            <span>{{get_the_title()}}</span>
                            @endwhile
                            {{wp_reset_query()}}
                </div>
                @php($loop = App\getCustomQuery(['post_type'=> 'employees', 'posts_per_page' => -1]))
                    @while ($loop->have_posts()) @php($loop->the_post())
                        @php
                        $category = get_the_category();
                        if(!empty($category)) {
                            $categoryName = $category[0]->name;
                        } else {
                            $categoryName = '';
                        }
                        @endphp
                        @if(get_field('isOnAbout') && !empty($categoryName))
                            <div class="bio__group">
                                <h5 class="bio__label">{{$categoryName}}</h5>
                                <span>{{get_field('name')}}</span>
                                <span>{{get_field('description')}}</span>
                            </div>
                        @endif
                    @endwhile
                    {{wp_reset_query()}}
                <div class="bio__socials">
                    @include('partials.socials',['twitter'=> $twitter, 'facebook'=> $facebook])
                </div>
            </aside>
        </div>
    </article>
@endsection
