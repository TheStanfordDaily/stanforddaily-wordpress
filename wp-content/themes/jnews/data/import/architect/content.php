<?php

return array(

    // image
    'image' =>  array(
        'architect1' => 'http://jegtheme.com/asset/jnews/demo/architect/architect1.jpg',
        'architect2' => 'http://jegtheme.com/asset/jnews/demo/architect/architect2.jpg',
        'architect3' => 'http://jegtheme.com/asset/jnews/demo/architect/architect3.jpg',
        'architect4' => 'http://jegtheme.com/asset/jnews/demo/architect/architect4.jpg',
        'architect5' => 'http://jegtheme.com/asset/jnews/demo/architect/architect5.jpg',
        'architect6' => 'http://jegtheme.com/asset/jnews/demo/architect/architect6.jpg',
        'architect7' => 'http://jegtheme.com/asset/jnews/demo/architect/architect7.jpg',
        'architect8' => 'http://jegtheme.com/asset/jnews/demo/architect/architect8.jpg',
        'architect9' => 'http://jegtheme.com/asset/jnews/demo/architect/architect9.jpg',
        'architect10' => 'http://jegtheme.com/asset/jnews/demo/architect/architect10.jpg',
        'architect11' => 'http://jegtheme.com/asset/jnews/demo/architect/architect11.jpg',
        'architect12' => 'http://jegtheme.com/asset/jnews/demo/architect/architect12.jpg',
        'architect_bg' => 'http://jegtheme.com/asset/jnews/demo/architect/architect_bg.jpg',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/architect/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/architect/logo@2x.png',
        'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/architect/mobile_logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/architect/mobile_logo@2x.png',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png',
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'architecture' =>
                array(
                    'title' =>'Architecture',
                    'description' => 'You can add some category description here.'
                ),
            'beach' =>
                array(
                    'title' =>'Beach',
                    'description' => 'You can add some category description here.'
                ),
            'collections' =>
                array(
                    'title' =>'Collections',
                    'description' => 'You can add some category description here.'
                ),
            'design' =>
                array(
                    'title' =>'Design',
                    'description' => 'You can add some category description here.'
                ),
            'education' =>
                array(
                    'title' =>'Education',
                    'description' => 'You can add some category description here.'
                ),
            'featured' =>
                array(
                    'title' =>'Featured',
                    'description' => 'You can add some category description here.'
                ),
            'greenhouse' =>
                array(
                    'title' =>'Greenhouse',
                    'description' => 'You can add some category description here.'
                ),
            'hotel' =>
                array(
                    'title' =>'Hotel',
                    'description' => 'You can add some category description here.'
                ),
            'house' =>
                array(
                    'title' =>'House',
                    'description' => 'You can add some category description here.'
                ),
            'interiors' =>
                array(
                    'title' =>'Interiors',
                    'description' => 'You can add some category description here.'
                ),
            'projects' =>
                array(
                    'title' =>'Projects',
                    'description' => 'You can add some category description here.'
                ),
            'restaurant' =>
                array(
                    'title' =>'Restaurant',
                    'description' => 'You can add some category description here.'
                ),
            'technology' =>
                array(
                    'title' =>'Technology',
                    'description' => 'You can add some category description here.'
                ),
            'town' =>
                array(
                    'title' =>'Town',
                    'description' => 'You can add some category description here.'
                ),
            'trends' =>
                array(
                    'title' =>'Trends',
                    'description' => 'You can add some category description here.'
                ),
        ),

        'post_tag' => array()
    ),

    // post & page
    'post' => array(
        'frank-lloyd-wright-remains-americas-greatest-architect' => array(
            'title' => "\"Frank Lloyd Wright remains America's greatest architect\"",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'architect1',
            'taxonomy' => array(
                'category' => 'architecture,beach,collections,design,education,featured,greenhouse,hotel,town',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'miami-beach-residence-by-saota-takes-indoor-outdoor-living-to-the-extreme' => array(
            'title' => "Miami Beach residence by SAOTA takes indoor-outdoor living to the extreme",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'architect2',
            'taxonomy' => array(
                'category' => 'architecture,beach,collections,design,greenhouse,hotel,house,interiors,town,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'vision-unveiled-for-london-school-powered-by-thames-tide' => array(
            'title' => "Vision unveiled for London school powered by Thames tide",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'architect3',
            'taxonomy' => array(
                'category' => 'collections,design,education,house,interiors,projects,restaurant,technology,town,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'climate-change-forces-emergency-repairs-to-failsafe-arctic-seed-vault' => array(
            'title' => "Climate change forces emergency repairs to \"failsafe\" Arctic seed vault",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'architect4',
            'taxonomy' => array(
                'category' => 'architecture,collections,design,education,featured,greenhouse,hotel,projects,restaurant,technology,town',
                'post_tag' => '',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=BtVtYSm3bJY'
            )
        ),
        'erasmus-exchange-programme-could-remain-open-to-uk-students-after-brexit' => array(
            'title' => "Erasmus exchange programme could remain open to UK students after Brexit",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'architect5',
            'taxonomy' => array(
                'category' => 'collections,design,education,greenhouse,hotel,house,interiors,restaurant,technology,town,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'grenfell-tower-fire-deaths-raise-questions-about-safety-of-post-war-renovations' => array(
            'title' => "Grenfell Tower fire deaths raise questions about safety of post-war renovations",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'architect6',
            'taxonomy' => array(
                'category' => 'architecture,beach,design,education,hotel,house,projects,restaurant,technology,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'public-hotel-by-herzog-de-meuron-features-fuss-free-bedrooms-like-cabins-on-a-yacht' => array(
            'title' => "Public hotel by Herzog & de Meuron features fuss-free bedrooms \"like cabins on a yacht\"",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'architect7',
            'taxonomy' => array(
                'category' => 'architecture,collections,design,education,greenhouse,hotel,house,restaurant,technology,town,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'sou-fujimoto-creates-ornate-bookshelves-for-basel-installation' => array(
            'title' => "Sou Fujimoto creates ornate bookshelves for Basel installation",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'architect8',
            'taxonomy' => array(
                'category' => 'architecture,beach,collections,design,education,greenhouse,hotel,house,interiors,town,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'santiago-calatravas-world-trade-center-oculus-continues-to-leak' => array(
            'title' => "Santiago Calatrava's World Trade Center Oculus continues to leak",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'architect9',
            'taxonomy' => array(
                'category' => 'architecture,collections,design,education,hotel,house,projects,restaurant,technology,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'note-design-and-afteroom-hack-ikea-kitchens-to-make-living-room-furnishings-for-reform-2' => array(
            'title' => "Note Design and Afteroom hack IKEA kitchens to make living room furnishings for Reform",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'architect10',
            'taxonomy' => array(
                'category' => 'architecture,collections,design,education,hotel,house,interiors,technology,town,trends',
                'post_tag' => '',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=1OaWeQ6Sw1Y'
            )
        ),
        'frank-lloyd-wright-merged-eastern-and-western-architecture-at-tokyos-imperial-hotel' => array(
            'title' => "Frank Lloyd Wright merged eastern and western architecture at Tokyo's Imperial Hotel",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'architect11',
            'taxonomy' => array(
                'category' => 'architecture,beach,collections,design,greenhouse,hotel,house,interiors,restaurant,technology,town,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'herman-miller-and-yves-behars-smart-desks-tell-employees-when-theyve-been-sitting-too-long' => array(
            'title' => "Herman Miller and Yves Behar's smart desks tell employees when they've been sitting too long",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'architect12',
            'taxonomy' => array(
                'category' => 'architecture,beach,collections,featured,greenhouse,hotel,projects,restaurant,technology,town,trends',
                'post_tag' => '',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}'),
                '_format_gallery_images' => array(
                    '{{image:architect1:id}}',
                    '{{image:architect2:id}}',
                    '{{image:architect3:id}}',
                    '{{image:architect4:id}}',
                    '{{image:architect5:id}}',
                ),
            )
        ),
        'theresa-may-orders-public-inquiry-into-grenfell-tower-fire-as-renovations-blamed' => array(
            'title' => "Theresa May orders public inquiry into Grenfell Tower fire as renovations blamed",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'architect1',
            'taxonomy' => array(
                'category' => 'architecture,collections,design,education,hotel,house,projects,restaurant,technology,town,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'drone-footage-captures-brutalist-robin-hood-gardens-ahead-of-imminent-demolition' => array(
            'title' => "Drone footage captures brutalist Robin Hood Gardens ahead of imminent demolition",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'architect2',
            'taxonomy' => array(
                'category' => 'beach,collections,design,education,greenhouse,hotel,house,interiors,restaurant,technology,town',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'note-design-and-afteroom-hack-ikea-kitchens-to-make-living-room-furnishings-for-reform' => array(
            'title' => "Note Design and Afteroom hack IKEA kitchens to make living room furnishings for Reform",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'architect3',
            'taxonomy' => array(
                'category' => 'beach,collections,education,greenhouse,hotel,projects,restaurant,technology,town,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'treehouse-hotel-room-peeps-above-canopy-of-mexicos-tropical-woodland' => array(
            'title' => "Treehouse hotel room peeps above canopy of Mexico's tropical woodland",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'architect4',
            'taxonomy' => array(
                'category' => 'architecture,collections,design,education,greenhouse,hotel,projects,restaurant,technology,town',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'dan-brunn-renovates-frank-gehry-designed-la-house-for-an-illustrator' => array(
            'title' => "Dan Brunn renovates Frank Gehry-designed LA house for an illustrator",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'architect5',
            'taxonomy' => array(
                'category' => 'architecture,beach,design,education,greenhouse,hotel,house,interiors,technology,town,trends',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}')
            )
        ),
        'haverstock-extends-school-on-londons-modernist-alexandra-road-estate' => array(
            'title' => "Haverstock extends school on London's modernist Alexandra Road Estate",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'architect6',
            'taxonomy' => array(
                'category' => 'architecture,beach,design,education,hotel,house,projects,restaurant,technology,trends',
                'post_tag' => '',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category::id}}'),
                '_format_gallery_images' => array(
                    '{{image:architect1:id}}',
                    '{{image:architect2:id}}',
                    '{{image:architect3:id}}',
                    '{{image:architect4:id}}',
                    '{{image:architect5:id}}',
                ),
            )
        ),

        // page
        'home-1' => array(
	        'title' => 'Home 1',
	        'content' => 'home1.txt',
	        'post_type' => 'page',
	        'metabox' => array(
		        '_wp_page_template' => 'template-builder.php',
		        '_wpb_shortcodes_custom_css' => '.vc_custom_1497677014143{margin-bottom: 30px !important;padding-top: 25px !important;padding-bottom: 20px !important;background-color: #e0e0e0 !important;}.vc_custom_1497606708847{border-top-width: 5px !important;padding-top: 20px !important;border-top-color: #333333 !important;border-top-style: solid !important;}.vc_custom_1497676931341{margin-bottom: 10px !important;}',
		        '_elementor_data' => 'home1.json',
		        '_elementor_edit_mode' => 'builder',
		        '_elementor_page_settings' => array(
			        'custom_css' => '.vc_custom_1497677014143{margin-bottom: 30px !important;padding-top: 25px !important;padding-bottom: 20px !important;background-color: #e0e0e0 !important;}.vc_custom_1497606708847{border-top-width: 5px !important;padding-top: 20px !important;border-top-color: #333333 !important;border-top-style: solid !important;}.vc_custom_1497676931341 .jeg_ad_module{margin-bottom: 10px !important;}'
		        )
	        )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497842008456{border-top-width: 5px !important;padding-top: 20px !important;border-top-color: #000000 !important;border-top-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_5',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-widget-1',
                    'module'    => '5',
                    'excerpt_length' => '50',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497842008456{border-top-width: 5px !important;padding-top: 20px !important;border-top-color: #000000 !important;border-top-style: solid !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497841404623{border-top-width: 5px !important;padding-top: 25px !important;border-top-color: #000000 !important;border-top-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_5',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'default-sidebar',
                    'module'    => '5',
                    'excerpt_length' => '45',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497841404623{border-top-width: 5px !important;padding-top: 25px !important;border-top-color: #000000 !important;border-top-style: solid !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497863676658{margin-top: -30px !important;padding-top: 20px !important;background-color: #e2e2e2 !important;}.vc_custom_1497844228391{margin-top: 30px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_5',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-widget-1',
                    'module'    => '3',
                    'excerpt_length' => '45',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497863676658{margin-top: -30px !important;padding-top: 20px !important;background-color: #e2e2e2 !important;}.vc_custom_1497844228391{margin-top: 30px !important;}'
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
        'header-1' => array(
            'title' => 'Header 1',
            'location' => ''
        ),
        'header-2' => array(
            'title' => 'Header 2',
            'location' => ''
        ),
        'header-3' => array(
            'title' => 'Header 3',
            'location' => ''
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
        'interiors' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Interiors',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:interiors:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:interiors:id}}',
                    'number' => 9,
                ),
            )
        ),
        'design' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Design',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:design:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:design:id}}',
                    'number' => 9,
                ),
            )
        ),
        'technology' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Technology',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:technology:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:technology:id}}',
                    'number' => 9,
                ),
            )
        ),
        'projects' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Projects',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:projects:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:projects:id}}',
                    'number' => 9,
                ),
            )
        ),

        // footer & topbar menu
        'home-mobile' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Home',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:home-1:id}}',
                'menu-item-status' => 'publish'
            )
        ),
            'home-1-mobile' => array(
                'location' => 'footer-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Home - Layout 1',
                    'menu-item-parent-id' => '{{menu:home-mobile:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:home-1:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'home-2-mobile' => array(
                'location' => 'footer-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Home - Layout 2',
                    'menu-item-parent-id' => '{{menu:home-mobile:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:home-2:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'home-3-mobile' => array(
                'location' => 'footer-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Home - Layout 3',
                    'menu-item-parent-id' => '{{menu:home-mobile:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:home-3:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'home-4-mobile' => array(
                'location' => 'footer-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Home - Layout 4',
                    'menu-item-parent-id' => '{{menu:home-mobile:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:home-4:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
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
                'menu-item-title' => 'Contact Us',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),

        'architecture-1' => array(
            'location' => 'header-1',
            'menu-item-data' => array(
                'menu-item-title' => 'Architecture',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:architecture:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'design-1' => array(
            'location' => 'header-1',
            'menu-item-data' => array(
                'menu-item-title' => 'Design',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:design:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'interiors-1' => array(
            'location' => 'header-1',
            'menu-item-data' => array(
                'menu-item-title' => 'Interiors',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:interiors:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'technology-1' => array(
            'location' => 'header-1',
            'menu-item-data' => array(
                'menu-item-title' => 'Technology',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:technology:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'trends-2' => array(
            'location' => 'header-2',
            'menu-item-data' => array(
                'menu-item-title' => 'Trends',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:trends:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'projects-2' => array(
            'location' => 'header-2',
            'menu-item-data' => array(
                'menu-item-title' => 'Projects',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:projects:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'collections-2' => array(
            'location' => 'header-2',
            'menu-item-data' => array(
                'menu-item-title' => 'Collections',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:collections:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'education-2' => array(
            'location' => 'header-2',
            'menu-item-data' => array(
                'menu-item-title' => 'Education',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:education:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'house-3' => array(
            'location' => 'header-3',
            'menu-item-data' => array(
                'menu-item-title' => 'House',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:house:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'restaurant-3' => array(
            'location' => 'header-3',
            'menu-item-data' => array(
                'menu-item-title' => 'Restaurant',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:restaurant:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'greenhouse-3' => array(
            'location' => 'header-3',
            'menu-item-data' => array(
                'menu-item-title' => 'Greenhouse',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:greenhouse:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'hotel-3' => array(
            'location' => 'header-3',
            'menu-item-data' => array(
                'menu-item-title' => 'Hotel',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:hotel:id}}',
                'menu-item-status' => 'publish'
            )
        ),

    ),

    'widget_position' => array(
        'Home Widget 1'
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