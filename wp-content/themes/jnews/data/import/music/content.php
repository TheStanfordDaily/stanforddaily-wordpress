<?php

return array(

    // image
    'image' =>  array(
        'fashion1' => 'http://jegtheme.com/asset/jnews/demo/default/fashion1.jpg',
        'fashion2' => 'http://jegtheme.com/asset/jnews/demo/default/fashion2.jpg',
        'fashion3' => 'http://jegtheme.com/asset/jnews/demo/default/fashion3.jpg',
        'fashion4' => 'http://jegtheme.com/asset/jnews/demo/default/fashion4.jpg',
        'fashion5' => 'http://jegtheme.com/asset/jnews/demo/default/fashion5.jpg',
        'fashion6' => 'http://jegtheme.com/asset/jnews/demo/default/fashion6.jpg',
        'travel1' => 'http://jegtheme.com/asset/jnews/demo/default/travel1.jpg',
        'travel2' => 'http://jegtheme.com/asset/jnews/demo/default/travel2.jpg',
        'travel3' => 'http://jegtheme.com/asset/jnews/demo/default/travel3.jpg',
        'travel4' => 'http://jegtheme.com/asset/jnews/demo/default/travel4.jpg',
        'travel5' => 'http://jegtheme.com/asset/jnews/demo/default/travel5.jpg',
        'travel6' => 'http://jegtheme.com/asset/jnews/demo/default/travel6.jpg',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'aside' => 'http://jegtheme.com/asset/jnews/demo/music/magazine.jpg',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/music/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/music/logo@2x.png',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'artist' =>
                array(
                    'title' =>'Artist',
                    'description' => ''
                ),
            'culture' =>
                array(
                    'title' =>'Culture',
                    'description' => ''
                ),
            'fashion' =>
                array(
                    'title' =>'Fashion',
                    'description' => ''
                ),
            'lifestyle' =>
                array(
                    'title' =>'Lifestyle',
                    'description' => ''
                ),
            'metal' =>
                array(
                    'title' =>'Metal',
                    'description' => ''
                ),
            'news' =>
	            array(
		            'title' =>'News',
		            'description' => ''
	            ),
            'rock' =>
	            array(
		            'title' =>'Rock',
		            'description' => ''
	            ),
            'videos' =>
	            array(
		            'title' =>'Videos',
		            'description' => ''
	            )
        ),

        'post_tag' => array(
            'best-of-2017' => array(
                'title' => 'Best of 2017'
            ),
            'grammys-2018' => array(
	            'title' => 'Grammys 2018'
            ),
            'indie-label' => array(
	            'title' => 'Indie Label'
            ),
            'most-streamed-2017' => array(
	            'title' => 'Most Streamed 2017'
            ),
            'podcast' => array(
	            'title' => 'Podcast'
            ),
            'pop' => array(
	            'title' => 'Pop'
            ),
            'rnb-hip-hop' => array(
	            'title' => 'R&B / Hip-Hop'
            ),
            'women-in-music' => array(
	            'title' => 'Women in Music'
            ),
            'top-chart-100' => array(
	            'title' => 'Top Chart 100'
            )
        )
    ),

    // post & page
    'post' => array(
	    'fashion-story-from-the-catwalk-to-your-closet' => array(
		    'title' => "Noel Gallagher On Why He Can’t Write “sad” Like Thom Yorke",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion1',
		    'taxonomy' => array(
			    'category' => 'artist,lifestyle',
			    'post_tag' => 'indie-label,podcast,pop,top-chart-100'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:artist:id}}')
		    )
	    ),
	    'best-tracks-of-the-week-rich-chigga-wiz-khalifa-yaeji-more' => array(
		    'title' => "Best Tracks of the Week: Rich Chigga, Wiz Khalifa, Yaeji & More",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion2',
		    'taxonomy' => array(
			    'category' => 'culture,fashion,lifestyle,metal',
			    'post_tag' => 'indie-label,most-streamed-2017,podcast,rnb-hip-hop'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:culture:id}}')
		    )
	    ),
	    'selena-gomez-stuns-in-billboard-2017-woman-of-the-year-story' => array(
		    'title' => "Selena Gomez Stuns in ‘Billboard’ 2017 Woman of the Year Story",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion3',
		    'taxonomy' => array(
			    'category' => 'artist,culture,fashion,lifestyle',
			    'post_tag' => 'grammys-2018,pop,rnb-hip-hop,top-chart-100,women-in-music'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:artist:id}}')
		    )
	    ),
	    'american-music-awards-2017-inside-the-hottest-show-moments' => array(
		    'title' => "American Music Awards 2017: Inside the Hottest Show Moments",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion4',
		    'taxonomy' => array(
			    'category' => 'culture,metal,news,rock',
			    'post_tag' => 'best-of-2017,most-streamed-2017,podcast,pop,rnb-hip-hop'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:news:id}}')
		    )
	    ),
	    'new-mental-health-service-launches-to-help-musicians' => array(
		    'title' => "New Mental Health Service Launches To Help Musicians",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion5',
		    'taxonomy' => array(
			    'category' => 'culture,lifestyle,videos',
			    'post_tag' => 'best-of-2017,grammys-2018,rnb-hip-hop,women-in-music'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
		    )
	    ),
	    'eminem-reveals-revival-album-featuring-with-ed-sheeran' => array(
		    'title' => "Eminem Reveals ‘Revival’ Album Featuring with Ed Sheeran",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion6',
		    'taxonomy' => array(
			    'category' => 'artist,rock,videos',
			    'post_tag' => 'best-of-2017,indie-label,podcast,rnb-hip-hop'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:rock:id}}')
		    )
	    ),
	    'big-shaq-responds-to-noel-gallaghers-invitation-to-support-him-on-tour' => array(
		    'title' => "Big Shaq Responds To Noel Gallagher’s Invitation To Support Him On Tour",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel1',
		    'taxonomy' => array(
			    'category' => 'metal,news,videos',
			    'post_tag' => 'best-of-2017,grammys-2018,rnb-hip-hop,women-in-music',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:videos:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=uQwQqJwWpW4'
		    )
	    ),
	    'all-the-pink-carpet-looks-from-billboard-women-in-music-2017' => array(
		    'title' => "All the Pink Carpet Looks from Billboard Women In Music 2017",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel2',
		    'taxonomy' => array(
			    'category' => 'artist,culture,lifestyle',
			    'post_tag' => 'best-of-2017,grammys-2018,rnb-hip-hop,women-in-music'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
		    )
	    ),
	    'maroon-5-jimmy-fallon-start-party-in-nyc-subway-while-busking' => array(
		    'title' => "Maroon 5, Jimmy Fallon Start Party in NYC Subway While Busking",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel3',
		    'taxonomy' => array(
			    'category' => 'artist,fashion,news,rock',
			    'post_tag' => 'best-of-2017,pop,rnb-hip-hop,top-chart-100'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:artist:id}}')
		    )
	    ),
	    'watch-rich-chigga-break-down-the-beat-for-glow-like-dat' => array(
		    'title' => "Watch Rich Chigga Break Down the Beat for “Glow Like Dat”",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel4',
		    'taxonomy' => array(
			    'category' => 'artist,news,rock,videos',
			    'post_tag' => 'most-streamed-2017,podcast,rnb-hip-hop,top-chart-100',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:videos:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=adDD43CvrUc'
		    )
	    ),
	    'selena-gomez-reveals-why-she-reconnected-with-justin-bieber' => array(
		    'title' => "Selena Gomez Reveals Why She Reconnected with Justin Bieber",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel5',
		    'taxonomy' => array(
			    'category' => 'culture,fashion,lifestyle',
			    'post_tag' => 'most-streamed-2017,podcast,pop,women-in-music'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
		    )
	    ),
	    'miguel-delivers-a-party-for-the-end-of-the-world-on-war-leisure' => array(
		    'title' => "Miguel Delivers a Party for the End of the World on ‘War & Leisure’",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel6',
		    'taxonomy' => array(
			    'category' => 'artist,news,rock',
			    'post_tag' => 'grammys-2018,indie-label,most-streamed-2017,rnb-hip-hop,top-chart-100,women-in-music'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:rock:id}}')
		    )
	    ),
	    '19-year-old-danish-rapper-k-phax-effuses-chill-on-oh-my-god' => array(
		    'title' => "19-Year-Old Danish Rapper K-Phax Effuses Chill On “Oh My God”",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion1',
		    'taxonomy' => array(
			    'category' => 'culture,lifestyle,news',
			    'post_tag' => 'indie-label,podcast,rnb-hip-hop'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:culture:id}}')
		    )
	    ),
	    'watch-dialog-dini-hari-new-single-video-clip-tentang-rumahku' => array(
		    'title' => "Watch Dialog Dini Hari New Single Video Clip: Tentang Rumahku",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion2',
		    'taxonomy' => array(
			    'category' => 'artist,news,videos',
			    'post_tag' => 'indie-label,most-streamed-2017,podcast,rnb-hip-hop,top-chart-100,women-in-music',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:artist:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=kEbxIfmvJE0'
		    )
	    ),
	    'good-charlotte-pays-tribute-to-lil-peep-with-awful-things-cover' => array(
		    'title' => "Good Charlotte Pays Tribute to Lil Peep with 'Awful Things' Cover",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion3',
		    'taxonomy' => array(
			    'category' => 'artist,fashion,metal,news',
			    'post_tag' => 'best-of-2017,grammys-2018,indie-label,podcast'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:metal:id}}')
		    )
	    ),
	    'ed-sheeran-rihanna-top-spotifys-most-streamed-artists-of-2017' => array(
		    'title' => "Ed Sheeran & Rihanna Top Spotify's Most Streamed Artists of 2017",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion4',
		    'taxonomy' => array(
			    'category' => 'artist,lifestyle,news',
			    'post_tag' => 'best-of-2017,most-streamed-2017,podcast,pop,women-in-music'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:news:id}}')
		    )
	    ),
	    'watch-as-flares-are-set-off-in-the-crowd-to-mark-liam-gallaghers-arrival-in-glasgow' => array(
		    'title' => "Watch As Flares Are Set Off In The Crowd To Mark Liam Gallagher’s Arrival In Glasgow",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion5',
		    'taxonomy' => array(
			    'category' => 'artist,rock,videos',
			    'post_tag' => 'best-of-2017,grammys-2018,podcast,top-chart-100',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:videos:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=YdJc7-ZEuT0'
		    )
	    ),
	    'shed-seven-announce-biggest-show-of-their-career-in-manchester' => array(
		    'title' => "Shed Seven Announce Biggest Show of Their Career In Manchester",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion6',
		    'taxonomy' => array(
			    'category' => 'fashion,metal,videos',
			    'post_tag' => 'best-of-2017,indie-label,most-streamed-2017,podcast,pop'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
		    )
	    ),
	    'fergie-crashes-live-gala-stage-to-put-in-a-little-work-for-her-new-single' => array(
		    'title' => "Fergie Crashes LIVE Gala Stage to Put In 'A Little Work' for Her New Single",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel1',
		    'taxonomy' => array(
			    'category' => 'artist,fashion,news,rock',
			    'post_tag' => 'grammys-2018,rnb-hip-hop,women-in-music'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:news:id}}')
		    )
	    ),
	    'justin-bleber-posts-tribute-to-his-bro-relationships-are-worth-fighting-for' => array(
		    'title' => "Justin Bleber Posts Tribute to His Bro: 'Relationships Are Worth Fighting For'",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel2',
		    'taxonomy' => array(
			    'category' => 'culture,lifestyle,news',
			    'post_tag' => 'best-of-2017,pop,rnb-hip-hop,top-chart-100'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:lifestyle:id}}')
		    )
	    ),
	    'watch-pitbull-throws-a-boat-party-full-of-bikini-models-in-jungle-video' => array(
		    'title' => "Watch Pitbull Throws a Boat Party Full of Bikini Models in 'Jungle' Video",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel3',
		    'taxonomy' => array(
			    'category' => 'metal,rock,videos',
			    'post_tag' => 'grammys-2018,indie-label,most-streamed-2017,top-chart-100',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:videos:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=-lyRNHCPTAE'
		    )
	    ),
	    'pnk-disputes-riff-with-christina-aguilera-after-ama-performance-reaction' => array(
		    'title' => "P!nk Disputes 'Riff' With Christina Aguilera After AMA Performance Reaction",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel4',
		    'taxonomy' => array(
			    'category' => 'artist,news,rock,videos',
			    'post_tag' => 'grammys-2018,rnb-hip-hop,top-chart-100,women-in-music',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:artist:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=AR764HY82Cs'
		    )
	    ),
	    'check-out-all-three-rihanna-covers-for-the-vogue-paris-december-2017-issue' => array(
		    'title' => "Check out All Three Rihanna Covers for the ‘Vogue’ Paris December 2017 Issue",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel5',
		    'taxonomy' => array(
			    'category' => 'culture,fashion,lifestyle',
			    'post_tag' => 'most-streamed-2017,pop,women-in-music'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
		    )
	    ),
	    'ed-sheeran-and-beyonces-perfect-is-surging-on-midweek-u-k-chart' => array(
		    'title' => "Ed Sheeran and Beyonce's 'Perfect' Is Surging On Midweek U.K. Chart",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'travel6',
		    'taxonomy' => array(
			    'category' => 'fashion,lifestyle,metal,news',
			    'post_tag' => 'best-of-2017,grammys-2018,indie-label,most-streamed-2017,pop,top-chart-100'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category::id}}')
		    )
	    ),
	    'warner-music-revenues-up-10-percent-in-2017-second-straight-profitable-year' => array(
		    'title' => "Warner Music Revenues Up 10 Percent in 2017, Second Straight Profitable Year",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion1',
		    'taxonomy' => array(
			    'category' => 'metal,news,rock',
			    'post_tag' => 'grammys-2018,indie-label,most-streamed-2017,podcast,pop,rnb-hip-hop'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:news:id}}')
		    )
	    ),
	    'noel-gallagher-responds-to-oasis-rock-and-roll-hall-of-fame-speculation' => array(
		    'title' => "Noel Gallagher responds to Oasis Rock and Roll Hall of Fame speculation",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'fashion2',
		    'taxonomy' => array(
			    'category' => 'artist,metal,news,rock,videos',
			    'post_tag' => 'grammys-2018,indie-label,most-streamed-2017,podcast,pop,top-chart-100'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:rock:id}}')
		    )
	    ),

        // page
        'home-1' => array(
            'title' => 'Home 1',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1512377882271{margin-bottom: 40px !important;background-color: #111111 !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'Latest News',
                    'second_title' => '',
                    'header_type' => 'heading_8',
                    'layout' => 'right-sidebar',
                    'sidebar' => 'home-loop',
                    'sticky_sidebar' => '1',
                    'module'    => '23',
                    'excerpt_length' => '30',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_2',
                    'pagination_align' => 'center',
                    'show_navtext' => '1',
                    'post_offset' => '2',
                    'sort_by' => 'latest',
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
                '_wpb_shortcodes_custom_css' => '.vc_custom_1513044266676{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #eeeeee !important;}.vc_custom_1513046171914{margin-bottom: 30px !important;}.vc_custom_1513046163553{margin-bottom: 30px !important;}.vc_custom_1512967949954{margin-bottom: 40px !important;border-top-width: 3px !important;border-right-width: 3px !important;border-bottom-width: 3px !important;border-left-width: 3px !important;padding-top: 25px !important;padding-right: 40px !important;padding-bottom: 25px !important;padding-left: 40px !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => '',
                    'second_title' => '',
                    'header_type' => 'heading_8',
                    'layout' => 'no-sidebar',
                    'sidebar' => 'default-sidebar',
                    'module'    => '27',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'pagination_align' => 'center',
                    'show_navtext' => '0',
                    'show_pageinfo' => '0',
                    'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1513044266676{margin-top: -30px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #eeeeee !important;}.vc_custom_1513046171914{margin-bottom: 30px !important;}.vc_custom_1513046163553{margin-bottom: 30px !important;}.vc_custom_1512967949954{margin-bottom: 40px !important;border-top-width: 3px !important;border-right-width: 3px !important;border-bottom-width: 3px !important;border-left-width: 3px !important;padding-top: 25px !important;padding-right: 40px !important;padding-bottom: 25px !important;padding-left: 40px !important;border-left-color: #eeeeee !important;border-left-style: solid !important;border-right-color: #eeeeee !important;border-right-style: solid !important;border-top-color: #eeeeee !important;border-top-style: solid !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}'
                )
            )
        ),
        'home-3' => array(
            'title' => 'Home 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1512976835198{margin-top: 30px !important;margin-bottom: 40px !important;padding-top: 40px !important;background-color: #000000 !important;}.vc_custom_1512978813047{margin-bottom: 30px !important;}.vc_custom_1512978822542{margin-bottom: 30px !important;}.vc_custom_1512979295697{margin-bottom: 40px !important;}',
	            '_wpb_post_custom_css' => '.jeg_postblock_27 .jeg_post_excerpt {display: none;}',
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.jeg_postblock_27 .jeg_post_excerpt {display: none;}.vc_custom_1512976835198{margin-top: 30px !important;margin-bottom: 40px !important;padding-top: 40px !important;background-color: #000000 !important;}.vc_custom_1512978813047{margin-bottom: 30px !important;}.vc_custom_1512978822542{margin-bottom: 30px !important;}.vc_custom_1512979295697{margin-bottom: 40px !important;}'
                )
            )
        ),
	    'footer' => array(
		    'title' => 'Footer',
		    'content' => 'footer.txt',
		    'post_type' => 'footer',
		    'metabox' => array(
			    '_elementor_data' => 'footer.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.jeg_footer .footer_dark h5 {font-size: 18px;color: #3bc5f8;font-weight: bold;}.jeg_footer .widget_categories ul {-webkit-columns: 3;columns: 3;-webkit-column-gap: 20px;column-gap: 20px;}'
			    ),
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1513050611045{padding-top: 60px !important;padding-bottom: 25px !important;background-color: #000000 !important;}.vc_custom_1512979959667{padding-bottom: 22px !important;background-color: #000000 !important;}.vc_custom_1512983784595{margin-bottom: 15px !important;}.vc_custom_1513050520235{margin-bottom: 0px !important;}',
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

        'news' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'News',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:news:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'artist' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Artist',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:artist:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'rock' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Rock',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:rock:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'metal' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Metal',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:metal:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'culture' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Culture',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:culture:id}}',
                'menu-item-status' => 'publish'
            )
        ),

        'fashion' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Fashion',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:fashion:id}}',
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
        'our-team' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Our Team',
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
        'privacy' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Privacy Policy',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),
        'contact' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Contact Us',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),

    ),

    'widget_position' => array(
        'Home',
        'Home 4',
        'Home 5',
	    'Home - Loop',
	    'Single Post'
    ),

    'widget' => array(
        'widget.json',
    ),

    'customizer' => array(
        'style.json',
    ),

    'plugin' => array(
	    'jnews-essential',
        'jnews-breadcrumb',
        'jnews-instagram',
        'jnews-jsonld',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'mailchimp-for-wp'
    )

);