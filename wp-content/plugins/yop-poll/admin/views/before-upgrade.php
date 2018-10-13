<div class="bootstrap-yop wrap">
<form action="" method="post" class="set-upgrade-to-pro-width2">
    <?php _e( 'If you already have a license, please enter it below to activate YOP Poll Pro:', 'yop-poll' ); ?><br><br>
    <input type = "hidden" name = "action" value = "validate_licence">
    <?php wp_nonce_field('yop-poll-before-buy'); ?>
    <input type="text" name="licence">
    <input type = "submit" nameadd_poll = "check_licence" class = "button-primary" value = '<?php echo _e( 'Activate', 'yop-poll' ); ?>'>
</form>
<br>
    <div align="center">
        <div class="flexslider" style="margin-bottom:30px; border: 0px;">
            <ul class="slides">
                <li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image1.jpg"; ?>" alt="Image 1"></li>
                <li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image2.jpg"; ?>" alt="Image 2"></li>
                <li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image3.jpg"; ?>" alt="Image 3"></li>
                <li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image4.jpg"; ?>" alt="Image 4"></li>
                <li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image6.jpg"; ?>" alt="Image 5"></li>
                <li><img src="<?php echo YOP_POLL_URL . "admin/assets/images/slider/image7.jpg"; ?>" alt="Image 6"></li>
            </ul>
        </div>
    </div>
    <br>
    <form style="text-align: center" action="" method="post">
        <p style="text-align:center; font-weight: bold; font-size: 16px">
            <?php wp_nonce_field('yop-poll-before-buy' ); ?>
            <input type="hidden" name="action" value="do-buy">
            <input type="hidden" name="upgrade" value="yes">
			<button class="btn btn-primary btn-lg" type="submit">
				Upgrade to Pro for <u>Only</u> $17
			</button>
			<br>
			60 days money back guarantee
        </p>
    </form>
</div>
<section>
    <div class="yop_testimonials_pro1">
        <p class="yop_testimonials_header">
            Top class software and support
        </p>
        <p class="yop_testimonials_content">
           I love this software and the support service.
            <br>
            This is definitely the #1 poll plugin for WP. I give this software and its support service a A++++.
            <br><br>
            I'm so glad to be a Pro version user. The US$17 upgrade worth every cent...
            <br><br>
            I originally had some difficulties with the tool, and I reported them. (This is normal for all software.)
            After I reported my issues, the support got in touch with me very quickly and have the problem resolved.
            Also, they listened to my suggestions and worked with me to have things implemented and resolved.
            This is definitely a TOP CLASS service.
        </p>
        <p class="yop_testimonials_client">
        edwintam, wordpress user
        </p>
        <p></p> </div>
    <div class="yop_testimonials_pro2">
        <p class="yop_testimonials_header">
        	Great support for a very useful product
        </p>
        <p class="yop_testimonials_content">
			I used yop poll standard and tried upgrading.
			I ran into an issue and send support an email.
			I got the best suppor timaginable.
			They immediately (within the hour) started working on the issue, solved it and solved a
			bunch of other stuff in the running.
            <br><br>
            Superb Support, absolutely worth paying for!
        </p>
        <p class="yop_testimonials_client">
        fredverhoeven, wordpress user
        </p>
    </div> <br>
</section>
<script>
    jQuery( document ).ready( function ( $ ) {
        jQuery( '.flexslider' ).flexslider( {
            startAt: 0,
            slideshow: true,
            slideshowSpeed: 5000
        });
        jQuery( '.flexslider' ).data( 'flexslider' ).flexAnimate( 0, false );
        jQuery( '.flex-prev' ).css( 'opacity', '0.7' );
        jQuery( '.flex-next' ).css( 'opacity' , '0.7' );
    } );
</script>
