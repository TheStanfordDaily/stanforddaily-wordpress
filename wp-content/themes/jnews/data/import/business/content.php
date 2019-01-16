<?php

return array(

    // image
    'image' =>  array(
        'news1' => 'http://jegtheme.com/asset/jnews/demo/default/news1.jpg',
        'news2' => 'http://jegtheme.com/asset/jnews/demo/default/news2.jpg',
        'news3' => 'http://jegtheme.com/asset/jnews/demo/default/news3.jpg',
        'news4' => 'http://jegtheme.com/asset/jnews/demo/default/news4.jpg',
        'news5' => 'http://jegtheme.com/asset/jnews/demo/default/news5.jpg',
        'news6' => 'http://jegtheme.com/asset/jnews/demo/default/news6.jpg',
        'news7' => 'http://jegtheme.com/asset/jnews/demo/default/news7.jpg',
        'news8' => 'http://jegtheme.com/asset/jnews/demo/default/news8.jpg',
        'news9' => 'http://jegtheme.com/asset/jnews/demo/default/news9.jpg',
        'news10' => 'http://jegtheme.com/asset/jnews/demo/default/news10.jpg',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/business/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/business/logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
        	'business' => array(
        		'title'         => 'Business',
		        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
	        'economy' => array(
		        'title'         => 'Economy',
		        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
	        'markets' => array(
		        'title'         => 'Markets',
		        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
	        'opinion' => array(
		        'title'         => 'Opinion',
		        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
	        'politics' => array(
		        'title'         => 'Politics',
		        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
	        'real-estate' => array(
		        'title'         => 'Real Estate',
		        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
	        'tech' => array(
		        'title'         => 'Tech',
		        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
		        'cryptocurrency' => array(
			        'title'         => 'Cryptocurrency',
			        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent'        => 'tech'
		        ),
		        'gadget' => array(
			        'title'         => 'Gadget',
			        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent'        => 'tech'
		        ),
		        'startup' => array(
			        'title'         => 'Startup',
			        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent'        => 'tech'
		        ),
	        'world' => array(
		        'title'         => 'World',
		        'description'   => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        )
        ),
        'post_tag' => array(
            'bitcoin' => array(
                'title' => 'Bitcoin',
            ),
            'business-analysis' => array(
                'title' => 'Business Analysis',
            ),
            'business-tips' => array(
                'title' => 'Business Tips',
            ),
            'gold-price' => array(
                'title' => 'Gold Price',
            ),
            'investment-loss' => array(
                'title' => 'Investment Loss'
            ),
            'market-stories' => array(
                'title' => 'Market Stories'
            ),
            'oil-market' => array(
                'title' => 'Oil Market'
            ),
            'sillicon-valley' => array(
                'title' => 'Sillicon Valley'
            ),
            'united-stated' => array(
                'title' => 'United Stated'
            ),
            'venture-capital' => array(
                'title' => 'Venture Capital'
            ),
            'wall-street' => array(
                'title' => 'Wall Street'
            ),
        )
    ),

    // post & page
    'post' => array(
    	'high-street-retailers-pin-hopes-on-discount-splurge-in-black-friday-fever' => array(
		    'title' => "High Street Retailers Pin Hopes On Discount Splurge In Black Friday Fever",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news1',
		    'taxonomy' => array(
			    'category' => 'business,economy,gadget,markets',
			    'post_tag' => 'gold-price,investment-loss,market-stories,united-stated,venture-capital,wall-street'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}')
		    )
	    ),
	    'uk-faces-two-decades-of-no-earnings-growth-and-more-austerity' => array(
		    'title' => "UK Faces Two Decades of No Earnings Growth and More Austerity",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news2',
		    'taxonomy' => array(
			    'category' => 'economy,opinion,politics,world',
			    'post_tag' => 'bitcoin,business-analysis,business-tips,gold-price,investment-loss,market-stories'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:economy:id}}'),
			    'post_subtitle' => 'A budget tells us what we can\'t afford, but it doesn\'t keep us from buying it.'
			)
		),
		'high-speed-traders-in-search-of-new-markets-jump-into-bitcoin' => array(
			'title' => "High-Speed Traders In Search of New Markets Jump Into Bitcoin",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'business,cryptocurrency,economy,markets',
				'post_tag' => 'bitcoin,gold-price,investment-loss,united-stated,venture-capital,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:cryptocurrency:id}}')
			)
		),
	    'twitter-tweaks-video-again-adding-view-counts-for-some-users' => array(
			'title' => "Brexit Has Created A Political Climate No Budget Can Fix",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'economy,opinion,politics,world',
				'post_tag' => 'bitcoin,gold-price,market-stories,oil-market,venture-capital,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:opinion:id}}'),
				'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
			)
		),
	    'bitcoins-main-rival-ethereum-hits-a-fresh-record-high-425-55' => array(
			'title' => "Bitcoin’s Main Rival Ethereum Hits A Fresh Record High: $425.55",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'business,cryptocurrency,markets,real-estate',
				'post_tag' => 'bitcoin,business-analysis,investment-loss,market-stories,oil-market,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:cryptocurrency:id}}'),
				'post_subtitle' => 'Its price has risen by more than 5,000 percent since the start of the year.'
			)
		),
	    'bitcoin-is-definitely-not-a-fraud-ceo-of-mobile-only-bank-revolut-says' => array(
			'title' => "Bitcoin Is 'definitely not a fraud,' CEO of Mobile-Only Bank Revolut Says",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news6',
			'taxonomy' => array(
				'category' => 'business,cryptocurrency,markets,opinion',
				'post_tag' => 'bitcoin,business-analysis,investment-loss,market-stories,united-stated,venture-capital'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}')
			)
		),
	    'betterment-moves-beyond-robo-advising-with-human-financial-planners' => array(
			'title' => "Betterment Moves Beyond Robo-Advising with Human Financial Planners",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news7',
			'taxonomy' => array(
				'category' => 'business,economy,real-estate,startup',
				'post_tag' => 'business-tips,market-stories,oil-market,sillicon-valley,venture-capital'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:startup:id}}')
			)
		),
	    'wall-streets-running-of-the-bulls-may-trample-investors' => array(
			'title' => "Wall Street's Running of the Bulls May Trample Investors",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'business,economy,markets,real-estate',
				'post_tag' => 'business-analysis,gold-price,investment-loss,market-stories,united-stated,venture-capital'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:markets:id}}')
			)
		),
	    'trumps-h-1b-visa-bill-spooks-indias-it-companies' => array(
			'title' => "Tesla’s Burning Through Nearly Half a Million Dollars Every Hour",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news9',
			'taxonomy' => array(
				'category' => 'gadget,politics,real-estate,startup',
				'post_tag' => 'bitcoin,business-tips,gold-price,oil-market,sillicon-valley,venture-capital'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
	    'economists-see-few-monetary-policy-changes-with-powell-leading-fed' => array(
			'title' => "Economists See Few Monetary Policy Changes With Powell Leading Fed",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news10',
			'taxonomy' => array(
				'category' => 'gadget,opinion,politics,world',
				'post_tag' => 'business-analysis,business-tips,gold-price,oil-market,sillicon-valley,venture-capital'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:world:id}}')
			)
		),
	    'saudi-trade-off-more-social-freedom-no-political-dissent' => array(
			'title' => "Saudi Trade-Off: More Social Freedom, No Political Dissent",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news1',
			'taxonomy' => array(
				'category' => 'economy,markets,politics,real-estate,world',
				'post_tag' => 'business-analysis,gold-price,investment-loss,sillicon-valley,united-stated,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:world:id}}'),
				'post_subtitle' => 'Crown Prince Mohammed bin Salman gives youth more leeway, as long as they don’t complain.'
			)
		),
	    'tether-theft-isnt-the-first-controversy-for-cryptocurrency-firm' => array(
			'title' => "Tether Theft Isn't the First Controversy for Cryptocurrency Firm",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news2',
			'taxonomy' => array(
				'category' => 'business,cryptocurrency,gadget,opinion',
				'post_tag' => 'bitcoin,business-analysis,business-tips,market-stories,oil-market,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:gadget:id}}')
			)
		),
	    'indonesias-largest-fleet-of-taxis-teams-up-to-beat-ride-hailing-apps' => array(
			'title' => "Indonesia's Largest Fleet of Taxis Teams Up To Beat Ride-Hailing Apps",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'business,economy,gadget,world',
				'post_tag' => 'bitcoin,business-tips,gold-price,market-stories,oil-market,sillicon-valley'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:world:id}}')
			)
		),
	    'instagram-is-testing-photo-albums-because-nothing-is-sacred-anymore' => array(
			'title' => "Instagram Is Testing Photo Albums, Because Nothing Is Sacred Anymore",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'business,gadget,real-estate',
				'post_tag' => 'business-tips,investment-loss,sillicon-valley,venture-capital,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:tech:id}}')
			)
		),
	    'china-reports-breaking-up-gang-that-moved-3-billion-abroad' => array(
			'title' => "China Reports Breaking Up Gang That Moved $3 Billion Abroad",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'economy,opinion,politics,world',
				'post_tag' => 'business-tips,gold-price,investment-loss,market-stories,oil-market,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:economy:id}}')
			)
		),
	    'the-next-generation-of-cryptocurrency-hardware-advanced-atms' => array(
			'title' => "The Next Generation of Cryptocurrency Hardware: Advanced ATMs",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news6',
			'taxonomy' => array(
				'category' => 'business,cryptocurrency,economy,politics',
				'post_tag' => 'bitcoin,business-analysis,gold-price,sillicon-valley,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:cryptocurrency:id}}')
			)
		),
	    'u-s-online-sales-surge-shoppers-throng-stores-on-thanksgiving-evening' => array(
			'title' => "U.S. Online Sales Surge, Shoppers Throng Stores On Thanksgiving Evening",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news7',
			'taxonomy' => array(
				'category' => 'business,economy,opinion,startup,world',
				'post_tag' => 'business-tips,market-stories,oil-market,sillicon-valley,venture-capital'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}')
			)
		),
	    'central-banks-are-right-when-they-say-no-one-understands-them' => array(
			'title' => "Central Banks Are Right When They Say No One Understands Them",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'cryptocurrency,markets,real-estate,startup',
				'post_tag' => 'business-analysis,investment-loss,market-stories,united-stated,venture-capital,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:markets:id}}')
			)
		),
	    'china-stocks-tumble-after-latest-signs-of-beijings-markets-crusade' => array(
			'title' => "China Stocks Tumble After Latest Signs of Beijing’s Markets Crusade",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news9',
			'taxonomy' => array(
				'category' => 'economy,opinion,politics,world',
				'post_tag' => 'bitcoin,gold-price,oil-market,united-stated,venture-capital,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
	    'hotshot-snapchat-founders-face-a-dilemma-lie-low-or-live-large' => array(
			'title' => "Hotshot Snapchat Founders Face a Dilemma: Lie Low or Live Large?",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news10',
			'taxonomy' => array(
				'category' => 'business,opinion,real-estate,startup,world',
				'post_tag' => 'business-tips,market-stories,oil-market,sillicon-valley,united-stated,venture-capital'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:real-estate:id}}')
			)
		),
	    'president-trump-threatens-to-send-u-s-troops-to-mexico-to-take-care-of-bad-hombres' => array(
			'title' => "Black Friday Merchants Look to Extend Moment of Retail Optimism",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news2',
			'taxonomy' => array(
				'category' => 'business,cryptocurrency,markets,opinion',
				'post_tag' => 'bitcoin,business-analysis,business-tips,gold-price,investment-loss,oil-market'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:markets:id}}'),
				'post_subtitle' => 'A budget tells us what we can\'t afford, but it doesn\'t keep us from buying it.'
			)
	    ),
	    'people-are-handing-out-badges-at-tube-stations-to-tackle-loneliness' => array(
			'title' => "U.K. Floats Open-Ended Irish Veto to Break Brexit Impasse",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'gadget,politics,real-estate',
				'post_tag' => 'bitcoin,business-analysis,oil-market,sillicon-valley,united-stated,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
	    'a-1-trillion-wealth-fund-notes-red-flag-in-real-estate-market' => array(
			'title' => "A $1 Trillion Wealth Fund Notes 'Red Flag' in Real Estate Market",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'economy,real-estate,startup,world',
				'post_tag' => 'bitcoin,business-tips,investment-loss,sillicon-valley,united-stated,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:real-estate:id}}')
			)
		),
	    'fund-tracking-bitcoin-launches-in-europe-as-crypto-gains-backers' => array(
			'title' => "Fund Tracking Bitcoin Launches in Europe as Crypto Gains Backers",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'cryptocurrency,economy,gadget,startup,world',
				'post_tag' => 'business-tips,gold-price,investment-loss,sillicon-valley,united-stated,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:cryptocurrency:id}}')
			)
		),
	    'uber-hacking-customers-not-at-risk-of-financial-crime-says-minister' => array(
			'title' => "Uber Hacking: Customers Not at Risk of Financial Crime, Says Minister",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news6',
			'taxonomy' => array(
				'category' => 'business,opinion,politics,world',
				'post_tag' => 'bitcoin,investment-loss,oil-market,sillicon-valley,venture-capital,wall-street'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:opinion:id}}')
			)
		),
	    'watch-justin-timberlakes-cry-me-a-river-come-to-life-in-mesmerizing-dance' => array(
			'title' => "Inside the Chinese Bitcoin Mine That's Grossing $1.5M a Month",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news7',
			'taxonomy' => array(
				'category' => 'business,cryptocurrency,gadget,startup',
				'post_tag' => 'business-analysis,business-tips,gold-price,investment-loss,sillicon-valley,venture-capital',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:cryptocurrency:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=K8kua5B5K3I'
			)
		),
	    'oil-heads-for-best-weekly-gain-in-month-on-keystone-disruption' => array(
			'title' => "Oil Heads for Best Weekly Gain in Month on Keystone Disruption",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'economy,politics,real-estate,world',
				'post_tag' => 'business-analysis,gold-price,market-stories,oil-market,venture-capital'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:economy:id}}')
			)
		),
		'three-startups-that-wowed-jack-ma-and-won-alibabas-backing' => array(
			'title' => "Three Startups That Wowed Jack Ma and Won Alibaba's Backing",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news9',
			'taxonomy' => array(
				'category' => 'gadget,markets,opinion,startup',
				'post_tag' => 'bitcoin,business-analysis,business-tips,market-stories,oil-market,united-stated'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:startup:id}}')
			)
		),


        // page
        'home-1' => array(
            'title'     => 'Home 1',
            'content'   => 'home1.txt',
            'post_type' => 'page',
            'metabox'   => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1512016752396{margin-top: -20px !important;margin-bottom: 30px !important;}.vc_custom_1511342124026{margin-bottom: 0px !important;}.vc_custom_1511342337732{margin-bottom: -20px !important;}.vc_custom_1512014313652{margin-top: 0px !important;margin-bottom: 0px !important;}.vc_custom_1512016730597{margin-top: -20px !important;margin-bottom: 20px !important;}',
                'jnews_page_loop' => array(
	                'enable_page_loop'      => '1',
	                'first_title'           => 'News Index',
	                'header_type'           => 'heading_5',
	                'layout'                => 'right-sidebar',
	                'sticky_sidebar'        => '1',
	                'sidebar'               => 'home-loop',
	                'module'                => '3',
	                'excerpt_length'        => '20',
	                'content_date'          => 'default',
	                'content_pagination'    => 'nav_1',
	                'show_navtext'          => '0',
	                'show_pageinfo'         => '0',
	                'pagination_align'      => 'left',
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1512016752396{margin-top: -20px !important;margin-bottom: 30px !important;}.vc_custom_1511342124026{margin-bottom: 0px !important;}.vc_custom_1511342337732{margin-bottom: -20px !important;}.vc_custom_1512014313652{margin-top: 0px !important;margin-bottom: 0px !important;}.vc_custom_1512016730597{margin-top: -20px !important;margin-bottom: 20px !important;}.elementor-element-8b40258 .elementor-divider {padding: 0 !important;}'
                )
            )
        ),
        'home-2' => array(
            'title'     => 'Home 2',
            'content'   => 'home2.txt',
            'post_type' => 'page',
            'metabox'   => array(
                '_wp_page_template' => 'template-builder.php',
                'jnews_page_loop' => array(
	                'enable_page_loop'      => '1',
	                'first_title'           => 'News Index',
	                'header_type'           => 'heading_5',
	                'layout'                => 'no-sidebar',
	                'sticky_sidebar'        => '1',
	                'module'                => '22',
	                'excerpt_length'        => '20',
	                'content_date'          => 'default',
	                'content_pagination'    => 'nav_1',
	                'show_navtext'          => '0',
	                'show_pageinfo'         => '0',
	                'pagination_align'      => 'center',
	                'post_offset'           => '6'
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder'
            )
        ),
        'home-3' => array(
            'title'     => 'Home 3',
            'content'   => 'home3.txt',
            'post_type' => 'page',
            'metabox'   => array(
                '_wp_page_template' => 'template-builder.php',
	            '_wpb_shortcodes_custom_css' => '.vc_custom_1511857007652{margin-bottom: 20px !important;}.vc_custom_1511856448607{margin-bottom: 20px !important;}.vc_custom_1511858134941{margin-bottom: 20px !important;}.vc_custom_1511858126629{margin-top: 0px !important;margin-bottom: 0px !important;}.vc_custom_1512007027792{margin-top: -15px !important;margin-bottom: 40px !important;}.vc_custom_1512007088900{margin-bottom: 20px !important;}',
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1511857007652{margin-bottom: 20px !important;}.vc_custom_1511856448607{margin-bottom: 20px !important;}.vc_custom_1511858134941{margin-bottom: 20px !important;}.vc_custom_1511858126629{margin-top: 0px !important;margin-bottom: 0px !important;}.vc_custom_1512007027792{margin-top: -15px !important;margin-bottom: 40px !important;}.vc_custom_1512007088900{margin-bottom: 20px !important;}'
                )
            )
        ),
        'home-4' => array(
            'title'     => 'Home 4',
            'content'   => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
	            '_wpb_shortcodes_custom_css' => '.vc_custom_1511860982119{background-color: #00122c !important;}.vc_custom_1511860579780{margin-bottom: 0px !important;}',
                'jnews_page_loop' => array(
	                'enable_page_loop'      => '1',
	                'first_title'           => 'Latest News',
	                'header_type'           => 'heading_8',
	                'layout'                => 'right-sidebar',
	                'sidebar'               => 'home-loop',
	                'sticky_sidebar'        => '1',
	                'module'                => '23',
	                'excerpt_length'        => '20',
	                'content_date'          => 'default',
	                'content_pagination'    => 'nav_1',
	                'show_navtext'          => '0',
	                'show_pageinfo'         => '0',
	                'pagination_align'      => 'center',
	                'post_offset'           => '4'
                ),
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1511860982119{background-color: #00122c !important;}.vc_custom_1511860579780{margin-bottom: 0px !important;}.jeg_postblock_carousel_2 .owl-carousel .owl-nav div {bottom: 50%;transform: translateY(50%);width: 28px;}.jeg_postblock_carousel_2 .owl-carousel .owl-nav .owl-prev {left: -60px;}.jeg_postblock_carousel_2 .owl-carousel .owl-nav .owl-next {right: -60px;}'
                )
            )
        ),
        'home-5' => array(
            'title'     => 'Home 5',
            'content'   => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1512011295511{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f7f7f7 !important;}.vc_custom_1512012739570{margin-bottom: 0px !important;border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1512011036478{margin-bottom: 35px !important;}.vc_custom_1512012480689{border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1511858134941{margin-bottom: 20px !important;}.vc_custom_1512010716042{margin-top: 0px !important;margin-bottom: 0px !important;}.vc_custom_1512007027792{margin-top: -15px !important;margin-bottom: 40px !important;}.vc_custom_1512011198395{margin-bottom: 0px !important;}.vc_custom_1512012594962{border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1512012780552{border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1512011451668{border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1512011373389{border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}',
                'jnews_page_loop' => array(
	                'enable_page_loop'      => '1',
	                'first_title'           => '',
	                'header_type'           => 'heading_6',
	                'layout'                => 'no-sidebar',
	                'sticky_sidebar'        => '1',
	                'module'                => '23',
	                'excerpt_length'        => '20',
	                'content_date'          => 'default',
	                'content_pagination'    => 'nav_1',
	                'show_navtext'          => '0',
	                'show_pageinfo'         => '0',
	                'pagination_align'      => 'center',
                ),
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1512011295511{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f7f7f7 !important;}.vc_custom_1512012739570{margin-bottom: 0px !important;border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1512011036478{margin-bottom: 35px !important;}.vc_custom_1512012480689{border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1511858134941{margin-bottom: 20px !important;}.vc_custom_1512010716042{margin-top: 0px !important;margin-bottom: 0px !important;}.vc_custom_1512007027792{margin-top: -15px !important;margin-bottom: 40px !important;}.vc_custom_1512011198395{margin-bottom: 0px !important;}.vc_custom_1512012594962{border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1512012780552{border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1512011451668{border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}.vc_custom_1512011373389{border-top-width: 1px !important;border-top-color: #eeeeee !important;border-top-style: solid !important;}'
                )
            )
        ),
	    'advertise' => array(
		    'title'     => 'Advertise',
		    'content'   => 'advertise.txt',
		    'post_type' => 'page',
		    'metabox'   => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1511853168881{margin-top: -30px !important;}.vc_custom_1511854141443{padding-top: 60px !important;padding-bottom: 60px !important;background-color: #f0f7fb !important;}.vc_custom_1510724395057{padding-bottom: 40px !important;}.vc_custom_1511853196596{padding: 20px !important;background-color: #ffffff !important;}.vc_custom_1511852476911{margin-bottom: 20px !important;}.vc_custom_1511853196596{padding: 20px !important;background-color: #ffffff !important;}.vc_custom_1510720799994{margin-bottom: 20px !important;}.vc_custom_1511853196596{padding: 20px !important;background-color: #ffffff !important;}.vc_custom_1511852523377{margin-bottom: 20px !important;}.vc_custom_1511853196596{padding: 20px !important;background-color: #ffffff !important;}.vc_custom_1510720806593{margin-bottom: 20px !important;}.vc_custom_1510652209240{padding-right: 60px !important;}.vc_custom_1510725324274{padding-right: 40px !important;padding-left: 40px !important;}.vc_custom_1511853817262{margin-bottom: 25px !important;}.vc_custom_1510725777045{padding-right: 60px !important;}.vc_custom_1511853844391{margin-bottom: 25px !important;}.vc_custom_1510729092548{padding-top: 60px !important;padding-bottom: 60px !important;}.vc_custom_1510729361931{padding-right: 40px !important;}.vc_custom_1511853996045{margin-top: 0px !important;}'
		    )
	    ),
	    'contact' => array(
		    'title'     => 'Contact Us',
		    'content'   => 'contact.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'default',
			    '_wpb_shortcodes_custom_css' => '',
			    'jnews_single_page' => array(
			    	'layout' => 'right-sidebar',
				    'sidebar' => 'author',
				    'sticky_sidebar' => '0',
				    'show_post_meta' => '0',
				    'share_position' => '0'
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

        'world' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'World',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:world:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'economy' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Economy',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:economy:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'business' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Business',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:business:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'opinion' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Opinion',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:opinion:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'markets' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Markets',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:markets:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'tech' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Tech',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:tech:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'real-estate' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Real Estate',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:real-estate:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),

        // Footer & Topbar Menu
        'home-footer' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Home',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:home-1:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'advertise' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Advertisement',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:advertise:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'contact' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Contact Us',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:contact:id}}',
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
        'other' => array(
            'location' => 'footer-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Other Links',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish'
            )
        ),

        // Mobile Menu
        'advertise-1' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Advertisement',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:advertise:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'contact-1' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Contact Us',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:contact:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'home-mobile' => array(
            'location' => 'mobile-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Homepages',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:home-1:id}}',
                'menu-item-status' => 'publish'
            )
        ),
	        'home-1-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Home 1',
			        'menu-item-parent-id' => '{{menu:home-mobile:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-1:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'home-2-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Home 2',
			        'menu-item-parent-id' => '{{menu:home-mobile:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-2:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'home-3-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Home 3',
			        'menu-item-parent-id' => '{{menu:home-mobile:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-3:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'home-4-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Home 4',
			        'menu-item-parent-id' => '{{menu:home-mobile:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-4:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'home-5-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Home 5',
			        'menu-item-parent-id' => '{{menu:home-mobile:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-5:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
        'world-mobile' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'World',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:world:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'economy-mobile' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Economy',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:economy:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'business-mobile' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Business',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:business:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'opinion-mobile' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Opinion',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:opinion:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'markets-mobile' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Markets',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:markets:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'tech-mobile' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Tech',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:tech:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'real-estate-mobile' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Real Estate',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:real-estate:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
    ),

    'widget_position' => array(
        'Stock Sticker',
        'Home',
        'Home - Loop',
	    'Home - 4',
        'Author'
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
        'jnews-auto-load-post',
        'jnews-instagram',
        'jnews-jsonld',
        'jnews-meta-header',
        'jnews-social-login',
        'jnews-social-share',
        'jnews-view-counter',
        'jnews-weather',
    )

);