<form id="pico-container" action="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=pico-plugin" method="post">
    <!--Connect form -->
	<div class="form pico">
		<div class="header-form"><img src="<?php echo plugin_dir_url( __DIR__ ) . 'img/wordmark.svg'?>" alt="Pico"></div>
		<div class="description-form">
			<p><b>Connect your Pico Publisher account.</b><br>Your Publisher ID and API Key can be found under the Integrations tab of your <a href="https://publisher.pico.tools/settings/integrations" target="blank">Pico Publisher Settings</a>.</p>
		</div>
		<p class="login-label">Publisher ID</p>
		<div class="input-wrapper">
            <?php $publisher_creds = Pico_Setup::get_publisher_id(true); ?>
			<input type="text" id="publisher_id" name="publisher_id" value="<?php echo $publisher_creds['publisher_id']?>" disabled>
			<img src="<?php echo plugin_dir_url( __DIR__ ) . 'img/ic_selected.svg'?>" class="input-img">
		</div>
		<p class="login-label">API Key</p>
		<div class="input-wrapper">
			<input type="password" id="api_key" name="api_key" value="<?php echo $publisher_creds['api_key']?>" disabled>
			<img src="<?php echo plugin_dir_url( __DIR__ ) . 'img/ic_selected.svg'?>" class="input-img">
		</div>
		<?php $health_status = Pico_Menu::health_check(); ?>
		<?php echo $health_status; ?>
		<input type="hidden" name="action" value="disconnect-pp">
		<input type="button" class="pico-button pico-button-danger open-modal" value="Disconnect">
		<!-- <button>Connect</button> -->
		<div style="clear: both"></div>
	</div>

    <!--Leaky paywall notice -->
	<?php if(class_exists( 'Leaky_Paywall' )){ ?>
		<div class="leaky-form">
			<img src="<?php echo plugin_dir_url( __DIR__ ) . 'img/ic_alert.svg'?>" class="alert-img">
			<b>Leaky Paywall Detected</b>
			<div>
				<p>Since you’re currently using Leaky Paywall to manage subscriptions, Pico will be applied only to your non-subscriber audience. To which percentage of your non-subscribers would you like to present Pico?</p>
				<select id="leaky_paywall_option">
					<?php foreach(range(0, 10) as $i){?>
						<option <?php if(intval(get_option('leaky_paywall_percentage'), 10) == $i*10) echo "selected" ?> value="<?php echo $i*10 ?>"><?php echo $i*10 ?>% of non-subscribers<?php if($i == 0) echo " [DISABLED]" ?></option>
					<?php } ?>
				</select>
				<small id="leaky-paywall-update-status"></small>
				<div id="leaky-paywall-select-description">
					<small>Your other non-subscribers will continue to experience your site based on rules set forth through Leaky Paywall.</small>
				</div>
			</div>
		</div>
	<?php }?>
    <!--Publisher app link -->
	<div class="footer-form">
		<div class="f-left"><p>Manage content access and user engagement campaigns at <a href="https://publisher.pico.tools" target="blank">publisher.pico.tools</a>.</p></div>
		<div class="f-right"><a href="https://publisher.pico.tools" target="blank"><img src="<?php echo plugin_dir_url( __DIR__ ) . 'img/ic_launch.svg'?>" alt="Launch Pico"></a></div>
	</div>
    <!--Confirm disconnect -->
	<div id="modal-container" class="modal-disconnect">
	  <div class="modal" id="alert">
		<div class="header">
			<div class="close-alert"><img src="<?php echo plugin_dir_url( __DIR__ ) . 'img/ic_close.svg'?>" alt="Close"></div>
			<div class="alert-title"><b>Disconnect Pico?</b></div>
		</div>
		<div class="message">
		    Content access, registration, and revenue settings for this site will be suspended effective immediately.
		</div>
		<div class="footer">
			<input type="submit" name="submit" id="submit" class="pico-button pico-button-danger close-modal" value="Disconnect">
			<input type="button" name="cancel" id="cancel" class="pico-button pico-button-neutral close-modal" value="Cancel">
		</div>
	  </div>
	</div>
</form>
