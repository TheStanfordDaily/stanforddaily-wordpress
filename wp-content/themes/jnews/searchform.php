<form action="<?php echo esc_url( apply_filters( 'jnews_get_permalink', home_url('/') ) ); ?>" method="get" class="jeg_search_form" target="_top">
    <input name="s" class="jeg_search_input" placeholder="<?php jnews_print_translation('Search...', 'jnews', 'search_form') ?>" type="text" value="<?php echo esc_html(get_search_query()) ?>" autocomplete="off">
    <button type="submit" class="jeg_search_button btn"><i class="fa fa-search"></i></button>
</form>
<?php get_template_part('fragment/header/search-result'); ?>