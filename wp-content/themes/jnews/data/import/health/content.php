<?php

return array(

    // image
    'image' =>  array(
        'health1'       => 'http://jegtheme.com/asset/jnews/demo/default/news9.jpg',
        'health2'       => 'http://jegtheme.com/asset/jnews/demo/default/fashion2.jpg',
        'health3'       => 'http://jegtheme.com/asset/jnews/demo/default/fashion3.jpg',
        'health4'       => 'http://jegtheme.com/asset/jnews/demo/default/fashion4.jpg',
        'health5'       => 'http://jegtheme.com/asset/jnews/demo/default/fashion5.jpg',
        'health6'       => 'http://jegtheme.com/asset/jnews/demo/default/fashion6.jpg',
        'health7'       => 'http://jegtheme.com/asset/jnews/demo/default/fashion1.jpg',
        'health8'       => 'http://jegtheme.com/asset/jnews/demo/default/travel2.jpg',
        'health9'       => 'http://jegtheme.com/asset/jnews/demo/default/travel3.jpg',
        'logo'          => 'http://jegtheme.com/asset/jnews/demo/health/logo.png',
        'logo2x'        => 'http://jegtheme.com/asset/jnews/demo/health/logo@2x.png',
        'footer_logo'   => 'http://jegtheme.com/asset/jnews/demo/health/footer_logo.png',
        'footer_logo2x' => 'http://jegtheme.com/asset/jnews/demo/health/footer_logo@2x.png',
        'mobile_logo'   => 'http://jegtheme.com/asset/jnews/demo/health/mobile_logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/health/mobile_logo@2x.png',
        'sticky_logo'   => 'http://jegtheme.com/asset/jnews/demo/health/sticky_logo.png',
        'sticky_logo2x' => 'http://jegtheme.com/asset/jnews/demo/health/sticky_logo@2x.png',
        'favicon'       => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_345x345'    => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90'     => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600'    => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90'     => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'health' =>
                array(
                    'title' =>'Health',
                    'description' => 'You can add some category description here.'
                ),
            'weight-loss' =>
                array(
                    'title' =>'Weight Loss',
                    'description' => 'You can add some category description here.'
                ),
            'disease' =>
                array(
                    'title' =>'Disease',
                    'description' => 'You can add some category description here.'
                ),
            'fitness' =>
                array(
                    'title' =>'Fitness',
                    'description' => 'You can add some category description here.'
                ),
            'lifestyle' =>
                array(
                    'title' =>'Lifestyle',
                    'description' => 'You can add some category description here.'
                ),
            'nutrition' =>
                array(
                    'title' =>'Nutrition',
                    'description' => 'You can add some category description here.'
                ),
        ),

        'post_tag' => array(
            'cancer' => array(
                'title' => 'Cancer',
            ),
            'diet-tips' => array(
                'title' => 'Diet Tips'
            ),
            'skin-care' => array(
                'title' => 'Skin Care'
            ),
            'health-symptoms' => array(
                'title' => 'Health Symptoms'
            ),
            'heart-attack' => array(
                'title' => 'Heart Attack'
            ),
            'diabetes' => array(
                'title' => 'Diabetes'
            ),
            'pregnancy' => array(
                'title' => 'Pregnancy'
            ),
            'womens-health' => array(
                'title' => 'Women\'s Health'
            ),
            'mens-health' => array(
                'title' => 'Men\'s Health'
            ),
        )
    ),

    // post & page
    'post' => array(
        'a-trainer-reveals-the-best-exercises-for-a-stronger-toned-butt' => array(
            'title' => "A Trainer Reveals the Best Exercises For a Stronger, Toned Butt",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health1',
            'taxonomy' => array(
                'category' => 'fitness,lifestyle',
                'post_tag' => 'diet-tips,health-symptoms,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'unused-dental-surgery-prescriptions-may-help-fuel-opioid-epidemic' => array(
            'title' => "Unused Dental Surgery Prescriptions May Help Fuel Opioid Epidemic",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health2',
            'taxonomy' => array(
                'category' => 'health,lifestyle',
                'post_tag' => 'cancer,diabetes,health-symptoms,pregnancy,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'breast-thermography-technology-benefits-and-cancer-signs' => array(
            'title' => "Breast Thermography: Technology, Benefits, and Cancer Signs",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health3',
            'taxonomy' => array(
                'category' => 'disease,health',
                'post_tag' => 'health-symptoms,heart-attack,pregnancy,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'researchers-examine-impact-of-soda-on-childrens-dental-health' => array(
            'title' => "Researchers Examine Impact of Soda on Children's Dental Health",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health4',
            'taxonomy' => array(
                'category' => 'health,lifestyle',
                'post_tag' => 'diabetes,heart-attack,mens-health,pregnancy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}'),
                'post_subtitle' => 'Your Baby\'s First Dental Visit.'
            )
        ),
        'dental-care-for-kids-when-should-your-child-start-going-to-the-dentist' => array(
            'title' => "Dental Care for Kids: When Should Your Child Start Going to the Dentist?",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health5',
            'taxonomy' => array(
                'category' => 'health,lifestyle',
                'post_tag' => 'diabetes,heart-attack,mens-health,pregnancy'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}'),
                'post_subtitle' => 'Your Baby\'s First Dental Visit.'
            )
        ),
        'digital-health-intervention-does-not-lower-heart-attack-risk' => array(
            'title' => "Digital Health Intervention Does Not Lower Heart Attack Risk",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health6',
            'taxonomy' => array(
                'category' => 'disease,health',
                'post_tag' => 'health-symptoms,heart-attack,pregnancy,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'how-to-lose-10-pounds-even-if-you-hate-vegetables' => array(
            'title' => "How To Lose 10 Pounds Even If You Hate Vegetables",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health7',
            'taxonomy' => array(
                'category' => 'lifestyle,nutrition,weight-loss',
                'post_tag' => 'cancer,health-symptoms,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:weight-loss:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'what-your-legs-could-be-telling-you-about-your-heart-health' => array(
            'title' => "What Your Legs Could Be Telling You About Your Heart Health",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health8',
            'taxonomy' => array(
                'category' => 'disease,health',
                'post_tag' => 'cancer,health-symptoms,heart-attack,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'a-trainer-answers-whats-the-best-workout-for-losing-weight' => array(
            'title' => "A Trainer Answers: What's the Best Workout For Losing Weight?",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health9',
            'taxonomy' => array(
                'category' => 'fitness,lifestyle,weight-loss',
                'post_tag' => 'diet-tips,health-symptoms,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'causes-of-psoriatic-arthritis-triggers-and-risk-factors' => array(
            'title' => "Causes of psoriatic arthritis: Triggers and risk factors",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health1',
            'taxonomy' => array(
                'category' => 'disease,health',
                'post_tag' => 'cancer,diabetes,health-symptoms,heart-attack,mens-health,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:disease:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'these-foods-to-absolutely-avoid-if-you-want-clear-glowing-skin' => array(
            'title' => "These Foods to Absolutely Avoid If You Want Clear, Glowing Skin",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health2',
            'taxonomy' => array(
                'category' => 'health,lifestyle,nutrition',
                'post_tag' => 'diabetes,health-symptoms,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:nutrition:id}}')
            )
        ),
        'drinking-this-kind-of-tea-could-help-shed-those-last-few-pounds' => array(
            'title' => "Drinking This Kind of Tea Could Help Shed Those Last Few Pounds",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health3',
            'taxonomy' => array(
                'category' => 'lifestyle,nutrition,weight-loss',
                'post_tag' => 'diabetes,diet-tips,pregnancy,skin-care'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:nutrition:id}}')
            )
        ),
        'this-easy-cardio-swap-will-help-you-train-for-a-half-marathon' => array(
            'title' => "This Easy Cardio Swap Will Help You Train for A Half Marathon",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health4',
            'taxonomy' => array(
                'category' => 'fitness,lifestyle,weight-loss',
                'post_tag' => 'diet-tips,health-symptoms,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        '5-must-follow-rules-if-you-want-to-get-strong' => array(
            'title' => "5 Must-Follow Rules If You Want to Get Strong",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health5',
            'taxonomy' => array(
                'category' => 'fitness,lifestyle,weight-loss',
                'post_tag' => 'diet-tips,mens-health,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
                'post_subtitle' => 'Don\'t shy, burn fat for quicker weight loss.'
            )
        ),
        'what-bleeding-gums-mean-for-people-with-diabetes' => array(
            'title' => "What bleeding gums mean for people with diabetes",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health6',
            'taxonomy' => array(
                'category' => 'health,lifestyle,nutrition',
                'post_tag' => 'diabetes,diet-tips,health-symptoms,mens-health,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'what-is-salicylic-acid-and-why-should-i-use-it-on-my-skin' => array(
            'title' => "What is Salicylic acid and why should I use it on my skin?",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health7',
            'taxonomy' => array(
                'category' => 'disease,health,nutrition',
                'post_tag' => 'cancer,diet-tips,health-symptoms,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:disease:id}}')
            )
        ),
        'drinking-coffee-could-protect-against-some-types-of-cancer' => array(
            'title' => "Drinking coffee could protect against some types of cancer",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health8',
            'taxonomy' => array(
                'category' => 'disease,health,nutrition',
                'post_tag' => 'cancer,diet-tips,health-symptoms,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:disease:id}}')
            )
        ),
        '7-tips-better-ways-to-remove-acne-on-your-face' => array(
            'title' => "7 Tips Better Ways to Remove Acne on Your Face",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health9',
            'taxonomy' => array(
                'category' => 'health,lifestyle',
                'post_tag' => 'cancer,health-symptoms,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'youre-being-watched-without-knowing-it' => array(
            'title' => "10 Things Every Woman Should Know About Yeast Infections",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health1',
            'taxonomy' => array(
                'category' => 'disease,health',
                'post_tag' => 'health-symptoms,heart-attack,pregnancy,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'can-this-weight-loss-pill-really-help-you-lose-weight' => array(
            'title' => "Can This Weight-Loss Pill Really Help You Lose Weight?",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health2',
            'taxonomy' => array(
                'category' => 'fitness,lifestyle,nutrition',
                'post_tag' => 'diabetes,health-symptoms,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:nutrition:id}}'),
                'post_subtitle' => 'Far far away, behind the word mountains, far from the countries.'
            )
        ),
        'the-simple-hacks-you-need-to-eat-more-salads' => array(
            'title' => "The Simple Hacks You Need to Eat More Salads",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health3',
            'taxonomy' => array(
                'category' => 'lifestyle,nutrition',
                'post_tag' => 'diabetes,diet-tips,mens-health,pregnancy,skin-care'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:nutrition:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'load-up-on-shrooms-with-these-healthy-recipes' => array(
            'title' => "Load Up on Shrooms With These Healthy Recipes",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health4',
            'taxonomy' => array(
                'category' => 'lifestyle,nutrition,weight-loss',
                'post_tag' => 'cancer,health-symptoms,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:weight-loss:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        '6-ways-to-burn-more-calories-doing-bodyweight-exercises' => array(
            'title' => "6 Ways to Burn More Calories Doing Bodyweight Exercises",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health5',
            'taxonomy' => array(
                'category' => 'fitness,lifestyle,weight-loss',
                'post_tag' => 'diet-tips,health-symptoms,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        '10-fat-burning-moves-that-will-help-you-lose-weight' => array(
            'title' => "10 Fat-Burning Moves That Will Help You Lose Weight",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health6',
            'taxonomy' => array(
                'category' => 'fitness,lifestyle,weight-loss',
                'post_tag' => 'diet-tips,mens-health,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
                'post_subtitle' => 'Don\'t shy, burn fat for quicker weight loss.'
            )
        ),
        'alcohol-link-between-liver-and-brain-may-control-consumption' => array(
            'title' => "Alcohol: Link Between Liver and Brain May Control Consumption",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health7',
            'taxonomy' => array(
                'category' => 'disease,health,lifestyle',
                'post_tag' => 'cancer,diabetes,health-symptoms,heart-attack,pregnancy,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}')
            )
        ),
        'outdoor-best-friend-workouts-for-when-it-finally-starts-to-get-warm' => array(
            'title' => "Outdoor Best Friend Workouts For When It Finally Starts to Get Warm",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health8',
            'taxonomy' => array(
                'category' => 'fitness,lifestyle,weight-loss',
                'post_tag' => 'diet-tips,health-symptoms,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'get-ready-to-run-your-first-5k-with-this-plan' => array(
            'title' => "Get Ready to Run Your First 5K With This Plan",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'health9',
            'taxonomy' => array(
                'category' => 'fitness,lifestyle,weight-loss',
                'post_tag' => 'diet-tips,health-symptoms,heart-attack,skin-care,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
                'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
            )
        ),
        'dark-urine-could-indicate-a-liver-problem' => array(
            'title' => "Dark urine could indicate a liver problem",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'health1',
            'taxonomy' => array(
                'category' => 'disease,health,lifestyle',
                'post_tag' => 'cancer,health-symptoms,womens-health'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:health:id}}'),
                'post_subtitle' => 'Urine that is orange, amber or brown might signify liver disease.'
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
                    'first_title' => 'Latest News',
                    'header_type' => 'heading_1',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '23',
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
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493695065122{margin-bottom: 40px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 30px !important;padding-right: 30px !important;padding-left: 30px !important;background-color: #212121 !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1492765990069{margin-top: 20px !important;}.vc_custom_1492758943788{border-top-width: 3px !important;border-right-width: 3px !important;border-bottom-width: 3px !important;border-left-width: 3px !important;padding-top: 20px !important;padding-right: 25px !important;padding-bottom: 20px !important;padding-left: 25px !important;background-color: #f9fafa !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;border-radius: 4px !important;}.vc_custom_1492766021090{margin-bottom: 20px !important;}',
                'jnews_video_cache' => array(
                    'Vj1bnfNaVBE' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=Vj1bnfNaVBE',
                        'id' => 'Vj1bnfNaVBE',
                        'title' => 'Men and depression: Getting the right treatment',
                        'thumbnail' => 'https://i.ytimg.com/vi/Vj1bnfNaVBE/default.jpg',
                        'duration' => '00:04:56'
                    ),
                    'RTqqY1uKChU' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=RTqqY1uKChU',
                        'id' => 'RTqqY1uKChU',
                        'title' => 'Debunking misconceptions around addiction',
                        'thumbnail' => 'https://i.ytimg.com/vi/RTqqY1uKChU/default.jpg',
                        'duration' => '00:04:32'
                    ),
                    'YPjK8CX5cJo' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=YPjK8CX5cJo',
                        'id' => 'YPjK8CX5cJo',
                        'title' => 'How Honeybees Brush Their Eye Hairs',
                        'thumbnail' => 'https://i.ytimg.com/vi/YPjK8CX5cJo/default.jpg',
                        'duration' => '00:01:15'
                    ),
                    'Lanzf6AKbD0' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=Lanzf6AKbD0',
                        'id' => 'Lanzf6AKbD0',
                        'title' => 'This Beat-Bot’s Got Groove!',
                        'thumbnail' => 'https://i.ytimg.com/vi/Lanzf6AKbD0/default.jpg',
                        'duration' => '00:00:49'
                    ),
                    'oZOHWD4q9c4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=oZOHWD4q9c4',
                        'id' => 'oZOHWD4q9c4',
                        'title' => 'Tips for more energy',
                        'thumbnail' => 'https://i.ytimg.com/vi/oZOHWD4q9c4/default.jpg',
                        'duration' => '00:04:10'
                    ),
                    '287NSXirWeA' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=287NSXirWeA',
                        'id' => '287NSXirWeA',
                        'title' => 'Listen to the Sounds of Knees Cracking',
                        'thumbnail' => 'https://i.ytimg.com/vi/287NSXirWeA/default.jpg',
                        'duration' => '00:02:01'
                    ),
                    'LZFWUPMUgxs' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=LZFWUPMUgxs',
                        'id' => 'LZFWUPMUgxs',
                        'title' => 'Instant Egghead Outtakes 2013',
                        'thumbnail' => 'https://i.ytimg.com/vi/LZFWUPMUgxs/default.jpg',
                        'duration' => '00:03:18'
                    )
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493695065122{margin-bottom: 40px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 30px !important;padding-right: 30px !important;padding-left: 30px !important;background-color: #212121 !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1492765990069{margin-top: 20px !important;}.vc_custom_1492758943788{border-top-width: 3px !important;border-right-width: 3px !important;border-bottom-width: 3px !important;border-left-width: 3px !important;padding-top: 20px !important;padding-right: 25px !important;padding-bottom: 20px !important;padding-left: 25px !important;background-color: #f9fafa !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;border-radius: 4px !important;}.vc_custom_1492766021090{margin-bottom: 20px !important;}'
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
                    'first_title' => 'Latest News',
                    'header_type' => 'heading_1',
                    'layout' => 'no-sidebar',
                    'sidebar' => 'default-sidebar',
                    'module'    => '9',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
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
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493695138935{border-top-width: 2px !important;padding-top: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1493004760321{border-top-width: 1px !important;padding-top: 5px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1493005960272{padding-right: 30px !important;padding-left: 30px !important;}.vc_custom_1493005979049{margin-bottom: -10px !important;}',
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493695138935{border-top-width: 2px !important;padding-top: 30px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1493004760321{border-top-width: 1px !important;padding-top: 5px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1493005960272{padding-right: 30px !important;padding-left: 30px !important;}.vc_custom_1493005979049{margin-bottom: -10px !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493014018017{margin-bottom: 30px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 7px !important;padding-bottom: 7px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}',
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493014018017{margin-bottom: 30px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 7px !important;padding-bottom: 7px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}'
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

        'health' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Health',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:health:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '',
                    'number' => 7
                ),
            )
        ),

        'weight-loss' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Weight Loss',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:weight-loss:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:weight-loss:id}}',
                    'number' => 7
                ),
            )
        ),

        'disease' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Disease',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:disease:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:disease:id}}',
                    'number' => 7
                ),
            )
        ),

        'fitness' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Fitness',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:fitness:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:fitness:id}}',
                    'number' => 7
                ),
            )
        ),

        'nutrition' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Nutrition',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:nutrition:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:nutrition:id}}',
                    'number' => 7
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
                    'type' => 'category_1',
                    'category' => '{{category:lifestyle:id}}',
                    'number' => 7
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
        'Contact',
        'Home 5',
        'Archives'
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
        'jnews-jsonld',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )

);