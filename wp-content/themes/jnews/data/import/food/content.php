<?php

return array(

    // image
    'image' =>  array(
        'food1' => 'http://jegtheme.com/asset/jnews/demo/food/food1.jpg',
        'food2' => 'http://jegtheme.com/asset/jnews/demo/food/food2.jpg',
        'food3' => 'http://jegtheme.com/asset/jnews/demo/food/food3.jpg',
        'food4' => 'http://jegtheme.com/asset/jnews/demo/food/food4.jpg',
        'food5' => 'http://jegtheme.com/asset/jnews/demo/food/food5.jpg',
        'food6' => 'http://jegtheme.com/asset/jnews/demo/food/food6.jpg',
        'food7' => 'http://jegtheme.com/asset/jnews/demo/food/food7.jpg',
        'food8' => 'http://jegtheme.com/asset/jnews/demo/food/food8.jpg',
        'food9' => 'http://jegtheme.com/asset/jnews/demo/food/food9.jpg',
        'food10' => 'http://jegtheme.com/asset/jnews/demo/food/food10.jpg',
        'food11' => 'http://jegtheme.com/asset/jnews/demo/food/food11.jpg',
        'food12' => 'http://jegtheme.com/asset/jnews/demo/food/food12.jpg',
        'fashion2' => 'http://jegtheme.com/asset/jnews/demo/default/fashion2.jpg',
        'pattern' => 'http://jegtheme.com/asset/jnews/demo/food/pattern.png',
        'midbar_bg' => 'http://jegtheme.com/asset/jnews/demo/food/midbar_bg.jpg',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/food/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/food/logo@2x.png',
        'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/food/mobile_logo.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/food/mobile_logo@2x.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'breakfast' =>
                array(
                    'title' => 'Breakfast',
                ),
            'dinner' =>
                array(
                    'title' => 'Dinner',
                ),
            'drink' =>
                array(
                    'title' => 'Drink',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
                ),
            'recipe' =>
                array(
                    'title' => 'Recipe',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
                ),
            'restaurant' =>
                array(
                    'title' => 'Restaurant',
                ),
            'street-food' =>
                array(
                    'title' => 'Street Food',
                    'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
                ),
            'vegetarian' =>
                array(
                    'title' => 'Vegetarian',
                ),
        ),

        'post_tag' => array(
            'bakery' => array(
                'title' => 'Bakery',
            ),
            'brunch' => array(
                'title' => 'Brunch',
            ),
            'cafe' => array(
                'title' => 'Cafe',
            ),
            'cake' => array(
                'title' => 'Cake',
            ),
            'chicken' => array(
                'title' => 'Chicken',
            ),
            'coffee' => array(
                'title' => 'Coffee',
            ),
            'gluten-free' => array(
                'title' => 'Gluten Free',
            ),
            'mint' => array(
                'title' => 'Mint',
            ),
            'raspberry' => array(
                'title' => 'Raspberry',
            ),
            'red-pepper' => array(
                'title' => 'Red Pepper',
            ),
            'rice' => array(
                'title' => 'Rice',
            ),
            'vegan' => array(
                'title' => 'Vegan',
            ),
        )
    ),

    // post & page
    'post' => array(
        'raspberry-mint-lemonade-recipe' => array(
            'title' => "Raspberry Mint Lemonade Recipe",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'food4',
            'taxonomy' => array(
                'category' => 'breakfast,dinner,drink,recipe',
                'post_tag' => 'brunch,cafe,coffee,mint,raspberry,red-pepper'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:drink:id}}'),
                'enable_food_recipe' => '1',
                'jnews_food_recipe' => array(
                    'enable_food_recipe' => '1',
                    'food_recipe_title' => 'Raspberry Mint Lemonade',
                    'food_recipe_serve' => '2 people',
                    'food_recipe_time' => '15',
                    'food_recipe_prep' => '5',
                    'food_recipe_level' => 'Easy',
                    'enable_print_recipe' => '1',
                    'ingredient' => array(
                        array('item' => '1/2 pint raspberries'),
                        array('item' => '1/2 cup sugar'),
                        array('item' => '1/4 cup fresh mint leaves'),
                        array('item' => '2/3 cup fresh lemon juice plus slices for garnish'),
                        array('item' => 'Chilled vodka, optional'),
                    ),
                    'instruction' => '<ol class="recipe-list recipe-directions-list">
                                        <li class="recipe-directions-item">Combine sugar and 1/2 cup water in a small saucepan. Cook over medium heat, stirring, just until the sugar melts, 2 to 3 minutes.</li>
                                        <li class="recipe-directions-item">Place raspberries and mint leaves in a pitcher. Using the end of a spoon or a muddler, crush until pulpy and smashed. Add lemon juice, simple syrup, and 3 cups water, and stir to combine. Add enough ice to fill the pitcher.</li>
                                        <li class="recipe-directions-item">Serve over ice garnished with mint sprigs and lemon slices. Add vodka, if desired.</li>
                                        <li class="recipe-directions-item">It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.</li>
                                    </ol>
                                    <strong>Notes</strong>: <em>Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. Above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. </em>'
                )
            )
        ),
        'new-recipe-pasta-with-creamy-kale-sauce' => array(
            'title' => "New Recipe Pasta with Creamy Kale Sauce",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'food5',
            'taxonomy' => array(
                'category' => 'breakfast,dinner,recipe,vegetarian',
                'post_tag' => 'bakery,brunch,cafe,cake,mint,raspberry,vegan',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:street-food:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=6N4gEJ_ED98',
                'enable_food_recipe' => '1',
                'jnews_food_recipe' => array(
                    'enable_food_recipe' => '1',
                    'food_recipe_title' => 'Pasta with Creamy Kale Sauce',
                    'food_recipe_serve' => '4 peoples',
                    'food_recipe_time' => '30',
                    'food_recipe_prep' => '10',
                    'food_recipe_level' => 'Easy',
                    'enable_print_recipe' => '1',
                    'ingredient' => array(
                        array('item' => '12-ounces of whatever kind of pasta you like!'),
                        array('item' => '3-4 cups shredded kale'),
                        array('item' => '1 tablespoon olive oil'),
                        array('item' => '2 cloves garlic, minced'),
                        array('item' => 'Salt to taste'),
                        array('item' => 'Squeeze of lemon juice if you have it'),
                    ),
                    'instruction' => '<ol>
                                        <li>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</li>
                                        <li>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</li>
                                        <li>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</li>
                                        <li>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</li>
                                        <li>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</li>
                                        <li>She packed her seven versalia, put her initial into the belt and made herself on the way.</li>
                                    </ol>
                                    <div class="alert alert-warning"><strong>Notes:</strong> Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. Above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</div>'
                )
            )
        ),
        'spicy-crispy-pomegranate-chicken' => array(
            'title' => "Spicy Crispy Pomegranate Chicken",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'food6',
            'taxonomy' => array(
                'category' => 'breakfast,dinner,recipe,restaurant,vegetarian',
                'post_tag' => 'brunch,chicken,rice,vegan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:dinner:id}}'),
                'enable_food_recipe' => '1',
                'jnews_single_post' => array(
                    'override_template' => '1',
                    'override' => array(
                        array(
                            'template' => '4',
                            'parallax' => '1',
                            'fullscreen' => '0',
                            'layout' => 'right-sidebar',
                            'sidebar' => 'default-sidebar',
                            'share_position' => '',
                            'share_float_style' => 'share-monocrhome',
                            'show_share_counter' => '1',
                            'show_view_counter' => '1',
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
                ),
                'jnews_food_recipe' => array(
                    'enable_food_recipe' => '1',
                    'food_recipe_title' => 'Spicy Crispy Pomegranate Chicken',
                    'food_recipe_serve' => '2 peoples',
                    'food_recipe_time' => '45',
                    'food_recipe_prep' => '10',
                    'food_recipe_level' => 'Moderate',
                    'enable_print_recipe' => '1',
                    'ingredient' => array(
                        array('item' => '2 pounds chicken wings'),
                        array('item' => '1½ teaspoons garlic powder'),
                        array('item' => '1 cup flour'),
                        array('item' => '1 teaspoon cayenne pepper'),
                        array('item' => '1½ cups pomegranate juice'),
                        array('item' => '1¼ teaspoons sriracha'),
                        array('item' => '2 garlic cloves, smashed'),
                    ),
                    'instruction' => '<ol>
                                        <li>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</li>
                                        <li>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</li>
                                        <li>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</li>
                                        <li>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</li>
                                        <li>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</li>
                                        <li>She packed her seven versalia, put her initial into the belt and made herself on the way.</li>
                                    </ol>
                                    <div class="alert alert-warning"><strong>Notes:</strong> Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. Above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</div>'
                )
            )
        ),
        'steak-baso-butter-lobster-sandwich' => array(
            'title' => "Steak & Baso Butter Lobster Sandwich",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'food1',
            'taxonomy' => array(
                'category' => 'breakfast,dinner,restaurant,vegetarian',
                'post_tag' => 'bakery,brunch,chicken,mint,raspberry,rice'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:dinner:id}}'),
                'jnews_single_post' => array(
                    'override_template' => '1',
                    'override' => array(
                        array(
                            'template' => '10',
                            'parallax' => '1',
                            'fullscreen' => '0',
                            'layout' => 'no-sidebar-narrow',
                            'sidebar' => 'default-sidebar',
                            'share_position' => 'bottom',
                            'share_float_style' => 'share-monocrhome',
                            'show_share_counter' => '1',
                            'show_view_counter' => '1',
                            'show_post_meta' => '1',
                            'show_post_author' => '1',
                            'show_post_author_image' => '1',
                            'show_post_date' => '1',
                            'show_post_category' => '0',
                            'show_post_tag' => '1',
                            'show_prev_next_post' => '0',
                            'show_popup_post' => '1',
                            'show_author_box' => '1',
                            'show_post_related' => '1',
                        )
                    )
                ),
                'enable_food_recipe' => '1',
                'jnews_food_recipe' => array(
                    'enable_food_recipe' => '1',
                    'food_recipe_title' => 'Steak & Baso Butter Lobster Sandwich',
                    'food_recipe_serve' => '4',
                    'food_recipe_time' => '30',
                    'food_recipe_prep' => '5',
                    'food_recipe_level' => 'Easy',
                    'enable_print_recipe' => '1',
                    'ingredient' => array(
                        array('item' => '4 cooked lobsters or 4 lobster tails'),
                        array('item' => '1/2 cup mayonnaise'),
                        array('item' => '2 inner celery stalks and leaves, finely chopped'),
                        array('item' => 'Salt and freshly ground black pepper'),
                        array('item' => '4 rolls, split and lightly toasted'),
                        array('item' => '2 tablespoons chopped fresh parsley leaves'),
                    ),
                    'instruction' => '<ol>
                                        <li>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</li>
                                        <li>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</li>
                                        <li>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</li>
                                        <li>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</li>
                                        <li>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</li>
                                        <li>She packed her seven versalia, put her initial into the belt and made herself on the way.</li>
                                    </ol>
                                    <div class="alert alert-warning"><strong>Notes:</strong> Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. Above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</div>'
                )
            )
        ),
        'fresh-vegan-granola-bites-recipe' => array(
            'title' => "Fresh Vegan Granola Bites Recipe",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'food2',
            'taxonomy' => array(
                'category' => 'dinner,recipe,vegetarian',
                'post_tag' => 'cake,chicken,gluten-free,mint,raspberry,vegan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:vegetarian:id}}'),
                'enable_food_recipe' => '1',
                'jnews_food_recipe' => array(
                    'enable_food_recipe' => '1',
                    'food_recipe_title' => 'Fresh Vegan Granola Bites',
                    'food_recipe_serve' => '2 peoples',
                    'food_recipe_time' => '25',
                    'food_recipe_prep' => '10',
                    'food_recipe_level' => 'Easy',
                    'enable_print_recipe' => '1',
                    'ingredient' => array(
                        array('item' => '1 cup shredded coconut'),
                        array('item' => '1/3 cup almonds, sliced'),
                        array('item' => '2 tablespoon flax meal'),
                        array('item' => '1 teaspoon cinnamon'),
                        array('item' => '1/2 cup almond butter'),
                        array('item' => '1/3 cup coconut nectar or maple syrup'),
                        array('item' => '1/4 cup water'),
                    ),
                    'instruction' => '<ol>
                                        <li>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</li>
                                        <li>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</li>
                                        <li>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</li>
                                        <li>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</li>
                                        <li>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</li>
                                        <li>She packed her seven versalia, put her initial into the belt and made herself on the way.</li>
                                    </ol>
                                    <div class="alert alert-warning"><strong>Notes:</strong> Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. Above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</div>'
                )
            )
        ),
        'mediterranean-rice-bowls-with-red-pepper-sauce' => array(
            'title' => "Mediterranean Rice Bowls with Red Pepper Sauce",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'food3',
            'taxonomy' => array(
                'category' => 'breakfast,dinner,recipe',
                'post_tag' => 'cafe,coffee,red-pepper,rice'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:dinner:id}}'),
                'enable_food_recipe' => '1',
                'jnews_food_recipe' => array(
                    'enable_food_recipe' => '1',
                    'food_recipe_title' => 'Mediterranean Rice Bowls with Red Pepper Sauce',
                    'food_recipe_serve' => '2 peoples',
                    'food_recipe_time' => '30',
                    'food_recipe_prep' => '10',
                    'food_recipe_level' => 'Easy',
                    'enable_print_recipe' => '1',
                    'ingredient' => array(
                        array('item' => 'spinach, kale, or cucumber'),
                        array('item' => '1 ounce jar roasted red peppers, draine'),
                        array('item' => 'fresh basil or parsley'),
                        array('item' => 'olive oil, lemon juice, salt, pepper'),
                        array('item' => '½ teaspoon salt (more to taste)'),
                        array('item' => '½ cup almonds'),
                    ),
                    'instruction' => '<ol>
                                        <li>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</li>
                                        <li>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</li>
                                        <li>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</li>
                                        <li>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</li>
                                        <li>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</li>
                                        <li>She packed her seven versalia, put her initial into the belt and made herself on the way.</li>
                                    </ol>
                                    <div class="alert alert-warning"><strong>Notes:</strong> Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. Above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</div>'
                )
            )
        ),
        'caramelized-pear-chocolate-cake' => array(
            'title' => "Caramelized Pear Chocolate Cake",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'food10',
            'taxonomy' => array(
                'category' => 'breakfast,recipe,restaurant,vegetarian',
                'post_tag' => 'bakery,cake,red-pepper,rice',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:vegetarian:id}}'),
                '_format_gallery_images' => array(
                    '{{image:food7:id}}',
                    '{{image:food8:id}}',
                    '{{image:food9:id}}',
                    '{{image:food10:id}}',
                    '{{image:food11:id}}',
                ),
                'enable_food_recipe' => '1',
                'jnews_food_recipe' => array(
                    'enable_food_recipe' => '1',
                    'food_recipe_title' => 'Caramelized Pear Chocolate Cake',
                    'food_recipe_serve' => '3 peoples',
                    'food_recipe_time' => '30',
                    'food_recipe_prep' => '5',
                    'food_recipe_level' => 'Moderate',
                    'enable_print_recipe' => '1',
                    'ingredient' => array(
                        array('item' => '1-1/2 cups unbleached all-purpose flour'),
                        array('item' => '2 large eggs'),
                        array('item' => '1 cup packed light brown sugar'),
                        array('item' => '1/2 cup whole milk'),
                        array('item' => ' 2/3 cup fresh lemon juice plus slices for garnish'),
                        array('item' => ' Chilled vodka, optional'),
                    ),
                    'instruction' => '<ol class="recipe-list recipe-directions-list">
                                        <li class="recipe-directions-item">Combine sugar and 1/2 cup water in a small saucepan. Cook over medium heat, stirring, just until the sugar melts, 2 to 3 minutes.</li>
                                        <li class="recipe-directions-item">Place raspberries and mint leaves in a pitcher. Using the end of a spoon or a muddler, crush until pulpy and smashed. Add lemon juice, simple syrup, and 3 cups water, and stir to combine. Add enough ice to fill the pitcher.</li>
                                        <li class="recipe-directions-item">Serve over ice garnished with mint sprigs and lemon slices. Add vodka, if desired.</li>
                                        <li class="recipe-directions-item">It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.</li>
                                    </ol>
                                    <strong>Notes</strong>: <em>Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. Above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. </em>'
                )
            )
        ),
        'mushroom-pasta-with-melted-cheese' => array(
            'title' => "Mushroom Pasta with Melted Cheese",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'food11',
            'taxonomy' => array(
                'category' => 'drink,recipe,street-food,vegetarian',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:street-food:id}}'),
                'enable_food_recipe' => '1',
                'jnews_food_recipe' => array(
                    'enable_food_recipe' => '1',
                    'food_recipe_title' => 'Mushroom Pasta with Melted Cheese',
                    'food_recipe_serve' => '4 peoples',
                    'food_recipe_time' => '30',
                    'food_recipe_prep' => '5',
                    'food_recipe_level' => 'Easy',
                    'enable_print_recipe' => '1',
                    'ingredient' => array(
                        array('item' => 'spinach, kale, or cucumber'),
                        array('item' => '1 ounce jar roasted red peppers, draine'),
                        array('item' => '1 ounce jar roasted red peppers, draine'),
                        array('item' => 'olive oil, lemon juice, salt, pepper'),
                        array('item' => '½ cup almonds'),
                        array('item' => '½ teaspoon salt (more to taste)'),
                    ),
                    'instruction' => '<ol class="recipe-list recipe-directions-list">
                                        <li class="recipe-directions-item">Combine sugar and 1/2 cup water in a small saucepan. Cook over medium heat, stirring, just until the sugar melts, 2 to 3 minutes.</li>
                                        <li class="recipe-directions-item">Place raspberries and mint leaves in a pitcher. Using the end of a spoon or a muddler, crush until pulpy and smashed. Add lemon juice, simple syrup, and 3 cups water, and stir to combine. Add enough ice to fill the pitcher.</li>
                                        <li class="recipe-directions-item">Serve over ice garnished with mint sprigs and lemon slices. Add vodka, if desired.</li>
                                        <li class="recipe-directions-item">It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.</li>
                                    </ol>
                                    <strong>Notes</strong>: <em>Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. Above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. </em>'
                )
            )
        ),
        'balinese-street-foods-you-need-to-try' => array(
            'title' => "Balinese Street Foods You Need to Try",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'food12',
            'taxonomy' => array(
                'category' => 'breakfast,dinner,restaurant,street-food',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:street-food:id}}')
            )
        ),
        'cofeeto-a-mint-mojito-with-coffee' => array(
            'title' => "Cofeeto: A Mint Mojito with Coffee",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'food7',
            'taxonomy' => array(
                'category' => 'breakfast,drink,restaurant,street-food',
                'post_tag' => 'brunch,cafe,coffee',
                'post_format' => 'post-format-video'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:drink:id}}'),
                '_format_video_embed' => 'https://www.youtube.com/watch?v=6N4gEJ_ED98'
            )
        ),
        'spicy-asian-salad-with-avocado-dressing' => array(
            'title' => "Spicy Asian Salad with Avocado Dressing",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'food8',
            'taxonomy' => array(
                'category' => 'breakfast,recipe,vegetarian',
                'post_tag' => 'brunch,gluten-free,vegan'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:breakfast:id}}')
            )
        ),
        'easy-summer-refreshing-cocktail' => array(
            'title' => "Easy Summer Refreshing Cocktail",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'food9',
            'taxonomy' => array(
                'category' => 'dinner,drink,restaurant,street-food',
                'post_tag' => 'cafe,coffee,red-pepper,rice'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:drink:id}}')
            )
        ),
        'japanese-coconut-curry-braised-pork-thighs' => array(
            'title' => "Japanese Coconut Curry Braised Pork Thighs",
            'content' => 'post1.txt',
            'post_type' => 'post',
            'featured_image' => 'food4',
            'taxonomy' => array(
                'category' => 'breakfast,dinner,recipe,restaurant',
                'post_tag' => 'bakery,brunch,cake,chicken,gluten-free',
                'post_format' => 'post-format-gallery'
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:street-food:id}}'),
                '_format_gallery_images' => array(
                    '{{image:food7:id}}',
                    '{{image:food8:id}}',
                    '{{image:food9:id}}',
                    '{{image:food10:id}}',
                    '{{image:food11:id}}',
                ),
            )
        ),
        'bacon-and-caramelized-banana-pie' => array(
            'title' => "Bacon and Caramelized Banana Pie",
            'content' => 'post2.txt',
            'post_type' => 'post',
            'featured_image' => 'food5',
            'taxonomy' => array(
                'category' => 'breakfast,recipe,restaurant,vegetarian',
                'post_tag' => ''
            ),
            'metabox' => array(
                'jnews_primary_category' => array('id' => '{{category:breakfast:id}}')
            )
        ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1489224388121{padding: 25px !important;background-color: #f5f5f5 !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'header_type' => 'heading_6',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '10',
                    'excerpt_length' => '32',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',   
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1489224388121{padding: 25px !important;background-color: #f5f5f5 !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'Home 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1489391035570{border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 30px !important;padding-bottom: 30px !important;border-top-color: #d8dbe2 !important;border-top-style: solid !important;border-bottom-color: #d8dbe2 !important;border-bottom-style: solid !important;}',
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1489391035570{border-top-width: 1px !important;border-bottom-width: 1px !important;padding-top: 30px !important;padding-bottom: 30px !important;border-top-color: #d8dbe2 !important;border-top-style: solid !important;border-bottom-color: #d8dbe2 !important;border-bottom-style: solid !important;}.socials_widget.nobg .fa {color: #58a4b0 !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1489486355819{border-top-width: 3px !important;border-right-width: 3px !important;border-bottom-width: 3px !important;border-left-width: 3px !important;padding-top: 25px !important;padding-right: 25px !important;padding-bottom: 25px !important;padding-left: 25px !important;border-left-color: #d8dbe2 !important;border-left-style: solid !important;border-right-color: #d8dbe2 !important;border-right-style: solid !important;border-top-color: #d8dbe2 !important;border-top-style: solid !important;border-bottom-color: #d8dbe2 !important;border-bottom-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'header_type' => 'heading_5',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home',
                    'module'    => '26',
                    'excerpt_length' => '46',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'show_navtext' => '1',
                    'show_pageinfo' => '1',
                    'pagination_align' => 'left',   
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1489486355819{border-top-width: 3px !important;border-right-width: 3px !important;border-bottom-width: 3px !important;border-left-width: 3px !important;padding-top: 25px !important;padding-right: 25px !important;padding-bottom: 25px !important;padding-left: 25px !important;border-left-color: #d8dbe2 !important;border-left-style: solid !important;border-right-color: #d8dbe2 !important;border-right-style: solid !important;border-top-color: #d8dbe2 !important;border-top-style: solid !important;border-bottom-color: #d8dbe2 !important;border-bottom-style: solid !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'Home 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1489542785087{margin-bottom: 30px !important;border-bottom-width: 1px !important;padding-bottom: 10px !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}',
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1489542785087{margin-bottom: 30px !important;border-bottom-width: 1px !important;padding-bottom: 10px !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}'
                )
            )
        ),
        'home-5' => array(
            'title' => 'Home 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '',
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder'
            )
        ),
        'about' => array(
            'title' => 'About',
            'content' => 'about.txt',
            'post_type' => 'page',
            'metabox' => array(
                'jnews_single_page' => array(
                    'layout' => 'no-sidebar', 
                )
            )
        ),
        'contact' => array(
            'title' => 'Contact',
            'content' => 'contact.txt',
            'post_type' => 'page',
            'metabox' => array(
                'jnews_single_page' => array(
                    'layout' => 'left-sidebar',
                    'sidebar' => 'contact-page', 
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
        'recipe' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'recipe',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:recipe:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:recipe:id}}',
                    'number' => 6
                ),
            )
        ),
        'street-food' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Street Food',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:street-food:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:street-food:id}}',
                    'number' => 6
                ),
            )
        ),
        'drink' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Drink',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:drink:id}}',
                'menu-item-status' => 'publish'
            ),
            'metabox' => array(
                'menu_item_jnews_mega_menu' => array(
                    'type' => 'category_1',
                    'category' => '{{category:dinner:id}}',
                    'number' => 9
                ),
            )
        ),
        'restaurant' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Restaurant',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:restaurant:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'travel' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Travel',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:dinner:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'about' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'About',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:about:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'contact' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Contact',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:contact:id}}',
                'menu-item-status' => 'publish'
            )
        ),


        // Footer & Topbar Menu
        'home-6' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Home',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:home-1:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'recipe-1' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Recipe',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:recipe:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'about-1' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'About',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:about:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'archives' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Archives',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'contact-1' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Contact',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:contact:id}}',
                'menu-item-status' => 'publish'
            )
        ),

    ),

    'widget_position' => array(
        'Home',
        'Author',
        'Home 4',
        'Contact Page'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'contact-form-7',
        'jnews-food-recipe',
        'jnews-breadcrumb',
        'jnews-gallery',
        'jnews-instagram',
        'jnews-jsonld',
        'jnews-like',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )

);