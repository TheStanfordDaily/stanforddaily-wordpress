<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package The_Stanford_Daily
 */

if ( ! function_exists( 'tsd_get_all_author_id' ) ) :
	/**
	 * Get all authors' ID of the current article.
	 */
	function tsd_get_all_author_id() {
		$author_list = [];
		if ( function_exists( 'get_coauthors' ) ) :
			foreach ( get_coauthors() as $each_author ) {
				$author_list[] = $each_author->ID;
			}
		else:
			$author_list = [get_the_author_meta( 'ID' )];
		endif;
		return $author_list;
	}
endif;

if ( ! function_exists( 'tsd_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function tsd_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'tsd' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'tsd_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author(s).
	 */
	function tsd_posted_by($show_avatar = true) {
		if ( function_exists( 'coauthors_posts_links' ) ) :
			// https://vip.wordpress.com/documentation/incorporate-co-authors-plus-template-tags-into-your-theme/
			$author_html = coauthors_posts_links( null, null, null, null, false );
		else:
			$author_html = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
		endif;

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'tsd' ),
			$author_html
		);

		if ($show_avatar) {
			tsd_posted_by_avatar();
		}

		echo '<span class="byline">' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'tsd_posted_by_avatar' ) ) :
	/**
	 * Prints HTML for all the avatar(s) of the author(s).
	 */
	function tsd_posted_by_avatar() {
		$author_list = tsd_get_all_author_id();

		foreach ( $author_list as $each_author ) {
			echo get_avatar( $each_author, 80, null, get_the_author_meta('display_name', $each_author) );
		}
	}
endif;

if ( ! function_exists( 'tsd_comments_count' ) ) :
	/**
	 * Prints HTML for the comments count for this post.
	 * Note that when using Disqus, putting arguments in comments_number() will not be effective.
	 * Ref: https://wordpress.stackexchange.com/q/87886/75147
	 */
	function tsd_comments_count() {
		?><span class="entry-meta-comment"><a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></span><?php
	}
endif;

if ( ! function_exists( 'tsd_author_box' ) ) :
	/**
	 * Prints HTML for the author box which contains the author information.
	 */
	function tsd_author_box( $id ) {
		$user = get_user_by( 'id' , $id );
		$user_url = esc_url( get_author_posts_url( $id ) );
		?>
		<div class="author-box">
			<div class="author-image">
				<a href="<?php echo $user_url; ?>"><?php echo get_avatar( $id, 110, null, $user->display_name ); ?></a>
			</div>
			<div class="author-content">
				<p class="author-name"><a href="<?php echo $user_url; ?>"><?php echo $user->display_name; ?></a></p>
				<p class="author-description"><?php the_author_meta( "description" , $id ); ?></p>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'tsd_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function tsd_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/*$categories_list = get_the_category_list( esc_html__( ', ', 'tsd' ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'tsd' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}*/

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( '', 'list item separator', 'tsd' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links"><span>Tags:</span>%1$s</div>', $tags_list ); // WPCS: XSS OK.
			}

			if ( is_singular() ) :
				printf( '<div class="author-boxes">' );
				$author_list = tsd_get_all_author_id();
				foreach ( $author_list as $each_author_id ) {
					tsd_author_box($each_author_id);
				}
				printf( '</div>' );
			endif;
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'tsd' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'tsd_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function tsd_post_thumbnail( $size = "post-thumbnail" ) {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( is_singular() ) :
			if ( ! has_post_thumbnail() ) {
				return;
			}
			?>

			<div class="post-feature-image">
				<?php
				the_post_thumbnail( $size, [
					'title' => the_title_attribute( [ 'echo' => false ] )
				] );
				?>
			</div><!-- .post-feature-image -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<div class="thumbnail-container<?php if ( ! has_post_thumbnail() ) { ?> no-thumbnail<?php } ?>">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( $size, [
						'title' => the_title_attribute( [ 'echo' => false ] )
					] );
				}
				?>
			</div>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'tsd_pagination' ) ) :
	/**
	 * Pagination for archive, taxonomy, category, tag and search results pages
	 * https://www.kevinleary.net/wordpress-pagination-paginate_links/
	 *
	 * @global $wp_query http://codex.wordpress.org/Class_Reference/WP_Query
	 * @return Prints the HTML for the pagination if a template is $paged
	 */
	function tsd_pagination() {
		global $wp_query;

		$big = 999999999; // This needs to be an unlikely integer

		// For more options and info view the docs for paginate_links()
		// http://codex.wordpress.org/Function_Reference/paginate_links
		$paginate_links = paginate_links( array(
			'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'mid_size' => 5,
			'prev_text' => '',
			'next_text' => ''
		) );

		// Display the pagination if more than one page is found
		if ( $paginate_links ) { ?>
		<div class="pagination">
			<?php echo $paginate_links; ?>
		</div><!-- .pagination -->
		<?php }
	}
endif;
