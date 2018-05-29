<?php

return array(

    // image
    'image' =>  array(
        'personal1' => 'http://jegtheme.com/asset/jnews/demo/default/fashion1.jpg',
        'personal2' => 'http://jegtheme.com/asset/jnews/demo/default/fashion2.jpg',
        'personal3' => 'http://jegtheme.com/asset/jnews/demo/default/fashion3.jpg',
        'personal4' => 'http://jegtheme.com/asset/jnews/demo/default/fashion4.jpg',
        'personal5' => 'http://jegtheme.com/asset/jnews/demo/default/fashion5.jpg',
        'personal6' => 'http://jegtheme.com/asset/jnews/demo/default/fashion6.jpg',
        'personal7' => 'http://jegtheme.com/asset/jnews/demo/default/travel1.jpg',
        'personal8' => 'http://jegtheme.com/asset/jnews/demo/default/travel2.jpg',
        'personal9' => 'http://jegtheme.com/asset/jnews/demo/default/travel3.jpg',
        'about' => 'http://jegtheme.com/asset/jnews/demo/personal/about.jpg',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/personal/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/personal/logo@2x.png',
        'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/personal/mobile_logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/personal/mobile_logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'inspiration' =>
                array(
                    'title' =>'Inspiration',
                    'description' => 'You can add some category description here.'
                ),
            'travel' =>
                array(
                    'title' =>'Travel',
                    'description' => 'You can add some category description here.'
                ),
            'lifestyle' =>
                array(
                    'title' =>'Lifestyle',
                    'description' => 'You can add some category description here.'
                ),
            'culture' =>
                array(
                    'title' =>'Culture',
                    'description' => 'You can add some category description here.'
                ),
            'photography' =>
                array(
                    'title' =>'Photography',
                    'description' => 'You can add some category description here.'
                ),
        ),

        'post_tag' => array(
        )
    ),

    // post & page
    'post' => array(
        'why-you-shouldnt-be-terrible-at-what-you-love' => array(
            'title' => "Why You Shouldn’t Be <strong><em>Terrible</em></strong> <em>at</em> What You Love",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal1',
            'taxonomy' => array(
                'category' => 'inspiration,photography',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:photography:id}}')
            )
        ),
        'the-slow-death-of-silicon-valley' => array(
            'title' => "The Slow Death of Silicon Valley",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal2',
            'taxonomy' => array(
                'category' => 'culture,lifestyle,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
            )
        ),
        'say-youre-sorry-with-the-right-flowers' => array(
            'title' => "Say You’re Sorry <em>with</em> The Right Flowers",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal3',
            'taxonomy' => array(
                'category' => 'culture,inspiration',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
            )
        ),
        'dont-follow-lifestyle-that-you-cant-afford' => array(
            'title' => "Don’t Follow <strong>Lifestyle</strong> That You <em>Can’t Afford</em>",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal4',
            'taxonomy' => array(
                'category' => 'culture,lifestyle',
                'post_tag' => '',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=BtVtYSm3bJY'
            )
        ),
        'two-ways-to-maximise-your-creative-output' => array(
            'title' => "Two Ways to <strong>Maximise</strong> Your <em>Creative Output</em>",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal5',
            'taxonomy' => array(
                'category' => 'inspiration,photography',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
            )
        ),
        'daily-tips-a-beginners-guide-to-photography' => array(
            'title' => "<em>Daily Tips</em>: A Beginner’s Guide <em>to</em> <strong>Photography</strong>",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal6',
            'taxonomy' => array(
                'category' => 'photography,travel',
                'post_tag' => '',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:photography:id}}'),
                '_format_gallery_images' => array(
                    '{{image:personal1:id}}',
                    '{{image:personal2:id}}',
                    '{{image:personal3:id}}',
                    '{{image:personal4:id}}',
                    '{{image:personal5:id}}',
                ),
            )
        ),
        'preparing-for-the-holidays-photoshoot-session' => array(
            'title' => "Preparing <em>for</em> the <strong>Holidays</strong> Photoshoot Session",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal7',
            'taxonomy' => array(
                'category' => 'photography,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:photography:id}}')
            )
        ),
        'the-essentials-things-to-carry' => array(
            'title' => "The <strong>Essentials Things</strong> <em>to</em> Carry",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal8',
            'taxonomy' => array(
                'category' => 'culture,lifestyle,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:culture:id}}')
            )
        ),
        'make-something-even-if-you-dont-feel-like-it' => array(
            'title' => "Make Something Even If You Don’t Feel Like It",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal9',
            'taxonomy' => array(
                'category' => 'inspiration,photography',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:photography:id}}')
            )
        ),
        'keeping-the-head-and-heart-happy' => array(
            'title' => "Keeping The Head and Heart Happy",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal1',
            'taxonomy' => array(
                'category' => 'lifestyle,photography',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
            )
        ),
        'prime-your-thinking-for-success' => array(
            'title' => "Prime Your Thinking <em>for</em> <strong>Success</strong>",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal2',
            'taxonomy' => array(
                'category' => 'inspiration,lifestyle',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
            )
        ),
        'lose-weight-with-this-breakfast' => array(
            'title' => "Lose Weight <em>with</em> This Breakfast",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal3',
            'taxonomy' => array(
                'category' => 'culture,lifestyle',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
            )
        ),
        'what-rejection-taught-me-about-doing-the-work' => array(
            'title' => "What Rejection Taught Me About Doing the Work",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal4',
            'taxonomy' => array(
                'category' => 'culture,inspiration,photography',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
            )
        ),
        'daily-tips-6-keys-to-reveal-your-passion-as-a-writer' => array(
            'title' => "<em>Daily Tips</em>: 6 Keys To Reveal Your Passion As A <strong><em>Writer</em></strong>",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal5',
            'taxonomy' => array(
                'category' => 'inspiration,lifestyle,photography',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
            )
        ),
        'what-your-gap-fragrance-said-about-you' => array(
            'title' => "What Your <strong><em>Gap Fragrance</em></strong> Said About You",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal6',
            'taxonomy' => array(
                'category' => 'lifestyle,photography,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
            )
        ),
        'daily-tips-one-thing-you-can-do-today' => array(
            'title' => "<em>Daily Tips</em>: One Thing You Can <strong>Do Today</strong>",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal7',
            'taxonomy' => array(
                'category' => 'inspiration,photography,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
            )
        ),
        'this-breakfast-is-maybe-the-most-british-thing-ever' => array(
            'title' => "This Breakfast is Maybe the Most British Thing Ever",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal8',
            'taxonomy' => array(
                'category' => 'culture,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}')
            )
        ),
        'travel-diary-throwback-to-lembongan' => array(
            'title' => "<strong>Travel Diary</strong>: Throwback <em>to</em> Lembongan",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal9',
            'taxonomy' => array(
                'category' => 'culture,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:culture:id}}')
            )
        ),
        'pink-bomber-spring-jacket' => array(
            'title' => "Pink Bomber <strong><em>Spring Jacket</em></strong>",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal1',
            'taxonomy' => array(
                'category' => 'inspiration,lifestyle',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}')
            )
        ),
        'the-long-road-to-mastery' => array(
            'title' => "The Long Road to Mastery",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal2',
            'taxonomy' => array(
                'category' => 'inspiration,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}')
            )
        ),
        'how-to-travel-the-world-as-a-developer' => array(
            'title' => "How to Travel The World as a Developer",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal3',
            'taxonomy' => array(
                'category' => 'inspiration,lifestyle,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}')
            )
        ),
        'top-hairstyle-you-should-follow-this-summer' => array(
            'title' => "Top Hairstyle You Should Follow This Summer",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal4',
            'taxonomy' => array(
                'category' => 'culture,lifestyle,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}')
            )
        ),
        'things-to-learn-after-marriage' => array(
            'title' => "Things <em>to</em> Learn After Marriage",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal5',
            'taxonomy' => array(
                'category' => 'culture,inspiration',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:culture:id}}')
            )
        ),
        'a-photoshoot-session-with-jennifer-pigeon' => array(
            'title' => "A <strong>Photoshoot Session</strong> <em>with</em> Jennifer Pigeon",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal6',
            'taxonomy' => array(
                'category' => 'photography,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:photography:id}}')
            )
        ),
        'candy-is-better-for-you-than-you-thought' => array(
            'title' => "Candy Is Better <em>for</em> You Than You Thought",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal7',
            'taxonomy' => array(
                'category' => 'culture,inspiration,lifestyle',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
            )
        ),
        'how-i-learned-to-self-love' => array(
            'title' => "How I Learned to Self Love",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal8',
            'taxonomy' => array(
                'category' => 'culture,inspiration',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
            )
        ),
        'the-story-how-i-become-a-fulltime-blogger' => array(
            'title' => "<em>The Story</em>: How I Become a <strong><em>Fulltime Blogger</em></strong>",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal9',
            'taxonomy' => array(
                'category' => 'inspiration,lifestyle',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
            )
        ),
        'kat-skinner-photoshoot-session' => array(
            'title' => "Kat Skinner Photoshoot Session",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal1',
            'taxonomy' => array(
                'category' => 'culture,lifestyle,travel',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}')
            )
        ),
        'best-of-the-best-celebrity-short-hairstyle-we-love' => array(
            'title' => "Best of The Best Celebrity Short Hairstyle We Love",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'personal2',
            'taxonomy' => array(
                'category' => 'culture,inspiration,lifestyle',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
            )
        ),
        'fashion-story-from-the-catwalk-to-your-closet' => array(
            'title' => "Fashion Story: From the Catwalk to Your Closet",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'personal3',
            'taxonomy' => array(
                'category' => 'lifestyle,photography',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
            )
        ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497338445929{margin-top: 60px !important;margin-bottom: 0px !important;}.vc_custom_1497338367440{margin-top: 15px !important;}.vc_custom_1497338419229{margin-right: 25% !important;margin-bottom: 70px !important;margin-left: 25% !important;}.vc_custom_1506044319036{margin-top: 30px !important;margin-bottom: 40px !important;border-top-width: 6px !important;border-right-width: 6px !important;border-bottom-width: 6px !important;border-left-width: 6px !important;border-left-color: #f3f3f3 !important;border-left-style: solid !important;border-right-color: #f3f3f3 !important;border-right-style: solid !important;border-top-color: #f3f3f3 !important;border-top-style: solid !important;border-bottom-color: #f3f3f3 !important;border-bottom-style: solid !important;}.vc_custom_1497338270333{margin-top: -40px !important;margin-right: -80px !important;margin-bottom: 30px !important;margin-left: -80px !important;}.vc_custom_1506043888167{margin-top: 20px !important;margin-bottom: 0px !important;}.vc_custom_1506043731337{margin-top: 15px !important;}.vc_custom_1506043984803{margin-right: 10% !important;margin-bottom: 70px !important;margin-left: 10% !important;}.vc_custom_1506043766872{margin-top: 10px !important;margin-bottom: 40px !important;border-top-width: 6px !important;border-right-width: 6px !important;border-bottom-width: 6px !important;border-left-width: 6px !important;border-left-color: #f3f3f3 !important;border-left-style: solid !important;border-right-color: #f3f3f3 !important;border-right-style: solid !important;border-top-color: #f3f3f3 !important;border-top-style: solid !important;border-bottom-color: #f3f3f3 !important;border-bottom-style: solid !important;}.vc_custom_1506043710461{margin-top: -40px !important;margin-bottom: 30px !important;}.vc_custom_1497001040372{margin-top: -40px !important;margin-bottom: 60px !important;border-bottom-width: 1px !important;padding-top: 40px !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'second_title' => '',
                    'header_type' => 'heading_7',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-1-loop',
                    'module'    => '27',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497338445929{margin-top: 60px !important;margin-bottom: 0px !important;}.vc_custom_1497338367440{margin-top: 15px !important;}.vc_custom_1497338419229{margin-right: 25% !important;margin-bottom: 70px !important;margin-left: 25% !important;}.vc_custom_1506044319036{margin-top: 30px !important;margin-bottom: 40px !important;border-top-width: 6px !important;border-right-width: 6px !important;border-bottom-width: 6px !important;border-left-width: 6px !important;border-left-color: #f3f3f3 !important;border-left-style: solid !important;border-right-color: #f3f3f3 !important;border-right-style: solid !important;border-top-color: #f3f3f3 !important;border-top-style: solid !important;border-bottom-color: #f3f3f3 !important;border-bottom-style: solid !important;}.vc_custom_1497338270333{margin-top: -40px !important;margin-right: -80px !important;margin-bottom: 30px !important;margin-left: -80px !important;}.vc_custom_1506043888167{margin-top: 20px !important;margin-bottom: 0px !important;}.vc_custom_1506043731337{margin-top: 15px !important;}.vc_custom_1506043984803{margin-right: 10% !important;margin-bottom: 70px !important;margin-left: 10% !important;}.vc_custom_1506043766872{margin-top: 10px !important;margin-bottom: 40px !important;border-top-width: 6px !important;border-right-width: 6px !important;border-bottom-width: 6px !important;border-left-width: 6px !important;border-left-color: #f3f3f3 !important;border-left-style: solid !important;border-right-color: #f3f3f3 !important;border-right-style: solid !important;border-top-color: #f3f3f3 !important;border-top-style: solid !important;border-bottom-color: #f3f3f3 !important;border-bottom-style: solid !important;}.vc_custom_1506043710461{margin-top: -40px !important;margin-bottom: 30px !important;}.vc_custom_1497001040372{margin-top: -40px !important;margin-bottom: 60px !important;border-bottom-width: 1px !important;padding-top: 40px !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497089681409{margin-top: -30px !important;padding-right: 50px !important;padding-left: 50px !important;}.vc_custom_1497248707893{padding-right: 50px !important;padding-left: 50px !important;}.vc_custom_1497249374297{margin-top: 40px !important;margin-bottom: 0px !important;}.vc_custom_1497063457904{margin-top: 15px !important;}.vc_custom_1497063494388{margin-right: 10% !important;margin-bottom: 70px !important;margin-left: 10% !important;}.vc_custom_1497063494389{margin-right: 25% !important;margin-bottom: 70px !important;margin-left: 25% !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'second_title' => '',
                    'header_type' => 'heading_7',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '10',
                    'excerpt_length' => '50',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497089681409{padding-right: 50px !important;padding-left: 50px !important;}.vc_custom_1497248707893{padding-right: 50px !important;padding-left: 50px !important;}.vc_custom_1497249374297{margin-top: 40px !important;margin-bottom: 0px !important;}.vc_custom_1497063457904{margin-top: 15px !important;}.vc_custom_1497063494388{margin-right: 10% !important;margin-bottom: 70px !important;margin-left: 10% !important;}.vc_custom_1497063494389{margin-right: 25% !important;margin-bottom: 70px !important;margin-left: 25% !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497339642400{margin-top: -30px !important;}.vc_custom_1497341590743{margin-top: 20px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 30px !important;padding-bottom: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'second_title' => '',
                    'header_type' => 'heading_7',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '26',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497339642400{margin-top: -30px !important;}.vc_custom_1497341590743{margin-top: 20px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 30px !important;padding-bottom: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497349683941{margin-top: -30px !important;background-color: #f5f5f5 !important;}.vc_custom_1488350648412{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1497349209724{margin-bottom: 0px !important;}.vc_custom_1497411956757{margin-bottom: 50px !important;padding-top: 25px !important;padding-right: 25px !important;padding-bottom: 25px !important;padding-left: 25px !important;background-color: #f5f5f5 !important;}.vc_custom_1497433437186{margin-bottom: 0px !important;}.vc_custom_1506050170098{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1506051609521{margin-bottom: 0px !important;}',
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497349683941{margin-top: -30px !important;background-color: #f5f5f5 !important;}.vc_custom_1488350648412{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1497349209724{margin-bottom: 0px !important;}.vc_custom_1497411956757{margin-bottom: 50px !important;padding-top: 25px !important;padding-right: 25px !important;padding-bottom: 25px !important;padding-left: 25px !important;background-color: #f5f5f5 !important;}.vc_custom_1497433437186{margin-bottom: 0px !important;}.vc_custom_1506050170098{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1506051609521{margin-bottom: 0px !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'second_title' => '',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-5',
                    'module'    => '27',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                ),
                '_elementor_data' => '',
                '_elementor_edit_mode' => 'builder'
            )
        ),
        'contact' => array(
            'title' => 'Contact',
            'content' => 'contact.txt',
            'post_type' => 'page',
        ),
    ),

    // menu location
    'menu_location' => array(
        'main-navigation' => array(
            'title' => 'Main Navigation',
            'location' => 'navigation'
        ),
        'footer-navigation' => array(
            'title' => 'Footer Navigation',
            'location' => 'footer_navigation'
        ),
        'mobile-navigation' => array(
            'title' => 'Mobile Navigation',
            'location' => 'mobile_navigation'
        )
    ),

    // menu it self
    'menu' => array(

        // Main Menu
        'home' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Home',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:home-1:id}}',
                'menu-item-status' => 'publish'
            )
        ),
            'home-1' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Home - Layout 1',
                    'menu-item-parent-id' => '{{menu:home:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:home-1:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'home-2' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Home - Layout 2',
                    'menu-item-parent-id' => '{{menu:home:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:home-2:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'home-3' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Home - Layout 3',
                    'menu-item-parent-id' => '{{menu:home:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:home-3:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'home-4' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Home - Layout 4',
                    'menu-item-parent-id' => '{{menu:home:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:home-4:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'home-5' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Home - Layout 5',
                    'menu-item-parent-id' => '{{menu:home:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:home-5:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
        'inspiration' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Inspiration',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:inspiration:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'travel' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Travel',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:travel:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'lifestyle' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Lifestyle',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:lifestyle:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'culture' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Culture',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:culture:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'photography' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Photography',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:photography:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'shop' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Shop',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
            'checkout' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Checkout',
                    'menu-item-parent-id' => '{{menu:shop:id}}',
                    'menu-item-type' => 'custom',
                    'menu-item-url' => '#',
                    'menu-item-status' => 'publish'
                )
            ),
            'cart' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Cart',
                    'menu-item-parent-id' => '{{menu:shop:id}}',
                    'menu-item-type' => 'custom',
                    'menu-item-url' => '#',
                    'menu-item-status' => 'publish'
                )
            ),

        // Footer & Topbar Menu
        'about' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'About',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'advertise' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Advertise',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'privacy-and-policy' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Privacy & Policy',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'contact' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Contact',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),

        // Mobile Menu
        'home-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Home',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:home-1:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'shop-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Shop',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'inspiration-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Inspiration',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:inspiration:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'lifestyle-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Lifestyle',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:lifestyle:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'culture-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Culture',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:culture:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'travel-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Travel',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:travel:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'photography-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Photography',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:photography:id}}',
                'menu-item-status' => 'publish'
            )
        ),
    ),

    'widget_position' => array(
        'Home',
        'Home 1',
        'Home 1 - Loop',
        'Home 5',
        'Shop'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'contact-form-7',
        'jnews-instagram',
        'jnews-customizer-category',
        'jnews-jsonld',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )

);