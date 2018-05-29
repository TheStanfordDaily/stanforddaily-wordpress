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
        'logo' => 'http://jegtheme.com/asset/jnews/demo/crypto/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/crypto/logo@2x.png',
        'footer_logo' => 'http://jegtheme.com/asset/jnews/demo/crypto/footer_logo.png',
        'footer_logo2x' => 'http://jegtheme.com/asset/jnews/demo/crypto/footer_logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
        	'bitcoin' => array(
        		'title'         => 'Bitcoin',
		        'description'   => 'You can add some category description here.'
	        ),
	        'blockchain' => array(
		        'title'         => 'Blockchain',
		        'description'   => 'You can add some category description here.'
	        ),
	        'business' => array(
		        'title'         => 'Business',
		        'description'   => 'You can add some category description here.'
	        ),
	        'ethereum' => array(
		        'title'         => 'Ethereum',
		        'description'   => 'You can add some category description here.'
	        ),
	        'guide' => array(
		        'title'         => 'Guide',
		        'description'   => 'You can add some category description here.'
	        ),
	        'market' => array(
		        'title'         => 'Market',
		        'description'   => 'You can add some category description here.'
	        ),
	        'regulation' => array(
		        'title'         => 'Regulation',
		        'description'   => 'You can add some category description here.'
	        ),
	        'ripple' => array(
		        'title'         => 'Ripple',
		        'description'   => 'You can add some category description here.'
	        )
        ),
        'post_tag' => array(
	        'altcoin' => array(
		        'title' => 'Altcoin',
	        ),
            'bitcoin-drops' => array(
                'title' => 'Bitcoin drops',
            ),
            'bitcoin-wallet' => array(
                'title' => 'Bitcoin Wallet',
            ),
            'cointelegraph' => array(
                'title' => 'Cointelegraph',
            ),
            'cryptocurrency' => array(
                'title' => 'Cryptocurrency',
            ),
            'ico' => array(
                'title' => 'ICO'
            ),
            'investment' => array(
                'title' => 'Investment'
            ),
            'lending' => array(
                'title' => 'Lending'
            ),
            'market-stories' => array(
                'title' => 'Market Stories'
            ),
            'mining-bitcoin' => array(
                'title' => 'Mining Bitcoin'
            )
        )
    ),

    // post & page
    'post' => array(
	    'us-commodities-regulator-beefs-up-bitcoin-futures-review' => array(
		    'title' => "US Commodities Regulator Beefs Up Bitcoin Futures Review",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news1',
		    'taxonomy' => array(
			    'category' => 'bitcoin,blockchain,regulation',
			    'post_tag' => 'altcoin,ico,investment,market-stories,mining-bitcoin'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:bitcoin:id}}')
		    )
	    ),
	    'saudi-trade-off-more-social-freedom-no-political-dissent' => array(
		    'title' => "Bitcoin Hits 2018 Low as Concerns Mount on Regulation, Viability",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news2',
		    'taxonomy' => array(
			    'category' => 'business,market,regulation',
			    'post_tag' => 'bitcoin-wallet,cointelegraph,ico,investment,mining-bitcoin'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:bitcoin:id}}')
		    )
	    ),
	    'india-bitcoin-prices-drop-as-media-misinterprets-govs-regulation-speech' => array(
		    'title' => "India: Bitcoin Prices Drop As Media Misinterprets Gov’s Regulation Speech",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news3',
		    'taxonomy' => array(
			    'category' => 'bitcoin,guide,regulation',
			    'post_tag' => 'altcoin,cryptocurrency,ico,lending,market-stories'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:regulation:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'bitcoins-main-rival-ethereum-hits-a-fresh-record-high-425-55' => array(
		    'title' => "Bitcoin’s Main Rival Ethereum Hits A Fresh Record High: $425.55",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news4',
		    'taxonomy' => array(
			    'category' => 'blockchain,business,ethereum,ripple',
			    'post_tag' => 'cointelegraph,cryptocurrency,investment,lending,market-stories'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:ethereum:id}}'),
			    'post_subtitle' => 'Its price has risen by more than 5,000 percent since the start of the year.'
		    )
	    ),
	    'bitcoin-is-definitely-not-a-fraud-ceo-of-mobile-only-bank-revolut-says' => array(
		    'title' => "Bitcoin Is 'Definitely Not a Fraud,' CEO of Mobile-Only Bank Revolut Says",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news5',
		    'taxonomy' => array(
			    'category' => 'bitcoin,business,ethereum,market,ripple',
			    'post_tag' => 'altcoin,cointelegraph,cryptocurrency,investment,market-stories,mining-bitcoin'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}')
		    )
	    ),
	    'high-speed-traders-in-search-of-new-markets-jump-into-bitcoin' => array(
		    'title' => "High-Speed Traders In Search of New Markets Jump Into Bitcoin",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news6',
		    'taxonomy' => array(
			    'category' => 'blockchain,business,market',
			    'post_tag' => 'altcoin,cryptocurrency,ico,investment,mining-bitcoin'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:market:id}}')
		    )
	    ),
	    'wolf-of-wall-street-says-bitcoin-could-hit-50k-before-crashing' => array(
		    'title' => "Wolf Of Wall Street Says Bitcoin Could Hit $50K Before Crashing",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'news7',
		    'taxonomy' => array(
			    'category' => 'bitcoin,business,market,ripple',
			    'post_tag' => 'bitcoin-drops,cointelegraph,cryptocurrency,ico,investment,market-stories'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}'),
			    'post_subtitle' => 'A budget tells us what we can\'t afford, but it doesn\'t keep us from buying it.'
			)
		),
		'cryptocurrency-breaches-9000-for-first-time-since-november' => array(
			'title' => "Cryptocurrency Breaches $9,000 For First Time Since November",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'blockchain,market,regulation',
				'post_tag' => 'altcoin,cointelegraph,ico,investment,market-stories,mining-bitcoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:market:id}}')
			)
		),
		'beginners-guide-what-you-should-know-about-cryptocurrency' => array(
			'title' => "Beginners Guide: What You Should Know About Cryptocurrency",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news9',
			'taxonomy' => array(
				'category' => 'blockchain,guide',
				'post_tag' => 'altcoin,bitcoin-drops,bitcoin-wallet,cryptocurrency,ico,lending'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:guide:id}}')
			)
		),
		'enterprise-ethereum-alliance-appoints-first-executive-director' => array(
			'title' => "Enterprise Ethereum Alliance Appoints First Executive Director",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news10',
			'taxonomy' => array(
				'category' => 'blockchain,business,ethereum',
				'post_tag' => 'altcoin,bitcoin-drops,bitcoin-wallet,cointelegraph,ico,lending'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:ethereum:id}}')
			)
		),
		'ethereum-founder-one-of-bloombergs-top-50-most-influential-people' => array(
			'title' => "Ethereum Founder One of Bloomberg’s Top 50 Most Influential People",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news1',
			'taxonomy' => array(
				'category' => 'business,ethereum,market',
				'post_tag' => 'altcoin,bitcoin-drops,bitcoin-wallet,lending,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:ethereum:id}}')
			)
		),
		'tether-theft-isnt-the-first-controversy-for-cryptocurrency-firm' => array(
			'title' => "Tether Theft Isn't the First Controversy for Cryptocurrency Firm",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news2',
			'taxonomy' => array(
				'category' => 'blockchain,business,regulation',
				'post_tag' => 'bitcoin-drops,cointelegraph,cryptocurrency,lending,market-stories,mining-bitcoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:regulation:id}}')
			)
		),
		'jack-dorseys-square-launches-bitcoin-trading-for-cash-app-users' => array(
			'title' => "Jack Dorsey's Square Launches Bitcoin Trading For Cash App Users",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'blockchain,business',
				'post_tag' => 'bitcoin-drops,bitcoin-wallet,cryptocurrency,ico,lending,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}')
			)
		),
		'what-is-blockchain-technology-a-step-by-step-guide-for-beginners' => array(
			'title' => "What is Blockchain Technology? A Step-by-Step Guide For Beginners",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'guide',
				'post_tag' => 'altcoin,bitcoin-drops,bitcoin-wallet,investment'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:guide:id}}')
			)
		),
		'facebook-bans-all-cryptocurrency-advertising-including-bitcoin-ethereum' => array(
			'title' => "Facebook Bans All Cryptocurrency Advertising, Including Bitcoin & Ethereum",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'bitcoin,blockchain,ethereum,regulation,ripple',
				'post_tag' => 'bitcoin-drops,ico,investment,lending,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:regulation:id}}')
			)
		),
		'blockchain-bloat-how-ethereum-is-tackling-storage-issues' => array(
			'title' => "Blockchain Bloat: How Ethereum Is Tackling Storage Issues",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news6',
			'taxonomy' => array(
				'category' => 'business,ethereum',
				'post_tag' => 'bitcoin-wallet,cointelegraph,cryptocurrency,ico'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:ethereum:id}}')
			)
		),
		'bitcoin-near-bottom-will-rally-to-20k-this-year-early-bitcoin-investor' => array(
			'title' => "Bitcoin Near Bottom, Will Rally To $20K This Year: Early Bitcoin Investor",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news7',
			'taxonomy' => array(
				'category' => 'bitcoin,blockchain,market',
				'post_tag' => 'altcoin,bitcoin-drops,bitcoin-wallet,lending,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:market:id}}')
			)
		),
		'central-banks-are-right-when-they-say-no-one-understands-them' => array(
			'title' => "Central Banks Are Right When They Say No One Understands Them",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'business,regulation',
				'post_tag' => 'altcoin,cointelegraph,investment,market-stories,mining-bitcoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}')
			)
		),
		'crypto-market-crash-not-the-new-years-present-everyone-hoped-for' => array(
			'title' => "Crypto Market Crash - Not The New Year’s Present Everyone Hoped For",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news9',
			'taxonomy' => array(
				'category' => 'blockchain,market',
				'post_tag' => 'altcoin,cryptocurrency,ico,lending,mining-bitcoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:market:id}}')
			)
		),
		'what-is-the-difference-between-public-and-permissioned-blockchains' => array(
			'title' => "What is the Difference Between Public and Permissioned Blockchains?",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news10',
			'taxonomy' => array(
				'category' => 'guide',
				'post_tag' => 'altcoin,bitcoin-drops,bitcoin-wallet,lending,market-stories,mining-bitcoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:guide:id}}')
			)
		),
		'bitconnect-shuts-down-after-accused-of-running-a-ponzi-scheme' => array(
			'title' => "Bitconnect Shuts Down After Accused Of Running A Ponzi Scheme",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news1',
			'taxonomy' => array(
				'category' => 'blockchain,regulation',
				'post_tag' => 'bitcoin-drops,cointelegraph,cryptocurrency,ico,investment,lending'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:blockchain:id}}'),
				'post_subtitle' => 'A budget tells us what we can\'t afford, but it doesn\'t keep us from buying it.'
			)
		),
		'beginners-guide-how-to-use-smart-contracts-for-revenue-sharing-explained' => array(
			'title' => "Beginners Guide: How to Use Smart Contracts For Revenue Sharing, Explained",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news2',
			'taxonomy' => array(
				'category' => 'guide',
				'post_tag' => 'bitcoin-wallet,cointelegraph,cryptocurrency,lending,mining-bitcoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:guide:id}}')
			)
		),
		'samsung-confirms-it-is-making-asic-chips-for-cryptocurrency-mining' => array(
			'title' => "Samsung Confirms It Is Making Asic Chips For Cryptocurrency Mining",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news3',
			'taxonomy' => array(
				'category' => 'bitcoin,market',
				'post_tag' => 'bitcoin-drops,bitcoin-wallet,cryptocurrency,investment,mining-bitcoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}')
			)
		),
		'fund-tracking-bitcoin-launches-in-europe-as-crypto-gains-backers' => array(
			'title' => "Fund Tracking Bitcoin Launches in Europe as Crypto Gains Backers",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news4',
			'taxonomy' => array(
				'category' => 'bitcoin,guide,market,regulation',
				'post_tag' => 'bitcoin-drops,bitcoin-wallet,ico,investment,mining-bitcoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:market:id}}')
			)
		),
		'all-you-need-to-know-about-this-whole-segwit-vs-segwit2x-thing' => array(
			'title' => "All You Need to Know About This Whole SegWit vs. SegWit2x Thing",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news5',
			'taxonomy' => array(
				'category' => 'guide',
				'post_tag' => 'altcoin,bitcoin-wallet,cryptocurrency,investment,lending'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:guide:id}}')
			)
		),
		'watch-justin-timberlakes-cry-me-a-river-come-to-life-in-mesmerizing-dance' => array(
			'title' => "Inside the Chinese Bitcoin Mine That's Grossing $1.5M a Month",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news6',
			'taxonomy' => array(
				'category' => 'bitcoin,ethereum,guide,market,ripple',
				'post_tag' => 'altcoin,bitcoin-drops,bitcoin-wallet,cointelegraph,ico,investment',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:ethereum:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=K8kua5B5K3I'
			)
		),
		'china-is-reportedly-moving-to-clamp-down-on-bitcoin-miners' => array(
			'title' => "China Is Reportedly Moving To Clamp Down On Bitcoin Miners",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'news7',
			'taxonomy' => array(
				'category' => 'guide,market,regulation',
				'post_tag' => 'altcoin,cointelegraph,ico,lending,market-stories'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:regulation:id}}')
			)
		),
		'a-major-vulnerability-has-frozen-hundreds-of-millions-of-dollars-of-ethereum' => array(
			'title' => "A Major Vulnerability Has Frozen Hundreds Of Millions Of Dollars Of Ethereum",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'news8',
			'taxonomy' => array(
				'category' => 'bitcoin,ethereum,market,ripple',
				'post_tag' => 'bitcoin-drops,cointelegraph,cryptocurrency,lending,market-stories,mining-bitcoin'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:ethereum:id}}')
			)
		),
        
        // page
        'home-1' => array(
            'title'     => 'Home 1',
            'content'   => 'home1.txt',
            'post_type' => 'page',
            'metabox'   => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1517797873722{margin-top: -30px !important;margin-bottom: 30px !important;border-bottom-width: 1px !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1517972384474{margin-bottom: 40px !important;padding-top: 25px !important;padding-bottom: 15px !important;background-color: #f3f3f3 !important;}.vc_custom_1518077048960{margin-bottom: -1px !important;}.vc_custom_1517900383918{margin-bottom: 0px !important;}',
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1517797873722{margin-top: -30px !important;margin-bottom: 30px !important;border-bottom-width: 1px !important;border-bottom-color: #eeeeee !important;border-bottom-style: solid !important;}.vc_custom_1517972384474{margin-bottom: 40px !important;padding-top: 25px !important;padding-bottom: 15px !important;background-color: #f3f3f3 !important;}.vc_custom_1518077048960{margin-bottom: -1px !important;}.vc_custom_1517900383918{margin-bottom: 0px !important;}.jeg_breakingnews {margin-bottom: 0;}'
                )
            )
        ),
        'home-2' => array(
            'title'     => 'Home 2',
            'content'   => 'home2.txt',
            'post_type' => 'page',
            'metabox'   => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1517993998548{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f3f3f3 !important;}.vc_custom_1517986614897{margin-bottom: 10px !important;}.vc_custom_1517993398803{border-bottom-width: 20px !important;padding-top: 15px !important;padding-right: 20px !important;padding-left: 20px !important;background-color: #191818 !important;}.vc_custom_1517994006112{margin-bottom: 0px !important;}',
                '_wpb_post_custom_css' => '#tickerwidget span, #tickerwidget a {display: none !important;}',
                'jnews_page_loop' => array(
	                'enable_page_loop'      => '1',
	                'first_title'           => 'News Index',
	                'header_type'           => 'heading_7',
	                'layout'                => 'right-sidebar',
	                'sidebar'               => 'home-loop',
	                'sticky_sidebar'        => '1',
	                'module'                => '3',
	                'excerpt_length'        => '20',
	                'content_date'          => 'default',
	                'content_pagination'    => 'nav_1',
	                'show_navtext'          => '0',
	                'show_pageinfo'         => '0',
	                'pagination_align'      => 'left'
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1517993998548{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f3f3f3 !important;}.vc_custom_1517986614897{margin-bottom: 10px !important;}.vc_custom_1517993398803{border-bottom-width: 20px !important;padding-top: 15px !important;padding-right: 20px !important;padding-left: 20px !important;background-color: #191818 !important;}.vc_custom_1517994006112{margin-bottom: 0px !important;}#tickerwidget span, #tickerwidget a {display: none !important;}'
                )
            )
        ),
        'home-3' => array(
            'title'     => 'Home 3',
            'content'   => 'home3.txt',
            'post_type' => 'page',
            'metabox'   => array(
                '_wp_page_template' => 'template-builder.php',
	            '_wpb_shortcodes_custom_css' => '.vc_custom_1517998328794{background-color: #191818 !important;}.vc_custom_1518000459703{border-top-width: 2px !important;border-right-width: 2px !important;border-bottom-width: 2px !important;border-left-width: 2px !important;padding-top: 30px !important;padding-right: 30px !important;padding-bottom: 5px !important;padding-left: 30px !important;border-left-color: #fcb11e !important;border-left-style: solid !important;border-right-color: #fcb11e !important;border-right-style: solid !important;border-top-color: #fcb11e !important;border-top-style: solid !important;border-bottom-color: #fcb11e !important;border-bottom-style: solid !important;}.vc_custom_1518000298753{margin-bottom: 0px !important;}',
                '_wpb_post_custom_css' => '.jeg_hero_style_4 .jeg_post_meta {display: none;}',
                'jnews_page_loop' => array(
	                'enable_page_loop'      => '1',
	                'first_title'           => '',
	                'header_type'           => 'heading_8',
	                'layout'                => 'no-sidebar',
	                'module'                => '23',
	                'excerpt_length'        => '20',
	                'content_date'          => 'default',
	                'content_pagination'    => 'nav_1',
	                'show_navtext'          => '0',
	                'show_pageinfo'         => '0',
	                'pagination_align'      => 'center',
	                'post_offset'           => '4'
                ),
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1517998328794{background-color: #191818 !important;}.vc_custom_1518000459703{border-top-width: 2px !important;border-right-width: 2px !important;border-bottom-width: 2px !important;border-left-width: 2px !important;padding-top: 30px !important;padding-right: 30px !important;padding-bottom: 5px !important;padding-left: 30px !important;border-left-color: #fcb11e !important;border-left-style: solid !important;border-right-color: #fcb11e !important;border-right-style: solid !important;border-top-color: #fcb11e !important;border-top-style: solid !important;border-bottom-color: #fcb11e !important;border-bottom-style: solid !important;}.vc_custom_1518000298753{margin-bottom: 0px !important;}.jeg_hero_style_4 .jeg_post_meta {display: none;}.jeg_postblock_carousel_2 {margin-bottom: 0;}'
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
				    'custom_css' => '.jeg_footer p {margin-bottom: 0;}.elementor-widget-container h5 {font-weight: 700;color: #fcbf46 !important;}.elementor-widget-wp-widget-categories ul {-webkit-columns: 2;columns: 2;-webkit-column-gap: 20px;column-gap: 20px;}.elementor-widget-wp-widget-categories ul li a {color: #212121;display: inline-block;font-weight: 700;}.elementor-widget-jnews_footer_menu_elementor {margin-bottom: 0 !important;margin-top: 1em;}.elementor-element .mc4wp-form {padding: 0 !important;border: none !important;margin: 0 !important;}.jeg_footer .footer_dark input[type=submit] {background: #fcb11e;}.mc4wp-form-fields p:nth-child(2) {padding: 15px 0;}'
			    ),
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
				    'sidebar' => 'page',
				    'sticky_sidebar' => '0',
				    'show_post_meta' => '0',
				    'share_position' => '0'
			    )
		    )
	    ),
	    'faq' => array(
		    'title'     => 'FAQ',
		    'content'   => 'faq.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1510631860906{margin-bottom: 20px !important;}',
		    )
	    )
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
        'top-navigation' => array(
	        'title' => 'Top Bar Navigation',
	        'location' => 'top_navigation'
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

        'bitcoin' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Bitcoin',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:bitcoin:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'ethereum' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Ethereum',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:ethereum:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'regulation' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Regulation',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:regulation:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'market' => array(
            'location' => 'main-navigation',
            'menu-item-data' => array(
                'menu-item-title' => 'Market',
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'category',
                'menu-item-object-id' => '{{category:market:id}}',
                'menu-item-status' => 'publish'
            )
        ),
        'blockchain' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Blockchain',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:blockchain:id}}',
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
        'guide' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Guide',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:guide:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'contact' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Contact Us',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:contact:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),

        // Footer Menu
        'about' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'About',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => '#',
		        'menu-item-status' => 'publish'
	        )
        ),
        'faq' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'FAQ',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:faq:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'support' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Support Forum',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => 'https://support.jegtheme.com',
		        'menu-item-status' => 'publish'
	        )
        ),
        'landing' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Landing Page',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => 'https://jnews.io/landing',
		        'menu-item-status' => 'publish'
	        )
        ),
        'buy' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Buy JNews',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => 'https://themeforest.net/item/jnews-wordpress-blog-news-magazine-newspaper-theme/20566392?ref=jegtheme&license=regular&open_purchase_for_item_id=20566392',
		        'menu-item-status' => 'publish'
	        )
        ),
        'contact-1' => array(
	        'location' => 'footer-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Contact Us',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:contact:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),

        // Mobile Menu
        'contact-mobile' => array(
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
			        'menu-item-title' => 'Home - Layout 1',
			        'menu-item-parent-id' => '{{menu:home:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-1:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'home-2-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Home - Layout 2',
			        'menu-item-parent-id' => '{{menu:home:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-2:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'home-3-mobile' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'Home - Layout 3',
			        'menu-item-parent-id' => '{{menu:home:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-3:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),

        'world' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'World',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:world:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'economy' => array(
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
        'guide-mobile' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Guide',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:guide:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),

	    // Top Menu
        'about-top' => array(
	        'location' => 'top-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'About',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => '#',
		        'menu-item-status' => 'publish'
	        )
        ),
        'faq-top' => array(
	        'location' => 'top-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'FAQ',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:faq:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'landing-top' => array(
	        'location' => 'top-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Landing Page',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => '#',
		        'menu-item-status' => 'publish'
	        )
        ),
        'buy-top' => array(
	        'location' => 'top-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'Buy JNews',
		        'menu-item-type' => 'custom',
		        'menu-item-url' => '#',
		        'menu-item-status' => 'publish'
	        )
        )
    ),

    'widget_position' => array(
        'Home',
        'Home - Loop',
	    'Home - 4',
        'Author',
        'page'
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