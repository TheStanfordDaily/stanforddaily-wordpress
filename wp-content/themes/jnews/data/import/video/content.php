<?php

return array(

    // image
    'image' =>  array(
        'video1'    => 'http://jegtheme.com/asset/jnews/demo/default/travel1.jpg',
        'video2'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion2.jpg',
        'video3'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion3.jpg',
        'video4'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion4.jpg',
        'video5'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion5.jpg',
        'video6'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion6.jpg',
        'video7'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion1.jpg',
        'video8'    => 'http://jegtheme.com/asset/jnews/demo/default/travel2.jpg',
        'video9'    => 'http://jegtheme.com/asset/jnews/demo/default/travel3.jpg',
        'video_bg'  => 'http://jegtheme.com/asset/jnews/demo/default/travel4.jpg',
        'logo'      => 'http://jegtheme.com/asset/jnews/demo/video/logo.png',
        'logo2x'    => 'http://jegtheme.com/asset/jnews/demo/video/logo@2x.png',
        'pattern'   => 'http://jegtheme.com/asset/jnews/demo/video/pattern.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'travel' => array(
                'title' => 'Travel',
                'description' => 'You can add some category description here.'
            ),
            'news' => array(
                'title' => 'News',
                'description' => 'You can add some category description here.'
            ),
            'tech' => array(
                'title' => 'Tech',
                'description' => 'You can add some category description here.'
            ),
            'movie' => array(
                'title' => 'Movie',
                'description' => 'You can add some category description here.'
            ),
            'music' => array(
                'title' => 'Music',
                'description' => 'You can add some category description here.'
            ),
            'gaming' => array(
                'title' => 'Gaming',
                'description' => 'You can add some category description here.'
            ),
            'sports' => array(
                'title' => 'Sports',
                'description' => 'You can add some category description here.'
            ),
            'food' => array(
                'title' => 'Food',
                'description' => 'You can add some category description here.'
            ),
        ),

        'post_tag' => array(
        )
    ),

    // post & page
    'post' => array(
	    'this-is-how-all-your-favorite-chefs-make-scrambled-eggs' => array(
		    'title' => "This Is How All Your Favorite Chefs Make Scrambled Eggs",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video1',
		    'taxonomy' => array(
			    'category' => 'food,news,travel',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:food:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=yv64abAJvEA'
		    )
	    ),
	    'radiohead-have-announced-their-own-signature-fender-guitar' => array(
		    'title' => "Radiohead Have Announced Their Own Signature Fender Guitar",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video2',
		    'taxonomy' => array(
			    'category' => 'music',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:music:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=lQGawYKY3H4'
		    )
	    ),
	    'game-of-thrones-premiere-proves-the-ladies-are-running-the-show' => array(
		    'title' => "'Game of Thrones' premiere proves the ladies are running the show",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video3',
		    'taxonomy' => array(
			    'category' => 'movie,news',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:movie:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=1Mlhnt0jMlg'
		    )
	    ),
	    'fat-burning-cardio-workout-best-workout-for-losing-weight' => array(
		    'title' => "Fat Burning Cardio Workout: Best Workout For Losing Weight?",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video4',
		    'taxonomy' => array(
			    'category' => 'sports,travel',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=u30ElgGF8yk'
		    )
	    ),
	    'the-complete-history-of-daft-punk-told-through-a-creative-infographic' => array(
		    'title' => "The Complete History Of Daft Punk Told Through A Creative Infographic",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video5',
		    'taxonomy' => array(
			    'category' => 'food,music,news,tech',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:music:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=nMs3qtWmwNs'
		    )
	    ),
	    'aggressive-downhill-cross-country-all-mountain-bike-racing' => array(
		    'title' => "Aggressive Downhill, Cross Country & All Mountain Bike Racing",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video6',
		    'taxonomy' => array(
			    'category' => 'news,sports',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=dBlSHIBUx7g'
		    )
	    ),
	    'valentino-rossi-essential-to-build-on-assen-triumph' => array(
		    'title' => "Valentino Rossi: Essential to build on Assen triumph",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video7',
		    'taxonomy' => array(
			    'category' => 'gaming,sports',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=uHQ_U9j3W-o'
		    )
	    ),
	    'is-eminem-releasing-new-music-soon' => array(
		    'title' => "Is Eminem Releasing New Music Soon?",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video8',
		    'taxonomy' => array(
			    'category' => 'music',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:music:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=j5-yKhDd64s'
		    )
	    ),
	    'everything-we-just-learned-about-the-last-jedi' => array(
		    'title' => "Everything we just learned about 'The Last Jedi'",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video9',
		    'taxonomy' => array(
			    'category' => 'movie',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:movie:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=1Mlhnt0jMlg'
		    )
	    ),
	    'mixtape-primer-reviewing-kendrick-lamars-pre-fame-output' => array(
		    'title' => "Mixtape Primer: Reviewing Kendrick Lamar's Pre-Fame Output",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video1',
		    'taxonomy' => array(
			    'category' => 'music,sports',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:music:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=tlL2GXiE4ic'
		    )
	    ),
	    'fullmetal-alchemist-live-action-movie-releases-its-first-full-trailer' => array(
		    'title' => "Fullmetal Alchemist Live-Action Movie Releases Its First Full Trailer",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video2',
		    'taxonomy' => array(
			    'category' => 'movie',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:movie:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=VpPWHPa6w-0'
		    )
	    ),
	    'heres-wonder-woman-just-hanging-with-her-justice-league-boys' => array(
		    'title' => "Here's Wonder Woman just hanging with her Justice League boys",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video3',
		    'taxonomy' => array(
			    'category' => 'movie',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:movie:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=VSB4wGIdDwo'
		    )
	    ),
	    'dota-2-the-international-7-prize-is-the-biggest-prize-pool-in-esports-history' => array(
		    'title' => "Dota 2 The International 7 Prize is the Biggest Prize Pool in Esports History",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video4',
		    'taxonomy' => array(
			    'category' => 'gaming',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=ohcDVmVfPLA'
		    )
	    ),
	    'marvel-unleashes-first-infinity-war-teaser-trailer-its-surprising' => array(
		    'title' => "Marvel unleashes first 'Infinity War' teaser trailer, its surprising",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'video5',
		    'taxonomy' => array(
			    'category' => 'movie',
			    'post_tag' => '',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:movie:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=1Mlhnt0jMlg'
		    )
	    ),
	    'widi-widianas-new-single-formalin-sik-luh-has-arrived-and-its-so-good' => array(
		    'title' => "Widi Widiana's New Single \"Formalin Sik Luh\" Has Arrived and It's So Good",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video6',
			'taxonomy' => array(
				'category' => 'food,music,sports',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:music:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=tlL2GXiE4ic'
			)
		),
		'stay-healthy-look-younger-with-this-25-minute-workout' => array(
			'title' => "Stay Healthy & Look Younger with this 25-minute workout",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video7',
			'taxonomy' => array(
				'category' => 'sports',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=AEzUCgxYlf0'
			)
		),
		'mclaren-drivers-get-hondas-spec-3-engine-for-austria' => array(
			'title' => "Mclaren Drivers Get Honda's Spec 3 Engine For Austria",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video8',
			'taxonomy' => array(
				'category' => 'news,sports,tech',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=UuNYxtVoUs8'
			)
		),
		'xiaomi-mi6-hands-on-its-as-good-as-the-iphone-7-plus' => array(
			'title' => "Xiaomi MI6 hands on: It’s as good as the iPhone 7 Plus",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video9',
			'taxonomy' => array(
				'category' => 'news,tech,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:tech:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=DfxinyJkd6o'
			)
		),
		'watch-dialog-dini-hari-perform-at-the-senayan-city' => array(
			'title' => "Watch Dialog Dini Hari Perform at The Senayan City",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video1',
			'taxonomy' => array(
				'category' => 'music',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:music:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=nMs3qtWmwNs'
			)
		),
		'justin-biebers-been-in-trouble-with-the-police-again' => array(
			'title' => "Justin Bieber’s Been In Trouble With The Police Again",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video2',
			'taxonomy' => array(
				'category' => 'music,news',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:music:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=tlL2GXiE4ic'
			)
		),
		'bayu-cuaca-spins-tunangan-langka-into-an-acoustic-fantasy' => array(
			'title' => "Bayu Cuaca Spins 'Tunangan Langka' Into An Acoustic Fantasy",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video3',
			'taxonomy' => array(
				'category' => 'movie,music,news,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:music:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=tlL2GXiE4ic'
			)
		),
		'space-action-rpg-warframe-expands-to-open-world-gameplay' => array(
			'title' => "Space Action RPG Warframe Expands To Open World Gameplay",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video4',
			'taxonomy' => array(
				'category' => 'gaming',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=CuKYFVoK73A'
			)
		),
		'new-god-of-war-trailer-released-release-date-set-for-early-2018' => array(
			'title' => "New God Of War Trailer Released, Release Date Set For Early 2018",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video5',
			'taxonomy' => array(
				'category' => 'gaming,news,tech',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=gOE2BVRCUkM'
			)
		),
		'the-reason-why-is-tesla-overhyped-and-overvalued' => array(
			'title' => "The Reason Why is Tesla Overhyped and Overvalued",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video6',
			'taxonomy' => array(
				'category' => 'news,sports,tech',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:tech:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=Rt0GkhVPjac'
			)
		),
		'chicagos-best-burger-because-we-all-love-krabby-patty' => array(
			'title' => "Chicago's Best Burger: Because we all love Krabby Patty",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video7',
			'taxonomy' => array(
				'category' => 'food,movie,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=5KLYz0pApq0'
			)
		),
		'fox-broadcasts-formula-es-historic-nyc-races-starting-july-15th' => array(
			'title' => "Fox broadcasts Formula E's historic NYC races starting July 15th",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video8',
			'taxonomy' => array(
				'category' => 'sports',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=cUchHWNkWXA'
			)
		),
		'eat-the-trend-giant-meatball-stuffed-with-spaghetti' => array(
			'title' => "Eat the Trend: Giant Meatball Stuffed With Spaghetti",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video9',
			'taxonomy' => array(
				'category' => 'food,tech,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=pUaKcFI4BZY'
			)
		),
		'this-theory-about-the-ending-of-interstellar-changes-everything' => array(
			'title' => "This Theory About The Ending Of Interstellar Changes Everything",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video1',
			'taxonomy' => array(
				'category' => 'gaming,movie,news,tech,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:movie:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=zSWdZVtXT7E'
			)
		),
		'agent-327-operation-barbershop-an-animated-film-based-on-martin-lodewijks-comic' => array(
			'title' => "Agent 327: Operation Barbershop: An Animated Film Based on Martin Lodewijk’s Comic",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video2',
			'taxonomy' => array(
				'category' => 'gaming,movie,news',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:movie:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=mN0zPOpADL4'
			)
		),
		'the-adventures-of-tintin-the-secret-of-the-unicorn-trailer' => array(
			'title' => "Need For Speed: Payback Looks Very Fast And Fairly Furious",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video3',
			'taxonomy' => array(
				'category' => 'gaming,sports,tech',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=K-5EdHZ0hBs'
			)
		),
		'13-reasons-why-christian-navarro-talks-tony-season-2-spoilers' => array(
			'title' => "'13 Reasons Why': Christian Navarro talks Tony, Season 2 spoilers",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video4',
			'taxonomy' => array(
				'category' => 'movie,music,news,tech',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:movie:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=JebwYGn5Z3E'
			)
		),
		'danny-macaskill-returns-with-incredible-wee-day-out-clip' => array(
			'title' => "Danny MacAskill returns with incredible Wee Day Out clip",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video5',
			'taxonomy' => array(
				'category' => 'sports,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=K_7k3fnxPq0'
			)
		),
		'celebrity-foodies-see-what-the-stars-are-snacking-on-today' => array(
			'title' => "Celebrity Foodies: See What the Stars Are Snacking on Today",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video6',
			'taxonomy' => array(
				'category' => 'food,music,tech',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=3DtEyQF5eAA'
			)
		),
		'bioware-addresses-mass-effect-andromeda-dlc-cancellation-rumors' => array(
			'title' => "BioWare Addresses Mass Effect: Andromeda DLC Cancellation Rumors",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video7',
			'taxonomy' => array(
				'category' => 'gaming,tech',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=X6PJEmEHIaY'
			)
		),
		'meet-17-year-old-indonesian-rapper-rich-chigga' => array(
			'title' => "Meet 17-Year-Old Indonesian Rapper Rich Chigga",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video8',
			'taxonomy' => array(
				'category' => 'music,news,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:music:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=rzc3_b_KnHc'
			)
		),
		'game-of-thrones-season-7-second-trailer-winterishere' => array(
			'title' => "Game of Thrones Season 7: Second Trailer #WinterIsHere",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video9',
			'taxonomy' => array(
				'category' => 'movie',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:movie:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=1Mlhnt0jMlg'
			)
		),
		'this-great-street-food-truck-you-should-try-in-seminyak' => array(
			'title' => "This Great Street Food Truck You Should Try in Seminyak",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video1',
			'taxonomy' => array(
				'category' => 'food,movie,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=6wZ7wn3eH5U'
			)
		),
		'death-stranding-no-showing-at-e3-this-year-says-kojima' => array(
			'title' => "Death Stranding: No showing at E3 this year, says Kojima",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video2',
			'taxonomy' => array(
				'category' => 'gaming,music',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=H2Hy96sOnq8'
			)
		),
		'destiny-2-beta-when-it-starts-whats-in-it-and-all-the-known-issues' => array(
			'title' => "Destiny 2 Beta: When It Starts, What's In It, And All The Known Issues",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video3',
			'taxonomy' => array(
				'category' => 'gaming',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=ohcDVmVfPLA'
			)
		),
		'new-marvel-vs-capcom-infinite-gameplay-video-reveals-iron-man-vs-mega-man' => array(
			'title' => "New Marvel Vs. Capcom: Infinite Gameplay Video Reveals Iron Man vs Mega Man",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video4',
			'taxonomy' => array(
				'category' => 'gaming',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=udJXP1qjfUM'
			)
		),
		'watch-video-of-new-toy-story-world-in-kingdom-hearts-3-will-release-2018' => array(
			'title' => "Watch Video of New Toy Story World in Kingdom Hearts 3 - Will Release 2018",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video5',
			'taxonomy' => array(
				'category' => 'gaming',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=H2Hy96sOnq8'
			)
		),
		'watch-morning-joe-host-joe-scarborough-perform-with-his-band' => array(
			'title' => "Watch 'Morning Joe' Host Joe Scarborough Perform With His Band",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video6',
			'taxonomy' => array(
				'category' => 'music',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:music:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=nMs3qtWmwNs'
			)
		),
		'pokemon-go-celebrates-first-birthday-with-events-across-the-globe' => array(
			'title' => "Pokémon Go celebrates first birthday with events across the globe",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video7',
			'taxonomy' => array(
				'category' => 'gaming,news,tech',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=Jzks65HSJSU'
			)
		),
		'sachsenring-motogp-marquez-apologises-to-vinales-after-clash' => array(
			'title' => "Sachsenring MotoGP: Marquez apologises to Vinales after clash",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video8',
			'taxonomy' => array(
				'category' => 'sports',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=UuNYxtVoUs8'
			)
		),
		'here-is-the-9-biggest-announcements-from-apple-wwdc-2017' => array(
			'title' => "Here is The 9 Biggest Announcements from Apple WWDC 2017",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video9',
			'taxonomy' => array(
				'category' => 'movie,news,tech',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:tech:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=FC0pT9xg1oI'
			)
		),
		'the-completely-addictive-method-of-cooking-broccoli-and-cauliflower' => array(
			'title' => "The Completely Addictive Method of Cooking Broccoli and Cauliflower",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video1',
			'taxonomy' => array(
				'category' => 'food,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=xymkykke0mQ'
			)
		),
		'street-foods-you-should-eat-when-visiting-bali-for-the-first-time' => array(
			'title' => "Street Foods You Should Eat When Visiting Bali For The First Time",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video2',
			'taxonomy' => array(
				'category' => 'food,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=xymkykke0mQ'
			)
		),
		'turkish-street-food-a-guide-to-the-best-street-food-in-istanbul-turkey' => array(
			'title' => "Turkish Street Food: A Guide To The Best Street Food In Istanbul, Turkey",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video3',
			'taxonomy' => array(
				'category' => 'food,news,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=xymkykke0mQ'
			)
		),
		'this-easy-summer-salads-you-can-whip-up-in-a-flash' => array(
			'title' => "This Easy Summer Salads You Can Whip Up in a Flash",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video4',
			'taxonomy' => array(
				'category' => 'food,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=c7kxd5qwNHQ'
			)
		),
		'young-adults-and-the-evolution-of-modern-food-culture' => array(
			'title' => "Young adults and the evolution of modern food culture",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video5',
			'taxonomy' => array(
				'category' => 'food,news,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=va5Z7BS6_dQ'
			)
		),
		'these-delicious-balinese-street-foods-you-need-to-try-right-now' => array(
			'title' => "These delicious Balinese street foods you need to try right now",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video6',
			'taxonomy' => array(
				'category' => 'food,news,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=NDJlPG_M600'
			)
		),
		'liam-gallagher-anything-noel-can-sing-i-can-sing-better' => array(
			'title' => "Liam Gallagher: 'Anything Noel can sing, I can sing better'",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video7',
			'taxonomy' => array(
				'category' => 'gaming,movie,music',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:music:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=NDJlPG_M600'
			)
		),
		'biowares-anthem-is-a-science-fantasy-like-star-wars' => array(
			'title' => "BioWare's Anthem is a \"science fantasy\" like Star Wars",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video8',
			'taxonomy' => array(
				'category' => 'gaming,movie,sports',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=wi0Uq7QmKm4'
			)
		),
		'barack-obama-returns-to-indonesia-for-family-vacation' => array(
			'title' => "Barack Obama Returns To Indonesia For Family Vacation",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video9',
			'taxonomy' => array(
				'category' => 'food,news,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=ro2--S-Dy34'
			)
		),
		'five-reasons-to-buy-and-to-skip-an-apple-watch' => array(
			'title' => "Five Reasons To Buy and To Skip An Apple Watch",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video1',
			'taxonomy' => array(
				'category' => 'news,sports,tech',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:tech:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=p2_O6M1m6xg'
			)
		),
		'kintamani-volcano-downhill-biking-adventure' => array(
			'title' => "Kintamani Volcano Downhill Biking Adventure",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video2',
			'taxonomy' => array(
				'category' => 'sports',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=m_gnMnhPTxQ'
			)
		),
		'a-deep-sea-dive-into-bermudas-hidden-depths' => array(
			'title' => "A Deep Sea Dive Into Bermuda’s Hidden Depths",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video3',
			'taxonomy' => array(
				'category' => 'news,tech,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:news:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=p0G68ORc8uQ'
			)
		),
		'when-you-get-another-day-off-but-suddenly-canceled' => array(
			'title' => "Deep-sea Mining Could Transform The Globe",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'video4',
			'taxonomy' => array(
				'category' => 'news,tech,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:news:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=IYKaKeJv2dQ'
			)
		),
		'first-ever-electronic-music-awards-are-coming-to-l-a-in-september' => array(
			'title' => "First-Ever Electronic Music Awards Are Coming to L.A. in September",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'video5',
			'taxonomy' => array(
				'category' => 'music,news,travel',
				'post_tag' => '',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:news:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=zSwOsXDTc2o'
			)
		),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1501064204380{margin-top: -30px !important;}.vc_custom_1500021559938{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #1c1c1c !important;}.vc_custom_1500964838797{border-right-width: 0px !important;border-bottom-width: 0px !important;border-left-width: 0px !important;padding-top: 50px !important;padding-bottom: 50px !important;background: rgba(38,38,38,0.01) url({{image:video_bg:url:full}}) !important;*background-color: rgb(38,38,38) !important;}',
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1501064204380{margin-top: -30px !important;}.vc_custom_1500021559938{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #1c1c1c !important;}.vc_custom_1500964838797{border-right-width: 0px !important;border-bottom-width: 0px !important;border-left-width: 0px !important;padding-top: 50px !important;padding-bottom: 50px !important;background: rgba(38,38,38,0.01) url({{image:video_bg:url:full}}) !important;*background-color: rgb(38,38,38) !important;}.jeg_blocklink .jeg_block_content > div {box-shadow: none;background: transparent;}'
                )
            )
        ),
	    'home-2' => array(
		    'title' => 'Home 2',
		    'content' => 'home2.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1500357991848{margin-top: -30px !important;padding-top: 20px !important;background: #1c1c1c url({{image:pattern:url:full}) !important;}.vc_custom_1500356260451{margin-top: -100px !important;margin-bottom: 40px !important;padding-top: 115px !important;padding-bottom: 15px !important;background-color: #f5f5f5 !important;}.vc_custom_1500358296730{margin-bottom: 40px !important;padding-top: 50px !important;padding-bottom: 20px !important;background: #1c1c1c url({{image:pattern:url:full}}) !important;}.vc_custom_1498890962911{margin-bottom: 60px !important;border-bottom-width: 1px !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1491642981686{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1500965325318{margin-bottom: 0px !important;}.vc_custom_1501063358100{margin-bottom: 0px !important;}.vc_custom_1500350027340{margin-bottom: 0px !important;}.vc_custom_1498888273304{margin-bottom: -30px !important;}',
			    '_elementor_data' => 'home2.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.vc_custom_1500357991848{margin-top: -30px !important;padding-top: 20px !important;background: #1c1c1c url({{image:pattern:url:full}) !important;}.vc_custom_1500356260451{margin-top: -100px !important;margin-bottom: 40px !important;padding-top: 115px !important;padding-bottom: 15px !important;background-color: #f5f5f5 !important;}.vc_custom_1500358296730{margin-bottom: 40px !important;padding-top: 50px !important;padding-bottom: 20px !important;background: #1c1c1c url({{image:pattern:url:full}}) !important;}.vc_custom_1498890962911{margin-bottom: 60px !important;border-bottom-width: 1px !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1491642981686{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1500965325318{margin-bottom: 0px !important;}.vc_custom_1501063358100{margin-bottom: 0px !important;}.vc_custom_1500350027340{margin-bottom: 0px !important;}.vc_custom_1498888273304{margin-bottom: -30px !important;}'
			    )
		    )
	    ),
	    'home-3' => array(
		    'title' => 'Home 3',
		    'content' => 'home3.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1500106046245{margin-top: -30px !important;margin-bottom: 40px !important;}.vc_custom_1500283560219{margin-top: 40px !important;margin-bottom: -40px !important;border-bottom-width: 40px !important;padding-top: 20px !important;background-color: #f5f5f5 !important;}.vc_custom_1491642981686{padding-right: 0px !important;padding-left: 0px !important;}',
			    '_elementor_data' => 'home3.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.vc_custom_1500106046245{margin-top: -30px !important;margin-bottom: 40px !important;}.vc_custom_1500283560219{margin-top: 40px !important;margin-bottom: -40px !important;border-bottom-width: 40px !important;padding-top: 20px !important;background-color: #f5f5f5 !important;}.vc_custom_1491642981686{padding-right: 0px !important;padding-left: 0px !important;}'
			    )
		    )
	    ),
        'about' => array(
            'title' => 'About',
            'content' => 'about.txt',
            'post_type' => 'page',
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
			        'menu-item-title' => 'Home 1',
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
			        'menu-item-title' => 'Home 2',
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
			        'menu-item-title' => 'Home 3',
			        'menu-item-parent-id' => '{{menu:home:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-3:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
        'browse' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Browse',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => '#',
		        'menu-item-status' => 'publish'
	        )
        ),
	        'main-gaming' => array(
		        'location' => 'main-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Gaming',
			        'menu-item-parent-id' => '{{menu:browse:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:gaming:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'main-movie' => array(
		        'location' => 'main-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Movie',
			        'menu-item-parent-id' => '{{menu:browse:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:movie:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'main-music' => array(
		        'location' => 'main-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Music',
			        'menu-item-parent-id' => '{{menu:browse:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:music:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'main-tech' => array(
		        'location' => 'main-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Tech',
			        'menu-item-parent-id' => '{{menu:browse:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:tech:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'main-news' => array(
		        'location' => 'main-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'News',
			        'menu-item-parent-id' => '{{menu:browse:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:news:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'main-sports' => array(
		        'location' => 'main-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Sports',
			        'menu-item-parent-id' => '{{menu:browse:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:sports:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'main-food' => array(
		        'location' => 'main-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Food',
			        'menu-item-parent-id' => '{{menu:browse:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:food:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'main-travel' => array(
		        'location' => 'main-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Travel',
			        'menu-item-parent-id' => '{{menu:browse:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:travel:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
        'about' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'About',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:about:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),

        // footer & topbar menu
        'gaming' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Gaming',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:gaming:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'movie' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Movie',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:movie:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'music' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Music',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:music:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'tech' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Tech',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:tech:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'travel' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Travel',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:travel:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'food' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Food',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:food:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'news' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'News',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:news:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'sports' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Sports',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:sports:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
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
        'Category',
        'Contact',
        'Home 3',
	    'Home 4'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'contact-form-7',
        'jnews-jsonld',
        'jnews-like',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )
);
