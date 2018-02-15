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
                    <div class="bio__separator"></div>
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
                      <a href="{{$twitter}}" target="_blank" class="contact__info">
                        <img src="{{\App\asset_path('images/fil-twitter.svg')}}" alt="Icône Twitter" class="twitter">
                      </a>
                      <a href="{{$facebook}}" target="_blank" class="contact__info">
                        <svg width="20px" height="20px" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g id="Color-" transform="translate(-200.000000, -160.000000)" fill="#4460A0">
                                  <path d="M225.638355,208 L202.649232,208 C201.185673,208 200,206.813592 200,205.350603 L200,162.649211 C200,161.18585 201.185859,160 202.649232,160 L245.350955,160 C246.813955,160 248,161.18585 248,162.649211 L248,205.350603 C248,206.813778 246.813769,208 245.350955,208 L233.119305,208 L233.119305,189.411755 L239.358521,189.411755 L240.292755,182.167586 L233.119305,182.167586 L233.119305,177.542641 C233.119305,175.445287 233.701712,174.01601 236.70929,174.01601 L240.545311,174.014333 L240.545311,167.535091 C239.881886,167.446808 237.604784,167.24957 234.955552,167.24957 C229.424834,167.24957 225.638355,170.625526 225.638355,176.825209 L225.638355,182.167586 L219.383122,182.167586 L219.383122,189.411755 L225.638355,189.411755 L225.638355,208 L225.638355,208 Z" id="Facebook"></path>
                              </g>
                          </g>
                      </svg>
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
                                        <a href="{{$twitter}}" target="_blank">
                                          <img src="{{\App\asset_path('images/fil-twitter.svg')}}"
                                                 alt="Icône Twitter" class="twitter">
                                        </a>
                                        @if(!empty($email))
                                            <a href="mailto:{{$email}}">
                                                <img width="24px" src="{{\App\asset_path('images/mail-team.svg')}}" alt="Icône Mail" class="mail">
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
