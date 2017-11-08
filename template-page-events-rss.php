<?php
/**
* Template Name: Upcoming Events RSS Feed
*/
$StanfordTimezone = new DateTimeZone('America/Los_Angeles');
$StanfordTime = new DateTime("now", $StanfordTimezone);

$time = time() + $StanfordTimezone->getOffset($StanfordTime);
$posts = query_posts(array('post_type' => 'ajde_events', 'meta_key' => 'evcal_srow', 'meta_value' => $time, 'meta_compare' => '>=', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'showposts' => 100, 'posts_per_page' => 100));

function rfcDate( $s ) {
//return date(DATE_RFC822, strtotime(get_the_date()));
return date(DATE_RFC822,strtotime($s));
}

header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';

?>

<rss version="2.0"
        xmlns:content="http://purl.org/rss/1.0/modules/content/"
        xmlns:wfw="http://wellformedweb.org/CommentAPI/"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:atom="http://www.w3.org/2005/Atom"
        xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
        xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
        <?php do_action('rss2_ns'); ?>>

<channel>
        <title>Upcoming Events Feed</title>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
        <link>http://www.stanforddaily.com/upcoming-events-feed/</link>
        <description>Upcoming Events Feed</description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <language><?php echo get_option('rss_language'); ?></language>
        <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
        <?php while(have_posts()) : the_post(); ?>
<?php		$meta_values = get_post_meta(get_the_ID());
		$start_date = $meta_values['evcal_srow'];

		if ($start_date[0] - $StanfordTimezone->getOffset($StanfordTime) < time() + (24*60*60)):
?>
                <item>
                        <title><?php the_title_rss(); ?></title>
                        <pubDate><?php echo date(DATE_RFC822, $start_date[0] - $StanfordTimezone->getOffset($StanfordTime));/*mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false);*/ ?></pubDate>
                        <?php do_action('rss2_item'); ?>
                </item>
        	<?php endif;
	endwhile; ?>
</channel>
</rss>

