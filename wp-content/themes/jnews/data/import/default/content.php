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
        'news11' => 'http://jegtheme.com/asset/jnews/demo/default/news11.jpg',
        'news12' => 'http://jegtheme.com/asset/jnews/demo/default/news12.jpg',
        'sport1' => 'http://jegtheme.com/asset/jnews/demo/default/sport1.jpg',
        'sport2' => 'http://jegtheme.com/asset/jnews/demo/default/sport2.jpg',
        'sport3' => 'http://jegtheme.com/asset/jnews/demo/default/sport3.jpg',
        'tech1' => 'http://jegtheme.com/asset/jnews/demo/default/tech1.jpg',
        'tech2' => 'http://jegtheme.com/asset/jnews/demo/default/tech2.jpg',
        'tech3' => 'http://jegtheme.com/asset/jnews/demo/default/tech3.jpg',
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
        'aside' => 'http://jegtheme.com/asset/jnews/demo/default/aside.jpg',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'footer_logo' => 'http://jegtheme.com/asset/jnews/demo/default/footer_logo.png',
        'footer_logo2x' => 'http://jegtheme.com/asset/jnews/demo/default/footer_logo@2x.png',
        'sticky_logo' => 'http://jegtheme.com/asset/jnews/demo/default/sticky_logo.png',
        'sticky_logo2x' => 'http://jegtheme.com/asset/jnews/demo/default/sticky_logo@2x.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'news' =>
                array(
                    'title' =>'News',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
                ),
                'business' =>
                    array(
                        'title' => 'Business',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'news'
                    ),
                'politics' =>
                    array(
                        'title' =>'Politics',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'news'
                    ),
                'science' =>
                    array(
                        'title' => 'Science',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'news'
                    ),
                'world' =>
                    array(
                        'title' => 'World',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'news'
                    ),

            'lifestyle' =>
                array(
                    'title' => 'Lifestyle',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
                ),
                'fashion' =>
                    array(
                        'title' =>'Fashion',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'lifestyle'
                    ),
                'travel' =>
                    array(
                        'title' =>'Travel',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'lifestyle'
                    ),
                'food' =>
                    array(
                        'title' =>'Food',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'lifestyle'
                    ),
                'health' =>
                    array(
                        'title' =>'Health',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'lifestyle'
                    ),

            'tech' =>
                array(
                    'title' => 'Tech',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
                ),
                'apps' =>
                    array(
                        'title' =>'Apps',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'tech'
                    ),
                'gadget' =>
                    array(
                        'title' =>'Gadget',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'tech'
                    ),
                'mobile' =>
                    array(
                        'title' =>'Mobile',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'tech'
                    ),
                'startup' =>
                    array(
                        'title' =>'Startup',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'tech'
                    ),

            'entertainment' =>
                array(
                    'title' => 'Entertainment',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
                ),
                'gaming' =>
                    array(
                        'title' =>'Gaming',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'entertainment'
                    ),
                'movie' =>
                    array(
                        'title' =>'Movie',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'entertainment'
                    ),
                'music' =>
                    array(
                        'title' =>'Music',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'entertainment'
                    ),
                'sports' =>
                    array(
                        'title' =>'Sports',
                        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                        'parent' => 'entertainment'
                    ),
            'review' =>
                array(
                    'title' => 'Review',
                    'description' => 'We brings you detailed expert reviews and ratins of the latest consumer electronics, tech products, along with specs, user reviews, prices and more.'
                ),
        ),
        'post_tag' => array(
                'trump-inauguration' => array(
                'title' => 'Trump Inauguration'
            ),
            'united-stated' => array(
                'title' => 'United Stated',
            ),
            'election-results' => array(
                'title' => 'Election Results',
            ),
            'white-house' => array(
                'title' => 'White House',
            ),
            'market-stories' => array(
                'title' => 'Market Stories',
            ),

            'fashion-week' => array(
                'title' => 'Fashion Week'
            ),
            'golden-globes' => array(
                'title' => 'Golden Globes'
            ),
            'game-of-thrones' => array(
                'title' => 'Game of Thrones'
            ),
            'motogp-2017' => array(
                'title' => 'MotoGP 2017'
            ),
            'esports' => array(
                'title' => 'eSports'
            ),

            'ces-2017' => array(
                'title' => 'CES 2017'
            ),
            'nintendo-switch' => array(
                'title' => 'Nintendo Switch'
            ),
            'mark-zuckerberg' => array(
                'title' => 'Mark Zuckerberg'
            ),
            'sillicon-valley' => array(
                'title' => 'Sillicon Valley'
            ),
            'ps4-pro' => array(
                'title' => 'Playstation 4 Pro'
            )
        )
    ),

    // post & page
    'post' => array(
        'the-legend-of-zelda-breath-of-the-wild-gameplay-on-the-nintendo-switch' => array(
            'title' => 'The Legend of Zelda: Breath of the Wild gameplay on the Nintendo Switch',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel6',
            'taxonomy' => array(
                'category' => 'review,gadget,mobile,startup,music',
                'post_tag' => 'trump-inauguration,white-house,market-stories,game-of-thrones,motogp-2017,mark-zuckerberg',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'The Legend of Zelda',
                    'good' => array(
                            array('good_text' => 'Good low light camera'),
                            array('good_text' => 'Water resistant'),
                            array('good_text' => 'Double the internal capacity')
                    ),
                    'bad' => array(
                        array('bad_text' => 'Lacks clear upgrades'),
                        array('bad_text' => 'Same design used for last three phones'),
                        array('bad_text' => 'Battery life unimpressive')
                    ),
                    'rating' => array(
                        array('rating_text' => 'Design','rating_number' => '9'),
                        array('rating_text' => 'Performance','rating_number' => '8'),
                        array('rating_text' => 'Camera','rating_number' => '9'),
                        array('rating_text' => 'Battery','rating_number' => '7'),
                        array('rating_text' => 'Price','rating_number' => '8')
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.',
                    'type' => 'point',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'shadow-tactics-blades-of-the-shogun-review' => array(
            'title' => 'Shadow Tactics: Blades of the Shogun Review',
            'content' => 'post-review.txt',
            'post_type' => 'post',
            'featured_image' => 'travel3',
            'taxonomy' => array(
                'category' => 'review,apps,gadget,mobile',
                'post_tag' => 'market-stories,election-results,white-house,fashion-week,motogp-2017,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gaming:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Shadow Tactics: Blades of the Shogun',
                    'good' => array(
                            array('good_text' => 'Good low light camera'),
                            array('good_text' => 'Water resistant'),
                            array('good_text' => 'Double the internal capacity')
                    ),
                    'bad' => array(
                        array('bad_text' => 'Lacks clear upgrades'),
                        array('bad_text' => 'Same design used for last three phones'),
                        array('bad_text' => 'Battery life unimpressive')
                    ),
                    'rating' => array(
                        array('rating_text' => 'Design','rating_number' => '9'),
                        array('rating_text' => 'Performance','rating_number' => '8'),
                        array('rating_text' => 'Camera','rating_number' => '9'),
                        array('rating_text' => 'Battery','rating_number' => '7'),
                        array('rating_text' => 'Price','rating_number' => '8')
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.',
                    'type' => 'star',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'macos-sierra-review-mac-users-get-a-modest-update-this-year' => array(
            'title' => 'macOS Sierra review: Mac users get a modest update this year',
            'content' => 'post-review.txt',
            'post_type' => 'post',
            'featured_image' => 'travel4',
            'taxonomy' => array(
                'category' => 'review,gadget,gaming,mobile',
                'post_tag' => 'trump-inauguration,united-stated,election-results,golden-globes,mark-zuckerberg,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:review:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'macOS Sierra',
                    'good' => array(
                            array('good_text' => 'Good low light camera'),
                            array('good_text' => 'Water resistant'),
                            array('good_text' => 'Double the internal capacity')
                    ),
                    'bad' => array(
                        array('bad_text' => 'Lacks clear upgrades'),
                        array('bad_text' => 'Same design used for last three phones'),
                        array('bad_text' => 'Battery life unimpressive')
                    ),
                    'rating' => array(
                        array('rating_text' => 'Design','rating_number' => '9'),
                        array('rating_text' => 'Performance','rating_number' => '8'),
                        array('rating_text' => 'Camera','rating_number' => '9'),
                        array('rating_text' => 'Battery','rating_number' => '7'),
                        array('rating_text' => 'Price','rating_number' => '8')
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'hands-on-samsung-galaxy-a5-2017-review' => array(
            'title' => 'Hands on: Samsung Galaxy A5 2017 review',
            'content' => 'post-review.txt',
            'post_type' => 'post',
            'featured_image' => 'tech2',
            'taxonomy' => array(
                'category' => 'review,gadget,mobile,gaming',
                'post_tag' => 'united-stated,white-house,market-stories,motogp-2017,ces-2017,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Samsung Galaxy A5 2017',
                    'good' => array(
                        array('good_text' => 'Good low light camera'),
                        array('good_text' => 'Water resistant'),
                        array('good_text' => 'Double the internal capacity')
                    ),
                    'bad' => array(
                        array('bad_text' => 'Lacks clear upgrades'),
                        array('bad_text' => 'Same design used for last three phones'),
                        array('bad_text' => 'Battery life unimpressive')
                    ),
                    'rating' => array(
                        array('rating_text' => 'Design','rating_number' => '9'),
                        array('rating_text' => 'Performance','rating_number' => '8'),
                        array('rating_text' => 'Camera','rating_number' => '9'),
                        array('rating_text' => 'Battery','rating_number' => '7'),
                        array('rating_text' => 'Price','rating_number' => '8')
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.',
                    'type' => 'point',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'the-last-guardian-playstation-4-game-review' => array(
            'title' => 'The Last Guardian Playstation 4 Game review',
            'content' => 'post-review.txt',
            'post_type' => 'post',
            'featured_image' => 'travel5',
            'taxonomy' => array(
                'category' => 'review,apps,gadget,mobile,startup',
                'post_tag' => 'united-stated,election-results,white-house,market-stories,motogp-2017,ces-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:apps:id}}'),
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'The Last Guardian',
                    'good' => array(
                        array('good_text' => 'Good low light camera'),
                        array('good_text' => 'Water resistant'),
                        array('good_text' => 'Double the internal capacity')
                    ),
                    'bad' => array(
                        array('bad_text' => 'Lacks clear upgrades'),
                        array('bad_text' => 'Same design used for last three phones'),
                        array('bad_text' => 'Battery life unimpressive')
                    ),
                    'rating' => array(
                        array('rating_text' => 'Design','rating_number' => '9'),
                        array('rating_text' => 'Performance','rating_number' => '8'),
                        array('rating_text' => 'Camera','rating_number' => '9'),
                        array('rating_text' => 'Battery','rating_number' => '7'),
                        array('rating_text' => 'Price','rating_number' => '8')
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),

        'hillary-clinton-in-white-pantsuit-for-trump-inauguration' => array(
            'title' => 'Hillary Clinton in white pantsuit for Trump inauguration',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'news, politics, business, world',
                'post_tag' => 'trump-inauguration, united-stated, election-results, ces-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'amazon-has-143-billion-reasons-to-keep-adding-more-perks-to-prime' => array(
            'title' => 'Amazon has 143 billion reasons to keep adding more perks to Prime',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news2',
            'taxonomy' => array(
                'category' => 'news, politics, science, business, world',
                'post_tag' => 'trump-inauguration, united-stated, election-results, ces-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'shooting-more-than-40-years-of-new-yorks-halloween-parade' => array(
            'title' => 'Shooting More than 40 Years of New York\'s Halloween Parade',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news3',
            'taxonomy' => array(
                'category' => 'travel, lifestyle, world, fashion',
                'post_tag' => 'trump-inauguration, united-stated, election-results, ces-2017, motogp-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:world:id}}')
            )
        ),
        'these-are-the-5-big-tech-stories-to-watch-in-2017' => array(
            'title' => 'These Are the 5 Big Tech Stories to Watch in 2017',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news4',
            'taxonomy' => array(
                'category' => 'tech, apps, gadget, startup, business',
                'post_tag' => 'fashion-week, golden-globes, motogp-2017, ps4-pro, ces-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:startup:id}}'),
                'post_subtitle' => 'Make no mistake, the tech giants are still the kings.'
            )
        ),
        'heroes-of-the-storm-global-championship-2017-starts-tomorrow-heres-what-you-need-to-know' => array(
            'title' => 'Heroes of the Storm Global Championship 2017 starts tomorrow, here\'s what you need to know',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news5',
            'taxonomy' => array(
                'category' => 'fashion,mobile,gaming,movie',
                'post_tag' => 'trump-inauguration,market-stories,white-house,fashion-week,esports,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'why-millennials-need-to-save-twice-as-much-as-boomers-did' => array(
            'title' => 'Why Millennials Need to Save Twice as Much as Boomers Did',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news6',
            'taxonomy' => array(
                'category' => 'business, travel, lifestyle, world, fashion',
                'post_tag' => 'fashion-week, golden-globes, motogp-2017, ps4-pro, ces-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'doctors-take-inspiration-from-online-dating-to-build-organ-transplant-ai' => array(
            'title' => 'Doctors take inspiration from online dating to build organ transplant AI',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news7',
            'taxonomy' => array(
                'category' => 'health, lifestyle, world, fashion, news',
                'post_tag' => 'fashion-week, golden-globes, game-of-thrones, ces-2017, motogp-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'how-couples-can-solve-lighting-disagreements-for-good' => array(
            'title' => 'How couples can solve lighting disagreements for good',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news8',
            'taxonomy' => array(
                'category' => 'science, health, lifestyle, world, fashion, news',
                'post_tag' => 'fashion-week, golden-globes, game-of-thrones, ces-2017, motogp-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:science:id}}')
            )
        ),
        'ducati-launch-lorenzo-and-doviziosos-desmosedici' => array(
            'title' => 'Ducati launch: Lorenzo and Dovizioso\'s Desmosedici',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news9',
            'taxonomy' => array(
                'category' => 'business,fashion,travel,gadget',
                'post_tag' => 'election-results,fashion-week,motogp-2017,esports,ces-2017,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        '23-celebrity-tweets-you-missed-from-the-golden-globes' => array(
            'title' => '23 Celebrity Tweets You Missed From The Golden Globes',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news10',
            'taxonomy' => array(
                'category' => 'business,science,food,startup',
                'post_tag' => 'united-stated,election-results,fashion-week,game-of-thrones,ces-2017,mark-zuckerberg',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'harnessing-the-power-of-vr-with-power-rangers-and-snapdragon-835' => array(
            'title' => 'Harnessing the power of VR with Power Rangers and Snapdragon 835',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news11',
            'taxonomy' => array(
                'category' => 'science,apps,gaming,sports',
                'post_tag' => 'united-stated,market-stories,game-of-thrones,esports,mark-zuckerberg,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:science:id}}')
            )
        ),
        'so-you-want-to-be-a-startup-investor-here-are-things-you-should-know' => array(
            'title' => 'So you want to be a startup investor? Here are things you should know',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news12',
            'taxonomy' => array(
                'category' => 'politics,world,fashion,music',
                'post_tag' => 'united-stated,white-house,market-stories,game-of-thrones,mark-zuckerberg,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}')
            )
        ),
        'dota-2-and-csgo-top-steams-2016-list-for-most-played-games' => array(
            'title' => 'Dota 2 and CS:GO top Steam\'s 2016 list for most played games',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport1',
            'taxonomy' => array(
                'category' => 'politics,gaming,movie,sports',
                'post_tag' => 'white-house,golden-globes,game-of-thrones,motogp-2017,mark-zuckerberg,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'vinales-will-be-as-tough-for-rossi-as-lorenzo-suzuki-motogp-boss' => array(
            'title' => 'Vinales will be as tough for Rossi as Lorenzo - Suzuki MotoGP boss',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport2',
            'taxonomy' => array(
                'category' => 'science,world,travel,sports',
                'post_tag' => 'election-results,white-house,fashion-week,esports,sillicon-valley,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:science:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'motogp-makes-tyre-strategies-easier-to-follow-for-2017' => array(
            'title' => 'MotoGP makes tyre strategies easier to follow for 2017',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport3',
            'taxonomy' => array(
                'category' => 'politics,travel,health,mobile',
                'post_tag' => 'trump-inauguration,market-stories,game-of-thrones,motogp-2017,esports,mark-zuckerberg,ps4-pro',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=BtVtYSm3bJY'
            )
        ),
        'president-obama-holds-his-final-press-conference' => array(
            'title' => 'President Obama Holds his Final Press Conference',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'tech1',
            'taxonomy' => array(
                'category' => 'health,gadget,gaming,sports',
                'post_tag' => 'trump-inauguration,white-house,golden-globes,ces-2017,sillicon-valley,ps4-pro',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=1OaWeQ6Sw1Y'
            )
        ),
        'gfinity-launching-competitive-league-for-teams-to-draft-amateur-players' => array(
            'title' => 'Gfinity launching competitive league for teams to draft amateur players',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'tech2',
            'taxonomy' => array(
                'category' => 'business,science,food,gaming',
                'post_tag' => 'market-stories,election-results,white-house,fashion-week,ces-2017,mark-zuckerberg',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'nintendo-switch-ui-gets-new-close-up-in-deleted-tweet' => array(
            'title' => 'Nintendo Switch UI gets new close-up in deleted tweet',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'tech3',
            'taxonomy' => array(
                'category' => 'fashion,travel,food,startup',
                'post_tag' => 'trump-inauguration,white-house,golden-globes,motogp-2017,ces-2017,mark-zuckerberg',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'heres-some-of-the-best-sneakers-on-display-at-london-fashion-week' => array(
            'title' => 'Here\'s Some of the Best Sneakers on Display at London Fashion Week',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion1',
            'taxonomy' => array(
                'category' => 'fashion, travel, lifestyle, health, mobile',
                'post_tag' => 'fashion-week, golden-globes, motogp-2017, ps4-pro, ces-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
            )
        ),
        'official-who-molested-woman-didnt-have-to-be-politically-correct' => array(
            'title' => 'Official Who Molested Woman Didn\'t Have to Be Politically Correct',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion2',
            'taxonomy' => array(
                'category' => 'travel,gadget,mobile,startup',
                'post_tag' => 'united-stated,election-results,white-house,motogp-2017,sillicon-valley,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'how-this-nigerian-woman-went-from-aspiring-developer-to-meeting-mark-zuckerberg' => array(
            'title' => 'How this Nigerian woman went from aspiring developer to meeting Mark Zuckerberg',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion3',
            'taxonomy' => array(
                'category' => 'health,gadget,music,sports',
                'post_tag' => 'trump-inauguration,election-results,game-of-thrones,motogp-2017,mark-zuckerberg,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'celebrity-foodies-see-what-the-stars-are-snacking-on-today' => array(
            'title' => 'Celebrity Foodies: See What the Stars Are Snacking on Today',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion4',
            'taxonomy' => array(
                'category' => 'business,apps,movie,sports',
                'post_tag' => 'united-stated,fashion-week,market-stories,esports,mark-zuckerberg,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}')
            )
        ),
        'jimmy-fallons-8-best-hosting-moments-of-all-time' => array(
            'title' => 'Jimmy Fallon\'s 8 Best Hosting Moments of All Time',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion5',
            'taxonomy' => array(
                'category' => 'business,fashion,health,gadget',
                'post_tag' => 'white-house,market-stories,esports,nintendo-switch,mark-zuckerberg,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'british-model-issues-lengthy-sincere-apology-for-cultural-appropriation' => array(
            'title' => 'British model issues lengthy, sincere apology for cultural appropriation',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion6',
            'taxonomy' => array(
                'category' => 'politics,fashion,gadget,music',
                'post_tag' => 'market-stories,golden-globes,game-of-thrones,esports,mark-zuckerberg,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'is-japan-the-most-overrated-travel-destination-in-the-world' => array(
            'title' => 'Is Japan the Most Overrated Travel Destination in the World?',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel1',
            'taxonomy' => array(
                'category' => 'travel, lifestyle, world, business',
                'post_tag' => 'fashion-week, golden-globes, mark-zuckerberg, game-of-thrones, ces-2017',
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
                'jnews_primary_category' => array('id' => '{{category:travel:id}}')
            )
        ),
        'explore-moroccos-desert-and-seaside-with-these-stunning-35mm-images' => array(
            'title' => 'Explore Morocco\'s Desert and Seaside With These Stunning 35mm Images',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel2',
            'taxonomy' => array(
                'category' => 'travel, lifestyle, world, fashion',
                'post_tag' => 'fashion-week, golden-globes, motogp-2017, game-of-thrones, ces-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}')
            )
        ),
        'sony-shares-a-list-of-39-titles-that-will-be-optimized-for-the-ps4-pro-at-launch' => array(
            'title' => 'Sony shares a list of 39 titles that will be optimized for the PS4 Pro at launch',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel3',
            'taxonomy' => array(
                'category' => 'fashion,travel,health,mobile',
                'post_tag' => 'trump-inauguration,united-stated,election-results,ces-2017,nintendo-switch,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'yamaha-2017-motogp-bike-launched-with-rossi-and-vinales' => array(
            'title' => 'Yamaha 2017 MotoGP bike launched with Rossi and Vinales',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel4',
            'taxonomy' => array(
                'category' => 'gadget,mobile,movie,music',
                'post_tag' => 'market-stories,white-house,golden-globes,game-of-thrones,nintendo-switch,mark-zuckerberg',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'the-heart-of-nintendos-new-console-isnt-the-switch' => array(
            'title' => 'The heart of Nintendo\'s new console isn\'t the Switch',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel5',
            'taxonomy' => array(
                'category' => 'health,mobile,gaming,music',
                'post_tag' => 'white-house,fashion-week,golden-globes,game-of-thrones,motogp-2017,mark-zuckerberg',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=gGhK7e3VbEk'
            )
        ),
        '12-things-you-didnt-see-during-the-2017-golden-globes' => array(
            'title' => '12 Things You Didn\'t See During The 2017 Golden Globes',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel6',
            'taxonomy' => array(
                'category' => 'travel,food,health,gadget',
                'post_tag' => 'united-stated,fashion-week,esports,nintendo-switch,mark-zuckerberg,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'this-chinese-province-says-it-faked-fiscal-data-for-several-years' => array(
            'title' => 'This Chinese Province Says It Faked Fiscal Data for Several Years',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'politics,gadget,startup,music',
                'post_tag' => 'election-results,motogp-2017,esports,ces-2017,nintendo-switch,mark-zuckerberg',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'dota-pit-season-5-finals-preview-secret-vp-have-something-to-prove' => array(
            'title' => 'Dota Pit Season 5 finals preview: Secret, VP have something to prove',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news2',
            'taxonomy' => array(
                'category' => 'politics,world,food,health',
                'post_tag' => 'golden-globes,esports,ces-2017,nintendo-switch,mark-zuckerberg,ps4-pro',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=pEg_y9Fdj3k'
            )
        ),
        'intel-core-i7-7700k-kaby-lake-review' => array(
            'title' => 'Intel Core i7-7700K \'Kaby Lake\' review',
            'content' => 'post-review.txt',
            'post_type' => 'post',
            'featured_image' => 'news3',
            'taxonomy' => array(
                'category' => 'review,mobile,gaming,gadget',
                'post_tag' => 'united-stated,election-results,golden-globes,motogp-2017,nintendo-switch,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:mobile:id}}'),
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Intel Core i7-7700K',
                    'good' => array(
                            array('good_text' => 'Good low light camera'),
                            array('good_text' => 'Water resistant'),
                            array('good_text' => 'Double the internal capacity')
                    ),
                    'bad' => array(
                        array('bad_text' => 'Lacks clear upgrades'),
                        array('bad_text' => 'Same design used for last three phones'),
                        array('bad_text' => 'Battery life unimpressive')
                    ),
                    'rating' => array(
                        array('rating_text' => 'Design','rating_number' => '9'),
                        array('rating_text' => 'Performance','rating_number' => '8'),
                        array('rating_text' => 'Camera','rating_number' => '9'),
                        array('rating_text' => 'Battery','rating_number' => '7'),
                        array('rating_text' => 'Price','rating_number' => '8')
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.',
                    'type' => 'point',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'hands-on-apple-iphone-7-review' => array(
            'title' => 'Hands on: Apple iPhone 7 review',
            'content' => 'post-review.txt',
            'post_type' => 'post',
            'featured_image' => 'news4',
            'taxonomy' => array(
                'category' => 'review,startup,gaming,gadget',
                'post_tag' => 'trump-inauguration,motogp-2017,esports,ces-2017,nintendo-switch,mark-zuckerberg',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple iPhone 9',
                    'good' => array(
                            array('good_text' => 'Good low light camera'),
                            array('good_text' => 'Water resistant'),
                            array('good_text' => 'Double the internal capacity')
                    ),
                    'bad' => array(
                        array('bad_text' => 'Lacks clear upgrades'),
                        array('bad_text' => 'Same design used for last three phones'),
                        array('bad_text' => 'Battery life unimpressive')
                    ),
                    'rating' => array(
                        array('rating_text' => 'Design','rating_number' => '9'),
                        array('rating_text' => 'Performance','rating_number' => '8'),
                        array('rating_text' => 'Camera','rating_number' => '9'),
                        array('rating_text' => 'Battery','rating_number' => '7'),
                        array('rating_text' => 'Price','rating_number' => '8')
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.',
                    'type' => 'point',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'retirees-it-may-be-time-to-get-your-head-out-of-the-sand' => array(
            'title' => 'Retirees, It May Be Time To Get Your Head Out Of The Sand',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news5',
            'taxonomy' => array(
                'category' => 'business, travel, lifestyle, world, fashion',
                'post_tag' => 'fashion-week, golden-globes, motogp-2017, ps4-pro, ces-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'obama-takes-jerry-seinfeld-for-a-drive-around-the-white-house' => array(
            'title' => 'Obama Takes Jerry Seinfeld for a Drive Around the White House',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news6',
            'taxonomy' => array(
                'category' => 'news, politics, science, business, world',
                'post_tag' => 'united-stated, election-results, ces-2017, mark-zuckerberg, fashion-week',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'these-delicious-balinese-street-foods-you-need-to-try-right-now' => array(
            'title' => 'These delicious Balinese street foods you need to try right now',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news7',
            'taxonomy' => array(
                'category' => 'business,politics,food,gaming',
                'post_tag' => 'market-stories,election-results,white-house,fashion-week,esports,nintendo-switch',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'snapchat-ex-employee-claims-company-faked-growth-stats-to-boost-value' => array(
            'title' => 'Snapchat ex-employee claims company faked growth stats to boost value',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news8',
            'taxonomy' => array(
                'category' => 'politics,world,travel,startup',
                'post_tag' => 'trump-inauguration,motogp-2017,esports,nintendo-switch,sillicon-valley,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'heres-how-we-built-our-company-culture-without-going-broke' => array(
            'title' => 'Here\'s how we built our company culture without going broke',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news9',
            'taxonomy' => array(
                'category' => 'apps,gadget,startup,movie',
                'post_tag' => 'trump-inauguration,united-stated,election-results,fashion-week,golden-globes,esports',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:apps:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'valentino-rossi-maverick-vinales-can-fight-for-title-with-yamaha' => array(
            'title' => 'Valentino Rossi: Maverick Vinales can fight for title with Yamaha',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news10',
            'taxonomy' => array(
                'category' => 'business,gadget,movie,sports',
                'post_tag' => 'united-stated,market-stories,white-house,golden-globes,esports,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'donald-trump-is-sworn-in-as-president-capping-his-swift-ascent' => array(
            'title' => 'Donald Trump Is Sworn In as President, Capping His Swift Ascent',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news11',
            'taxonomy' => array(
                'category' => 'politics,science,travel,gaming',
                'post_tag' => 'white-house,golden-globes,market-stories,trump-inauguration,nintendo-switch,mark-zuckerberg,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'the-wikileaks-emails-show-how-a-clinton-white-house-might-operate' => array(
            'title' => 'The WikiLeaks Emails Show How a Clinton White House Might Operate',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news12',
            'taxonomy' => array(
                'category' => 'politics,fashion,food,apps',
                'post_tag' => 'united-stated,election-results,fashion-week,esports,nintendo-switch,mark-zuckerberg',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'ducati-has-all-the-cards-to-win-2017-motogp-title-says-ceo' => array(
            'title' => 'Ducati has all the cards\' to win 2017 MotoGP title, says CEO',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport1',
            'taxonomy' => array(
                'category' => 'politics,food,apps,sports',
                'post_tag' => 'market-stories,motogp-2017,esports,ces-2017,mark-zuckerberg,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'suzuki-unveils-its-entry-level-2017-gsx-r125-sportbike' => array(
            'title' => 'Suzuki Unveils Its Entry-Level 2017 GSX-R125 Sportbike',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport2',
            'taxonomy' => array(
                'category' => 'politics,science,health,movie',
                'post_tag' => 'united-stated,white-house,esports,nintendo-switch,mark-zuckerberg,ps4-pro',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=wF7cUPwbQMk'
            )
        ),
        'jorge-lorenzo-wont-change-riding-style-for-ducati-motogp-bike' => array(
            'title' => 'Jorge Lorenzo won\'t change riding style for Ducati MotoGP bike',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport3',
            'taxonomy' => array(
                'category' => 'business,science,startup,music',
                'post_tag' => 'market-stories,white-house,golden-globes,ces-2017,nintendo-switch,mark-zuckerberg',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'mark-zuckerberg-promises-to-travel-the-entire-united-states-in-2017' => array(
            'title' => 'Mark Zuckerberg promises to travel the entire United States in 2017',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'tech1',
            'taxonomy' => array(
                'category' => 'food,mobile,startup,sports',
                'post_tag' => 'trump-inauguration,golden-globes,game-of-thrones,motogp-2017,ces-2017,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'evil-geniues-team-liquid-and-alliance-have-finalized-their-dota-2-rosters' => array(
            'title' => 'Evil Geniues, Team Liquid, and Alliance have finalized their Dota 2 rosters',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'tech3',
            'taxonomy' => array(
                'category' => 'travel,apps,startup,sports',
                'post_tag' => 'market-stories,white-house,fashion-week,golden-globes,motogp-2017,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'hostem-makes-travel-comfortable-with-a-portable-pillow-and-duvet-set' => array(
            'title' => 'Hostem Makes Travel Comfortable With a Portable Pillow and Duvet Set',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'tech2',
            'taxonomy' => array(
                'category' => 'politics,health,startup,sports',
                'post_tag' => 'election-results,golden-globes,esports,nintendo-switch,sillicon-valley,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'here-are-6-brands-and-designers-to-look-out-for-next-year' => array(
            'title' => 'Here Are 6 Brands and Designers to Look Out for Next Year',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion1',
            'taxonomy' => array(
                'category' => 'travel,gadget,mobile,startup',
                'post_tag' => 'united-stated,white-house,market-stories,fashion-week,mark-zuckerberg,sillicon-valley',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                '_format_gallery_images' => array(
                    '{{image:fashion1:id}}',
                    '{{image:fashion5:id}}',
                    '{{image:fashion4:id}}',
                    '{{image:fashion2:id}}',
                    '{{image:fashion3:id}}',
                ),
                'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'you-have-to-watch-mariah-careys-new-years-eve-nightmare-in-times-square' => array(
            'title' => 'You Have To Watch Mariah Carey\'s New Year\'s Eve Nightmare in Times Square',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion2',
            'taxonomy' => array(
                'category' => 'travel,gaming,music,sports',
                'post_tag' => 'united-stated,market-stories,fashion-week,esports,nintendo-switch,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'smooth-talking-hacker-remote-wipes-reporters-ipad-macbook' => array(
            'title' => 'Smooth-Talking Hacker Remote-Wipes Reporter\'s iPad, MacBook',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion3',
            'taxonomy' => array(
                'category' => 'business,fashion,apps,startup',
                'post_tag' => 'united-stated,election-results,fashion-week,game-of-thrones,sillicon-valley,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        '5-fashion-stories-from-around-the-web-you-might-have-missed-this-week' => array(
            'title' => '5 Fashion stories from around the web you might have missed this week',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion4',
            'taxonomy' => array(
                'category' => 'politics,food,mobile,sports',
                'post_tag' => 'trump-inauguration,fashion-week,motogp-2017,ces-2017,nintendo-switch,sillicon-valley',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                '_format_gallery_images' => array(
                    '{{image:fashion4:id}}',
                    '{{image:fashion5:id}}',
                    '{{image:fashion1:id}}',
                    '{{image:fashion2:id}}',
                    '{{image:fashion3:id}}',
                ),
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'a-year-of-lives-lost-to-diseases-science-has-yet-to-tame' => array(
            'title' => 'A Year of Lives Lost to Diseases Science Has Yet to Tame',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion5',
            'taxonomy' => array(
                'category' => 'health, lifestyle, world, fashion, news',
                'post_tag' => 'fashion-week, golden-globes, game-of-thrones, ces-2017, motogp-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'jokowi-seeks-investors-for-indonesias-airports-to-curb-deficit' => array(
            'title' => 'Jokowi Seeks Investors for Indonesia\'s Airports to Curb Deficit',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'fashion6',
            'taxonomy' => array(
                'category' => 'politics,world,gadget,mobile',
                'post_tag' => 'trump-inauguration,election-results,game-of-thrones,esports,mark-zuckerberg,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'csgo-eleague-major-pools-and-tournament-schedule-announced' => array(
            'title' => 'CS:GO ELeague Major pools and tournament schedule announced',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel1',
            'taxonomy' => array(
                'category' => 'apps,mobile,movie,sports',
                'post_tag' => 'election-results,fashion-week,ces-2017,nintendo-switch,sillicon-valley,ps4-pro',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:apps:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'washington-prepares-for-donald-trumps-big-moment' => array(
            'title' => 'Washington prepares for Donald Trump\'s big moment',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel4',
            'taxonomy' => array(
                'category' => 'business,fashion,health,music',
                'post_tag' => 'election-results,golden-globes,motogp-2017,esports,ces-2017,mark-zuckerberg',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'with-150-million-daily-active-users-instagram-stories-is-launching-ads' => array(
            'title' => 'With 150 million daily active users, Instagram Stories is launching ads',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'travel5',
            'taxonomy' => array(
                'category' => 'tech, apps, gadget, startup, business',
                'post_tag' => 'ces-2017, golden-globes, motogp-2017, ps4-pro, nintendo-switch',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tech:id}}'),
            )
        ),
        'game-of-thrones-spending-just-as-long-making-fewer-episodes' => array(
            'title' => 'Game of Thrones spending just as long making fewer episodes',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'travel6',
            'taxonomy' => array(
                'category' => 'entertainment,movie,gaming,music',
                'post_tag' => 'white-house,fashion-week,golden-globes,game-of-thrones,motogp-2017,mark-zuckerberg',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:movie:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=6N4gEJ_ED98'
            )
        ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1483584986908{margin-bottom: 40px !important;padding-top: 40px !important;background-color: #212121 !important;}.vc_custom_1483585071691{margin-bottom: 40px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '5',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1483584986908{margin-bottom: 40px !important;padding-top: 40px !important;background-color: #212121 !important;}.vc_custom_1483585071691{margin-bottom: 40px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1484967211521{border-top-width: 3px !important;padding-top: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1483947993136{border-top-width: 3px !important;padding-top: 15px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1484967536068{border-top-width: 3px !important;padding-top: 10px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '3',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_3',
                    'pagination_align' => 'left',   
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1484967211521{border-top-width: 3px !important;padding-top: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1483947993136{border-top-width: 3px !important;padding-top: 15px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1484967536068{border-top-width: 3px !important;padding-top: 10px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1483589032702{border-top-width: 2px !important;padding-top: 10px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1483589144101{border-top-width: 2px !important;padding-top: 10px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1483589190696{border-top-width: 2px !important;padding-top: 10px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'LATEST NEWS',
                    'header_type' => 'heading_5',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-3-loop',
                    'module'    => '9',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1483589032702{border-top-width: 2px !important;padding-top: 10px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1483589144101{border-top-width: 2px !important;padding-top: 10px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1483589190696{border-top-width: 2px !important;padding-top: 10px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1484905515832{margin-top: -30px !important;margin-bottom: 40px !important;border-bottom-width: 1px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;background-position: 0 0 !important;background-repeat: repeat !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1484905248370{margin-bottom: 40px !important;padding-top: 40px !important;background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAEklEQVR4AWNAB/Ly8pLUE0AAAHmVAk8rYiPSAAAAAElFTkSuQmCC) !important;background-position: 0 0 !important;background-repeat: repeat !important;}',
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1484905515832{margin-top: -30px !important;margin-bottom: 40px !important;border-bottom-width: 1px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;background-position: 0 0 !important;background-repeat: repeat !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1484905248370{margin-bottom: 40px !important;padding-top: 40px !important;background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAEklEQVR4AWNAB/Ly8pLUE0AAAHmVAk8rYiPSAAAAAElFTkSuQmCC) !important;background-position: 0 0 !important;background-repeat: repeat !important;}'
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
                    'first_title' => 'Latest News',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '3',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1483598309110{border-top-width: 2px !important;padding-top: 15px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}'
                )
            )
        ),
        'home-6' => array(
            'title' => 'Home 6',
            'content' => 'home6.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1484213623234{margin-top: 20px !important;margin-bottom: 40px !important;padding-top: 30px !important;padding-bottom: 10px !important;background-color: #f5f5f5 !important;}.vc_custom_1484906528767{margin-top: 20px !important;}.vc_custom_1484906510053{margin-top: 40px !important;}',
                '_elementor_data' => 'home6.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1484213623234{margin-top: 20px !important;margin-bottom: 40px !important;padding-top: 30px !important;padding-bottom: 10px !important;background-color: #f5f5f5 !important;}.vc_custom_1484906528767{margin-top: 50px !important;}.vc_custom_1484906510053{margin-top: 40px !important;}.jeg_overlay_slider {margin-bottom: 0 !important;}'
                )
            )
        ),

        /*'first-post-slug' => array(
            'title' => 'First Post',
            'content' => 'first.txt',
            'post_type' => 'post',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'second-category-slug, first-category-slug, forth-category-slug, third-category-slug',
                'post_tag' => 'first-tag, second-tag',
                'post_format' => 'post-format-gallery' // post-format-gallery || post-format-audio || post-format-video
            ),
            'metabox' => array(
                '_format_audio_embed' => '',
                '_format_gallery_images' => array(
                    '{{image:news1:id}}',
                    '{{image:news2:id}}',
                    '{{image:news3:id}}',
                    '{{image:news4:id}}',
                ),
                '_format_video_embed' => '',
                'jnews_single_post' => array(
                    'override_template' => 1,
                    'override' => array(
                        array(
                            'template' => '2',
                            'parallax' => 1,
                            'fullscreen' => 1,
                            'layout' => 'left-sidebar',
                            'sidebar' => 'default-sidebar',
                            'share_position' => 'top',
                            'share_float_style' => 'share-monocrhome',
                            'show_share_counter' => 1,
                            'show_view_counter' => 1
                        )
                    )
                )
            )
        ),
        'second-post-slug' => array(
            'title' => 'Second Post',
            'content' => 'first.txt',
            'post_type' => 'post',
            'featured_image' => 'news2',
            'parent' => '{{post:first-post-slug:id}}',
            'taxonomy' => array(
                'category' => 'second-category-slug, first-category-slug, forth-category-slug, third-category-slug',
                'post_tag' => 'first-tag, second-tag'
            ),
            'metabox' => array(
                'embed_source' => array(
                    'source' => 'youtube',
                    'url' => 'https://www.youtube.com/watch?v=uX6M0IrJ7ck',
                    'cover' => '{image:news1:url:full}'
                ),
            )
        ),
        'first-page-slug' => array(
            'title' => 'First Content',
            'content' => 'first.txt',
            'post_type' => 'page',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'second-category-slug, first-category-slug, forth-category-slug, third-category-slug',
                'post_tag' => 'first-tag, second-tag'
            ),
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                'embed_source' => array(
                    'source' => 'youtube',
                    'url' => 'https://www.youtube.com/watch?v=uX6M0IrJ7ck',
                    'cover' => '{image:news1:url:thumbnail}'
                ),
            )
        ),
        'second-page-slug' => array(
            'title' => 'Second Content',
            'content' => 'first.txt',
            'post_type' => 'page',
            'featured_image' => 'news2',
            'parent' => '{{post:first-page-slug:id}}',
            'taxonomy' => array(
                'category' => 'second-category-slug, first-category-slug, forth-category-slug, third-category-slug',
                'post_tag' => 'first-tag, second-tag'
            ),
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                'embed_source' => array(
                    'source' => 'youtube',
                    'url' => 'https://www.youtube.com/watch?v=uX6M0IrJ7ck',
                    'cover' => '{image:news1:url:full}'
                ),
            )
        ),*/
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
            'home-6' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Home - Layout 6',
                    'menu-item-parent-id' => '{{menu:home:id}}',
                    'menu-item-type' => 'post_type',
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => '{{post:home-6:id}}',
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
                    'number' => 6,
                    'trending_tag' => '{{taxonomy:post_tag:trump-inauguration:id}},{{taxonomy:post_tag:united-stated:id}},{{taxonomy:post_tag:white-house:id}},{{taxonomy:post_tag:market-stories:id}},{{taxonomy:post_tag:election-results:id}}',
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
                    'number' => 6,
                    'trending_tag' => '{{taxonomy:post_tag:nintendo-switch:id}},{{taxonomy:post_tag:ces-2017:id}},{{taxonomy:post_tag:ps4-pro:id}},{{taxonomy:post_tag:mark-zuckerberg:id}}',
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
                    'number' => 6
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
                    'trending_tag' => '{{taxonomy:post_tag:golden-globes:id}},{{taxonomy:post_tag:game-of-thrones:id}},{{taxonomy:post_tag:motogp-2017:id}},{{taxonomy:post_tag:esports:id}},{{taxonomy:post_tag:fashion-week:id}}',
                ),
            )
        ),
        'review' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Review',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:review:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:review:id}}',
                    'number' => 6
                ),
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
                'menu-item-title' => 'Contact',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        )

        /*'news' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'News',
                'menu-item-parent-id' => '{menu:first-menu:id}',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:news:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'tech' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Tech',
                'menu-item-type' => 'custom',
                'menu-item-url' => 'google.com',
                'menu-item-object-id' => '{{category:first-category}-slug:id}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_2',
                    'category' => '{{category:first-category}-slug:id}',
                    'number' => 9,
                    'trending_tag' => '{{taxonomy:post_tag:first-tag:id}},{{taxonomy:post_tag:second-tag:id}}',
                ),
            )
        )*/
    ),

    'widget_position' => array(
        'Home',
        'Home - Loop',
        'Home 3 - Loop',
        'Home 3'
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
        'jnews-review',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-split',
        'jnews-view-counter',
        'jnews-weather'
    )

);