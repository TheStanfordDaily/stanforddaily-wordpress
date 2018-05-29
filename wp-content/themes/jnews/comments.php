<?php

if ( post_password_required() )
    return;

$comment_load = get_theme_mod('jnews_comment_load', 'normal');
$comment_type = apply_filters('jeg_comment_type', get_theme_mod('jnews_comment_type', 'wordpress'));
$is_normal_load = true;

if($comment_type === 'wordpress')
{
    $is_normal_load = true;
} else {
    $is_normal_load = ( $comment_load === 'normal' );
}

if($is_normal_load)
{
    get_template_part('fragment/comments');
} else {
    get_template_part('fragment/comments', 'button');
}