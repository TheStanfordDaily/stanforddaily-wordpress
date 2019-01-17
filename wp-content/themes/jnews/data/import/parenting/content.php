<?php

return array(

    // image
    'image' =>  array(
	    'parent1'    => 'http://jegtheme.com/asset/jnews/demo/default/travel1.jpg',
	    'parent2'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion2.jpg',
	    'parent3'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion3.jpg',
	    'parent4'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion4.jpg',
	    'parent5'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion5.jpg',
	    'parent6'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion6.jpg',
	    'parent7'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion1.jpg',
	    'parent8'    => 'http://jegtheme.com/asset/jnews/demo/default/travel2.jpg',
	    'parent9'    => 'http://jegtheme.com/asset/jnews/demo/default/travel3.jpg',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/parenting/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/parenting/logo@2x.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'parenting' =>
                array(
                    'title' =>'Parenting',
                    'description' => 'You can add some category description here.'
                ),
            'lifestyle' =>
                array(
                    'title' =>'Lifestyle',
                    'description' => 'You can add some category description here.'
                ),
            'family' =>
                array(
                    'title' =>'Family',
                    'description' => 'You can add some category description here.'
                ),
            'food' =>
                array(
                    'title' =>'Food',
                    'description' => 'You can add some category description here.'
                ),
            'baby-and-toddler' =>
                array(
                    'title' =>'Baby & Toddler',
                    'description' => 'You can add some category description here.'
                ),
            'health' =>
                array(
                    'title' =>'Health',
                    'description' => 'You can add some category description here.'
                ),
        ),

        'post_tag' => array(
            'best-dressed' => array(
                'title' => 'Best Dressed'
            ),
        )
    ),

    // post & page
    'post' => array(
        'psychological-benefits-for-kids-when-moms-keep-taking-folic-acid' => array(
            'title' => "Psychological Benefits for Kids When Moms Keep Taking Folic Acid",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent1',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,family,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:parenting:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'tech-toys-are-helping-kids-learn-to-code-at-an-early-age' => array(
            'title' => "Tech Toys Are Helping Kids Learn to Code at An Early Age",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent2',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,lifestyle,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:parenting:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'what-you-need-to-know-about-baby-weight-gain' => array(
            'title' => "What You Need to Know About Baby Weight Gain",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent3',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,health',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:baby-and-toddler:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'try-this-healthy-spring-food-art-for-your-kids-snack-time' => array(
            'title' => "Try This Healthy Spring Food Art for Your Kid's Snack Time",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent4',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,food,health',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'fathers-brains-respond-differently-to-daughters-than-sons' => array(
            'title' => "Fathers' Brains Respond Differently to Daughters Than Sons",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent5',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,family,health',
                'post_tag' => '',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                '_format_gallery_images' => array(
                    '{{image:parent2:id}}',
                    '{{image:parent3:id}}',
                    '{{image:parent4:id}}',
                    '{{image:parent5:id}}',
                    '{{image:parent6:id}}',
                ),
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'why-my-two-children-have-different-last-names' => array(
            'title' => "Why My Two Children Have Different Last Names",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent6',
            'taxonomy' => array(
                'category' => 'family,lifestyle',
                'post_tag' => '',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:family:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=8SVs2tkAo88',
            )
        ),
        'use-these-apps-to-teach-science-to-your-kids-and-theyll-love-it' => array(
            'title' => "Use These Apps to Teach Science to Your Kids and They'll Love It",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent7',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:baby-and-toddler:id}}'),
                'post_subtitle' => 'Each day of our lives we make deposits in the memory banks of our children.'
            )
        ),
        '6-factors-that-increase-your-chance-of-having-twins-or-multiples' => array(
            'title' => "6 Factors That Increase Your Chance Of Having Twins Or Multiples",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent8',
            'taxonomy' => array(
                'category' => 'family,health,lifestyle',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'can-you-give-your-baby-chocolate-this-easter' => array(
            'title' => "Can You Give Your Baby Chocolate This Easter?",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent9',
            'taxonomy' => array(
                'category' => 'health,lifestyle,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'why-you-shouldnt-judge-the-parents-of-the-naughty-kid' => array(
            'title' => "Why You Shouldn't Judge the Parents of the 'Naughty' Kid",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent1',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:parenting:id}}')
            )
        ),
        'how-financial-infidelity-is-killing-american-marriages' => array(
            'title' => "How Financial Infidelity Is Killing American Marriages",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent2',
            'taxonomy' => array(
                'category' => 'family,lifestyle,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'our-10-best-slow-cooker-winter-meals-for-school-nights' => array(
            'title' => "Our 10 Best Slow Cooker Winter Meals for School Nights",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent3',
            'taxonomy' => array(
                'category' => 'food,lifestyle',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'please-stop-asking-my-husband-when-hell-have-his-own-kids' => array(
            'title' => "Please Stop Asking My Husband When He'll Have His \"Own\" Kids",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent4',
            'taxonomy' => array(
                'category' => 'family,lifestyle,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:family:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'what-you-need-to-know-when-choosing-your-kids-sunscreen' => array(
            'title' => "What You Need to Know When Choosing Your Kid's Sunscreen",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent5',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,health,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'when-your-child-would-rather-have-a-chauffeur-than-a-working-mom' => array(
            'title' => "When Your Child Would Rather Have a Chauffeur Than a Working Mom",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent6',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,family,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:parenting:id}}')
            )
        ),
        'think-giving-your-kids-juice-is-better-than-soda-think-again' => array(
            'title' => "Think Giving Your Kids Juice is Better Than Soda? Think again",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent7',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,food,health',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'should-you-quit-your-job-to-be-a-stay-at-home-mom' => array(
            'title' => "Should You Quit Your Job to Be a Stay-at-Home Mom?",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent9',
            'taxonomy' => array(
                'category' => 'family,lifestyle,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:parenting:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'my-kidss-favorite-slow-cooker-pork-chop' => array(
            'title' => "My Kids's Favorite Slow Cooker Pork Chop",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent1',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,food',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        '7-reasons-why-fatherrelationships-with-their-kids-are-so-important' => array(
            'title' => "7 Reasons Why Father Are So Important to Their Kids",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent2',
            'taxonomy' => array(
                'category' => 'family,lifestyle',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:family:id}}')
            )
        ),
        'separation-anxiety-solutions-for-babies-and-toddlers' => array(
            'title' => "Separation Anxiety Solutions for Babies and Toddlers",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent3',
            'taxonomy' => array(
                'category' => 'family,health,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:parenting:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'too-much-stress-for-the-mother-affects-the-baby-through-amniotic-fluid' => array(
            'title' => "Too Much Stress for the Mother Affects the Baby Through Amniotic Fluid",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'parent4',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,health,parenting',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}'),
                'post_subtitle' => 'Parenting is not for sissies. You have to sacrifice and grow up.'
            )
        ),
        'try-these-baby-friendly-recipes-for-starting-spoon-feeding' => array(
            'title' => "Try These Baby-Friendly Recipes for Starting Spoon Feeding",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'parent5',
            'taxonomy' => array(
                'category' => 'baby-and-toddler,food,health',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:food:id}}')
            )
        ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '23',
                    'show_navtext' => 0,
                    'show_pageinfo' => 1,
                    'post_offset' => 0,
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder'
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497608125175{margin-top: 40px !important;margin-bottom: -40px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;}',
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497608125175{margin-top: 40px !important;margin-bottom: -40px !important;padding-top: 40px !important;background-color: #f5f5f5 !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497671495454{margin-top: 40px !important;margin-bottom: 60px !important;padding-top: 30px !important;background-color: #f9f9f9 !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '5',
                    'post_offset' => 0,
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                'jnews_video_cache' => array(
                    'foWUOPxU6j8' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=foWUOPxU6j8',
                        'id' => 'foWUOPxU6j8',
                        'title' => 'BACK TO SCHOOL (Mommy Wars Spoof) feat. Fruit of the Loom',
                        'thumbnail' => 'https://i.ytimg.com/vi/foWUOPxU6j8/default.jpg',
                        'duration' => '00:01:32'
                    ),
                    'qDJgt-sto-Q' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=qDJgt-sto-Q',
                        'id' => 'qDJgt-sto-Q',
                        'title' => 'MOM HACKS ℠ | Laundry! (Ep. 3)',
                        'thumbnail' => 'https://i.ytimg.com/vi/qDJgt-sto-Q/default.jpg',
                        'duration' => '00:02:17'
                    ),
                    'vwMH9eJGTcU' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=vwMH9eJGTcU',
                        'id' => 'vwMH9eJGTcU',
                        'title' => 'MOM HACKS ℠ | Arts & Crafts (Ep. 2)',
                        'thumbnail' => 'https://i.ytimg.com/vi/vwMH9eJGTcU/default.jpg',
                        'duration' => '00:02:17'
                    ),
                    'Xf1olSpQOVk' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=Xf1olSpQOVk',
                        'id' => 'Xf1olSpQOVk',
                        'title' => 'PLAY | Painting with Clothespins',
                        'thumbnail' => 'https://i.ytimg.com/vi/Xf1olSpQOVk/default.jpg',
                        'duration' => '00:01:48'
                    ),
                    'Jv8R8r6Ugho' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=Jv8R8r6Ugho',
                        'id' => 'Jv8R8r6Ugho',
                        'title' => 'PLAY | 3 Easy Bug Habitats',
                        'thumbnail' => 'https://i.ytimg.com/vi/Jv8R8r6Ugho/default.jpg',
                        'duration' => '00:02:56'
                    ),
                    'cvszL_o5ChA' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=cvszL_o5ChA',
                        'id' => 'cvszL_o5ChA',
                        'title' => 'PLAY | 3 ORNAMENT CRAFTS for KIDS!',
                        'thumbnail' => 'https://i.ytimg.com/vi/cvszL_o5ChA/default.jpg',
                        'duration' => '00:02:03'
                    )
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497671495454{margin-top: 40px !important;margin-bottom: 60px !important;padding-top: 30px !important;background-color: #f9f9f9 !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497858772246{margin-bottom: 40px !important;border-top-width: 2px !important;border-right-width: 2px !important;border-bottom-width: 2px !important;border-left-width: 2px !important;padding-top: 30px !important;padding-right: 35px !important;padding-bottom: 30px !important;padding-left: 35px !important;background-color: #f9f9f9 !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'header_type' => 'heading_8',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-2',
                    'module'    => '3',
                    'show_navtext' => 1,
                    'show_pageinfo' => 0,
                    'post_offset' => 0,
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                'jnews_video_cache' => array(
                    'foWUOPxU6j8' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=foWUOPxU6j8',
                        'id' => 'foWUOPxU6j8',
                        'title' => 'BACK TO SCHOOL (Mommy Wars Spoof) feat. Fruit of the Loom',
                        'thumbnail' => 'https://i.ytimg.com/vi/foWUOPxU6j8/default.jpg',
                        'duration' => '00:01:32'
                    ),
                    'qDJgt-sto-Q' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=qDJgt-sto-Q',
                        'id' => 'qDJgt-sto-Q',
                        'title' => 'MOM HACKS ℠ | Laundry! (Ep. 3)',
                        'thumbnail' => 'https://i.ytimg.com/vi/qDJgt-sto-Q/default.jpg',
                        'duration' => '00:02:17'
                    ),
                    'vwMH9eJGTcU' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=vwMH9eJGTcU',
                        'id' => 'vwMH9eJGTcU',
                        'title' => 'MOM HACKS ℠ | Arts & Crafts (Ep. 2)',
                        'thumbnail' => 'https://i.ytimg.com/vi/vwMH9eJGTcU/default.jpg',
                        'duration' => '00:02:17'
                    ),
                    'Xf1olSpQOVk' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=Xf1olSpQOVk',
                        'id' => 'Xf1olSpQOVk',
                        'title' => 'PLAY | Painting with Clothespins',
                        'thumbnail' => 'https://i.ytimg.com/vi/Xf1olSpQOVk/default.jpg',
                        'duration' => '00:01:48'
                    ),
                    'Jv8R8r6Ugho' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=Jv8R8r6Ugho',
                        'id' => 'Jv8R8r6Ugho',
                        'title' => 'PLAY | 3 Easy Bug Habitats',
                        'thumbnail' => 'https://i.ytimg.com/vi/Jv8R8r6Ugho/default.jpg',
                        'duration' => '00:02:56'
                    ),
                    'cvszL_o5ChA' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=cvszL_o5ChA',
                        'id' => 'cvszL_o5ChA',
                        'title' => 'PLAY | 3 ORNAMENT CRAFTS for KIDS!',
                        'thumbnail' => 'https://i.ytimg.com/vi/cvszL_o5ChA/default.jpg',
                        'duration' => '00:02:03'
                    )
                ),
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497858772246{margin-bottom: 40px !important;border-top-width: 2px !important;border-right-width: 2px !important;border-bottom-width: 2px !important;border-left-width: 2px !important;padding-top: 30px !important;padding-right: 35px !important;padding-bottom: 30px !important;padding-left: 35px !important;background-color: #f9f9f9 !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497860045378{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #5bbac7 !important;}.vc_custom_1497861649035{padding-top: 20px !important;padding-right: 25px !important;padding-bottom: 20px !important;padding-left: 25px !important;background-color: #fff7e0 !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Late Post',
                    'header_type' => 'heading_7',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '9',
                    'show_navtext' => 0,
                    'show_pageinfo' => 0,
                    'post_offset' => 0,
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497860045378{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #5bbac7 !important;}.vc_custom_1497861649035{padding-top: 20px !important;padding-right: 25px !important;padding-bottom: 20px !important;padding-left: 25px !important;background-color: #fff7e0 !important;}'
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
        'parenting' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Parenting',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:parenting:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'family' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Family',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:family:id}}',
                'menu-item-status' => 'publish'
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
            )
        ),
        'health' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Health',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:health:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'food' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Food',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:food:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'baby-and-toddler' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Baby & Toddler',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:baby-and-toddler:id}}',
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
        'shop' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Shop',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'forum' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Forum',
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
        'Home',
        // 'Home 4',
        // 'Home 5',
        'Home 3',
        'Home - Loop',
        'Home 2'
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
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )

);