<?php

return array(

    // image
    'image' =>  array(
	    'science1' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget1.jpg',
	    'science2' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget2.jpg',
	    'science3' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget3.jpg',
	    'science4' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget4.jpg',
	    'science5' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget5.jpg',
	    'science6' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget6.jpg',
	    'science7' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget7.jpg',
	    'science8' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget8.jpg',
	    'science9' => 'http://jegtheme.com/asset/jnews/demo/gadget-review/gadget9.jpg',
	    'science_bg_repeat' => 'http://jegtheme.com/asset/jnews/demo/science/science_bg_repeat.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/science/logo_science.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/science/logo_science@2x.png',
        'mobile_logo' => 'http://jegtheme.com/asset/jnews/demo/science/logo_science_sticky.png',
        'mobile_logo2x' => 'http://jegtheme.com/asset/jnews/demo/science/logo_science_sticky@2x.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
	    'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
	    'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
	        'art-culture' => array(
		        'title' =>'Art &amp; Culture',
		        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
		        'imagination' => array(
			        'title' =>'Imagination',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'art-culture'
		        ),
		        'modernism' => array(
			        'title' =>'Modernism',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'art-culture'
		        ),
		        'museum' => array(
			        'title' =>'Museum',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'art-culture'
		        ),
		        'symbolic' => array(
			        'title' =>'Symbolic',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'art-culture'
		        ),
	        'biology' => array(
		        'title' =>'Biology',
		        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
		        'animal' => array(
			        'title' =>'Animal',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'biology'
		        ),
		        'evolution' => array(
			        'title' =>'Evolution',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'biology'
		        ),
		        'genetics' => array(
			        'title' =>'Genetics',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'biology'
		        ),
		        'organism' => array(
			        'title' =>'Organism',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'biology'
		        ),
	        'health-2' => array(
		        'title' =>'Health',
		        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
		        'biomedical' => array(
			        'title' =>'Biomedical',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'health-2'
		        ),
		        'medicine' => array(
			        'title' =>'Medicine',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'health-2'
		        ),
		        'psychology' => array(
			        'title' =>'Psychology',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'health-2'
		        ),
		        'surgery' => array(
			        'title' =>'Surgery',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'health-2'
		        ),
	        'vegetation' => array(
		        'title' =>'Vegetation',
		        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'
	        ),
		        'ecosystem' => array(
			        'title' =>'Ecosystem',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'vegetation'
		        ),
		        'farming' => array(
			        'title' =>'Farming',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'vegetation'
		        ),
		        'forest' => array(
			        'title' =>'Forest',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'vegetation'
		        ),
		        'tropical' => array(
			        'title' =>'Tropical',
			        'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
			        'parent' => 'vegetation'
		        ),
        ),

        'post_tag' => array(
	        'climate-change' => array(
		        'title' => 'Climate Change',
	        ),
	        'flat-earth' => array(
		        'title' => 'Flat Earth'
	        ),
	        'future-of-medicine' => array(
		        'title' => 'Future of Medicine'
	        ),
	        'global-warming' => array(
		        'title' => 'Global Warming'
	        ),
	        'golden-sciene' => array(
		        'title' => 'Golden Sciene'
	        ),
	        'large-hadron-collider' => array(
		        'title' => 'Large Hadron Collider'
	        ),
	        'nanotechnology' => array(
		        'title' => 'Nanotechnology'
	        ),
	        'neurobiology' => array(
		        'title' => 'Neurobiology'
	        ),
	        'robotics-science' => array(
		        'title' => 'Robotics Science'
	        ),
	        'science-research' => array(
		        'title' => 'Science Research'
	        ),
	        'sustainability-ecosystem' => array(
	        	'title' => 'Sustainability Ecosystem'
	        )
        )
    ),

    // post & page
    'post' => array(
	    'the-moon-might-have-had-a-heavy-metal-atmosphere-with-supersonic-winds' => array(
		    'title' => "The moon might have had a heavy metal atmosphere with supersonic winds",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science1',
		    'taxonomy' => array(
			    'category' => 'biomedical,medicine,modernism,museum',
			    'post_tag' => 'climate-change,future-of-medicine,large-hadron-collider,neurobiology,science-research,sustainability-ecosystem'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:museum:id}}')
		    )
	    ),
	    'the-blue-wings-of-this-dragonfly-may-be-surprisingly-alive' => array(
		    'title' => "The blue wings of this dragonfly may be surprisingly alive",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science2',
		    'taxonomy' => array(
			    'category' => 'ecosystem,genetics,modernism,psychology',
			    'post_tag' => 'flat-earth,future-of-medicine,global-warming,golden-science,large-hadron-collider,sustainability-ecosystem'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:ecosystem:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'petunias-spread-their-scent-using-pushy-proteins' => array(
		    'title' => "Petunias spread their scent using pushy proteins",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science3',
		    'taxonomy' => array(
			    'category' => 'biomedical,ecosystem,modernism,organism',
			    'post_tag' => 'climate-change,flat-earth,large-hadron-collider,nanotechnology,robotics-science,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:ecosystem:id}}')
		    )
	    ),
	    'horse-version-of-whos-your-daddy-answered' => array(
		    'title' => "Horse version of ‘Who’s your daddy?’ answered",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science4',
		    'taxonomy' => array(
			    'category' => 'forest,genetics,museum,psychology',
			    'post_tag' => 'climate-change,flat-earth,future-of-medicine,nanotechnology,science-research,sustainability-ecosystem'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:forest:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'getting-a-flu-shot-could-soon-be-as-easy-as-sticking-on-a-band-aid' => array(
		    'title' => "Getting a flu ‘shot’ could soon be as easy as sticking on a Band-Aid",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science5',
		    'taxonomy' => array(
			    'category' => 'biomedical,farming,forest,organism',
			    'post_tag' => 'flat-earth,global-warming,large-hadron-collider,nanotechnology,science-research,sustainability-ecosystem',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=Mqp8Y80WFEI&t=34s'
		    )
	    ),
	    'gecko-inspired-robot-grippers-could-grab-hold-of-space-junk' => array(
		    'title' => "Gecko-inspired robot grippers could grab hold of space junk",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science6',
		    'taxonomy' => array(
			    'category' => 'biomedical,ecosystem,forest,symbolic',
			    'post_tag' => 'climate-change,flat-earth,global-warming,large-hadron-collider,neurobiology,sustainability-ecosystem'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:forest:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'carved-human-skulls-found-at-ancient-worship-center-in-turkey' => array(
		    'title' => "Carved human skulls found at ancient worship center in Turkey",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science7',
		    'taxonomy' => array(
			    'category' => 'biomedical,forest,modernism,tropical',
			    'post_tag' => 'climate-change,future-of-medicine,global-warming,golden-science,large-hadron-collider,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:forest:id}}')
		    )
	    ),
	    'chronic-flu-patients-could-be-an-early-warning-system-for-future-outbreaks' => array(
		    'title' => "Chronic flu patients could be an early warning system for future outbreaks",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science8',
		    'taxonomy' => array(
			    'category' => 'animal,genetics,museum,surgery',
			    'post_tag' => 'flat-earth,global-warming,nanotechnology,neurobiology,robotics-science,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:museum:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'floral-curve-test-shows-whats-great-for-a-moth-is-not-so-good-for-a-flower' => array(
		    'title' => "Floral curve test shows what’s great for a moth is not so good for a flower",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science9',
		    'taxonomy' => array(
			    'category' => 'biomedical,genetics,imagination,modernism',
			    'post_tag' => 'climate-change,flat-earth,future-of-medicine,golden-science,nanotechnology,robotics-science'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:imagination:id}}')
		    )
	    ),
	    'magical-fish-basically-has-the-power-to-conjure-its-own-patronus' => array(
		    'title' => "Magical fish basically has the power to conjure its own Patronus",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science1',
		    'taxonomy' => array(
			    'category' => 'animal,evolution,modernism,tropical',
			    'post_tag' => 'climate-change,future-of-medicine,global-warming,golden-science,nanotechnology,robotics-science'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tropical:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'sound-reflecting-shelters-inspired-ancient-rock-artists' => array(
		    'title' => "Sound-reflecting shelters inspired ancient rock artists",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science2',
		    'taxonomy' => array(
			    'category' => 'ecosystem,evolution,museum,symbolic',
			    'post_tag' => 'future-of-medicine,global-warming,large-hadron-collider,neurobiology,robotics-science,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:ecosystem:id}}')
		    )
	    ),
	    'every-breath-you-take-contains-a-molecule-of-history' => array(
		    'title' => "Every breath you take contains a molecule of history",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science3',
		    'taxonomy' => array(
			    'category' => 'forest,medicine,organism,tropical',
			    'post_tag' => 'climate-change,global-warming,neurobiology,robotics-science,science-research,sustainability-ecosystem',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:forest:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=l1VXM_b2KFY'
		    )
	    ),
	    'flight-demands-may-have-steered-the-evolution-of-bird-egg-shape' => array(
		    'title' => "Flight demands may have steered the evolution of bird egg shape",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science4',
		    'taxonomy' => array(
			    'category' => 'farming,organism,psychology,tropical',
			    'post_tag' => 'future-of-medicine,golden-science,large-hadron-collider,nanotechnology,neurobiology,robotics-science'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}')
		    )
	    ),
	    'mice-shed-weight-when-they-cant-smell-but-not-because-they-stop-eating' => array(
		    'title' => "Mice shed weight when they can’t smell—but not because they stop eating",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science5',
		    'taxonomy' => array(
			    'category' => 'biomedical,farming,psychology,surgery',
			    'post_tag' => 'climate-change,flat-earth,global-warming,golden-science,neurobiology,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'milky-ways-superfast-stars-may-have-been-fired-out-of-a-nearby-galaxy' => array(
		    'title' => "Milky Way’s superfast stars may have been fired out of a nearby galaxy",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science6',
		    'taxonomy' => array(
			    'category' => 'forest,museum,organism,psychology',
			    'post_tag' => 'climate-change,flat-earth,future-of-medicine,large-hadron-collider,robotics-science,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:forest:id}}')
		    )
	    ),
	    'why-modern-mortar-crumbles-but-roman-concrete-lasts-millennia' => array(
		    'title' => "Why modern mortar crumbles, but Roman concrete lasts millennia",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science7',
		    'taxonomy' => array(
			    'category' => 'biomedical,evolution,imagination,psychology',
			    'post_tag' => 'flat-earth,global-warming,large-hadron-collider,nanotechnology,neurobiology,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:imagination:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'help-hope-and-hype-ethical-dimensions-of-neuroprosthetics' => array(
		    'title' => "Help, hope, and hype: Ethical dimensions of neuroprosthetics",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science8',
		    'taxonomy' => array(
			    'category' => 'animal,farming,imagination,psychology',
			    'post_tag' => 'flat-earth,nanotechnology,neurobiology,robotics-science,science-research,sustainability-ecosystem',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=ISOA8Y-LMiA'
		    )
	    ),
	    'releasing-plant-volatiles-as-simple-as-abc' => array(
		    'title' => "Releasing plant volatiles, as simple as ABC",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science9',
		    'taxonomy' => array(
			    'category' => 'evolution,farming,imagination,symbolic',
			    'post_tag' => 'future-of-medicine,large-hadron-collider,neurobiology,robotics-science,science-research,sustainability-ecosystem'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'update-creationist-geologist-wins-permit-to-collect-rocks-in-grand-canyon-after-lawsuit' => array(
		    'title' => "Update: Creationist geologist wins permit to collect rocks in Grand Canyon after lawsuit",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science1',
		    'taxonomy' => array(
			    'category' => 'farming,medicine,modernism,surgery',
			    'post_tag' => 'climate-change,global-warming,golden-science,neurobiology,robotics-science,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}')
		    )
	    ),
	    'safety-problems-at-a-los-alamos-laboratory-delay-u-s-nuclear-warhead-testing-and-production' => array(
		    'title' => "Safety problems at a Los Alamos laboratory delay U.S. nuclear warhead testing and production",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science2',
		    'taxonomy' => array(
			    'category' => 'genetics,imagination,medicine,museum',
			    'post_tag' => 'global-warming,golden-science,large-hadron-collider,neurobiology,robotics-science,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:museum:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'neandertals-and-modern-humans-started-mating-early' => array(
		    'title' => "Neandertals and modern humans started mating early",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science3',
		    'taxonomy' => array(
			    'category' => 'ecosystem,imagination,modernism,psychology',
			    'post_tag' => 'future-of-medicine,golden-science,large-hadron-collider,nanotechnology,science-research,sustainability-ecosystem'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:ecosystem:id}}')
		    )
	    ),
	    'in-switzerland-a-giant-new-machine-is-sucking-carbon-directly-from-the-air' => array(
		    'title' => "In Switzerland, a giant new machine is sucking carbon directly from the air",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science4',
		    'taxonomy' => array(
			    'category' => 'evolution,farming,forest,organism',
			    'post_tag' => 'future-of-medicine,global-warming,nanotechnology,neurobiology,science-research,sustainability-ecosystem'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'satellite-based-entanglement-distribution-over-1200-kilometers' => array(
		    'title' => "Satellite-based entanglement distribution over 1200 kilometers",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science5',
		    'taxonomy' => array(
			    'category' => 'evolution,farming,genetics,medicine',
			    'post_tag' => 'flat-earth,golden-science,large-hadron-collider,nanotechnology,neurobiology,robotics-science'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}')
		    )
	    ),
	    'ravens-remember-people-who-suckered-them-into-an-unfair-deal' => array(
		    'title' => "Ravens remember people who suckered them into an unfair deal",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science6',
		    'taxonomy' => array(
			    'category' => 'farming,genetics,medicine,psychology',
			    'post_tag' => 'climate-change,global-warming,large-hadron-collider,neurobiology,science-research,sustainability-ecosystem'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'theres-no-such-thing-as-a-pure-european-or-anyone-else' => array(
		    'title' => "There's no such thing as a 'pure' European—or anyone else",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science7',
		    'taxonomy' => array(
			    'category' => 'forest,museum,surgery,tropical',
			    'post_tag' => 'climate-change,flat-earth,future-of-medicine,nanotechnology,neurobiology,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:forest:id}}')
		    )
	    ),
	    'skull-cults-parkinsons-proteins-in-the-gut-and-bee-killing-pesticides' => array(
		    'title' => "Skull cults, Parkinson’s proteins in the gut, and bee-killing pesticides",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science8',
		    'taxonomy' => array(
			    'category' => 'biomedical,imagination,modernism,museum',
			    'post_tag' => 'future-of-medicine,global-warming,golden-science,robotics-science,science-research,sustainability-ecosystem'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:museum:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'house-lawmakers-balk-at-most-trump-science-cuts-in-early-bills' => array(
		    'title' => "House lawmakers balk at most Trump science cuts in early bills",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science9',
		    'taxonomy' => array(
			    'category' => 'animal,biomedical,ecosystem,evolution',
			    'post_tag' => 'flat-earth,future-of-medicine,global-warming,golden-science,large-hadron-collider,nanotechnology'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:ecosystem:id}}')
		    )
	    ),
	    'top-stories-mysterious-human-skull-carvings-algorithms-for-origami-and-nasas-newest-astronauts' => array(
		    'title' => "Top stories: Mysterious human skull carvings, algorithms for origami, and NASA’s newest astronauts",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science1',
		    'taxonomy' => array(
			    'category' => 'biomedical,farming,forest,psychology',
			    'post_tag' => 'climate-change,future-of-medicine,global-warming,large-hadron-collider,neurobiology,sustainability-ecosystem'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'groups-see-climate-science-review-as-chance-to-undercut-regulation' => array(
		    'title' => "Groups see climate science review as chance to undercut regulation",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science2',
		    'taxonomy' => array(
			    'category' => 'biomedical,ecosystem,genetics,medicine,symbolic,tropical',
			    'post_tag' => 'flat-earth,golden-science,large-hadron-collider,neurobiology,robotics-science,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:symbolic:id}}')
		    )
	    ),
	    'extinction-that-killed-the-dinosaurs-may-have-led-to-frog-explosion' => array(
		    'title' => "Extinction that killed the dinosaurs may have led to frog explosion",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science3',
		    'taxonomy' => array(
			    'category' => 'animal,ecosystem,medicine,museum,surgery,tropical',
			    'post_tag' => 'future-of-medicine,golden-science,large-hadron-collider,neurobiology,robotics-science,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tropical:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.'
		    )
	    ),
	    'ancient-roman-concrete-outperforms-our-own-and-science-only-just-worked-out-why' => array(
		    'title' => "Ancient Roman concrete outperforms our own, and science only just worked out why",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science4',
		    'taxonomy' => array(
			    'category' => 'animal,ecosystem,evolution,medicine,symbolic,tropical',
			    'post_tag' => 'climate-change,flat-earth,future-of-medicine,large-hadron-collider,neurobiology,science-research'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:symbolic:id}}')
		    )
	    ),
	    'in-india-critics-assail-proposal-to-build-100-waste-fueled-power-plants' => array(
		    'title' => "In India, critics assail proposal to build 100 waste-fueled power plants",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science5',
		    'taxonomy' => array(
			    'category' => 'ecosystem,farming,medicine,organism,symbolic,tropical',
			    'post_tag' => 'climate-change,future-of-medicine,global-warming,golden-science,large-hadron-collider,robotics-science',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:farming:id}}'),
			    'post_subtitle' => 'The best way to pay for a lovely moment is to enjoy it.',
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=IdPTuwKEfmA'
		    )
	    ),
	    'story-image-for-science-news-from-popular-science-what-moral-code-should-your-self-driving-car-follow' => array(
		    'title' => "Popular Science moral code why should your self-driving car follow?",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science6',
		    'taxonomy' => array(
			    'category' => 'ecosystem,evolution,forest,imagination,organism,tropical',
			    'post_tag' => 'flat-earth,global-warming,golden-science,nanotechnology,neurobiology,sustainability-ecosystem',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:evolution:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=EYh0F_8ZdSU'
		    )
	    ),
	    'scientists-are-not-so-hot-at-predicting-which-cancer-studies-will-succeed' => array(
		    'title' => "Scientists Are Not So Hot At Predicting Which Cancer Studies Will Succeed",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'science7',
		    'taxonomy' => array(
			    'category' => 'ecosystem,evolution,imagination,organism,tropical',
			    'post_tag' => 'flat-earth,global-warming,golden-science,nanotechnology,neurobiology,sustainability-ecosystem',
			    'post_format' => 'post-format-video'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:ecosystem:id}}'),
			    '_format_video_embed' => 'https://www.youtube.com/watch?v=SGaQ0WwZ_0I'
		    )
	    ),

	    // page
	    'home-1' => array(
		    'title' => 'Home 1',
		    'content' => 'home1.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1509097930740{margin-top: -30px !important;}.vc_custom_1499411173780{margin-bottom: 30px !important;}.vc_custom_1499414790301{margin-top: 30px !important;margin-bottom: 30px !important;}.vc_custom_1509333700351{margin-bottom: 30px !important;}.vc_custom_1509333775851{margin-bottom: -15px !important;}',
			    '_wpb_post_custom_css' => '',
			    'jnews_page_loop' => array(
				    'enable_page_loop' => '1',
				    'first_title' => 'NEWS INDEX',
				    'header_type' => 'heading_9',
				    'layout' => 'right-sidebar',
				    'sidebar' => 'home-1-loop',
				    'module'    => '3',
				    'excerpt_length' => '20',
				    'content_date' => 'default',
				    'content_pagination' => 'nav_1',
				    'pagination_align' => 'center',
				    'show_navtext' => 0,
				    'show_pageinfo' => 0
			    ),
			    '_elementor_data' => 'home1.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.vc_custom_1509097930740{margin-top: -30px !important;}.vc_custom_1499411173780{margin-bottom: 30px !important;}.vc_custom_1499414790301{margin-top: 30px !important;margin-bottom: 30px !important;}.vc_custom_1509333700351{margin-bottom: 30px !important;}.vc_custom_1509333775851{margin-bottom: -15px !important;}'
			    )
		    )
	    ),
	    'home-2' => array(
		    'title' => 'Home 2',
		    'content' => 'home2.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1509675777935{margin-top: 15px !important;}.vc_custom_1509676184384{margin-top: 10px !important;margin-bottom: 30px !important;}.vc_custom_1499759687297{margin-top: 40px !important;}.vc_custom_1509675572836{margin-top: 10px !important;margin-bottom: 30px !important;}.vc_custom_1509675590968{padding-top: 10px !important;}',
			    '_wpb_post_custom_css' => '.jeg_postblock_13 .jeg_readmore {display: none;}',
			    'jnews_page_loop' => array(
				    'enable_page_loop' => '1',
				    'first_title' => 'NEWS INDEX',
				    'header_type' => 'heading_9',
				    'layout' => 'right-sidebar',
				    'sidebar' => 'home-1-loop',
				    'module'    => '4',
				    'excerpt_length' => '20',
				    'content_date' => 'default',
				    'content_pagination' => 'nav_3',
				    'pagination_align' => 'left',
				    'show_navtext' => 1,
				    'show_pageinfo' => 1
			    ),
			    '_elementor_data' => 'home2.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.vc_custom_1509675777935{margin-top: 15px !important;}.vc_custom_1509676184384{margin-top: 10px !important;margin-bottom: 30px !important;}.vc_custom_1499759687297{margin-top: 40px !important;}.vc_custom_1509675572836{margin-top: 10px !important;margin-bottom: 30px !important;}.vc_custom_1509675590968{padding-top: 10px !important;}.jeg_postblock_13 .jeg_readmore {display: none;}'
			    )
		    )
	    ),
	    'home-3' => array(
		    'title' => 'Home 3',
		    'content' => 'home3.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1509677563676{margin-top: -30px !important;}.vc_custom_1499504605957{margin-bottom: 25px !important;}.vc_custom_1509681990549{padding-top: 70px !important;padding-bottom: 70px !important;background-color: #044389 !important;}.vc_custom_1509680014970{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 20px !important;padding-right: 40px !important;padding-bottom: 20px !important;padding-left: 40px !important;border-left-color: rgba(255,255,255,0.15) !important;border-left-style: solid !important;border-right-color: rgba(255,255,255,0.15) !important;border-right-style: solid !important;border-top-color: rgba(255,255,255,0.15) !important;border-top-style: solid !important;border-bottom-color: rgba(255,255,255,0.15) !important;border-bottom-style: solid !important;}.vc_custom_1499683044683{margin-bottom: 30px !important;}',
			    'jnews_page_loop' => array(
				    'enable_page_loop' => '1',
				    'first_title' => 'NEWS INDEX',
				    'header_type' => 'heading_9',
				    'layout' => 'right-sidebar',
				    'sidebar' => 'home-1-loop',
				    'module'    => '7',
				    'excerpt_length' => '34',
				    'content_date' => 'default',
				    'content_pagination' => 'nav_3',
				    'pagination_align' => 'left',
				    'show_navtext' => 1,
				    'show_pageinfo' => 1
			    ),
			    '_elementor_data' => 'home3.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.vc_custom_1509677563676{margin-top: -30px !important;}.vc_custom_1499504605957{margin-bottom: 25px !important;}.vc_custom_1509681990549{padding-top: 70px !important;padding-bottom: 70px !important;background-color: #044389 !important;}.vc_custom_1509680014970{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 20px !important;padding-right: 40px !important;padding-bottom: 20px !important;padding-left: 40px !important;border-left-color: rgba(255,255,255,0.15) !important;border-left-style: solid !important;border-right-color: rgba(255,255,255,0.15) !important;border-right-style: solid !important;border-top-color: rgba(255,255,255,0.15) !important;border-top-style: solid !important;border-bottom-color: rgba(255,255,255,0.15) !important;border-bottom-style: solid !important;}.vc_custom_1499683044683{margin-bottom: 30px !important;}'
			    )
		    )
	    ),
	    'home-4' => array(
		    'title' => 'Home 4',
		    'content' => 'home4.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1509683065393{margin-bottom: 30px !important;border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 30px !important;background-color: #f7f7f7 !important;background-position: 0 0 !important;background-repeat: repeat !important;border-left-color: #f5f5f5 !important;border-left-style: dotted !important;border-right-color: #f5f5f5 !important;border-right-style: dotted !important;border-top-color: #f5f5f5 !important;border-top-style: dotted !important;border-bottom-color: #f5f5f5 !important;border-bottom-style: dotted !important;border-radius: 3px !important;}.vc_custom_1499828687924{margin-bottom: 10px !important;}.vc_custom_1499828687924{margin-bottom: 10px !important;}.vc_custom_1502266697811{margin-bottom: 30px !important;}',
			    '_elementor_data' => 'home4.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.vc_custom_1509683065393{margin-bottom: 30px !important;border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;padding-top: 30px !important;background-color: #f7f7f7 !important;background-position: 0 0 !important;background-repeat: repeat !important;border-left-color: #f5f5f5 !important;border-left-style: dotted !important;border-right-color: #f5f5f5 !important;border-right-style: dotted !important;border-top-color: #f5f5f5 !important;border-top-style: dotted !important;border-bottom-color: #f5f5f5 !important;border-bottom-style: dotted !important;border-radius: 3px !important;}.vc_custom_1499828687924{margin-bottom: 10px !important;}.vc_custom_1499828687924{margin-bottom: 10px !important;}.vc_custom_1502266697811{margin-bottom: 30px !important;}'
			    )
		    )
	    ),
	    'home-5' => array(
		    'title' => 'Home 5',
		    'content' => 'home5.txt',
		    'post_type' => 'page',
		    'metabox' => array(
			    '_wp_page_template' => 'template-builder.php',
			    '_wpb_shortcodes_custom_css' => '.vc_custom_1499837814360{margin-bottom: 10px !important;}.vc_custom_1509690081984{margin-bottom: 40px !important;}',
			    'jnews_page_loop' => array(
				    'enable_page_loop' => '1',
				    'first_title' => 'NEWS INDEX',
				    'header_type' => 'heading_9',
				    'layout' => 'right-sidebar',
				    'sidebar' => 'home-1-loop',
				    'module'    => '7',
				    'excerpt_length' => '24',
				    'content_date' => 'default',
				    'content_pagination' => 'nav_3',
				    'pagination_align' => 'left',
				    'show_navtext' => 1,
				    'show_pageinfo' => 1
			    ),
			    '_elementor_data' => 'home5.json',
			    '_elementor_edit_mode' => 'builder',
			    '_elementor_page_settings' => array(
				    'custom_css' => '.vc_custom_1499837814360{margin-bottom: 10px !important;}.vc_custom_1509690081984{margin-bottom: 40px !important;}.jeg_overlay_slider {margin-bottom: 0;}'
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
        'mobile-navigation' => array(
	        'title' => 'Mobile Navigation',
	        'location' => 'mobile_navigation'
        ),
    ),

    // menu it self
    'menu' => array(
    	// main navigation
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
	    'vegetation' => array(
		    'location' => 'main-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Vegetation',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:vegetation:id}}',
			    'menu-item-status' => 'publish'
		    ),
		    'metabox' => array(
			    'menu_item_jnews_mega_menu' => array(
				    'type' => 'category_2',
				    'category' => '{{category:vegetation:id}}',
				    'number' => 9,
				    'trending_tag' => '{{taxonomy:post_tag:large-hadron-collider:id}},{{taxonomy:post_tag:future-of-medicine:id}},{{taxonomy:post_tag:climate-change:id}},{{taxonomy:post_tag:sustainability-ecosystem:id}},{{taxonomy:post_tag:science-research:id}},{{taxonomy:post_tag:flat-earth:id}}',
			    ),
		    )
	    ),
	    'health' => array(
		    'location' => 'main-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Health',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:health-2:id}}',
			    'menu-item-status' => 'publish'
		    ),
		    'metabox' => array(
			    'menu_item_jnews_mega_menu' => array(
				    'type' => 'category_2',
				    'category' => '{{category:health-2:id}}',
				    'number' => 6,
				    'trending_tag' => '{{taxonomy:post_tag:flat-earth:id}},{{taxonomy:post_tag:robotics-science:id}},{{taxonomy:post_tag:nanotechnology:id}},{{taxonomy:post_tag:global-warming:id}},{{taxonomy:post_tag:golden-science:id}},{{taxonomy:post_tag:future-of-medicine:id}}',
			    ),
		    )
	    ),
	    'biology' => array(
		    'location' => 'main-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Biology',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:biology:id}}',
			    'menu-item-status' => 'publish'
		    ),
		    'metabox' => array(
			    'menu_item_jnews_mega_menu' => array(
				    'type' => 'category_1',
				    'category' => '{{category:biology:id}}',
				    'number' => 9
			    ),
		    )
	    ),
	    'art-culture' => array(
		    'location' => 'main-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Art & Culture',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:art-culture:id}}',
			    'menu-item-status' => 'publish'
		    ),
		    'metabox' => array(
			    'menu_item_jnews_mega_menu' => array(
				    'type' => 'category_2',
				    'category' => '{{category:art-culture:id}}',
				    'number' => 9,
				    'trending_tag' => '{{taxonomy:post_tag:golden-science:id}},{{taxonomy:post_tag:nanotechnology:id}},{{taxonomy:post_tag:global-warming:id}},{{taxonomy:post_tag:climate-change:id}},{{taxonomy:post_tag:flat-earth:id}}',
			    ),
		    )
	    ),

    	// mobile navigation
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
	    'mobile-vegetation' => array(
		    'location' => 'mobile-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Vegetation',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:vegetation:id}}',
			    'menu-item-status' => 'publish'
		    ),
	    ),
		    'mobile-forest' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Forest',
				    'menu-item-parent-id' => '{{menu:mobile-vegetation:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:forest:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-farming' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Farming',
				    'menu-item-parent-id' => '{{menu:mobile-vegetation:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:farming:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-tropical' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Forest',
				    'menu-item-parent-id' => '{{menu:mobile-vegetation:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:tropical:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-ecosystem' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Ecosystem',
				    'menu-item-parent-id' => '{{menu:mobile-vegetation:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:ecosystem:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
	    'mobile-biology' => array(
		    'location' => 'mobile-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Biology',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:biology:id}}',
			    'menu-item-status' => 'publish'
		    ),
	    ),
		    'mobile-animal' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Animal',
				    'menu-item-parent-id' => '{{menu:mobile-biology:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:animal:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-evolution' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Evolution',
				    'menu-item-parent-id' => '{{menu:mobile-biology:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:evolution:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-organism' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Organism',
				    'menu-item-parent-id' => '{{menu:mobile-biology:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:organism:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-genetics' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Genetics',
				    'menu-item-parent-id' => '{{menu:mobile-biology:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:genetics:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
	    'mobile-health' => array(
		    'location' => 'mobile-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Health',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:health-2:id}}',
			    'menu-item-status' => 'publish'
		    ),
	    ),
		    'mobile-psychology' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Psychology',
				    'menu-item-parent-id' => '{{menu:mobile-health:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:psychology:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-surgery' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Surgery',
				    'menu-item-parent-id' => '{{menu:mobile-health:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:surgery:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-biomedical' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Biomedical',
				    'menu-item-parent-id' => '{{menu:mobile-health:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:biomedical:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-medicine' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Medicine',
				    'menu-item-parent-id' => '{{menu:mobile-health:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:medicine:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
	    'mobile-art-culture' => array(
		    'location' => 'mobile-navigation',
		    'menu-item-data' => array(
			    'menu-item-title' => 'Art & Culture',
			    'menu-item-type' => 'taxonomy',
			    'menu-item-object' => 'category',
			    'menu-item-object-id' => '{{category:art-culture:id}}',
			    'menu-item-status' => 'publish'
		    ),
	    ),
		    'mobile-modernism' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Modernism',
				    'menu-item-parent-id' => '{{menu:mobile-art-culture:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:modernism:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-museum' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Museum',
				    'menu-item-parent-id' => '{{menu:mobile-art-culture:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:museum:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-symbolic' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Symbolic',
				    'menu-item-parent-id' => '{{menu:mobile-art-culture:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:symbolic:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),
		    'mobile-imagination' => array(
			    'location' => 'mobile-navigation',
			    'menu-item-data' => array(
				    'menu-item-title' => 'Imagination',
				    'menu-item-parent-id' => '{{menu:mobile-art-culture:id}}',
				    'menu-item-type' => 'taxonomy',
				    'menu-item-object' => 'category',
				    'menu-item-object-id' => '{{category:imagination:id}}',
				    'menu-item-status' => 'publish'
			    ),
		    ),

    	// top bar & footer navigation
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
    	'Home 1 - Loop',
	    'Single Loop',
    	'Home 1',
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
        'jnews-view-counter'
    )

);