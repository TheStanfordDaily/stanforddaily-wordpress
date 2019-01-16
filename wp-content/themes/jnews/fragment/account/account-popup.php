<!-- Login Popup Content -->
<div id="jeg_loginform" class="jeg_popup mfp-with-anim mfp-hide">
    <div class="jeg_popupform">
        <form action="#" method="post" accept-charset="utf-8">
            <p><?php jnews_print_translation('Login to your account below', 'jnews', 'login_to_account'); ?></p>

            <!-- Form Messages -->
            <div class="form-message"></div>

            <p class="input_field">
                <input type="text" name="username" placeholder="<?php jnews_print_translation('Username', 'jnews', 'username'); ?>" value="">
            </p>
            <p class="input_field">
                <input type="password" name="password" placeholder="<?php jnews_print_translation('Password', 'jnews', 'password'); ?>" value="">
            </p>
            <p class="submit">
                <input type="hidden" name="action" value="login_handler">
                <input type="hidden" name="jnews_nonce" value="<?php echo esc_attr( wp_create_nonce('jnews_nonce') ) ?>">
                <input type="submit" name="jeg_login_button" class="button" value="<?php jnews_print_translation('Log In', 'jnews', 'log_in'); ?>" data-process="<?php jnews_print_translation('Processing . . .', 'jnews', 'processing'); ?>" data-string="<?php jnews_print_translation('Log In', 'jnews', 'log_in'); ?>">
            </p>
            <div class="bottom_links clearfix">
                <a href="#jeg_forgotform" class="jeg_popuplink forgot"><?php jnews_print_translation('Forgotten Password?', 'jnews', 'forgotten_password'); ?></a>
                <?php if(get_option( 'users_can_register' )) : ?>
                <a href="#jeg_registerform" class="jeg_popuplink"><i class="fa fa-user"></i> <?php jnews_print_translation('Sign Up', 'jnews', 'sign_up'); ?></a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<!-- Register Popup Content -->
<div id="jeg_registerform" class="jeg_popup mfp-with-anim mfp-hide">
    <div class="jeg_popupform">
        <form action="#" method="post" accept-charset="utf-8">
            <p><?php jnews_print_translation('Fill the forms bellow to register', 'jnews', 'fill_form_to_register'); ?></p>

            <!-- Form Messages -->
            <div class="form-message"></div>

            <p class="input_field">
                <input type="text" name="email" placeholder="<?php jnews_print_translation('Your email', 'jnews', 'your_email'); ?>" value="">
            </p>
            <p class="input_field">
                <input type="text" name="username" placeholder="<?php jnews_print_translation('Username', 'jnews', 'username'); ?>" value="">
            </p>
            <p class="submit">
                <input type="hidden" name="action" value="register_handler">
                <input type="hidden" name="jnews_nonce" value="">
                <input type="submit" name="jeg_login_button" class="button" value="<?php jnews_print_translation('Sign Up', 'jnews', 'sign_up'); ?>" data-process="<?php jnews_print_translation('Processing . . .', 'jnews', 'processing'); ?>" data-string="<?php jnews_print_translation('Sign Up', 'jnews', 'sign_up'); ?>">
            </p>
            <?php if ( get_theme_mod('jnews_gdpr_register_enable', false) ) : ?>
                <div class="register_privacy_policy">
                    <?php echo get_theme_mod('jnews_gdpr_register_text', __('<span class="required">*</span>By registering into our website, you agree to the Terms &amp; Conditions and <a href="#">Privacy Policy</a>.', 'jnews')); ?>
                </div>
            <?php endif ?>
            <div class="bottom_links clearfix">
                <span><?php jnews_print_translation('All fields are required.', 'jnews', 'all_field_required'); ?></span>
                <a href="#jeg_loginform" class="jeg_popuplink"><i class="fa fa-lock"></i> <?php jnews_print_translation('Log In', 'jnews', 'log_in'); ?></a>
            </div>
        </form>
    </div>
</div>


<!-- Register Popup Content -->
<div id="jeg_forgotform" class="jeg_popup mfp-with-anim mfp-hide">
    <div class="jeg_popupform">
        <form action="#" method="post" accept-charset="utf-8">
            <h3><?php jnews_print_translation('Retrieve your password', 'jnews', 'retrieve_password'); ?></h3>
            <p><?php jnews_print_translation('Please enter your username or email address to reset your password.', 'jnews', 'enter_detail_reset_password'); ?></p>

            <!-- Form Messages -->
            <div class="form-message"></div>

            <p class="input_field">
                <input type="text" name="user_login" placeholder="<?php jnews_print_translation('Your email or username', 'jnews', 'your_email_or_username'); ?>" value="">
            </p>
            <p class="submit">
                <input type="hidden" name="action" value="forget_password_handler">
                <input type="hidden" name="jnews_nonce" value="">
                <input type="submit" name="jeg_login_button" class="button" value="<?php jnews_print_translation('Reset Password', 'jnews', 'reset_password'); ?>" data-process="<?php jnews_print_translation('Processing . . .', 'jnews', 'processing'); ?>" data-string="<?php jnews_print_translation('Reset Password', 'jnews', 'reset_password'); ?>">
            </p>
            <div class="bottom_links clearfix">
                <a href="#jeg_loginform" class="jeg_popuplink"><i class="fa fa-lock"></i> <?php jnews_print_translation('Log In', 'jnews', 'log_in'); ?></a>
            </div>
        </form>
    </div>
</div>