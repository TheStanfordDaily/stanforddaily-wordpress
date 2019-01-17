<?php
    $author_id = get_post_field( 'post_author', get_the_ID() );
?>
<?php if( get_the_author_meta( "url", $author_id ) ) : ?>
    <a href="<?php the_author_meta("url", $author_id); ?>" rel="nofollow" class="url"><i class="fa fa-globe"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "facebook", $author_id ) ) : ?>
    <a href="<?php the_author_meta("facebook", $author_id); ?>" rel="nofollow" class="facebook"><i class="fa fa-facebook-official"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "twitter", $author_id ) ) : ?>
    <a href="<?php the_author_meta("twitter", $author_id); ?>" rel="nofollow" class="twitter"><i class="fa fa-twitter"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "googleplus", $author_id ) ) : ?>
    <a href="<?php the_author_meta("googleplus", $author_id); ?>" rel="nofollow" class="googleplus"><i class="fa fa-google-plus"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "linkedin", $author_id ) ) : ?>
    <a href="<?php the_author_meta("linkedin", $author_id); ?>" rel="nofollow" class="linkedin"><i class="fa fa-linkedin"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "pinterest", $author_id ) ) : ?>
    <a href="<?php the_author_meta("pinterest", $author_id); ?>" rel="nofollow" class="pinterest"><i class="fa fa-pinterest"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "behance", $author_id ) ) : ?>
    <a href="<?php the_author_meta("behance", $author_id); ?>" rel="nofollow" class="behance"><i class="fa fa-behance"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "github", $author_id ) ) : ?>
    <a href="<?php the_author_meta("github", $author_id); ?>" rel="nofollow" class="github"><i class="fa fa-github"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "flickr", $author_id ) ) : ?>
    <a href="<?php the_author_meta("flickr", $author_id); ?>" rel="nofollow" class="flickr"><i class="fa fa-flickr"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "tumblr", $author_id ) ) : ?>
    <a href="<?php the_author_meta("tumblr", $author_id); ?>" rel="nofollow" class="tumblr"><i class="fa fa-tumblr"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "dribbble", $author_id ) ) : ?>
    <a href="<?php the_author_meta("dribbble", $author_id); ?>" rel="nofollow" class="dribbble"><i class="fa fa-dribbble"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "soundcloud", $author_id ) ) : ?>
    <a href="<?php the_author_meta("soundcloud", $author_id); ?>" rel="nofollow" class="soundcloud"><i class="fa fa-soundcloud"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "instagram", $author_id ) ) : ?>
    <a href="<?php the_author_meta("instagram", $author_id); ?>" rel="nofollow" class="instagram"><i class="fa fa-instagram"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "vimeo", $author_id ) ) : ?>
    <a href="<?php the_author_meta("vimeo", $author_id); ?>" rel="nofollow" class="vimeo"><i class="fa fa-vimeo"></i> </a>
<?php endif; ?>

<?php if( get_the_author_meta( "youtube", $author_id ) ) : ?>
    <a href="<?php the_author_meta("youtube", $author_id); ?>" rel="nofollow" class="youtube"><i class="fa fa-youtube-play"></i></a>
<?php endif; ?>

<?php if( get_the_author_meta( "vk", $author_id ) ) : ?>
    <a href="<?php the_author_meta("vk", $author_id); ?>" rel="nofollow" class="vk"><i class="fa fa-vk"></i></a>
<?php endif; ?>

<?php if( get_the_author_meta( "reddit", $author_id ) ) : ?>
    <a href="<?php the_author_meta("reddit", $author_id); ?>" rel="nofollow" class="reddit"><i class="fa fa-reddit"></i></a>
<?php endif; ?>

<?php if( get_the_author_meta( "weibo", $author_id ) ) : ?>
    <a href="<?php the_author_meta("weibo", $author_id); ?>" rel="nofollow" class="weibo"><i class="fa fa-weibo"></i></a>
<?php endif; ?>

<?php if( get_the_author_meta( "rss", $author_id ) ) : ?>
    <a href="<?php the_author_meta("rss", $author_id); ?>" rel="nofollow" class="rss"><i class="fa fa-rss"></i></a>
<?php endif; ?>