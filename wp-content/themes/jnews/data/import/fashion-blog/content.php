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
        'logo' => 'http://jegtheme.com/asset/jnews/demo/fashion-blog/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/fashion-blog/logo@2x.png',
        'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/fashion-blog/mobile_logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/fashion-blog/mobile_logo@2x.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'fashion' =>
                array(
                    'title' =>'Fashion',
                    'description' => ''
                ),
            'beauty' =>
                array(
                    'title' =>'Beauty',
                    'description' => ''
                ),
                'makeup' =>
                    array(
                        'title' =>'Makeup',
                        'description' => '',
                        'parent' => 'beauty'
                    ),
                'hair' =>
                    array(
                        'title' =>'Hair',
                        'description' => '',
                        'parent' => 'beauty'
                    ),
                'skin-care' =>
                    array(
                        'title' =>'Skin Care',
                        'description' => '',
                        'parent' => 'beauty'
                    ),
                'health-and-fitness' =>
                    array(
                        'title' =>'Health & Fitness',
                        'description' => '',
                        'parent' => 'beauty'
                    ),
            'celebrity' =>
                array(
                    'title' =>'Celebrity',
                    'description' => ''
                ),
            'travel' =>
                array(
                    'title' =>'Travel',
                    'description' => ''
                ),
            'lifestyle' =>
                array(
                    'title' =>'Lifestyle',
                    'description' => ''
                ),

        ),

        'post_tag' => array(
            'fashion-week' => array(
                'title' => 'Fashion Week'
            ),
            'golden-globes' => array(
                'title' => 'Golden Globes'
            ),
            'oscars-2017' => array(
                'title' => 'Oscars 2017'
            ),
            'street-style' => array(
                'title' => 'Street Style'
            ),
            'red-carpet' => array(
                'title' => 'Red Carpet'
            ),
            'best-dressed' => array(
                'title' => 'Best Dressed'
            ),
            'celebrity-style' => array(
                'title' => 'Celebrity Style'
            ),
            'runaway-look' => array(
                'title' => 'Runaway Look'
            ),
            'diy-fashion' => array(
                'title' => 'D.I.Y. Fashion'
            ),

        )
    ),

    // post & page
    'post' => array(
        'lisa-toboggan-photoshoot-session-for-x-magazine' => array(
            'title' => "Kat Skinner <strong>Photoshoot Session</strong> for Female <em>Magazine</em>",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion1',
            'taxonomy' => array(
                'category' => 'beauty,celebrity,hair,lifestyle',
                'post_tag' => 'best-dressed,celebrity-style,golden-globes,oscars-2017'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:hair:id}}')
            )
        ),
        'best-of-the-best-celebrity-short-hairstyle-we-love' => array(
            'title' => "<strong>Best <em>of</em> The Best</strong> Celebrity <em>Short Hairstyle</em> We Love",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion2',
            'taxonomy' => array(
                'category' => 'celebrity,fashion,makeup,skin-care',
                'post_tag' => 'celebrity-style,diy-fashion,fashion-week,golden-globes,oscars-2017,street-style',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:celebrity:id}}'),
                '_format_gallery_images' => array(
                    '{{image:travel1:id}}',
                    '{{image:travel2:id}}',
                    '{{image:travel3:id}}',
                    '{{image:travel4:id}}',
                    '{{image:travel5:id}}',
                ),
            )
        ),
        'watch-this-blogger-home-is-an-airy-inspiration' => array(
            'title' => "Watch This <strong>Blogger Home</strong> Is An Airy <em>Inspiration</em>",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion3',
            'taxonomy' => array(
                'category' => 'celebrity,makeup,skin-care,travel',
                'post_tag' => 'celebrity-style,golden-globes,oscars-2017,runaway-look',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:celebrity:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=V0nWI2r42eA'
            )
        ),
        'pradas-newest-sandals-are-a-lesson-in-elegant-comfort' => array(
            'title' => "<em>Prada\'s</em> Newest Sandals Are a <strong>Lesson</strong> in Elegant Comfort",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion4',
            'taxonomy' => array(
                'category' => 'fashion,health-and-fitness,lifestyle,skin-care',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,golden-globes,red-carpet,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'twitter-proves-adidas-superstars-still-dominate-fashionable-footwear' => array(
            'title' => "Twitter proves <strong>Adidas Superstars</strong> still dominate <em>fashionable</em> footwear",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion5',
            'taxonomy' => array(
                'category' => 'beauty,hair,lifestyle,makeup,travel',
                'post_tag' => 'best-dressed,fashion-week,oscars-2017,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
            )
        ),
        'instead-of-a-suitcase-just-put-everything-in-this-jacket' => array(
            'title' => "Instead <em>of</em> a Suitcase Just Put Everything in <strong><em>This Jacket</em></strong>",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion6',
            'taxonomy' => array(
                'category' => 'fashion,lifestyle,travel',
                'post_tag' => 'celebrity-style,diy-fashion,golden-globes,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
            )
        ),
        'gynopedia-helps-travelers-find-health-care-everywhere' => array(
            'title' => "<strong>Gynopedia</strong> Helps Travelers Find Health Care <em>Everywhere</em>",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel1',
            'taxonomy' => array(
                'category' => 'fashion,health-and-fitness,lifestyle,travel',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,golden-globes,oscars-2017,red-carpet'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}')
            )
        ),
        'the-10-best-products-to-drop-this-week-where-to-buy-them' => array(
            'title' => "The 10 <strong>Best Products</strong> to Drop This Week <em>&</em> Where to Buy Them",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel2',
            'taxonomy' => array(
                'category' => 'health-and-fitness,lifestyle,makeup,travel',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,fashion-week,golden-globes,runaway-look'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:makeup:id}}')
            )
        ),
        'top-hairstyle-you-should-follow-this-summer' => array(
            'title' => "<strong>Top Hairstyle</strong> You Should <em>Follow</em> This Summer",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel3',
            'taxonomy' => array(
                'category' => 'beauty,celebrity,hair,lifestyle',
                'post_tag' => 'best-dressed,celebrity-style,golden-globes,oscars-2017'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:hair:id}}')
            )
        ),
        'all-the-celebrity-looks-from-the-oscars-2017-red-carpet' => array(
            'title' => "All the <strong>Celebrity Looks</strong> <em>from</em> the Oscars 2017 Red Carpet",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel4',
            'taxonomy' => array(
                'category' => 'fashion,hair,health-and-fitness,travel',
                'post_tag' => 'fashion-week,oscars-2017,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
            )
        ),
        'the-best-celebrity-photobombs-of-all-time' => array(
            'title' => "The Best <strong>Celebrity</strong> Photobombs <em>of</em> All Time",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel5',
            'taxonomy' => array(
                'category' => 'celebrity,fashion,makeup,skin-care',
                'post_tag' => 'celebrity-style,diy-fashion,fashion-week,golden-globes,oscars-2017,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:celebrity:id}}')
            )
        ),
        'gigi-hadid-takes-the-pussyhat-to-the-runway-at-milan-fashion-week' => array(
            'title' => "<strong>Gigi Hadid</strong> takes the <em>pussyhat</em> to the runway <em>at</em> <strong>Milan Fashion Week</strong>",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel6',
            'taxonomy' => array(
                'category' => 'celebrity,makeup,skin-care,travel',
                'post_tag' => 'best-dressed,diy-fashion,fashion-week,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:makeup:id}}')
            )
        ),
        'florence-and-the-machines-opera-house-show-fined-for-being-too-loud' => array(
            'title' => "<strong>Florence</strong> and the <strong>Machine\'s</strong> <em>Opera House</em> show fined for being too loud",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion1',
            'taxonomy' => array(
                'category' => 'fashion,health-and-fitness,makeup,skin-care',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,fashion-week,red-carpet,runaway-look'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
            )
        ),
        'emma-watson-just-found-a-new-earth-friendly-way-to-be-fabulous' => array(
            'title' => "<strong>Emma Watson</strong> just found a new, <em>Earth-friendly</em> way to be fabulous",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion2',
            'taxonomy' => array(
                'category' => 'health-and-fitness,makeup,skin-care,travel',
                'post_tag' => 'celebrity-style,diy-fashion,fashion-week,golden-globes,oscars-2017,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:makeup:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'the-oscars-red-carpet-was-its-own-live-action-beauty-and-the-beast' => array(
            'title' => "<strong>The Oscars</strong> red carpet was its own live action ‘<em>Beauty and the Beast</em>‘",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion3',
            'taxonomy' => array(
                'category' => 'celebrity,health-and-fitness,lifestyle,makeup',
                'post_tag' => 'celebrity-style,diy-fashion,fashion-week,oscars-2017,red-carpet,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:makeup:id}}')
            )
        ),
        'heres-some-of-the-best-sneakers-on-display-at-london-fashion-week' => array(
            'title' => "Here\'s Some of the <strong>Best Sneakers</strong> on Display <em>at</em> London <em>Fashion Week</em>",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion4',
            'taxonomy' => array(
                'category' => 'fashion,hair,lifestyle,makeup',
                'post_tag' => 'best-dressed,diy-fashion,fashion-week,oscars-2017,red-carpet,street-style',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
                '_format_gallery_images' => array(
                    '{{image:travel1:id}}',
                    '{{image:travel2:id}}',
                    '{{image:travel3:id}}',
                    '{{image:travel4:id}}',
                    '{{image:travel5:id}}',
                ),
            )
        ),
        'watch-this-aerogel-insulated-jacket-withstand-liquid-nitrogen' => array(
            'title' => "Watch this <strong>Aerogel Insulated Jacket</strong> withstand <em>Liquid</em> Nitrogen",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion5',
            'taxonomy' => array(
                'category' => 'health-and-fitness,lifestyle,makeup,skin-care',
                'post_tag' => 'best-dressed,fashion-week,golden-globes,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:makeup:id}}')
            )
        ),
        'your-bff-emma-stone-wore-a-planned-parenthood-pin-to-the-oscars' => array(
            'title' => "Your BFF <strong>Emma Stone</strong> wore a <em>Planned Parenthood</em> pin to the Oscars",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion6',
            'taxonomy' => array(
                'category' => 'celebrity,hair,health-and-fitness,lifestyle',
                'post_tag' => 'best-dressed,diy-fashion,fashion-week,red-carpet,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:hair:id}}')
            )
        ),
        'a-detailed-look-at-the-1984-seiko-chariot-steve-jobs-watch' => array(
            'title' => "A <strong>Detailed Look</strong> at the 1984 Seiko Chariot ‘<em>Steve Jobs</em>\' Watch",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel1',
            'taxonomy' => array(
                'category' => 'hair,lifestyle,skin-care,travel',
                'post_tag' => 'best-dressed,celebrity-style,diy-fashion,fashion-week,runaway-look,street-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:hair:id}}')
            )
        ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1488185105318{margin-top: -30px !important;}.vc_custom_1488359383183{margin-top: -40px !important;margin-bottom: 60px !important;border-bottom-width: 1px !important;padding-top: 40px !important;background-color: #f9f9f9 !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1488185113339{padding-right: 0px !important;padding-left: 0px !important;}',
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1488185105318{margin-top: -30px !important;}.vc_custom_1488359383183{margin-top: -40px !important;margin-bottom: 60px !important;border-bottom-width: 1px !important;padding-top: 40px !important;background-color: #f9f9f9 !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1488185113339{padding-right: 0px !important;padding-left: 0px !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'second_title' => '',
                    'header_type' => 'heading_3',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'default-sidebar',
                    'module'    => '26',
                    'excerpt_length' => '52',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_2',
                    'pagination_align' => 'center',
                    'show_navtext' => '1',
                    'show_pageinfo' => '1',
                ),
                '_elementor_data' => '',
                '_elementor_edit_mode' => 'builder'
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1488342076566{padding-right: 30px !important;padding-left: 30px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'LATEST POST',
                    'second_title' => '',
                    'header_type' => 'heading_3',
                    'header_background' => '#252627',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-2',
                    'module'    => '12',
                    'excerpt_length' => '42',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_3',
                    'pagination_align' => 'center',
                    'show_navtext' => '1',
                    'show_pageinfo' => '0',
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1488342076566{padding-right: 30px !important;padding-left: 30px !important;}'
                ),
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1488350635772{margin-top: -40px !important;}.vc_custom_1488350648412{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1488356060347{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 30px !important;padding-right: 30px !important;padding-bottom: 20px !important;padding-left: 30px !important;background-color: #f9f9f9 !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'LATEST POST',
                    'second_title' => '',
                    'header_type' => 'heading_3',
                    'header_background' => '#252627',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-4-loop',
                    'module'    => '5',
                    'excerpt_length' => '23',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_2',
                    'pagination_align' => 'center',
                    'show_navtext' => '1',
                ),
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1488350635772{margin-top: -40px !important;}.vc_custom_1488350648412{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1488356060347{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 30px !important;padding-right: 30px !important;padding-bottom: 20px !important;padding-left: 30px !important;background-color: #f9f9f9 !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.socials_widget.nobg .fa {color: #252627 !important;}'
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
                    'first_title' => 'LATEST POST',
                    'second_title' => '',
                    'header_type' => 'heading_3',
                    'header_background' => '#252627',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-2',
                    'module'    => '10',
                    'excerpt_length' => '50',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_2',
                    'pagination_align' => 'center',
                    'show_navtext' => '1',
                    'show_pageinfo' => '0',
                ),
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder'
            )
        )
    ),

    // menu location
    'menu_location' => array(
        'main-navigation' => array(
            'title' => 'Main Navigation',
            'location' => 'navigation'
        ),
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

        'fashion' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Fashion',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:fashion:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:fashion:id}}',
                    'number' => 7
                ),
            )
        ),

        'beauty' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Beauty',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:beauty:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_2',
                    'category' => '{{category:gaming:id}}',
                    'number' => 6,
                    'trending_tag' => '{{taxonomy:post_tag:best-dressed:id}},{{taxonomy:post_tag:oscars-2017:id}},{{taxonomy:post_tag:golden-globes:id}},{{taxonomy:post_tag:fashion-week:id}},{{taxonomy:post_tag:red-carpet:id}},{{taxonomy:post_tag:diy-fashion:id}},{{taxonomy:post_tag:celebrity-style:id}}',
                ),
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

        'health-and-fitness' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Health &amp; Fitness',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:health-and-fitness:id}}',
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

    ),

    'widget_position' => array(
        'Home',
        'Home - Loop',
        'Author',
        'Home 2',
        'Home 4',
        'Home 4 - Loop'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'jnews-gallery',
        'jnews-instagram',
        'jnews-jsonld',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )

);