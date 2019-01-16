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
	    'logo' => 'http://jegtheme.com/asset/jnews/demo/metronews/logo.png',
	    'logo2x' => 'http://jegtheme.com/asset/jnews/demo/metronews/logo@2x.png',
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
            'entertainment' => array(
                'title' =>'Entertainment',
                'description' => 'You can add some category description here.'
            ),
	            'gaming' => array(
		            'title' =>'Gaming',
		            'description' => 'You can add some category description here.',
		            'parent' => 'entertainment'
	            ),
	            'movie' => array(
		            'title' =>'Movie',
		            'description' => 'You can add some category description here.',
		            'parent' => 'entertainment'
	            ),
	            'music' => array(
		            'title' =>'Music',
		            'description' => 'You can add some category description here.',
		            'parent' => 'entertainment'
	            ),
	            'sports' => array(
		            'title' =>'Sports',
		            'description' => 'You can add some category description here.',
		            'parent' => 'entertainment'
	            ),
            'lifestyle' => array(
	            'title' =>'Lifestyle',
	            'description' => 'You can add some category description here.'
            ),
	            'fashion' => array(
		            'title' =>'Fashion',
		            'description' => 'You can add some category description here.',
		            'parent' => 'lifestyle'
	            ),
	            'food' => array(
		            'title' =>'Food',
		            'description' => 'You can add some category description here.',
		            'parent' => 'lifestyle'
	            ),
	            'health' => array(
		            'title' =>'Health',
		            'description' => 'You can add some category description here.',
		            'parent' => 'lifestyle'
	            ),
	            'travel' => array(
		            'title' =>'Travel',
		            'description' => 'You can add some category description here.',
		            'parent' => 'lifestyle'
	            ),
            'news' => array(
	            'title' =>'News',
	            'description' => 'You can add some category description here.'
            ),
	            'bussiness' => array(
		            'title' =>'Bussiness',
		            'description' => 'You can add some category description here.',
		            'parent' => 'news'
	            ),
	            'politics' => array(
		            'title' =>'Politics',
		            'description' => 'You can add some category description here.',
		            'parent' => 'news'
	            ),
	            'science' => array(
		            'title' =>'Science',
		            'description' => 'You can add some category description here.',
		            'parent' => 'news'
	            ),
	            'world' => array(
		            'title' =>'World',
		            'description' => 'You can add some category description here.',
		            'parent' => 'news'
	            ),
            'tech' => array(
	            'title' =>'Tech',
	            'description' => 'You can add some category description here.'
            ),
	            'apps' => array(
		            'title' =>'Apps',
		            'description' => 'You can add some category description here.',
		            'parent' => 'tech'
	            ),
	            'gadget' => array(
		            'title' =>'Gadget',
		            'description' => 'You can add some category description here.',
		            'parent' => 'tech'
	            ),
	            'mobile' => array(
		            'title' =>'Mobile',
		            'description' => 'You can add some category description here.',
		            'parent' => 'tech'
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
	    '7-netflix-tricks-thatll-change-how-you-watch-your-favorite-shows' => array(
		    'title' => "7 Netflix Tricks That'll Change How You Watch Your Favorite Shows",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news1',
		    'taxonomy' => array(
			    'category' => 'apps,gadget,mobile,tech',
			    'post_tag' => 'balinese-culture,champions-league,istana-negara,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tech:id}}')
		    )
	    ),
	    'fitness-app-strava-published-heat-map-details-about-secret-military-bases' => array(
		    'title' => "Fitness App Strava Published 'Heat Map' Details About Secret Military Bases",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news2',
		    'taxonomy' => array(
			    'category' => 'apps,gadget,mobile,tech',
			    'post_tag' => '2018-league,balinese-culture,doctor-terawan,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tech:id}}')
		    )
	    ),
	    'youtube-star-logan-paul-faces-outrage-over-dead-body-video' => array(
		    'title' => "YouTube Star Logan Paul Faces Outrage Over Dead Body Video",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news3',
		    'taxonomy' => array(
			    'category' => 'apps,gadget,mobile,tech',
			    'post_tag' => '2018-league,budget-travel,market-stories,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tech:id}}')
		    )
	    ),
	    'elon-musk-says-hes-sold-10000-flamethrowers-through-his-boring-company-website' => array(
		    'title' => "Elon Musk Says He's Sold 10,000 Flamethrowers Through His Boring Company Website",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news4',
		    'taxonomy' => array(
			    'category' => 'apps,gadget,mobile,tech',
			    'post_tag' => 'balinese-culture,budget-travel,champions-league,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tech:id}}')
		    )
	    ),
	    'elon-musk-says-spacex-will-now-start-working-on-big-fing-rocket' => array(
		    'title' => "Elon Musk Says SpaceX Will Now Start Working On 'Big F***ing Rocket'",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news5',
		    'taxonomy' => array(
			    'category' => 'apps,gadget,mobile,tech',
			    'post_tag' => '2018-league,balinese-culture,market-stories,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tech:id}}')
		    )
	    ),
	    'facebook-reportedly-testing-downvote-button' => array(
		    'title' => "Facebook Reportedly Testing 'Downvote' Button",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news6',
		    'taxonomy' => array(
			    'category' => 'apps,gadget,mobile,tech',
			    'post_tag' => '2018-league,bali-united,doctor-terawan,istana-negara'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tech:id}}')
		    )
	    ),
	    'the-homepod-smart-speaker-shows-the-best-and-worst-of-apple' => array(
		    'title' => "The HomePod Smart Speaker Shows The Best and Worst of Apple",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news7',
		    'taxonomy' => array(
			    'category' => 'apps,gadget,mobile,tech',
			    'post_tag' => 'bali-united,budget-travel,doctor-terawan,istana-negara'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tech:id}}')
		    )
	    ),
	    'art-therapy-has-clear-effect-on-severe-depression-research-finds' => array(
		    'title' => "Art Therapy Has 'Clear Effect' On Severe Depression, Research Finds",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news8',
		    'taxonomy' => array(
			    'category' => 'fashion,food,health,lifestyle,travel',
			    'post_tag' => '2018-league,budget-travel,champions-league,doctor-terawan'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
		    )
	    ),
	    'what-it-means-to-have-a-creative-personality' => array(
		    'title' => "What It Means To Have A Creative Personality",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news9',
		    'taxonomy' => array(
			    'category' => 'fashion,food,health,lifestyle,travel',
			    'post_tag' => 'budget-travel,doctor-terawan,national-exam,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
		    )
	    ),
	    '7-odd-things-that-happen-to-your-body-when-its-cold-outside' => array(
		    'title' => "7 Odd Things That Happen To Your Body When It's Cold Outside",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news10',
		    'taxonomy' => array(
			    'category' => 'fashion,food,health,lifestyle,travel',
			    'post_tag' => 'balinese-culture,chopper-bike,market-stories,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
		    )
	    ),
	    'how-neuroplasticity-can-help-you-get-rid-of-your-bad-habits' => array(
		    'title' => "How Neuroplasticity Can Help You Get Rid Of Your Bad Habits",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news1',
		    'taxonomy' => array(
			    'category' => 'fashion,food,health,lifestyle,travel',
			    'post_tag' => 'bali-united,champions-league,istana-negara,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
		    )
	    ),
	    'watch-7-tips-on-how-to-start-working-out' => array(
		    'title' => "Watch: 7 Tips On How To Start Working Out",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news2',
		    'taxonomy' => array(
			    'category' => 'fashion,food,health,lifestyle,travel',
			    'post_tag' => '2018-league,champions-league,istana-negara,national-exam'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
		    )
	    ),
	    '18-realistic-ways-to-become-a-happier-more-chill-person-in-2018' => array(
		    'title' => "18 Realistic Ways To Become A Happier, More Chill Person In 2018",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news3',
		    'taxonomy' => array(
			    'category' => 'fashion,food,health,lifestyle,travel',
			    'post_tag' => 'budget-travel,doctor-terawan,istana-negara,market-stories'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
		    )
	    ),
	    'what-ive-learned-from-a-year-without-alcohol' => array(
		    'title' => "What I've Learned From A Year Without Alcohol",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news4',
		    'taxonomy' => array(
			    'category' => 'fashion,food,health,lifestyle,travel',
			    'post_tag' => '2018-league,budget-travel,champions-league,market-stories'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
		    )
	    ),
	    'amy-schumer-makes-it-official-with-her-new-chef-boyfriend' => array(
		    'title' => "Amy Schumer Makes It Official With Her New Chef Boyfriend",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news5',
		    'taxonomy' => array(
			    'category' => 'entertainment,gaming,movie,music,sports',
			    'post_tag' => 'balinese-culture,doctor-terawan,market-stories,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:entertainment:id}}')
		    )
	    ),
	    'george-clooney-talks-about-his-love-for-amal-and-its-devastatingly-romantic' => array(
		    'title' => "George Clooney Talks About His Love For Amal, And It’s Devastatingly Romantic",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news6',
		    'taxonomy' => array(
			    'category' => 'entertainment,gaming,movie,music,sports',
			    'post_tag' => '2018-league,champions-league,doctor-terawan,istana-negara'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:entertainment:id}}')
		    )
	    ),
	    'walking-dead-star-danai-gurira-was-absolutely-devastated-after-that-carl-reveal' => array(
		    'title' => "'Walking Dead' Star Danai Gurira Was 'Absolutely Devastated' After That Carl Reveal",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news7',
		    'taxonomy' => array(
			    'category' => 'entertainment,gaming,movie,music,sports',
			    'post_tag' => '2018-league,bali-united,balinese-culture,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:entertainment:id}}')
		    )
	    ),
	    'black-panther-lives-up-to-the-hype-and-then-some-huffpost-verdict' => array(
		    'title' => "'Black Panther' Lives Up To The Hype - And Then Some: HuffPost Verdict",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news8',
		    'taxonomy' => array(
			    'category' => 'entertainment,gaming,movie,music,sports',
			    'post_tag' => 'bali-united,chopper-bike,doctor-terawan,istana-negara'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:entertainment:id}}')
		    )
	    ),
	    'amy-poehler-and-parks-and-recreation-cast-reunite-for-galentines-day' => array(
		    'title' => "Amy Poehler And 'Parks And Recreation' Cast Reunite For Galentine's Day",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news9',
		    'taxonomy' => array(
			    'category' => 'entertainment,gaming,movie,music,sports',
			    'post_tag' => 'champions-league,doctor-terawan,istana-negara,market-stories'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:entertainment:id}}')
		    )
	    ),
	    'kim-cattrall-shows-cynthia-nixon-some-love-after-slamming-sarah-jessica-parker' => array(
		    'title' => "Kim Cattrall Shows Cynthia Nixon Some Love After Slamming Sarah Jessica Parker",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news10',
		    'taxonomy' => array(
			    'category' => 'entertainment,gaming,movie,music,sports',
			    'post_tag' => 'balinese-culture,chopper-bike,doctor-terawan,visit-bali'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:entertainment:id}}')
		    )
	    ),
	    'amy-schumer-says-yes-marries-chef-chris-fischer-after-a-few-months-of-dating' => array(
		    'title' => "Amy Schumer Says \"Yes\", Marries Chef Chris Fischer After A Few Months Of Dating",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news1',
			'taxonomy' => array(
				'category' => 'entertainment,gaming,movie,music,sports',
				'post_tag' => 'bali-united,budget-travel,istana-negara,national-exam'
			),
		    'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:entertainment:id}}'),
				'post_subtitle' => 'And her stunning wedding dress is WAY more affordable than it looks.'
			)
		),
		'trump-didnt-sing-all-the-words-to-the-national-anthem-at-national-championship-game' => array(
			'title' => "Trump Didn't Sing All The Words To The National Anthem At National Championship Game",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news2',
			'taxonomy' => array(
				'category' => 'bussiness,news,politics,world',
				'post_tag' => 'champions-league,chopper-bike,doctor-terawan,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
		'protesters-try-to-arrest-londons-mayor-for-disrespecting-donald-trump' => array(
			'title' => "Protesters Try To Arrest London's Mayor For Disrespecting Donald Trump",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'bussiness,news,politics,science,world',
				'post_tag' => 'bali-united,champions-league,istana-negara,national-exam'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
		'how-melbournes-so-called-african-gang-crisis-took-over-australian-politics' => array(
			'title' => "How Melbourne's So-Called 'African Gang Crisis' Took Over Australian Politics",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'bussiness,news,politics,science,world',
				'post_tag' => '2018-league,chopper-bike,istana-negara,national-exam'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
		'pentagon-reportedly-weighing-using-nukes-in-response-to-large-cyberattacks' => array(
			'title' => "Pentagon Reportedly Weighing Using Nukes In Response To 'Large Cyberattacks’",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'bussiness,news,politics,science,world',
				'post_tag' => 'balinese-culture,budget-travel,national-exam,visit-bali'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
		'secret-australian-government-documents-found-in-cabinets-sold-at-second-hand-store' => array(
			'title' => "Secret Australian Government Documents Found In Cabinets Sold At Second-Hand Store",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news6',
			'taxonomy' => array(
				'category' => 'bussiness,news,politics,science,world',
				'post_tag' => '2018-league,bali-united,national-exam,visit-bali'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
		'trump-supporters-consume-and-share-the-most-fake-news-oxford-study-finds' => array(
			'title' => "Trump Supporters Consume And Share The Most Fake News, Oxford Study Finds",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news7',
			'taxonomy' => array(
				'category' => 'bussiness,news,politics,science,world',
				'post_tag' => 'bali-united,champions-league,istana-negara,national-exam'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
		'government-runs-out-of-money-again-as-congress-fails-to-reach-a-deal' => array(
			'title' => "Government Runs Out Of Money Again As Congress Fails To Reach A Deal",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'bussiness,news,politics',
				'post_tag' => '2018-league,doctor-terawan,istana-negara,national-exam'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
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
                '_elementor_edit_mode' => 'builder',
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
            'title' => 'Top Navigation',
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
        'news' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'News',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:news:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
	            'menu_item_jnews_mega_menu' => array(
		            'type' => 'category_2',
		            'category' => '{{category:news:id}}',
		            'number' => 7,
		            'trending_tag' => '',
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
			        'number' => 7,
			        'trending_tag' => '',
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
			        'number' => 7,
			        'trending_tag' => '',
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
			        'type' => 'category_2',
			        'category' => '{{category:tech:id}}',
			        'number' => 7,
			        'trending_tag' => '',
		        ),
	        )
        ),

        // Topbar Menu
        'about' => array(
            'location' => 'top-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'About',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'advertise' => array(
            'location' => 'top-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Advertise',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'careers' => array(
            'location' => 'top-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Careers',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'contact' => array(
            'location' => 'top-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Contact',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
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
        'entertainment-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Entertainment',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:entertainment:id}}',
                'menu-item-status' => 'publish'
            )
        ),
	        'gaming-mobile' => array(
	            'location' => 'mobile-navigation',
	            'menu-item-data' => array(
	                'menu-item-title' => 'Gaming',
	                'menu-item-type' => 'taxonomy',
	                'menu-item-object' => 'category',
	                'menu-item-object-id' => '{{category:gaming:id}}',
	                'menu-item-parent-id' => '{{menu:entertainment-mobile:id}}',
	                'menu-item-status' => 'publish'
	            )
	        ),
	        'movie-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Movie',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:movie:id}}',
			        'menu-item-parent-id' => '{{menu:entertainment-mobile:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'music-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Music',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:music:id}}',
			        'menu-item-parent-id' => '{{menu:entertainment-mobile:id}}',
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
			        'menu-item-parent-id' => '{{menu:entertainment-mobile:id}}',
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
	        'fashion-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Fashion',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:fashion:id}}',
			        'menu-item-parent-id' => '{{menu:lifestyle-mobile:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'food-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Food',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:food:id}}',
			        'menu-item-parent-id' => '{{menu:lifestyle-mobile:id}}',
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
			        'menu-item-parent-id' => '{{menu:lifestyle-mobile:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'health-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Health',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:health:id}}',
			        'menu-item-parent-id' => '{{menu:lifestyle-mobile:id}}',
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
	        'bussiness-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Bussiness',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:bussiness:id}}',
			        'menu-item-parent-id' => '{{menu:news-mobile:id}}',
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
			        'menu-item-parent-id' => '{{menu:news-mobile:id}}',
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
			        'menu-item-parent-id' => '{{menu:news-mobile:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'world-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'World',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:world:id}}',
			        'menu-item-parent-id' => '{{menu:news-mobile:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
        'tech-mobile' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Tech',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:tech:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
	        'apps-mobile' => array(
	            'location' => 'mobile-navigation',
	            'menu-item-data' => array(
	                'menu-item-title' => 'Apps',
	                'menu-item-type' => 'taxonomy',
	                'menu-item-object' => 'category',
	                'menu-item-object-id' => '{{category:apps:id}}',
	                'menu-item-parent-id' => '{{menu:tech-mobile:id}}',
	                'menu-item-status' => 'publish'
	            )
	        ),
	        'gadget-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Gadget',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:gadget:id}}',
			        'menu-item-parent-id' => '{{menu:tech-mobile:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'mobile-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Mobile',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{category:mobile:id}}',
			        'menu-item-parent-id' => '{{menu:tech-mobile:id}}',
			        'menu-item-status' => 'publish'
		        )
	        )
    ),

    'widget_position' => array(),

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
        'jnews-social-share',
        'jnews-view-counter',
    )
);