<div id="pico-container">
    <div class="form pico">
    	<div class="header-form"><img src="<?php echo plugin_dir_url( __DIR__ ) . 'img/wordmark.svg'?>" alt="Pico"></div>
    	<div class="description-form">
    		<p><span><b>Connect your Pico Publisher account.</b></span><br>Your Publisher ID and API Key can be found under the Integrations tab of your <a href="https://publisher.pico.tools/settings/integrations" target="blank">Pico Publisher Settings</a>.</p>
    	</div>
    	<form class="login-form" action="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=pico-plugin" method="post" autocomplete="off">
    		<p class="login-label">Publisher ID</p>
    		<input type="text" id="publisher_id" name="publisher_id">
    		<p class="login-label">API Key</p>
    		<input type="text" id="api_key" name="api_key">
    		<input type="hidden" name="action" value="enter-key">
    		<input type="submit" name="submit" id="submit" class="pico-button pico-button-primary" value="Connect">
    		<!-- <button>Connect</button> -->
    		<div style="clear: both"></div>
    	</form>
    </div>
    <div class="footer-form">
    	<div class="f-left"><p>Manage content access and user engagement campaigns at <a href="https://publisher.pico.tools" target="blank">publisher.pico.tools</a>.</p></div>
    	<div class="f-right"><a href="https://publisher.pico.tools" target="blank"><img src="<?php echo plugin_dir_url( __DIR__ ) . 'img/ic_launch.svg'?>" alt="Launch Pico"></a></div>
    </div>
</div>
