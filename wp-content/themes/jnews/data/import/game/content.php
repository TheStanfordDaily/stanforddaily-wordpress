<?php

return array(

    // image
    'image' =>  array(
	    'game1' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget1.jpg',
	    'game2' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget2.jpg',
	    'game3' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget3.jpg',
	    'game4' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget4.jpg',
	    'game5' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget5.jpg',
	    'game6' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget6.jpg',
	    'game7' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget7.jpg',
	    'game8' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget8.jpg',
	    'game9' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget9.jpg',
	    'game_bg' => 'http://jegtheme.com/asset/jnews/demo/game/game_bg.png',
	    'wavy_bg2' => 'http://jegtheme.com/asset/jnews/demo/game/wavy_bg2.png',
	    'game_row_bg' => 'http://jegtheme.com/asset/jnews/demo/game/game_row_bg.png',
	    'game_header_bg' => 'http://jegtheme.com/asset/jnews/demo/game/game_header_bg.png',
	    'game_row_bg_dark' => 'http://jegtheme.com/asset/jnews/demo/game/game_row_bg_dark.png',
	    'game_bg2' => 'http://jegtheme.com/asset/jnews/demo/game/game_bg2.jpg',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/game/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/game/logo@2x.png',
        'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/game/mobile_logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/game/mobile_logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
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
                    'title' =>'news',
                    'description' => 'You can add some category description here.'
                ),
            'reviews' =>
                array(
                    'title' =>'Reviews',
                    'description' => 'You can add some category description here.'
                ),
            'ps4' =>
                array(
                    'title' =>'PS4',
                    'description' => 'You can add some category description here.'
                ),
            'xbox-one' =>
                array(
                    'title' =>'Xbox One',
                    'description' => 'You can add some category description here.'
                ),
            'switch' =>
                array(
                    'title' =>'Switch',
                    'description' => 'You can add some category description here.'
                ),
            'pc' =>
                array(
                    'title' =>'PC',
                    'description' => 'You can add some category description here.'
                ),
            'mobile' =>
                array(
                    'title' =>'Mobile',
                    'description' => 'You can add some category description here.'
                ),
            'video' =>
                array(
                    'title' =>'Video',
                    'description' => 'You can add some category description here.'
                ),
        ),

        'post_tag' => array(
            'console' => array(
                'title' => 'Console',
            ),
            'rpg' => array(
                'title' => 'RPG'
            ),
            'action' => array(
                'title' => 'Action'
            ),
            'adventure' => array(
                'title' => 'Adventure'
            ),
            'strategy' => array(
                'title' => 'Strategy'
            ),
            'racing' => array(
                'title' => 'Racing'
            ),
            'sport' => array(
                'title' => 'Sport'
            ),
            'esport' => array(
                'title' => 'eSport'
            ),
            'open-world' => array(
                'title' => 'Open World'
            ),
            'top-list' => array(
                'title' => 'Top List'
            ),
        )
    ),

    // post & page
    'post' => array(
        'kojima-provides-update-on-death-stranding-talks-naked-norman-reedus' => array(
            'title' => "Kojima Provides Update On Death Stranding, Talks Naked Norman Reedus",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game1',
            'taxonomy' => array(
                'category' => 'news,pc,ps4,video,xbox-one',
                'post_tag' => 'action,adventure,console',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=vYkgqYRWajw'
            )
        ),
        'the-witcher-3-wild-hunt-for-playstation-4-reviews' => array(
            'title' => "The Witcher 3: Wild Hunt for PlayStation 4 Reviews",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game2',
            'taxonomy' => array(
                'category' => 'mobile,pc,ps4,reviews',
                'post_tag' => 'action,adventure,console,open-world,rpg'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'destiny-will-be-down-for-maintenance-next-week-heres-when' => array(
            'title' => "Destiny Will Be Down For Maintenance Next Week, Here's When",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game3',
            'taxonomy' => array(
                'category' => 'mobile,news,video',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}')
            )
        ),
        'halo-wars-2-on-xbox-one-review-the-good-and-the-bad' => array(
            'title' => "Halo Wars 2 on Xbox One Review: The Good and The Bad",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game4',
            'taxonomy' => array(
                'category' => 'mobile,pc,reviews,xbox-one',
                'post_tag' => 'action,adventure,console,open-world'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:xbox-one:id}}'),
                'post_subtitle' => 'The nice thing about Halo Wars 2 is that it works.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'ghost-recon-wildlands-update-out-very-soon-patch-notes-release-dates' => array(
            'title' => "Ghost Recon: Wildlands Update Out Very Soon, Patch Notes & Release Dates",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game5',
            'taxonomy' => array(
                'category' => 'news,switch,video,xbox-one',
                'post_tag' => 'action,console,esport,racing,sport'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:xbox-one:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=q1wYD5b4VUw'
            )
        ),
        'top-10-best-selling-games-of-the-week-in-south-east-asia' => array(
            'title' => "Top 10 Best-Selling Games Of The Week In South-East Asia",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game6',
            'taxonomy' => array(
                'category' => 'news,switch,video,xbox-one',
                'post_tag' => 'racing,sport,top-list'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=5ypU9j4w3_w'
            )
        ),
        'uncharted-4-a-thiefs-end-on-playstation-4-review' => array(
            'title' => "Uncharted 4: A Thief's End on Playstation 4 Review",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game7',
            'taxonomy' => array(
                'category' => 'pc,ps4,reviews,switch,video',
                'post_tag' => 'adventure,esport,open-world,rpg,strategy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=eYNCCu0y-Is',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'nioh-review-this-more-than-just-a-dark-souls-clone' => array(
            'title' => "Nioh Review: This More Than Just a Dark Souls Clone",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game8',
            'taxonomy' => array(
                'category' => 'mobile,pc,ps4,reviews,video',
                'post_tag' => 'adventure,esport,open-world,rpg,strategy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=eYNCCu0y-Is',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'for-honor-for-xbox-one-review-single-minded-battle-simulation' => array(
            'title' => "For Honor for Xbox One Review: Single-minded Battle Simulation",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game9',
            'taxonomy' => array(
                'category' => 'mobile,reviews,video,xbox-one',
                'post_tag' => 'action,adventure,console,open-world'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:xbox-one:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'tekken-7-launches-in-june-for-ps4-xbox-one-and-pc' => array(
            'title' => "Tekken 7 launches in June for PS4, Xbox One, and PC",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game1',
            'taxonomy' => array(
                'category' => 'pc,ps4,switch,video,xbox-one',
                'post_tag' => 'action,adventure,console,open-world',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=V1eN1CPit2M'
            )
        ),
        'dead-or-alive-5-last-round-review-on-playstation-4-and-xbox-one' => array(
            'title' => "Dead or Alive 5: Last Round Review on Playstation 4 and Xbox One",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game2',
            'taxonomy' => array(
                'category' => 'mobile,ps4,reviews,video,xbox-one',
                'post_tag' => 'action,adventure,console,open-world'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'mass-effect-andromeda-for-playstation-4-insanely-review' => array(
            'title' => "Mass Effect: Andromeda for Playstation 4 Insanely Review",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game3',
            'taxonomy' => array(
                'category' => 'mobile,pc,ps4,reviews',
                'post_tag' => 'action,adventure,console,open-world'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}'),
                'post_subtitle' => 'The central storyline revolves around an evil alien race and its narcissistic leader.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'the-best-upcoming-games-for-pc-ps4-and-xbox-one-in-2017' => array(
            'title' => "The Best Upcoming Games for PC, PS4 and XBOX One in 2017",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game4',
            'taxonomy' => array(
                'category' => 'mobile,news,pc,ps4,switch,video',
                'post_tag' => 'racing,sport,top-list'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=5ypU9j4w3_w'
            )
        ),
        'alienation-review-an-action-rpg-thats-heavy-on-the-action-and-gorgeous-effects' => array(
            'title' => "Alienation for Playstation 4 review: Gorgeous effects and heavy on the action",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game5',
            'taxonomy' => array(
                'category' => 'mobile,ps4,reviews,switch,xbox-one',
                'post_tag' => 'action,console,rpg,strategy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}'),
                'post_subtitle' => 'Blistering action and gorgeous effects make Alienation the best nation',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'top-7-best-car-racing-games-for-pc-ps4-and-xbox-one-in-2017' => array(
            'title' => "Top 7 Best Car Racing Games for PC, PS4 and XBOX One in 2017",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game6',
            'taxonomy' => array(
                'category' => 'mobile,news,pc,video',
                'post_tag' => 'racing,sport,top-list'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=5ypU9j4w3_w'
            )
        ),
        'hearthstone-fan-game-imagines-new-classes-300-fresh-cards' => array(
            'title' => "Hearthstone fan game imagines new classes, 300+ fresh cards",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game7',
            'taxonomy' => array(
                'category' => 'mobile,xbox-one',
                'post_tag' => 'console,esport,racing,sport'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:xbox-one:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=q1wYD5b4VUw'
            )
        ),
        'sonic-forces-gets-our-hopes-up-with-first-classic-sonic-gameplay' => array(
            'title' => "Sonic Forces gets our hopes up with first ‘classic Sonic’ gameplay",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game8',
            'taxonomy' => array(
                'category' => 'news,switch,video,xbox-one',
                'post_tag' => 'action,console,esport,racing,sport',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:xbox-one:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=q1wYD5b4VUw'
            )
        ),
        'the-original-starcraft-is-now-free-and-its-available-on-pc-and-mac' => array(
            'title' => "The Original StarCraft Is Now Free and It's Available on PC and Mac",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game9',
            'taxonomy' => array(
                'category' => 'mobile,news,pc,video',
                'post_tag' => 'esport,open-world,rpg,strategy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}'),
                'post_subtitle' => 'The gameplay remains as good as ever',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=5ypU9j4w3_w'
            )
        ),
        'marvels-guardians-of-the-galaxy-the-telltale-series-review' => array(
            'title' => "Marvel's Guardians of the Galaxy: The Telltale Series Review",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game1',
            'taxonomy' => array(
                'category' => 'pc,reviews,video,xbox-one',
                'post_tag' => 'action,console,racing,sport'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:xbox-one:id}}'),
                'post_subtitle' => 'An evocative and exhilarating open-world adventure game.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'horizon-zero-dawn-for-playstation-4-reviews' => array(
            'title' => "Horizon: Zero Dawn for PlayStation 4 Reviews",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game2',
            'taxonomy' => array(
                'category' => 'ps4,reviews,video',
                'post_tag' => 'action,adventure,console,open-world,rpg,strategy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}'),
                'post_subtitle' => 'An evocative and exhilarating open-world adventure game.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'the-legend-of-zelda-breath-of-the-wild-review' => array(
            'title' => "The Legend of Zelda: Breath of the Wild Review",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game3',
            'taxonomy' => array(
                'category' => 'reviews,switch,video',
                'post_tag' => 'action,adventure,console,open-world,rpg,strategy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:switch:id}}'),
                'post_subtitle' => 'An evocative and exhilarating open-world adventure game.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'marvel-vs-capcom-infinite-release-date-set-for-september' => array(
            'title' => "Marvel vs Capcom: Infinite release date set for September",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game4',
            'taxonomy' => array(
                'category' => 'news,pc,ps4,video',
                'post_tag' => 'adventure,esport,rpg,strategy',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:video:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=xZ2Hsig12h8'
            )
        ),
        'dota-2-will-require-a-phone-number-to-play-ranked-matches' => array(
            'title' => "Dota 2 will require a phone number to play ranked matches",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game5',
            'taxonomy' => array(
                'category' => 'news,pc,ps4,switch',
                'post_tag' => 'action,adventure,esport,rpg,strategy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:pc:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'sony-shares-a-list-of-39-titles-that-will-be-optimized-for-the-ps4-pro-at-launch' => array(
            'title' => "Sony shares a list of 39 titles that will be optimized for the PS4 Pro at launch",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game6',
            'taxonomy' => array(
                'category' => 'mobile,news,pc,switch,xbox-one',
                'post_tag' => 'action,console,esport,racing,sport'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'watch-a-full-dawn-of-war-3-match-ahead-of-the-open-beta' => array(
            'title' => "Watch A Full Dawn Of War 3 Match Ahead Of The Open Beta",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game7',
            'taxonomy' => array(
                'category' => 'news,pc,ps4,video',
                'post_tag' => 'adventure,esport,rpg,strategy',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:video:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=zEq-Of5RrcY'
            )
        ),
        'world-of-warcraft-legion-jnews-game-honest-review' => array(
            'title' => "World of Warcraft: Legion: JNews Game Honest Review",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game8',
            'taxonomy' => array(
                'category' => 'pc,reviews,video,xbox-one',
                'post_tag' => 'adventure,esport,open-world,rpg,strategy',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:pc:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=eYNCCu0y-Is',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Apple macOS Sierra',
                    'good' => array(
                        array( 'good_text' => 'Good low light camera' ),
                        array( 'good_text' => 'Water resistant' ),
                        array( 'good_text' => 'Double the internal capacity' )
                    ),
                    'bad' => array(
                        array( 'bad_text' => 'Lacks clear upgrades' ),
                        array( 'bad_text' => 'Same design used for last three phones' ),
                        array( 'bad_text' => 'Battery life unimpressive' )
                    ),
                    'rating' => array(
                        array(
                            'rating_text' => 'Design',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Performance',
                            'rating_number' => 8
                        ),
                        array(
                            'rating_text' => 'Camera',
                            'rating_number' => 9
                        ),
                        array(
                            'rating_text' => 'Battery',
                            'rating_number' => 7
                        ),
                        array(
                            'rating_text' => 'Price',
                            'rating_number' => 8
                        )
                    ),
                    'summary' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.',
                    'type' => 'percentage',
                ),
                'jnew_rating_mean' => '8.2',
            )
        ),
        'next-gen-playstation-system-will-launch-in-2018-analyst-predicts' => array(
            'title' => "Next-Gen PlayStation System Will Launch In 2018, Analyst Predicts",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game9',
            'taxonomy' => array(
                'category' => 'mobile,news,ps4',
                'post_tag' => 'console,esport,open-world,racing'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=q1wYD5b4VUw'
            )
        ),
        'sniper-ghost-warrior-3-takes-almost-5-minutes-to-load-on-ps4' => array(
            'title' => "Sniper Ghost Warrior 3 Takes Almost 5 Minutes To Load On PS4",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game1',
            'taxonomy' => array(
                'category' => 'news,pc,ps4',
                'post_tag' => 'action,adventure,console,open-world,rpg,strategy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:ps4:id}}')
            )
        ),
        'nintendo-switch-ui-gets-new-close-up-in-deleted-tweet' => array(
            'title' => "Nintendo Switch UI gets new close-up in deleted tweet",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game2',
            'taxonomy' => array(
                'category' => 'mobile,news,pc,switch,xbox-one',
                'post_tag' => 'action,console,esport,racing,sport'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:switch:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'new-persona-domain-names-have-fans-hoping-for-persona-5-spinoffs' => array(
            'title' => "New Persona domain names have fans hoping for Persona 5 spinoffs",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'game3',
            'taxonomy' => array(
                'category' => 'news,pc,ps4,switch',
                'post_tag' => 'adventure,console,open-world,rpg,strategy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:news:id}}')
            )
        ),
        'which-games-would-you-like-to-play-on-the-snes-mini' => array(
            'title' => "Which games would you like to play on the SNES Mini?",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'game4',
            'taxonomy' => array(
                'category' => 'mobile,news,switch,xbox-one',
                'post_tag' => 'console,open-world,racing,sport'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:switch:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493713130452{margin-top: -30px !important;margin-bottom: 40px !important;background: #14141b url({{image:game_bg:url:full}}) !important;}.vc_custom_1493454638462{margin-bottom: 40px !important;background-color: #000000 !important;}.vc_custom_1493713143711{margin-top: 5px !important;margin-bottom: 0px !important;}.vc_custom_1493454615877{margin-bottom: 0px !important;}',
                'jnews_video_cache' => array(
                    'YhpFWYHGnV8' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=YhpFWYHGnV8',
                        'id' => 'YhpFWYHGnV8',
                        'title' => 'Shadow of War: Weapons and Gear Detailed - IGN First',
                        'thumbnail' => 'https://i.ytimg.com/vi/YhpFWYHGnV8/default.jpg',
                        'duration' => '00:07:02'
                    ),
                    'VvZAsX8uVhY' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=VvZAsX8uVhY',
                        'id' => 'VvZAsX8uVhY',
                        'title' => 'Dawn of War 3 - 20 Minutes of Marine Gameplay',
                        'thumbnail' => 'https://i.ytimg.com/vi/VvZAsX8uVhY/default.jpg',
                        'duration' => '00:24:14',
                    ),
                    'X6PJEmEHIaY' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=X6PJEmEHIaY',
                        'id' => 'X6PJEmEHIaY',
                        'title' => 'MASS EFFECT™: ANDROMEDA – Official Launch Trailer',
                        'thumbnail' => 'https://i.ytimg.com/vi/X6PJEmEHIaY/default.jpg',
                        'duration' => '00:01:45'
                    ),
                    'eAK9LKWlkZ0' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=eAK9LKWlkZ0',
                        'id' => 'eAK9LKWlkZ0',
                        'title' => 'Project CARS 2 - Announcement Trailer | PS4',
                        'thumbnail' => 'https://i.ytimg.com/vi/eAK9LKWlkZ0/default.jpg',
                        'duration' => '00:01:26'
                    ),
                    '_zDZYrIUgKE' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=_zDZYrIUgKE',
                        'id' => '_zDZYrIUgKE',
                        'title' => 'Dark Souls III - Opening Cinematic Trailer | PS4, XB1, PC',
                        'thumbnail' => 'https://i.ytimg.com/vi/_zDZYrIUgKE/default.jpg',
                        'duration' => '00:03:36'
                    ),
                    'hI8goBqqRTo' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=hI8goBqqRTo',
                        'id' => 'hI8goBqqRTo',
                        'title' => 'Death Stranding - Reveal Trailer - E3 2016',
                        'thumbnail' => 'https://i.ytimg.com/vi/hI8goBqqRTo/default.jpg',
                        'duration' => '00:03:32'
                    ),
                    'VqeMjHmL9eg' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=VqeMjHmL9eg',
                        'id' => 'VqeMjHmL9eg',
                        'title' => 'Titanfall 2 Single Player Cinematic Trailer',
                        'thumbnail' => 'https://i.ytimg.com/vi/VqeMjHmL9eg/default.jpg',
                        'duration' => '00:02:51'
                    )
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493713130452{margin-top: -30px !important;margin-bottom: 40px !important;background: #14141b url({{image:game_bg:url:full}}) !important;}.vc_custom_1493454638462{margin-bottom: 40px !important;background-color: #000000 !important;}.vc_custom_1493713143711{margin-top: 5px !important;margin-bottom: 0px !important;}.vc_custom_1493454615877{margin-bottom: 0px !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493696127056{margin-top: -30px !important;margin-bottom: 80px !important;padding-top: 10px !important;background: #14141b url({{image:game_header_bg:url:full}}) !important;}.vc_custom_1493690553307{background-image: url({{image:game_bg2:url:full}}) !important;}.vc_custom_1493695697950{padding-top: 100px !important;background: #14141b url({{image:game_row_bg:url:full}}) !important;}.vc_custom_1493695783410{padding-top: 140px !important;background-image: url({{image:game_row_bg_dark:url:full}}) !important;}.vc_custom_1493693694302{margin-bottom: -40px !important;}.vc_custom_1493691089834{margin-bottom: 10px !important;}.vc_custom_1493692933928{margin-top: -10px !important;}.vc_custom_1493693529913{margin-bottom: -100px !important;}',
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493696127056{margin-top: -30px !important;margin-bottom: 80px !important;padding-top: 10px !important;background: #14141b url({{image:game_header_bg:url:full}}) !important;background-repeat: no-repeat !important;background-position: bottom !important;}.vc_custom_1493690553307{background-image: url({{image:game_bg2:url:full}}) !important;background-repeat: no-repeat;background-position: center center;}.vc_custom_1493695697950{padding-top: 100px !important;background: #14141b url({{image:game_row_bg:url:full}}) !important;background-repeat: no-repeat !important;}.vc_custom_1493695783410{padding-top: 140px !important;background-image: url({{image:game_row_bg_dark:url:full}}) !important;background-repeat: no-repeat;}.vc_custom_1493693694302{margin-bottom: -40px !important;}.vc_custom_1493691089834{margin-bottom: 10px !important;}.vc_custom_1493692933928{margin-top: -10px !important;}.vc_custom_1493693529913{margin-bottom: -100px !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493712948189{margin-top: -30px !important;margin-bottom: 60px !important;padding-top: 60px !important;background: #14141b url({{image:wavy_bg2:url:full}}) !important;}.vc_custom_1493712184986{background-image: url({{image:game_bg2:url:full}}) !important;}.vc_custom_1493709154205{margin-top: 30px !important;padding-right: 0px !important;padding-left: 0px !important;background-color: rgba(0,0,0,0.01) !important;*background-color: rgb(0,0,0) !important;}.vc_custom_1493712273799{margin-bottom: 0px !important;}',
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493712948189{margin-top: -30px !important;margin-bottom: 60px !important;padding-top: 60px !important;background: #14141b url({{image:wavy_bg2:url:full}}) !important;background-repeat: no-repeat !important;background-position: bottom !important;}.vc_custom_1493712184986{background-image: url({{image:game_bg2:url:full}}) !important;background-repeat: no-repeat;background-position: top center;}.vc_custom_1493709154205{margin-top: 30px !important;padding-right: 0px !important;padding-left: 0px !important;background-color: rgba(0,0,0,0.01) !important;*background-color: rgb(0,0,0) !important;}.vc_custom_1493712273799{margin-bottom: 0px !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493717198088{margin-top: -30px !important;margin-bottom: 30px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #e9e9ea !important;}.vc_custom_1493717321326{background-image: url({{image:game_bg2:url:full}}) !important;}.vc_custom_1493717204553{margin-bottom: 0px !important;}.vc_custom_1505979895312{border-top-width: 10px !important;border-top-color: rgba(255,255,255,0.01) !important;border-top-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'LATEST',
                    'second_title' => 'NEWS',
                    'header_type' => 'heading_8',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-3',
                    'module'    => '23',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493717198088{margin-top: -30px !important;margin-bottom: 30px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #e9e9ea !important;}.vc_custom_1493717321326{background-image: url({{image:game_bg2:url:full}}) !important;background-repeat: no-repeat !important;background-position: top center !important;}.vc_custom_1493717204553{margin-bottom: 0px !important;}.vc_custom_1505979895312{border-top-width: 10px !important;border-top-color: rgba(255,255,255,0.01) !important;border-top-style: solid !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493718966991{margin-top: -30px !important;}.vc_custom_1493719969662{background-image: url({{image:game_bg2:url:full}}) !important;}.vc_custom_1493720368355{border-top-width: 1px !important;padding-top: 40px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1493719004153{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1493720391493{margin-bottom: 0px !important;}',
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493718966991{margin-top: -30px !important;}.vc_custom_1493719969662{background-image: url({{image:game_bg2:url:full}}) !important;background-repeat: no-repeat;background-position: top center;}.vc_custom_1493720368355{border-top-width: 1px !important;padding-top: 40px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1493719004153{padding-right: 0px !important;padding-left: 0px !important;}.vc_custom_1493720391493{margin-bottom: 0px !important;}'
                )
            )
        ),
        'contact' => array(
            'title' => 'Contact',
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

        'reviews' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Reviews',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:reviews:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:reviews:id}}',
                    'number' => 7
                ),
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
                    'category' => '',
                    'number' => 6,
                    'trending_tag' => '{{taxonomy:post_tag:top-list:id}},{{taxonomy:post_tag:adventure:id}},{{taxonomy:post_tag:esport:id}},{{taxonomy:post_tag:open-world:id}},{{taxonomy:post_tag:strategy:id}},{{taxonomy:post_tag:sport:id}},{{taxonomy:post_tag:console:id}},{{taxonomy:post_tag:action:id}},{{taxonomy:post_tag:rpg:id}},{{taxonomy:post_tag:racing:id}}'
                ),
            )
        ),

        'pc' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'PC',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:pc:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:pc:id}}',
                    'number' => 7
                ),
            )
        ),

        'ps4' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'PS4',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:ps4:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:ps4:id}}',
                    'number' => 7
                ),
            )
        ),

        'switch' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Switch',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:switch:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:switch:id}}',
                    'number' => 7
                ),
            )
        ),

        'xbox-one' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Xbox One',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:xbox-one:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:xbox-one:id}}',
                    'number' => 7
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
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:contact:id}}',
                'menu-item-status' => 'publish'
            )
        )
    ),

    'widget_position' => array(
        'Home',
        'Home 2',
        'Home 3',
        'Contact'
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
        'jnews-like',
        'jnews-meta-header',
        'jnews-review',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-split',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )

);