<?php

return array(

    // image
    'image' =>  array(
	    'news1' => 'http://jegtheme.com/asset/jnews/demo/default/news1.jpg',
	    'news2' => 'http://jegtheme.com/asset/jnews/demo/default/news2.jpg',
	    'news3' => 'http://jegtheme.com/asset/jnews/demo/default/news3.jpg',
	    'news4' => 'http://jegtheme.com/asset/jnews/demo/default/news4.jpg',
	    'news5' => 'http://jegtheme.com/asset/jnews/demo/default/news5.jpg',
	    'news6' => 'http://jegtheme.com/asset/jnews/demo/default/news6.jpg',
	    'news7' => 'http://jegtheme.com/asset/jnews/demo/default/news7.jpg',
	    'news8' => 'http://jegtheme.com/asset/jnews/demo/default/news8.jpg',
	    'news9' => 'http://jegtheme.com/asset/jnews/demo/default/news9.jpg',
	    'news10' => 'http://jegtheme.com/asset/jnews/demo/default/news10.jpg',
	    'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
	    'logo' => 'http://jegtheme.com/asset/jnews/demo/localnews/logo.png',
	    'logo2x' => 'http://jegtheme.com/asset/jnews/demo/localnews/logo@2x.png',
	    'footer_logo' => 'http://jegtheme.com/asset/jnews/demo/localnews/footer_logo.png',
	    'footer_logo2x' => 'http://jegtheme.com/asset/jnews/demo/localnews/footer_logo@2x.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png',
	    'ad_vertical' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/ad_vertical.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'business' => array(
                'title' =>'Business',
                'description' => 'You can add some category description here.'
            ),
            'culture' => array(
	            'title' =>'Culture',
	            'description' => 'You can add some category description here.'
            ),
            'lifestyle' => array(
	            'title' =>'Lifestyle',
	            'description' => 'You can add some category description here.'
            ),
            'national' => array(
	            'title' =>'National',
	            'description' => 'You can add some category description here.'
            ),
            'news' => array(
	            'title' =>'News',
	            'description' => 'You can add some category description here.'
            ),
            'opinion' => array(
	            'title' =>'Opinion',
	            'description' => 'You can add some category description here.'
            ),
            'politics' => array(
	            'title' =>'Politics',
	            'description' => 'You can add some category description here.'
            ),
            'sports' => array(
	            'title' =>'Sports',
	            'description' => 'You can add some category description here.'
            ),
            'travel' => array(
	            'title' =>'Travel',
	            'description' => 'You can add some category description here.'
            )
        ),
        'post_tag' => array(
            '2018-league' => array(
                'title' => '2018 League'
            ),
            'bali-united' => array(
	            'title' => 'Bali United'
            ),
            'balinese-culture' => array(
	            'title' => 'Balinese Culture'
            ),
            'budget-travel' => array(
	            'title' => 'Budget Travel'
            ),
            'champions-league' => array(
	            'title' => 'Champions League'
            ),
            'chopper-bike' => array(
	            'title' => 'Chopper Bike'
            ),
            'doctor-terawan' => array(
	            'title' => 'Doctor Terawan'
            ),
            'istana-negara' => array(
	            'title' => 'Istana Negara'
            ),
            'market-stories' => array(
	            'title' => 'Market Stories'
            ),
            'national-exam' => array(
	            'title' => 'National Exam'
            ),
            'visit-bali' => array(
	            'title' => 'Visit Bali'
            ),
        )
    ),

    // post & page
    'post' => array(
	    'mobile-data-not-internet-service-providers-to-be-blocked-in-bali-during-nyepi' => array(
		    'title' => "Mobile Data, Not Internet Service Providers, To Be Blocked In Bali During Nyepi",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news1',
		    'taxonomy' => array(
			    'category' => 'business,national,news,politics',
			    'post_tag' => '2018-league,bali-united,balinese-culture,champions-league,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:politics:id}}')
		    )
	    ),
	    'jokowi-needs-multidimensional-dialogue-on-criminal-code-bill-alliance' => array(
		    'title' => "Jokowi Needs Multidimensional Dialogue On Criminal Code Bill: Alliance",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news2',
		    'taxonomy' => array(
			    'category' => 'business,lifestyle,national,politics',
			    'post_tag' => 'bali-united,balinese-culture,budget-travel,chopper-bike,istana-negara,market-stories'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:politics:id}}')
		    )
	    ),
	    'china-to-build-indonesias-longest-bridge-in-north-kalimantan' => array(
		    'title' => "China To Build Indonesia’s Longest Bridge In North Kalimantan",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news3',
		    'taxonomy' => array(
			    'category' => 'business,national,politics,travel',
			    'post_tag' => '2018-league,balinese-culture,champions-league,doctor-terawan,market-stories,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}')
		    )
	    ),
	    'indonesia-among-top-10-destinations-for-chinese-tourists-in-2017' => array(
		    'title' => "Indonesia Among Top 10 Destinations For Chinese Tourists In 2017",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news4',
		    'taxonomy' => array(
			    'category' => 'business,lifestyle,news,travel',
			    'post_tag' => '2018-league,balinese-culture,champions-league,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:travel:id}}')
		    )
	    ),
	    'indonesia-to-offer-infrastructure-projects-at-imf-world-bank-meeting' => array(
		    'title' => "Indonesia To Offer Infrastructure Projects At IMF-World Bank Meeting",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news5',
		    'taxonomy' => array(
			    'category' => 'business,culture,national,politics',
			    'post_tag' => 'balinese-culture,champions-league,doctor-terawan,national-exam,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}'),
			    'post_subtitle' => 'Victory has a thousand fathers, but defeat is an orphan.'
		    )
	    ),
	    'ngurah-rai-international-airport-to-close-for-24-hours-for-nyepi' => array(
		    'title' => "Ngurah Rai International Airport To Close For 24 Hours For Nyepi",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news6',
		    'taxonomy' => array(
			    'category' => 'business,national,politics',
			    'post_tag' => 'balinese-culture,champions-league,doctor-terawan,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:politics:id}}')
		    )
	    ),
	    'nyepi-celebrations-mobile-internet-turned-off-for-balis-new-year' => array(
		    'title' => "Nyepi Celebrations: Mobile Internet Turned Off For Bali's New Year",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news7',
		    'taxonomy' => array(
			    'category' => 'lifestyle,national,news,politics,travel',
			    'post_tag' => 'bali-united,balinese-culture,budget-travel,champions-league,istana-negara,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:national:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'presidential-train-now-available-for-jakartans-traveling-to-bandung' => array(
		    'title' => "Presidential Train Now Available For Jakartans Traveling To Bandung",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news8',
		    'taxonomy' => array(
			    'category' => 'business,culture,lifestyle,opinion,travel',
			    'post_tag' => '2018-league,balinese-culture,champions-league,chopper-bike,doctor-terawan,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:travel:id}}')
		    )
	    ),
	    'a-digital-media-startup-growing-up-with-millennial-women' => array(
		    'title' => "A Digital Media Startup Growing Up With Millennial Women",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news9',
		    'taxonomy' => array(
			    'category' => 'business,culture,opinion',
			    'post_tag' => 'bali-united,budget-travel,istana-negara,market-stories,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:opinion:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'indonesia-is-bringing-free-wi-fi-to-more-than-1000-villages-this-year' => array(
		    'title' => "Indonesia Is Bringing Free Wi-fi To More Than 1,000 Villages This Year",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news10',
		    'taxonomy' => array(
			    'category' => 'business,national,news',
			    'post_tag' => '2018-league,bali-united,chopper-bike,doctor-terawan,market-stories,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:national:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'tourists-from-us-singapore-are-frequent-users-of-airbnb-in-south-korea' => array(
		    'title' => "Tourists from US, Singapore are frequent users of Airbnb in South Korea",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news1',
		    'taxonomy' => array(
			    'category' => 'lifestyle,national,news,travel',
			    'post_tag' => 'balinese-culture,budget-travel,doctor-terawan,istana-negara,national-exam,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
			    'post_subtitle' => 'Before anything else, preparation is the key to success.'
		    )
	    ),
	    'indonesias-largest-fleet-of-taxis-teams-up-to-beat-ride-hailing-apps' => array(
		    'title' => "Indonesia's Largest Fleet Of Taxis Teams Up To Beat Ride-hailing Apps",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news2',
		    'taxonomy' => array(
			    'category' => 'business,lifestyle,national,opinion,travel',
			    'post_tag' => '2018-league,bali-united,budget-travel,istana-negara,market-stories'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}')
		    )
	    ),
	    'trump-didnt-record-comey-white-house-tells-house-intel-panel' => array(
		    'title' => "Thousands of peoples leaving Bali via port to skip 'Day of Silence'",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news3',
		    'taxonomy' => array(
			    'category' => 'culture,lifestyle,news,opinion',
			    'post_tag' => '2018-league,bali-united,balinese-culture,budget-travel,istana-negara,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:culture:id}}'),
			    'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
		    )
	    ),
	    'finland-has-an-education-system-the-other-country-should-learn-from' => array(
		    'title' => "Finland Has An Education System The Other Country Should Learn From",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news4',
		    'taxonomy' => array(
			    'category' => 'business,national,news,opinion',
			    'post_tag' => 'bali-united,chopper-bike,market-stories,national-exam,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:opinion:id}}'),
			    'post_subtitle' => 'Before anything else, preparation is the key to success.'
		    )
	    ),
	    'women-in-politics-urgency-of-quota-system-for-women-in-regional-elections' => array(
		    'title' => "Women in Politics: Urgency of Quota System For Women In Regional Elections",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news5',
		    'taxonomy' => array(
			    'category' => 'national,opinion,politics',
			    'post_tag' => '2018-league,bali-united,budget-travel,chopper-bike,doctor-terawan,istana-negara'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:politics:id}}')
		    )
	    ),
	    'life-on-the-edge-at-home-in-mount-agungs-danger-zone' => array(
		    'title' => "Life on the Edge: At home in Mount Agung’s Danger Zone",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news6',
		    'taxonomy' => array(
			    'category' => 'business,culture,lifestyle,travel',
			    'post_tag' => 'bali-united,budget-travel,champions-league,istana-negara,market-stories,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
			    'post_subtitle' => 'Before anything else, preparation is the key to success.'
		    )
	    ),
	    'commentary-why-2019-indonesian-presidential-election-is-all-about-2024' => array(
		    'title' => "Commentary: Why 2019 Indonesian Presidential Election is all about 2024",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news7',
		    'taxonomy' => array(
			    'category' => 'national,opinion,politics',
			    'post_tag' => 'balinese-culture,budget-travel,champions-league,doctor-terawan,market-stories,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:opinion:id}}')
		    )
	    ),
	    'super-bowl-2017-heres-how-many-people-watched-the-super-bowl' => array(
		    'title' => "Super Bowl 2017: Here’s How Many People Watched the Super Bowl",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news8',
		    'taxonomy' => array(
			    'category' => 'news,opinion,sports',
			    'post_tag' => 'chopper-bike,istana-negara,market-stories,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
			    'post_subtitle' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.'
		    )
	    ),
	    'what-you-need-to-know-about-sacred-balinese-dance-sanghyang-jaran-dance' => array(
		    'title' => "What You Need to Know About Sacred Balinese Dance: Sanghyang Jaran Dance",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news9',
		    'taxonomy' => array(
			    'category' => 'culture,lifestyle,travel',
			    'post_tag' => 'budget-travel,champions-league,chopper-bike,doctor-terawan,national-exam,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:opinion:id}}'),
			    'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.',
			    'jnews_single_post' => array(
				    'override_template' => '1',
				    'override' => array(
					    array(
						    'template' => '2',
						    'parallax' => '1',
						    'fullscreen' => '0',
						    'layout' => 'right-sidebar',
						    'sidebar' => 'default-sidebar',
						    'sticky_sidebar' => '0',
						    'share_position' => 'top',
						    'share_float_style' => 'share-monocrhome',
						    'show_share_counter' => '1',
						    'show_view_counter' => '1',
						    'show_featured' => '1',
						    'show_post_meta' => '1',
						    'show_post_author' => '1',
						    'show_post_author_image' => '0',
						    'show_post_date' => '1',
						    'post_date_format' => '',
						    'post_date_format_custom' => '',
						    'show_post_category' => '1',
						    'show_post_tag' => '1',
						    'show_prev_next_post' => '0',
						    'show_popup_post' => '1',
						    'number_popup_post' => '1',
						    'show_author_box' => '1',
						    'show_post_related' => '1',
						    'show_inline_post_related' => '0',
					    )
				    ),
				    'override_image_size' => '1',
				    'image_override' => array(
					    array(
						    'single_post_thumbnail_size' => 'crop-715',
						    'single_post_gallery_size' => 'crop-500',
					    )
				    )
			    )
		    )
	    ),
	    'official-bali-united-recruit-milos-krkotic-ex-montenegro-national-team-players' => array(
		    'title' => "Official, Bali United Recruit Milos Krkotic, Ex-Montenegro National Team Players",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news10',
		    'taxonomy' => array(
			    'category' => 'news,sports',
			    'post_tag' => '2018-league,budget-travel,champions-league,chopper-bike,market-stories,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:sports:id}}')
		    )
	    ),
	    'five-london-tower-blocks-evacuated-over-cladding-safety-fears' => array(
		    'title' => "Millions of Indigenous People May Lose Voting Rights: Alliance",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news1',
		    'taxonomy' => array(
			    'category' => 'culture,national,news,travel',
			    'post_tag' => '2018-league,balinese-culture,budget-travel,chopper-bike,istana-negara,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:news:id}}'),
			    'post_subtitle' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.'
		    )
	    ),
	    'the-benefits-of-running-that-make-you-healthier-and-happier' => array(
		    'title' => "The Benefits of Running That Make You Healthier and Happier",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news2',
		    'taxonomy' => array(
			    'category' => 'lifestyle,opinion,sports',
			    'post_tag' => '2018-league,bali-united,chopper-bike,istana-negara,market-stories'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
			    'post_subtitle' => 'Self-belief and hard work will always earn you success.'
		    )
	    ),
	    'president-joko-jokowi-widodo-refuses-to-sign-md3-law' => array(
		    'title' => "President Joko \"Jokowi\" Widodo Refuses to Sign MD3 Law",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'national,news,politics',
				'post_tag' => '2018-league,bali-united,balinese-culture,champions-league,istana-negara,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
			)
		),
		'not-thieves-but-wife-cleared-funds-out-of-customer-account-says-bri' => array(
			'title' => "Not Thieves, But Wife, Cleared Funds Out Of Customer Account, Says BRI",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'business,news,opinion',
				'post_tag' => '2018-league,bali-united,budget-travel,doctor-terawan,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}')
			)
		),
		'how-to-find-protests-in-your-city-when-you-dont-know-where-to-start' => array(
			'title' => "Bawaslu finds Crescent Star Party eligible for Indonesia's 2019 elections",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'national,opinion,politics',
				'post_tag' => 'balinese-culture,champions-league,doctor-terawan,istana-negara,market-stories,national-exam'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
		'trump-may-special-relationship-gets-special-treatment-in-the-streets-of-london' => array(
			'title' => "Everything You Need to Know About Climbing in Bali’s Mount Batur",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news6',
			'taxonomy' => array(
				'category' => 'sports,travel',
				'post_tag' => 'balinese-culture,champions-league,chopper-bike,doctor-terawan,istana-negara,market-stories,visit-bali'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
				'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.'
			)
		),
		'gopros-karma-drone-is-back-on-sale-after-design-flaw-made-them-fall-out-of-the-sky' => array(
			'title' => "Could Cristiano Ronaldo really be about to leave Real Madrid?",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news7',
			'taxonomy' => array(
				'category' => 'news,opinion,sports',
				'post_tag' => 'bali-united,budget-travel,doctor-terawan,istana-negara,national-exam,visit-bali'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:news:id}}'),
				'post_subtitle' => 'Before anything else, preparation is the key to success.'
			)
		),
		'of-course-this-novelty-final-fantasy-fork-is-an-oversized-sword-replica' => array(
			'title' => "How The Premier League Became A Dream Destination For Young Brazilians",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'culture,lifestyle,national,sports',
				'post_tag' => '2018-league,champions-league,chopper-bike,doctor-terawan,market-stories,visit-bali'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'post_subtitle' => 'Victory has a thousand fathers, but defeat is an orphan.'
			)
		),
		'nike-invented-self-lacing-sneakers-because-the-future-is-now' => array(
			'title' => "Nike Invented Self-Lacing Sneakers Because the Future Is Now",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news9',
			'taxonomy' => array(
				'category' => 'culture,lifestyle,news,sports',
				'post_tag' => '2018-league,bali-united,chopper-bike,istana-negara,national-exam'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'post_subtitle' => 'A collection of textile samples lay spread out on the table.'
			)
		),
		'indonesian-shuttlers-win-two-titles-at-2017-world-junior-championships' => array(
			'title' => "Indonesian Shuttlers Win Two Titles at 2017 World Junior Championships",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news10',
			'taxonomy' => array(
				'category' => 'lifestyle,national,sports',
				'post_tag' => '2018-league,bali-united,budget-travel,champions-league,chopper-bike,doctor-terawan,istana-negara,national-exam'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.'
			)
		),
		'the-chainsmokers-actually-make-a-great-nickelback-cover-band' => array(
			'title' => "Indonesia Urges Olympic Council of Asia to Promote 2018 Asian Games",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news1',
			'taxonomy' => array(
				'category' => 'national,news,sports',
				'post_tag' => '2018-league,chopper-bike,istana-negara,market-stories,national-exam'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:national:id}}'),
				'post_subtitle' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.'
			)
		),
		'obama-visits-bali-expected-to-promote-indonesian-tourism' => array(
			'title' => "Obama Visits Bali, Expected To Promote Indonesian Tourism",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news2',
			'taxonomy' => array(
				'category' => 'culture,opinion,travel',
				'post_tag' => 'balinese-culture,budget-travel,champions-league,doctor-terawan,national-exam,visit-bali'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
				'post_subtitle' => 'Self-belief and hard work will always earn you success.'
			)
		),
		'cyber-violence-an-emerging-new-reality-for-many-indonesian-women' => array(
			'title' => "Cyber-Violence, an Emerging New Reality for Many Indonesian Women",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'culture,national,opinion,politics',
				'post_tag' => 'balinese-culture,budget-travel,chopper-bike,national-exam'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
		'travel-insider-bengawan-solo-travel-mart-returns-for-ninth-time' => array(
			'title' => "Travel Insider: Bengawan Solo Travel Mart Returns For Ninth Time",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'culture,lifestyle,travel',
				'post_tag' => '2018-league,bali-united,budget-travel,chopper-bike,national-exam'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:travel:id}}')
			)
		),
		'pssi-sends-condolences-after-another-fan-dies-in-football-violence' => array(
			'title' => "PSSI Sends Condolences After Another Fan Dies in Football Violence",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'national,news,sports',
				'post_tag' => 'bali-united,chopper-bike,istana-negara,market-stories,national-exam,visit-bali'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}')
			)
		),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1520846852047{margin-top: -30px !important;border-bottom-width: 1px !important;border-bottom-color: #e0e0e0 !important;border-bottom-style: solid !important;}.vc_custom_1521098579413{margin-bottom: 40px !important;border-bottom-width: 1px !important;background-color: #f7f7f7 !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1521087666319{margin-top: -1px !important;margin-bottom: -1px !important;border-top-width: 0px !important;border-right-width: 0px !important;border-bottom-width: 0px !important;border-left-width: 0px !important;}.vc_custom_1523343309410{margin-bottom: 0px !important;}.vc_custom_1523334745043{margin-bottom: -10px !important;}',
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1520846852047{margin-top: -30px !important;border-bottom-width: 1px !important;border-bottom-color: #e0e0e0 !important;border-bottom-style: solid !important;}.vc_custom_1521098579413{margin-bottom: 40px !important;border-bottom-width: 1px !important;background-color: #f7f7f7 !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1521087666319_{margin-top: -1px !important;margin-bottom: -1px !important;border-top-width: 0px !important;border-right-width: 0px !important;border-bottom-width: 0px !important;border-left-width: 0px !important;}.vc_custom_1523343309410{margin-bottom: 0px !important;}.vc_custom_1523334745043{margin-bottom: -10px !important;}'
                ),
                'jnews_video_cache' => array(
	                'waNUjKODMTg' => array(
		                'type' => 'youtube',
		                'url' => 'https://www.youtube.com/watch?v=waNUjKODMTg',
		                'id' => 'waNUjKODMTg',
		                'title' => 'Sipping Sherry in Spain With the Frugal Traveler | The Daily 360 | The New York Times',
		                'thumbnail' => 'https://i.ytimg.com/vi/waNUjKODMTg/default.jpg',
		                'duration' => '00:01:47'
	                ),
				    'Fgmt38uiH8A' => array(
						'type' => 'youtube',
						'url' => 'https://www.youtube.com/watch?v=Fgmt38uiH8A',
						'id' => 'Fgmt38uiH8A',
						'title' => 'Uber Co-Founder And CEO Travis Kalanick Resigns Due To Intense Pressure From Investors | TIME',
						'thumbnail' => 'https://i.ytimg.com/vi/Fgmt38uiH8A/default.jpg',
						'duration' => '00:01:07'
					),
				    'udrKnXueTW0' => array(
						'type' => 'youtube',
						'url' => 'https://www.youtube.com/watch?v=udrKnXueTW0',
						'id' => 'udrKnXueTW0',
						'title' => 'Watch President Barack Obama\'s full farewell speech',
			            'thumbnail' => 'https://i.ytimg.com/vi/udrKnXueTW0/default.jpg',
			            'duration' => '00:55:44'
			        ),
				    'DrtXjeTEXmo' => array(
						'type' => 'youtube',
						'url' => 'https://www.youtube.com/watch?v=DrtXjeTEXmo',
						'id' => 'DrtXjeTEXmo',
						'title' => 'Dissecting Trump\'s recent financial disclosure',
			            'thumbnail' => 'https://i.ytimg.com/vi/DrtXjeTEXmo/default.jpg',
			            'duration' => '00:04:06'
			        ),
				    'z5QURxhdJSE' => array(
						'type' => 'youtube',
						'url' => 'https://www.youtube.com/watch?v=z5QURxhdJSE',
						'id' => 'z5QURxhdJSE',
						'title' => 'We Are What We Eat: Borneo | Nat Geo Live',
						'thumbnail' => 'https://i.ytimg.com/vi/z5QURxhdJSE/default.jpg',
						'duration' => '00:04:14'
					)
                ),
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '@media (min-width: 992px) {.jeg_sidebar.left.elementor-column {padding-left: 0;padding-right: 30px;}}'
                ),
                'jnews_video_cache' => array(
                    'udrKnXueTW0' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=udrKnXueTW0',
                        'id' => 'udrKnXueTW0',
                        'title' => 'Watch President Barack Obama\'s full farewell speech',
                        'thumbnail' => 'https://i.ytimg.com/vi/udrKnXueTW0/default.jpg',
                        'duration' => '00:55:44'
                    ),
                    'DrtXjeTEXmo' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=DrtXjeTEXmo',
                        'id' => 'DrtXjeTEXmo',
                        'title' => 'Dissecting Trump\'s recent financial disclosure',
                        'thumbnail' => 'https://i.ytimg.com/vi/DrtXjeTEXmo/default.jpg',
                        'duration' => '00:04:06'
                    ),
                    'z5QURxhdJSE' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=z5QURxhdJSE',
                        'id' => 'z5QURxhdJSE',
                        'title' => 'We Are What We Eat: Borneo | Nat Geo Live',
                        'thumbnail' => 'https://i.ytimg.com/vi/z5QURxhdJSE/default.jpg',
                        'duration' => '00:04:14'
                    ),
                    'j-W2i9HHKfw' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=j-W2i9HHKfw',
                        'id' => 'j-W2i9HHKfw',
                        'title' => 'NAT GEO People - Bangladesh visit',
                        'thumbnail' => 'https://i.ytimg.com/vi/j-W2i9HHKfw/default.jpg',
                        'duration' => '00:44:00'
                    ),
                    'U3d_Lfo9aAM' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=U3d_Lfo9aAM',
                        'id' => 'U3d_Lfo9aAM',
                        'title' => 'Oglądaj Cesar Millan na Ratunek na Nat Geo People!',
                        'thumbnail' => 'https://i.ytimg.com/vi/U3d_Lfo9aAM/default.jpg',
                        'duration' => '00:00:31'
                    ),
                    'J1sIp9iw80M' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=J1sIp9iw80M',
                        'id' => 'J1sIp9iw80M',
                        'title' => 'The aquanauts who journey to the bottom of the ocean',
                        'thumbnail' => 'https://i.ytimg.com/vi/J1sIp9iw80M/default.jpg',
                        'duration' => '00:02:47'
                    )
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1523344659552{margin-bottom: 10px !important;}.vc_custom_1523345785419{margin-bottom: 0px !important;}',
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1523344659552{margin-bottom: 10px !important;}.vc_custom_1523345785419{margin-bottom: 0px !important;}'
                )
            )
        ),
        'contact' => array(
            'title' => 'Contact',
            'content' => 'contact.txt',
            'post_type' => 'page',
            'metabox' => array(
                'jnews_single_page' => array(
                    'layout' => 'no-sidebar',
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

        'news' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'News',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:news:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'politics' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Politics',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:politics:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'business' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Business',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:business:id}}',
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
        'opinion' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Opinion',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:opinion:id}}',
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
        'careers' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Careers',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'contact' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Contact',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:contact:id}}',
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
        'politics-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Politics',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:politics:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'news-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'News',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:news:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'business-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Business',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:business:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'science-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Science',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:science:id}}',
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
        'national-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'National',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:national:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'sports-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Sports',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:sports:id}}',
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
        'opinion-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Opinion',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:opinion:id}}',
                'menu-item-status' => 'publish'
            )
        )
    ),

    'widget_position' => array(
        'Author',
        'Single Left',
	    'Archive Left',
	    'Archive Right'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'jnews-breadcrumb',
        'jnews-gallery',
        'jnews-jsonld',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-split',
        'jnews-view-counter',
        'jnews-weather',
    )
);