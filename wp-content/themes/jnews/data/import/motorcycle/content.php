<?php

return array(

    // image
    'image' =>  array(
        'moto1' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/moto1.jpg',
        'moto2' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/moto2.jpg',
        'moto3' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/moto3.jpg',
        'moto4' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/moto4.jpg',
        'moto5' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/moto5.jpg',
        'moto6' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/moto6.jpg',
        'moto7' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/moto7.jpg',
        'moto8' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/moto8.jpg',
        'moto9' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/moto9.jpg',
        'moto_bg' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/moto_bg.jpg',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/logo.png',
        'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/logo.png',
        'sticky_logo' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/logo.png',
        'sticky_logo2x' => 'http://jegtheme.com/asset/jnews/demo/motorcycle/logo.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(

            'brand' => array(
                'title' =>'Brand',
                'description' => 'A wonderful serenity has taken possession of my entire soul.'
            ),
                'bmw' => array(
                    'title' =>'BMW',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'brand'
                ),
                'ducati' => array(
                    'title' =>'Ducati',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'brand'
                ),
                'harley-davidson' => array(
                    'title' =>'Harley-Davidson',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'brand'
                ),
                'honda' => array(
                    'title' =>'Honda',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'brand'
                ),
                'kawasaki' => array(
                    'title' =>'Kawasaki',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'brand'
                ),
                'suzuki' => array(
                    'title' =>'Suzuki',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'brand'
                ),
                'triumph' => array(
                    'title' =>'Triumph',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'brand'
                ),
                'yamaha' => array(
                    'title' =>'Yamaha',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'brand'
                ),
            'motogp' => array(
                'title' =>'MotoGP',
                'description' => 'A wonderful serenity has taken possession of my entire soul.'
            ),
            'type' => array(
                'title' =>'Type',
                'description' => 'A wonderful serenity has taken possession of my entire soul.'
            ),
                'adventure' => array(
                    'title' =>'Adventure',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'type'
                ),
                'cruiser' => array(
                    'title' =>'Cruiser',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'type'
                ),
                'retro' => array(
                    'title' =>'Retro',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'type'
                ),
                'sport' => array(
                    'title' =>'Sport',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'type'
                ),
                'touring' => array(
                    'title' =>'Touring',
                    'description' => 'A wonderful serenity has taken possession of my entire soul.',
                    'parent' => 'type'
                ),
        ),
    
        'post_tag' => array(
            'adventure' => array(
                'title' => 'Adventure',
            ),
            'assengp' => array(
                'title' => 'AssenGP',
            ),
            'big-bike' => array(
                'title' => 'Big Bike',
            ),
            'bikes-for-sale' => array(
                'title' => 'Bikes for sale',
            ),
            'custom-motorcycle' => array(
                'title' => 'Custom Motorcycle'
            ),
            'dovizioso' => array(
                'title' => 'Dovizioso'
            ),
            'ducati-on-sale' => array(
                'title' => 'Ducati on sale'
            ),
            'dutchgp' => array(
                'title' => 'DutchGP'
            ),
            'harley-davidson' => array(
                'title' => 'Harley-Davidson'
            ),
            'japstyle' => array(
                'title' => 'Japstyle'
            ),
            'kawasaki-zrx' => array(
                'title' => 'Kawasaki ZRX'
            ),
            'lorenzo' => array(
                'title' => 'Lorenzo'
            ),
            'motogp' => array(
                'title' => 'MotoGP'
            ),
            'motorcycle-news' => array(
                'title' => 'Motorcycle News'
            ),
            'retro-motorcycle' => array(
                'title' => 'Retro Motorcycle'
            ),
            'ride-to-work' => array(
                'title' => 'Ride to work'
            ),
            'riding-style' => array(
                'title' => 'Riding Style'
            ),
            'rossi' => array(
                'title' => 'Rossi'
            ),
            'vw-audio-group' => array(
                'title' => 'VW Audio Group'
            ),
            'zarco' => array(
                'title' => 'Zarco'
            )
        )
    ),

    // post & page
    'post' => array(
        'rossi-thought-of-last-lap-marquez-duel-very-worrying' => array(
            'title' => "Rossi: Thought of last lap Marquez duel very worrying!",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto1',
            'taxonomy' => array(
                'category' => 'ducati,honda,kawasaki,motogp,suzuki,triumph,yamaha',
                'post_tag' => 'assengp,motogp,zarco'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:motogp:id}}')
            )
        ),
        'all-new-suzuki-gsx-r600-gets-0-finance-deal' => array(
            'title' => "All new Suzuki GSX-R600 gets 0% finance deal",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto2',
            'taxonomy' => array(
                'category' => 'bmw,ducati,kawasaki,retro,suzuki',
                'post_tag' => 'custom-motorcycle,japstyle,retro-motorcycle'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:suzuki:id}}')
            )
        ),
        'best-of-bikemart-modern-classic-bikes-for-sale-this-week' => array(
            'title' => "Best of bikemart: Modern classic bikes for sale this week",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto3',
            'taxonomy' => array(
                'category' => 'adventure,bmw,cruiser,kawasaki,retro,sport',
                'post_tag' => 'adventure,big-bike,riding-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:triumph:id}}')
            )
        ),
        'piaggio-yourban-300lt-an-english-proofreader-short-of-genius' => array(
            'title' => "Piaggio Yourban 300LT: an English proofreader short of genius",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto4',
            'taxonomy' => array(
                'category' => 'bmw,cruiser,harley-davidson,honda,kawasaki',
                'post_tag' => 'bikes-for-sale,custom-motorcycle,harley-davidson,ride-to-work,vw-audio-group'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:yamaha:id}}')
            )
        ),
        'worlds-first-harley-davidson-road-king-backflip-nearly-works' => array(
            'title' => "World's first Harley-Davidson Road King backflip nearly works",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto5',
            'taxonomy' => array(
                'category' => 'adventure,bmw,cruiser,harley-davidson,sport',
                'post_tag' => 'ducati-on-sale,harley-davidson,motorcycle-news,vw-audio-group'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:yamaha:id}}')
            )
        ),
        'entertainment-announced-for-british-motogp-at-silverstone' => array(
            'title' => "Entertainment announced for British MotoGP at Silverstone",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto6',
            'taxonomy' => array(
                'category' => 'adventure,bmw,cruiser,harley-davidson,triumph',
                'post_tag' => 'adventure,big-bike,custom-motorcycle,japstyle,retro-motorcycle,riding-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:yamaha:id}}')
            )
        ),
        'vicious-bike-gang-assault-rider-in-attempt-to-steal-her-bike' => array(
            'title' => "Vicious bike gang assault rider in attempt to steal her bike",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto7',
            'taxonomy' => array(
                'category' => 'adventure,bmw,cruiser,sport,touring,triumph',
                'post_tag' => 'custom-motorcycle,japstyle,retro-motorcycle'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:bmw:id}}')
            )
        ),
        'triumph-launches-new-insurance-products' => array(
            'title' => "Triumph launches new insurance products",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto8',
            'taxonomy' => array(
                'category' => 'adventure,bmw,cruiser,harley-davidson,triumph',
                'post_tag' => 'adventure,big-bike,riding-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:triumph:id}}')
            )
        ),
        'lorenzo-at-motogp-assen-im-not-a-specialist-in-these-conditions' => array(
            'title' => "Lorenzo at MotoGP Assen: I'm not a specialist in these conditions",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto9',
            'taxonomy' => array(
                'category' => 'ducati,honda,motogp,suzuki,yamaha',
                'post_tag' => 'lorenzo,motogp,rossi'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:motogp:id}}')
            )
        ),
        'is-the-zona-m100-rear-view-camera-the-future' => array(
            'title' => "Is the Zona M100 rear-view camera the future?",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto1',
            'taxonomy' => array(
                'category' => 'ducati,harley-davidson,kawasaki,sport,suzuki',
                'post_tag' => 'ducati-on-sale,harley-davidson,motorcycle-news,vw-audio-group'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:honda:id}}')
            )
        ),
        'ducati-1299-superleggera-the-most-savage-superbike-ever' => array(
            'title' => "Ducati 1299 Superleggera: The most savage superbike ever",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto2',
            'taxonomy' => array(
                'category' => 'ducati,harley-davidson,kawasaki,retro,sport,touring',
                'post_tag' => 'bikes-for-sale,custom-motorcycle,harley-davidson,ride-to-work,vw-audio-group'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:honda:id}}')
            )
        ),
        'are-you-going-to-the-isle-of-man-tt' => array(
            'title' => "Are you going to the Isle of Man TT?",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto3',
            'taxonomy' => array(
                'category' => 'honda,kawasaki,retro,sport,suzuki,touring,yamaha',
                'post_tag' => 'custom-motorcycle,japstyle,retro-motorcycle'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:honda:id}}')
            )
        ),
        'first-ride-incoming-bmw-r-ninet-urban-gs' => array(
            'title' => "First ride incoming: BMW R nineT Urban G/S",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto4',
            'taxonomy' => array(
                'category' => 'adventure,bmw,cruiser,ducati,honda,retro,suzuki',
                'post_tag' => 'adventure,big-bike,riding-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:bmw:id}}')
            )
        ),
        'husqvarna-unveil-fuel-injected-two-stroke-range' => array(
            'title' => "Husqvarna unveil fuel-injected two-stroke range",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto5',
            'taxonomy' => array(
                'category' => 'adventure,cruiser,ducati,harley-davidson,triumph,yamaha',
                'post_tag' => 'bikes-for-sale,kawasaki-zrx,motorcycle-news,ride-to-work'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:triumph:id}}')
            )
        ),
        'you-could-do-with-one-of-these-in-your-garage' => array(
            'title' => "You could do with one of these in your garage",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto6',
            'taxonomy' => array(
                'category' => 'honda,retro,touring,triumph,yamaha',
                'post_tag' => 'ducati-on-sale,harley-davidson,motorcycle-news,vw-audio-group'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:honda:id}}')
            )
        ),
        'dovizioso-i-thought-about-the-championship' => array(
            'title' => "Dovizioso: \"I thought about the Championship\"",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto7',
            'taxonomy' => array(
                'category' => 'ducati,harley-davidson,honda,motogp,triumph,yamaha',
                'post_tag' => 'dovizioso,motogp,rossi'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:motogp:id}}')
            )
        ),
        'yamaha-mt-03-and-r3-get-updated-colours' => array(
            'title' => "Yamaha MT-03 and R3 get updated colours",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto8',
            'taxonomy' => array(
                'category' => 'adventure,cruiser,retro,touring,triumph,yamaha',
                'post_tag' => 'bikes-for-sale,custom-motorcycle,harley-davidson,ride-to-work,vw-audio-group'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:yamaha:id}}')
            )
        ),
        'bike-of-the-day-suzuki-dl1000-v-strom-grand-touring' => array(
            'title' => "Bike of the day: Suzuki DL1000 V-Strom Grand Touring",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto9',
            'taxonomy' => array(
                'category' => 'cruiser,kawasaki,retro,suzuki,touring,triumph,yamaha',
                'post_tag' => 'custom-motorcycle,harley-davidson,kawasaki-zrx,ride-to-work'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:suzuki:id}}')
            )
        ),
        'bmw-motorrad-days-returns-next-month' => array(
            'title' => "BMW Motorrad Days returns next month",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto2',
            'taxonomy' => array(
                'category' => 'adventure,bmw,ducati,honda,sport',
                'post_tag' => 'adventure,big-bike,custom-motorcycle,japstyle,retro-motorcycle,riding-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:bmw:id}}')
            )
        ),
        'customs-get-a-boost-for-brackley-festival-of-motorcycling' => array(
            'title' => "Customs get a boost for Brackley Festival of Motorcycling",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto3',
            'taxonomy' => array(
                'category' => 'cruiser,kawasaki,retro,sport,touring,triumph,yamaha',
                'post_tag' => 'custom-motorcycle,japstyle,retro-motorcycle'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:triumph:id}}')
            )
        ),
        'big-biking-adventures-across-the-globe' => array(
            'title' => "Big biking adventures across the globe",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto4',
            'taxonomy' => array(
                'category' => 'adventure,bmw,harley-davidson,honda,kawasaki,suzuki,touring',
                'post_tag' => 'adventure,big-bike,riding-style'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:harley-davidson:id}}')
            )
        ),
        'all-new-suzuki-gsx-r600-gets-0-finance-deal-2' => array(
            'title' => "Zarco: If it rained more, I could have been a god",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto5',
            'taxonomy' => array(
                'category' => 'honda,motogp,suzuki,yamaha',
                'post_tag' => 'dutchgp,motogp,zarco'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:motogp:id}}')
            )
        ),
        'why-this-bulletproof-zrx-is-worth-2500-of-anyones-money' => array(
            'title' => "Why this bulletproof ZRX is worth £2500 of anyone’s money",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'moto6',
            'taxonomy' => array(
                'category' => 'kawasaki,retro,sport,suzuki,touring',
                'post_tag' => 'bikes-for-sale,kawasaki-zrx,motorcycle-news,ride-to-work'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:kawasaki:id}}')
            )
        ),
        'ducati-up-for-sale-harley-davidson-reportedly-preparing-a-bid' => array(
            'title' => "Harley-Davidson Expressing Interest in Buying Ducati",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'moto7',
            'taxonomy' => array(
                'category' => 'ducati,harley-davidson,kawasaki,retro,sport,touring',
                'post_tag' => 'ducati-on-sale,harley-davidson,motorcycle-news,vw-audio-group'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ducati:id}}')
            )
        ),
    
        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1498702456954{margin-top: -30px !important;}.vc_custom_1498292610467{margin-top: 30px !important;}.vc_custom_1498547170226{padding-top: 35px !important;background-color: #eeeeee !important;}.vc_custom_1498463150283{margin-bottom: 50px !important;padding-top: 50px !important;background-image: url({{image:moto_bg:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1498710988941{border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 20px !important;background-color: #111111 !important;border-top-color: #383838 !important;border-top-style: solid !important;border-bottom-color: #383838 !important;border-bottom-style: solid !important;}.vc_custom_1498461383108{padding-top: 20px !important;padding-right: 20px !important;padding-bottom: 10px !important;padding-left: 20px !important;background-color: rgba(5,5,5,0.6) !important;*background-color: rgb(5,5,5) !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'second_title' => '',
                    'header_type' => 'heading_2',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '3',
                    'excerpt_length' => '27',
                    'content_date' => 'default',
                    'date_custom' => 'Y/m/d',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1498702456954 .elementor-container{max-width: 1230px !important;}.vc_custom_1498702456954{margin-top: -30px !important;}.vc_custom_1498292610467{margin-top: 30px !important;}.vc_custom_1498547170226{padding-top: 35px !important;background-color: #eeeeee !important;}.vc_custom_1498463150283{margin-bottom: 50px !important;padding-top: 50px !important;background-image: url({{image:moto_bg:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1498710988941{border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 20px !important;background-color: #111111 !important;border-top-color: #383838 !important;border-top-style: solid !important;border-bottom-color: #383838 !important;border-bottom-style: solid !important;}.vc_custom_1498461383108{padding-top: 20px !important;padding-right: 20px !important;padding-bottom: 10px !important;padding-left: 20px !important;background-color: rgba(5,5,5,0.6) !important;*background-color: rgb(5,5,5) !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_post_custom_css' => '.jeg_block_heading_5.alt::before{border-color: #aaa;}.jsc_dark .jeg_dark_playlist .jeg_video_playlist_title{color: #fff;}',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1498551926075{margin-bottom: 20px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'second_title' => '',
                    'header_type' => 'heading_2',
                    'layout' => 'no-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '15',
                    'excerpt_length' => '27',
                    'content_date' => 'default',
                    'date_custom' => 'Y/m/d',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'sort_by' => 'latest',
                ),
                'jnews_video_cache' => array(
                    'UJnDKxgUoho' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=UJnDKxgUoho',
                        'id' => 'UJnDKxgUoho',
                        'title' => 'The Paddock Girls of the #ArgentinaGP',
                        'thumbnail' => 'https://i.ytimg.com/vi/UJnDKxgUoho/default.jpg',
                        'duration' => '00:01:07'
                    ),
                    'FyEtmQT7ftA' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=FyEtmQT7ftA',
                        'id' => 'FyEtmQT7ftA',
                        'title' => '2017 Yamaha XSR 900 Review',
                        'thumbnail' => 'https://i.ytimg.com/vi/FyEtmQT7ftA/default.jpg',
                        'duration' => '00:20:59'
                    ),
                    'lZHF_BL58sM' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=lZHF_BL58sM',
                        'id' => 'lZHF_BL58sM',
                        'title' => 'Yamaha R1M - First Ride 2015',
                        'thumbnail' => 'https://i.ytimg.com/vi/lZHF_BL58sM/default.jpg',
                        'duration' => '00:17:00'
                    ),
                    'uOfdlt0uqtE' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=uOfdlt0uqtE',
                        'id' => 'uOfdlt0uqtE',
                        'title' => 'Yamaha R6 | Bike Review',
                        'thumbnail' => 'https://i.ytimg.com/vi/uOfdlt0uqtE/default.jpg',
                        'duration' => '00:07:12'
                    ),
                    'grVPsnJ8gKo' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=grVPsnJ8gKo',
                        'id' => 'grVPsnJ8gKo',
                        'title' => '2017 Honda CBR1000RR SP Review of Specs + Start-Up | CBR Sport Bike / Motorcycle Walk-Around | HRC',
                        'thumbnail' => 'https://i.ytimg.com/vi/grVPsnJ8gKo/default.jpg',
                        'duration' => '00:08:20'
                    ),
                    'NcBqvsiw_Yc' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=NcBqvsiw_Yc',
                        'id' => 'NcBqvsiw_Yc',
                        'title' => 'Harley Davidson Sportster Iron 883 Review at RevZilla.com',
                        'thumbnail' => 'https://i.ytimg.com/vi/NcBqvsiw_Yc/default.jpg',
                        'duration' => '00:11:05'
                    )
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.jeg_block_heading_5.alt::before{border-color: #aaa;}.jsc_dark .jeg_dark_playlist .jeg_video_playlist_title{color: #fff;}.vc_custom_1498551926075{margin-bottom: 20px !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1498702315668{margin-top: -30px !important;margin-bottom: 30px !important;background-image: url({{image:moto_bg:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}',
                '_wpb_post_custom_css' => '.jeg_block_heading_5.alt::before{border-color: #aaa;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'second_title' => '',
                    'header_type' => 'heading_2',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '3',
                    'excerpt_length' => '27',
                    'content_date' => 'default',
                    'date_custom' => 'Y/m/d',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'show_navtext' => 1,
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1498702315668{margin-top: -30px !important;margin-bottom: 30px !important;background-image: url({{image:moto1:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.jeg_block_heading_5.alt::before{border-color: #aaa;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1498705804321{margin-top: -30px !important;}.vc_custom_1498708294377{margin-bottom: 40px !important;padding-top: 30px !important;background-color: #444444 !important;}.vc_custom_1498710426144{margin-bottom: 50px !important;padding-top: 50px !important;padding-bottom: 20px !important;background: #878787 url({{image:moto1:url:full}}) !important;}.vc_custom_1498708286266{margin-bottom: 30px !important;}.vc_custom_1498709507169{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 30px !important;padding-bottom: 30px !important;background-color: #282828 !important;border-left-color: #333333 !important;border-left-style: dashed !important;border-right-color: #333333 !important;border-right-style: dashed !important;border-top-color: #333333 !important;border-top-style: dashed !important;border-bottom-color: #333333 !important;border-bottom-style: dashed !important;}',
                '_wpb_post_custom_css' => '.jeg_pl_lg_7 {border-color: #5a5959;} .jsc_dark .jeg_video_playlist_title {color: #fff;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'second_title' => '',
                    'header_type' => 'heading_2',
                    'layout' => 'no-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '23',
                    'excerpt_length' => '27',
                    'content_date' => 'default',
                    'date_custom' => 'Y/m/d',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1498705804321 .elementor-container {max-width: 1230px !important;}.vc_custom_1498705804321{margin-top: -30px !important;}.vc_custom_1498708294377{margin-bottom: 40px !important;padding-top: 30px !important;background-color: #444444 !important;}.vc_custom_1498710426144{margin-bottom: 50px !important;padding-top: 50px !important;padding-bottom: 20px !important;background: #878787 url({{image:moto1:url:full}}) !important;}.vc_custom_1498708286266{margin-bottom: 30px !important;}.vc_custom_1498709507169{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 30px !important;padding-bottom: 30px !important;background-color: #282828 !important;border-left-color: #333333 !important;border-left-style: dashed !important;border-right-color: #333333 !important;border-right-style: dashed !important;border-top-color: #333333 !important;border-top-style: dashed !important;border-bottom-color: #333333 !important;border-bottom-style: dashed !important;}.jeg_pl_lg_7 {border-color: #5a5959;} .jsc_dark .jeg_video_playlist_title {color: #fff;}'
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
        'motorcycle' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Motorcycle',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
            'brand' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Brand',
                    'menu-item-parent-id' => '{{menu:motorcycle:id}}',
                    'menu-item-type' => 'taxonomy',
                    'menu-item-object' => 'category',
                    'menu-item-object-id' => '{{post:brand:id}}',
                    'menu-item-status' => 'publish'
                ),
                'metabox' => array(
                    'menu_item_jnews_mega_menu' => array(
                        'child_mega' => 'two_row',
                    ),
                )
            ),
                'bmw' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'BMW',
                        'menu-item-parent-id' => '{{menu:brand:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:bmw:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'ducati' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Ducati',
                        'menu-item-parent-id' => '{{menu:brand:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:ducati:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'harley-davidson' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Harley-Davidson',
                        'menu-item-parent-id' => '{{menu:brand:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:harley-davidson:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'honda' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Honda',
                        'menu-item-parent-id' => '{{menu:brand:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:honda:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'kawasaki' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Kawasaki',
                        'menu-item-parent-id' => '{{menu:brand:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:kawasaki:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'suzuki' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Suzuki',
                        'menu-item-parent-id' => '{{menu:brand:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:suzuki:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'triumph' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Triumph',
                        'menu-item-parent-id' => '{{menu:brand:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:triumph:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'yamaha' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Yamaha',
                        'menu-item-parent-id' => '{{menu:brand:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:yamaha:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
            'type' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Type',
                    'menu-item-parent-id' => '{{menu:motorcycle:id}}',
                    'menu-item-type' => 'taxonomy',
                    'menu-item-object' => 'category',
                    'menu-item-object-id' => '{{post:type:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
                'adventure' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Adventure',
                        'menu-item-parent-id' => '{{menu:type:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:adventure:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'cruiser' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Cruiser',
                        'menu-item-parent-id' => '{{menu:type:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:cruiser:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'retro' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Retro',
                        'menu-item-parent-id' => '{{menu:type:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:retro:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'sport' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Sport',
                        'menu-item-parent-id' => '{{menu:type:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:sport:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
                'touring' => array(
                    'location' => 'main-navigation',
                    'menu-item-data' => array(
                        'menu-item-title' => 'Touring',
                        'menu-item-parent-id' => '{{menu:type:id}}',
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'category',
                        'menu-item-object-id' => '{{post:touring:id}}',
                        'menu-item-status' => 'publish'
                    )
                ),
            'engine' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Engine',
                    'menu-item-parent-id' => '{{menu:motorcycle:id}}',
                    'menu-item-type' => 'custom',
                    'menu-item-url' => '#',
                    'menu-item-status' => 'publish'
                )
            ),
            'custom' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Custom',
                    'menu-item-parent-id' => '{{menu:motorcycle:id}}',
                    'menu-item-type' => 'custom',
                    'menu-item-url' => '#',
                    'menu-item-status' => 'publish'
                )
            ),
            'gear' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Gear',
                    'menu-item-parent-id' => '{{menu:motorcycle:id}}',
                    'menu-item-type' => 'custom',
                    'menu-item-url' => '#',
                    'menu-item-status' => 'publish'
                )
            ),
        'motogp' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'MotoGP',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:motogp:id}}',
                    'number' => 4,
                ),
            )
        ),
        'custom-1' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Custom',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'gear-1' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Gear',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'videos' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Videos',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'subscribe' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Subscribe',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
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
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
    ),

    'widget_position' => array(
        'Home Widget',
        'Home Loop',
        'Single Post'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'jnews-breadcrumb', 
        'jnews-jsonld',
        'jnews-like',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter'
    )
);
