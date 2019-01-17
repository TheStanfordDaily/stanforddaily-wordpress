<?php

return array(

    // image
    'image' =>  array(
	    'rtl1' => 'http://jegtheme.com/asset/jnews/demo/default/news9.jpg',
	    'rtl2' => 'http://jegtheme.com/asset/jnews/demo/default/fashion2.jpg',
	    'rtl3' => 'http://jegtheme.com/asset/jnews/demo/default/fashion3.jpg',
	    'rtl4' => 'http://jegtheme.com/asset/jnews/demo/default/fashion4.jpg',
	    'rtl5' => 'http://jegtheme.com/asset/jnews/demo/default/fashion5.jpg',
	    'rtl6' => 'http://jegtheme.com/asset/jnews/demo/default/fashion6.jpg',
	    'rtl7' => 'http://jegtheme.com/asset/jnews/demo/default/fashion1.jpg',
	    'rtl8' => 'http://jegtheme.com/asset/jnews/demo/default/travel2.jpg',
	    'rtl9' => 'http://jegtheme.com/asset/jnews/demo/default/travel3.jpg',
        'logo' => 'http://jegtheme.com/asset/jnews/demo/rtl/logo.png',
        'logo2x' => 'http://jegtheme.com/asset/jnews/demo/rtl/logo@2x.png',
        'footer_logo' => 'http://jegtheme.com/asset/jnews/demo/rtl/footer_logo.png',
        'footer_logo2x' => 'http://jegtheme.com/asset/jnews/demo/rtl/footer_logo@2x.png',
        'favicon' => 'http://jegtheme.com/asset/jnews/demo/default/favicon.png',
        'ad_300x250' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x250.jpg',
        'ad_345x345' => 'http://jegtheme.com/asset/jnews/demo/default/ad_345x345.jpg',
        'ad_728x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_728x90.png',
        'ad_300x600' => 'http://jegtheme.com/asset/jnews/demo/default/ad_300x600.jpg',
        'ad_970x90' => 'http://jegtheme.com/asset/jnews/demo/default/ad_970x90.png'
    ),

    // create taxonomy
    'taxonomy' => array(
        'category' => array(
            'news' =>
                array(
                    'title' =>'أخبار',
                    'description' => 'يمكنك إضافة بعض وصف الفئة هنا.'
                ),
                'business' =>
                    array(
                        'title' => 'اعمال',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'news'
                    ),
                'politics' =>
                    array(
                        'title' =>'سياسة',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'news'
                    ),
                'science' =>
                    array(
                        'title' => 'علم',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'news'
                    ),
                'world' =>
                    array(
                        'title' => 'العالمية',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'news'
                    ),

            'lifestyle' =>
                array(
                    'title' => 'لايف ستايل',
                    'description' => 'يمكنك إضافة بعض وصف الفئة هنا.'
                ),
                'fashion' =>
                    array(
                        'title' =>'موضه',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'lifestyle'
                    ),
                'travel' =>
                    array(
                        'title' =>'السفر',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'lifestyle'
                    ),
                'food' =>
                    array(
                        'title' =>'طعام',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'lifestyle'
                    ),
                'health' =>
                    array(
                        'title' =>'الصحة',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'lifestyle'
                    ),

            'tech' =>
                array(
                    'title' => 'التكنولوجيا',
                    'description' => 'يمكنك إضافة بعض وصف الفئة هنا.'
                ),
                'apps' =>
                    array(
                        'title' =>'التطبيقات',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'tech'
                    ),
                'gear' =>
                    array(
                        'title' =>'معدات',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'tech'
                    ),
                'mobile' =>
                    array(
                        'title' =>'متحرك',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'tech'
                    ),
                'startup' =>
                    array(
                        'title' =>'أبدء',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'tech'
                    ),

            'entertainment' =>
                array(
                    'title' => 'وسائل الترفيه',
                    'description' => 'يمكنك إضافة بعض وصف الفئة هنا.'
                ),
                'gaming' =>
                    array(
                        'title' =>'الألعاب',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'entertainment'
                    ),
                'movie' =>
                    array(
                        'title' =>'فيلم',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'entertainment'
                    ),
                'music' =>
                    array(
                        'title' =>'موسيقى',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'entertainment'
                    ),
                'sports' =>
                    array(
                        'title' =>'رياضات',
                        'description' => 'يمكنك إضافة بعض وصف الفئة هنا.',
                        'parent' => 'entertainment'
                    ),
        ),
        'post_tag' => array(
            'united-stated' => array(
                'title' => 'الولايات المتحدة الامريكانية',
            ),
            'election-results' => array(
                'title' => 'نتائج الانتخابات',
            ),
            'market-stories' => array(
                'title' => 'قصص السوق',
            ),
            'future-of-news' => array(
                'title' => 'مستقبل الأخبار'
            ),
            'earth-day' => array(
                'title' => 'يوم الارض'
            ),
            'tv-series' => array(
                'title' => 'مسلسل تلفزيونى'
            ),
            'motogp' => array(
                'title' => 'موتو غب قطر'
            ),
            'flat-earth' => array(
                'title' => 'شقة الأرض'
            ),
            'climate-change' => array(
                'title' => 'تغير المناخ'
            ),
            'sillicon-valley' => array(
                'title' => 'وادي السيليكون'
            ),
        )
    ),

    // post & page
    'post' => array(
	    '%d8%a7%d9%84%d8%af%d9%88%d9%84-%d8%a7%d9%84%d8%a3%d8%b1%d8%a8%d8%b9-%d8%a7%d9%84%d9%85%d9%82%d8%a7%d8%b7%d8%b9%d8%a9-%d9%84%d9%82%d8%b7%d8%b1-%d8%aa%d9%87%d8%af%d8%af-%d8%a8%d8%a7%d8%aa%d8%ae%d8%a7' => array(
		    'title' => "الدول الأربع المقاطعة لقطر تهدد باتخاذ إجراءات جديدة ضدها",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl1',
		    'taxonomy' => array(
			    'category' => 'gaming,world,food,music',
			    'post_tag' => 'climate-change,future-of-news,tv-series,motogp,sillicon-valley,earth-day'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:world:id}}')
		    )
	    ),
	    '%d9%86%d9%8a%d9%86%d8%aa%d9%86%d8%af%d9%88-%d8%a3%d9%88%d9%84-%d8%a7%d9%84%d8%aa%d8%a8%d8%af%d9%8a%d9%84-%d9%8a%d8%aa%d8%af%d9%81%d9%82%d9%88%d9%86-%d8%a7%d9%84%d8%aa%d8%b7%d8%a8%d9%8a%d9%82-%d8%aa' => array(
		    'title' => "نينتندو أول التبديل يتدفقون التطبيق تطلق الخميس في اليابان",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl2',
		    'taxonomy' => array(
			    'category' => 'gaming,health,movie,gear',
			    'post_tag' => 'united-stated,flat-earth,tv-series,motogp,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:gear:id}}'),
			    'post_subtitle' => 'رجل يحتاج صعوباته لأنها ضرورية للتمتع بالنجاح'
		    )
	    ),
	    '%d8%ac%d9%87%d8%a7%d8%b2%d9%83-%d9%84%d9%86-%d9%8a%d9%83%d9%88%d9%86-%d9%84%d8%a8%d9%86%d8%a9%d8%8c-%d9%84%d9%83%d9%86%d9%87%d8%a7-%d9%84%d9%86-%d8%aa%d8%ad%d8%b5%d9%84-%d8%b9%d9%84%d9%89-%d8%a7%d9%84' => array(
		    'title' => "جهازك لن يكون لبنة، لكنها لن تحصل على المزيد من التحديثات",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl3',
		    'taxonomy' => array(
			    'category' => 'gaming,health,movie,gear',
			    'post_tag' => 'united-stated,flat-earth,tv-series,motogp,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:tech:id}}'),
			    'post_subtitle' => 'رجل يحتاج صعوباته لأنها ضرورية للتمتع بالنجاح'
		    )
	    ),
	    '%d9%83%d9%84-%d9%85%d8%a7-%d8%aa%d8%ad%d8%aa%d8%a7%d8%ac%d9%87-%d9%81%d9%8a-%d9%87%d8%b0%d9%87-%d8%a7%d9%84%d8%ad%d9%8a%d8%a7%d8%a9-%d9%87%d9%88-%d8%a7%d9%84%d8%ac%d9%87%d9%84-%d9%88%d8%a7%d9%84%d8%ab' => array(
		    'title' => "كل ما تحتاجه في هذه الحياة هو الجهل والثقة، ثم النجاح هو بالتأكيد.",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl4',
		    'taxonomy' => array(
			    'category' => 'gaming,health,sports,gear',
			    'post_tag' => 'united-stated,flat-earth,tv-series,motogp,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
			    'post_subtitle' => 'رجل يحتاج صعوباته لأنها ضرورية للتمتع بالنجاح'
		    )
	    ),
	    '%d9%87%d8%b0%d8%a7-%d8%a7%d9%84%d8%a7%d9%86%d8%aa%d8%b5%d8%a7%d8%b1-%d8%a7%d9%84%d9%82%d9%84%d9%82-%d8%a7%d9%84%d8%b7%d8%a8%d9%8a%d8%b9%d9%8a-%d8%b3%d9%88%d9%81-%d8%aa%d8%b5%d8%a8%d8%ad-%d8%ac%d8%b2' => array(
		    'title' => "هذا الانتصار القلق الطبيعي سوف تصبح جزءا من الروتين اليومي الخاص بك",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl5',
		    'taxonomy' => array(
			    'category' => 'apps,travel,music,fashion',
			    'post_tag' => 'climate-change,flat-earth,future-of-news,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:travel:id}}')
		    )
	    ),
	    'new-campaign-wants-you-to-raise-funds-for-abuse-victims-by-ditching-the-razor' => array(
		    'title' => "الأمم العربية تقول إن لديها استجابة قطر للمطالب",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl6',
		    'taxonomy' => array(
			    'category' => 'food,science,movie,mobile',
			    'post_tag' => 'climate-change,flat-earth,tv-series,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:science:id}}')
		    )
	    ),
	    'meet-the-woman-whos-making-consumer-boycotts-great-again' => array(
		    'title' => "تلبية المرأة الذي يجعل المستهلكين المقاطعة كبيرة مرة أخرى",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl7',
		    'taxonomy' => array(
			    'category' => 'apps,sports,food,science',
			    'post_tag' => 'flat-earth,market-stories,future-of-news,motogp,earth-day'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:science:id}}')
		    )
	    ),
	    'twitter-tweaks-video-again-adding-view-counts-for-some-users' => array(
		    'title' => "يقوم تويتر بتعديل الفيديو مرة أخرى، مع إضافة مشاهدات لبعض المستخدمين",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl8',
		    'taxonomy' => array(
			    'category' => 'apps,sports,politics,fashion',
			    'post_tag' => 'climate-change,flat-earth,market-stories,future-of-news,tv-series,election-results'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
			    'post_subtitle' => 'قبل أي شيء آخر، وإعداد هو مفتاح النجاح.'
		    )
	    ),
	    '%d8%a8%d8%a7%d8%b1%d8%a7%d9%83-%d8%a3%d9%88%d8%a8%d8%a7%d9%85%d8%a7-%d9%88%d8%b2%d9%8a%d8%a7%d8%b1%d8%a9-%d8%a7%d9%84%d8%b9%d8%a7%d8%a6%d9%84%d8%a9-%d8%a8%d8%a7%d9%84%d9%8a%d9%86%d9%8a%d8%b2-%d8%ad' => array(
		    'title' => "باراك أوباما وزيارة العائلة بالينيز حقول الأرز خلال عطلة",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl9',
		    'taxonomy' => array(
			    'category' => 'business,politics,movie,mobile',
			    'post_tag' => 'flat-earth,market-stories,tv-series,motogp,election-results'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}')
		    )
	    ),
	    '%d8%a7%d9%84%d8%b4%d8%ba%d8%a8-%d8%aa%d9%82%d8%b1%d9%8a%d8%b1-%d9%8a%d8%b8%d9%87%d8%b1-%d9%84%d9%86%d8%af%d9%86-%d9%8a%d8%ad%d8%aa%d8%a7%d8%ac-%d8%a5%d9%84%d9%89-%d8%a7%d9%84%d8%ad%d9%81%d8%a7%d8%b8' => array(
		    'title' => "الشغب تقرير يظهر لندن يحتاج إلى الحفاظ على أرقام الشرطة، يقول عمدة",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl1',
		    'taxonomy' => array(
			    'category' => 'startup,food,mobile,fashion',
			    'post_tag' => 'united-stated,climate-change,market-stories,future-of-news,election-results'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
		    )
	    ),
	    '%d9%85%d8%a7%d9%86%d8%b4%d8%b3%d8%aa%d8%b1-%d9%8a%d9%88%d9%86%d8%a7%d9%8a%d8%aa%d8%af-%d9%8a%d8%b6%d9%85-%d8%a7%d9%84%d8%a8%d9%84%d8%ac%d9%8a%d9%83%d9%8a-%d9%84%d9%88%d9%83%d8%a7%d9%83%d9%88-%d9%85' => array(
		    'title' => "مانشستر يونايتد يضم البلجيكي لوكاكو مقابل 75 مليون استرليني",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl2',
		    'taxonomy' => array(
			    'category' => 'startup,travel,food,mobile,fashion',
			    'post_tag' => 'united-stated,climate-change,market-stories,future-of-news,election-results'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:travel:id}}')
		    )
	    ),
	    '%d8%a7%d9%84%d9%86%d8%a7%d8%b3-%d9%8a%d9%88%d8%b2%d8%b9%d9%88%d9%86-%d8%b4%d8%a7%d8%b1%d8%a7%d8%aa-%d9%81%d9%8a-%d9%85%d8%ad%d8%b7%d8%a7%d8%aa-%d8%a3%d9%86%d8%a8%d9%88%d8%a8-%d9%84%d9%85%d8%b9%d8%a7-2' => array(
		    'title' => "الناس يوزعون شارات في محطات أنبوب لمعالجة الوحدة",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl3',
		    'taxonomy' => array(
			    'category' => 'gaming,health,sports,gear',
			    'post_tag' => 'united-stated,flat-earth,tv-series,motogp,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
		    )
	    ),
	    '%d9%8a%d8%b6%d8%b9%d9%81-%d8%a3%d8%af%d8%a7%d8%a1-%d8%a7%d9%84%d8%b4%d8%b1%d9%83%d8%a9%d8%8c-%d9%81%d9%85%d9%86-%d8%a7%d9%84%d9%85%d8%b3%d8%aa%d8%ad%d8%b3%d9%86-%d8%b1%d9%88%d9%81%d9%8a%d9%88-%d8%a7' => array(
		    'title' => "يضعف أداء الشركة، فمن المستحسن روفيو الاكتتاب أو الشراء",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl4',
		    'taxonomy' => array(
			    'category' => 'gaming,health,sports,gear',
			    'post_tag' => 'united-stated,flat-earth,tv-series,motogp,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
			    'post_subtitle' => 'رجل يحتاج صعوباته لأنها ضرورية للتمتع بالنجاح'
		    )
	    ),
	    'india-is-bringing-free-wi-fi-to-more-than-1000-villages-this-year' => array(
		    'title' => "تقدم الهند واي فاي مجاني إلى أكثر من 1000 قرية هذا العام",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl5',
		    'taxonomy' => array(
			    'category' => 'health,politics,science,mobile',
			    'post_tag' => 'united-stated,climate-change,flat-earth,market-stories,motogp'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:politics:id}}'),
			    'post_subtitle' => 'أفضل طريقة لدفع لحظة جميلة هو التمتع بها.'
		    )
	    ),
	    '%d9%8a%d8%aa%d8%ad%d8%b1%d9%83-%d8%a7%d9%84%d8%aa%d8%ad%d8%b1%d9%83-%d8%a5%d9%84%d9%89-%d9%85%d8%a7-%d9%87%d9%88-%d8%a3%d8%a8%d8%b9%d8%af-%d9%85%d9%86-%d8%aa%d9%82%d8%af%d9%8a%d9%85-%d8%a7%d9%84%d9%85' => array(
		    'title' => "يتحرك التحرك إلى ما هو أبعد من تقديم المشورة مع المخططين الماليين البشريين",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl6',
		    'taxonomy' => array(
			    'category' => 'world,politics,food,mobile',
			    'post_tag' => 'climate-change,future-of-news,motogp,election-results,earth-day'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:politics:id}}')
		    )
	    ),
	    '%d8%a7%d9%84%d9%86%d8%a7%d8%b3-%d9%8a%d9%88%d8%b2%d8%b9%d9%88%d9%86-%d8%b4%d8%a7%d8%b1%d8%a7%d8%aa-%d9%81%d9%8a-%d9%85%d8%ad%d8%b7%d8%a7%d8%aa-%d8%a3%d9%86%d8%a8%d9%88%d8%a8-%d9%84%d9%85%d8%b9%d8%a7' => array(
		    'title' => "الناس يوزعون شارات في محطات أنبوب لمعالجة الوحدة",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl7',
		    'taxonomy' => array(
			    'category' => 'gaming,sports,gear,fashion',
			    'post_tag' => 'united-stated,flat-earth,tv-series,motogp,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
		    )
	    ),
	    '%d9%87%d8%a7%d9%85%d8%a8%d9%88%d8%b1%d8%ba-%d8%aa%d9%82%d9%81-%d9%84%d8%b9%d9%86%d9%81-%d9%85%d8%ac%d9%85%d9%88%d8%b9%d8%a9-%d8%a7%d9%84%d8%b9%d8%b4%d8%b1%d9%8a%d9%86-%d9%85%d8%b9-%d8%aa%d8%b2%d8%a7' => array(
		    'title' => "هامبورغ تقف لعنف مجموعة العشرين مع تزايد التوترات على تكتيكات الشرطة",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl8',
		    'taxonomy' => array(
			    'category' => 'travel,sports,food,mobile',
			    'post_tag' => 'climate-change,flat-earth,future-of-news,tv-series,sillicon-valley,earth-day'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:travel:id}}')
		    )
	    ),
	    'this-filipino-guy-channels-his-inner-miss-universe-by-strutting-in-six-inch-heels-and-speedos' => array(
		    'title' => "لماذا نعتقد أن الفقراء فقراء بسبب خياراتهم السيئة؟",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl9',
		    'taxonomy' => array(
			    'category' => 'health,science,music,fashion',
			    'post_tag' => 'united-stated,future-of-news,motogp,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:science:id}}')
		    )
	    ),
	    '%d8%a7%d9%84%d9%86%d9%81%d8%b7-%d8%aa%d8%b3%d8%b1%d8%a8-%d9%82%d8%a8%d8%a7%d9%84%d8%a9-%d8%a7%d9%84%d8%b3%d8%a7%d8%ad%d9%84-%d8%a7%d9%84%d8%ac%d9%86%d9%88%d8%a8%d9%8a-%d8%a7%d9%84%d9%87%d9%86%d8%af' => array(
		    'title' => "النفط تسرب قبالة الساحل الجنوبي الهند يترك صياد الذين تقطعت بهم السبل، وتأثرت الحياة البحرية",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl1',
		    'taxonomy' => array(
			    'category' => 'startup,world,politics,movie',
			    'post_tag' => 'united-stated,climate-change,market-stories,motogp,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:politics:id}}')
		    )
	    ),
	    '%d9%8a%d9%85%d9%83%d9%86%d9%83-%d8%a7%d9%84%d8%a2%d9%86-%d9%84%d8%b9%d8%a8-%d8%a8%d9%8a%d9%84-%d8%ba%d9%8a%d8%aa%d8%b3-%d8%a3%d9%88%d9%84-%d9%84%d8%b9%d8%a8%d8%a9-%d9%83%d9%85%d8%a8%d9%8a%d9%88%d8%aa' => array(
		    'title' => "يمكنك الآن لعب بيل غيتس أول لعبة كمبيوتر وتشغيل أكثر الحمير على اي فون الخاص بك، وأبل ووتش",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl2',
		    'taxonomy' => array(
			    'category' => 'business,apps,world,movie',
			    'post_tag' => 'united-stated,future-of-news,tv-series,sillicon-valley,earth-day'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}')
		    )
	    ),
	    '%d9%88%d8%a7%d9%84%d8%aa%d8%b1-%d8%b4%d9%88%d8%a8-%d8%b1%d8%a6%d9%8a%d8%b3-%d9%85%d9%83%d8%aa%d8%a8-%d8%a7%d9%84%d8%a3%d8%ae%d9%84%d8%a7%d9%82%d9%8a%d8%a7%d8%aa-%d8%a7%d9%84%d8%a3%d9%85%d8%b1%d9%8a' => array(
		    'title' => "والتر شوب رئيس مكتب الأخلاقيات الأمريكي ينوي الاستقالة بعد صدام مع ترامب",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl3',
		    'taxonomy' => array(
			    'category' => 'business,apps,mobile,gear',
			    'post_tag' => 'united-stated,climate-change,flat-earth,motogp,election-results,earth-day'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}')
		    )
	    ),
	    '%d8%a7%d9%83%d8%aa%d8%b4%d9%81%d8%aa-%d8%ad%d8%af%d9%8a%d8%ab%d8%a7-%d8%b1%d9%8a%d9%86%d9%8a%d8%aa%d8%b3-%d8%a7%d9%84%d8%b5%d9%88%d8%b1%d8%a9-%d8%a3%d9%85%d9%8a%d9%84%d9%8a%d8%a7-%d8%a5%d9%8a%d8%b1' => array(
		    'title' => "اكتشفت حديثا رينيتس الصورة أميليا إيرهارت نظرية المؤامرة",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl4',
		    'taxonomy' => array(
			    'category' => 'apps,politics,movie,fashion',
			    'post_tag' => 'climate-change,flat-earth,future-of-news,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:politics:id}}')
		    )
	    ),
	    'everyone-stop-everything-beyonc-just-announced-that-shes-pregnant-with-twins' => array(
		    'title' => "ناشطون يبكون الجبن كما يغلق أعضاء مجلس الشيوخ الجمهوريين الأبواب إلى قاعات المدينة الصحية",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl5',
		    'taxonomy' => array(
			    'category' => 'apps,travel,mobile,music',
			    'post_tag' => 'united-stated,flat-earth,tv-series,motogp,election-results'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:travel:id}}')
		    )
	    ),
	    '%d8%a7%d9%84%d8%aa%d8%ad%d9%82%d9%8a%d9%82-%d9%81%d9%8a-%d9%85%d8%a7%d9%86%d8%a7%d8%af%d9%88-%d8%aa%d8%b3%d8%a7%d8%b1%d8%b9-%d9%85%d9%86-%d8%a3%d8%ac%d9%84-%d8%aa%d8%ad%d9%82%d9%82-%d9%85%d8%b3%d8%a4' => array(
		    'title' => "التحقيق في مانادو تسارع من أجل تحقق مسؤولون زوجه",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl6',
		    'taxonomy' => array(
			    'category' => 'gaming,health,sports,gear',
			    'post_tag' => 'united-stated,flat-earth,tv-series,motogp,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:fashion:id}}'),
			    'post_subtitle' => 'رجل يحتاج صعوباته لأنها ضرورية للتمتع بالنجاح'
		    )
	    ),
	    '%d9%85%d9%86-%d8%ad%d9%84%d9%82%d8%a9-%d9%85%d9%81%d8%b1%d8%ba%d8%a9-%d8%a5%d9%84%d9%89-%d8%a7%d9%84%d8%aa%d8%b1%d9%8a%d8%a7%d8%aa%d9%84%d9%88%d9%86-%d9%83%d9%8a%d9%81-%d8%aa%d8%ba%d9%8a%d8%b1-%d8%b2' => array(
		    'title' => "من حلقة مفرغة إلى الترياتلون: كيف تغير زوج من الاحذية حياتي",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl7',
		    'taxonomy' => array(
			    'category' => 'business,gaming,apps,travel',
			    'post_tag' => 'united-stated,flat-earth,market-stories,tv-series,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}')
		    )
	    ),
	    '%d8%b3%d8%aa%d8%a9-%d8%b9%d9%84%d8%a7%d9%85%d8%a7%d8%aa-%d8%a3%d9%86-%d8%a3%d9%86%d8%aa-%d9%88%d8%a7%d9%84%d8%af%d8%b1%d8%a7%d8%ac%d8%a9-%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9-%d8%a8%d9%83-%d9%82%d8%af' => array(
		    'title' => "ستة علامات أن أنت والدراجة الخاصة بك قد نفد من الطريق",
		    'content' => 'post2.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl8',
		    'taxonomy' => array(
			    'category' => 'business,travel,health,music',
			    'post_tag' => 'united-stated,market-stories,future-of-news,election-results,sillicon-valley'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}')
		    )
	    ),
	    '%d8%aa%d8%ac%d8%b9%d9%84-%d9%86%d9%81%d8%b3%d9%83-%d9%8a%d8%b4%d8%b9%d8%b1-%d8%b9%d9%84%d9%89-%d9%86%d8%ad%d9%88-%d8%a3%d9%81%d8%b6%d9%84-%d9%85%d9%86-%d8%ae%d9%84%d8%a7%d9%84-%d8%a7%d9%84%d8%b6%d8%ad' => array(
		    'title' => "تجعل نفسك يشعر على نحو أفضل من خلال الضحك على أفضل الخرافات الأخبار يناير",
		    'content' => 'post1.txt',
		    'post_type' => 'post',
		    'featured_image' => 'rtl9',
		    'taxonomy' => array(
			    'category' => 'startup,business,food,gear',
			    'post_tag' => 'united-stated,climate-change,motogp,election-results,sillicon-valley,earth-day'
		    ),
		    'metabox' => array(
			    'jnews_primary_category' => array('id' => '{{category:business:id}}')
		    )
	    ),
	    '%d8%a8%d8%a7%d8%b3%d8%aa%d8%ae%d8%af%d8%a7%d9%85-%d8%ac%d9%87%d8%a7%d8%b2-%d9%82%d8%b1%d8%a7%d8%a1%d8%a9-%d8%a7%d9%84%d8%b9%d9%82%d9%84%d8%8c-%d9%88%d9%82%d8%a7%d9%84-%d8%a7%d9%84%d9%85%d8%b1%d8%b6' => array(
		    'title' => "ناشطون يبكون الجبن كما يغلق أعضاء مجلس الشيوخ الجمهوريين الأبواب إلى قاعات المدينة الصحية",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl1',
			'taxonomy' => array(
				'category' => 'startup,travel,sports,fashion',
				'post_tag' => 'united-stated,motogp,election-results,sillicon-valley,earth-day'
			),
					'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
			)
		),
		'%d9%88%d8%a7%d9%8a%d9%86-%d8%b1%d9%88%d9%86%d9%8a-%d9%85%d8%b1%d8%a9-%d8%a3%d8%ae%d8%b1%d9%89-%d9%81%d9%8a-%d8%a7%d9%8a%d9%81%d8%b1%d8%aa%d9%88%d9%86-%d8%b3%d9%8a%d9%83%d9%88%d9%86-%d8%b1%d9%88%d8%a7' => array(
			'title' => "واين روني مرة أخرى في ايفرتون سيكون رواية - ولكن قد تنتهي بشكل جيد في البكاء",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl2',
			'taxonomy' => array(
				'category' => 'travel,food,mobile,fashion',
				'post_tag' => 'market-stories,future-of-news,motogp,election-results,sillicon-valley,earth-day'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:fashion:id}}')
			)
		),
		'%d8%aa%d8%b1%d8%a7%d9%85%d8%a8-%d9%85%d8%a7%d9%8a-%d8%b9%d9%84%d8%a7%d9%82%d8%a9-%d8%ae%d8%a7%d8%b5%d8%a9-%d9%8a%d8%ad%d8%b5%d9%84-%d8%b9%d9%84%d9%89-%d9%85%d8%b9%d8%a7%d9%85%d9%84%d8%a9-%d8%ae%d8%a7' => array(
			'title' => "ترامب-ماي علاقة خاصة يحصل على معاملة خاصة في شوارع لندن",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl3',
			'taxonomy' => array(
				'category' => 'business,politics,movie,music',
				'post_tag' => 'united-stated,market-stories,future-of-news,tv-series,motogp,election-results'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}')
			)
		),
		'%d8%aa%d9%88%d8%a7%d8%ac%d9%87-%d8%a7%d9%84%d9%82%d9%88%d8%a7%d8%aa-%d8%a7%d9%84%d8%b5%d9%8a%d9%86%d9%8a%d8%a9-%d9%88%d8%a7%d9%84%d9%87%d9%86%d8%af%d9%8a%d8%a9-%d9%85%d9%88%d8%a7%d8%ac%d9%87%d8%a9' => array(
			'title' => "تواجه القوات الصينية والهندية مواجهة فى النزاع الحدودى فى بوتان",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl4',
			'taxonomy' => array(
				'category' => 'startup,business,sports,music',
				'post_tag' => 'united-stated,flat-earth,tv-series,sillicon-valley,earth-day'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}')
			)
		),
		'of-course-this-novelty-final-fantasy-fork-is-an-oversized-sword-replica' => array(
			'title' => "ناشطون يبكون الجبن كما يغلق أعضاء مجلس الشيوخ الجمهوريين الأبواب إلى قاعات المدينة الصحية",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl5',
			'taxonomy' => array(
				'category' => 'startup,business,apps,sports',
				'post_tag' => 'united-stated,climate-change,market-stories,motogp,election-results'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}'),
				'post_subtitle' => 'قبل أي شيء آخر، وإعداد هو مفتاح النجاح.'
			)
		),
		'%d9%83%d9%8a%d9%81%d9%8a%d8%a9-%d8%a7%d9%84%d8%b9%d8%ab%d9%88%d8%b1-%d8%b9%d9%84%d9%89-%d8%a7%d9%84%d8%a7%d8%ad%d8%aa%d8%ac%d8%a7%d8%ac%d8%a7%d8%aa-%d9%81%d9%8a-%d9%85%d8%af%d9%8a%d9%86%d8%aa%d9%83' => array(
			'title' => "كيفية العثور على الاحتجاجات في مدينتك عندما كنت لا تعرف من أين تبدأ",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl6',
			'taxonomy' => array(
				'category' => 'apps,travel,food,science',
				'post_tag' => 'market-stories,future-of-news,tv-series,election-results,earth-day'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:science:id}}')
			)
		),
		'%d9%83%d9%8a%d9%81-%d8%aa%d8%ae%d8%b7%d8%b7-%d9%86%d8%a7%d9%8a%d9%83-%d9%84%d9%83%d8%b3%d8%b1-%d9%88%d8%a7%d8%ad%d8%af%d8%a9-%d9%85%d9%86-%d8%a3%d9%83%d8%ab%d8%b1-%d8%a7%d9%84%d8%ad%d9%88%d8%a7%d8%ac' => array(
			'title' => "كيف تخطط نايك لكسر واحدة من أكثر الحواجز شاقة في الأداء البشري",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl7',
			'taxonomy' => array(
				'category' => 'world,politics,gear,fashion',
				'post_tag' => 'united-stated,climate-change,flat-earth,future-of-news,tv-series,election-results'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:politics:id}}')
			)
		),
		'%d8%ac%d9%88%d9%84%d8%a9-%d9%81%d8%b1%d9%86%d8%b3%d8%a7-%d9%83%d8%b1%d9%8a%d8%b3-%d9%81%d8%b1%d9%88%d9%85-%d9%81%d9%8a-%d8%ac%d9%8a%d8%b1%d8%b3%d9%8a-%d8%a7%d9%84%d8%a3%d8%b5%d9%81%d8%b1-%d9%83%d9%85' => array(
			'title' => "جولة فرنسا: كريس فروم في جيرسي الأصفر كما فابيو أرو يفوز المرحلة الخامسة",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl8',
			'taxonomy' => array(
				'category' => 'gaming,science,mobile,music',
				'post_tag' => 'flat-earth,future-of-news,tv-series,motogp,earth-day'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:science:id}}')
			)
		),
		'%d8%a7%d9%84%d8%ac%d9%85%d9%87%d9%88%d8%b1%d9%8a%d9%88%d9%86-%d9%81%d9%8a-%d9%85%d8%ac%d9%84%d8%b3-%d8%a7%d9%84%d9%86%d9%88%d8%a7%d8%a8-%d9%8a%d8%b5%d9%88%d8%aa%d9%88%d9%86-%d9%84%d8%a5%d9%86%d9%87' => array(
			'title' => "الجمهوريون في مجلس النواب يصوتون لإنهاء حكم وقف حطام تعدين الفحم من يجري إغراقها في تيارات",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl9',
			'taxonomy' => array(
				'category' => 'business,apps,politics,mobile',
				'post_tag' => 'united-stated,climate-change,market-stories,future-of-news,motogp'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}'),
				'post_subtitle' => 'كل ما تحتاجه في هذه الحياة هو الجهل والثقة، ثم النجاح هو بالتأكيد.'
			)
		),
		'%d9%88%d9%82%d8%af-%d8%a8%d8%b1%d8%af%d8%aa-%d8%b1%d9%88%d9%85%d8%a7%d9%86%d8%b3%d9%8a%d8%a9-%d8%af%d9%88%d9%86%d8%a7%d9%84%d8%af-%d8%aa%d8%b1%d8%a7%d9%85%d8%a8-%d9%85%d8%b9-%d8%b4%d9%8a-%d8%a7%d9%84' => array(
			'title' => "ناشطون يبكون الجبن كما يغلق أعضاء مجلس الشيوخ الجمهوريين الأبواب إلى قاعات المدينة الصحية",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl1',
			'taxonomy' => array(
				'category' => 'startup,health,world,sports,science,mobile',
				'post_tag' => 'united-stated,flat-earth,election-results,sillicon-valley,earth-day'
			),
					'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}')
			)
		),
		'%d9%88%d8%a5%d9%84%d9%8a%d9%83-%d9%83%d9%8a%d9%81-%d8%aa%d8%ba%d9%8a%d8%b1%d8%aa-%d8%aa%d8%b3%d9%84%d8%a7-%d9%85%d9%88%d8%af%d9%8a%d9%84-3-%d9%85%d9%86-%d8%a7%d9%84%d9%86%d9%85%d9%88%d8%b0%d8%ac' => array(
			'title' => "وإليك كيف تغيرت تسلا موديل 3 من النموذج إلى سيارة الإنتاج",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl2',
			'taxonomy' => array(
				'category' => 'startup,gaming,world,science,gear,fashion',
				'post_tag' => 'united-stated,future-of-news,election-results,sillicon-valley,earth-day'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:world:id}}'),
				'post_subtitle' => 'كل ما تحتاجه في هذه الحياة هو الجهل والثقة، ثم النجاح هو بالتأكيد.'
			)
		),
		'%d9%81%d9%88%d8%b1%d8%b3%d8%a8%d8%b1%d9%88%d9%86%d8%ba-%d8%af%d9%88%d8%b1%d8%b4-%d8%aa%d9%8a%d8%b4%d9%86%d9%8a%d9%83-%d8%a3%d9%88%d8%b3-%d8%aa%d9%8a%d8%b4-%d8%ac%d9%8a%d8%a7%d9%86%d8%aa%d8%b3-v' => array(
			'title' => "فورسبرونغ دورش تيشنيك: أوس تيش جيانتس v ألمانيا في سباق السيارات بدون سائق",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl3',
			'taxonomy' => array(
				'category' => 'startup,gaming,health,world,science,music',
				'post_tag' => 'united-stated,climate-change,flat-earth,future-of-news,election-results'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:health:id}}')
			)
		),
		'watch-justin-timberlakes-cry-me-a-river-come-to-life-in-mesmerizing-dance' => array(
			'title' => "مشاهدة جوستين تيمبرليك 'صرخة لي نهر' تعال إلى الحياة في الرقص مليء بالجمال",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl4',
			'taxonomy' => array(
				'category' => 'startup,business,health,world,science,movie',
				'post_tag' => 'climate-change,future-of-news,motogp,sillicon-valley,earth-day',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:business:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=uuZE_IRwLNI'
			)
		),
		'%d8%a3%d9%88%d9%86%d8%b4%d8%a7%d8%b1%d8%aa%d8%af-%d8%a3%d8%ad%d8%af%d8%ab-%d8%a7%d9%84%d8%b9%d8%b1%d9%88%d8%b6-%d8%a7%d9%84%d8%aa%d9%88%d8%b6%d9%8a%d8%ad%d9%8a%d8%a9-%d8%a7%d9%84%d9%85%d9%81%d9%82' => array(
			'title' => "أونشارتد: أحدث العروض التوضيحية المفقودة تراث عرض الكنز الصيد ديو في المزامنة",
			'content' => 'post1.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl5',
			'taxonomy' => array(
				'category' => 'travel,world,science,movie,music',
				'post_tag' => 'united-stated,flat-earth,market-stories,tv-series,motogp,earth-day',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:science:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=B8QiF7ycXDo'
			)
		),
		'%d9%84%d9%8a%d8%af%d9%8a-%d8%ba%d8%a7%d8%ba%d8%a7-%d8%b3%d8%ad%d8%a8%d8%aa-%d9%82%d8%a8%d8%a7%d9%84%d8%a9-%d9%88%d8%a7%d8%ad%d8%af%d8%a9-%d9%85%d9%86-%d8%a3%d9%81%d8%b6%d9%84-%d8%b9%d8%b1%d9%88%d8%b6' => array(
			'title' => "ليدي غاغا سحبت قبالة واحدة من أفضل عروض الوقت الحقيقي من أي وقت مضى",
			'content' => 'post2.txt',
			'post_type' => 'post',
			'featured_image' => 'rtl6',
			'taxonomy' => array(
				'category' => 'travel,world,politics,science,movie,music',
				'post_tag' => 'united-stated,flat-earth,market-stories,tv-series,motogp,earth-day',
				'post_format' => 'post-format-video'
			),
			'metabox' => array(
				'jnews_primary_category' => array('id' => '{{category:music:id}}'),
				'_format_video_embed' => 'https://www.youtube.com/watch?v=txXwg712zw4'
			)
		),

        // page
        'home-1' => array(
            'title' => 'الرئيسية',
            'content' => 'home1.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1499828165738{padding-top: 40px !important;background-color: #141414 !important;}.vc_custom_1499828181644{margin-bottom: 40px !important;padding-top: 25px !important;padding-bottom: 25px !important;background-color: #f5f5f5 !important;}.vc_custom_1499828156986{margin-bottom: 0px !important;}',
                'jnews_page_loop' => array(
	                'enable_page_loop' => '1',
	                'first_title' => 'آخر مشاركة',
	                'header_type' => 'heading_8',
	                'layout' => 'left-sidebar',
	                'sidebar' => 'home-loop',
	                'module'    => '4',
	                'excerpt_length' => '20',
	                'content_date' => 'Y/m/d',
	                'content_pagination' => 'nav_1',
	                'pagination_align' => 'center',
	                'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home1.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1499828165738{padding-top: 40px !important;background-color: #141414 !important;}.vc_custom_1499828181644{margin-bottom: 40px !important;padding-top: 25px !important;padding-bottom: 25px !important;background-color: #f5f5f5 !important;}.vc_custom_1499828156986{margin-bottom: 0px !important;}'
                )
            )
        ),
        'home-2' => array(
            'title' => 'الصفحة الرئيسية 2',
            'content' => 'home2.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                'jnews_page_loop' => array(
	                'enable_page_loop' => '1',
	                'first_title' => 'أحدث الأخبار',
	                'header_type' => 'heading_6',
	                'layout' => 'right-sidebar',
	                'sidebar' => 'home-2-loop',
	                'module'    => '9',
	                'excerpt_length' => '20',
	                'content_date' => 'Y/m/d',
	                'content_pagination' => 'nav_1',
	                'pagination_align' => 'center',
	                'sort_by' => 'latest',
                ),
                '_elementor_data' => 'home2.json',
                '_elementor_edit_mode' => 'builder'
            )
        ),
        'home-3' => array(
            'title' => 'الصفحة الرئيسية 3',
            'content' => 'home3.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1499838706012{margin-top: -30px !important;}.vc_custom_1499851836504{margin-top: 15px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #111111 !important;}.vc_custom_1499838741889{padding-right: 0px !important;padding-left: 0px !important;}',
                '_elementor_data' => 'home3.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1499838706012{margin-top: -30px !important;}.vc_custom_1499851836504{margin-top: 15px !important;margin-bottom: 40px !important;padding-top: 30px !important;background-color: #111111 !important;}.vc_custom_1499838741889{padding-right: 0px !important;padding-left: 0px !important;}'
                )
            )
        ),
        'home-4' => array(
            'title' => 'الصفحة الرئيسية 4',
            'content' => 'home4.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_elementor_data' => 'home4.json',
                '_elementor_edit_mode' => 'builder'
            )
        ),
        'home-5' => array(
            'title' => 'الصفحة الرئيسية 5',
            'content' => 'home5.txt',
            'post_type' => 'page',
            'metabox' => array(
                '_wp_page_template' => 'template-builder.php',
                '_wpb_shortcodes_custom_css' => '.vc_custom_1499916616568{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f9f9f9 !important;}.vc_custom_1499916585567{margin-bottom: 0px !important;}',
                'jnews_page_loop' => array(
                    'enable_page_loop' => '1',
                    'first_title' => 'المزيد من الأخبار',
                    'header_type' => 'heading_6',
                    'layout' => 'left-sidebar',
                    'sidebar' => 'home-loop',
                    'module'    => '4',
                    'excerpt_length' => '20',
                    'content_date' => 'default',
                    'content_pagination' => 'nav_1',
                    'show_navtext' => '1',
                    'show_pageinfo' => '1',
                    'pagination_align' => 'left',
                ),
                '_elementor_data' => 'home5.json',
                '_elementor_edit_mode' => 'builder',
                '_elementor_page_settings' => array(
	                'custom_css' => '.vc_custom_1499916616568{margin-bottom: 40px !important;padding-top: 15px !important;padding-bottom: 15px !important;background-color: #f9f9f9 !important;}.vc_custom_1499916585567{margin-bottom: 0px !important;}'
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
                'menu-item-title' => 'الرئيسية',
                'menu-item-type' => 'post_type',
                'menu-item-object' => 'page',
                'menu-item-object-id' => '{{post:home-1:id}}',
                'menu-item-status' => 'publish'
            )
        ),
	        'home-1' => array(
		        'location' => 'main-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'الصفحة الرئيسية 1',
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
			        'menu-item-title' => 'الصفحة الرئيسية 2',
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
			        'menu-item-title' => 'الصفحة الرئيسية 3',
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
			        'menu-item-title' => 'الصفحة الرئيسية 4',
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
			        'menu-item-title' => 'الصفحة الرئيسية 5',
			        'menu-item-parent-id' => '{{menu:home:id}}',
			        'menu-item-type' => 'post_type',
			        'menu-item-object' => 'page',
			        'menu-item-object-id' => '{{post:home-5:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),

        'business' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'اعمال',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:business:id}}',
		        'menu-item-status' => 'publish'
	        ),
	        'metabox' => array(
		        'menu_item_jnews_mega_menu' => array(
			        'type' => 'category_1',
			        'category' => '{{category:business:id}}',
			        'number' => 8,
		        ),
	        )
        ),
        'tech' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'التكنولوجيا',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:tech:id}}',
		        'menu-item-status' => 'publish'
	        ),
	        'metabox' => array(
		        'menu_item_jnews_mega_menu' => array(
			        'type' => 'category_2',
			        'category' => '{{category:tech:id}}',
			        'number' => 6,
			        'trending_tag' => '{{taxonomy:post_tag:climate-change:id}},{{taxonomy:post_tag:future-of-news:id}},{{taxonomy:post_tag:tv-series:id}},{{taxonomy:post_tag:united-stated:id}},{{taxonomy:post_tag:election-results:id}},{{taxonomy:post_tag:sillicon-valley:id}},{{taxonomy:post_tag:market-stories:id}}',
		        ),
	        )
        ),
        'lifestyle' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'لايف ستايل',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:lifestyle:id}}',
		        'menu-item-status' => 'publish'
	        ),
	        'metabox' => array(
		        'menu_item_jnews_mega_menu' => array(
			        'type' => 'category_1',
			        'category' => '{{category:lifestyle:id}}',
			        'number' => 9,
		        ),
	        )
        ),
        'entertainment' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'وسائل الترفيه',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:entertainment:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'world' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'العالمية',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:world:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'politics' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'سياسة',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:politics:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'science' => array(
	        'location' => 'main-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'علم',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:science:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),

	    // mobile menu
        'mobile-home' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'الرئيسية',
		        'menu-item-type' => 'post_type',
		        'menu-item-object' => 'page',
		        'menu-item-object-id' => '{{post:home-1:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'news' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'أخبار',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{category:news:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
	        'mobile-business' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'اعمال',
			        'menu-item-parent-id' => '{{menu:news:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{post:business:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'mobile-world' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'العالمية',
			        'menu-item-parent-id' => '{{menu:news:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{post:world:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'mobile-politics' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'سياسة',
			        'menu-item-parent-id' => '{{menu:news:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{post:politics:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
	        'mobile-science' => array(
		        'location' => 'mobile-navigation',
		        'menu-item-data' => array(
			        'menu-item-title' => 'علم',
			        'menu-item-parent-id' => '{{menu:news:id}}',
			        'menu-item-type' => 'taxonomy',
			        'menu-item-object' => 'category',
			        'menu-item-object-id' => '{{post:science:id}}',
			        'menu-item-status' => 'publish'
		        )
	        ),
        'mobile-tech' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'التكنولوجيا',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{post:tech:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'mobile-lifestyle' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'لايف ستايل',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{post:lifestyle:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
        'mobile-entertainment' => array(
	        'location' => 'mobile-navigation',
	        'menu-item-data' => array(
		        'menu-item-title' => 'وسائل الترفيه',
		        'menu-item-type' => 'taxonomy',
		        'menu-item-object' => 'category',
		        'menu-item-object-id' => '{{post:entertainment:id}}',
		        'menu-item-status' => 'publish'
	        )
        ),
    ),

    'widget_position' => array(
        'Home',
	    'Home Loop',
	    'Home 2',
	    'Home 2 Loop',
	    'Home 3',
	    'Search',
	    'Home 4'
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
        'jnews-split',
        'jnews-view-counter',
        'jnews-weather',
        'mailchimp-for-wp'
    )

);