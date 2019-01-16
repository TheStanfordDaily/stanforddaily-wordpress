<?php

return array(

    // image
    'image' =>  array(
        'gadget1' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget1.jpg',
        'gadget2' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget2.jpg',
        'gadget3' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget3.jpg',
        'gadget4' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget4.jpg',
        'gadget5' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget5.jpg',
        'gadget6' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget6.jpg',
        'gadget7' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget7.jpg',
        'gadget8' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget8.jpg',
        'gadget9' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget9.jpg',
        'gadget_bg' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget_bg.jpg',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/logo@2x.png',
        'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/mobile_logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/mobile_logo@2x.png',
        'sticky_logo' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/sticky_logo.png',
        'sticky_logo2x' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/sticky_logo@2x.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png',
        'ad_vertical' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/ad_vertical.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'car' =>
                array(
                    'title' =>'Car',
                    'description' => 'You can add some category description here.'
                ),
            'gadget' =>
                array(
                    'title' =>'Gadget',
                    'description' => 'You can add some category description here.'
                ),
            'computer' =>
                array(
                    'title' =>'Computer',
                    'description' => 'You can add some category description here.'
                ),
            'laptop' =>
                array(
                    'title' =>'Laptop',
                    'description' => 'You can add some category description here.'
                ),
            'mobile' =>
                array(
                    'title' =>'Mobile',
                    'description' => 'You can add some category description here.'
                ),
            'phone' =>
                array(
                    'title' =>'Phone',
                    'description' => 'You can add some category description here.'
                ),
        ),

        'post_tag' => array(
            'best-laptop' => array(
                'title' => 'Best Laptop'
            ),
            'best-phone-2017' => array(
                'title' => 'Best Phone 2017'
            ),
            'bluetooth-device' => array(
                'title' => 'Bluetooth Device'
            ),
            'ces-2017' => array(
                'title' => 'CES 2017'
            ),
            'esports' => array(
                'title' => 'eSports'
            ),
            'gadget-week' => array(
                'title' => 'Gadget Week'
            ),
            'home-entertaiment' => array(
                'title' => 'Home Entertaimnet'
            ),
            'mp3-players' => array(
                'title' => 'MP3 Players'
            ),
            'nintendo-switch' => array(
                'title' => 'Nintendo Switch'
            ),
            'sillicon-valley' => array(
                'title' => 'Sillicon Valley'
            ),
            'smart-home' => array(
                'title' => 'Smart Home'
            ),
            'sport-outdoors' => array(
                'title' => 'Sport & Outdoors'
            ),
            'super-car' => array(
                'title' => 'Super Car'
            ),
            'weareable-device' => array(
                'title' => 'Weareable Device'
            ),
            'wearebale-tech' => array(
                'title' => 'Wearable Tech'
            )
        )
    ),

    // post & page
    'post' => array(
        '2017-jeep-compass-entry-level-jeep-takes-a-heading-to-high-style' => array(
            'title' => "2017 Jeep Compass: Entry-level Jeep takes a heading to high style",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget1',
            'taxonomy' => array(
                'category' => 'car',
                'post_tag' => 'ces-2017,home-entertaiment,mp3-players,wearebale-tech'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:car:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
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
        'asus-rog-rapture-gt-ac5300-the-ultimate-router-for-gamers-and-nerds' => array(
            'title' => "Asus ROG Rapture GT-AC5300: The ultimate router for gamers and nerds",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget2',
            'taxonomy' => array(
                'category' => 'gadget,laptop',
                'post_tag' => 'ces-2017,home-entertaiment,mp3-players,wearebale-tech'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        'amazon-fire-7-2017-small-improvements-make-amazons-budget-tablet-a-better-bargain' => array(
            'title' => "Amazon Fire 7 (2017): Small improvements make Amazon's budget tablet a better bargain",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget3',
            'taxonomy' => array(
                'category' => 'computer,gadget',
                'post_tag' => 'best-laptop,ces-2017,home-entertaiment,mp3-players,wearebale-tech'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:phone:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
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
        'apple-imac-pro-is-promisingly-powerful' => array(
            'title' => "Apple iMac Pro is promisingly powerful",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget4',
            'taxonomy' => array(
                'category' => 'gadget,mobile',
                'post_tag' => 'best-laptop,ces-2017,gadget-week,super-car,weareable-device'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:computer:id}}'),
                'post_subtitle' => 'Make no mistake, the tech giants are still the kings.',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        'microsoft-surface-pro-4-iterative-in-the-best-sense-of-the-word' => array(
            'title' => "Microsoft Surface Pro 4: iterative in the best sense of the word",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget5',
            'taxonomy' => array(
                'category' => 'gadget,phone',
                'post_tag' => 'bluetooth-device,esports,gadget-week,sillicon-valley,sport-outdoors,wearebale-tech',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:laptop:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=-jGSOX2-G6M',
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
        'asus-zenbook-ux305-review-a-most-affordable-and-excellent-ultrabook' => array(
            'title' => "Asus ZenBook UX305 review: A most affordable and excellent Ultrabook",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget6',
            'taxonomy' => array(
                'category' => 'gadget,laptop,mobile,phone',
                'post_tag' => 'best-laptop,ces-2017,gadget-week,super-car,weareable-device'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:laptop:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=W3VDcUP60sE',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        'microsoft-surface-book-review-an-amazing-laptop-that-does-even-more-as-a-tablet' => array(
            'title' => "Microsoft Surface Book review: An amazing laptop that does even more as a tablet",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget7',
            'taxonomy' => array(
                'category' => 'computer,gadget,mobile,phone',
                'post_tag' => 'best-laptop,ces-2017,gadget-week,smart-home,weareable-device',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:computer:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=A1OsmndtIrY',
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
        '2017-kia-cadenza-review-a-sedan-delivering-beauty-tech-and-value' => array(
            'title' => "2017 Kia Cadenza review: A sedan delivering beauty, tech and value",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget8',
            'taxonomy' => array(
                'category' => 'car',
                'post_tag' => 'bluetooth-device,esports,gadget-week,mp3-players,sillicon-valley,super-car'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:car:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        'anker-soundbuds-slim-review-a-wireless-headphone-bargain-thats-hard-to-beat' => array(
            'title' => "Anker SoundBuds Slim review: A wireless headphone bargain that's hard to beat",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget9',
            'taxonomy' => array(
                'category' => 'gadget',
                'post_tag' => 'best-laptop,best-phone-2017,esports,smart-home,sport-outdoors,super-car,wearebale-tech'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=BtVtYSm3bJY',
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
        'belkin-wemo-dimmer-review-features-shine-with-belkin-wemos-dimmable-smart-switch' => array(
            'title' => "Belkin WeMo Dimmer review: Features shine with Belkin WeMo's dimmable smart switch",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget1',
            'taxonomy' => array(
                'category' => 'gadget',
                'post_tag' => 'bluetooth-device,ces-2017,sillicon-valley,super-car,weareable-device,wearebale-tech',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=1OaWeQ6Sw1Y',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        'rotimatic-review-there-are-still-some-kinks-in-this-indian-flatbread-maker' => array(
            'title' => "Rotimatic review: There are still some kinks in this Indian flatbread maker",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget2',
            'taxonomy' => array(
                'category' => 'gadget',
                'post_tag' => 'best-phone-2017,bluetooth-device,ces-2017,gadget-week,mp3-players,sport-outdoors'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
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
        'bt-whole-home-wi-fi-review-whole-house-coverage' => array(
            'title' => "BT Whole Home Wi-Fi review: Whole house coverage",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget3',
            'taxonomy' => array(
                'category' => 'computer,gadget,mobile,phone',
                'post_tag' => 'best-laptop,best-phone-2017,bluetooth-device,ces-2017,weareable-device,wearebale-tech'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        'canon-maxify-mb2750-review-a-surprisingly-affordable-well-equipped-office-workhorse' => array(
            'title' => "Canon Maxify MB2750 review A surprisingly affordable well-equipped office workhorse",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget4',
            'taxonomy' => array(
                'category' => 'computer,gadget,laptop,phone',
                'post_tag' => 'best-laptop,ces-2017,gadget-week,super-car,weareable-device',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:mobile:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=9Q5P_4OeCQs',
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
        'canon-pixma-ts8050-review-a-cleverly-designed-mfp-in-more-ways-than-one' => array(
            'title' => "Canon Pixma TS8050 review A cleverly designed MFP in more ways than one",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget5',
            'taxonomy' => array(
                'category' => 'computer,gadget,laptop,mobile',
                'post_tag' => 'best-laptop,bluetooth-device,home-entertaiment,mp3-players,sillicon-valley,super-car'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        'sony-ubp-x800-review-a-4k-blu-ray-player-alternative-with-a-premium-vibe' => array(
            'title' => "Sony UBP-X800 review: A 4K Blu-ray player alternative with a premium vibe",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget6',
            'taxonomy' => array(
                'category' => 'gadget,laptop,mobile,phone',
                'post_tag' => 'best-laptop,best-phone-2017,mp3-players,smart-home,super-car,wearebale-tech'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:mobile:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
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
        'samsung-galaxy-s8-plus-review-a-big-phone-lovers-dream-but-man-that-fingerprint-reader' => array(
            'title' => "Samsung Galaxy S8 Plus review: A big-phone lover's dream, but man, that fingerprint reader",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget7',
            'taxonomy' => array(
                'category' => 'computer,gadget,mobile,phone',
                'post_tag' => 'best-phone-2017,esports,gadget-week,home-entertaiment,sport-outdoors,super-car'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:phone:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        'origin-pc-eon15-s-2017-review-what-a-tie-looks-like-when-price-and-performance-rumble' => array(
            'title' => "Origin PC Eon15-S (2017) review: What a tie looks like when price and performance rumble",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget8',
            'taxonomy' => array(
                'category' => 'computer,gadget,laptop,mobile',
                'post_tag' => 'best-phone-2017,bluetooth-device,esports,nintendo-switch,sport-outdoors,super-car'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:laptop:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
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
        '2017-kia-soul-turbo-review-much-more-powerful-kia-soul-turbo-is-only-just-a-little-better-overall' => array(
            'title' => "2017 Kia Soul Turbo review: Much more powerful Kia Soul Turbo is only just a little better overall",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget9',
            'taxonomy' => array(
                'category' => 'car',
                'post_tag' => 'best-phone-2017,esports,sillicon-valley,smart-home,sport-outdoors,weareable-device'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:car:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        '2016-tesla-model-s-60-review-2016-tesla-model-s-now-with-fewer-miles-for-less-money' => array(
            'title' => "2016 Tesla Model S 60 review: 2016 Tesla Model S, now with fewer miles for less money",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget1',
            'taxonomy' => array(
                'category' => 'car',
                'post_tag' => 'best-phone-2017,ces-2017,gadget-week,smart-home,weareable-device',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:car:id}}'),
                '_format_gallery_images' => array(
                    '{{image:gadget1:id}}',
                    '{{image:gadget1:id}}',
                    '{{image:gadget1:id}}',
                    '{{image:gadget1:id}}',
                    '{{image:gadget1:id}}',
                ),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
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
        'blackberry-keyone-review-vintage-vibes-and-a-modern-os' => array(
            'title' => "BlackBerry KEYone review: Vintage vibes and a modern OS",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget2',
            'taxonomy' => array(
                'category' => 'computer,gadget,mobile,phone',
                'post_tag' => 'best-laptop,ces-2017,gadget-week,smart-home,weareable-device'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:mobile:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        'sony-xbr-a1e-series-review-unique-style-and-incredible-oled-picture-but-theres-a-sony-tax' => array(
            'title' => "Sony XBR-A1E series review:  Unique style and incredible OLED picture, but there's a 'Sony tax'",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget3',
            'taxonomy' => array(
                'category' => 'computer,gadget,laptop,mobile,phone',
                'post_tag' => 'ces-2017,home-entertaiment,mp3-players,nintendo-switch,sillicon-valley,wearebale-tech'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
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
        'google-home-review-google-home-might-be-the-virtual-assistant-for-you' => array(
            'title' => "Google Home review:  Google Home might be the virtual assistant for you",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget4',
            'taxonomy' => array(
                'category' => 'computer,gadget,laptop,mobile,phone',
                'post_tag' => 'best-phone-2017,bluetooth-device,nintendo-switch,smart-home,sport-outdoors,weareable-device'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:gadget:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                'enable_review' => '1',
                'jnews_review' => array(
                    'enable_review' => '1',
                    'name' => 'Nintendo Switch ',
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
                            'rating_number' => 9
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
                    'price' => array(
                        array(
                            'shop' => 'Amazon',
                            'price' => '804.99',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'BestBuy',
                            'price' => '735',
                            'link' => '#affiliate-link'
                        ),
                        array(
                            'shop' => 'Ebay',
                            'price' => '649.99',
                            'link' => '#your-referral-link'
                        )
                    )
                ),
                'jnew_rating_mean' => '8.4',
                'jnews_price_lowest' => '649.99',
            )
        ),
        'lenovo-thinkpad-x1-carbon-2017-review-a-modern-classic-for-the-battery-bleeding-business-traveler' => array(
            'title' => "Lenovo ThinkPad X1 Carbon (2017) review:  A modern classic for the battery-bleeding business traveler",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget5',
            'taxonomy' => array(
                'category' => 'computer,gadget,laptop,mobile,phone',
                'post_tag' => 'best-laptop,best-phone-2017,bluetooth-device,gadget-week,smart-home,weareable-device',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:laptop:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=gGhK7e3VbEk',
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
        'emotiva-airmotiv-b1-review-audiophile-sound-for-a-popcorn-price' => array(
            'title' => "Emotiva Airmotiv B1 review:  Audiophile sound for a popcorn price",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'gadget6',
            'taxonomy' => array(
                'category' => 'computer,gadget,laptop,mobile,phone',
                'post_tag' => 'best-phone-2017,esports,gadget-week,home-entertaiment,nintendo-switch,sillicon-valley',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:laptop:id}}'),
                'post_subtitle' => 'Best designed tech gadgets money can buy - Gadget Review',
                '_format_video_embed' => 'https://www.youtube.com/watch?v=_2Cki8MjLzM',
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

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497263838416{margin-top: 30px !important;margin-bottom: 50px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;background-color: #f2f2f2 !important;border-top-color: #dbdbdb !important;border-top-style: solid !important;border-bottom-color: #dbdbdb !important;border-bottom-style: solid !important;}.vc_custom_1497233281181{margin-top: 40px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'LATEST',
                    'second_title' => 'POST',
                    'header_type' => 'heading_5',
                    'layout' => 'no-sidebar',
                    'module'    => '11',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497263838416{margin-top: 30px !important;margin-bottom: 50px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;background-color: #f2f2f2 !important;border-top-color: #dbdbdb !important;border-top-style: solid !important;border-bottom-color: #dbdbdb !important;border-bottom-style: solid !important;}.vc_custom_1497233281181{margin-top: 40px !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder'
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1496997248277{padding-top: 50px !important;padding-bottom: 20px !important;background-color: #e2e1e1 !important;}.vc_custom_1496902123945{margin-top: 30px !important;}.vc_custom_1496902134318{margin-top: 10px !important;}.vc_custom_1497065061597{margin-top: 40px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'LATEST',
                    'second_title' => 'NEWS',
                    'header_type' => 'heading_5',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'landing-3',
                    'module'    => '5',
                    'excerpt_length' => '35',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1496997248277{padding-top: 50px !important;padding-bottom: 20px !important;background-color: #e2e1e1 !important;}.vc_custom_1496902123945{margin-top: 30px !important;}.vc_custom_1496902134318{margin-top: 10px !important;}.vc_custom_1497065061597{margin-top: 40px !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497000949360{padding-top: 30px !important;background-color: #eaeaea !important;}.vc_custom_1497000774013{margin-top: 40px !important;}.vc_custom_1497001074688{margin-top: 20px !important;margin-bottom: 40px !important;padding-top: 40px !important;background-color: #e8e8e8 !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'LATEST',
                    'second_title' => 'NEWS',
                    'header_type' => 'heading_5',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'landing-3',
                    'module'    => '5',
                    'excerpt_length' => '35',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497000949360{padding-top: 30px !important;background-color: #eaeaea !important;}.vc_custom_1497000774013{margin-top: 40px !important;}.vc_custom_1497001074688{margin-top: 20px !important;margin-bottom: 40px !important;padding-top: 40px !important;background-color: #e8e8e8 !important;}'
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
        'gadget' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Gadget',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:gadget:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_2',
                    'category' => '{{category:gadget:id}}',
                    'number' => 10,
                    'trending_tag' => '{{taxonomy:post_tag:ces-2017:id}},{{taxonomy:post_tag:super-car:id}},{{taxonomy:post_tag:esports:id}},{{taxonomy:post_tag:best-phone-2017:id}}',
                ),
            )
        ),
        'computer' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Computer',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:computer:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'laptop' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Laptop',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:laptop:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'mobile' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Mobile',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:mobile:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'phone' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Phone',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:phone:id}}',
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
        'contact' => array(
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
        'Landing 1',
        'Landing 3',
        'Landing 4',
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
        'jnews-gallery',
        'jnews-jsonld',
        'jnews-meta-header',
        'jnews-review',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'jnews-weather',
        'mailchimp-for-wp'
    )

);