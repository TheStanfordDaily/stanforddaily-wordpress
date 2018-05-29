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
        'logo' => 'http://jegtheme.com/asset/jnews/demo/news/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/news/logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
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
                'gear' =>
                    array(
                        'title' =>'Gear',
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
        ),
        'post_tag' => array(
            'united-stated' => array(
                'title' => 'United Stated',
            ),
            'election-results' => array(
                'title' => 'Election Results',
            ),
            'donald-trump' => array(
                'title' => 'Donald Trump',
            ),
            'market-stories' => array(
                'title' => 'Market Stories',
            ),
            'future-of-news' => array(
                'title' => 'Future of News'
            ),
            'golden-globes' => array(
                'title' => 'Golden Globes'
            ),
            'mr-robot' => array(
                'title' => 'Mr. Robot'
            ),
            'motogp-2017' => array(
                'title' => 'MotoGP 2017'
            ),
            'flat-earth' => array(
                'title' => 'Flat Earth'
            ),
            'climate-change' => array(
                'title' => 'Climate Change'
            ),
            'sillicon-valley' => array(
                'title' => 'Sillicon Valley'
            ),
        )
    ),

    // post & page
    'post' => array(
        'rap-group-call-out-publication-for-using-their-image-in-place-of-gang' => array(
            'title' => 'Rap group call out publication for using their image in place of \'gang\'',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'fashion,food,mobile,startup',
                'post_tag' => 'united-stated,election-results,donald-trump,market-stories,future-of-news,climate-change',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
            )
        ),
        'meet-the-woman-whos-making-consumer-boycotts-great-again' => array(
            'title' => 'Meet the woman who\'s making consumer boycotts great again',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news2',
            'taxonomy' => array(
                'category' => 'science,food,apps,sports',
                'post_tag' => 'donald-trump,market-stories,future-of-news,golden-globes,motogp-2017,flat-earth',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:science:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'new-campaign-wants-you-to-raise-funds-for-abuse-victims-by-ditching-the-razor' => array(
            'title' => 'New campaign wants you to raise funds for abuse victims by ditching the razor',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news3',
            'taxonomy' => array(
                'category' => 'science,food,mobile,movie',
                'post_tag' => 'election-results,donald-trump,mr-robot,flat-earth,climate-change,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:science:id}}')
            )
        ),
        'twitter-tweaks-video-again-adding-view-counts-for-some-users' => array(
            'title' => 'Twitter tweaks video again, adding view counts for some users',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news4',
            'taxonomy' => array(
                'category' => 'politics,fashion,apps,sports',
                'post_tag' => 'election-results,market-stories,future-of-news,mr-robot,flat-earth,climate-change',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'a-beginners-guide-to-the-legendary-tim-tam-biscuit-now-available-in-america' => array(
            'title' => 'A beginner\'s guide to the legendary Tim Tam biscuit, now available in America',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news5',
            'taxonomy' => array(
                'category' => 'business,politics,mobile,movie',
                'post_tag' => 'election-results,donald-trump,market-stories,mr-robot,motogp-2017,flat-earth',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
            )
        ),
        'india-is-bringing-free-wi-fi-to-more-than-1000-villages-this-year' => array(
            'title' => 'India is bringing free Wi-Fi to more than 1,000 villages this year',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news6',
            'taxonomy' => array(
                'category' => 'politics,science,health,mobile',
                'post_tag' => 'united-stated,donald-trump,market-stories,motogp-2017,flat-earth,climate-change',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'betterment-moves-beyond-robo-advising-with-human-financial-planners' => array(
            'title' => 'Betterment moves beyond robo-advising with human financial planners',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news7',
            'taxonomy' => array(
                'category' => 'politics,world,food,mobile',
                'post_tag' => 'election-results,donald-trump,future-of-news,golden-globes,motogp-2017,climate-change',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'people-are-handing-out-badges-at-tube-stations-to-tackle-loneliness' => array(
            'title' => 'People are handing out badges at Tube stations to tackle loneliness',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news8',
            'taxonomy' => array(
                'category' => 'fashion,gear,gaming,sports',
                'post_tag' => 'united-stated,election-results,mr-robot,motogp-2017,flat-earth,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'trumps-h-1b-visa-bill-spooks-indias-it-companies' => array(
            'title' => 'Trump\'s H-1B Visa Bill spooks India\'s IT companies',
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news9',
            'taxonomy' => array(
                'category' => 'travel,food,mobile,sports',
                'post_tag' => 'future-of-news,golden-globes,mr-robot,flat-earth,climate-change,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}')
            )
        ),
        'magical-fish-basically-has-the-power-to-conjure-its-own-patronus' => array(
            'title' => 'Magical fish basically has the power to conjure its own Patronus',
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news10',
            'taxonomy' => array(
                'category' => 'world,food,gaming,music',
                'post_tag' => 'future-of-news,golden-globes,mr-robot,motogp-2017,climate-change,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:world:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),

        'this-filipino-guy-channels-his-inner-miss-universe-by-strutting-in-six-inch-heels-and-speedos' => array(
            'title' => "This Filipino guy channels his inner Miss Universe by strutting in six-inch heels and speedos",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news11',
            'taxonomy' => array(
                'category' => 'science,fashion,health,music',
                'post_tag' => 'united-stated,election-results,donald-trump,future-of-news,motogp-2017,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:science:id}}')
            )
        ),
        'oil-spill-off-indias-southern-coast-leaves-fisherman-stranded-marine-life-impacted' => array(
            'title' => "Oil spill off India's southern coast leaves fisherman stranded, marine life impacted",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news12',
            'taxonomy' => array(
                'category' => 'politics,world,startup,movie',
                'post_tag' => 'united-stated,election-results,market-stories,motogp-2017,climate-change,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),

        // repeat 1
        'you-can-now-play-bill-gates-first-pc-game-and-run-over-donkeys-on-your-iphone-apple-watch' => array(
            'title' => "You can now play Bill Gates' first PC game and run over donkeys on your iPhone, Apple Watch",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'business,world,apps,movie',
                'post_tag' => 'united-stated,donald-trump,future-of-news,golden-globes,mr-robot,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}')
            )
        ),
        'indonesias-largest-fleet-of-taxis-teams-up-to-beat-ride-hailing-apps' => array(
            'title' => "Indonesia's largest fleet of taxis teams up to beat ride-hailing apps",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news2',
            'taxonomy' => array(
                'category' => 'business,apps,gear,mobile',
                'post_tag' => 'united-stated,election-results,golden-globes,motogp-2017,flat-earth,climate-change',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'idol-contestant-besieged-by-pro-trump-twitter-users-because-of-his-name' => array(
            'title' => "'Idol' contestant besieged by pro-Trump Twitter users because of his name",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news3',
            'taxonomy' => array(
                'category' => 'politics,fashion,apps,movie',
                'post_tag' => 'election-results,donald-trump,future-of-news,flat-earth,climate-change,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}')
            )
        ),
        'everyone-stop-everything-beyonc-just-announced-that-shes-pregnant-with-twins' => array(
            'title' => "Everyone stop everything: Beyonce just announced that she's pregnant with twins",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news4',
            'taxonomy' => array(
                'category' => 'travel,apps,mobile,music',
                'post_tag' => 'united-stated,election-results,donald-trump,mr-robot,motogp-2017,flat-earth',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:travel:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'instagram-is-testing-photo-albums-because-nothing-is-sacred-anymore' => array(
            'title' => "Instagram is testing photo albums, because nothing is sacred anymore",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news5',
            'taxonomy' => array(
                'category' => 'business,travel,apps,gaming',
                'post_tag' => 'united-stated,election-results,market-stories,mr-robot,flat-earth,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
            )
        ),
        '7-february-games-you-should-get-excited-about' => array(
            'title' => "7 February games you should get excited about",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news6',
            'taxonomy' => array(
                'category' => 'business,travel,health,music',
                'post_tag' => 'united-stated,election-results,donald-trump,market-stories,future-of-news,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'make-yourself-feel-better-by-laughing-at-januarys-best-news-bloopers' => array(
            'title' => "Make yourself feel better by laughing at January's best news bloopers",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news7',
            'taxonomy' => array(
                'category' => 'business,food,gear,startup',
                'post_tag' => 'united-stated,election-results,golden-globes,motogp-2017,climate-change,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}')
            )
        ),
        'using-a-mind-reading-device-locked-in-patients-told-researchers-theyre-happy' => array(
            'title' => "Using a mind reading device, 'locked-in' patients told researchers they're happy",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news8',
            'taxonomy' => array(
                'category' => 'fashion,travel,startup,sports',
                'post_tag' => 'united-stated,election-results,donald-trump,golden-globes,motogp-2017,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'how-to-find-protests-in-your-city-when-you-dont-know-where-to-start' => array(
            'title' => "How to find protests in your city when you don't know where to start",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news9',
            'taxonomy' => array(
                'category' => 'science,travel,food,apps',
                'post_tag' => 'election-results,donald-trump,market-stories,future-of-news,golden-globes,mr-robot',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:science:id}}'),
            )
        ),
        'trump-may-special-relationship-gets-special-treatment-in-the-streets-of-london' => array(
            'title' => "Trump-May special relationship gets special treatment in the streets of London",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news10',
            'taxonomy' => array(
                'category' => 'business,politics,movie,music',
                'post_tag' => 'united-stated,election-results,market-stories,future-of-news,mr-robot,motogp-2017',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'gopros-karma-drone-is-back-on-sale-after-design-flaw-made-them-fall-out-of-the-sky' => array(
            'title' => "GoPro's Karma drone is back on sale after design flaw made them fall out of the sky",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news11',
            'taxonomy' => array(
                'category' => 'business,startup,music,sports',
                'post_tag' => 'united-stated,donald-trump,golden-globes,mr-robot,flat-earth,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
            )
        ),
        'of-course-this-novelty-final-fantasy-fork-is-an-oversized-sword-replica' => array(
            'title' => "Of course this novelty 'Final Fantasy' fork is an oversized sword replica",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news12',
            'taxonomy' => array(
                'category' => 'business,apps,startup,sports',
                'post_tag' => 'united-stated,election-results,donald-trump,market-stories,motogp-2017,climate-change',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),

        // repeat 2
        'how-nike-plans-to-break-one-of-the-most-daunting-barriers-in-human-performance' => array(
            'title' => "How Nike plans to break one of the most daunting barriers in human performance",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news1',
            'taxonomy' => array(
                'category' => 'politics,world,fashion,gear',
                'post_tag' => 'united-stated,election-results,future-of-news,mr-robot,flat-earth,climate-change',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
            )
        ),
        'trump-attends-the-return-of-the-remains-of-the-navy-seal-who-died-in-yemen' => array(
            'title' => "Trump Attends the Return of the Remains of the Navy SEAL Who Died in Yemen",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news2',
            'taxonomy' => array(
                'category' => 'fashion,travel,food,mobile',
                'post_tag' => 'election-results,market-stories,future-of-news,golden-globes,motogp-2017,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'president-trump-threatens-to-send-u-s-troops-to-mexico-to-take-care-of-bad-hombres' => array(
            'title' => "President Trump Threatens to Send U.S. Troops to Mexico to Take Care of 'Bad Hombres'",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news3',
            'taxonomy' => array(
                'category' => 'science,mobile,gaming,music',
                'post_tag' => 'donald-trump,future-of-news,golden-globes,mr-robot,motogp-2017,flat-earth',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:science:id}}')
            )
        ),
        'house-republicans-vote-to-end-rule-stopping-coal-mining-debris-from-being-dumped-in-streams' => array(
            'title' => "House Republicans Vote to End Rule Stopping Coal Mining Debris From Being Dumped in Streams",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news4',
            'taxonomy' => array(
                'category' => 'business,politics,apps,mobile',
                'post_tag' => 'united-stated,donald-trump,market-stories,future-of-news,motogp-2017,climate-change',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'the-chainsmokers-actually-make-a-great-nickelback-cover-band' => array(
            'title' => "The Chainsmokers Actually Make a Great Nickelback Cover Band",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news5',
            'taxonomy' => array(
                'category' => 'health,mobile,startup,sports,science,world',
                'post_tag' => 'united-stated,election-results,donald-trump,golden-globes,flat-earth,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'j-k-rowling-is-shutting-down-readers-who-burned-all-their-harry-potter-books' => array(
            'title' => "J.K. Rowling Is Shutting Down Readers Who Burned All Their Harry Potter Books",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news6',
            'taxonomy' => array(
                'category' => 'world,fashion,gear,gaming,startup,science',
                'post_tag' => 'united-stated,election-results,donald-trump,future-of-news,golden-globes,sillicon-valley',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:world:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'the-scary-reason-healthy-people-die-after-an-er-visit' => array(
            'title' => "The Scary Reason Healthy People Die After an ER Visit",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news7',
            'taxonomy' => array(
                'category' => 'health,startup,gaming,music,science,world',
                'post_tag' => 'united-stated,election-results,donald-trump,future-of-news,flat-earth,climate-change',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'watch-justin-timberlakes-cry-me-a-river-come-to-life-in-mesmerizing-dance' => array(
            'title' => "Watch Justin Timberlake's 'Cry Me a River' Come to Life in Mesmerizing Dance",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news8',
            'taxonomy' => array(
                'category' => 'business,health,startup,movie,science,world',
                'post_tag' => 'donald-trump,future-of-news,golden-globes,motogp-2017,climate-change,sillicon-valley',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                '_format_video_embed' => 'https://www.youtube.com/watch?v=gtcV6fkms80',
                'jnews_primary_category' => array('id' => '{{category:business:id}}'),
                'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
            )
        ),
        'barack-obamas-now-mainly-focusing-on-wearing-this-casual-backwards-hat' => array(
            'title' => "Barack Obama's Now Mainly Focusing on Wearing This Casual Backwards Hat",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'news9',
            'taxonomy' => array(
                'category' => 'science,travel,movie,music,world',
                'post_tag' => 'united-stated,market-stories,golden-globes,mr-robot,motogp-2017,flat-earth',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                '_format_video_embed' => 'https://www.youtube.com/watch?v=RpUOFv2SHL8',
                'jnews_primary_category' => array('id' => '{{category:science:id}}')
            )
        ),
        'lady-gaga-pulled-off-one-of-the-best-halftime-shows-ever' => array(
            'title' => "Lady Gaga Pulled Off One of the Best Halftime Shows Ever",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'news10',
            'taxonomy' => array(
                'category' => 'science,travel,movie,music,politics,world',
                'post_tag' => 'united-stated,market-stories,golden-globes,mr-robot,motogp-2017,flat-earth',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                '_format_video_embed' => 'https://www.youtube.com/watch?v=txXwg712zw4',
                'jnews_primary_category' => array('id' => '{{category:music:id}}')
            )
        ),



        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1485745434897{border-top-width: 2px !important;padding-top: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}',
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1485745434897{border-top-width: 2px !important;padding-top: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1486456415323{margin-bottom: 15px !important;}',
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1486456415323{margin-bottom: 15px !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-3-loop',
                    'module'    => '5',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'show_navtext' => '1',
                    'show_pageinfo' => '1',
                    'pagination_align' => 'left',   
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder'
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder'
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
                    'number' => 10,
                    'trending_tag' => '{{taxonomy:post_tag:donald-trump:id}},{{taxonomy:post_tag:future-of-news:id}},{{taxonomy:post_tag:climate-change:id}},{{taxonomy:post_tag:market-stories:id}},{{taxonomy:post_tag:election-results:id}},{{taxonomy:post_tag:flat-earth:id}}',
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
                    'number' => 10,
                    'trending_tag' => '{{taxonomy:post_tag:flat-earth:id}},{{taxonomy:post_tag:sillicon-valley:id}},{{taxonomy:post_tag:mr-robot:id}},{{taxonomy:post_tag:motogp-2017:id}},{{taxonomy:post_tag:golden-globes:id}},{{taxonomy:post_tag:future-of-news:id}}',
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
                    'number' => 10
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
            'politics' => array(
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
            'business' => array(
                'location' => 'mobile-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Business',
                    'menu-item-type' => 'taxonomy',
                    'menu-item-object' => 'category',
                    'menu-item-object-id' => '{{category:business:id}}',
                    'menu-item-parent-id' => '{{menu:news-mobile:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'world' => array(
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
            'science' => array(
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
            'gaming' => array(
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
            'music' => array(
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
            'movie' => array(
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
            'sports' => array(
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
            'apps' => array(
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
            'gear' => array(
                'location' => 'mobile-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Gear',
                    'menu-item-type' => 'taxonomy',
                    'menu-item-object' => 'category',
                    'menu-item-object-id' => '{{category:gear:id}}',
                    'menu-item-parent-id' => '{{menu:tech-mobile:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'mobile' => array(
                'location' => 'mobile-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Mobile',
                    'menu-item-type' => 'taxonomy',
                    'menu-item-object' => 'category',
                    'menu-item-object-id' => '{{category:mobile:id}}',
                    'menu-item-parent-id' => '{{menu:tech-mobile:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'startup' => array(
                'location' => 'mobile-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Startup',
                    'menu-item-type' => 'taxonomy',
                    'menu-item-object' => 'category',
                    'menu-item-object-id' => '{{category:startup:id}}',
                    'menu-item-parent-id' => '{{menu:tech-mobile:id}}',
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
            'food' => array(
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
            'fashion' => array(
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
            'health' => array(
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
            'travel' => array(
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

    ),

    'widget_position' => array(
        'Home 3 - Loop',
        'Home 3',
        'Home 5',
        'Home 5 - Loop',
        'Author'
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
        'jnews-auto-load-post',
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