<?php

return array(

    // image
    'image' =>  array(
        'travel1' => 'http://jegtheme.com/asset/jnews/demo/travel/travel1.jpg',
        'travel2' => 'http://jegtheme.com/asset/jnews/demo/travel/travel2.jpg',
        'travel3' => 'http://jegtheme.com/asset/jnews/demo/travel/travel3.jpg',
        'travel4' => 'http://jegtheme.com/asset/jnews/demo/food/food5.jpg',
        'travel5' => 'http://jegtheme.com/asset/jnews/demo/travel/travel5.jpg',
        'travel6' => 'http://jegtheme.com/asset/jnews/demo/travel/travel6.jpg',
        'travel7' => 'http://jegtheme.com/asset/jnews/demo/travel/travel7.jpg',
        'travel8' => 'http://jegtheme.com/asset/jnews/demo/travel/travel8.jpg',
        'travel9' => 'http://jegtheme.com/asset/jnews/demo/travel/travel9.jpg',
        'travel10' => 'http://jegtheme.com/asset/jnews/demo/default/travel3.jpg',
        'travel_bg' => 'http://jegtheme.com/asset/jnews/demo/travel/travel_bg.jpg',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/travel/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/travel/logo@2x.png',
        'footer_logo' => 'http://jegtheme.com/asset/jnews/demo/travel/footer_logo.png',
        'footer_logo2x' => 'http://jegtheme.com/asset/jnews/demo/travel/footer_logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'destination' =>
                array(
                    'title' =>'Destination',
                    'description' => 'You can add some category description here.'
                ),
            'food-drink' =>
                array(
                    'title' =>'Food & Drink',
                    'description' => 'You can add some category description here.'
                ),
            'news' =>
                array(
                    'title' =>'News',
                    'description' => 'You can add some category description here.'
                ),
            'travel-ideas' =>
                array(
                    'title' =>'Travel Ideas',
                    'description' => 'You can add some category description here.'
                ),
            'photo' =>
                array(
                    'title' =>'Photo',
                    'description' => 'You can add some category description here.'
                ),
            'video' =>
                array(
                    'title' =>'Video',
                    'description' => 'You can add some category description here.'
                ),
        ),
        'post_tag' => array(
            'backpacker' => array(
                'title' => 'Backpacker'
            ),
            'food' => array(
                'title' => 'Food'
            ),
            'gear' => array(
                'title' => 'Gear'
            ),
            'resources' => array(
                'title' => 'Resources'
            ),
            'solo-travel' => array(
                'title' => 'Solo Travel'
            ),
            'tips' => array(
                'title' => 'Tips'
            ),
            'trip-plan' => array(
                'title' => 'Trip Plan'
            )
        )
    ),

    // post & page
    'post' => array(
        // post
        'your-guide-to-canggus-hottest-street-the-essential-batu-bolong' => array(
            'title' => "Your Guide to Canggu’s Hottest Street: The Essential Batu Bolong",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel1',
            'taxonomy' => array(
                'category' => 'news,photo,travel-ideas',
                'post_tag' => 'backpacker,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}')
            )
        ),
        '6-perfect-places-to-watch-the-sunrise-in-bali-while-you-honeymoon' => array(
            'title' => "6 Perfect places to watch the sunrise in Bali while you honeymoon",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel2',
            'taxonomy' => array(
                'category' => 'news,photo,travel-ideas',
                'post_tag' => 'backpacker,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:photo:id}}')
            )
        ),
        '10-summer-safety-tips-for-water-sports-adventurers' => array(
            'title' => "10 Summer Safety Tips For Water Sports Adventurers",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel3',
            'taxonomy' => array(
                'category' => 'destination,photo,travel-ideas',
                'post_tag' => 'resources,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}')
            )
        ),
        'expert-tips-how-to-become-a-professional-travel-blogger' => array(
            'title' => "Expert Tips: How To Become A Professional Travel Blogger",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel4',
            'taxonomy' => array(
                'category' => 'destination,news,travel-ideas',
                'post_tag' => 'backpacker,food,gear,resources,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}')
            )
        ),
        'tips-choosing-the-best-accommodation-type-for-your-trip' => array(
            'title' => "Tips: Choosing the best accommodation type for your trip",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel5',
            'taxonomy' => array(
                'category' => 'destination,food-drink,travel-ideas',
                'post_tag' => 'food,gear,resources,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}')
            )
        ),
        'these-delicious-balinese-street-foods-you-need-to-try-right-now' => array(
            'title' => "These delicious Balinese street foods you need to try right now",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel6',
            'taxonomy' => array(
                'category' => 'destination,food-drink,photo,travel-ideas',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food-drink:id}}')
            )
        ),
        'celebrate-nyepi-in-true-bali-spirit-with-a-luxurious-day-of-silence' => array(
            'title' => "Celebrate Nyepi in true Bali spirit with a luxurious day of silence",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel7',
            'taxonomy' => array(
                'category' => 'destination,photo,travel-ideas',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}')
            )
        ),
        'great-surf-spots-in-bali-from-beginner-to-pro-surfers' => array(
            'title' => "Great Surf Spots in Bali: From Beginner to Pro Surfers",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel8',
            'taxonomy' => array(
                'category' => 'destination,photo,travel-ideas',
                'post_tag' => 'resources,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}')
            )
        ),
        'important-things-you-should-know-for-mount-agung-hiking' => array(
            'title' => "Important things you should know for Mount Agung hiking",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel9',
            'taxonomy' => array(
                'category' => 'destination,news,travel-ideas,video',
                'post_tag' => 'backpacker,food,gear,resources,solo-travel,tips,trip-plan',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:video:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=7nc93MhqbYw',
                'jnews_single_post' => array(
                    'override_template' => '1',
                    'override' => array(
                        array(
                            'template' => '9',
                            'parallax' => '1',
                            'fullscreen' => '0',
                            'layout' => 'right-sidebar',
                            'sidebar' => 'default-sidebar',
                            'share_position' => 'bottom',
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
                            'show_prev_next_post' => '0',
                            'show_popup_post' => '1',
                            'show_author_box' => '1',
                            'show_post_related' => '1',
                        )
                    )
                )
            )
        ),
        'how-to-built-a-freelance-career-while-traveling-the-world' => array(
            'title' => "How to built a freelance career while traveling the world",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel10',
            'taxonomy' => array(
                'category' => 'news,travel-ideas',
                'post_tag' => 'gear,resources,solo-travel,tips'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}'),
                'post_subtitle' => 'Essential tips for beginners.'
            )
        ),
        'a-restaurant-near-seminyak-is-making-tea-leaf-salad-pizza' => array(
            'title' => "A restaurant near Seminyak is making tea leaf salad pizza",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel1',
            'taxonomy' => array(
                'category' => 'food-drink,photo',
                'post_tag' => 'backpacker,food,gear,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food-drink:id}}')
            )
        ),
        '10-most-hidden-and-secluded-beach-in-bali-with-breathtaking-views' => array(
            'title' => "10 Most Hidden and Secluded Beach in Bali with Breathtaking Views",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel2',
            'taxonomy' => array(
                'category' => 'destination,photo,travel-ideas',
                'post_tag' => 'backpacker,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:destination:id}}')
            )
        ),
        'bali-nightlife-guide-the-most-popular-clubs-in-kuta' => array(
            'title' => "Bali Nightlife Guide : The most popular clubs in Kuta",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel3',
            'taxonomy' => array(
                'category' => 'destination,food-drink,news,travel-ideas',
                'post_tag' => 'food,gear,resources,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:destination:id}}')
            )
        ),
        'the-ultimate-getaway-guide-to-ubud-everything-you-should-know' => array(
            'title' => "The Ultimate Getaway Guide to Ubud: Everything You Should Know",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel4',
            'taxonomy' => array(
                'category' => 'destination,photo,travel-ideas',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}')
            )
        ),
        'this-english-breakfast-pie-is-maybe-the-most-british-thing-ever' => array(
            'title' => "This English breakfast pie is maybe the most British thing ever",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel5',
            'taxonomy' => array(
                'category' => 'food-drink,news,photo,travel-ideas',
                'post_tag' => 'backpacker,food,gear,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food-drink:id}}')
            )
        ),
        '7-things-you-should-know-when-taking-a-taxi-in-seminyak' => array(
            'title' => "7 Things you should know when taking a Taxi in Seminyak",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel6',
            'taxonomy' => array(
                'category' => 'destination,photo,travel-ideas',
                'post_tag' => 'backpacker,gear,solo-travel,tips'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:destination:id}}')
            )
        ),
        'everything-you-need-to-know-about-solo-travel' => array(
            'title' => "Everything You Need to Know About Solo Travel",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel7',
            'taxonomy' => array(
                'category' => 'destination,news,travel-ideas',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}')
            )
        ),
        '10-things-you-didnt-know-about-being-solo-traveler-in-asia' => array(
            'title' => "10 things you didn't know about being solo traveler in Asia",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel8',
            'taxonomy' => array(
                'category' => 'destination,news,video',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:video:id}}')
            )
        ),
        'secret-escapes-curates-luxe-hotel-deals-online-causes-serious-wanderlust-offline' => array(
            'title' => "Secret Escapes curates luxe hotel deals online, causes serious wanderlust offline",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel9',
            'taxonomy' => array(
                'category' => 'destination,news,travel-ideas,video',
                'post_tag' => 'backpacker,food,gear,resources',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=UWPvuIGBEAQ',
                'jnews_single_post' => array(
                    'override_template' => '1',
                    'override' => array(
                        array(
                            'template' => '9',
                            'parallax' => '1',
                            'fullscreen' => '0',
                            'layout' => 'right-sidebar',
                            'sidebar' => 'default-sidebar',
                            'share_position' => 'bottom',
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
                            'show_prev_next_post' => '0',
                            'show_popup_post' => '1',
                            'show_author_box' => '1',
                            'show_post_related' => '1',
                        )
                    )
                )
            )
        ),
        'important-rules-to-surviving-a-climb-up-mount-agung-bali' => array(
            'title' => "Important Rules to Surviving a Climb up Mount Agung Bali",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel10',
            'taxonomy' => array(
                'category' => 'destination,photo,travel-ideas',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:destination:id}}')
            )
        ),
        'lunch-at-this-cosy-cafe-and-try-the-signature-drink-bali-coffee-experience' => array(
            'title' => "Lunch at this cosy cafe and try the signature drink: Bali Coffee experience",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel1',
            'taxonomy' => array(
                'category' => 'food-drink,news,photo,travel-ideas',
                'post_tag' => 'backpacker,food,gear,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food-drink:id}}')
            )
        ),
        'hostem-makes-travel-comfortable-with-a-portable-pillow-and-duvet-set' => array(
            'title' => "Hostem Makes Travel Comfortable With a Portable Pillow and Duvet Set",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel2',
            'taxonomy' => array(
                'category' => 'destination,news,travel-ideas',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}')
            )
        ),
        'where-to-go-in-2017-start-making-your-travel-plans-for-this-year' => array(
            'title' => "Where to go in 2017: Start making your travel plans for this year",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel3',
            'taxonomy' => array(
                'category' => 'destination,news,travel-ideas,video',
                'post_tag' => '',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=qjP4QdZK7tc',
                'jnews_single_post' => array(
                    'override_template' => '1',
                    'override' => array(
                        array(
                            'template' => '9',
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
                            'show_post_author_image' => '1',
                            'show_post_date' => '1',
                            'show_post_category' => '1',
                            'show_post_tag' => '1',
                            'show_prev_next_post' => '0',
                            'show_popup_post' => '1',
                            'show_author_box' => '1',
                            'show_post_related' => '1',
                        )
                    )
                )
            )
        ),
        '6-best-things-to-do-in-bali-must-do-must-see-must-eat' => array(
            'title' => "6 Best Things to Do in Bali – Must-Do, Must-See & Must-Eat",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel4',
            'taxonomy' => array(
                'category' => 'destination,news,travel-ideas',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}'),
                'post_subtitle' => 'Essential Bali travel tips for first-time visitors'
            )
        ),
        'get-to-know-balinise-cuisine-5-essential-foods' => array(
            'title' => "Get to know Balinise cuisine: 5 essential foods",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel5',
            'taxonomy' => array(
                'category' => 'food-drink,news,photo,travel-ideas,video',
                'post_tag' => 'backpacker,food,gear,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food-drink:id}}')
            )
        ),
        'late-night-restaurants-in-kuta-great-spots-that-open-past-midnight' => array(
            'title' => "Late night restaurants in Kuta: Great spots that open past midnight",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel6',
            'taxonomy' => array(
                'category' => 'food-drink,news,photo,travel-ideas',
                'post_tag' => 'backpacker,food,gear,solo-travel,tips,trip-plan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food-drink:id}}')
            )
        ),
        'circular-runways-could-revolutionize-how-planes-takeoff-and-land' => array(
            'title' => "Circular runways could revolutionize how planes takeoff and land",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel7',
            'taxonomy' => array(
                'category' => 'news,photo,video',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}')
            )
        ),
        'traveling-with-a-second-language-is-a-life-savior' => array(
            'title' => "Traveling with a second language is a life savior",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel8',
            'taxonomy' => array(
                'category' => 'destination,news,video',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:video:id}}')
            )
        ),
        'world-map-proves-basically-every-country-has-a-terrible-tourism-slogan' => array(
            'title' => "World map proves basically every country has a terrible tourism slogan",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel9',
            'taxonomy' => array(
                'category' => 'destination,news,travel-ideas',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}')
            )
        ),
        'is-japan-the-most-overrated-travel-destination-in-the-world' => array(
            'title' => "Is Japan the Most Overrated Travel Destination in the World?",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel10',
            'taxonomy' => array(
                'category' => 'destination,news,travel-ideas',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:destination:id}}')
            )
        ),
        'explorebatur-volcano-and-lake-batur-with-these-stunning-35mm-images' => array(
            'title' => "ExploreBatur Volcano and Lake Batur With These Stunning 35mm Images",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel1',
            'taxonomy' => array(
                'category' => 'destination,photo,travel-ideas',
                'post_tag' => '',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                '_format_gallery_images' => array(
                    '{{image:travel1:id}}',
                    '{{image:travel2:id}}',
                    '{{image:travel3:id}}',
                    '{{image:travel4:id}}',
                    '{{image:travel5:id}}',
                ),
                'jnews_primary_category' => array('id' => '{{category:travel-ideas:id}}'),
                'jnews_single_post' => array(
                    'override_template' => '1',
                    'override' => array(
                        array(
                            'template' => '7',
                            'parallax' => '1',
                            'fullscreen' => '0',
                            'layout' => 'right-sidebar',
                            'sidebar' => 'default-sidebar',
                            'share_position' => 'bottom',
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
                            'show_prev_next_post' => '0',
                            'show_popup_post' => '1',
                            'show_author_box' => '1',
                            'show_post_related' => '1',
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
                '_wpb_shortcodes_custom_css' => '.vc_custom_1492066458960{margin-top: -30px !important;}.vc_custom_1496890676325{margin-top: 30px !important;}.vc_custom_1492066358906{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1496892063515{margin-bottom: 15px !important;}.vc_custom_1496890040339{margin-bottom: 15px !important;}',
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1492066458960{margin-top: -30px !important;}.vc_custom_1496890676325{margin-top: 30px !important;}.vc_custom_1492066358906{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1496892063515{margin-bottom: 15px !important;}.vc_custom_1496890040339{margin-bottom: 15px !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1492145456225{margin-bottom: 40px !important;padding-top: 40px !important;background: #474044 url({{image:travel_bg:url:full}}) !important;}.vc_custom_1492145229079{margin-bottom: 0px !important;background-color: rgba(255,255,255,0.01) !important;*background-color: rgb(255,255,255) !important;}.vc_custom_1491901714227{margin-bottom: 0px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest News',
                    'second_title' => '',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '3',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'date_custom' => 'Y/m/d',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'sort_by' => 'latest'
                ),
                'jnews_video_cache' => array(
                    'qjP4QdZK7tc' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=qjP4QdZK7tc&t=6s',
                        'id' => 'qjP4QdZK7tc',
                        'title' => 'Wonderful Indonesia | Bali',
                        'thumbnail' => 'https://i.ytimg.com/vi/qjP4QdZK7tc/default.jpg',
                        'duration' => '00:03:22'
                    ),
                    'UWPvuIGBEAQ' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=UWPvuIGBEAQ',
                        'id' => 'UWPvuIGBEAQ',
                        'title' => '18 most popular tourist attractions in bali - Compilation',
                        'thumbnail' => 'https://i.ytimg.com/vi/UWPvuIGBEAQ/default.jpg',
                        'duration' => '00:11:28'
                    ),
                    'WhzMiQuL-Zk' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=WhzMiQuL-Zk',
                        'id' => 'WhzMiQuL-Zk',
                        'title' => 'Villa Kubu Seminyak Bali Official Video',
                        'thumbnail' => 'https://i.ytimg.com/vi/WhzMiQuL-Zk/default.jpg',
                        'duration' => '00:02:40'
                    ),
                    'gCaTo5OXD7o' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=gCaTo5OXD7o',
                        'id' => 'gCaTo5OXD7o',
                        'title' => 'Wonderful Indonesia: A Visual Journey through Banyuwangi',
                        'thumbnail' => 'https://i.ytimg.com/vi/gCaTo5OXD7o/default.jpg',
                        'duration' => '00:01:30'
                    ),
                    'OQlOlLY9y_g' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=OQlOlLY9y_g',
                        'id' => 'OQlOlLY9y_g',
                        'title' => 'Wander Your Way to Wonderful Indonesia!',
                        'thumbnail' => 'https://i.ytimg.com/vi/OQlOlLY9y_g/default.jpg',
                        'duration' => '00:03:37'
                    ),
                    'K78EPuUv9cI' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=K78EPuUv9cI',
                        'id' => 'K78EPuUv9cI',
                        'title' => 'Experience the Sensory Wonders of Indonesia 30s',
                        'thumbnail' => 'https://i.ytimg.com/vi/K78EPuUv9cI/default.jpg',
                        'duration' => '00:00:31'
                    )
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1492145456225{margin-bottom: 40px !important;padding-top: 40px !important;background: #474044 url({{image:travel_bg:url:full}}) !important;}.vc_custom_1492145229079{margin-bottom: 0px !important;background-color: rgba(255,255,255,0.01) !important;*background-color: rgb(255,255,255) !important;}.vc_custom_1491901714227{margin-bottom: 0px !important;}.jeg_overlay_slider{margin-bottom: 0px;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1492147185383{margin-bottom: -40px !important;background-image: url({{image:travel_bg:url:full}}) !important;}.vc_custom_1492146497755{margin-top: 20px !important;margin-bottom: 0px !important;background-color: rgba(255,255,255,0.01) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;*background-color: rgb(255,255,255) !important;}',
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1492147185383{margin-bottom: -40px !important;background-image: url({{image:travel_bg:url:full}}) !important;}.vc_custom_1492146497755{margin-top: 20px !important;margin-bottom: 0px !important;background-color: rgba(255,255,255,0.01) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;*background-color: rgb(255,255,255) !important;}.elementor_custom_62c3ebd{margin-bottom: -40px;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest News',
                    'second_title' => '',
                    'header_type' => 'heading_3',
                    'layout' => 'no-sidebar',
                    'sidebar' => 'home-4',
                    'module'    => '27',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'date_custom' => 'Y/m/d',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'sort_by' => 'latest'
                ),
                'jnews_video_cache' => array(
                    'qjP4QdZK7tc' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=qjP4QdZK7tc&t=6s',
                        'id' => 'qjP4QdZK7tc',
                        'title' => 'Wonderful Indonesia | Bali',
                        'thumbnail' => 'https://i.ytimg.com/vi/qjP4QdZK7tc/default.jpg',
                        'duration' => '00:03:22'
                    ),
                    'UWPvuIGBEAQ' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=UWPvuIGBEAQ',
                        'id' => 'UWPvuIGBEAQ',
                        'title' => '18 most popular tourist attractions in bali - Compilation',
                        'thumbnail' => 'https://i.ytimg.com/vi/UWPvuIGBEAQ/default.jpg',
                        'duration' => '00:11:28'
                    ),
                    'WhzMiQuL-Zk' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=WhzMiQuL-Zk',
                        'id' => 'WhzMiQuL-Zk',
                        'title' => 'Villa Kubu Seminyak Bali Official Video',
                        'thumbnail' => 'https://i.ytimg.com/vi/WhzMiQuL-Zk/default.jpg',
                        'duration' => '00:02:40'
                    ),
                    'gCaTo5OXD7o' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=gCaTo5OXD7o',
                        'id' => 'gCaTo5OXD7o',
                        'title' => 'Wonderful Indonesia: A Visual Journey through Banyuwangi',
                        'thumbnail' => 'https://i.ytimg.com/vi/gCaTo5OXD7o/default.jpg',
                        'duration' => '00:01:30'
                    ),
                    'OQlOlLY9y_g' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=OQlOlLY9y_g',
                        'id' => 'OQlOlLY9y_g',
                        'title' => 'Wander Your Way to Wonderful Indonesia!',
                        'thumbnail' => 'https://i.ytimg.com/vi/OQlOlLY9y_g/default.jpg',
                        'duration' => '00:03:37'
                    ),
                    'K78EPuUv9cI' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=K78EPuUv9cI',
                        'id' => 'K78EPuUv9cI',
                        'title' => 'Experience the Sensory Wonders of Indonesia 30s',
                        'thumbnail' => 'https://i.ytimg.com/vi/K78EPuUv9cI/default.jpg',
                        'duration' => '00:00:31'
                    )
                ),
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest News',
                    'second_title' => '',
                    'header_type' => 'heading_7',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '12',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'date_custom' => 'Y/m/d',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'exclude_post' => '{{post:your-guide-to-canggus-hottest-street-the-essential-batu-bolong:id}},{{post:6-perfect-places-to-watch-the-sunrise-in-bali-while-you-honeymoon:id}},{{post:10-summer-safety-tips-for-water-sports-adventurers:id}}',
                    'sort_by' => 'latest'
                ),
                '_wpb_shortcodes_custom_css' => '.vc_custom_1492148194688{margin-top: -30px !important;}.vc_custom_1492148178007{padding-right: 0px !important;padding-left: 0px !important;}',
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1492148194688{margin-top: -30px !important;}.vc_custom_1492148178007{padding-right: 0px !important;padding-left: 0px !important;}'
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
                    'share_position' => 'hide'
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
        'top-navigation' => array(
            'title' => 'Top Navigation',
            'location' => 'top_navigation'
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
        'travel-news' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Travel News',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:news:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_2',
                    'category' => '{{category:news:id}}',
                    'number' => 6,
                    'trending_tag' => '{{taxonomy:post_tag:backpacker:id}},{{taxonomy:post_tag:gear:id}},{{taxonomy:post_tag:resources:id}},{{taxonomy:post_tag:solo-travel:id}},{{taxonomy:post_tag:tips:id}},{{taxonomy:post_tag:trip-plan:id}},{{taxonomy:post_tag:food:id}}',
                ),
            )
        ),
        'destination' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Destination',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:destination:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:destination:id}}',
                    'number' => 6
                ),
            )
        ),
        'travel-ideas' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Travel Ideas',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:travel-ideas:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:travel-ideas:id}}',
                    'number' => 6
                ),
            )
        ),
        'food-drink' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Food & Drink',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:food-drink:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:food-drink:id}}',
                    'number' => 6
                ),
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

        // footer menu
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
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:contact:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        // top menu
        'shop' => array(
            'location' => 'top-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Shop',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'account' => array(
            'location' => 'top-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'My Account',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
            'cart' => array(
                'location' => 'top-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Cart',
                    'menu-item-parent-id' => '{{menu:account:id}}',
                    'menu-item-type' => 'custom',
                    'menu-item-url' => '#',
                    'menu-item-status' => 'publish'
                )
            ),
            'checkout' => array(
                'location' => 'top-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Checkout',
                    'menu-item-parent-id' => '{{menu:account:id}}',
                    'menu-item-type' => 'custom',
                    'menu-item-url' => '#',
                    'menu-item-status' => 'publish'
                )
            ),
        'contact-1' => array(
            'location' => 'top-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Contact Us',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:contact:id}}',
                'menu-item-status' => 'publish'
            )
        )
    ),

    'widget_position' => array(
        'Home',
        'Home 3',
        'Contact',
        'Shop'
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
        'jnews-instagram',
        'jnews-jsonld',
        'jnews-like',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'jnews-weather',
        'mailchimp-for-wp'
    )

);