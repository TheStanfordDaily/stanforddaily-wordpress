<?php

return array(

    // image
    'image' =>  array(
	    'interior1' => 'http://jegtheme.com/asset/jnews/demo/interior/interior1.jpg',
	    'interior2' => 'http://jegtheme.com/asset/jnews/demo/interior/interior2.jpg',
	    'interior3' => 'http://jegtheme.com/asset/jnews/demo/interior/interior3.jpg',
	    'interior4' => 'http://jegtheme.com/asset/jnews/demo/interior/interior4.jpg',
	    'interior5' => 'http://jegtheme.com/asset/jnews/demo/interior/interior5.jpg',
	    'interior6' => 'http://jegtheme.com/asset/jnews/demo/interior/interior6.jpg',
	    'interior7' => 'http://jegtheme.com/asset/jnews/demo/interior/interior7.jpg',
	    'interior8' => 'http://jegtheme.com/asset/jnews/demo/interior/interior8.jpg',
	    'interior9' => 'http://jegtheme.com/asset/jnews/demo/interior/interior9.jpg',
	    'author' => 'http://jegtheme.com/asset/jnews/demo/default/news9.jpg',
	    'header_bg'  => 'http://jegtheme.com/asset/jnews/demo/interior/header_bg.jpg',
	    'menubg'  => 'http://jegtheme.com/asset/jnews/demo/interior/menubg.jpg',
	    'logo'  => 'http://jegtheme.com/asset/jnews/demo/interior/logo.png',
	    'logo2x'  => 'http://jegtheme.com/asset/jnews/demo/interior/logo@2x.png',
        'mobile'  => 'http://jegtheme.com/asset/jnews/demo/interior/logo_interior_mobile.png',
        'mobile2x'  => 'http://jegtheme.com/asset/jnews/demo/interior/logo_interior_mobile2x.png',
	    'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
	    'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'design' =>
                array(
                    'title' => 'Design',
                    'description' => 'You can add some category description here.'
                ),
            'furniture' =>
                array(
                    'title' => 'Furniture',
                    'description' => 'You can add some category description here.'
                ),
            'inspiration' =>
                array(
                    'title' => 'Inspiration',
                    'description' => 'You can add some category description here.'
                ),
            'diy' =>
                array(
                    'title' => 'DIY',
                    'description' => 'You can add some category description here.'
                ),
            'decor' =>
                array(
                    'title' => 'Decor',
                    'description' => 'You can add some category description here.'
                ),
        ),

        'post_tag' => array(
	        'apartment' => array(
		        'title' => 'Apartment',
	        ),
	        'bedroom' => array(
		        'title' => 'Bedroom',
	        ),
	        'bohemian' => array(
		        'title' => 'Bohemian',
	        ),
	        'budget' => array(
		        'title' => 'Budget',
	        ),
	        'cozy' => array(
		        'title' => 'Cozy',
	        ),
	        'industrial' => array(
		        'title' => 'Industrial',
	        ),
	        'livingroom' => array(
		        'title' => 'Livingroom',
	        ),
	        'minimalist' => array(
		        'title' => 'Minimalist',
	        ),
	        'modern' => array(
		        'title' => 'Modern',
	        ),
	        'office' => array(
		        'title' => 'Office',
	        ),
	        'plants' => array(
		        'title' => 'Plants',
	        ),
        )
    ),

    // post & page
    'post' => array(
	    'these-things-you-will-find-in-every-fixer-upper-kitchen' => array(
		    'title' => "These Things You Will Find In Every Fixer Upper Kitchen",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'interior1',
		    'taxonomy' => array(
			    'category' => 'diy,furniture',
			    'post_tag' => ''
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:inspiration:id}}'),
			    'post_subtitle' => 'Self-belief and hard work will always earn you success.'
		    )
	    ),
	    'coastal-living-rooms-that-will-make-you-yearn-for-the-beach' => array(
		    'title' => "Coastal Living Rooms That Will Make You Yearn for the Beach",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'interior2',
		    'taxonomy' => array(
			    'category' => 'furniture',
			    'post_tag' => ''
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:furniture:id}}'),
			    'post_subtitle' => 'Self-belief and hard work will always earn you success.'
		    )
	    ),
	    'these-20-rooms-with-coastal-decor-are-the-definition-of-calm' => array(
		    'title' => "These 20 Rooms With Coastal Decor Are The Definition of Calm",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'interior3',
		    'taxonomy' => array(
			    'category' => 'decor,design,furniture',
			    'post_tag' => 'budget,industrial,minimalist,plants'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:decor:id}}'),
			    'post_subtitle' => 'Choosing the best indoor plants for your interior.'
		    )
	    ),
	    'explore-the-modernist-interiors-of-the-kubu-hotel-in-seminyak' => array(
		    'title' => "Explore the Modernist Interiors of the \"Kubu\" Hotel in Seminyak",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior4',
			'taxonomy' => array(
				'category' => 'decor,design,inspiration',
				'post_tag' => ''
			),
		    'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:design:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'smart-acoustics-and-cozy-aesthetics-shape-office-in-poznan' => array(
			'title' => "Smart Acoustics and Cozy Aesthetics Shape Office in Poznan",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior5',
			'taxonomy' => array(
				'category' => 'decor,diy,furniture',
				'post_tag' => ''
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:furniture:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'10-apps-that-will-change-the-way-you-decorate' => array(
			'title' => "10 Apps That Will Change The Way You Decorate",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior6',
			'taxonomy' => array(
				'category' => 'decor,design,inspiration',
				'post_tag' => 'budget,industrial,minimalist,plants'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:inspiration:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'case-studies-redesign-home-office-room-for-better-productivity' => array(
			'title' => "Case Studies: Redesign Home-Office Room for Better Productivity",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior7',
			'taxonomy' => array(
				'category' => 'decor,design,furniture',
				'post_tag' => ''
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:design:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'putting-a-sofa-in-your-kitchen-is-officially-a-thing' => array(
			'title' => "Putting A Sofa In Your Kitchen Is Officially A Thing",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior8',
			'taxonomy' => array(
				'category' => 'design,diy,furniture',
				'post_tag' => 'budget,industrial,minimalist,plants'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:design:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'a-modernist-sofa-system-for-small-spaces-from-normann-copenhagen' => array(
			'title' => "A Modernist Sofa System for Small Spaces from Normann Copenhagen",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior9',
			'taxonomy' => array(
				'category' => 'design,furniture',
				'post_tag' => 'industrial,office'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:furniture:id}}'),
				'post_subtitle' => 'Choosing the best indoor plants for your interior.'
			)
		),
		'workspaces-ideas-finding-the-right-desk-for-your-small-home-office' => array(
			'title' => "Workspaces Ideas: Finding the Right Desk for Your Small Home Office",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior1',
			'taxonomy' => array(
				'category' => 'design,furniture,inspiration',
				'post_tag' => ''
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:furniture:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'the-beautiful-interior-of-casa-ubud-seminyak-by-leo-dicaplok' => array(
			'title' => "The Beautiful Interior of Casa Ubud Seminyak by Leo DiCaplok",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior2',
			'taxonomy' => array(
				'category' => 'design,furniture,inspiration',
				'post_tag' => 'budget,industrial,minimalist,plants'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:design:id}}'),
				'post_subtitle' => 'Choosing the best indoor plants for your interior.'
			)
		),
		'9-pieces-of-furniture-to-help-you-unwind-after-a-stressful-day' => array(
			'title' => "9 Pieces of Furniture To Help You Unwind After A Stressful Day",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior3',
			'taxonomy' => array(
				'category' => 'diy,furniture,inspiration',
				'post_tag' => ''
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:furniture:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'this-70s-trend-is-making-a-major-comeback-for-your-home' => array(
			'title' => "This '70s Trend Is Making A Major Comeback For Your Home",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior4',
			'taxonomy' => array(
				'category' => 'diy,furniture,inspiration',
				'post_tag' => ''
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:inspiration:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'try-these-diy-projects-to-refresh-your-apartment-for-spring' => array(
			'title' => "Try These DIY Projects to Refresh Your Apartment for Spring",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior5',
			'taxonomy' => array(
				'category' => 'decor,design,diy',
				'post_tag' => 'industrial,office'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:diy:id}}'),
				'post_subtitle' => 'Choosing the best indoor plants for your interior.'
			)
		),
		'these-exciting-home-trends-to-look-out-for-and-follow-in-2017' => array(
			'title' => "These Exciting Home Trends To Look Out For and Follow In 2017",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior6',
			'taxonomy' => array(
				'category' => 'design,furniture,inspiration',
				'post_tag' => 'bohemian,cozy,livingroom,modern'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:design:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'ideas-for-making-the-most-of-that-fifth-wall-you-can-follow' => array(
			'title' => "Ideas for Making The Most of That Fifth Wall You Can Follow",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior7',
			'taxonomy' => array(
				'category' => 'decor,diy,inspiration',
				'post_tag' => 'budget,industrial,minimalist,plants'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:inspiration:id}}'),
				'post_subtitle' => 'Choosing the best indoor plants for your interior.'
			)
		),
		'these-16-stylish-rooms-do-mid-century-modern-right' => array(
			'title' => "These 16 Stylish Rooms Do Mid-century Modern Right",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior8',
			'taxonomy' => array(
				'category' => 'decor,furniture,inspiration',
				'post_tag' => 'budget,industrial,minimalist,plants'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:inspiration:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'how-to-choose-the-best-office-plant-for-your-work-space' => array(
			'title' => "How to Choose the Best Office Plant for Your Work Space",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior9',
			'taxonomy' => array(
				'category' => 'decor,diy,inspiration',
				'post_tag' => ''
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:decor:id}}'),
				'post_subtitle' => 'Choosing the best indoor plants for your interior.'
			)
		),
		'creative-bedroom-workspaces-to-follow-with-style-and-practicality' => array(
			'title' => "Creative Bedroom Workspaces to Follow with Style and Practicality",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior1',
			'taxonomy' => array(
				'category' => 'design,inspiration',
				'post_tag' => ''
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:inspiration:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'daily-inspiration-exquisite-restaurant-interiors-from-around-the-world' => array(
			'title' => "Daily Inspiration: Exquisite Restaurant Interiors From Around the World",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior2',
			'taxonomy' => array(
				'category' => 'decor,design,inspiration',
				'post_tag' => 'budget,industrial,minimalist,plants'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:inspiration:id}}'),
				'post_subtitle' => 'Choosing the best indoor plants for your interior.'
			)
		),
		'the-problem-with-exposed-brick-that-no-one-talks-about' => array(
			'title' => "The Problem With Exposed Brick That No One Talks About",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior3',
			'taxonomy' => array(
				'category' => 'design,diy,inspiration',
				'post_tag' => 'budget,industrial,minimalist,plants'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:diy:id}}'),
				'post_subtitle' => 'Choosing the best indoor plants for your interior.'
			)
		),
		'design-trends-trendy-sofas-and-sectionals-that-captivate-with-color' => array(
			'title' => "Design Trends: Trendy Sofas and Sectionals that Captivate with Color",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior4',
			'taxonomy' => array(
				'category' => 'furniture,inspiration',
				'post_tag' => ''
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:furniture:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'daily-inspiration-cloud-lamp-brings-thunder-and-lightning-indoors' => array(
			'title' => "Daily Inspiration: Cloud Lamp Brings Thunder and Lightning Indoors",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior5',
			'taxonomy' => array(
				'category' => 'decor,diy,inspiration',
				'post_tag' => ''
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:decor:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'daily-ideas-a-country-bedroom-plays-with-gothic-decor' => array(
			'title' => "Daily Ideas: A Country Bedroom Plays With Gothic Decor",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior6',
			'taxonomy' => array(
				'category' => 'decor,diy,inspiration',
				'post_tag' => 'apartment,bedroom,bohemian,modern'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:decor:id}}'),
				'post_subtitle' => 'Choosing the best indoor plants for your interior.'
			)
		),
		'unique-decor-inspiration-that-will-make-your-apartment-cozier' => array(
			'title' => "Unique Decor Inspiration That Will Make Your Apartment Cozier",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior7',
			'taxonomy' => array(
				'category' => 'decor,design,diy',
				'post_tag' => 'apartment,bedroom,bohemian,modern'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:decor:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'daily-ideas-how-to-add-style-to-your-space-with-books' => array(
			'title' => "Daily Ideas: How To Add Style To Your Space With Books",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'interior8',
			'taxonomy' => array(
				'category' => 'diy,furniture,inspiration',
				'post_tag' => ''
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:inspiration:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'21-space-savvy-ideas-for-the-small-modern-bedroom' => array(
			'title' => "21 Space-Savvy Ideas for the Small Modern Bedroom",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'interior9',
			'taxonomy' => array(
				'category' => 'decor,diy,inspiration',
				'post_tag' => 'budget,industrial,minimalist,plants'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:decor:id}}'),
				'post_subtitle' => 'Choosing the best indoor plants for your interior.'
			)
		),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '
.vc_custom_1500537159512{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f5f5f5 !important;}.vc_custom_1500868120265{margin-top: -30px !important;}.vc_custom_1500950008636{margin-bottom: 0px !important;}.vc_custom_1500868255598{margin-bottom: 0px !important;}.vc_custom_1500607933751{margin-bottom: 0px !important;border-bottom-width: 0px !important;}.vc_custom_1500607933751{margin-bottom: 0px !important;border-bottom-width: 0px !important;}.vc_custom_1500868614129{margin-bottom: 40px !important;padding-top: 25px !important;padding-right: 25px !important;padding-bottom: 25px !important;padding-left: 25px !important;background-color: #000000 !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'header_type' => 'heading_9',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '5',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1500537159512{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f5f5f5 !important;}.vc_custom_1500868120265{margin-top: -30px !important;}.vc_custom_1500950008636{margin-bottom: 0px !important;}.vc_custom_1500868255598{margin-bottom: 0px !important;}.vc_custom_1500607933751{margin-bottom: 0px !important;border-bottom-width: 0px !important;}.vc_custom_1500607933751{margin-bottom: 0px !important;border-bottom-width: 0px !important;}.vc_custom_1500868614129{margin-bottom: 40px !important;padding-top: 25px !important;padding-right: 25px !important;padding-bottom: 25px !important;padding-left: 25px !important;background-color: #000000 !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1500631832731{margin-top: -30px !important;}.vc_custom_1500537159512{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f5f5f5 !important;}.vc_custom_1500631765437{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1500869249494{margin-bottom: 0px !important;}.vc_custom_1500957046854{margin-bottom: 0px !important;}.vc_custom_1500607933751{margin-bottom: 0px !important;border-bottom-width: 0px !important;}.vc_custom_1500957067826{margin-bottom: 0px !important;}.vc_custom_1500607933751{margin-bottom: 0px !important;border-bottom-width: 0px !important;}',
                'jnews_page_loop' => array(
	                'enable_page_loop' => '1',
	                'first_title' => '',
	                'header_type' => 'heading_6',
	                'layout' => 'right-sidebar',
	                'sidebar' => 'home',
	                'module'    => '10',
	                'excerpt_length' => '40',
	                'content_date' => 'default',
	                'content_pagination' => 'nav_1',
	                'pagination_align' => 'center',
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1500631832731{margin-top: -30px !important;}.vc_custom_1500537159512{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f5f5f5 !important;}.vc_custom_1500631765437{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1500869249494 .jeg_heroblock_7{margin-bottom: 0px !important;}.vc_custom_1500957046854{margin-bottom: 0px !important;}.vc_custom_1500607933751{margin-bottom: 0px !important;border-bottom-width: 0px !important;}.vc_custom_1500957067826{margin-bottom: 0px !important;}.vc_custom_1500607933751{margin-bottom: 0px !important;border-bottom-width: 0px !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1500885411715{margin-top: -30px !important;}.vc_custom_1500884775946{padding-top: 25px !important;padding-bottom: 25px !important;background-color: #eeeeee !important;}.vc_custom_1500883717252{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1500884137214{margin-bottom: 0px !important;}.vc_custom_1500885880112{margin-bottom: 0px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'header_type' => 'heading_9',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-3',
                    'module'    => '12',
                    'excerpt_length' => '30',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'show_navtext' => '1',
                    'show_pageinfo' => '1',
                    'pagination_align' => 'left',
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1500885411715{margin-top: -30px !important;}.vc_custom_1500884775946{padding-top: 25px !important;padding-bottom: 25px !important;background-color: #eeeeee !important;}.vc_custom_1500883717252{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1500884137214{margin-bottom: 0px !important;}.vc_custom_1500885880112{margin-bottom: 0px !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1500889787002{margin-bottom: 40px !important;padding-top: 25px !important;padding-bottom: 25px !important;background-color: #f5f5f5 !important;}.vc_custom_1500890076080{margin-top: 40px !important;margin-bottom: 60px !important;background-color: #000000 !important;}.vc_custom_1500961591264{margin-bottom: 30px !important;}.vc_custom_1500889591425{margin-bottom: 0px !important;border-bottom-width: 0px !important;}.vc_custom_1500961496570{margin-bottom: 0px !important;}.vc_custom_1500961612461{margin-bottom: 0px !important;}.vc_custom_1500889907248{margin-top: 40px !important;background-color: #000000 !important;}.vc_custom_1500889894823{margin-top: 0px !important;margin-bottom: 40px !important;}',
                'jnews_page_loop' => array(
	                'enable_page_loop' => '1',
	                'first_title' => '',
	                'header_type' => 'heading_9',
	                'layout' => 'right-sidebar',
	                'sidebar' => 'default-sidebar',
	                'module'    => '10',
	                'excerpt_length' => '20',
	                'content_date' => 'default',
	                'content_pagination' => 'nav_1',
	                'pagination_align' => 'center',
	                'post_offset' => 8
                ),
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1500889787002{margin-bottom: 40px !important;padding-top: 25px !important;padding-bottom: 25px !important;background-color: #f5f5f5 !important;}.vc_custom_1500890076080{margin-top: 40px !important;margin-bottom: 60px !important;background-color: #000000 !important;}.vc_custom_1500961591264{margin-bottom: 30px !important;}.vc_custom_1500889591425{margin-bottom: 0px !important;border-bottom-width: 0px !important;}.vc_custom_1500961496570{margin-bottom: 0px !important;}.vc_custom_1500961612461{margin-bottom: 0px !important;}.vc_custom_1500889907248{margin-top: 40px !important;background-color: #000000 !important;}.vc_custom_1500889894823{margin-top: 0px !important;margin-bottom: 40px !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1500890847747{margin-top: -30px !important;}.vc_custom_1500890951961{padding: 25px !important;background-color: #eeeeee !important;}',
                'jnews_page_loop' => array(
	                'enable_page_loop' => '1',
	                'first_title' => '',
	                'header_type' => 'heading_6',
	                'layout' => 'right-sidebar',
	                'sidebar' => 'home-3',
	                'module'    => '26',
	                'excerpt_length' => '40',
	                'content_date' => 'default',
	                'content_pagination' => 'nav_1',
	                'pagination_align' => 'center',
	                'post_offset' => 2
                ),
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1500890847747{margin-top: -30px !important;}.vc_custom_1500890951961{padding: 25px !important;background-color: #eeeeee !important;}'
                )
            )
        ),
        'about' => array(
            'title' => 'About',
            'content' => 'about.txt',
            'post_type' => 'page',
            'metabox' => array(
                'jnews_single_page' => array(
                    'layout' => 'no-sidebar',
                )
            )
        ),
        'contact' => array(
            'title' => 'Contact',
            'content' => 'contact.txt',
            'post_type' => 'page',
            'metabox' => array(
                'jnews_single_page' => array(
                    'layout' => 'left-sidebar',
                    'sidebar' => 'contact-page',
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
        'footer-navigation' => array(
            'title' => 'Footer Navigation',
            'location' => 'footer_navigation'
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
			        'number' => 8,
		        ),
	        )
        ),
        'diy' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'DIY',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:diy:id}}',
		        'menu-item-status' => 'publish'
	        ),
	        'metabox' => array(
		        'menu_item_jnews_mega_menu' => array(
			        'type' => 'category_1',
			        'category' => '{{category:diy:id}}',
			        'number' => 8,
		        ),
	        )
        ),
        'decor' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Decor',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:decor:id}}',
		        'menu-item-status' => 'publish'
	        ),
	        'metabox' => array(
		        'menu_item_jnews_mega_menu' => array(
			        'type' => 'category_1',
			        'category' => '{{category:decor:id}}',
			        'number' => 8,
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
	        )
        ),
        'furniture' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Furniture',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:furniture:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),

        // Mobile Menu
        'mobile-home' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Home',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:home-1:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'mobile-inspiration' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Inspiration',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:inspiration:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'mobile-design' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Design',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:design:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'mobile-decor' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Decor',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:decor:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'mobile-diy' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'DIY',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:diy:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'mobile-furniture' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Furniture',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:furniture:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'mobile-about' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'About',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:about:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'mobile-contact' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Contact',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:contact:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        // Footer & Topbar Menu
        'footer-home' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Home',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:home-1:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'footer-about' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'About',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:about:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'archives' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Archives',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'footer-contact' => array(
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
        'Contact Page',
	    'Home 3'
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
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'jnews-weather',
        'mailchimp-for-wp'
    )

);