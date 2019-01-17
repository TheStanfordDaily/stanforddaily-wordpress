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
	    'logo'          => 'http://jegtheme.com/asset/jnews/demo/fitness/logo.png',
	    'logo2x'        => 'http://jegtheme.com/asset/jnews/demo/fitness/logo@2x.png',
	    'footer_logo'   => 'http://jegtheme.com/asset/jnews/demo/fitness/footer_logo.png',
	    'footer_logo2x' => 'http://jegtheme.com/asset/jnews/demo/fitness/footer_logo@2x.png',
	    'favicon'       => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
	    'ad_345x345'    => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
	    'ad_728x90'     => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
	    'ad_300x600'    => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
	    'ad_970x90'     => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'diets-weight-loss' =>
                array(
                    'title' =>'Diets & Weight Loss',
                    'description' => 'You can add some category description here.'
                ),
            'health' =>
                array(
                    'title' =>'Health',
                    'description' => 'You can add some category description here.'
                ),
            'workout' =>
                array(
                    'title' =>'Workout',
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
            'food-nutrition' =>
                array(
                    'title' =>'Food & Nutrition',
                    'description' => 'You can add some category description here.'
                ),
        ),

        'post_tag' => array(
            'arms' => array(
                'title' => 'Arms',
            ),
            'best-fitness-food' => array(
	            'title' => 'Best Fitness Food',
            ),
            'cardio' => array(
	            'title' => 'Cardio',
            ),
            'fat-burning' => array(
	            'title' => 'Fat Burning',
            ),
            'fitness-tips' => array(
	            'title' => 'Fitness Tips',
            ),
            'quick-workout' => array(
	            'title' => 'Quick Workout',
            ),
            'running' => array(
	            'title' => 'Running',
            ),
            'stretches' => array(
	            'title' => 'Stretches',
            ),
            'workout-playlist' => array(
	            'title' => 'Workout Playlist',
            )
        )
    ),

    // post & page
    'post' => array(
	    'step-by-step-instructions-to-choose-the-right-running-chews' => array(
		    'title' => "Step by Step Instructions to Choose the Right Running Chews",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'health1',
		    'taxonomy' => array(
			    'category' => 'health,lifestyle,workout',
			    'post_tag' => 'arms,best-fitness-food,cardio,quick-workout,stretches,workout-playlist'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:workout:id}}'),
			    'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
		    )
	    ),
	    'hot-yoga-is-no-better-for-you-than-regular-yoga-study-says' => array(
		    'title' => "Hot Yoga Is No Better for You Than Regular Yoga, Study Says",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'health2',
		    'taxonomy' => array(
			    'category' => 'fitness,lifestyle',
			    'post_tag' => 'arms,fitness-tips,quick-workout,stretches'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
			    'post_subtitle' => 'Take care of your body. It\'s the only place you have to live.'
		    )
	    ),
	    'how-important-are-warming-up-and-cooling-down-in-a-workout' => array(
			'title' => "How Important Are Warming Up And Cooling Down In A Workout?",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health3',
			'taxonomy' => array(
				'category' => 'fitness,lifestyle,workout',
				'post_tag' => 'cardio,fat-burning,quick-workout,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fitness:id}}')
			)
		),
		'celebrity-fitness-trainer-is-doing-intense-workout-with-baby' => array(
			'title' => "Celebrity Fitness Trainer Is Doing Intense Workout With Baby",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health4',
			'taxonomy' => array(
				'category' => 'health,lifestyle,workout',
				'post_tag' => 'best-fitness-food,cardio,fat-burning,running'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}'),
				'post_subtitle' => 'To enjoy the glow of good health, you must exercise.'
			)
		),
		'five-yoga-poses-you-should-do-first-thing-in-the-morning' => array(
			'title' => "Five Yoga Poses You Should Do First Thing in the Morning",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health5',
			'taxonomy' => array(
				'category' => 'fitness,health,lifestyle',
				'post_tag' => 'best-fitness-food,cardio,fat-burning,running'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}'),
				'post_subtitle' => 'Take care of your body. It\'s the only place you have to live.'
			)
		),
	    'these-foods-you-should-never-eat-after-a-workout' => array(
			'title' => "These Foods You Should Never Eat After a Workout",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health6',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,food-nutrition,lifestyle',
				'post_tag' => 'arms,quick-workout,stretches,workout-playlist'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:diets-weight-loss:id}}'),
				'post_subtitle' => 'Take care of your body. It\'s the only place you have to live.'
			)
		),
		'the-ultimate-gym-workout-routines-for-men-for-beginners' => array(
			'title' => "The Ultimate Gym Workout Routines for Men for Beginners",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health7',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,fitness,workout',
				'post_tag' => 'arms,quick-workout,stretches,workout-playlist'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:workout:id}}'),
				'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
			)
		),
		'what-your-legs-could-be-telling-you-about-your-heart-health' => array(
			'title' => "What Your Legs Could Be Telling You About Your Heart Health",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health8',
			'taxonomy' => array(
				'category' => 'health,lifestyle',
				'post_tag' => 'fat-burning,quick-workout,stretches,workout-playlist'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}'),
				'post_subtitle' => 'Take care of your body. It\'s the only place you have to live.'
			)
		),
		'a-trainer-answers-whats-the-best-workout-for-losing-weight' => array(
			'title' => "A Trainer Answers: What's the Best Workout For Losing Weight?",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health9',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,fitness,workout',
				'post_tag' => 'arms,fitness-tips,quick-workout,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:diets-weight-loss:id}}'),
				'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
			)
		),
	    'a-trainer-reveals-the-best-exercises-for-a-stronger-and-toned-shoulders' => array(
			'title' => "A Trainer Reveals the Best Exercises For a Stronger and Toned Shoulders",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health1',
			'taxonomy' => array(
				'category' => 'health,workout',
				'post_tag' => 'best-fitness-food,fat-burning,quick-workout,running,stretches,workout-playlist'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:workout:id}}'),
				'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
			)
		),
	    'healthy-breakfast-ideas-what-fitness-experts-eat-in-the-morning' => array(
			'title' => "Healthy Breakfast Ideas: What Fitness Experts Eat In The Morning",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health2',
			'taxonomy' => array(
				'category' => 'food-nutrition,health,lifestyle',
				'post_tag' => 'best-fitness-food,fitness-tips,quick-workout,running,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food-nutrition:id}}')
			)
		),
	    'beginner-exercises-you-should-try-to-build-a-better-body-for-cycling' => array(
			'title' => "Beginner Exercises You Should Try To Build A Better Body For Cycling",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health3',
			'taxonomy' => array(
				'category' => 'health,workout',
				'post_tag' => 'arms,best-fitness-food,quick-workout,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:workout:id}}')
			)
		),
	    'drinking-this-kind-of-tea-could-help-shed-those-last-few-pounds' => array(
			'title' => "Drinking This Kind of Tea Could Help Shed Those Last Few Pounds",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health4',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,food-nutrition,health',
				'post_tag' => 'arms,best-fitness-food,cardio,fitness-tips'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food-nutrition:id}}')
			)
		),
	    'this-easy-cardio-swap-will-help-you-train-for-a-half-marathon' => array(
			'title' => "This Easy Cardio Swap Will Help You Train for A Half Marathon",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health5',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,fitness,lifestyle',
				'post_tag' => 'arms,fitness-tips,quick-workout,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
				'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
			)
		),
	    'the-best-yoga-moves-to-improve-shoulder-flexibility' => array(
			'title' => "The Best Yoga Moves To Improve Shoulder Flexibility",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health6',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,fitness,lifestyle',
				'post_tag' => 'cardio,fitness-tips,running,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
				'post_subtitle' => 'Don\'t shy, burn fat for quicker weight loss.'
			)
	    ),
	    'unconventional-workouts-that-torch-fat-and-sculpt-muscle' => array(
			'title' => "Unconventional Workouts That Torch Fat And Sculpt Muscle",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health7',
			'taxonomy' => array(
				'category' => 'fitness,health,workout',
				'post_tag' => 'fitness-tips,quick-workout,stretches,workout-playlist'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:workout:id}}')
			)
		),
		'10-dynamic-warm-up-exercises-to-prime-you-for-your-workout' => array(
			'title' => "10 Dynamic Warm-Up Exercises to Prime You for Your Workout",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health8',
			'taxonomy' => array(
				'category' => 'health,lifestyle,workout',
				'post_tag' => 'fitness-tips,quick-workout,stretches,workout-playlist'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:workout:id}}')
			)
		),
		'the-one-exercise-everyone-should-do-before-lifting-weights' => array(
			'title' => "The One Exercise Everyone Should Do Before Lifting Weights",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health9',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,health,lifestyle',
				'post_tag' => 'arms,quick-workout,stretches,workout-playlist'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:workout:id}}')
			)
		),
		'expert-tips-good-ways-to-warm-up-your-knees-during-exercise' => array(
			'title' => "Expert Tips: Good Ways to Warm Up Your Knees During Exercise",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health1',
			'taxonomy' => array(
				'category' => 'fitness,health,workout',
				'post_tag' => 'cardio,fat-burning,quick-workout,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}')
			)
		),
		'build-bigger-broader-shoulders-with-these-shoulders-exercises' => array(
			'title' => "Build Bigger, Broader Shoulders With These Shoulders Exercises",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health2',
			'taxonomy' => array(
				'category' => 'fitness,lifestyle,workout',
				'post_tag' => 'arms,best-fitness-food,quick-workout,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
				'post_subtitle' => 'Far far away, behind the word mountains, far from the countries.'
			)
		),
		'the-simple-hacks-you-need-to-eat-more-salads' => array(
			'title' => "Having Strong Arms With These Arm Workouts You Can Do Everywhere",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health3',
			'taxonomy' => array(
				'category' => 'fitness,lifestyle,workout',
				'post_tag' => 'arms,best-fitness-food,cardio,fitness-tips,running'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
				'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
			)
		),
		'6-reasons-to-eat-more-of-your-fruits-and-veggies-frozen' => array(
			'title' => "6 Reasons to Eat More of Your Fruits and Veggies Frozen",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health4',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,food-nutrition,health',
				'post_tag' => 'cardio,fat-burning,quick-workout,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:food-nutrition:id}}')
			)
		),
		'outdoor-best-friend-workouts-for-when-it-finally-starts-to-get-warm' => array(
			'title' => "Outdoor Best Friend Workouts For When It Finally Starts to Get Warm",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health5',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,fitness,lifestyle',
				'post_tag' => 'arms,fitness-tips,quick-workout,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
				'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
			)
		),
		'6-ways-to-burn-more-calories-doing-bodyweight-exercises' => array(
			'title' => "6 Ways to Burn More Calories Doing Bodyweight Exercises",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health6',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,fitness,lifestyle',
				'post_tag' => 'arms,fitness-tips,quick-workout,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
				'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
			)
		),
		'10-fat-burning-moves-that-will-help-you-lose-weight' => array(
			'title' => "10 Fat-Burning Moves That Will Help You Lose Weight",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health7',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,fitness,lifestyle',
				'post_tag' => 'fitness-tips,running,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
				'post_subtitle' => 'Don\'t shy, burn fat for quicker weight loss.'
			)
		),
		'alcohol-link-between-liver-and-brain-may-control-consumption' => array(
			'title' => "Alcohol: Link Between Liver and Brain May Control Consumption",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health8',
			'taxonomy' => array(
				'category' => 'food-nutrition,health,lifestyle',
				'post_tag' => 'best-fitness-food,cardio,fat-burning,quick-workout,stretches,workout-playlist'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}')
			)
		),
	    'get-ready-to-run-your-first-5k-to-build-strength-and-endurance' => array(
			'title' => "Get Ready to Run Your First 5K to Build Strength and Endurance",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'health9',
			'taxonomy' => array(
				'category' => 'diets-weight-loss,fitness,lifestyle',
				'post_tag' => 'arms,fat-burning,fitness-tips,quick-workout,stretches'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fitness:id}}'),
				'post_subtitle' => 'A wonderful serenity has taken possession of my entire soul.'
			)
		),
	    'the-only-reason-you-should-ever-take-a-supplement-and-why' => array(
			'title' => "The Only Reason You Should Ever Take a Supplement and Why",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'health1',
			'taxonomy' => array(
				'category' => 'health,lifestyle,workout',
				'post_tag' => 'quick-workout,stretches,workout-playlist'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}'),
				'post_subtitle' => 'There are few reasons why you should actually use workout supplements.'
			)
		),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1516867057019{margin-bottom: 15px !important;}.vc_custom_1516864288868{margin-bottom: 15px !important;}.vc_custom_1516864099181{margin-top: 0px !important;}.vc_custom_1493005960272{padding-right: 30px !important;padding-left: 30px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest News',
                    'header_type' => 'heading_7',
                    'layout' => 'right-sidebar',
                    'sticky_sidebar' => '1',
                    'sidebar' => 'home',
                    'module'    => '5',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1516867057019{margin-bottom: 15px !important;}.vc_custom_1516864288868{margin-bottom: 15px !important;}.vc_custom_1516864099181{margin-top: 0px !important;}.vc_custom_1493005960272{padding-right: 30px !important;padding-left: 30px !important;}'
                )
            )
        ),
	    'home-2' => array(
		    'title' => 'Home 2',
		    'content' => 'home2.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    'jnews_page_loop' => array(
				    'enable_page_loop' => '1',
				    'first_title' => '',
				    'header_type' => 'heading_7',
				    'layout' => 'right-sidebar',
				    'sidebar' => 'home-2',
				    'sticky_sidebar' => '1',
				    'module'    => '3',
				    'excerpt_length' => '20',
				    'content_date' => 'default',
				    'content_pagination' => 'nav_1',
				    'pagination_align' => 'center',
			    ),
			    '_elementor_data' => 'home2.json',
			    '_elementor_edit_mode' => 'builder',
		    )
	    ),
	    'footer' => array(
		    'title' => 'Footer',
		    'content' => 'footer.txt',
		    'post_type' => 'footer',
		    'metabox' => array(
			    '_elementor_data' => 'footer.json',
			    '_elementor_edit_mode' => 'builder',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1516873179341{padding-top: 60px !important;padding-bottom: 20px !important;}.vc_custom_1517475531648{border-top-width: 1px !important;border-bottom-width: 1px !important;border-top-color: #e0e0e0 !important;border-top-style: solid !important;border-bottom-color: #e0e0e0 !important;border-bottom-style: solid !important;}.vc_custom_1517475977261{padding-top: 40px !important;padding-bottom: 40px !important;}.vc_custom_1516871007861{border-top-width: 1px !important;padding-top: 14px !important;padding-bottom: 14px !important;border-top-color: #e0e0e0 !important;border-top-style: solid !important;}.vc_custom_1516869140758{border-top-width: 1px !important;border-bottom-width: 1px !important;border-top-color: #e0e0e0 !important;border-top-style: solid !important;border-bottom-color: #e0e0e0 !important;border-bottom-style: solid !important;}.vc_custom_1516871226747{background-image: url(https://jnews.io/fitness/wp-content/uploads/sites/36/2017/12/jnews-demo-16.jpg?id=148) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1516869695156{margin-top: 40px !important;margin-bottom: 40px !important;}.vc_custom_1516875612247{margin-bottom: 10px !important;}.vc_custom_1516874616165{margin-bottom: 40px !important;padding-right: 12% !important;padding-left: 12% !important;}.vc_custom_1516266297767{margin-bottom: 0px !important;}',
			    '_wpb_post_custom_css' => '.vc_cta3-container.vc_cta3-size-md {margin-bottom: 0;}',
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
        'categories' => array(
	        'title' => 'Categories',
	        'location' => ''
        ),
        'footer-link' => array(
	        'title' => 'Footer Links',
	        'location' => ''
        )
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
			        'menu-item-title' => 'Magazine Style',
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
			        'menu-item-title' => 'Blog Style',
			        'menu-item-parent-id' => '{{menu:home:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-2:id}}',
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
        'weight-loss' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Diets & Weight Loss',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:diets-weight-loss:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'workout' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Workout',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:workout:id}}',
		        'menu-item-status' => 'publish'
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
	        )
        ),
        'food-nutrition' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Food & Nutrition',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:food-nutrition:id}}',
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
        ),

	    // Footer Links
        'buy' => array(
	        'location' => 'footer-link',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Buy JNews',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => 'https://themeforest.net/item/jnews-wordpress-blog-news-magazine-newspaper-theme/20566392?ref=jegtheme&license=regular&open_purchase_for_item_id=20566392',
		        'menu-item-status' => 'publish'
	        )
        ),
        'landing' => array(
	        'location' => 'footer-link',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Landing Page',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => '#',
		        'menu-item-status' => 'publish'
	        )
        ),
        'main' => array(
	        'location' => 'footer-link',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Main Demo',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => '#',
		        'menu-item-status' => 'publish'
	        )
        ),
        'support' => array(
	        'location' => 'footer-link',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Support Forum',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => 'http://support.jegtheme.com/',
		        'menu-item-status' => 'publish'
	        )
        ),

	    // Categories
        'fitness-1' => array(
	        'location' => 'categories',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Fitness',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:fitness:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'diets-1' => array(
	        'location' => 'categories',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Diets & Weight Loss',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:diets-weight-loss:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'workout-1' => array(
	        'location' => 'categories',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Workout',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:workout:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'food-nutrition-1' => array(
	        'location' => 'categories',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Food & Nutrition',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:food-nutrition:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'lifestyle-1' => array(
	        'location' => 'categories',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Lifestyle',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:lifestyle:id}}',
		        'menu-item-status' => 'publish'
	        )
        )
    ),

    'widget_position' => array(
        'Home',
        'Contact',
        'Archives',
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
        'jnews-social-share',
        'jnews-view-counter'
    )
);