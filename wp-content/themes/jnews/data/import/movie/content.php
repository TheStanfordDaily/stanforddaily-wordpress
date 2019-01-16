<?php

return array(

    // image
    'image' =>  array(
	    'movie1'    => 'http://jegtheme.com/asset/jnews/demo/default/travel1.jpg',
	    'movie2'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion2.jpg',
	    'movie3'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion3.jpg',
	    'movie4'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion4.jpg',
	    'movie5'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion5.jpg',
	    'movie6'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion6.jpg',
	    'movie7'    => 'http://jegtheme.com/asset/jnews/demo/default/fashion1.jpg',
	    'movie8'    => 'http://jegtheme.com/asset/jnews/demo/default/travel2.jpg',
	    'movie9'    => 'http://jegtheme.com/asset/jnews/demo/default/travel3.jpg',
	    'movie_bg' => 'http://jegtheme.com/asset/jnews/demo/default/news5.jpg',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/movie/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/movie/logo@2x.png',
	    'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/movie/mobile_logo.png',
	    'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/movie/mobile_logo@2x.png',
	    'footer_logo' => 'http://jegtheme.com/asset/jnews/demo/news/logo.png',
	    'footer_logo2x' => 'http://jegtheme.com/asset/jnews/demo/news/logo@2x.png',
	    'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
	    'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png',
	    'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
	    'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
	        'box-office' => array(
		        'title' => 'Box Office',
		        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
	        'genre' => array(
		        'title' => 'Genre',
		        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
		        'action' => array(
			        'title' => 'Action',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'genre'
		        ),
		        'comedy' => array(
			        'title' => 'Comedy',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'genre'
		        ),
		        'horror' => array(
			        'title' => 'Horror',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'genre'
		        ),
		        'romantic' => array(
			        'title' => 'Romantic',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'genre'
		        ),
	        'movie-review' => array(
		        'title' => 'Movie Review',
		        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
	        'serial-movie' => array(
		        'title' => 'Serial Movie',
		        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
	        'trailer' => array(
		        'title' => 'Trailer',
		        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
        ),

        'post_tag' => array(
	        'climate-change' => array(
		        'title' => 'Climate Change',
	        ),
	        'donald-trump' => array(
		        'title' => 'Donald Trump',
	        ),
	        'election-results' => array(
		        'title' => 'Election Results',
	        ),
	        'flat-earth' => array(
		        'title' => 'Flat Earth',
	        ),
	        'future-of-news' => array(
		        'title' => 'Future of News',
	        ),
	        'golden-globes' => array(
		        'title' => 'Golden Globes',
	        ),
	        'market-stories' => array(
		        'title' => 'Market Stories',
	        ),
	        'motogp-2017' => array(
		        'title' => 'MotoGP 2017',
	        ),
	        'mr-robot' => array(
		        'title' => 'Mr. Robot',
	        ),
	        'sillicon-valley' => array(
		        'title' => 'Sillicon Valley',
	        ),
	        'united-stated' => array(
		        'title' => 'United Stated',
	        )
        )
    ),

    // post & page
    'post' => array(
	    'game-of-thrones-the-10-burning-questions-that-must-be-answered' => array(
		    'title' => "Game of Thrones: the 10 burning questions that must be answered",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'movie1',
		    'taxonomy' => array(
			    'category' => 'action,movie-review,serial-movie',
			    'post_tag' => 'climate-change,donald-trump,election-results,future-of-news,market-stories,united-stated'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:movie-review:id}}'),
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
	    'war-for-the-planet-of-the-apes-15-wtf-moments' => array(
		    'title' => "War For The Planet Of The Apes: 15 WTF Moments",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'movie2',
		    'taxonomy' => array(
			    'category' => 'action,box-office,movie-review',
			    'post_tag' => 'donald-trump,flat-earth,future-of-news,golden-globes,market-stories,motogp-2017'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:serial-movie:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
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
	    'new-campaign-wants-you-to-raise-funds-for-abuse-victims-by-ditching-the-razor' => array(
		    'title' => "‘Despicable Me 3’ Scores Biggest Opening Day Ever for Animated Movie in China",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'movie3',
		    'taxonomy' => array(
			    'category' => 'comedy,genre,trailer',
			    'post_tag' => 'climate-change,donald-trump,election-results,flat-earth,mr-robot,sillicon-valley',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:trailer:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=euz-KBBfAAo'
		    )
	    ),
	    'twitter-tweaks-video-again-adding-view-counts-for-some-users' => array(
		    'title' => "Summer Just Got A Lot Better 'Cause \"Star Wars: Rogue One\" Is Coming To Netflix",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'movie4',
		    'taxonomy' => array(
				'category' => 'action,box-office,movie-review',
				'post_tag' => 'climate-change,election-results,flat-earth,future-of-news,market-stories,mr-robot'
			),
		    'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category::id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
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
	    'a-beginners-guide-to-the-legendary-tim-tam-biscuit-now-available-in-america' => array(
			'title' => "Emma Stone's 'La La Land' One-Woman Show Gets a Drag Makeover",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie5',
			'taxonomy' => array(
				'category' => 'box-office,romantic,trailer',
				'post_tag' => 'donald-trump,election-results,flat-earth,market-stories,motogp-2017,mr-robot',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:trailer:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=0pdqf4P9MB8'
			)
		),
	    'india-is-bringing-free-wi-fi-to-more-than-1000-villages-this-year' => array(
			'title' => "Spokane’s lingering taste for ‘Fifty Shades of Grey’ is best served online",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie6',
			'taxonomy' => array(
				'category' => 'box-office,horror,movie-review,romantic',
				'post_tag' => 'climate-change,donald-trump,flat-earth,market-stories,motogp-2017,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:movie-review:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
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
	    'betterment-moves-beyond-robo-advising-with-human-financial-planners' => array(
			'title' => "Lake Elsinore Library to screen Disney’s “Beauty and the Beast”",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie7',
			'taxonomy' => array(
				'category' => 'box-office,comedy,movie-review,romantic',
				'post_tag' => 'climate-change,donald-trump,election-results,future-of-news,golden-globes,motogp-2017'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:movie-review:id}}'),
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
	    'people-are-handing-out-badges-at-tube-stations-to-tackle-loneliness' => array(
			'title' => "Power Rangers Takes No. 1 In Home Video Rankings For 2nd Straight Week",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie8',
			'taxonomy' => array(
				'category' => 'action,comedy,movie-review',
				'post_tag' => 'election-results,flat-earth,motogp-2017,mr-robot,sillicon-valley,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:movie-review:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
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
	    'trumps-h-1b-visa-bill-spooks-indias-it-companies' => array(
			'title' => "King Ghidora hinted in new promo for the 'Kong: Skull Island' DVD release",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie9',
			'taxonomy' => array(
				'category' => 'action,box-office,movie-review',
				'post_tag' => 'climate-change,flat-earth,future-of-news,golden-globes,mr-robot,sillicon-valley'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:movie-review:id}}'),
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
	    'magical-fish-basically-has-the-power-to-conjure-its-own-patronus' => array(
			'title' => "Despite Promises, Rey Will Be Left Out of ‘Star Wars’ Monopoly Due to ‘Insufficient Interest’",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie1',
			'taxonomy' => array(
				'category' => 'action,romantic,trailer',
				'post_tag' => 'climate-change,future-of-news,golden-globes,motogp-2017,mr-robot,sillicon-valley',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:trailer:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
				'_format_video_embed' => 'https://www.youtube.com/watch?v=zB4I68XVPzQ'
			)
		),
	    'this-filipino-guy-channels-his-inner-miss-universe-by-strutting-in-six-inch-heels-and-speedos' => array(
			'title' => "This real-life Kung Fu Panda fight between a panda and peacock will keep you ROFL-ing!",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie2',
			'taxonomy' => array(
				'category' => 'box-office,comedy',
				'post_tag' => 'donald-trump,election-results,future-of-news,motogp-2017,sillicon-valley,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:comedy:id}}')
			)
		),
	    'oil-spill-off-indias-southern-coast-leaves-fisherman-stranded-marine-life-impacted' => array(
			'title' => "Here's Why Leonardo DiCaprio Surrendered an Oscar to the Government",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie3',
			'taxonomy' => array(
				'category' => 'action,box-office,romantic',
				'post_tag' => 'climate-change,election-results,market-stories,motogp-2017,sillicon-valley,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category::id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
			)
		),
	    'you-can-now-play-bill-gates-first-pc-game-and-run-over-donkeys-on-your-iphone-apple-watch' => array(
			'title' => "Batman v Superman: Dawn of Justice: 19 things that don't make sense in this nonsensical movie",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie4',
			'taxonomy' => array(
				'category' => 'action,box-office,trailer',
				'post_tag' => 'donald-trump,future-of-news,golden-globes,mr-robot,sillicon-valley,united-stated',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:trailer:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=0WWzgGyAH6Y'
			)
		),
	    'indonesias-largest-fleet-of-taxis-teams-up-to-beat-ride-hailing-apps' => array(
			'title' => "'Zootopia 2' Release Date, Spoilers: Cast Revealed by Officer McHorn Voice Actor Mark Smith",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie5',
			'taxonomy' => array(
				'category' => 'comedy,trailer',
				'post_tag' => 'climate-change,election-results,flat-earth,golden-globes,motogp-2017,united-stated',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:trailer:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
				'_format_video_embed' => 'https://www.youtube.com/watch?v=jWM0ct-OLsM'
			)
		),
	    'idol-contestant-besieged-by-pro-trump-twitter-users-because-of-his-name' => array(
			'title' => "US box office: Disney's remake of The Jungle Book roars to $103.5m opening",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie6',
			'taxonomy' => array(
				'category' => 'action,box-office',
				'post_tag' => 'climate-change,donald-trump,election-results,flat-earth,future-of-news,sillicon-valley'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category::id}}')
			)
		),
	    'everyone-stop-everything-beyonc-just-announced-that-shes-pregnant-with-twins' => array(
			'title' => "Oscar Winner Colleen Atwood Shares ‘The Huntsman: Winter’s War’ Costume Secrets",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie7',
			'taxonomy' => array(
				'category' => 'action,romantic',
				'post_tag' => 'donald-trump,election-results,flat-earth,motogp-2017,mr-robot,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:action:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
			)
		),
	    'instagram-is-testing-photo-albums-because-nothing-is-sacred-anymore' => array(
			'title' => "Free popcorn, cotton candy: Families invited to ‘Secret Life of Pets’ screening in Old Town on Saturday",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie8',
			'taxonomy' => array(
				'category' => 'action,box-office,comedy',
				'post_tag' => 'election-results,flat-earth,market-stories,mr-robot,sillicon-valley,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:comedy:id}}')
			)
		),
	    '7-february-games-you-should-get-excited-about' => array(
			'title' => "Original Ghostbusters star reveals one big problem with remake",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie9',
			'taxonomy' => array(
				'category' => 'box-office,comedy',
				'post_tag' => 'donald-trump,election-results,future-of-news,market-stories,sillicon-valley,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:comedy:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
			)
		),
	    'make-yourself-feel-better-by-laughing-at-januarys-best-news-bloopers' => array(
			'title' => "Jaume Collet-Serra Frontrunner For 'Suicide Squad' Sequel",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie1',
			'taxonomy' => array(
				'category' => 'action,box-office',
				'post_tag' => 'climate-change,election-results,golden-globes,motogp-2017,sillicon-valley,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:action:id}}')
			)
		),
	    'using-a-mind-reading-device-locked-in-patients-told-researchers-theyre-happy' => array(
			'title' => "7 Things Parents Should Know About ‘The Magnificent Seven’ (2016)",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie2',
			'taxonomy' => array(
				'category' => 'action,trailer',
				'post_tag' => 'donald-trump,election-results,golden-globes,motogp-2017,sillicon-valley,united-stated',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:trailer:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
				'_format_video_embed' => 'https://www.youtube.com/watch?v=q-RBA0xoaWU'
			)
		),
	    'how-to-find-protests-in-your-city-when-you-dont-know-where-to-start' => array(
			'title' => "Ant-Man & Doctor Strange Team Up In New Avengers: Infinity War Set Photos",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie3',
			'taxonomy' => array(
				'category' => 'action,trailer',
				'post_tag' => 'donald-trump,election-results,future-of-news,golden-globes,market-stories,mr-robot',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:trailer:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=HSzx-zryEgM'
			)
		),
	    'trump-may-special-relationship-gets-special-treatment-in-the-streets-of-london' => array(
			'title' => "How Mel Gibson’s Cinematographer Captured the Horror of ‘Hacksaw Ridge’",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie4',
			'taxonomy' => array(
				'category' => 'action,romantic',
				'post_tag' => 'election-results,future-of-news,market-stories,motogp-2017,mr-robot,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:action:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
			)
		),
	    'gopros-karma-drone-is-back-on-sale-after-design-flaw-made-them-fall-out-of-the-sky' => array(
			'title' => "Fantastic Beasts 2, 3, 4 and 5 release date, cast, plot and all you need to know",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie5',
			'taxonomy' => array(
				'category' => 'action,box-office,horror',
				'post_tag' => 'donald-trump,flat-earth,golden-globes,mr-robot,sillicon-valley,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:action:id}}')
			)
		),
	    'of-course-this-novelty-final-fantasy-fork-is-an-oversized-sword-replica' => array(
			'title' => "Moana: Disney Releases Full ‘You’re Welcome’ Musical Number",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie6',
			'taxonomy' => array(
				'category' => 'action,box-office,comedy',
				'post_tag' => 'climate-change,donald-trump,election-results,market-stories,motogp-2017,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:comedy:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
			)
		),
	    'how-nike-plans-to-break-one-of-the-most-daunting-barriers-in-human-performance' => array(
			'title' => "JRR Tolkien's estate and Warner Bros end five-year legal battle",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie7',
			'taxonomy' => array(
				'category' => 'box-office,horror,romantic',
				'post_tag' => 'climate-change,election-results,flat-earth,future-of-news,mr-robot,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:box-office:id}}')
			)
		),
	    'trump-attends-the-return-of-the-remains-of-the-navy-seal-who-died-in-yemen' => array(
			'title' => "The Imitation Game's Graham Moore to Make Playwriting Debut With Summer Shorts Series",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie8',
			'taxonomy' => array(
				'category' => 'action,box-office,comedy',
				'post_tag' => 'election-results,future-of-news,golden-globes,market-stories,motogp-2017,sillicon-valley'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:action:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
			)
		),
	    'president-trump-threatens-to-send-u-s-troops-to-mexico-to-take-care-of-bad-hombres' => array(
			'title' => "How Classical Elevated the Oscar-Winning Film 'Birdman'",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie9',
			'taxonomy' => array(
				'category' => 'comedy,horror,romantic',
				'post_tag' => 'donald-trump,flat-earth,future-of-news,golden-globes,motogp-2017,mr-robot'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:romantic:id}}')
			)
		),
	    'house-republicans-vote-to-end-rule-stopping-coal-mining-debris-from-being-dumped-in-streams' => array(
			'title' => "'Cinderella likes bad boys': The Lily James you've never seen",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie1',
			'taxonomy' => array(
				'category' => 'romantic,trailer',
				'post_tag' => 'climate-change,donald-trump,future-of-news,market-stories,motogp-2017,united-stated',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:trailer:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
				'_format_video_embed' => 'https://www.youtube.com/watch?v=20DF6U1HcGQ'
			)
		),
	    'the-chainsmokers-actually-make-a-great-nickelback-cover-band' => array(
			'title' => "Which Characters Get The Most Screen Time in ‘Avengers: Age of Ultron’?",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie2',
			'taxonomy' => array(
				'category' => 'action,box-office',
				'post_tag' => 'donald-trump,election-results,flat-earth,golden-globes,sillicon-valley,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:box-office:id}}')
			)
		),
	    'j-k-rowling-is-shutting-down-readers-who-burned-all-their-harry-potter-books' => array(
			'title' => "How Scientifically Accurate is Jurassic World?",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie3',
			'taxonomy' => array(
				'category' => 'action,box-office',
				'post_tag' => 'donald-trump,election-results,future-of-news,golden-globes,sillicon-valley,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:action:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
			)
		),
	    'the-scary-reason-healthy-people-die-after-an-er-visit' => array(
			'title' => "Introducing Purple Minions: Evil, Destructive, Adorable",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie4',
			'taxonomy' => array(
				'category' => 'box-office,comedy',
				'post_tag' => 'climate-change,donald-trump,election-results,flat-earth,future-of-news,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:comedy:id}}')
			)
		),
	    'watch-justin-timberlakes-cry-me-a-river-come-to-life-in-mesmerizing-dance' => array(
			'title' => "Let’s Nerd Out About Ants Before You See Ant-Man",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'movie5',
			'taxonomy' => array(
				'category' => 'action,comedy,romantic',
				'post_tag' => 'climate-change,donald-trump,future-of-news,golden-globes,motogp-2017,sillicon-valley',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:box-office:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
				'_format_video_embed' => 'https://www.youtube.com/watch?v=gtcV6fkms80'
			)
		),
	    'barack-obamas-now-mainly-focusing-on-wearing-this-casual-backwards-hat' => array(
			'title' => "Sony Pictures teams up with iconic video game classics in ‘PIXELS’",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'movie6',
			'taxonomy' => array(
				'category' => 'action,box-office,comedy,horror',
				'post_tag' => 'flat-earth,golden-globes,market-stories,motogp-2017,mr-robot,united-stated',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:comedy:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=RpUOFv2SHL8'
			)
		),

	    // page
	    'home-1' => array(
		    'title' => 'Home 1',
		    'content' => 'home1.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1500454618309{margin-top: -30px !important;padding-top: 40px !important;background-image: url({{image:movie_bg:url:full}}) !important;}.vc_custom_1500448269745{margin-top: -100px !important;margin-bottom: 40px !important;border-bottom-width: 1px !important;padding-top: 135px !important;background-color: #efefef !important;border-bottom-color: #e8e8e8 !important;border-bottom-style: solid !important;}.vc_custom_1500542804714{margin-bottom: 100px !important;padding-top: 70px !important;background: #912c21 url({{image:movie_bg:url:full}}) !important;}.vc_custom_1500448405808{margin-bottom: 0px !important;}.vc_custom_1500979555358{margin-bottom: 30px !important;}.vc_custom_1500450896570{margin-bottom: -70px !important;}',
			    '_wpb_post_custom_css' => '#firstrow .jeg_slider_wrapper,#firstrow .jeg_slider_type_2{z-index: 2;}#secondoverflow {overflow: visible;}',
			    'jnews_page_loop' => array(
				    'enable_page_loop' => '1',
				    'first_title' => 'NEWS INDEX',
				    'header_type' => 'heading_2',
				    'layout' => 'right-sidebar',
				    'sidebar' => 'default-sidebar',
				    'module'    => '3',
				    'excerpt_length' => '34',
				    'content_date' => 'default',
				    'content_pagination' => 'nav_1',
				    'pagination_align' => 'left',
				    'show_navtext' => 1,
                    'show_pageinfo' => 1,
				    'post_offset' => 0
			    ),
			    '_elementor_data' => 'home1.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.vc_custom_1500454618309{margin-top: -30px !important;padding-top: 40px !important;background-image: url({{image:movie_bg:url:full}}) !important;}.vc_custom_1500448269745{margin-top: -100px !important;margin-bottom: 40px !important;border-bottom-width: 1px !important;padding-top: 135px !important;background-color: #efefef !important;border-bottom-color: #e8e8e8 !important;border-bottom-style: solid !important;}.vc_custom_1500542804714{margin-bottom: 100px !important;padding-top: 70px !important;background: #912c21 url({{image:movie_bg:url:full}}) !important;}.vc_custom_1500448405808{margin-bottom: 0px !important;}.vc_custom_1500979555358{margin-bottom: 30px !important;}.vc_custom_1500450896570{margin-bottom: -70px !important;}#firstrow .jeg_slider_wrapper,#firstrow .jeg_slider_type_2{z-index: 2;}#secondoverflow {overflow: visible;}'
			    )
		    )
	    ),
	    'home-2' => array(
		    'title' => 'Home 2',
		    'content' => 'home2.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1500534460264{margin-top: -30px !important;margin-bottom: 140px !important;padding-top: 40px !important;background-image: url({{image:movie_bg:url:full}}) !important;}.vc_custom_1505874429344{margin-bottom: 30px !important;}.vc_custom_1505874444596{margin-bottom: 40px !important;}.vc_custom_1505874461260{margin-bottom: 160px !important;padding-top: 40px !important;background-image: url({{image:movie_bg:url:full}}) !important;}.vc_custom_1500535084096{margin-bottom: -100px !important;}.vc_custom_1505874741161{margin-right: 20px !important;margin-left: -40px !important;border-top-width: 20px !important;border-right-width: 20px !important;border-bottom-width: 20px !important;border-left-width: 20px !important;padding-top: 50px !important;padding-right: 20px !important;padding-bottom: 200px !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1500537899601{margin-top: -40px !important;margin-left: -50px !important;background-color: #fcfcfc !important;}.vc_custom_1500536163831{margin-top: -330px !important;}.vc_custom_1505874752177{margin-right: 20px !important;margin-left: -40px !important;border-top-width: 20px !important;border-right-width: 20px !important;border-bottom-width: 20px !important;border-left-width: 20px !important;padding-top: 50px !important;padding-right: 20px !important;padding-bottom: 360px !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1500537910882{margin-top: -40px !important;margin-left: -50px !important;background-color: #fcfcfc !important;}.vc_custom_1500539063746{margin-top: -490px !important;}.vc_custom_1505874768329{margin-right: 20px !important;margin-left: -40px !important;border-top-width: 20px !important;border-right-width: 20px !important;border-bottom-width: 20px !important;border-left-width: 20px !important;padding-top: 50px !important;padding-right: 20px !important;padding-bottom: 160px !important;border-left-color: rgba(238,238,238,0.2) !important;border-left-style: solid !important;border-right-color: rgba(238,238,238,0.2) !important;border-right-style: solid !important;border-top-color: rgba(238,238,238,0.2) !important;border-top-style: solid !important;border-bottom-color: rgba(238,238,238,0.2) !important;border-bottom-style: solid !important;}.vc_custom_1500538336520{margin-top: -40px !important;margin-left: -50px !important;}.vc_custom_1500537497369{margin-top: -290px !important;}.vc_custom_1500538480850{margin-bottom: -120px !important;}',
			    '_wpb_post_custom_css' => "#firstrow,
#secondrow {
    overflow: visible;
}

@media only screen and (max-width: 1024px) {
    .jeg_offside .jeg_offside_inner > .jeg_wrapper {
        margin-left: 20px !important;
    }
    
    .jeg_offside .jeg_offside_inner h1 {
        font-size: 100px !important;
    }
}

@media only screen and (max-width: 767px) {
    .jeg_offside .jeg_offside_inner h1 {
        font-size: 80px !important;
    }
}

@media only screen and (max-width: 480px) {
    .jeg_offside .jeg_offside_inner h1 {
        font-size: 40px !important;
        margin-bottom: 100px;
    }
}",
			    'jnews_page_loop' => array(
				    'enable_page_loop' => '1',
				    'first_title' => 'NEWS INDEX',
				    'header_type' => 'heading_2',
				    'layout' => 'no-sidebar',
				    'sidebar' => 'default-sidebar',
				    'module'    => '23',
				    'excerpt_length' => '20',
				    'content_date' => 'default',
				    'content_pagination' => 'nav_1',
				    'pagination_align' => 'left',
				    'show_navtext' => 1,
				    'show_pageinfo' => 1,
				    'post_offset' => 0
			    ),
			    '_elementor_data' => 'home2.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.vc_custom_1500534460264{margin-top: -30px !important;margin-bottom: 140px !important;padding-top: 40px !important;background-image: url({{image:movie_bg:url:full}}) !important;}.vc_custom_1505874429344{margin-bottom: 30px !important;}.vc_custom_1505874444596{margin-bottom: 40px !important;}.vc_custom_1505874461260{margin-bottom: 160px !important;padding-top: 40px !important;background-image: url({{image:movie_bg:url:full}}) !important;}.vc_custom_1500535084096{margin-bottom: -100px !important;}.vc_custom_1505874741161{margin-right: 20px !important;margin-left: -40px !important;border-top-width: 20px !important;border-right-width: 20px !important;border-bottom-width: 20px !important;border-left-width: 20px !important;padding-top: 50px !important;padding-right: 20px !important;padding-bottom: 200px !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1500537899601{margin-top: -40px !important;margin-left: -50px !important;background-color: #fcfcfc !important;}.vc_custom_1500536163831{margin-top: -330px !important;}.vc_custom_1505874752177{margin-right: 20px !important;margin-left: -40px !important;border-top-width: 20px !important;border-right-width: 20px !important;border-bottom-width: 20px !important;border-left-width: 20px !important;padding-top: 50px !important;padding-right: 20px !important;padding-bottom: 360px !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1500537910882{margin-top: -40px !important;margin-left: -50px !important;background-color: #fcfcfc !important;}.vc_custom_1500539063746{margin-top: -490px !important;}.vc_custom_1505874768329{margin-right: 20px !important;margin-left: -40px !important;border-top-width: 20px !important;border-right-width: 20px !important;border-bottom-width: 20px !important;border-left-width: 20px !important;padding-top: 50px !important;padding-right: 20px !important;padding-bottom: 160px !important;border-left-color: rgba(238,238,238,0.2) !important;border-left-style: solid !important;border-right-color: rgba(238,238,238,0.2) !important;border-right-style: solid !important;border-top-color: rgba(238,238,238,0.2) !important;border-top-style: solid !important;border-bottom-color: rgba(238,238,238,0.2) !important;border-bottom-style: solid !important;}.vc_custom_1500538336520{margin-top: -40px !important;margin-left: -50px !important;}.vc_custom_1500537497369{margin-top: -290px !important;}.vc_custom_1500538480850{margin-bottom: -120px !important;}#firstrow,
#secondrow {
    overflow: visible;
}

@media only screen and (max-width: 1024px) {
    .jeg_offside .jeg_offside_inner > .jeg_wrapper {
        margin-left: 20px !important;
    }
    
    .jeg_offside .jeg_offside_inner h1 {
        font-size: 100px !important;
    }
}

@media only screen and (max-width: 767px) {
    .jeg_offside .jeg_offside_inner h1 {
        font-size: 80px !important;
    }
}

@media only screen and (max-width: 480px) {
    .jeg_offside .jeg_offside_inner h1 {
        font-size: 40px !important;
        margin-bottom: 100px;
    }
}'
			    ),
		    )
	    ),
	    'home-3' => array(
		    'title' => 'Home 3',
		    'content' => 'home3.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1500453570734{margin-top: -30px !important;margin-bottom: 140px !important;padding-top: 60px !important;background: #dddddd url({{image:movie_bg:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1500453683082{margin-bottom: 70px !important;border-bottom-width: 150px !important;padding-top: 20px !important;padding-bottom: 30px !important;background: #aa2727 url({{image:movie_bg:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1500457952216{margin-bottom: -100px !important;}.vc_custom_1500370993441{padding-bottom: 20px !important;}.vc_custom_1500347032852{margin-bottom: -220px !important;}.vc_custom_1500089835358{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 30px !important;padding-bottom: 30px !important;background-color: #f9f9f9 !important;border-left-color: #e0e0e0 !important;border-left-style: solid !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;border-top-color: #e0e0e0 !important;border-top-style: solid !important;border-bottom-color: #e0e0e0 !important;border-bottom-style: solid !important;border-radius: 2px !important;}',
			    '_wpb_post_custom_css' => '#first-header,#second-header {overflow: visible;}',
			    '_elementor_data' => 'home3.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.vc_custom_1500453570734{margin-top: -30px !important;margin-bottom: 140px !important;padding-top: 60px !important;background: #dddddd url({{image:movie_bg:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1500453683082{margin-bottom: 70px !important;border-bottom-width: 150px !important;padding-top: 20px !important;padding-bottom: 30px !important;background: #aa2727 url({{image:movie_bg:url:full}}) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1500457952216{margin-bottom: -100px !important;}.vc_custom_1500370993441{padding-bottom: 20px !important;}.vc_custom_1500347032852{margin-bottom: -220px !important;}.vc_custom_1500089835358{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 30px !important;padding-bottom: 30px !important;background-color: #f9f9f9 !important;border-left-color: #e0e0e0 !important;border-left-style: solid !important;border-right-color: #e0e0e0 !important;border-right-style: solid !important;border-top-color: #e0e0e0 !important;border-top-style: solid !important;border-bottom-color: #e0e0e0 !important;border-bottom-style: solid !important;border-radius: 2px !important;}#first-header,#second-header {overflow: visible;}'
			    )
		    )
	    ),
	    'home-4' => array(
		    'title' => 'Home 4',
		    'content' => 'home4.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    'jnews_page_loop' => array(
				    'enable_page_loop' => '1',
				    'first_title' => 'NEWS INDEX',
				    'header_type' => 'heading_2',
				    'layout' => 'right-sidebar',
				    'sidebar' => 'default-sidebar',
				    'module'    => '4',
				    'excerpt_length' => '32',
				    'content_date' => 'default',
				    'content_pagination' => 'nav_1',
				    'pagination_align' => 'left',
				    'show_navtext' => 1,
				    'show_pageinfo' => 1,
				    'post_offset' => 0
			    ),
			    '_elementor_data' => 'home4.json',
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
	    'mobile-navigation' => array(
		    'title' => 'Mobile Navigation',
		    'location' => 'mobile_navigation'
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
	    'movie-review' => array(
		    'location' => 'main-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Movie Review',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:movie-review:id}}',
			    'menu-item-status' => 'publish'
		    ),
		    'metabox' => array(
			    'menu_item_jnews_mega_menu' => array(
				    'type' => 'category_2',
				    'category' => '{{category:movie-review:id}}',
				    'number' => 5,
				    'trending_tag' => '{{taxonomy:post_tag:donald-trump:id}},{{taxonomy:post_tag:future-of-news:id}},{{taxonomy:post_tag:climate-change:id}},{{taxonomy:post_tag:market-stories:id}},{{taxonomy:post_tag:election-results:id}},{{taxonomy:post_tag:flat-earth:id}}'
			    ),
		    )
	    ),
	    'trailer' => array(
		    'location' => 'main-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Trailer',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:trailer:id}}',
			    'menu-item-status' => 'publish'
		    ),
		    'metabox' => array(
			    'menu_item_jnews_mega_menu' => array(
				    'type' => 'category_2',
				    'category' => '{{category:trailer:id}}',
				    'number' => 5,
				    'trending_tag' => '{{taxonomy:post_tag:flat-earth:id}},{{taxonomy:post_tag:sillicon-valley:id}},{{taxonomy:post_tag:mr-robot:id}},{{taxonomy:post_tag:motogp-2017:id}},{{taxonomy:post_tag:golden-globes:id}},{{taxonomy:post_tag:future-of-news:id}}'
			    ),
		    )
	    ),
	    'genre' => array(
		    'location' => 'main-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Genre',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:genre:id}}',
			    'menu-item-status' => 'publish'
		    ),
		    'metabox' => array(
			    'menu_item_jnews_mega_menu' => array(
				    'type' => 'category_1',
				    'category' => '{{category:genre:id}}',
				    'number' => 10
			    ),
		    )
	    ),
	    'box-office' => array(
		    'location' => 'main-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Box Office',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:box-office:id}}',
			    'menu-item-status' => 'publish'
		    ),
		    'metabox' => array(
			    'menu_item_jnews_mega_menu' => array(
				    'type' => 'category_2',
				    'category' => '{{category:box-office:id}}',
				    'number' => 10,
				    'trending_tag' => '{{taxonomy:post_tag:golden-globes:id}},{{taxonomy:post_tag:mr-robot:id}},{{taxonomy:post_tag:motogp-2017:id}},{{taxonomy:post_tag:climate-change:id}},{{taxonomy:post_tag:flat-earth:id}}'
			    ),
		    )
	    ),
	    'celebrity' => array(
		    'location' => 'main-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Celebrity',
			    'menu-item-type' => 'custom',
			    'menu-item-url' => '#',
			    'menu-item-status' => 'publish'
		    )
	    ),
	    'tv-series' => array(
		    'location' => 'main-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'TV Series',
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
	    ),

	    // Mobile Menu
	    'mobile-home' => array(
			'location' => 'mobile-navigation',
			'menu-item-data' => array(
				'menu-item-title' => 'Home',
				'menu-item-type' => 'post_type',
				'menu-item-object' => 'page',
				'menu-item-object-id' => '{{post:home-1:id}}',
				'menu-item-status' => 'publish'
			)
		),
			'mobile-home-1' => array(
				'location' => 'mobile-navigation',
				'menu-item-data' => array(
					'menu-item-title' => 'Home - Layout 1',
					'menu-item-parent-id' => '{{menu:mobile-home:id}}',
					'menu-item-type' => 'post_type',
					'menu-item-object' => 'page',
					'menu-item-object-id' => '{{post:home-1:id}}',
					'menu-item-status' => 'publish'
				)
			),
			'mobile-home-2' => array(
				'location' => 'mobile-navigation',
				'menu-item-data' => array(
					'menu-item-title' => 'Home - Layout 2',
					'menu-item-parent-id' => '{{menu:mobile-home:id}}',
					'menu-item-type' => 'post_type',
					'menu-item-object' => 'page',
					'menu-item-object-id' => '{{post:home-2:id}}',
					'menu-item-status' => 'publish'
				)
			),
			'mobile-home-3' => array(
				'location' => 'mobile-navigation',
				'menu-item-data' => array(
					'menu-item-title' => 'Home - Layout 3',
					'menu-item-parent-id' => '{{menu:mobile-home:id}}',
					'menu-item-type' => 'post_type',
					'menu-item-object' => 'page',
					'menu-item-object-id' => '{{post:home-3:id}}',
					'menu-item-status' => 'publish'
				)
			),
			'mobile-home-4' => array(
				'location' => 'mobile-navigation',
				'menu-item-data' => array(
					'menu-item-title' => 'Home - Layout 4',
					'menu-item-parent-id' => '{{menu:mobile-home:id}}',
					'menu-item-type' => 'post_type',
					'menu-item-object' => 'page',
					'menu-item-object-id' => '{{post:home-4:id}}',
					'menu-item-status' => 'publish'
				)
			),
	    'mobile-movie-review' => array(
		    'location' => 'mobile-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Movie Review',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:movie-review:id}}',
			    'menu-item-status' => 'publish'
		    )
	    ),
	    'mobile-genre' => array(
		    'location' => 'mobile-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Genre',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:genre:id}}',
			    'menu-item-status' => 'publish'
		    )
	    ),
		    'mobile-action' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Action',
				    'menu-item-parent-id' => '{{menu:mobile-genre:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:action:id}}',
				    'menu-item-status' => 'publish'
			    )
		    ),
		    'mobile-romantic' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Romantic',
				    'menu-item-parent-id' => '{{menu:mobile-genre:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:romantic:id}}',
				    'menu-item-status' => 'publish'
			    )
		    ),
		    'mobile-horror' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Horror',
				    'menu-item-parent-id' => '{{menu:mobile-genre:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:horror:id}}',
				    'menu-item-status' => 'publish'
			    )
		    ),
		    'mobile-commedy' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Commedy',
				    'menu-item-parent-id' => '{{menu:mobile-genre:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:commedy:id}}',
				    'menu-item-status' => 'publish'
			    )
		    ),
	    'mobile-trailer' => array(
		    'location' => 'mobile-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Trailer',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:trailer:id}}',
			    'menu-item-status' => 'publish'
		    )
	    ),
	    'mobile-box-office' => array(
		    'location' => 'mobile-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Box Office',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:box-office:id}}',
			    'menu-item-status' => 'publish'
		    )
	    ),
    ),

    'widget_position' => array(
    	'Author',
	    'Home 3',
	    'Home 3 Loop',
	    'Home 5',
	    'Home 5 Loop',
	    'Single Post'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
        'jnews-jsonld',
        'jnews-like',
        'jnews-meta-header',
        'jnews-review',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )

);