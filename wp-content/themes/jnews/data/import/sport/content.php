<?php

return array(

    // image
    'image' =>  array(
        'sport1' => 'http://jegtheme.com/asset/jnews/demo/default/sport2.jpg',
        'sport2' => 'http://jegtheme.com/asset/jnews/demo/sport/sport1.jpg',
        'sport3' => 'http://jegtheme.com/asset/jnews/demo/default/sport3.jpg',
        'sport4' => 'http://jegtheme.com/asset/jnews/demo/sport/sport4.jpg',
        'sport5' => 'http://jegtheme.com/asset/jnews/demo/sport/sport5.jpg',
        'sport6' => 'http://jegtheme.com/asset/jnews/demo/sport/sport6.jpg',
        'sport7' => 'http://jegtheme.com/asset/jnews/demo/sport/sport7.jpg',
        'sport8' => 'http://jegtheme.com/asset/jnews/demo/sport/sport8.jpg',
        'sport9' => 'http://jegtheme.com/asset/jnews/demo/sport/sport9.jpg',
        'sport10' => 'http://jegtheme.com/asset/jnews/demo/sport/sport10.jpg',
        'sport11' => 'http://jegtheme.com/asset/jnews/demo/sport/sport11.jpg',
        'sport12' => 'http://jegtheme.com/asset/jnews/demo/sport/sport12.jpg',
        'sport13' => 'http://jegtheme.com/asset/jnews/demo/sport/sport13.jpg',
        'sport14' => 'http://jegtheme.com/asset/jnews/demo/sport/sport14.jpg',
        'logo'      => 'http://jegtheme.com/asset/jnews/demo/sport/logo.png',
        'logo2x'    => 'http://jegtheme.com/asset/jnews/demo/sport/logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'basketball' =>
                array(
                    'title' =>'Basketball',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
                ),
            'motogp' =>
                array(
                    'title' => 'Moto GP',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                ),
            'f1' =>
                array(
                    'title' =>'Formula 1',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                ),
            'football' =>
                array(
                    'title' => 'Football',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                ),
            'golf' =>
                array(
                    'title' => 'Golf',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                ),
            'boxing' =>
                array(
                    'title' => 'Boxing',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                ),
            'tennis' =>
                array(
                    'title' => 'Tennis',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                ),

            'cycling' =>
                array(
                    'title' => 'Cycling',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
                ),
        ),

        'post_tag' => array(
            'premier-league' => array(
                'title' => 'Premier League',
            ),
            'motogp-2017' => array(
                'title' => 'MotoGP 2017'
            ),
            'valentino-rossi' => array(
                'title' => 'Valentino Rossi'
            ),
            'zlatan-ibrahimovic' => array(
                'title' => 'Zlatan Ibrahimovic'
            ),
            'the-presidents-cup' => array(
                'title' => 'The Presidents Cup'
            ),
            'super-bowl' => array(
                'title' => 'Super Bowl'
            ),
            'us-sports' => array(
                'title' => 'US Sports'
            ),
            'ufc' => array(
                'title' => 'UFC'
            ),
            'mma' => array(
                'title' => 'MMA'
            ),
            'champions-league' => array(
                'title' => 'Champions League'
            ),

        )
    ),

    // post & page
    'post' => array(
        'super-bowl-2017-heres-how-many-people-watched-the-super-bowl' => array(
            'title' => "Super Bowl 2017: Here\'s How Many People Watched the Super Bowl",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport1',
            'taxonomy' => array(
                'category' => 'basketball,f1,golf,tennis',
                'post_tag' => 'mma,motogp-2017,premier-league,super-bowl,the-presidents-cup,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}'),
                'post_subtitle' => 'Our greatest glory is not in never falling, but in rising every time we fall.',
            )
        ),
        'arsenal-and-sutton-communities-teams-deepen-bonds' => array(
            'title' => "Arsenal and Sutton communities teams deepen bonds",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport2',
            'taxonomy' => array(
                'category' => 'basketball,football,f1,tennis',
                'post_tag' => 'motogp-2017,premier-league,super-bowl,us-sports,valentino-rossi,zlatan-ibrahimovic',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=Cm0hWHpYFCw',
            )
        ),
        'lance-armstrong-is-facing-a-100-million-lawsuit-from-the-u-s-government' => array(
            'title' => "Lance Armstrong Is Facing a $100 Million Lawsuit From the U.S. Government",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport3',
            'taxonomy' => array(
                'category' => 'cycling,golf,motogp,tennis',
                'post_tag' => 'mma,motogp-2017,premier-league,super-bowl,the-presidents-cup,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:cycling:id}}')
            )
        ),
        'mclarens-f1-reboot-needs-to-be-successful-for-the-sake-of-the-sport' => array(
            'title' => "McLaren\'s F1 reboot needs to be successful for the sake of the sport",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport4',
            'taxonomy' => array(
                'category' => 'football,f1,motogp,tennis',
                'post_tag' => 'champions-league,mma,super-bowl,ufc,us-sports,zlatan-ibrahimovic',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:motogp:id}}'),
                '_format_gallery_images' => array(
                    '{{image:sport1:id}}',
                    '{{image:sport2:id}}',
                    '{{image:sport3:id}}',
                    '{{image:sport4:id}}',
                    '{{image:sport5:id}}',
                ),
            )
        ),
        'dani-alves-the-truth-behind-fights-with-cristiano-ronaldo' => array(
            'title' => "Dani Alves: The truth behind fights with Cristiano Ronaldo",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport5',
            'taxonomy' => array(
                'category' => 'cycling,football,golf',
                'post_tag' => 'champions-league,premier-league,super-bowl,the-presidents-cup,ufc,valentino-rossi',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=M9puglGDUzM',
            )
        ),
        'matthew-wade-says-concussion-substitute-rule-needs-to-be-looked-at' => array(
            'title' => "Matthew Wade says concussion substitute rule 'needs to be looked at'",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport6',
            'taxonomy' => array(
                'category' => 'basketball,football,f1,tennis',
                'post_tag' => 'mma,premier-league,super-bowl,the-presidents-cup,us-sports,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:basketball:id}}')
            )
        ),
        'new-york-jets-darrelle-revis-faces-assault-and-robbery-charges' => array(
            'title' => "New York Jets' Darrelle Revis faces assault and robbery charges",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport7',
            'taxonomy' => array(
                'category' => 'boxing,football,golf,motogp',
                'post_tag' => 'champions-league,mma,the-presidents-cup,us-sports,valentino-rossi,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:motogp:id}}')
            )
        ),
        'dybala-is-the-new-messi-and-worth-e150m-zamparini-hails-juventus-forward' => array(
            'title' => "'Dybala is the new Messi and worth &euro;150m' - Zamparini hails Juventus forward",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport8',
            'taxonomy' => array(
                'category' => 'boxing,f1,motogp',
                'post_tag' => 'champions-league,mma,super-bowl,the-presidents-cup,ufc,valentino-rossi',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:motogp:id}}'),
                '_format_gallery_images' => array(
                    '{{image:sport1:id}}',
                    '{{image:sport2:id}}',
                    '{{image:sport3:id}}',
                    '{{image:sport4:id}}',
                    '{{image:sport5:id}}',
                ),
            )
        ),
        'get-more-stats-based-winners-with-soccerways-betting-guide' => array(
            'title' => "Get more stats-based winners with Soccerway's betting guide",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport9',
            'taxonomy' => array(
                'category' => 'boxing,cycling,f1,tennis',
                'post_tag' => 'champions-league,motogp-2017,premier-league,the-presidents-cup,ufc,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:f1:id}}')
            )
        ),
        'konta-and-watson-fight-back-to-keep-alive-gbs-fed-cup-promotion-dreams' => array(
            'title' => "Konta and Watson fight back to keep alive GB\'s Fed Cup promotion dreams",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport10',
            'taxonomy' => array(
                'category' => 'boxing,cycling,f1,golf',
                'post_tag' => 'champions-league,mma,motogp-2017,super-bowl,us-sports,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tennis:id}}')
            )
        ),
        'dont-let-big-f1-teams-push-you-around-johnny-herbert-tells-liberty-media' => array(
            'title' => "Don\'t let big F1 teams push you around, Johnny Herbert tells Liberty Media",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport11',
            'taxonomy' => array(
                'category' => 'boxing,cycling,golf,tennis',
                'post_tag' => 'premier-league,super-bowl,the-presidents-cup,ufc,us-sports,zlatan-ibrahimovic',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:f1:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=gCzkaX2DL7w',
            )
        ),
        'creative-how-a-small-motogp-factory-beats-big-ones' => array(
            'title' => "'Creative': How a small MotoGP factory beats big ones",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport12',
            'taxonomy' => array(
                'category' => 'cycling,golf,motogp,tennis',
                'post_tag' => 'champions-league,mma,motogp-2017,premier-league,the-presidents-cup,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:motogp:id}}'),
                'post_subtitle' => 'Our greatest glory is not in never falling, but in rising every time we fall.',
            )
        ),
        'jose-mourinho-gets-tough-with-his-manchester-united-players-at-half-time' => array(
            'title' => "Jos&#233; Mourinho gets tough with his Manchester United players at half-time",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport13',
            'taxonomy' => array(
                'category' => 'football,f1,motogp,tennis',
                'post_tag' => 'mma,motogp-2017,super-bowl,the-presidents-cup,ufc,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}')
            )
        ),
        'arsene-wenger-i-will-manage-next-season-at-arsenal-or-somewhere-else' => array(
            'title' => "Ars&#232;ne Wenger: I will manage next season, at Arsenal or somewhere else",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport14',
            'taxonomy' => array(
                'category' => 'basketball,cycling,football,tennis',
                'post_tag' => 'champions-league,the-presidents-cup,ufc,us-sports,valentino-rossi,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:cycling:id}}'),
                'post_subtitle' => 'Our greatest glory is not in never falling, but in rising every time we fall.',
            )
        ),
        'robson-rooney-is-a-manchester-united-great' => array(
            'title' => "Wayne Rooney will only be regarded as a Manchester United great once he retires",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport1',
            'taxonomy' => array(
                'category' => 'boxing,cycling,football,golf',
                'post_tag' => 'champions-league,mma,motogp-2017,the-presidents-cup,ufc,us-sports',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:cycling:id}}'),
                'post_subtitle' => 'Our greatest glory is not in never falling, but in rising every time we fall.',
            )
        ),
        'transfer-news-the-latest-rumours-from-man-utd-chelsea-arsenal-and-all-the-top-teams' => array(
            'title' => "Transfer news: The latest rumours from Man Utd, Chelsea, Arsenal and all the top teams",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport2',
            'taxonomy' => array(
                'category' => 'basketball,football,golf,tennis',
                'post_tag' => 'champions-league,mma,motogp-2017,super-bowl,the-presidents-cup,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}')
            )
        ),
        'grady-jarrett-could-have-been-the-super-bowl-mvp-if-the-falcons-hadnt-blown-it' => array(
            'title' => "Grady Jarrett could have been the Super Bowl MVP if the Falcons hadn\'t blown it",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport3',
            'taxonomy' => array(
                'category' => 'football,f1,golf,tennis',
                'post_tag' => 'mma,motogp-2017,premier-league,super-bowl,the-presidents-cup,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}')
            ),
        ),
        'great-britain-to-face-croatia-in-fed-cup-promotion-play-off' => array(
            'title' => "Great Britain to face Croatia in Fed Cup promotion play-off",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport4',
            'taxonomy' => array(
                'category' => 'basketball,boxing,f1,tennis',
                'post_tag' => 'champions-league,super-bowl,the-presidents-cup,ufc,us-sports,zlatan-ibrahimovic',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tennis:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=eWo_s0hgRKs',
            )
        ),
        'clive-james-when-i-am-a-break-down-to-nadal-in-the-fifth-i-contemplate-giving-up-not-federer' => array(
            'title' => "Clive James: \'When I am a break down to Nadal in the fifth, I contemplate giving up. Not Federer\'",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport5',
            'taxonomy' => array(
                'category' => 'boxing,football,golf,motogp',
                'post_tag' => 'motogp-2017,the-presidents-cup,ufc,us-sports,valentino-rossi,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tennis:id}}')
            )
        ),
        'leo-in-limbo-messi-still-waiting-for-barcelona-to-offer-new-contract' => array(
            'title' => "Leo in limbo: Messi still waiting for Barcelona to offer new contract",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport6',
            'taxonomy' => array(
                'category' => 'basketball,football,golf',
                'post_tag' => 'mma,motogp-2017,ufc,us-sports,valentino-rossi,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}')
            )
        ),
        'alexis-out-thousands-of-chileans-to-march-for-sanchez-to-ditch-arsenal' => array(
            'title' => "Alexis out! Thousands of Chileans to march for Sanchez to ditch Arsenal",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport7',
            'taxonomy' => array(
                'category' => 'basketball,boxing,cycling,football',
                'post_tag' => 'champions-league,mma,premier-league,ufc,us-sports,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:basketball:id}}')
            )
        ),
        'joost-van-der-westhuizen-tennis-defaults-and-graham-taylors-comic-turn' => array(
            'title' => "Joost van der Westhuizen, tennis defaults and Graham Taylor's comic turn",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport8',
            'taxonomy' => array(
                'category' => 'basketball,f1,golf,tennis',
                'post_tag' => 'mma,motogp-2017,premier-league,super-bowl,the-presidents-cup,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tennis:id}}')
            )
        ),
        'barcelona-shortlist-three-men-to-replace-luis-enrique-but-current-boss-could-yet-stay' => array(
            'title' => "Barcelona shortlist three men to replace Luis Enrique - but current boss could yet stay",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport9',
            'taxonomy' => array(
                'category' => 'cycling,f1,motogp,tennis',
                'post_tag' => 'mma,super-bowl,the-presidents-cup,ufc,us-sports,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:motogp:id}}')
            )
        ),
        'real-madrid-v-espanyol-betting-zidanes-men-set-to-record-another-big-win' => array(
            'title' => "Real Madrid v Espanyol Betting: Zidane's men set to record another big win",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport10',
            'taxonomy' => array(
                'category' => 'basketball,cycling,football,f1',
                'post_tag' => 'champions-league,mma,premier-league,super-bowl,the-presidents-cup,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:basketball:id}}')
            )
        ),
        'barcelonas-digne-insists-real-madrid-arent-la-liga-favourites' => array(
            'title' => "Barcelona's Digne insists Real Madrid aren't La Liga favourites",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport11',
            'taxonomy' => array(
                'category' => 'football,f1,motogp,tennis',
                'post_tag' => 'mma,motogp-2017,premier-league,the-presidents-cup,ufc,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}')
            )
        ),
        'mercedes-f1-title-hopes-boosted-by-arrival-of-engineer-james-allison' => array(
            'title' => "Mercedes\' F1 title hopes boosted by arrival of engineer James Allison",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport12',
            'taxonomy' => array(
                'category' => 'basketball,cycling,football,f1',
                'post_tag' => 'mma,motogp-2017,super-bowl,us-sports,valentino-rossi,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:f1:id}}')
            )
        ),
        'us-tennis-says-sorry-for-using-nazi-era-anthem-before-germany-fed-cup-match' => array(
            'title' => "US Tennis says sorry for using Nazi-era anthem before Germany Fed Cup match",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport13',
            'taxonomy' => array(
                'category' => 'basketball,cycling,f1,golf',
                'post_tag' => 'mma,motogp-2017,premier-league,super-bowl,the-presidents-cup,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:tennis:id}}')
            )
        ),
        'meet-david-wagner-klopps-best-man-preparing-an-fa-cup-giant-killing-for-guardiola' => array(
            'title' => "Meet David Wagner: Klopp's best man preparing an FA Cup giant-killing for Guardiola",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport14',
            'taxonomy' => array(
                'category' => 'basketball,cycling,football,golf',
                'post_tag' => 'champions-league,motogp-2017,the-presidents-cup,ufc,valentino-rossi,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}')
            )
        ),
        'manchester-uniteds-zlatan-ibrahimovic-i-am-like-indiana-jones' => array(
            'title' => "Manchester United\'s Zlatan Ibrahimovic: I am like Indiana Jones",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport1',
            'taxonomy' => array(
                'category' => 'cycling,golf,motogp,tennis',
                'post_tag' => 'motogp-2017,super-bowl,the-presidents-cup,ufc,us-sports,valentino-rossi',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=mdLW17aZFJU',
            )
        ),
        'why-f1-must-fight-to-restore-the-nurburgring-to-the-calendar' => array(
            'title' => "Why F1 must fight to restore the N&#252;rburgring to the calendar",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport2',
            'taxonomy' => array(
                'category' => 'boxing,cycling,f1,golf',
                'post_tag' => 'champions-league,mma,premier-league,super-bowl,us-sports,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:f1:id}}')
            )
        ),
        'orlando-city-provides-jason-kreis-a-chance-at-redemption-will-he-take-it' => array(
            'title' => "Orlando City provides Jason Kreis a chance at redemption - will he take it?",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport3',
            'taxonomy' => array(
                'category' => 'boxing,football,tennis',
                'post_tag' => 'champions-league,mma,motogp-2017,premier-league,the-presidents-cup,ufc',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:football:id}}')
            )
        ),
        'burnley-v-lincoln-city-betting-clarets-set-for-more-cup-joy-on-home-soil' => array(
            'title' => "Burnley v Lincoln City Betting: Clarets set for more cup joy on home soil",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'sport4',
            'taxonomy' => array(
                'category' => 'basketball,boxing,cycling,football',
                'post_tag' => 'champions-league,motogp-2017,premier-league,ufc,valentino-rossi,zlatan-ibrahimovic',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:basketball:id}}')
            )
        ),
        'why-the-2017-f1-rule-changes-will-not-level-the-playing-field' => array(
            'title' => "Why the 2017 F1 rule changes will not level the playing field",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'sport5',
            'taxonomy' => array(
                'category' => 'cycling,golf,motogp,tennis',
                'post_tag' => 'mma,motogp-2017,premier-league,super-bowl,the-presidents-cup,valentino-rossi',
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:f1:id}}')
            )
        ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493692612602{margin-top: 20px !important;margin-bottom: 40px !important;margin-left: 0px !important;padding-top: 100px !important;padding-bottom: 70px !important;background: #050505 url({{image:sport14:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1487730974073{background-color: rgba(255,255,255,0.01) !important;*background-color: rgb(255,255,255) !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'second_title' => '',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '23',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493692612602{margin-top: 20px !important;margin-bottom: 40px !important;margin-left: 0px !important;padding-top: 100px !important;padding-bottom: 70px !important;background: #050505 url({{image:sport14:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1487730974073{background-color: rgba(255,255,255,0.01) !important;*background-color: rgb(255,255,255) !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493693409632{margin-top: -30px !important;}.vc_custom_1493693522042{padding-right: 0px !important;padding-left: 0px !important;}',
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493693409632{margin-top: -30px !important;}.vc_custom_1493693522042{padding-right: 0px !important;padding-left: 0px !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493693586029{margin-top: -30px !important;padding-top: 40px !important;padding-right: 30px !important;padding-left: 30px !important;background-color: #061d21 !important;}.vc_custom_1493693615060{margin-top: 80px !important;padding-right: 30px !important;padding-left: 30px !important;}.vc_custom_1493693649545{margin-bottom: 40px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;}.vc_custom_1493693815036{margin-bottom: 40px !important;padding-top: 40px !important;padding-right: 30px !important;padding-left: 30px !important;background-color: #061d21 !important;}.vc_custom_1487908706403{margin-bottom: -60px !important;}.vc_custom_1487908728368{border-top-width: 1px !important;padding-top: 15px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1487904702945{background-color: rgba(0,0,0,0.01) !important;*background-color: rgb(0,0,0) !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'second_title' => '',
                    'header_type' => 'heading_8',
                    'layout' => 'no-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '9',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493693586029{margin-top: -30px !important;padding-top: 40px !important;padding-right: 30px !important;padding-left: 30px !important;background-color: #061d21 !important;}.vc_custom_1493693615060{margin-top: 80px !important;padding-right: 30px !important;padding-left: 30px !important;}.vc_custom_1493693649545{margin-bottom: 40px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;}.vc_custom_1493693815036{margin-bottom: 40px !important;padding-top: 40px !important;padding-right: 30px !important;padding-left: 30px !important;background-color: #061d21 !important;}.vc_custom_1487908706403{margin-bottom: -60px !important;}.vc_custom_1487908728368{border-top-width: 1px !important;padding-top: 15px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1487904702945{background-color: rgba(0,0,0,0.01) !important;*background-color: rgb(0,0,0) !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493693901531{margin-bottom: 40px !important;background-image: url({{image:sport8:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1487915380416{background: rgba(10,10,10,0.01) url({{image:sport8:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;*background-color: rgb(10,10,10) !important;}.vc_custom_1487993828689{margin-top: 10px !important;margin-bottom: -25px !important;background-color: rgba(10,10,10,0.01) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;*background-color: rgb(10,10,10) !important;}',
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493693901531{margin-bottom: 40px !important;background-image: url({{image:sport8:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1487915380416{background: rgba(10,10,10,0.01) url({{image:sport8:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;*background-color: rgb(10,10,10) !important;}.vc_custom_1487993828689{margin-top: 10px !important;margin-bottom: -25px !important;background-color: rgba(10,10,10,0.01) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;*background-color: rgb(10,10,10) !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_elementor_data' => 'home5.json',
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

        'basketball' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Basketball',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:basketball:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'football' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Football',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:football:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'motogp' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Moto GP',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:motogp:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'f1' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Formula 1',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:f1:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'boxing' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Boxing',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:boxing:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'golf' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Golf',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:golf:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'cycling' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Cycling',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:cycling:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'tennis' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Tennis',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:tennis:id}}',
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
    ),

    'widget_position' => array(
        'Home',
        'Home - Loop',
        'Author',
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
        'jnews-customizer-category',
        'jnews-jsonld',
        'jnews-like',
        'jnews-instagram',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
        //'sportspress'
    )

);