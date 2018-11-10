<?php

/*************************************/
/*                                   */
/*       GLOBAL NOTICES              */
/*       Only to be used             */
/*       for general messages        */
/*                                   */
/*************************************/

/**
* Show Notice on Updates/Install
**/
function soundcloud_is_gold_update_admin_notice__info() {
    $r = '<div class="notice notice-info is-dismissible">';
    $r .= '<p>Hello new plugin and new features! <a href=""> Check it out</a></p>';
    $r .= '</div>';
    echo $r;
}

function check_for_announcements(){
  $announcement = 'hello world';
  return $announcement;
}
/**
* Show success
**/
function sample_admin_notice__success() {
    $r = '<div class="notice notice-success is-dismissible">';
    $r .= '<p>Done!</p>';
    $r .= '</div>';
    echo $r;
}
//add_action( 'admin_notices', 'sample_admin_notice__success' );

/**
* Show Info
**/
//add_action( 'admin_notices', 'sample_admin_notice__info', 10, 1);
function sample_admin_notice__info($content) {
    $r = '<div class="notice notice-info is-dismissible">';
    $r .= '<p>'.$content.'</p>';
    $r .= '</div>';
    echo $r;
}

$announcement = check_for_announcements();
if($announcement) {
  //do_action('admin_notices', $announcement);
}


/**
* Show Error
**/
function sample_admin_notice__error() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Invalid username, check out <a href="./admin.php?page=soundcloud-is-gold%2Fsoundcloud-is-gold.php">Soundcloud is gold</a>', 'sample-text-domain' ); ?></p>
    </div>
    <?php
}
//add_action( 'admin_notices', 'sample_admin_notice__error' );

/**
* Show Warning
**/
function sample_admin_notice__warning() {
    ?>
    <div class="notice notice-warming is-dismissible">
        <p><?php _e( 'Are you still using the plugin? Yes? You haven\'t donated <a href="./admin.php?page=soundcloud-is-gold%2Fsoundcloud-is-gold.php">Soundcloud is gold</a>', 'sample-text-domain' ); ?></p>
    </div>
    <?php
}
//add_action( 'admin_notices', 'sample_admin_notice__warning' );

?>
