{{--
  Template Name: About
--}}

@extends('layouts.app')
@php
    $authorId = \App\getOwnerId();
    $url = get_avatar_url( get_the_author_meta('user_email', $authorId), 'full');
    $fullName = get_the_author_meta('first_name',$authorId).' '.get_the_author_meta('last_name',$authorId);
    $description = get_the_author_meta('description', $authorId);
    $imageUrl = get_the_post_thumbnail_url();
    $politicalGroup = get_the_author_meta('group',$authorId);
@endphp
@section('content')
    <article class="bio">
        <div class="bio__bg" style="background-image: url({{$imageUrl}});">
            <img src="{{$imageUrl}}" class="visually-hidden">
        </div>
        <div class="bio__wrapper">
            <aside class="bio__sumup">
                <div class="bio__block">
                    <h3 class="bio__name">
                        {{$fullName}}
                    </h3>
                    <p class="bio__description">{{$description}}</p>
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
                    <div class=" bio__contact">
                      <a href="#" class="contact__info">
                        <img draggable="false" class="emoji emoji-twitter" alt="twitter" src="{{content_url()}}/themes/eneko/dist/images/twitter.png">
                      </a>
                      <a href="#" class="contact__info">
                        <img draggable="false" class="emoji emoji-facebook" alt="facebook" src="{{content_url()}}/themes/eneko/dist/images/facebook.png">
                      </a>
                    </div>
                  </div>
                  <div class="bio__title">L'équipe</div>
                  @php($loop = App\getCustomQuery(['post_type'=> 'employees', 'posts_per_page' => -1]))
                  @while ($loop->have_posts()) @php($loop->the_post())
                  @php
                            $category = get_the_terms(get_the_ID(),'roles');
                            $email = get_field('mail');
                            $twitter = get_field('twitter');
                            $linkedin = get_field('linkedin');
                            if(!empty($category)) {
                                $categoryName = $category[0]->name;
                            } else {
                                $categoryName = '';
                            }
                        @endphp
                        @if(get_field('isOnAbout') && !empty($categoryName))
                            <div class="bio__block is-secondary">
                                <div class="bio__group">
                                    <h5 class="bio__label">{{$categoryName}}</h5>
                                    <div class="separator"></div>
                                    <span class="bio__member">{{get_field('name')}}</span>
                                    <span class="bio__sentence">{{get_field('description')}}</span>
                                    <div class="bio__socials bio__contact">

                                        {{--@if(!empty($twitter))--}}
                                            <a href="{{$twitter}}" target="_blank">
                                                <img src="{{\App\asset_path('images/twitter.png')}}"
                                                     alt="Icône Twitter" class="twitter">
                                            </a>
                                        {{--@endif--}}
                                        @if(!empty($email))
                                            <a href="mailto:{{$email}}">
                                                <img width="24px" src="{{\App\asset_path('images/mail.svg')}}" alt="" class="mail">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endwhile
                        {{wp_reset_query()}}
            </aside>
            <div class="bio__content">
                {!! apply_filters('the_content', get_post()->post_content) !!}
            </div>
        </div>
    </article>
@endsection
