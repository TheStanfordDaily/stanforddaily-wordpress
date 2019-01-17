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
	    'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/newspaper/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/newspaper/logo@2x.png',
        'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/newspaper/mobile_logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/newspaper/mobile_logo@2x.png',
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
                    'description' => 'You can add some category description here.'
                ),
            'entertainment' =>
                array(
                    'title' =>'Entertainment',
                    'description' => 'You can add some category description here.'
                ),
                'gaming' =>
                    array(
                        'title' => 'Gaming',
                        'description' => 'You can add some category description here.',
                        'parent' => 'entertainment'
                    ),
                'movie' =>
                    array(
                        'title' => 'Movie',
                        'description' => 'You can add some category description here.',
                        'parent' => 'entertainment'
                    ),
                'music' =>
                    array(
                        'title' => 'Music',
                        'description' => 'You can add some category description here.',
                        'parent' => 'entertainment'
                    ),
                'sports' =>
                    array(
                        'title' => 'Sports',
                        'description' => 'You can add some category description here.',
                        'parent' => 'entertainment'
                    ),
            'lifestyle' =>
                array(
                    'title' =>'Lifestyle',
                    'description' => 'You can add some category description here.'
                ),
                'fashion' =>
                    array(
                        'title' => 'Fashion',
                        'description' => 'You can add some category description here.',
                        'parent' => 'lifestyle'
                    ),
                'food' =>
                    array(
                        'title' => 'food',
                        'description' => 'You can add some category description here.',
                        'parent' => 'lifestyle'
                    ),
                'health' =>
                    array(
                        'title' => 'Health',
                        'description' => 'You can add some category description here.',
                        'parent' => 'lifestyle'
                    ),
                'travel' =>
                    array(
                        'title' => 'Travel',
                        'description' => 'You can add some category description here.',
                        'parent' => 'lifestyle'
                    ),
            'national' =>
                array(
                    'title' =>'National',
                    'description' => 'You can add some category description here.'
                ),
            'politics' =>
                array(
                    'title' =>'Politics',
                    'description' => 'You can add some category description here.'
                ),
            'science' =>
                array(
                    'title' =>'Science',
                    'description' => 'You can add some category description here.'
                ),
            'tech' =>
                array(
                    'title' =>'Tech',
                    'description' => 'You can add some category description here.'
                ),
            'world' =>
                array(
                    'title' =>'World',
                    'description' => 'You can add some category description here.'
                ),
            
        ),
        'post_tag' => array(
            'climate-change' => array(
                'title' => 'Climate Change'
            ),
            'donald-trump' => array(
                'title' => 'Donald Trump',
            ),
            'election-results' => array(
                'title' => 'Election Results',
            ),
            'flat-earth' => array(
                'title' => 'Flat Earth'
            ),
            'golden-globes' => array(
                'title' => 'Golden Globes'
            ),
            'market-stories' => array(
                'title' => 'Market Stories',
            ),
            'motogp-2017' => array(
                'title' => 'MotoGP 2017'
            ),
            'mr-robot' => array(
                'title' => 'Mr. Robot'
            ),
            'sillicon-valley' => array(
                'title' => 'Sillicon Valley'
            ),
            'united-stated' => array(
                'title' => 'United Stated',
            ),
            'white-house' => array(
                'title' => 'White House'
            ),
        )
    ),

    // post & page
    'post' => array(
        'riots-report-shows-london-needs-to-maintain-police-numbers-says-mayor' => array(
            'title' => "Riots Report Shows London Needs To Maintain Police Numbers, Says Mayor",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'business,national,politics,world',
                'post_tag' => 'climate-change,election-results,flat-earth,united-stated,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'trump-is-struggling-to-stay-calm-on-russia-one-morning-call-at-a-time' => array(
            'title' => "Trump Is Struggling To Stay Calm On Russia, One Morning Call At A Time",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news2',
            'taxonomy' => array(
                'category' => 'business,national,politics',
                'post_tag' => 'donald-trump,election-results,united-stated,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'house-republicans-vote-to-end-rule-stopping-coal-mining-debris-from-being-dumped-in-streams' => array(
            'title' => "Republican Senator Vital to Health Bill’s Passage Won’t Support It",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news3',
            'taxonomy' => array(
                'category' => 'business,fashion,lifestyle,national,politics',
                'post_tag' => 'flat-earth,market-stories,motogp-2017,mr-robot,sillicon-valley,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'rap-group-call-out-publication-for-using-their-image-in-place-of-gang' => array(
            'title' => "Rap group call out publication for using their image in place of 'gang'",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news4',
            'taxonomy' => array(
                'category' => 'entertainment,fashion,music,travel',
                'post_tag' => 'climate-change,donald-trump,election-results,market-stories,united-stated,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:music:id}}')
            )
        ),
        'barack-obama-and-family-visit-balinese-paddy-fields-during-vacation' => array(
            'title' => "Barack Obama and Family Visit Balinese Paddy Fields During Vacation",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news5',
            'taxonomy' => array(
                'category' => 'business,fashion,lifestyle,politics,travel',
                'post_tag' => 'climate-change,election-results,united-stated,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'president-trump-threatens-to-send-u-s-troops-to-mexico-to-take-care-of-bad-hombres' => array(
            'title' => "Melania Trump's Mail Suit Suggests Desire To Monetise First Lady Role",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news6',
            'taxonomy' => array(
                'category' => 'fashion,gaming,lifestyle,national,politics',
                'post_tag' => 'donald-trump,election-results,golden-globes,united-stated,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
                'post_subtitle' => 'Victory has a thousand fathers, but defeat is an orphan.'
            )
        ),
        'this-secret-room-in-mount-rushmore-is-having-a-moment' => array(
            'title' => "This Secret Room In Mount Rushmore Is Having A Moment",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news7',
            'taxonomy' => array(
                'category' => 'lifestyle,national,politics,travel,world',
                'post_tag' => 'election-results,flat-earth,mr-robot,sillicon-valley,united-stated,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:national:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'betterment-moves-beyond-robo-advising-with-human-financial-planners' => array(
            'title' => "Betterment Moves Beyond Robo-Advising With Human Financial Planners",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news8',
            'taxonomy' => array(
                'category' => 'business,science,tech',
                'post_tag' => 'climate-change,donald-trump,election-results,golden-globes,motogp-2017,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}')
            )
        ),
        'a-digital-media-startup-growing-up-with-millennial-women' => array(
            'title' => "A Digital Media Startup Growing Up With Millennial Women",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news9',
            'taxonomy' => array(
                'category' => 'business,food,science,tech',
                'post_tag' => 'flat-earth,golden-globes,market-stories,mr-robot,sillicon-valley'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tech:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'india-is-bringing-free-wi-fi-to-more-than-1000-villages-this-year' => array(
            'title' => "India Is Bringing Free Wi-fi To More Than 1,000 Villages This Year",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'health,politics,science',
                'post_tag' => 'climate-change,donald-trump,flat-earth,market-stories,motogp-2017,united-stated'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'bill-gates-iconic-donkey-game-arrives-on-iphone-apple-watch' => array(
            'title' => "Bill Gates' iconic donkey game arrives on iPhone, Apple Watch",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news2',
            'taxonomy' => array(
                'category' => 'business,entertainment,gaming,tech',
                'post_tag' => 'donald-trump,golden-globes,mr-robot,sillicon-valley,united-stated,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tech:id}}'),
                'post_subtitle' => 'Before anything else, preparation is the key to success.'
            )
        ),
        'indonesias-largest-fleet-of-taxis-teams-up-to-beat-ride-hailing-apps' => array(
            'title' => "Indonesia's Largest Fleet Of Taxis Teams Up To Beat Ride-hailing Apps",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news3',
            'taxonomy' => array(
                'category' => 'business,lifestyle,national,tech,travel',
                'post_tag' => 'climate-change,flat-earth,market-stories,mr-robot,sillicon-valley'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}')
            )
        ),
        'trump-didnt-record-comey-white-house-tells-house-intel-panel' => array(
            'title' => "Trump Didn't Record Comey, White House Tells House Intel Panel",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news4',
            'taxonomy' => array(
                'category' => 'business,national,politics,tech',
                'post_tag' => 'climate-change,flat-earth,golden-globes,mr-robot,sillicon-valley,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'finland-has-an-education-system-the-other-country-should-learn-from' => array(
            'title' => "Finland Has An Education System The Other Country Should Learn From",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news5',
            'taxonomy' => array(
                'category' => 'business,national,science,world',
                'post_tag' => 'flat-earth,golden-globes,market-stories,motogp-2017,united-stated'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:science:id}}'),
                'post_subtitle' => 'Before anything else, preparation is the key to success.'
            )
        ),
        'johnny-depp-jokes-about-assassinating-trump-then-apologizes' => array(
            'title' => "Johnny Depp Jokes About Assassinating Trump, Then Apologizes",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news6',
            'taxonomy' => array(
                'category' => 'entertainment,fashion,lifestyle,movie,music',
                'post_tag' => 'climate-change,donald-trump,flat-earth,motogp-2017,mr-robot,sillicon-valley'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:movie:id}}')
            )
        ),
        'instagram-is-testing-photo-albums-because-nothing-is-sacred-anymore' => array(
            'title' => "Uber's Turbulent Week: Kalanick Out, New Twist In Google Lawsuit",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news7',
            'taxonomy' => array(
                'category' => 'business,gaming,science,tech,travel',
                'post_tag' => 'election-results,flat-earth,market-stories,mr-robot,sillicon-valley,united-stated'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'Before anything else, preparation is the key to success.'
            )
        ),
        '7-february-games-you-should-get-excited-about' => array(
            'title' => "Uncharted: The Lost Legacy's Latest Demo Shows A Treasure-Hunting Duo In Sync",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news8',
            'taxonomy' => array(
                'category' => 'entertainment,gaming,lifestyle,music,tech',
                'post_tag' => 'donald-trump,election-results,market-stories,sillicon-valley,united-stated,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gaming:id}}')
            )
        ),
        'make-yourself-feel-better-by-laughing-at-januarys-best-news-bloopers' => array(
            'title' => "Hannah Donker talks being The Weeknd's love interest in 'Secrets'",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news9',
            'taxonomy' => array(
                'category' => 'entertainment,fashion,lifestyle,movie,music,travel',
                'post_tag' => 'golden-globes,market-stories,motogp-2017,mr-robot'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:music:id}}')
            )
        ),
        'using-a-mind-reading-device-locked-in-patients-told-researchers-theyre-happy' => array(
            'title' => "Using A Mind Reading Device, 'locked-in' Patients Told Researchers They're Happy",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'fashion,sports,tech,travel',
                'post_tag' => 'donald-trump,election-results,golden-globes,motogp-2017,sillicon-valley,united-stated'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tech:id}}'),
                'jnews_single_post' => array(
                    'override_template' => '1',
                    'override' => array(
                        array(
                            'template' => '2',
                            'parallax' => '1',
                            'fullscreen' => '0',
                            'layout' => 'right-sidebar',
                            'sidebar' => 'default-sidebar',
                            'share_position' => 'top',
                            'share_float_style' => 'share-monocrhome',
                            'show_share_counter' => '1',
                            'show_view_counter' => '1',
                            'show_featured' => '1',
                            'show_post_meta' => '1',
                            'show_post_author' => '1',
                            'show_post_author_image' => '0',
                            'show_post_date' => '1',
                            'show_post_category' => '1',
                            'show_post_tag' => '1',
                            'show_prev_next_post' => '0',
                            'show_popup_post' => '1',
                            'number_popup_post' => '1',
                            'show_author_box' => '1',
                            'show_post_related' => '1',
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
        'hong-kongs-stock-market-tells-the-story-of-chinas-growing-dominance' => array(
            'title' => "Hong Kong’s Stock Market Tells the Story of China’s Growing Dominance",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news2',
            'taxonomy' => array(
                'category' => 'entertainment,movie,national,politics,world',
                'post_tag' => 'climate-change,election-results,market-stories,motogp-2017,sillicon-valley,united-stated'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:world:id}}')
            )
        ),
        'five-london-tower-blocks-evacuated-over-cladding-safety-fears' => array(
            'title' => "Five London Tower Blocks Evacuated Over Cladding Safety Fears",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news3',
            'taxonomy' => array(
                'category' => 'food,national,world',
                'post_tag' => 'climate-change,golden-globes,motogp-2017,mr-robot,sillicon-valley,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:world:id}}')
            )
        ),
        'these-edible-pick-up-sticks-let-you-play-with-your-food' => array(
            'title' => "These Edible Pick-Up Sticks Let You Play With Your Food",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news4',
            'taxonomy' => array(
                'category' => 'entertainment,health,lifestyle,sports',
                'post_tag' => 'climate-change,flat-earth,market-stories,motogp-2017,mr-robot'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food:id}}'),
                'post_subtitle' => 'Self-belief and hard work will always earn you success.'
            )
        ),
        'extreme-heat-waves-will-change-how-we-live-were-not-ready' => array(
            'title' => "Extreme Heat Waves Will Change How We Live. We’re Not Ready",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news5',
            'taxonomy' => array(
                'category' => 'politics,science,world',
                'post_tag' => 'climate-change,election-results,flat-earth,market-stories,mr-robot,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:world:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'new-campaign-wants-you-to-raise-funds-for-abuse-victims-by-ditching-the-razor' => array(
            'title' => "New campaign wants you to raise funds for abuse victims by ditching the razor",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news6',
            'taxonomy' => array(
                'category' => 'health,science,world',
                'post_tag' => 'climate-change,donald-trump,flat-earth,market-stories,sillicon-valley'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:world:id}}')
            )
        ),
        'how-to-find-protests-in-your-city-when-you-dont-know-where-to-start' => array(
            'title' => "How To Find Protests In Your City When You Don't Know Where To Start",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news7',
            'taxonomy' => array(
                'category' => 'food,national,politics,travel',
                'post_tag' => 'donald-trump,election-results,golden-globes,market-stories,mr-robot,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:national:id}}')
            )
        ),
        'trump-may-special-relationship-gets-special-treatment-in-the-streets-of-london' => array(
            'title' => "Trump-May Special Relationship Gets Special Treatment In The Streets of London",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news8',
            'taxonomy' => array(
                'category' => 'business,health,movie,music,politics',
                'post_tag' => 'donald-trump,election-results,market-stories,motogp-2017,mr-robot,united-stated,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'gopros-karma-drone-is-back-on-sale-after-design-flaw-made-them-fall-out-of-the-sky' => array(
            'title' => "Could Cristiano Ronaldo really be about to leave Real Madrid?",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news9',
            'taxonomy' => array(
                'category' => 'food,gaming,movie,sports',
                'post_tag' => 'donald-trump,flat-earth,golden-globes,mr-robot,sillicon-valley,united-stated',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
                'post_subtitle' => 'Before anything else, preparation is the key to success.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=pSPESZryb-c'
            )
        ),
        'of-course-this-novelty-final-fantasy-fork-is-an-oversized-sword-replica' => array(
            'title' => "How The Premier League Became A Dream Destination For Young Brazilians",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'entertainment,fashion,health,lifestyle,movie,sports',
                'post_tag' => 'climate-change,donald-trump,election-results,market-stories,motogp-2017,united-stated'
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
            'featured_image' => 'news2',
            'taxonomy' => array(
                'category' => 'fashion,gaming,lifestyle,sports',
                'post_tag' => 'climate-change,flat-earth,golden-globes,motogp-2017,mr-robot'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
            )
        ),
        'trump-attends-the-return-of-the-remains-of-the-navy-seal-who-died-in-yemen' => array(
            'title' => "British Police Warn Drug Users Of “Extra Strong, IKEA Branded” Ecstasy Pills",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news3',
            'taxonomy' => array(
                'category' => 'fashion,gaming,national,sports,travel',
                'post_tag' => 'climate-change,donald-trump,election-results,flat-earth,golden-globes,motogp-2017,mr-robot,sillicon-valley'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:national:id}}')
            )
        ),
        'the-chainsmokers-actually-make-a-great-nickelback-cover-band' => array(
            'title' => "The Chainsmokers Actually Make a Great Nickelback Cover Band",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news4',
            'taxonomy' => array(
                'category' => 'entertainment,fashion,health,lifestyle,music,science',
                'post_tag' => 'climate-change,golden-globes,market-stories,motogp-2017,mr-robot'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:music:id}}')
            )
        ),
        'j-k-rowling-is-shutting-down-readers-who-burned-all-their-harry-potter-books' => array(
            'title' => "Obama Wants To Visit Ubud On Low-key Bali Vacation: Bali Official",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news5',
            'taxonomy' => array(
                'category' => 'fashion,gaming,lifestyle,science,travel,world',
                'post_tag' => 'donald-trump,election-results,golden-globes,sillicon-valley,united-stated,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:world:id}}'),
                'post_subtitle' => 'Self-belief and hard work will always earn you success.'
            )
        ),
        'the-scary-reason-healthy-people-die-after-an-er-visit' => array(
            'title' => "New York Newest Vegan Spot: No Shade From Us, Shady Shack Is On Point",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news6',
            'taxonomy' => array(
                'category' => 'food,health,lifestyle,science',
                'post_tag' => 'golden-globes,motogp-2017,sillicon-valley,white-house'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food:id}}')
            )
        ),
        'watch-justin-timberlakes-cry-me-a-river-come-to-life-in-mesmerizing-dance' => array(
            'title' => "Watch Justin Timberlake's 'Cry Me a River' Come to Life in Mesmerizing Dance",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news7',
            'taxonomy' => array(
                'category' => 'entertainment,gaming,movie,music,science',
                'post_tag' => 'climate-change,flat-earth,golden-globes,motogp-2017,sillicon-valley'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:music:id}}')
            )
        ),
        'lady-gaga-pulled-off-one-of-the-best-halftime-shows-ever' => array(
            'title' => "Lady Gaga Pulled Off One of the Best Halftime Shows Ever",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news8',
            'taxonomy' => array(
                'category' => 'entertainment,fashion,lifestyle,music,travel',
                'post_tag' => 'flat-earth,golden-globes,market-stories,motogp-2017,mr-robot,united-stated',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:music:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=dMTKnO34lCE'
            )
        ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1498123782342{margin-bottom: 100px !important;background-color: #111111 !important;}.vc_custom_1498460103928{margin-top: -10px !important;margin-bottom: 40px !important;border-bottom-width: 1px !important;padding-bottom: 20px !important;border-bottom-color: #e8e8e8 !important;border-bottom-style: solid !important;}.vc_custom_1497951330965{margin-bottom: 30px !important;}.vc_custom_1498451819814{margin-bottom: 0px !important;}.vc_custom_1497953286225{margin-top: -10px !important;}.vc_custom_1498123549855{margin-bottom: -60px !important;}',
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
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1498123782342{margin-bottom: 100px !important;background-color: #111111 !important;}.vc_custom_1498460103928{margin-top: -10px !important;margin-bottom: 40px !important;border-bottom-width: 1px !important;padding-bottom: 20px !important;border-bottom-color: #e8e8e8 !important;border-bottom-style: solid !important;}.vc_custom_1497951330965{margin-bottom: 30px !important;}.vc_custom_1498451819814{margin-bottom: 0px !important;}.vc_custom_1497953286225{margin-top: -10px !important;}.vc_custom_1498123549855{margin-bottom: -60px !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1498462112764{margin-top: 0px !important;}.vc_custom_1498462112764{margin-top: 0px !important;}.vc_custom_1498462112764{margin-top: 0px !important;}.vc_custom_1498462112764{margin-top: 0px !important;}.vc_custom_1498462112764{margin-top: 0px !important;}.vc_custom_1498118759265{border-right-width: 1px !important;padding-right: 25px !important;border-right-color: #eeeeee !important;border-right-style: solid !important;}.vc_custom_1498118840775{margin-top: -10px !important;}.vc_custom_1498120545389{margin-bottom: 30px !important;border-top-width: 3px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 18px !important;padding-right: 25px !important;padding-bottom: 15px !important;padding-left: 25px !important;border-left-color: #111111 !important;border-left-style: solid !important;border-right-color: #111111 !important;border-right-style: solid !important;border-top-color: #111111 !important;border-top-style: solid !important;border-bottom-color: #111111 !important;border-bottom-style: solid !important;}',
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
                ),
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'header_type' => 'heading_6',
                    'layout' => 'no-sidebar',
                    'module'    => '22',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_2',
                    'show_navtext' => '1',
                    'post_offset' => 0,
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1498462112764{margin-top: 0px !important;}.vc_custom_1498462112764{margin-top: 0px !important;}.vc_custom_1498462112764{margin-top: 0px !important;}.vc_custom_1498462112764{margin-top: 0px !important;}.vc_custom_1498462112764{margin-top: 0px !important;}.vc_custom_1498118759265{border-right-width: 1px !important;padding-right: 25px !important;border-right-color: #eeeeee !important;border-right-style: solid !important;}.vc_custom_1498118840775{margin-top: -10px !important;}.vc_custom_1498120545389{margin-bottom: 30px !important;border-top-width: 3px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 18px !important;padding-right: 25px !important;padding-bottom: 15px !important;padding-left: 25px !important;border-left-color: #111111 !important;border-left-style: solid !important;border-right-color: #111111 !important;border-right-style: solid !important;border-top-color: #111111 !important;border-top-style: solid !important;border-bottom-color: #111111 !important;border-bottom-style: solid !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1498635775961{margin-top: -10px !important;margin-bottom: 20px !important;background-color: #f5f5f5 !important;}.vc_custom_1498636312662{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 15px !important;padding-right: 15px !important;padding-bottom: 15px !important;padding-left: 15px !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1498636321418{margin-bottom: 0px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_5',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-3-loop',
                    'module'    => '3',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'show_navtext' => '1',
                    'show_pageinfo' => '1',
                    'pagination_align' => 'left',   
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1498635775961{margin-top: -10px !important;margin-bottom: 20px !important;background-color: #f5f5f5 !important;}.vc_custom_1498636312662{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 15px !important;padding-right: 15px !important;padding-bottom: 15px !important;padding-left: 15px !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1498636321418{margin-bottom: 0px !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1498639556221{margin-bottom: 30px !important;}.vc_custom_1498639591674{margin-bottom: 30px !important;}.vc_custom_1498639794264{border-top-width: 2px !important;border-right-width: 2px !important;border-bottom-width: 2px !important;border-left-width: 2px !important;padding-top: 15px !important;padding-right: 20px !important;padding-left: 20px !important;border-left-color: #111111 !important;border-left-style: solid !important;border-right-color: #111111 !important;border-right-style: solid !important;border-top-color: #111111 !important;border-top-style: solid !important;border-bottom-color: #111111 !important;border-bottom-style: solid !important;background-color: #111111 !important;}',
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1498639556221{margin-bottom: 30px !important;}.vc_custom_1498639591674{margin-bottom: 30px !important;}.vc_custom_1498639794264{border-top-width: 2px !important;border-right-width: 2px !important;border-bottom-width: 2px !important;border-left-width: 2px !important;padding-top: 15px !important;padding-right: 20px !important;padding-left: 20px !important;border-left-color: #111111 !important;border-left-style: solid !important;border-right-color: #111111 !important;border-right-style: solid !important;border-top-color: #111111 !important;border-top-style: solid !important;border-bottom-color: #111111 !important;border-bottom-style: solid !important;background-color: #111111 !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1483598309110{border-top-width: 2px !important;padding-top: 15px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-5-loop',
                    'module'    => '3',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'show_navtext' => '1',
                    'show_pageinfo' => '1',
                    'pagination_align' => 'left',   
                ),
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1483598309110{border-top-width: 2px !important;padding-top: 15px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}'
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

        'world' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'World',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:world:id}}',
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
        'science' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Science',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:science:id}}',
                'menu-item-status' => 'publish'
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
                    'number' => 6,
                    'trending_tag' => '{{taxonomy:post_tag:sillicon-valley:id}},{{taxonomy:post_tag:climate-change:id}},{{taxonomy:post_tag:election-results:id}},{{taxonomy:post_tag:flat-earth:id}},{{taxonomy:post_tag:golden-globes:id}},{{taxonomy:post_tag:motogp-2017:id}},{{taxonomy:post_tag:mr-robot:id}}',
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
                    'type' => 'category_1',
                    'category' => '{{category:entertainment:id}}',
                    'number' => 9
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
                    'number' => 10,
                    'trending_tag' => '{{taxonomy:post_tag:golden-globes:id}},{{taxonomy:post_tag:mr-robot:id}},{{taxonomy:post_tag:motogp-2017:id}},{{taxonomy:post_tag:climate-change:id}},{{taxonomy:post_tag:flat-earth:id}}',
                ),
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
        'world-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'World',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:world:id}}',
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
                    'menu-item-parent-id' => '{{menu:news-mobile:id}}',
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
                    'menu-item-parent-id' => '{{menu:news-mobile:id}}',
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
                    'menu-item-parent-id' => '{{menu:news-mobile:id}}',
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
                    'menu-item-parent-id' => '{{menu:news-mobile:id}}',
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
        'health-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Health',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:health:id}}',
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
                'menu-item-status' => 'publish'
            )
        )

    ),

    'widget_position' => array(
        'Home 3 - Loop',
        'Home 3',
        'Home 5',
        'Home 5 - Loop',
        'Author',
        'Home 1',
        'Home 2'
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
        'jnews-gallery',
        'jnews-jsonld',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-split',
        'jnews-view-counter',
        'jnews-weather',
        'mailchimp-for-wp'
    )

);