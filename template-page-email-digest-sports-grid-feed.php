<?php
/**
* Template Name: Email Digest Sports Grid RSS Feed
*/
$StanfordTimezone = new DateTimeZone('America/Los_Angeles');
$StanfordTime = new DateTime("now", $StanfordTimezone);

$time = time() + $StanfordTimezone->getOffset($StanfordTime);
$posts = query_posts(array('cat' => '-27387,29059', 'showposts' => 100, 'posts_per_page' => 100));

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
	xmlns:media="http://search.yahoo.com/mrss"
        <?php do_action('rss2_ns'); ?>>
<meta http-equiv="charset" content="UTF-8" />
<channel>
        <title>Email Digest Sports Grid RSS Feed</title>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
        <link>http://www.stanforddaily.com/email-digest-sports-grid-feed/</link>
        <description>Email Digest Sports Grid Feed</description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <language>en-US</language>
        <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
        <?php while(have_posts()) : the_post(); ?>
	<?php
		$mylimit=1 * 86400; //days * seconds per day
		if (date('N') == 1) { //Monday
			$mylimit = 3 * 86400; //posts over the weekend
		}
		$post_age = date('U') - mysql2date('U', $post->post_date_gmt);
		if ($post_age < $mylimit) { ?>
			 <item>
		                <title><?php the_title_rss(); ?></title>
	                        <link><?php the_permalink_rss(); ?>?utm_source=rss&amp;utm_medium=rss&amp;utm_source=The+Stanford+Daily+e-mail+digest</link>
				<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
				<dc:creator><?php the_author(); ?></dc:creator>
				<guid isPermaLink="false"><?php the_guid(); ?></guid>
				<description><![CDATA[<?php the_excerpt() ?>]]></description>
				<?php if(get_the_post_thumbnail()): ?>
				<media:content url="<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array(150,100)); echo $image[0]; ?>" medium="image" />
				<?php endif; ?>
				<content:encoded><![CDATA[<?php the_excerpt_rss() ?>]]></content:encoded>
				<?php rss_enclosure(); ?>
		                <?php do_action('rss2_item'); ?>
		        </item><?
		}
	endwhile; ?>
</channel>
</rss>
