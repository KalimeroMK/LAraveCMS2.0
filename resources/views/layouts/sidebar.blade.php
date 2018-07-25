<aside class="sidebar clearfix">

    @if(isset($ads[\App\Ads::TYPE_SIDEBAR][0]))
        <div class="widget adwidget">
            {!! $ads[\App\Ads::TYPE_SIDEBAR][0]->code !!}
        </div>
    @endif

    @if(isset($ads[\App\Ads::TYPE_SIDEBAR][1]))
        <div class="widget adwidget">
            {!! $ads[\App\Ads::TYPE_SIDEBAR][1]->code !!}
        </div>
    @endif

    <div class="widget searchwidget">
        <form action="/search" method="GET" class="searchwidget-form">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="{{trans('messages.search..')}}">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
          </span>
            </div>
        </form>
    </div>

    @if(!empty($settings_social->facebook_box_js))
        <div class="widget tabwidget">
            {!! $settings_social->facebook_box_js !!}
        </div>
    @endif

    @if(!empty($settings_social->twitter_box_js))
        <div class="widget tabwidget">
            {!! $settings_social->twitter_box_js !!}
        </div>
    @endif

    <div class="widget tagwidget">
        <h3 class="block-title"><span>{{trans('messages.tags')}}</span></h3>
        <ul class="tags-widget">
            @foreach($popular_tags as $tag)
                <li><a href="/tag/{{$tag->slug}}">{{$tag->title}}</a></li>
            @endforeach
        </ul>
    </div>


    <div class="widget reviewwidget">
        <h3 class="block-title"><span>{{trans('messages.reviews')}}</span></h3>

        @foreach($review_posts as $review)
            <article class="widget-post clearfix">
                <div class="simple-thumb">

                    @if($review->render_type == \App\Posts::RENDER_TYPE_IMAGE || $review->render_type == \App\Posts::RENDER_TYPE_GALLERY)
                        <a href="/{{$review->slug}}">
                            <img src="{{$review->featured_image}}" alt="">
                        </a>
                    @endif

                    @if($review->render_type == \App\Posts::RENDER_TYPE_VIDEO)
                        <figure class="image-overlay" style="min-height: 0px;">
                            {!! $review->video_embed_code !!}
                        </figure>
                    @endif

                </div>
                <header>
                    <h3>
                        <a href="/{{$review->slug}}">{{$review->title}}</a>
                    </h3>

                    <p class="simple-share pull-right">
           <span class="read_only_raty"
                 data-score="{{$review->average_rating}}"></span>
                    </p>
                </header>
            </article>
        @endforeach
    </div>

    @if(sizeof($global_pages) > 0)
        <div class="widget categorywidget">
            <h3 class="block-title"><span>{{trans('messages.pages')}}</span></h3>
            <ul>
                @foreach($global_pages as $page)
                    @if($page->show_in_sidebar == 1)
                        <li>
                            <a href="/page/{{$page->slug}}">{{$page->title}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    <div class="widget categorywidget">
        <h3 class="block-title"><span>{{trans('messages.categories')}}</span></h3>
        <ul>
            @foreach($global_cats as $cat)
                @if($cat->show_in_sidebar == 1)
                    <li>
                        <a href="/category/{{$cat->slug}}">{{$cat->title}} <span
                                    class="count">{{$cat->post_count}}</span></a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    @if(!empty($settings_general->mailchimp_form))
        <div class="widget adwidget subscribewidget">
            <h3 class="block-title"><span>{{trans('messages.subscribe')}}</span></h3>

            <p>{{trans('messages.we_dont_spam_loyal')}}</p>

            {!! $settings_general->mailchimp_form !!}

        </div>
    @endif

    <div class="widget social-links">
        <h3 class="block-title"><span>{{trans('messages.follow_us')}}</span></h3>
        <ul class="social-list">

            @if(strlen($settings_social->fb_page_url) > 0)
                <li class="social-facebook">
                    <a href="{{$settings_social->fb_page_url}}" data-toggle="tooltip"
                       data-placement="bottom" title=""
                       data-original-title="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
            @endif

            @if(strlen($settings_social->twitter_url) > 0)
                <li class="social-twitter" data-toggle="tooltip" data-placement="bottom" title=""
                    data-original-title="Twitter">
                    <a href="{{$settings_social->twitter_url}}">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
            @endif

            @if(strlen($settings_social->google_plus_page_url) > 0)
                <li class="social-gplus">
                    <a href="{{$settings_social->google_plus_page_url}}" data-toggle="tooltip"
                       data-placement="bottom" title=""
                       data-original-title="Google+">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </li>
            @endif

            @if(strlen($settings_social->skype_username) > 0)
                <li class="social-skype">
                    <a href="skype:{{$settings_social->skype_username}}" data-toggle="tooltip"
                       data-placement="bottom" title=""
                       data-original-title="Skype">
                        <i class="fa fa-skype"></i>
                    </a>
                </li>
            @endif

            @if(strlen($settings_social->youtube_channel_url) > 0)
                <li class="social-youtube">
                    <a href="{{$settings_social->youtube_channel_url}}" data-toggle="tooltip"
                       data-placement="bottom" title=""
                       data-original-title="Youtube">
                        <i class="fa fa-youtube"></i>
                    </a>
                </li>
            @endif

            @if($settings_general->generate_rss_feeds == 1)
                <li class="social-rss">
                    <a href="/rss.xml" data-toggle="tooltip" data-placement="bottom" title=""
                       data-original-title="RSS">
                        <i class="fa fa-rss"></i>
                    </a>
                </li>
            @endif
        </ul>
    </div>

    @for($i=2;$i<sizeof($ads[\App\Ads::TYPE_SIDEBAR]);$i++)
        @if(isset($ads[\App\Ads::TYPE_SIDEBAR][$i]))
            <div class="widget adwidget">
                {!! $ads[\App\Ads::TYPE_SIDEBAR][$i]->code !!}
            </div>
        @endif
    @endfor

</aside>
