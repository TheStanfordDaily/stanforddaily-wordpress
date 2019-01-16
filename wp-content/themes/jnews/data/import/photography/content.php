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
	    'favicon'       => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'logo'          => 'http://jegtheme.com/asset/jnews/demo/photography/logo.png',
        'logo2x'        => 'http://jegtheme.com/asset/jnews/demo/photography/logo@2x.png',
        'mobile_logo'   => 'http://jegtheme.com/asset/jnews/demo/photography/mobile_logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/photography/mobile_logo@2x.png',
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'gear' =>
                array(
                    'title' =>'Gear',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
                ),
            'camera' =>
	            array(
		            'title' =>'Camera',
		            'parent' => 'gear',
		            'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	            ),
            'camera-bag' =>
	            array(
		            'title' =>'Camera Bag',
		            'parent' => 'gear',
		            'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	            ),
            'lens' =>
	            array(
		            'title' =>'Lens',
		            'parent' => 'gear',
		            'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	            ),
            'lighting' =>
	            array(
		            'title' =>'Lighting',
		            'parent' => 'gear',
		            'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	            ),
            'inspiration' =>
	            array(
		            'title' =>'Inspiration',
		            'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	            ),
            'landscape' =>
	            array(
		            'title' =>'Landscape',
		            'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	            ),
            'news' =>
	            array(
		            'title' =>'News',
		            'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	            ),
            'portrait' =>
	            array(
		            'title' =>'Portrait',
		            'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	            ),
            'tips' =>
	            array(
		            'title' =>'Tips',
		            'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	            ),
        ),
    
        'post_tag' => array(
            'best-entry-level-dslr	' => array(
                'title' => 'Best Entry Level DSLR	',
            ),
            'black-white' => array(
	            'title' => 'Black White',
            ),
            'canon' => array(
	            'title' => 'Canon',
            ),
            'fujifilm-x-t2' => array(
	            'title' => 'Fujifilm X-T2',
            ),
            'mirorless' => array(
	            'title' => 'Mirorless',
            ),
            'monochrome' => array(
	            'title' => 'Monochrome',
            ),
            'nikon' => array(
	            'title' => 'Nikon',
            ),
            'sony' => array(
	            'title' => 'Sony',
            ),
            'tripod' => array(
	            'title' => 'Tripod',
            ),
        )
    ),

    // post & page
    'post' => array(
	    'these-are-the-days-we-live-for' => array(
		    'title' => "These are the days we live for",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion1',
		    'taxonomy' => array(
			    'category' => 'inspiration,landscape,tips',
			    'post_tag' => 'mirorless,nikon,sony,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:landscape:id}}')
		    )
	    ),
	    'bloom-where-you-are-planted' => array(
		    'title' => "Bloom where you are planted",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion2',
		    'taxonomy' => array(
			    'category' => 'gear,landscape,tips',
			    'post_tag' => 'best-entry-level-dslr,black-white,fujifilm-x-t2,mirorless,monochrome,sony'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:landscape:id}}')
		    )
	    ),
	    'real-men-dont-take-selfies' => array(
		    'title' => "Real men don’t take selfies",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion3',
		    'taxonomy' => array(
			    'category' => 'landscape,tips',
			    'post_tag' => 'mirorless,nikon,sony,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tips:id}}')
		    )
	    ),
	    'i-am-forever-chasing-light' => array(
		    'title' => "I am forever chasing light",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion4',
		    'taxonomy' => array(
			    'category' => 'inspiration,portrait,tips',
			    'post_tag' => 'best-entry-level-dslr,fujifilm-x-t2,mirorless,sony,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:portrait:id}}')
		    )
	    ),
	    'beautiful-things-dont-ask-for-attention' => array(
		    'title' => "Beautiful things don’t ask for attention",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion5',
		    'taxonomy' => array(
			    'category' => 'inspiration,landscape,tips',
			    'post_tag' => 'best-entry-level-dslr,black-white,canon,mirorless,sony,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:landscape:id}}')
		    )
	    ),
	    'meet-me-where-the-sky-touches-the-sea' => array(
		    'title' => "Meet me where the sky touches the sea",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion6',
		    'taxonomy' => array(
			    'category' => 'inspiration,portrait',
			    'post_tag' => 'canon,fujifilm-x-t2,mirorless,monochrome,nikon,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:portrait:id}}')
		    )
	    ),
	    'good-vibes-happen-on-the-tides' => array(
		    'title' => "Good vibes happen on the tides",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel1',
		    'taxonomy' => array(
			    'category' => 'gear,inspiration,landscape',
			    'post_tag' => 'best-entry-level-dslr,canon,monochrome,nikon,sony,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tips:id}}')
		    )
	    ),
	    'you-dont-take-a-photograph-you-make-it' => array(
		    'title' => "You don’t take a photograph, you make it",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel2',
		    'taxonomy' => array(
			    'category' => 'gear,inspiration,portrait',
			    'post_tag' => 'black-white,mirorless,monochrome,sony,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:portrait:id}}')
		    )
	    ),
	    'the-true-mystery-of-the-world-is-the-visible' => array(
		    'title' => "The true mystery of the world is the visible",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel3',
		    'taxonomy' => array(
			    'category' => 'inspiration,portrait,tips',
			    'post_tag' => 'black-white,fujifilm-x-t2,mirorless,monochrome,nikon,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
		    )
	    ),
	    'photography-is-the-story-i-fail-to-put-into-words' => array(
		    'title' => "Photography is the story I fail to put into words",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel4',
		    'taxonomy' => array(
			    'category' => 'inspiration,landscape',
			    'post_tag' => 'best-entry-level-dslr,canon,fujifilm-x-t2,nikon,sony,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
		    )
	    ),
	    'enjoy-the-street-at-chicago' => array(
		    'title' => "Enjoy the street at Chicago",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel5',
		    'taxonomy' => array(
			    'category' => 'inspiration,portrait',
			    'post_tag' => 'black-white,canon,fujifilm-x-t2,nikon,sony'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:inspiration:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'when-your-shadow-comes-alive' => array(
		    'title' => "When your shadow comes alive",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel6',
		    'taxonomy' => array(
			    'category' => 'gear,portrait,tips',
			    'post_tag' => 'black-white,canon,fujifilm-x-t2,mirorless,sony'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:portrait:id}}')
		    )
	    ),
	    'get-lost-in-the-forest-dont-find-a-way-back' => array(
		    'title' => "Get lost in the forest & Don’t find a way back",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion1',
		    'taxonomy' => array(
			    'category' => 'landscape,tips',
			    'post_tag' => 'canon,fujifilm-x-t2,monochrome,nikon'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tips:id}}')
		    )
	    ),
	    'on-the-top-of-mountains-beneath-the-stars' => array(
		    'title' => "On the top of mountains & beneath the stars",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion2',
		    'taxonomy' => array(
			    'category' => 'gear,landscape,tips',
			    'post_tag' => 'best-entry-level-dslr,canon,fujifilm-x-t2,mirorless,monochrome,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:landscape:id}}')
		    )
	    ),
	    'dont-let-the-sunshine-spoil-your-rain' => array(
		    'title' => "Don’t let the sunshine spoil your rain",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion3',
		    'taxonomy' => array(
			    'category' => 'gear,inspiration,landscape',
			    'post_tag' => 'best-entry-level-dslr,black-white,fujifilm-x-t2,nikon,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
		    )
	    ),
	    'see-you-on-the-next-wave' => array(
		    'title' => "See you on the next wave",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion4',
		    'taxonomy' => array(
			    'category' => 'landscape,portrait,tips',
			    'post_tag' => 'best-entry-level-dslr,black-white,fujifilm-x-t2,mirorless,monochrome,sony'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:landscape:id}}')
		    )
	    ),
	    'difficult-roads-often-lead-to-beautiful-destinations' => array(
		    'title' => "Difficult roads often lead to beautiful destinations",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion5',
		    'taxonomy' => array(
			    'category' => 'inspiration,portrait',
			    'post_tag' => 'best-entry-level-dslr,black-white,canon,fujifilm-x-t2,mirorless,nikon'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:portrait:id}}')
		    )
	    ),
	    'some-people-walk-in-the-rain-others-just-get-wet' => array(
		    'title' => "Some people walk in the rain, others just get wet",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion6',
		    'taxonomy' => array(
			    'category' => 'gear,inspiration,portrait',
			    'post_tag' => 'best-entry-level-dslr,black-white,canon,mirorless,nikon,sony'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:portrait:id}}')
		    )
	    ),
	    'ignore-the-rain-look-for-the-rainbow' => array(
		    'title' => "Ignore the rain look for the rainbow",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel1',
		    'taxonomy' => array(
			    'category' => 'portrait,tips',
			    'post_tag' => 'best-entry-level-dslr,black-white,nikon,sony,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:portrait:id}}')
		    )
	    ),
	    'be-like-a-tree-and-let-the-dead-leaves-drop' => array(
		    'title' => "Be like a tree and let the dead leaves drop",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel2',
		    'taxonomy' => array(
			    'category' => 'gear,landscape,tips',
			    'post_tag' => 'best-entry-level-dslr,black-white,mirorless,monochrome,nikon'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:landscape:id}}')
		    )
	    ),
	    'so-lovely-was-the-loneliness-of-a-wild-lake' => array(
		    'title' => "So lovely was the loneliness of a wild lake",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel3',
		    'taxonomy' => array(
			    'category' => 'gear,landscape,portrait,tips',
			    'post_tag' => 'best-entry-level-dslr,canon,monochrome,nikon,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tips:id}}')
		    )
	    ),
	    'time-spent-at-the-beach-is-never-wasted' => array(
		    'title' => "Time spent at the beach is never wasted",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel4',
		    'taxonomy' => array(
			    'category' => 'inspiration,landscape,portrait',
			    'post_tag' => 'best-entry-level-dslr,canon,fujifilm-x-t2,monochrome,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
		    )
	    ),
	    'the-earth-has-music-for-those-who-listen' => array(
		    'title' => "The Earth has music for those who listen",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel5',
		    'taxonomy' => array(
			    'category' => 'gear,inspiration,portrait',
			    'post_tag' => 'best-entry-level-dslr,black-white,mirorless,sony,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
		    )
	    ),
	    'my-favorite-color-is-sunset' => array(
		    'title' => "My favorite color is sunset",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel6',
		    'taxonomy' => array(
			    'category' => 'gear,landscape,tips',
			    'post_tag' => 'best-entry-level-dslr,black-white,fujifilm-x-t2,monochrome,sony'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:landscape:id}}')
		    )
	    ),
	    'all-my-troubles-wash-away-in-the-water' => array(
		    'title' => "All my troubles wash away in the water",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion1',
		    'taxonomy' => array(
			    'category' => 'inspiration,portrait,tips',
			    'post_tag' => 'best-entry-level-dslr,black-white,fujifilm-x-t2,mirorless,nikon,sony'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:portrait:id}}')
		    )
	    ),
	    'i-love-the-smell-of-street' => array(
		    'title' => "I love the smell of street",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion2',
		    'taxonomy' => array(
			    'category' => 'gear,inspiration,portrait',
			    'post_tag' => 'best-entry-level-dslr,black-white,monochrome,nikon,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:portrait:id}}')
		    )
	    ),
	    'my-brain-feels-like-a-cool-deep-lake' => array(
		    'title' => "My brain feels like a cool, deep lake",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion3',
		    'taxonomy' => array(
			    'category' => 'inspiration,landscape,tips',
			    'post_tag' => 'best-entry-level-dslr,monochrome,nikon,sony,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
		    )
	    ),
	    'some-days-start-better-than-others' => array(
		    'title' => "Some days start better than others",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion4',
		    'taxonomy' => array(
			    'category' => 'inspiration,landscape,tips',
			    'post_tag' => 'canon,mirorless,monochrome,tripod'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:inspiration:id}}')
		    )
	    ),
	    'i-express-myself-with-images' => array(
		    'title' => "I express myself with images",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion5',
		    'taxonomy' => array(
			    'category' => 'inspiration,portrait',
			    'post_tag' => 'best-entry-level-dslr,black-white,canon,fujifilm-x-t2,mirorless,sony'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:portrait:id}}')
		    )
	    ),
    
        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder'
            )
        ),
	    'footer' => array(
		    'title' => 'Footer',
		    'content' => 'footer.txt',
		    'post_type' => 'footer',
		    'metabox' => array(
			    '_elementor_data' => 'footer.json',
			    '_elementor_edit_mode' => 'builder',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1516082354216{margin-top: 30px !important;padding-top: 22px !important;padding-bottom: 22px !important;}.vc_custom_1516083863519{margin-bottom: 0px !important;}',
		    )
	    ),
	    'contact' => array(
		    'title' => 'Contact',
		    'content' => 'contact.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'default',
			    'jnews_single_page' => array(
			    	'layout' => 'right-sidebar',
				    'sidebar' => 'contact',
				    'sticky_sidebar' => '0',
				    'show_post_meta' => '0',
				    'share_position' => 'hide',
				    'share_color' => 'share-monocrhome'
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
        'mobile-navigation' => array(
            'title' => 'Mobile Navigation',
            'location' => 'mobile_navigation'
        ),
    ),

    // menu it self
    'menu' => array(

        // main
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
        'tips' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Tips',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:tips:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_2',
                    'category' => '{{category:tips:id}}',
                    'number' => 6,
	                'trending_tag' => '{{taxonomy:post_tag:mirorless:id}},{{taxonomy:post_tag:monochrome:id}},{{taxonomy:post_tag:black-white:id}},{{taxonomy:post_tag:canon:id}},{{taxonomy:post_tag:sony:id}}'
                ),
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
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:inspiration:id}}',
                    'number' => 6
                ),
            )
        ),

        'landscape' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Landscape',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:landscape:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'portrait' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Portrait',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:portrait:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'contact-us' => array(
	        'location' => 'main-navigation',
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
        'Contact',
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'contact-form-7',
        'jnews-breadcrumb',
	    'jnews-essential',
        'jnews-gallery',
        'jnews-instagram',
        'jnews-jsonld',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-split',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )

);