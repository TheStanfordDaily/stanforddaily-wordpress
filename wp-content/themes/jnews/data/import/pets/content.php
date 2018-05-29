<?php

return array(

    // image
    'image' =>  array(
	    'pet1' => 'http://jegtheme.com/asset/jnews/demo/pets/pet1.jpg',
	    'pet2' => 'http://jegtheme.com/asset/jnews/demo/pets/pet2.jpg',
	    'pet3' => 'http://jegtheme.com/asset/jnews/demo/pets/pet3.jpg',
	    'pet4' => 'http://jegtheme.com/asset/jnews/demo/pets/pet4.jpg',
	    'pet5' => 'http://jegtheme.com/asset/jnews/demo/pets/pet5.jpg',
	    'pet6' => 'http://jegtheme.com/asset/jnews/demo/pets/pet6.jpg',
	    'pet7' => 'http://jegtheme.com/asset/jnews/demo/pets/pet7.jpg',
	    'pet8' => 'http://jegtheme.com/asset/jnews/demo/pets/pet8.jpg',
	    'pet9' => 'http://jegtheme.com/asset/jnews/demo/pets/pet9.jpg',
	    'pet10' => 'http://jegtheme.com/asset/jnews/demo/pets/pet10.jpg',
	    'pet_bg' => 'http://jegtheme.com/asset/jnews/demo/pets/pet_bg.jpg',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/pets/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/pets/logo@2x.png',
        'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/pets/mobile_logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/pets/mobile_logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'behavior' => array(
                'title' => 'Behavior',
                'description' => 'You can add some category description here.'
            ),
            'breed' => array(
                'title' => 'Breed',
                'description' => 'You can add some category description here.'
            ),
                'boxer' => array(
                    'title' => 'Boxer',
                    'description' => 'You can add some category description here.',
                    'parent' => 'breed'
                ),
                'bulldog' => array(
                    'title' => 'Bulldog',
                    'description' => 'You can add some category description here.',
                    'parent' => 'breed'
                ),
                'german-shepherd' => array(
                    'title' => 'German Shepherd',
                    'description' => 'You can add some category description here.',
                    'parent' => 'breed'
                ),
                'golden-retriever' => array(
                    'title' => 'Golden Retriever',
                    'description' => 'You can add some category description here.',
                    'parent' => 'breed'
                ),
                'labrador-retriever-breed' => array(
                    'title' => 'Labrador Retriever',
                    'description' => 'You can add some category description here.',
                    'parent' => 'breed'
                ),
                'rottweiler' => array(
                    'title' => 'Rottweiler',
                    'description' => 'You can add some category description here.',
                    'parent' => 'breed'
                ),
            'culture' => array(
                'title' => 'Culture',
                'description' => 'You can add some category description here.'
            ),
            'research' => array(
                'title' => 'Research',
                'description' => 'You can add some category description here.'
            ),
            'sports' => array(
                'title' => 'Sports',
                'description' => 'You can add some category description here.'
            ),
            'tips' => array(
                'title' => 'Tips',
                'description' => 'You can add some category description here.'
            ),
            'training' => array(
                'title' => 'Training',
                'description' => 'You can add some category description here.'
            ),
            'wellness' => array(
                'title' => 'Wellness',
                'description' => 'You can add some category description here.'
            )
        ),

        'post_tag' => array(
            'adopt' => array(
                'title' => 'Adopt Not Buy',
            ),
            'dog' => array(
                'title' => 'Dog'
            ),
            'pet' => array(
                'title' => 'Dog as Pet'
            ),
            'owner' => array(
                'title' => 'Dog Owner'
            ),
            'companion' => array(
                'title' => 'Human Companion'
            ),
            'friend' => array(
                'title' => 'Human Friend'
            ),
            'mistake' => array(
                'title' => 'Owner Mistake'
            ),
            'training' => array(
                'title' => 'Train Your Dog'
            )
        )
    ),

    // post & page
    'post' => array(
        'theres-no-such-thing-as-a-good-dog' => array(
            'title' => "There's No Such Thing as a Good Dog, Only Good Owner",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet1',
            'taxonomy' => array(
                'category' => 'behavior,boxer,culture,golden-retriever,labrador-retriever-breed',
                'post_tag' => 'adopt,dog,pet,owner,companion,friend,mistake,training'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:wellness:id}}')
            )
        ),
        'family-tree-of-dogs-reveals-secret-history-of-canines' => array(
            'title' => "Research say : Family tree of dogs reveals secret history of canines",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'pet2',
            'taxonomy' => array(
                'category' => 'boxer,bulldog,labrador-retriever-breed,research',
                'post_tag' => 'dog,pet,owner,companion,mistake,training'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:wellness:id}}')
            )
        ),
        'the-key-dietary-fats-every-raw-fed-dog-needs' => array(
            'title' => "The Key Natural Dietary Fats For Every Raw Fed Dog Needs",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet3',
            'taxonomy' => array(
                'category' => 'boxer,labrador-retriever-breed,rottweiler,tips',
                'post_tag' => 'dog,pet,owner,companion,mistake,training',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:wellness:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=1jLOOCADTGs'
            )
        ),
        '6-ways-turmeric-can-benefit-your-dogs-health' => array(
            'title' => "6 Ways Turmeric Can Benefit Your Dog's Health",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'pet4',
            'taxonomy' => array(
                'category' => 'golden-retriever,tips',
                'post_tag' => 'dog,pet,owner,companion,mistake,training',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:culture:id}}'),
                '_format_gallery_images' => array(
                    '{{image:pet2:id}}',
                    '{{image:pet1:id}}',
                    '{{image:pet3:id}}',
                    '{{image:pet5:id}}',
                    '{{image:pet6:id}}',
                )
            )
        ),
        'wirral-man-jailed-24-weeks-for-burning-dog-alive' => array(
            'title' => "Wirral Man Jailed 24 Weeks for burning dog alive",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet5',
            'taxonomy' => array(
                'category' => 'behavior,bulldog,culture,labrador-retriever-breed,tips',
                'post_tag' => 'dog,pet,owner,companion,mistake,training'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:culture:id}}')
            )
        ),
        'what-do-you-do-when-your-life-partner-isnt-a-dog-person' => array(
            'title' => "What Do You Do When Your Life Partner Isn't a Dog Person?",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'pet6',
            'taxonomy' => array(
                'category' => 'behavior,german-shepherd,labrador-retriever-breed,rottweiler',
                'post_tag' => 'adopt,dog,pet,owner,friend,training'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:wellness:id}}')
            )
        ),
        'caring-for-your-senior-dog-5-important-things-to-know' => array(
            'title' => "Caring for Your Senior Dog: 5 Important Things to Know",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet7',
            'taxonomy' => array(
                'category' => 'boxer,golden-retriever,research,wellness',
                'post_tag' => 'dog,pet,owner,training',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:wellness:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=fJxgu8TtIWI'
            )
        ),
        'do-better-canine-diets-support-longer-lives' => array(
            'title' => "Do Better Canine Diets Support Longer Lives?",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'pet8',
            'taxonomy' => array(
                'category' => 'labrador-retriever-breed,research,rottweiler,wellness',
                'post_tag' => 'dog,pet,owner,training'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:wellness:id}}')
            )
        ),
        'the-top-10-talking-points-for-trainers' => array(
            'title' => "The Top 10 Talking Points for Every Dog Trainers",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet9',
            'taxonomy' => array(
                'category' => 'bulldog,golden-retriever,research,sports,training,wellness',
                'post_tag' => 'dog,pet,owner,training'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:wellness:id}}')
            )
        ),
        'dogs-make-great-exercise-partners' => array(
            'title' => "Dogs Make Great Exercise Partners",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'pet10',
            'taxonomy' => array(
                'category' => 'bulldog,golden-retriever,research,sports,training,wellness',
                'post_tag' => 'dog,pet,owner,training',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:sports:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=yTnevA1C6p8'
            )
        ),
        'frequency-of-urination-related-to-dog-body-size' => array(
            'title' => "Frequency of Urination Related to Dog Body Size",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet1',
            'taxonomy' => array(
                'category' => 'bulldog,culture,research,rottweiler,training,wellness',
                'post_tag' => 'dog,pet,owner'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:wellness:id}}')
            )
        ),
        'vaccines-and-pesticides-cause-chronic-illnesses-in-pets-too' => array(
            'title' => "Vaccines and pesticides cause chronic illnesses in pets, too",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'pet2',
            'taxonomy' => array(
                'category' => 'boxer,culture,german-shepherd,research,training,wellness',
                'post_tag' => 'dog,pet,owner'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:wellness:id}}')
            )
        ),
        'dogs-are-even-more-like-us-than-we-thought' => array(
            'title' => "Dogs Are Even More Like Us Than We Thought",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet3',
            'taxonomy' => array(
                'category' => 'behavior,german-shepherd,golden-retriever,research,sports',
                'post_tag' => 'dog,pet,owner,companion'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:behavior:id}}')
            )
        ),
        '5-essential-commands-you-can-teach-your-dog' => array(
            'title' => "5 essential commands you can teach your dog",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'pet4',
            'taxonomy' => array(
                'category' => 'culture,research,sports,tips,training',
                'post_tag' => 'adopt,dog,owner,companion,mistake',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:training:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=fNLrE3ZdVe0'
            )
        ),
        'read-your-dogs-body-language' => array(
            'title' => "How To Read Your Dog's Body Language",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet5',
            'taxonomy' => array(
                'category' => 'behavior,bulldog,culture,german-shepherd,research,tips',
                'post_tag' => 'dog,owner,companion'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:behavior:id}}')
            )
        ),
        'does-your-dog-love-you' => array(
            'title' => "25 ways you know your dog loves you more than you think",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'pet6',
            'taxonomy' => array(
                'category' => 'behavior,bulldog,labrador-retriever-breed,research,rottweiler',
                'post_tag' => 'dog,friend'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:behavior:id}}')
            )
        ),
        'so-youre-thinking-of-getting-a-siberian-husky' => array(
            'title' => "So you’re thinking of getting a Siberian Husky",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet7',
            'taxonomy' => array(
                'category' => 'german-shepherd,research,rottweiler,sports,tips,training',
                'post_tag' => 'adopt,dog,friend'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:research:id}}')
            )
        ),
        'why-dogs-make-the-best-companions' => array(
            'title' => "Why dogs make the best companions for your family",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'pet8',
            'taxonomy' => array(
                'category' => 'golden-retriever,labrador-retriever-breed,research,tips,training',
                'post_tag' => 'dog,pet,companion,friend,mistake'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:training:id}}')
            )
        ),
        'common-mistakes-of-first-time-pet-owners' => array(
            'title' => "Common mistakes of first-time dog & cat owners",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet9',
            'taxonomy' => array(
                'category' => 'behavior,boxer,bulldog,culture,research,sports,tips',
                'post_tag' => 'adopt,pet,owner,friend,mistake'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:behavior:id}}')
            )
        ),
        'tips-for-couples-adopting-a-dog' => array(
            'title' => "How to Bring a Newly Adopted Dog to your Home",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'pet10',
            'taxonomy' => array(
                'category' => 'behavior,culture,german-shepherd,research,rottweiler,sports',
                'post_tag' => 'adopt,dog'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:behavior:id}}')
            )
        ),
        'how-to-choose-the-best-dog-for-your-kids' => array(
            'title' => "How to choose the best dog for your kids & family",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'pet1',
            'taxonomy' => array(
                'category' => 'behavior,culture',
                'post_tag' => 'adopt,dog,friend,mistake'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:behavior:id}}')
            )
        ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1497262857989{margin-right: 0px !important;margin-bottom: 40px !important;margin-left: 0px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 40px !important;background: #d6d6d6 url({{image:pet_bg:url:full}}) !important;border-top-color: #f2f2f2 !important;border-top-style: solid !important;border-bottom-color: #f2f2f2 !important;border-bottom-style: solid !important;}.vc_custom_1493453064886{padding-top: 80px !important;padding-right: 120px !important;padding-bottom: 80px !important;padding-left: 120px !important;}.vc_custom_1493452996290{background-color: rgba(255,255,255,0.51) !important;*background-color: rgb(255,255,255) !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-1',
                    'module'    => '5',
                    'excerpt_length' => '25',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                'jnews_video_cache' => array(
                    'SfLV8hD7zX4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=SfLV8hD7zX4',
                        'id' => 'SfLV8hD7zX4',
                        'title' => 'Jealous Dog Want Attention Compilation NEW',
                        'thumbnail' => 'https://i.ytimg.com/vi/SfLV8hD7zX4/default.jpg',
                        'duration' => '00:06:28'
                    ),
                    'j5PLngd2WN0' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=j5PLngd2WN0',
                        'id' => 'j5PLngd2WN0',
                        'title' => 'Best Of Funny Guilty Dog Compilation 2014',
                        'thumbnail' => 'https://i.ytimg.com/vi/j5PLngd2WN0/default.jpg',
                        'duration' => '00:05:32'
                    ),
                    'fdnM6u4sKKY' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=fdnM6u4sKKY',
                        'id' => 'fdnM6u4sKKY',
                        'title' => 'Dog Protecting Baby Dog is not only a pet but also a good friend',
                        'thumbnail' => 'https://i.ytimg.com/vi/fdnM6u4sKKY/default.jpg',
                        'duration' => '00:08:02'
                    ),
                    '1kgmfPClsZc' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=1kgmfPClsZc',
                        'id' => '1kgmfPClsZc',
                        'title' => 'Best Dog Birthday Surprise: DIY Ball Pit for Maymo',
                        'thumbnail' => 'https://i.ytimg.com/vi/1kgmfPClsZc/default.jpg',
                        'duration' => '00:01:39'
                    ),
                    'JDZ1K79ie64' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=JDZ1K79ie64',
                        'id' => 'JDZ1K79ie64',
                        'title' => 'How a little microchip changed this dog\'s life!!!  Please share this important video.',
                        'thumbnail' => 'https://i.ytimg.com/vi/JDZ1K79ie64/default.jpg',
                        'duration' => '00:05:48'
                    ),
                    'CKz_Ndak1u4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=CKz_Ndak1u4',
                        'id' => 'CKz_Ndak1u4',
                        'title' => '20 Most Luxurious Dog Houses',
                        'thumbnail' => 'https://i.ytimg.com/vi/CKz_Ndak1u4/default.jpg',
                        'duration' => '00:07:45'
                    )
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1497262857989{margin-right: 0px !important;margin-bottom: 40px !important;margin-left: 0px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 40px !important;background: #d6d6d6 url({{image:pet_bg:url:full}}) !important;border-top-color: #f2f2f2 !important;border-top-style: solid !important;border-bottom-color: #f2f2f2 !important;border-bottom-style: solid !important;}.vc_custom_1493453064886{padding-top: 80px !important;padding-right: 120px !important;padding-bottom: 80px !important;padding-left: 120px !important;}.vc_custom_1493452996290{background-color: rgba(255,255,255,0.51) !important;*background-color: rgb(255,255,255) !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493273163896{margin-bottom: 40px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 40px !important;background-color: #f2f2f2 !important;border-top-color: #e8e8e8 !important;border-top-style: solid !important;border-bottom-color: #e8e8e8 !important;border-bottom-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'no-sidebar',
                    'module'    => '23',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                'jnews_video_cache' => array(
                    'SfLV8hD7zX4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=SfLV8hD7zX4',
                        'id' => 'SfLV8hD7zX4',
                        'title' => 'Jealous Dog Want Attention Compilation NEW',
                        'thumbnail' => 'https://i.ytimg.com/vi/SfLV8hD7zX4/default.jpg',
                        'duration' => '00:06:28'
                    ),
                    'j5PLngd2WN0' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=j5PLngd2WN0',
                        'id' => 'j5PLngd2WN0',
                        'title' => 'Best Of Funny Guilty Dog Compilation 2014',
                        'thumbnail' => 'https://i.ytimg.com/vi/j5PLngd2WN0/default.jpg',
                        'duration' => '00:05:32'
                    ),
                    'fdnM6u4sKKY' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=fdnM6u4sKKY',
                        'id' => 'fdnM6u4sKKY',
                        'title' => 'Dog Protecting Baby Dog is not only a pet but also a good friend',
                        'thumbnail' => 'https://i.ytimg.com/vi/fdnM6u4sKKY/default.jpg',
                        'duration' => '00:08:02'
                    ),
                    '1kgmfPClsZc' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=1kgmfPClsZc',
                        'id' => '1kgmfPClsZc',
                        'title' => 'Best Dog Birthday Surprise: DIY Ball Pit for Maymo',
                        'thumbnail' => 'https://i.ytimg.com/vi/1kgmfPClsZc/default.jpg',
                        'duration' => '00:01:39'
                    ),
                    'JDZ1K79ie64' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=JDZ1K79ie64',
                        'id' => 'JDZ1K79ie64',
                        'title' => 'How a little microchip changed this dog\'s life!!!  Please share this important video.',
                        'thumbnail' => 'https://i.ytimg.com/vi/JDZ1K79ie64/default.jpg',
                        'duration' => '00:05:48'
                    ),
                    'CKz_Ndak1u4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=CKz_Ndak1u4',
                        'id' => 'CKz_Ndak1u4',
                        'title' => '20 Most Luxurious Dog Houses',
                        'thumbnail' => 'https://i.ytimg.com/vi/CKz_Ndak1u4/default.jpg',
                        'duration' => '00:07:45'
                    )
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493273163896{margin-bottom: 40px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 40px !important;background-color: #f2f2f2 !important;border-top-color: #e8e8e8 !important;border-top-style: solid !important;border-bottom-color: #e8e8e8 !important;border-bottom-style: solid !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1493273163896{margin-bottom: 40px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 40px !important;background-color: #f2f2f2 !important;border-top-color: #e8e8e8 !important;border-top-style: solid !important;border-bottom-color: #e8e8e8 !important;border-bottom-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-1',
                    'module'    => '5',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                'jnews_video_cache' => array(
                    'SfLV8hD7zX4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=SfLV8hD7zX4',
                        'id' => 'SfLV8hD7zX4',
                        'title' => 'Jealous Dog Want Attention Compilation NEW',
                        'thumbnail' => 'https://i.ytimg.com/vi/SfLV8hD7zX4/default.jpg',
                        'duration' => '00:06:28'
                    ),
                    'j5PLngd2WN0' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=j5PLngd2WN0',
                        'id' => 'j5PLngd2WN0',
                        'title' => 'Best Of Funny Guilty Dog Compilation 2014',
                        'thumbnail' => 'https://i.ytimg.com/vi/j5PLngd2WN0/default.jpg',
                        'duration' => '00:05:32'
                    ),
                    'fdnM6u4sKKY' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=fdnM6u4sKKY',
                        'id' => 'fdnM6u4sKKY',
                        'title' => 'Dog Protecting Baby Dog is not only a pet but also a good friend',
                        'thumbnail' => 'https://i.ytimg.com/vi/fdnM6u4sKKY/default.jpg',
                        'duration' => '00:08:02'
                    ),
                    '1kgmfPClsZc' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=1kgmfPClsZc',
                        'id' => '1kgmfPClsZc',
                        'title' => 'Best Dog Birthday Surprise: DIY Ball Pit for Maymo',
                        'thumbnail' => 'https://i.ytimg.com/vi/1kgmfPClsZc/default.jpg',
                        'duration' => '00:01:39'
                    ),
                    'JDZ1K79ie64' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=JDZ1K79ie64',
                        'id' => 'JDZ1K79ie64',
                        'title' => 'How a little microchip changed this dog\'s life!!!  Please share this important video.',
                        'thumbnail' => 'https://i.ytimg.com/vi/JDZ1K79ie64/default.jpg',
                        'duration' => '00:05:48'
                    ),
                    'CKz_Ndak1u4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=CKz_Ndak1u4',
                        'id' => 'CKz_Ndak1u4',
                        'title' => '20 Most Luxurious Dog Houses',
                        'thumbnail' => 'https://i.ytimg.com/vi/CKz_Ndak1u4/default.jpg',
                        'duration' => '00:07:45'
                    )
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1493273163896{margin-bottom: 40px !important;border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 40px !important;background-color: #f2f2f2 !important;border-top-color: #e8e8e8 !important;border-top-style: solid !important;border-bottom-color: #e8e8e8 !important;border-bottom-style: solid !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                'jnews_video_cache' => array(
                    'SfLV8hD7zX4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=SfLV8hD7zX4',
                        'id' => 'SfLV8hD7zX4',
                        'title' => 'Jealous Dog Want Attention Compilation NEW',
                        'thumbnail' => 'https://i.ytimg.com/vi/SfLV8hD7zX4/default.jpg',
                        'duration' => '00:06:28'
                    ),
                    'j5PLngd2WN0' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=j5PLngd2WN0',
                        'id' => 'j5PLngd2WN0',
                        'title' => 'Best Of Funny Guilty Dog Compilation 2014',
                        'thumbnail' => 'https://i.ytimg.com/vi/j5PLngd2WN0/default.jpg',
                        'duration' => '00:05:32'
                    ),
                    'fdnM6u4sKKY' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=fdnM6u4sKKY',
                        'id' => 'fdnM6u4sKKY',
                        'title' => 'Dog Protecting Baby Dog is not only a pet but also a good friend',
                        'thumbnail' => 'https://i.ytimg.com/vi/fdnM6u4sKKY/default.jpg',
                        'duration' => '00:08:02'
                    ),
                    '1kgmfPClsZc' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=1kgmfPClsZc',
                        'id' => '1kgmfPClsZc',
                        'title' => 'Best Dog Birthday Surprise: DIY Ball Pit for Maymo',
                        'thumbnail' => 'https://i.ytimg.com/vi/1kgmfPClsZc/default.jpg',
                        'duration' => '00:01:39'
                    ),
                    'JDZ1K79ie64' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=JDZ1K79ie64',
                        'id' => 'JDZ1K79ie64',
                        'title' => 'How a little microchip changed this dog\'s life!!!  Please share this important video.',
                        'thumbnail' => 'https://i.ytimg.com/vi/JDZ1K79ie64/default.jpg',
                        'duration' => '00:05:48'
                    ),
                    'CKz_Ndak1u4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=CKz_Ndak1u4',
                        'id' => 'CKz_Ndak1u4',
                        'title' => '20 Most Luxurious Dog Houses',
                        'thumbnail' => 'https://i.ytimg.com/vi/CKz_Ndak1u4/default.jpg',
                        'duration' => '00:07:45'
                    )
                ),
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
                '_wpb_shortcodes_custom_css' => '.vc_custom_1500979435512{margin-right: 0px !important;margin-bottom: 40px !important;margin-left: 0px !important;background-image: url({{image:pet_bg:url:full}}) !important;}.vc_custom_1493456483174{padding-top: 80px !important;padding-right: 120px !important;padding-bottom: 80px !important;padding-left: 120px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest Post',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-3',
                    'module'    => '5',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                'jnews_video_cache' => array(
                    'SfLV8hD7zX4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=SfLV8hD7zX4',
                        'id' => 'SfLV8hD7zX4',
                        'title' => 'Jealous Dog Want Attention Compilation NEW',
                        'thumbnail' => 'https://i.ytimg.com/vi/SfLV8hD7zX4/default.jpg',
                        'duration' => '00:06:28'
                    ),
                    'j5PLngd2WN0' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=j5PLngd2WN0',
                        'id' => 'j5PLngd2WN0',
                        'title' => 'Best Of Funny Guilty Dog Compilation 2014',
                        'thumbnail' => 'https://i.ytimg.com/vi/j5PLngd2WN0/default.jpg',
                        'duration' => '00:05:32'
                    ),
                    'fdnM6u4sKKY' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=fdnM6u4sKKY',
                        'id' => 'fdnM6u4sKKY',
                        'title' => 'Dog Protecting Baby Dog is not only a pet but also a good friend',
                        'thumbnail' => 'https://i.ytimg.com/vi/fdnM6u4sKKY/default.jpg',
                        'duration' => '00:08:02'
                    ),
                    '1kgmfPClsZc' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=1kgmfPClsZc',
                        'id' => '1kgmfPClsZc',
                        'title' => 'Best Dog Birthday Surprise: DIY Ball Pit for Maymo',
                        'thumbnail' => 'https://i.ytimg.com/vi/1kgmfPClsZc/default.jpg',
                        'duration' => '00:01:39'
                    ),
                    'JDZ1K79ie64' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=JDZ1K79ie64',
                        'id' => 'JDZ1K79ie64',
                        'title' => 'How a little microchip changed this dog\'s life!!!  Please share this important video.',
                        'thumbnail' => 'https://i.ytimg.com/vi/JDZ1K79ie64/default.jpg',
                        'duration' => '00:05:48'
                    ),
                    'CKz_Ndak1u4' => array(
                        'type' => 'youtube',
                        'url' => 'https://www.youtube.com/watch?v=CKz_Ndak1u4',
                        'id' => 'CKz_Ndak1u4',
                        'title' => '20 Most Luxurious Dog Houses',
                        'thumbnail' => 'https://i.ytimg.com/vi/CKz_Ndak1u4/default.jpg',
                        'duration' => '00:07:45'
                    )
                ),
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1500979435512{margin-right: 0px !important;margin-bottom: 40px !important;margin-left: 0px !important;background-image: url({{image:pet_bg:url:full}}) !important;}.vc_custom_1493456483174{padding-top: 80px !important;padding-right: 120px !important;padding-bottom: 80px !important;padding-left: 120px !important;}'
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
        'dog-breed' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Dog Breed',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:breed:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_2',
                    'category' => '{{category:breed:id}}',
                    'number' => 6,
                    'trending_tag' => '{{taxonomy:post_tag:companion:id}},{{taxonomy:post_tag:owner:id}},{{taxonomy:post_tag:training:id}},{{taxonomy:post_tag:adopt:id}}'
                ),
            )
        ),
        'heath-wellness' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Heath & Wellness',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:wellness:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:wellness:id}}',
                    'number' => 9
                ),
            )
        ),
        'behavior' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Pet Behavior',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:behavior:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:behavior:id}}',
                    'number' => 9
                ),
            )
        ),
        'more' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'More',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
            'tips' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Tips',
                    'menu-item-parent-id' => '{{menu:more:id}}',
                    'menu-item-type' => 'taxonomy',
                    'menu-item-object' => 'category',
                    'menu-item-object-id' => '{{category:tips:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'research' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Research',
                    'menu-item-parent-id' => '{{menu:more:id}}',
                    'menu-item-type' => 'taxonomy',
                    'menu-item-object' => 'category',
                    'menu-item-object-id' => '{{category:research:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
            'training' => array(
                'location' => 'main-navigation',
                'menu-item-data' => array(
                    'menu-item-title' => 'Training',
                    'menu-item-parent-id' => '{{menu:more:id}}',
                    'menu-item-type' => 'taxonomy',
                    'menu-item-object' => 'category',
                    'menu-item-object-id' => '{{category:training:id}}',
                    'menu-item-status' => 'publish'
                )
            ),
        'shop' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Shop',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
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
        'Home 1',
        'Category Widget',
        'Home 3',
        'Product List',
        'Home 4'
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
        'jnews-view-counter',
        'jnews-weather',
        'mailchimp-for-wp'
    )

);