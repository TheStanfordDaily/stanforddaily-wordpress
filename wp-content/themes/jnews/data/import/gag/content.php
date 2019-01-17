<?php

return array(

    // image
    'image' =>  array(
        'gag1' => 'http://jegtheme.com/asset/jnews/demo/gag/gag1.jpg',
        'gag2' => 'http://jegtheme.com/asset/jnews/demo/gag/gag2.jpg',
        'gag3' => 'http://jegtheme.com/asset/jnews/demo/gag/gag3.jpg',
        'gag4' => 'http://jegtheme.com/asset/jnews/demo/gag/gag4.jpg',
        'gag5' => 'http://jegtheme.com/asset/jnews/demo/gag/gag5.jpg',
        'gag6' => 'http://jegtheme.com/asset/jnews/demo/gag/gag6.jpg',
        'gag7' => 'http://jegtheme.com/asset/jnews/demo/gag/gag7.jpg',
        'gag8' => 'http://jegtheme.com/asset/jnews/demo/gag/gag8.jpg',
        'gag9' => 'http://jegtheme.com/asset/jnews/demo/gag/gag9.jpg',
        'gag10' => 'http://jegtheme.com/asset/jnews/demo/gag/gag10.jpg',
        'gag11' => 'http://jegtheme.com/asset/jnews/demo/gag/gag11.jpg',
        'gag12' => 'http://jegtheme.com/asset/jnews/demo/gag/gag12.jpg',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/gag/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/gag/logo@2x.png',
        'mobile_logo' => 'https://jnews.io/gag/wp-content/uploads/sites/9/2017/03/gag_logo.png',
        'mobile_logo2x' => 'https://jnews.io/gag/wp-content/uploads/sites/9/2017/03/gag_logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
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
            'gif' =>
                array(
                    'title' => 'GIF',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
            'fail' =>
                array(
                    'title' =>'Fail',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
            'lol' =>
                array(
                    'title' => 'LOL',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
            'animals' =>
                array(
                    'title' => 'Animals',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
            'meme' =>
                array(
                    'title' => 'Meme',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
            'girl' =>
                array(
                    'title' => 'Girl',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                ),
        ),
    
        'post_tag' => array(
            'dog' => array(
                'title' => 'Dog',
            ),
            'cat' => array(
                'title' => 'Cat',
            ),
            'savage' => array(
                'title' => 'Savage',
            ),
            'humor' => array(
                'title' => 'Humor',
            ),
            'gaming' => array(
                'title' => 'Gaming'
            ),
            'nsfw' => array(
                'title' => 'NSFW'
            ),
            'quotes' => array(
                'title' => 'Quotes'
            ),
            'epic' => array(
                'title' => 'Epic'
            ),
        )
    ),

    // post & page
    'post' => array(
        'how-to-deal-with-gold-digger' => array(
            'title' => "How to deal with gold digger",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gag1',
            'taxonomy' => array(
                'category' => 'fail,girl,lol',
                'post_tag' => 'cat,epic,gaming,humor,nsfw,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:girl:id}}')
            )
        ),
        'when-you-get-another-day-off-but-suddenly-canceled' => array(
            'title' => "When you get another day-off, but suddenly canceled",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gag2',
            'taxonomy' => array(
                'category' => 'fail,lol,meme',
                'post_tag' => 'epic,gaming,humor,nsfw,quotes,savage',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lol:id}}'),
                '_format_gallery_images' => array(
                    '{{image:gag1:id}}',
                    '{{image:gag2:id}}',
                    '{{image:gag3:id}}',
                    '{{image:gag4:id}}',
                    '{{image:gag5:id}}',
                ),
            )
        ),
        'youre-being-watched-without-knowing-it' => array(
            'title' => "You're being watched without knowing it",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gag3',
            'taxonomy' => array(
                'category' => 'animals,gif,lol,video',
                'post_tag' => 'cat,epic,gaming,humor,nsfw,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gif:id}}')
            )
        ),
        'this-is-just-a-banana-dont-be-dirty' => array(
            'title' => "This is just a banana, don't be dirty",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gag4',
            'taxonomy' => array(
                'category' => 'animals,fail,lol,meme',
                'post_tag' => 'epic,humor,nsfw,quotes'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lol:id}}')
            )
        ),
        'i-feel-so-happy-right-now' => array(
            'title' => "I feel so happy right now",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gag5',
            'taxonomy' => array(
                'category' => 'gif,girl,lol',
                'post_tag' => 'epic,gaming,humor,nsfw,quotes,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:girl:id}}')
            )
        ),
        'cute-baby-monkeys-compilations' => array(
            'title' => "Cute baby monkeys compilations",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gag6',
            'taxonomy' => array(
                'category' => 'animals,lol,video',
                'post_tag' => 'cat,epic,gaming,humor,nsfw,savage',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=JsEiHWST0ts'
            )
        ),
        'i-laughed-way-too-hard-at-this' => array(
            'title' => "I laughed way too hard at this",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gag7',
            'taxonomy' => array(
                'category' => 'fail,gif,lol,meme',
                'post_tag' => 'epic,gaming,humor,nsfw,quotes,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lol:id}}')
            )
        ),
        'this-is-why-dads-good-at-babysitting' => array(
            'title' => "This is why dads good at babysitting",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gag8',
            'taxonomy' => array(
                'category' => 'fail,girl,lol,meme',
                'post_tag' => 'epic,gaming,humor,nsfw,quotes,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fail:id}}')
            )
        ),
        'poor-lil-lion-savage-chimpanzee' => array(
            'title' => "Poor lil' lion, savage chimpanzee",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gag9',
            'taxonomy' => array(
                'category' => 'animals,fail,girl,lol,meme',
                'post_tag' => 'cat,epic,gaming,humor,nsfw,savage',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fail:id}}'),
                '_format_gallery_images' => array(
                    '{{image:gag1:id}}',
                    '{{image:gag2:id}}',
                    '{{image:gag3:id}}',
                    '{{image:gag4:id}}',
                    '{{image:gag5:id}}',
                )
            )
        ),
        'you-will-do-as-i-command' => array(
            'title' => "You will do as I command",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gag10',
            'taxonomy' => array(
                'category' => 'animals,fail,girl,lol,meme',
                'post_tag' => 'cat,epic,gaming,humor,nsfw,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:meme:id}}')
            )
        ),
        'a-frog-can-only-take-so-much-before-completely-losing-it' => array(
            'title' => "A frog can only take so much before completely losing it",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gag11',
            'taxonomy' => array(
                'category' => 'animals,fail,lol,meme',
                'post_tag' => 'cat,humor,nsfw,quotes,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}')
            )
        ),
        'the-real-fantastic-beast' => array(
            'title' => "The real fantastic beast",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gag12',
            'taxonomy' => array(
                'category' => 'animals,fail,lol,meme',
                'post_tag' => 'cat,epic,gaming,humor,nsfw,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}')
            )
        ),
        'when-people-talk-bullsht-all-the-time' => array(
            'title' => "When people talk bullsh*t all the time",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gag1',
            'taxonomy' => array(
                'category' => 'animals,fail,gif,lol',
                'post_tag' => 'cat,humor,nsfw,quotes,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}')
            )
        ),
        'you-dont-adopt-the-kitty-the-kitty-adopts-you' => array(
            'title' => "You dont adopt the kitty, the kitty adopts you",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gag2',
            'taxonomy' => array(
                'category' => 'animals,fail,gif,lol',
                'post_tag' => 'cat,epic,humor,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gif:id}}')
            )
        ),
        'gimme-more-wine-btch' => array(
            'title' => "Gimme more wine b*tch",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gag3',
            'taxonomy' => array(
                'category' => 'fail,gif,girl,lol,meme',
                'post_tag' => 'epic,gaming,humor,nsfw,quotes,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:girl:id}}')
            )
        ),
        'reality-sometimes-beyond-the-expectation' => array(
            'title' => "Reality sometimes beyond the expectation",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gag4',
            'taxonomy' => array(
                'category' => 'girl,lol,meme',
                'post_tag' => 'cat,epic,gaming,quotes'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:meme:id}}')
            )
        ),
        'i-wish-i-know-how-to-stop' => array(
            'title' => "I wish I know how to stop",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gag5',
            'taxonomy' => array(
                'category' => 'animals,fail,lol,meme',
                'post_tag' => 'epic,gaming,humor,nsfw,quotes,savage'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:meme:id}}')
            )
        ),
        'try-not-to-laugh-at-this' => array(
            'title' => "Try not to laugh at this",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gag6',
            'taxonomy' => array(
                'category' => 'animals,lol,video',
                'post_tag' => 'cat,epic,gaming,humor,nsfw,savage',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:animals:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=oqNKD9YVe4U'
            )
        ),
        'age-is-just-a-number-nah-its-just-a-word' => array(
            'title' => "Age is just a number? Nah, it's just a word!",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gag7',
            'taxonomy' => array(
                'category' => 'girl,lol,meme',
                'post_tag' => 'cat,epic,humor,nsfw,quotes'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:girl:id}}')
            )
        ),
    
        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'second_title' => '',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '18',
                    'excerpt_length' => '20',
                    'content_date' => 'ago',
                    'content_pagination' => 'nav_3',
                    'pagination_align' => 'center',
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => '',
                '_elementor_edit_mode' => 'builder'
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1490162941985{margin-top: -30px !important;}.vc_custom_1490162237805{padding-right: 0px !important;padding-left: 0px !important;}',
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1490162941985{margin-top: -30px !important;}.vc_custom_1490162237805{padding-right: 0px !important;padding-left: 0px !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1490175804508{margin-top: -30px !important;margin-bottom: 20px !important;padding-top: 15px !important;background-color: #ededed !important;}.vc_custom_1490427467267{margin-bottom: 40px !important;border-bottom-width: 1px !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1490175510998{margin-bottom: 15px !important;}.vc_custom_1490427454692{margin-bottom: 20px !important;}',
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1490175804508{margin-top: -30px !important;margin-bottom: 20px !important;padding-top: 15px !important;background-color: #ededed !important;}.vc_custom_1490427467267{margin-bottom: 40px !important;border-bottom-width: 1px !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1490175510998{margin-bottom: 15px !important;}.vc_custom_1490427454692{margin-bottom: 20px !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1490329382094{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 20px !important;background-color: #f5f5f5 !important;}',
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1490329382094{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 20px !important;background-color: #f5f5f5 !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1490427933218{margin-top: -30px !important;margin-bottom: 40px !important;background-color: #000000 !important;}.vc_custom_1490427853683{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1490427925003{margin-bottom: 0px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'second_title' => '',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '18',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_2',
                    'pagination_align' => 'center',
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1490427933218{margin-top: -30px !important;margin-bottom: 40px !important;background-color: #000000 !important;}.vc_custom_1490427853683{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1490427925003{margin-bottom: 0px !important;}.vc_custom_1490427925003 .jeg_heroblock_1 {margin-bottom: 0 !important;}'
                )
            )
        ),
        'popular' => array(
            'title' => 'Popular',
            'content' => 'popular.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1490244019430{margin-top: 0px !important;margin-bottom: 40px !important;border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 25px !important;padding-right: 25px !important;padding-bottom: 25px !important;padding-left: 25px !important;border-left-color: #111111 !important;border-left-style: solid !important;border-right-color: #111111 !important;border-right-style: solid !important;border-top-color: #111111 !important;border-top-style: solid !important;border-bottom-color: #111111 !important;border-bottom-style: solid !important;}.vc_custom_1490243964979{margin-top: 30px !important;}',
            )
        ),
        'contact' => array(
            'title' => 'Contact',
            'content' => 'contact.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'default',
                '_wpb_shortcodes_custom_css' => '',
                'jnews_single_page' => array(
                    'sidebar' => 'author', 
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

        'popular' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Popular',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:popular:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'meme' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Meme',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:meme:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'gif' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'GIF',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:gif:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'lol' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'LOL',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:lol:id}}',
                'menu-item-status' => 'publish'
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

        'contact' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Contact',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:contact:id}}',
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
                'menu-item-title' => 'Contact',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:contact:id}}',
                'menu-item-status' => 'publish'
            )
        ),
    ),

    'widget_position' => array(
        'Home',
        'Author',
        'Archives'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'contact-form-7',
        'jnews-gallery',
        'jnews-instagram',
        'jnews-jsonld',
        'jnews-like',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )
);
