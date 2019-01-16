<?php

return array(

    // image
    'image' =>  array(
        'fashion1' => 'http://jegtheme.com/asset/jnews/demo/default/fashion1.jpg',
        'fashion2' => 'http://jegtheme.com/asset/jnews/demo/default/fashion2.jpg',
        'fashion3' => 'http://jegtheme.com/asset/jnews/demo/default/fashion3.jpg',
        'fashion4' => 'http://jegtheme.com/asset/jnews/demo/default/fashion4.jpg',
        'fashion5' => 'http://jegtheme.com/asset/jnews/demo/default/fashion5.jpg',
        'fashion6' => 'http://jegtheme.com/asset/jnews/demo/default/fashion6.jpg',
        'travel1' => 'http://jegtheme.com/asset/jnews/demo/default/travel1.jpg',
        'travel2' => 'http://jegtheme.com/asset/jnews/demo/default/travel2.jpg',
        'travel3' => 'http://jegtheme.com/asset/jnews/demo/default/travel3.jpg',
        'travel4' => 'http://jegtheme.com/asset/jnews/demo/default/travel4.jpg',
        'travel5' => 'http://jegtheme.com/asset/jnews/demo/default/travel5.jpg',
        'travel6' => 'http://jegtheme.com/asset/jnews/demo/default/travel6.jpg',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/lifestyle/logo.png',
        'logoretina' => 'http://jegtheme.com/asset/jnews/demo/lifestyle/logoretina.png',
        'mobile' => 'http://jegtheme.com/asset/jnews/demo/lifestyle/mobile.png',
        'mobileretina' => 'http://jegtheme.com/asset/jnews/demo/lifestyle/mobileretina.png',
        'footer_logo' => 'http://jegtheme.com/asset/jnews/demo/lifestyle/footer_logo.png',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'celebrity' =>
                array(
                    'title' =>'Celebrity',
                    'description' => ''
                ),
            'culture' =>
                array(
                    'title' =>'Culture',
                    'description' => ''
                ),
            'fashion' =>
                array(
                    'title' =>'Fashion',
                    'description' => ''
                ),
                'footwear' =>
                    array(
                        'title' =>'Footwear',
                        'description' => '',
                        'parent' => 'fashion'
                    ),
            'lifestyle' =>
                array(
                    'title' =>'Lifestyle',
                    'description' => ''
                ),
                'food' =>
                    array(
                        'title' =>'Food',
                        'description' => '',
                        'parent' => 'lifestyle'
                    ),
                'health' =>
                    array(
                        'title' =>'Health',
                        'description' => '',
                        'parent' => 'lifestyle'
                    ),
                'music' =>
                    array(
                        'title' =>'Music',
                        'description' => '',
                        'parent' => 'lifestyle'
                    ),
            'travel' =>
                array(
                    'title' =>'Travel',
                    'description' => ''
                ),
        ),

        'post_tag' => array(
            'best-dressed' => array(
                'title' => 'Best Dressed'
            ),
            'celebrity-style' => array(
                'title' => 'Celebrity Style'
            ),
            'diy-fashion' => array(
                'title' => 'D.I.Y. Fashion'
            ),
            'fashion-week' => array(
                'title' => 'Fashion Week'
            ),
            'golden-globes' => array(
                'title' => 'Golden Globes'
            ),
            'oscars-2017' => array(
                'title' => 'Oscars 2017'
            ),
            'red-carpet' => array(
                'title' => 'Red Carpet'
            ),
            'runaway-look' => array(
                'title' => 'Runaway Look'
            ),
            'street-style' => array(
                'title' => 'Street Style'
            ),
        )
    ),

    // post & page
    'post' => array(
        'fashion-story-from-the-catwalk-to-your-closet' => array(
            'title' => "Fashion Story: From the Catwalk to Your Closet",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion4',
            'taxonomy' => array(
                'category' => 'celebrity,culture,fashion,lifestyle,travel',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,fashion-week,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:celebrity:id}}')
            )
        ),
        'these-delicious-balinese-street-foods-you-need-to-try-right-now' => array(
            'title' => "These delicious Balinese street foods you need to try right now",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion5',
            'taxonomy' => array(
                'category' => 'culture,food,lifestyle,travel',
                'post_tag' => 'best-dressed,celebrity-style,golden-globes,oscars-2017',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
                '_format_gallery_images' => array(
                    '{{image:travel1:id}}',
                    '{{image:travel2:id}}',
                    '{{image:travel3:id}}',
                    '{{image:travel4:id}}',
                    '{{image:travel5:id}}',
                ),
            )
        ),
        'layering-a-turtleneck-under-every-single-outfit' => array(
            'title' => "Layering a Turtleneck Under Every Single Outfit",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion6',
            'taxonomy' => array(
                'category' => 'celebrity,fashion,footwear',
                'post_tag' => 'best-dressed,celebrity-style,golden-globes,oscars-2017'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
            )
        ),
        'this-new-years-eve-unleash-your-inner-supermodel' => array(
            'title' => "This New Year’s Eve, Unleash Your Inner Supermodel",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel3',
            'taxonomy' => array(
                'category' => 'fashion,footwear,lifestyle,travel',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,fashion-week,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:footwear:id}}')
            )
        ),
        'dark-urine-could-indicate-a-liver-problem' => array(
            'title' => "Dark Urine Could Indicate a Liver Problem",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion1',
            'taxonomy' => array(
                'category' => 'culture,health,lifestyle,travel',
                'post_tag' => 'best-dressed,celebrity-style,golden-globes,oscars-2017'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'this-english-breakfast-pie-is-maybe-the-most-british-thing-ever' => array(
            'title' => "This English breakfast pie is maybe the most British thing ever",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion2',
            'taxonomy' => array(
                'category' => 'culture,food,health,lifestyle,travel',
                'post_tag' => 'best-dressed,celebrity-style,golden-globes,oscars-2017'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food:id}}')
            )
        ),
        'here-are-6-brands-and-designers-to-look-out-for-next-year' => array(
            'title' => "Here Are 6 Brands and Designers to Look Out for Next Year",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion3',
            'taxonomy' => array(
                'category' => 'celebrity,fashion,footwear',
                'post_tag' => 'best-dressed,celebrity-style,golden-globes,oscars-2017'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
            )
        ),
        'how-couples-can-solve-lighting-disagreements-for-good' => array(
            'title' => "How Couples Can Solve Lighting Disagreements for Good",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel4',
            'taxonomy' => array(
                'category' => 'celebrity,culture,lifestyle',
                'post_tag' => 'best-dressed,celebrity-style,golden-globes,oscars-2017'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
            )
        ),
        'lisa-toboggan-photoshoot-session-for-x-magazine' => array(
            'title' => "Kat Skinner Photoshoot Session for Female Magazine",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel5',
            'taxonomy' => array(
                'category' => 'celebrity,culture,footwear,lifestyle',
                'post_tag' => 'best-dressed,celebrity-style,golden-globes,oscars-2017'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'best-of-the-best-celebrity-short-hairstyle-we-love' => array(
            'title' => "Best of The Best Celebrity Short Hairstyle We Love",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel6',
            'taxonomy' => array(
                'category' => 'celebrity,fashion,food,music',
                'post_tag' => 'celebrity-style,diy-fashion,fashion-week,golden-globes,oscars-2017,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'watch-this-blogger-home-is-an-airy-inspiration' => array(
            'title' => "Watch This Blogger Home Is An Airy Inspiration",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel1',
            'taxonomy' => array(
                'category' => 'celebrity,food,music,travel',
                'post_tag' => 'celebrity-style,golden-globes,oscars-2017,runaway-look',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=V0nWI2r42eA'
            )
        ),
        'pradas-newest-sandals-are-a-lesson-in-elegant-comfort' => array(
            'title' => "Prada’s Newest Sandals Are a Lesson in Elegant Comfort",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel2',
            'taxonomy' => array(
                'category' => 'fashion,food,health,lifestyle',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,golden-globes,red-carpet,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'twitter-proves-adidas-superstars-still-dominate-fashionable-footwear' => array(
            'title' => "Twitter proves Adidas Superstars still dominate fashionable footwear",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel3',
            'taxonomy' => array(
                'category' => 'culture,footwear,lifestyle,music,travel',
                'post_tag' => 'best-dressed,fashion-week,oscars-2017,red-carpet,runaway-look,street-style',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}'),
                '_format_gallery_images' => array(
                    '{{image:travel1:id}}',
                    '{{image:travel2:id}}',
                    '{{image:travel3:id}}',
                    '{{image:travel4:id}}',
                    '{{image:travel5:id}}',
                ),
            )
        ),
        'instead-of-a-suitcase-just-put-everything-in-this-jacket' => array(
            'title' => "Instead of a Suitcase Just Put Everything in This Jacket",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion4',
            'taxonomy' => array(
                'category' => 'fashion,lifestyle,travel',
                'post_tag' => 'celebrity-style,diy-fashion,golden-globes,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'gynopedia-helps-travelers-find-health-care-everywhere' => array(
            'title' => "Gynopedia Helps Travelers Find  Health Care Everywhere",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion5',
            'taxonomy' => array(
                'category' => 'fashion,health,lifestyle,travel',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,golden-globes,oscars-2017,red-carpet'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'the-10-best-products-to-drop-this-week-where-to-buy-them' => array(
            'title' => "The 10 Best Products to Drop This Week & Where to Buy Them",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion6',
            'taxonomy' => array(
                'category' => 'health,lifestyle,music,travel',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,fashion-week,golden-globes,runaway-look'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'top-hairstyle-you-should-follow-this-summer' => array(
            'title' => "Top Hairstyle You Should Follow This Summer",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion1',
            'taxonomy' => array(
                'category' => 'celebrity,culture,footwear,lifestyle',
                'post_tag' => 'best-dressed,celebrity-style,golden-globes,oscars-2017'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'all-the-celebrity-looks-from-the-oscars-2017-red-carpet' => array(
            'title' => "All the Celebrity Looks from the Oscars 2017 Red Carpet",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion2',
            'taxonomy' => array(
                'category' => 'fashion,footwear,health,travel',
                'post_tag' => 'fashion-week,oscars-2017,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'the-best-celebrity-photobombs-of-all-time' => array(
            'title' => "The Best Celebrity Photobombs of All Time",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion3',
            'taxonomy' => array(
                'category' => 'celebrity,fashion,food,music',
                'post_tag' => 'celebrity-style,diy-fashion,fashion-week,golden-globes,oscars-2017,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'gigi-hadid-takes-the-pussyhat-to-the-runway-at-milan-fashion-week' => array(
            'title' => "Gigi Hadid takes the pussyhat to the runway at Milan Fashion Week",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel4',
            'taxonomy' => array(
                'category' => 'celebrity,food,music,travel',
                'post_tag' => 'best-dressed,diy-fashion,fashion-week,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'florence-and-the-machines-opera-house-show-fined-for-being-too-loud' => array(
            'title' => "Florence and the Machine's Opera House show fined for being too loud",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel5',
            'taxonomy' => array(
                'category' => 'fashion,food,health,music',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,fashion-week,red-carpet,runaway-look'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'emma-watson-just-found-a-new-earth-friendly-way-to-be-fabulous' => array(
            'title' => "Emma Watson just found a new, Earth-friendly way to be fabulous",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel6',
            'taxonomy' => array(
                'category' => 'food,health,music,travel',
                'post_tag' => 'celebrity-style,diy-fashion,fashion-week,golden-globes,oscars-2017,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'the-oscars-red-carpet-was-its-own-live-action-beauty-and-the-beast' => array(
            'title' => "The Oscars red carpet was its own live action 'Beauty and the Beast'",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel1',
            'taxonomy' => array(
                'category' => 'celebrity,health,lifestyle,music',
                'post_tag' => 'celebrity-style,diy-fashion,fashion-week,oscars-2017,red-carpet,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'heres-some-of-the-best-sneakers-on-display-at-london-fashion-week' => array(
            'title' => "Here’s Some of the Best Sneakers on Display at London Fashion Week",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel2',
            'taxonomy' => array(
                'category' => 'fashion,footwear,lifestyle,music',
                'post_tag' => 'best-dressed,diy-fashion,fashion-week,oscars-2017,red-carpet,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'watch-this-aerogel-insulated-jacket-withstand-liquid-nitrogen' => array(
            'title' => "Watch this Aerogel Insulated Jacket withstand Liquid Nitrogen",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel3',
            'taxonomy' => array(
                'category' => 'food,health,lifestyle,music',
                'post_tag' => 'best-dressed,fashion-week,golden-globes,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'your-bff-emma-stone-wore-a-planned-parenthood-pin-to-the-oscars' => array(
            'title' => "Your BFF Emma Stone wore a Planned Parenthood pin to the Oscars",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion4',
            'taxonomy' => array(
                'category' => 'celebrity,footwear,health,lifestyle',
                'post_tag' => 'best-dressed,diy-fashion,fashion-week,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'a-detailed-look-at-the-1984-seiko-chariot-steve-jobs-watch' => array(
            'title' => "A Detailed Look at the 1984 Seiko Chariot ‘Steve Jobs’ Watch",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion5',
            'taxonomy' => array(
                'category' => 'food,footwear,lifestyle,travel',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,fashion-week,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1488792112495{margin-top: -30px !important;background-color: #212121 !important;}.vc_custom_1488853361713{margin-top: -40px !important;margin-bottom: 50px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;}.vc_custom_1488185113339{padding-right: 0px !important;padding-left: 0px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'second_title' => '',
                    'header_type' => 'heading_8',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '5',
                    'excerpt_length' => '30',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_2',
                    'pagination_align' => 'center',
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1488792112495{margin-top: -30px !important;background-color: #212121 !important;}.vc_custom_1488853361713{margin-top: -40px !important;margin-bottom: 50px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;}.vc_custom_1488185113339{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1488185113339 .jeg_slider_wrapper{margin-bottom: 0;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1488859679196{border-top-width: 2px !important;padding-top: 15px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1488859848070{border-top-width: 2px !important;border-bottom-width: 2px !important;padding-top: 30px !important;padding-bottom: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'second_title' => '',
                    'header_type' => 'heading_8',
                    'layout' => 'no-sidebar',
                    'sidebar' => 'default-sidebar',
                    'module'    => '23',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'show_navtext' => '0',
                    'show_pageinfo' => '0',
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1488859679196{border-top-width: 2px !important;padding-top: 15px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1488859848070{border-top-width: 2px !important;border-bottom-width: 2px !important;padding-top: 30px !important;padding-bottom: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1488876706692{margin-top: 30px !important;margin-bottom: 40px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;}.vc_custom_1488876415412{margin-bottom: -25px !important;}.vc_custom_1488876817660{margin-bottom: 20px !important;}.vc_custom_1488877463680{margin-bottom: 40px !important;}.vc_custom_1488876406975{margin-bottom: 0px !important;}',
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1488876706692{margin-top: 30px !important;margin-bottom: 40px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;}.vc_custom_1488876415412{margin-bottom: -25px !important;}.vc_custom_1488876817660{margin-bottom: 20px !important;}.vc_custom_1488877463680{margin-bottom: 40px !important;}.vc_custom_1488876406975{margin-bottom: 0px !important;}.jeg_block_heading.jeg_block_heading_5{width: 350px;margin: 0 auto;}.jeg_block_heading.jeg_block_heading_5 .jeg_block_title {font-weight: 400;font-family: Lato;font-size: 14px;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1488879490890{padding: 30px !important;background-color: #f5f5f5 !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'second_title' => '',
                    'header_type' => 'heading_8',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-4',
                    'module'    => '6',
                    'excerpt_length' => '30',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_2',
                    'pagination_align' => 'center',
                    'show_navtext' => '1',
                    'show_pageinfo' => '0',
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1488879490890{padding: 30px !important;background-color: #f5f5f5 !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1488961940788{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #f5f5f5 !important;}.vc_custom_1488961957415{margin-bottom: 40px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;background-position: 0 0 !important;background-repeat: repeat !important;}.vc_custom_1488961575054{margin-bottom: 30px !important;}.vc_custom_1488939606445{border-top-width: 2px !important;padding-top: 25px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1488962382128{border-top-width: 2px !important;padding-top: 30px !important;border-top-color: #121212 !important;border-top-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest.',
                    'second_title' => '',
                    'header_type' => 'heading_8',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-5',
                    'module'    => '3',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'show_navtext' => '0',
                    'show_pageinfo' => '0',
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1488961940788{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #f5f5f5 !important;}.vc_custom_1488961957415{margin-bottom: 40px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;background-position: 0 0 !important;background-repeat: repeat !important;}.vc_custom_1488961575054{margin-bottom: 30px !important;}.vc_custom_1488939606445{border-top-width: 2px !important;padding-top: 25px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1488962382128{border-top-width: 2px !important;padding-top: 30px !important;border-top-color: #121212 !important;border-top-style: solid !important;}.jeg_block_heading.jeg_block_heading_5{width: 350px;margin: 0 auto;}.jeg_block_heading.jeg_block_heading_5 .jeg_block_title {font-weight: 400;font-family: Lato;font-size: 14px;}'
                )
            )
        )
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

        // main menu
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

        'fashion' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Fashion',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:fashion:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'footwear' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Footwear',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:footwear:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'celebrity' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Celebrity',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:celebrity:id}}',
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

        'lifestyle' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'lifestyle',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:lifestyle:id}}',
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

        'food' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Food',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:food:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        // footer & topbar menu
        'about' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'About',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'shop' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Shop',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'forum' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Forum',
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

    ),

    'widget_position' => array(
        'Home',
        'Home 4',
        'Home 5'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'jnews-breadcrumb',
        'jnews-instagram',
        'jnews-jsonld',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )

);