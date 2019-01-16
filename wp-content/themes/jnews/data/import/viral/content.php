<?php

return array(

    // image
    'image' =>  array(
        'viral1' => 'http://jegtheme.com/asset/jnews/demo/default/news8.jpg',
        'viral2' => 'http://jegtheme.com/asset/jnews/demo/default/news4.jpg',
        'viral3' => 'http://jegtheme.com/asset/jnews/demo/default/news5.jpg',
        'viral4' => 'http://jegtheme.com/asset/jnews/demo/default/news6.jpg',
        'viral5' => 'http://jegtheme.com/asset/jnews/demo/default/news9.jpg',
        'viral6' => 'http://jegtheme.com/asset/jnews/demo/default/news10.jpg',
        'viral7' => 'http://jegtheme.com/asset/jnews/demo/default/news12.jpg',
        'viral8' => 'http://jegtheme.com/asset/jnews/demo/default/tech1.jpg',
        'viral9' => 'http://jegtheme.com/asset/jnews/demo/default/tech2.jpg',
        'viral10' => 'http://jegtheme.com/asset/jnews/demo/default/fashion4.jpg',
        'viral11' => 'http://jegtheme.com/asset/jnews/demo/default/fashion5.jpg',
        'viral12' => 'http://jegtheme.com/asset/jnews/demo/default/fashion6.jpg',
        'logo'  => 'http://jegtheme.com/asset/jnews/demo/viral/logo.png',
        'logo2x'  => 'http://jegtheme.com/asset/jnews/demo/viral/logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'video' =>
                array(
                    'title' =>'Video',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.'
                ),
            'life' =>
                array(
                    'title' => 'Life',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
            'tech' =>
                array(
                    'title' =>'Tech',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
            'celebs' =>
                array(
                    'title' => 'Celebs',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
            'animals' =>
                array(
                    'title' => 'Animals',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
            'buzz' =>
                array(
                    'title' => 'Buzz',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
        ),
    
        'post_tag' => array(
            'viral' => array(
                'title' => 'Viral',
            ),
            'news' => array(
                'title' => 'News',
            ),
            'entertainment' => array(
                'title' => 'Entertainment',
            ),
            'health' => array(
                'title' => 'Health'
            ),
            'art' => array(
                'title' => 'Art'
            ),
            'funny' => array(
                'title' => 'Funny'
            ),
            'split-post' => array(
                'title' => 'Split Post'
            ),
            'gaming' => array(
                'title' => 'Gaming'
            ),
            'food' => array(
                'title' => 'Food'
            ),
        )
    ),

    // post & page
    'post' => array(
        'when-you-get-another-day-off-but-suddenly-canceled' => array(
            'title' => "When you get another day-off, but suddenly canceled",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral1',
            'taxonomy' => array(
                'category' => 'life,tech,video',
                'post_tag' => 'art,entertainment,news,viral'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:life:id}}')
            )
        ),
        'this-cheat-sheets-will-actually-help-you-sleep-better' => array(
            'title' => "This Cheat Sheets Will Actually Help You Sleep Better",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'viral2',
            'taxonomy' => array(
                'category' => 'celebs,life,tech',
                'post_tag' => 'funny,health,news,viral',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:life:id}}'),
                '_format_gallery_images' => array(
                    '{{image:viral1:id}}',
                    '{{image:viral2:id}}',
                    '{{image:viral3:id}}',
                    '{{image:viral4:id}}',
                    '{{image:viral5:id}}',
                ),
            )
        ),
        '21-most-hilarious-dog-face-reactions-you-should-never-forget' => array(
            'title' => "21 Most Hilarious Dog Face Reactions You Should Never Forget",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral3',
            'taxonomy' => array(
                'category' => 'animals,buzz,life',
                'post_tag' => 'funny,health,split-post,viral'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}'),
                'jnews_single_post' => array(
                    'override_template' => '1',
                    'override' => array(
                        array(
                            'template' => '1',
                            'parallax' => '0',
                            'fullscreen' => '0',
                            'layout' => 'right-sidebar',
                            'sidebar' => 'default-sidebar',
                            'share_position' => 'bottom',
                            'share_float_style' => 'share-monocrhome',
                            'show_share_counter' => '1',
                            'show_view_counter' => '1',
                            'show_featured' => '0',
                            'show_post_meta' => '1',
                            'show_post_author' => '1',
                            'show_post_author_image' => '1',
                            'show_post_date' => '1',
                            'show_post_category' => '1',
                            'show_post_tag' => '1',
                            'show_prev_next_post' => '1',
                            'show_popup_post' => '1',
                            'show_author_box' => '1',
                            'show_post_related' => '1',
                        )
                    )
                )
            )
        ),
        'this-guy-do-ollie-over-the-barrel-and-people-reactions-is-priceless' => array(
            'title' => "This Guy Do Ollie Over The Barrel And People Reactions is Priceless",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'viral4',
            'taxonomy' => array(
                'category' => 'buzz,life,tech,video',
                'post_tag' => 'entertainment,health,news,viral',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:life:id}}'),
                'post_subtitle' => 'Health Experts Are Very Unimpressed.'
            )
        ),
        'this-dog-woke-up-and-uh-oh-shes-surrounded-by-cats' => array(
            'title' => "This Dog Woke Up And, Uh-Oh, She's Surrounded By Cats",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral5',
            'taxonomy' => array(
                'category' => 'animals,celebs,life',
                'post_tag' => 'funny,health,viral'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}')
            )
        ),
        'this-man-invent-a-fashionable-suit-for-astronaut' => array(
            'title' => "This Man Invent a Fashionable Suit for Astronaut",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'viral6',
            'taxonomy' => array(
                'category' => 'buzz,celebs,life,tech',
                'post_tag' => 'art,entertainment,news,viral'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tech:id}}')
            )
        ),
        'age-is-just-a-number-nah-its-just-a-word' => array(
            'title' => "Age is just a number? Nah, it’s just a word!",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral7',
            'taxonomy' => array(
                'category' => 'life,tech,video',
                'post_tag' => 'art,funny,health,news'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:life:id}}')
            )
        ),
        'rare-photos-of-albert-einstein-that-youve-probably-never-seen-before' => array(
            'title' => "Rare Photos Of Albert Einstein That You've Probably Never Seen Before",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'viral8',
            'taxonomy' => array(
                'category' => 'celebs,life,tech',
                'post_tag' => 'funny,health,news,viral',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:celebs:id}}'),
                '_format_gallery_images' => array(
                    '{{image:viral1:id}}',
                    '{{image:viral2:id}}',
                    '{{image:viral3:id}}',
                    '{{image:viral4:id}}',
                    '{{image:viral5:id}}',
                ),
            )
        ),
        '10-funny-cat-pictures-that-will-made-your-day' => array(
            'title' => "10 Funny Cat Pictures That Will Made Your Day",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral9',
            'taxonomy' => array(
                'category' => 'animals,buzz,tech',
                'post_tag' => 'funny,health,split-post,viral'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}'),
                'jnews_single_post' => array(
                    'override_template' => '1',
                    'override' => array(
                        array(
                            'template' => '1',
                            'parallax' => '0',
                            'fullscreen' => '0',
                            'layout' => 'right-sidebar',
                            'sidebar' => 'default-sidebar',
                            'share_position' => 'bottom',
                            'share_float_style' => 'share-monocrhome',
                            'show_share_counter' => '1',
                            'show_view_counter' => '1',
                            'show_featured' => '0',
                            'show_post_meta' => '1',
                            'show_post_author' => '1',
                            'show_post_author_image' => '1',
                            'show_post_date' => '1',
                            'show_post_category' => '1',
                            'show_post_tag' => '1',
                            'show_prev_next_post' => '1',
                            'show_popup_post' => '1',
                            'show_author_box' => '1',
                            'show_post_related' => '1',
                        )
                    )
                )
            )
        ),
        'this-guy-downed-a-bottle-of-jack-daniels-in-15-seconds' => array(
            'title' => "This Guy Downed A Bottle Of Jack Daniel’s In 15 Seconds",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'viral10',
            'taxonomy' => array(
                'category' => 'buzz,life,tech',
                'post_tag' => 'entertainment,health,news,viral'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:life:id}}'),
                'post_subtitle' => 'Health Experts Are Very Unimpressed.'
            )
        ),
        'heres-why-no-one-is-buying-smartwatches-anymore' => array(
            'title' => "Here's Why No One Is Buying Smartwatches Anymore",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral11',
            'taxonomy' => array(
                'category' => 'buzz,celebs,tech,video',
                'post_tag' => 'funny,news,viral'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tech:id}}')
            )
        ),
        '11-reasons-why-you-should-never-take-a-bath-again' => array(
            'title' => "11 Reasons Why You Should Never Take a Bath Again",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'viral12',
            'taxonomy' => array(
                'category' => 'buzz,celebs,life',
                'post_tag' => 'art,entertainment,news'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:life:id}}'),
                'post_subtitle' => 'They\'re gross, stressful, and boring.'
            )
        ),
        'this-is-the-only-camel-selfie-you-ever-need-to-see' => array(
            'title' => "This Is The Only Camel Selfie You Ever Need To See",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral1',
            'taxonomy' => array(
                'category' => 'animals,buzz,life',
                'post_tag' => 'funny,health,news,viral'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}')
            )
        ),
        'game-of-thrones-season-7-trailer-is-trully-badass' => array(
            'title' => "Game of Thrones Season 7 Trailer is Trully Badass",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'viral2',
            'taxonomy' => array(
                'category' => 'buzz,celebs,tech,video',
                'post_tag' => 'art,entertainment,viral',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:video:id}}'),
                'post_subtitle' => 'The winter is coming',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=JxWfvtnHtS0'
            )
        ),
        'this-is-how-your-dogs-spend-their-weekends' => array(
            'title' => "This is How Your Dogs Spend Their Weekends",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral3',
            'taxonomy' => array(
                'category' => 'animals,buzz,life',
                'post_tag' => 'art,entertainment,news'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}')
            )
        ),
        'youre-being-watched-without-knowing-it' => array(
            'title' => "This Lovely Cats & Dogs Gallery Will Brighten Your Day",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'viral4',
            'taxonomy' => array(
                'category' => 'animals,buzz,life,video',
                'post_tag' => 'funny,health,viral'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}')
            )
        ),
        'this-app-let-you-be-your-best-emoji-self' => array(
            'title' => "This App Let You Be Your Best Emoji Self",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral5',
            'taxonomy' => array(
                'category' => 'buzz,celebs,tech,video',
                'post_tag' => 'funny,news,viral',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tech:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=jeHwGhkw8wk'
            )
        ),
        'people-are-going-nuts-over-this-ugly-cat-after-her-owner-shared-hilariously-warped-pics' => array(
            'title' => "People Are Going Nuts Over This \"Ugly Cat\" After Her Owner Shared Hilariously Warped Pics",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'viral6',
            'taxonomy' => array(
                'category' => 'animals,celebs,life',
                'post_tag' => 'funny,health,split-post,viral'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}')
            )
        ),
        '23-celebrity-tweets-you-missed-from-the-golden-globes' => array(
            'title' => "23 Celebrity Tweets You Missed From The Golden Globes",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral7',
            'taxonomy' => array(
                'category' => 'life,tech,video',
                'post_tag' => 'art,funny,health,news'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:celebs:id}}')
            )
        ),
        'watch-this-to-prove-that-yes-cats-are-cute-but-also-giant-weirdos' => array(
            'title' => "Watch This To Prove That Yes, Cats Are Cute, But Also Giant Weirdos",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'viral8',
            'taxonomy' => array(
                'category' => 'animals,video',
                'post_tag' => 'art,entertainment,news',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=tntOCGkgt98'
            )
        ),
        'doctors-take-inspiration-from-online-dating-to-build-organ-transplant-ai' => array(
            'title' => "Doctors take inspiration from online dating to build organ transplant AI",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'viral9',
            'taxonomy' => array(
                'category' => 'life,tech,video',
                'post_tag' => 'art,funny,health,news'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:life:id}}')
            )
        ),
    
        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1491642988902{margin-top: -30px !important;}.vc_custom_1491643032803{margin-top: 20px !important;}.vc_custom_1491642981686{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1491643074286{margin-bottom: 20px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'LATEST NEWS',
                    'second_title' => '.',
                    'header_type' => 'heading_8',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '5',
                    'excerpt_length' => '20',
                    'content_date' => 'Y/m/d',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1491642988902{margin-top: -30px !important;}.vc_custom_1491643032803{margin-top: 20px !important;}.vc_custom_1491642981686{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1491643074286{margin-bottom: 20px !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1491203942694{margin-top: -30px !important;margin-bottom: 40px !important;background-color: #ebebeb !important;}.vc_custom_1491204038785{margin-bottom: 0px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'LATEST POST',
                    'second_title' => '',
                    'header_type' => 'heading_8',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '10',
                    'excerpt_length' => '38',
                    'content_date' => 'Y/m/d',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'sort_by' => 'latest',
                ),
                'jnews_video_cache' => array(
                    'IvcE4o36cAo' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=IvcE4o36cAo',
                        'id' => 'IvcE4o36cAo',
                        'title' => 'Jenggot Uban music video 04 05 2015 2',
                        'thumbnail' => 'https://i.ytimg.com/vi/IvcE4o36cAo/default.jpg',
                        'duration' => '00:03:21'
                    )
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1491203942694{margin-top: -30px !important;margin-bottom: 40px !important;background-color: #ebebeb !important;}.vc_custom_1491204038785{margin-bottom: 0px !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1491552957528{margin-top: -30px !important;}.vc_custom_1491552985666{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f5f5f5 !important;}.vc_custom_1491621159434{margin-bottom: 20px !important;}.vc_custom_1491556329136{margin-bottom: 0px !important;}.vc_custom_1491621484522{margin-top: -10px !important;}',
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1491552957528{margin-top: -30px !important;}.vc_custom_1491552985666{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f5f5f5 !important;}.vc_custom_1491621159434{margin-bottom: 20px !important;}.vc_custom_1491556329136{margin-bottom: 0px !important;}.vc_custom_1491621484522{margin-top: -10px !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1491556817361{margin-top: -30px !important;}.vc_custom_1491559171238{margin-top: 20px !important;margin-bottom: -40px !important;border-top-width: 4px !important;padding-top: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1491556807520{padding-right: 0px !important;padding-left: 0px !important;}',
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1491556817361{margin-top: -30px !important;}.vc_custom_1491559171238{margin-top: 20px !important;margin-bottom: -40px !important;border-top-width: 4px !important;padding-top: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1491556807520{padding-right: 0px !important;padding-left: 0px !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1491639935153{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #191919 !important;}.vc_custom_1491639988149{margin-bottom: 30px !important;}',
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1491639935153{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #191919 !important;}.vc_custom_1491639988149{margin-bottom: 30px !important;}'
                )
            )
        ),
        'about' => array(
            'title' => 'About',
            'content' => 'about.txt',
            'post_type' => 'page',
            'featured_image' => 'viral1',
            'metabox' => array(
                '_wp_page_template' => 'default',
                'jnews_single_page' => array(
                    'layout' => 'no-sidebar', 
                    'sidebar' => 'contact', 
                )
            )
        ),
        'contact' => array(
            'title' => 'Contact Us',
            'content' => 'contact.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'default',
                'jnews_single_page' => array(
                    'layout' => 'right-sidebar', 
                    'sidebar' => 'contact', 
                )
            )
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
    ),

    // menu it self
    'menu' => array(

        // main & mobile menu
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

        'buzz' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Buzz',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:buzz:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_2',
                    'category' => '{{category:buzz:id}}',
                    'number' => 5,
                    'trending_tag' => '{{taxonomy:post_tag:funny:id}},{{taxonomy:post_tag:gaming:id}},{{taxonomy:post_tag:health:id}},{{taxonomy:post_tag:viral:id}},{{taxonomy:post_tag:food:id}},{{taxonomy:post_tag:news:id}}',
                ),
            )
        ),

        'animals' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Animals',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:animals:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:animals:id}}',
                    'number' => 7
                ),
            )
        ),

        'celebs' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Celebs',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:celebs:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_2',
                    'category' => '{{category:celebs:id}}',
                    'number' => 5,
                    'trending_tag' => '{{taxonomy:post_tag:food:id}},{{taxonomy:post_tag:funny:id}},{{taxonomy:post_tag:gaming:id}},{{taxonomy:post_tag:health:id}},{{taxonomy:post_tag:viral:id}},{{taxonomy:post_tag:entertainment:id}}',
                ),
            )
        ),

        'life' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Life',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:life:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:life:id}}',
                    'number' => 7
                ),
            )
        ),

        'tech' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Tech',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:tech:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:tech:id}}',
                    'number' => 7
                ),
            )
        ),

        'video' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Video',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:video:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'more' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'More',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
            'about' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'About',
                    'menu-item-parent-id' => '{{menu:more:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:about:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'contact' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Contact Us',
                    'menu-item-parent-id' => '{{menu:more:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:contact:id}}',
                    'menu-item-status' => 'publish'
                )
            ),

        // footer & topbar menu
        'about-1' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'About',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:about:id}}',
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
        'contact-1' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Contact Us',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:contact:id}}',
                'menu-item-status' => 'publish'
            )
        ),
    ),

    'widget_position' => array(
        'Home',
        'Category',
        'Home 3',
        'Contact'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'contact-form-7',
        'jnews-auto-load-post',
        'jnews-breadcrumb',
        'jnews-gallery',
        'jnews-customizer-category',
        'jnews-jsonld',
        'jnews-like',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-split',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )
);
