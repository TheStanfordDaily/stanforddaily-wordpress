<?php

return array(

    // image
    'image' =>  array(
        'news1'    => 'http://jegtheme.com/asset/jnews/demo/default/travel1.jpg',
        'news2'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion2.jpg',
        'news3'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion3.jpg',
        'news4'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion4.jpg',
        'news5'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion5.jpg',
        'news6'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion6.jpg',
        'news7'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion1.jpg',
        'news8'    => 'http://jegtheme.com/asset/jnews/demo/default/travel2.jpg',
        'news9'    => 'http://jegtheme.com/asset/jnews/demo/default/travel3.jpg',

        'favicon'   => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'logo'      => 'http://jegtheme.com/asset/jnews/demo/magazine/logo.png',
        'logo2x'    => 'http://jegtheme.com/asset/jnews/demo/magazine/logo@2x.png',
        'footer_logo' => 'http://jegtheme.com/asset/jnews/demo/magazine/footer_logo.png',
        'footer_logo2x' => 'http://jegtheme.com/asset/jnews/demo/magazine/footer_logo@2x.png',

        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'business' =>
                array(
                    'title' =>'Business',
                    'description' => ''
                ),
            'entertainment' =>
	            array(
		            'title' =>'Entertainment',
		            'description' => ''
	            ),
            'lifestyle' =>
	            array(
		            'title' =>'Lifestyle',
		            'description' => ''
	            ),
            'fashion' =>
	            array(
		            'title' =>'Fashion',
		            'description' => '',
		            'parent' => 'lifestyle'
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
            'travel' =>
	            array(
		            'title' =>'Travel',
		            'description' => '',
		            'parent' => 'lifestyle'
	            ),
            'sports' =>
	            array(
		            'title' =>'Sports',
		            'description' => ''
	            ),
            'world' =>
	            array(
		            'title' =>'World',
		            'description' => ''
	            ),
        ),
        'post_tag' => array(
            'bitcoin' => array(
                'title' => 'Bitcoin'
            ),
            'champions-league' => array(
	            'title' => 'Champions League'
            ),
            'explore-bali' => array(
	            'title' => 'Explore Bali'
            ),
            'golden-globes-2018' => array(
	            'title' => 'Golden Globes 2018'
            ),
            'grammy-awards' => array(
	            'title' => 'Grammy Awards'
            ),
            'harbolnas' => array(
	            'title' => 'Harbolnas'
            ),
            'litecoin' => array(
	            'title' => 'Litecoin'
            ),
            'market-stories' => array(
	            'title' => 'Market Stories'
            ),
            'united-stated' => array(
	            'title' => 'United Stated'
            )
        )
    ),

    // post & page
    'post' => array(
	    'economists-see-few-monetary-policy-changes-with-powell-leading-fed' => array(
		    'title' => "Economists See Few Monetary Policy Changes With Powell Leading Fed",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news1',
		    'taxonomy' => array(
			    'category' => 'business,food,health,lifestyle',
			    'post_tag' => 'explore-bali,golden-globes-2018,market-stories,united-stated'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}'),
			    'post_subtitle' => 'A budget tells us what we can\'t afford, but it doesn\'t keep us from buying it.',
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'jekardah-nightlife-offers-many-hotspots-for-people-with-alternative-lifestyles' => array(
			'title' => "Jekardah Nightlife Offers Many Hotspots for People with Alternative Lifestyles",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news2',
			'taxonomy' => array(
				'category' => 'entertainment,lifestyle,travel',
				'post_tag' => 'explore-bali,harbolnas,market-stories,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'these-foods-to-absolutely-avoid-if-you-want-clear-glowing-skin' => array(
			'title' => "These Foods to Absolutely Avoid If You Want Clear, Glowing Skin",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'entertainment,food,health,lifestyle',
				'post_tag' => 'champions-league,grammy-awards,harbolnas,litecoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'instagram-is-testing-photo-albums-because-nothing-is-sacred-anymore' => array(
			'title' => "Instagram Is Testing Photo Albums, Because Nothing Is Sacred Anymore",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'entertainment,food,lifestyle',
				'post_tag' => 'champions-league,explore-bali,grammy-awards,harbolnas'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:entertainment:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'10-fashion-stories-from-around-the-web-you-might-have-missed-this-week' => array(
			'title' => "10 Fashion Stories From Around The Web You Might Have Missed This Week",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'entertainment,fashion,lifestyle',
				'post_tag' => 'champions-league,golden-globes-2018,grammy-awards,litecoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'chinese-rooftopper-films-his-own-death-during-skyscraper-stunt' => array(
			'title' => "Chinese 'Rooftopper' Films His Own Death During Skyscraper Stunt",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news6',
			'taxonomy' => array(
				'category' => 'health,lifestyle,sports,travel,world',
				'post_tag' => 'bitcoin,champions-league,golden-globes-2018,grammy-awards'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:world:id}}'),
				'post_subtitle' => 'Website schema using JSON LD which is recommended by Google.',
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'indonesias-largest-fleet-of-taxis-teams-up-to-beat-ride-hailing-apps' => array(
			'title' => "Indonesia’s Largest Fleet of Taxis Teams Up To Beat Ride-Hailing Apps",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news7',
			'taxonomy' => array(
				'category' => 'business,lifestyle,sports,travel,world',
				'post_tag' => 'bitcoin,explore-bali,harbolnas,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:world:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'nike-invented-self-lacing-sneakers-because-the-future-is-now' => array(
			'title' => "Nike Invented Self-Lacing Sneakers Because the Future Is Now",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'fashion,health,lifestyle,sports',
				'post_tag' => 'bitcoin,champions-league,explore-bali,golden-globes-2018,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'research-reveals-drinking-coffee-could-protect-against-some-types-of-cancer' => array(
			'title' => "Research Reveals: Drinking Coffee Could Protect Against Some Types of Cancer",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news9',
			'taxonomy' => array(
				'category' => 'food,health,lifestyle',
				'post_tag' => 'bitcoin,explore-bali,golden-globes-2018,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'olivia-munns-one-piece-swimsuit-plunges-further-than-you-thought-possible' => array(
			'title' => "Olivia Munn's One-Piece Swimsuit Plunges Further Than You Thought Possible",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news1',
			'taxonomy' => array(
				'category' => 'business,entertainment,fashion,lifestyle',
				'post_tag' => 'bitcoin,champions-league,harbolnas,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:entertainment:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'elton-john-tells-noel-gallagher-what-he-thinks-about-his-new-album' => array(
			'title' => "Elton John Tells Noel Gallagher What He Thinks About His New Album",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news2',
			'taxonomy' => array(
				'category' => 'entertainment,fashion,lifestyle,travel',
				'post_tag' => 'champions-league,golden-globes-2018,litecoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:entertainment:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'these-delicious-balinese-street-foods-you-need-to-try-right-now' => array(
			'title' => "These Delicious Balinese Street Foods You Need To Try Right Now",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'food,lifestyle,travel,world',
				'post_tag' => 'bitcoin,explore-bali,harbolnas,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'three-arrested-after-masked-youths-launch-firebomb-attack-on-synagogue' => array(
			'title' => "Three Arrested After Masked Youths Launch Firebomb Attack On Synagogue",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'travel,world',
				'post_tag' => 'explore-bali,golden-globes-2018,grammy-awards,litecoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:world:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'fashion-girls-these-are-the-17-chic-flats-everyone-will-want-in-2018' => array(
			'title' => "Fashion Girls! These Are the 17 Chic Flats Everyone Will Want in 2018",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'entertainment,fashion,lifestyle',
				'post_tag' => 'explore-bali,harbolnas,market-stories,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'barack-obama-and-family-visit-balinese-paddy-fields-during-vacation' => array(
			'title' => "Barack Obama and Family Visit Balinese Paddy Fields During Vacation",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news6',
			'taxonomy' => array(
				'category' => 'entertainment,lifestyle,travel,world',
				'post_tag' => 'explore-bali,harbolnas,litecoin,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'this-easy-cardio-swap-will-help-you-train-for-a-half-marathon' => array(
			'title' => "This Easy Cardio Swap Will Help You Train for A Half Marathon",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news7',
			'taxonomy' => array(
				'category' => 'health,sports',
				'post_tag' => 'explore-bali,harbolnas,market-stories,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'john-browny-could-have-been-the-super-bowl-mvp-if-the-gagak-hadnt-blown-it' => array(
			'title' => "John Browny Could Have Been The Super Bowl MVP If The Gagak Hadn’t Blown It",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'entertainment,sports',
				'post_tag' => 'champions-league,harbolnas,litecoin,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'post_subtitle' => 'Automatic import will install plugin, import dummy content & style to replicate demo completely.',
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'hannah-donker-talks-being-the-weeknds-love-interest-in-secrets' => array(
			'title' => "Hannah Donker talks being The Weeknd’s love interest in ‘Secrets’",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news9',
			'taxonomy' => array(
				'category' => 'business,entertainment,fashion,health',
				'post_tag' => 'champions-league,grammy-awards,litecoin,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:entertainment:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'betterment-moves-beyond-robo-advising-with-human-financial-planners' => array(
			'title' => "Betterment Moves Beyond Robo-Advising with Human Financial Planners",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news1',
			'taxonomy' => array(
				'category' => 'entertainment,lifestyle,sports,travel',
				'post_tag' => 'explore-bali,harbolnas,market-stories,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'what-your-legs-could-be-telling-you-about-your-heart-health' => array(
			'title' => "What Your Legs Could Be Telling You About Your Heart Health",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news2',
			'taxonomy' => array(
				'category' => 'food,health,lifestyle,sports',
				'post_tag' => 'explore-bali,golden-globes-2018,grammy-awards,litecoin,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'high-street-retailers-pin-hopes-on-discount-splurge-in-black-friday-fever' => array(
			'title' => "High Street Retailers Pin Hopes On Discount Splurge In Black Friday Fever",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'business,travel,world',
				'post_tag' => 'harbolnas,litecoin,market-stories,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'bitcoin-is-definitely-not-a-fraud-ceo-of-mobile-only-bank-revolut-says' => array(
			'title' => "Bitcoin Is ‘Definitely Not A Fraud,’ CEO of Mobile-Only Bank Revolut Says",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'business,entertainment',
				'post_tag' => 'bitcoin,grammy-awards,market-stories,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'u-s-online-sales-surge-shoppers-throng-stores-on-thanksgiving-evening' => array(
			'title' => "U.S. Online Sales Surge, Shoppers Throng Stores On Thanksgiving Evening",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'business,entertainment,fashion,lifestyle,sports',
				'post_tag' => 'bitcoin,harbolnas,litecoin,market-stories,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'the-victorias-secret-2016-show-was-straight-out-of-game-of-thrones' => array(
			'title' => "The Victoria’s Secret 2016 Show Was Straight Out Of ‘Game of Thrones’",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news6',
			'taxonomy' => array(
				'category' => 'entertainment,fashion,lifestyle',
				'post_tag' => 'explore-bali,harbolnas,market-stories,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'california-fires-this-is-what-happens-when-you-breathe-in-smoke' => array(
			'title' => "California Fires: This Is What Happens When You Breathe In Smoke",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news7',
			'taxonomy' => array(
				'category' => 'health,world',
				'post_tag' => 'explore-bali,harbolnas,market-stories,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'united-and-city-dispute-the-blame-for-manchester-derby-tunnel-bust-up' => array(
			'title' => "United And City Dispute The Blame for Manchester Derby Tunnel Bust-up",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'entertainment,sports',
				'post_tag' => 'bitcoin,champions-league,harbolnas,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'trump-ambassador-beat-and-kidnapped-woman-in-watergate-cover-up-reports' => array(
			'title' => "Trump Ambassador Beat And ‘Kidnapped’ Woman In Watergate Cover-up: Reports",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news9',
			'taxonomy' => array(
				'category' => 'business,travel,world',
				'post_tag' => 'explore-bali,golden-globes-2018,market-stories,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:world:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
			)
		),
		'watch-as-flares-are-set-off-in-the-crowd-to-mark-liam-gallaghers-arrival-in-glasgow' => array(
			'title' => "Watch As Flares Are Set Off In The Crowd To Mark Liam Gallagher’s Arrival In Glasgow",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news1',
			'taxonomy' => array(
				'category' => 'entertainment,fashion,lifestyle,world',
				'post_tag' => 'bitcoin,champions-league,grammy-awards,harbolnas',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:entertainment:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0',
				'jnews_single_post' => array(
					'override_template' => '1',
					'override' => array(
						array(
							'template' => '8',
							'parallax' => '1',
							'fullscreen' => '0',
							'layout' => 'right-sidebar',
							'sidebar' => 'default-sidebar',
							'sticky_sidebar' => '1',
							'share_position' => 'top',
							'share_float_style' => 'share-monocrhome',
							'show_share_counter' => '1',
							'show_view_counter' => '1',
							'show_featured' => '1',
							'show_post_meta' => '1',
							'show_post_author' => '1',
							'show_post_author_image' => '1',
							'show_post_date' => '1',
							'show_post_category' => '1',
							'show_post_tag' => '1',
							'show_prev_next_post' => '1',
							'show_popup_post' => '1',
							'number_popup_post' => '1',
							'show_author_box' => '0',
							'show_post_related' => '1',
							'show_inline_post_related' => '0',
						)
					)
				)
			)
		),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1513228265772{background-color: #262b2f !important;}',
	            '_wpb_post_custom_css' => '.jeg_postblock_22 .jeg_post_meta {display: none;}',
                'jnews_page_loop' => array(
	                'enable_page_loop' => '1',
	                'first_title' => 'Latest Post',
	                'second_title' => '',
	                'header_type' => 'heading_1',
	                'layout' => 'right-sidebar',
	                'sidebar' => 'home-loop',
	                'sticky_sidebar' => '1',
	                'module'    => '5',
	                'excerpt_length' => '20',
	                'content_date' => 'default',
	                'content_pagination' => 'nav_1',
	                'pagination_align' => 'center',
	                'show_navtext' => '0',
	                'show_pageinfo' => '0',
	                'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.jeg_postblock_22 .jeg_post_meta {display: none;}'
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
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'default-sidebar',
                    'sticky_sidebar' => '1',
                    'module'    => '3',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                ),
                '_elementor_data' => '',
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
        'mobile-navigation' => array(
            'title' => 'Mobile Navigation',
            'location' => 'mobile_navigation'
        ),
        'top-navigation' => array(
            'title' => 'Top Bar Navigation',
            'location' => 'top_navigation'
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

        'world' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'World',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:world:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
	            'menu_item_jnews_mega_menu' => array(
		            'type' => 'category_1',
		            'category' => '{{category:world:id}}',
		            'number' => 7,
	            ),
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
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_2',
                    'category' => '{{category:lifestyle:id}}',
                    'number' => 6,
                    'trending_tag' => '{{taxonomy:post_tag:bitcoin:id}},{{taxonomy:post_tag:champions-league:id}},{{taxonomy:post_tag:explore-bali:id}},{{taxonomy:post_tag:golden-globes-2018:id}},{{taxonomy:post_tag:grammy-awards:id}},{{taxonomy:post_tag:harbolnas:id}}',
                ),
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
	        ),
	        'metabox' => array(
		        'menu_item_jnews_mega_menu' => array(
			        'type' => 'category_2',
			        'category' => '{{category:business:id}}',
			        'number' => 6,
			        'trending_tag' => '{{taxonomy:post_tag:market-stories:id}},{{taxonomy:post_tag:bitcoin:id}},{{taxonomy:post_tag:litecoin:id}},{{taxonomy:post_tag:harbolnas:id}},{{taxonomy:post_tag:united-stated:id}}',
		        ),
	        )
        ),
        'entertainment' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Entertainment',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:entertainment:id}}',
		        'menu-item-status' => 'publish'
	        ),
	        'metabox' => array(
		        'menu_item_jnews_mega_menu' => array(
			        'type' => 'category_2',
			        'category' => '{{category:entertainment:id}}',
			        'number' => 6,
			        'trending_tag' => '{{taxonomy:post_tag:golden-globes-2018:id}},{{taxonomy:post_tag:grammy-awards:id}},{{taxonomy:post_tag:explore-bali:id}},{{taxonomy:post_tag:champions-league:id}},{{taxonomy:post_tag:harbolnas:id}}',
		        ),
	        )
        ),
        'sports' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Sports',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:sports:id}}',
		        'menu-item-status' => 'publish'
	        ),
	        'metabox' => array(
		        'menu_item_jnews_mega_menu' => array(
			        'type' => 'category_2',
			        'category' => '{{category:sports:id}}',
			        'number' => 6,
			        'trending_tag' => '{{taxonomy:post_tag:champions-league:id}},{{taxonomy:post_tag:explore-bali:id}},{{taxonomy:post_tag:harbolnas:id}},{{taxonomy:post_tag:united-stated:id}},{{taxonomy:post_tag:market-stories:id}},{{taxonomy:post_tag:litecoin:id}}',
		        ),
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
        'landing' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Landing Page',
                'menu-item-type' => 'custom',
                'menu-item-url' => 'https://jnews.io/landing/',
                'menu-item-status' => 'publish'
            )
        ),
        'buy' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Buy JNews',
                'menu-item-type' => 'custom',
                'menu-item-url' => 'https://themeforest.net/item/jnews-wordpress-blog-news-magazine-newspaper-theme/20566392?ref=jegtheme&license=regular&open_purchase_for_item_id=20566392',
                'menu-item-status' => 'publish'
            )
        ),
        'support' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Support Forum',
                'menu-item-type' => 'custom',
                'menu-item-url' => 'https://themeforest.net/item/jnews-wordpress-blog-news-magazine-newspaper-theme/20566392?ref=jegtheme&license=regular&open_purchase_for_item_id=20566392',
                'menu-item-status' => 'publish'
            )
        ),
        'pre' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Pre-sale Question',
                'menu-item-type' => 'custom',
                'menu-item-url' => 'https://themeforest.net/item/jnews-one-stop-solution-for-web-publishing/20566392/comments?ref=jegtheme',
                'menu-item-status' => 'publish'
            )
        ),
        'contact' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Contact Us',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => 'https://themeforest.net/user/jegtheme?ref=jegtheme',
		        'menu-item-status' => 'publish'
	        )
        ),


        // Topbar Menu
        'landing-1' => array(
	        'location' => 'top-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Landing Page',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => 'https://jnews.io/landing/',
		        'menu-item-status' => 'publish'
	        )
        ),
        'shop' => array(
	        'location' => 'top-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Shop',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => 'https://jnews.io/landing/',
		        'menu-item-status' => 'publish'
	        )
        ),
        'contact-1' => array(
	        'location' => 'top-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Contact',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => '#',
		        'menu-item-status' => 'publish'
	        )
        ),
        'buy-1' => array(
	        'location' => 'top-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Buy JNews',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => 'https://themeforest.net/item/jnews-wordpress-blog-news-magazine-newspaper-theme/20566392?ref=jegtheme&license=regular&open_purchase_for_item_id=20566392',
		        'menu-item-status' => 'publish'
	        )
        ),
    ),

    'widget_position' => array(
        'Home - Loop',
        'Home',
        'Archives',
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'contact-form-7',
        'jnews-essential',
	    'jnews-customizer-category',
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