<?php 
	get_header();
    $user_id  = get_current_user_id();
    $account  = JNews\AccountPage::getInstance();
    $endpoint = $account->get_endpoint();
?>

<div class="jeg_main jeg_account_page">
    <div class="jeg_container">
        <div class="jeg_content">
            <div class="jeg_section">
                <div class="container">
                    <div class="jeg_cat_content row">
                        <div class="col-md-3 jeg_sticky_sidebar">
                            <div class="jeg_account_left">
                                <?php echo get_avatar( get_current_user_id(), '128', '', get_the_author_meta('display_name'), array( 'class' => 'img-rounded' ) ); ?>
                                <div class="jeg_author_content">
                                    <h3 class="jeg_author_name">
                                        <?php echo jeg_get_author_name( $user_id ); ?>
                                    </h3>
                                </div>
                                <div class="jeg_account_nav">
                                    <ul>
                                        <?php foreach ( array_slice( $endpoint, 1 ) as $item ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( home_url( '/' . $endpoint['account']['slug'] . '/' . $item['slug'] ) ); ?>"><?php jnews_print_translation( $item['title'], 'jnews', $item['label'] ); ?></a>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                                <?php do_action( 'jnews_after_account_nav' ); ?>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="jeg_account_right">
                                <h1 class="jeg_account_title"><?php do_action( 'jnews_account_right_title' ); ?></h1>
                                <?php do_action( 'jnews_account_right_content' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php do_action( 'jnews_after_main' ); ?>
    </div>
</div>

<?php get_footer(); ?>