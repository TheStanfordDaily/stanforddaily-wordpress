<?php $errors = $this->errors ?>
<div class="wrap" id="support-wrap">
	<h2><?php _e($this->options['name'] . ' diagnostics & support', $this->options['namespace'])?></h2>

	<p>
		<?php _e('You can send a support request from this screen directly. It is the best way to ask for support,
		because along with your description, an additional system information will be sent making it easier to help you.
		Support requests are usually answered within a day, with infrequent delays up to a couple of days
		 when I am away or busy with developing new cool stuff.', $this->options['namespace']) ?>
	</p>
	<form action="<?php echo admin_url(add_query_arg('page', 'support', $this->options['menu_slug'])) ?>" method="post" id="support-form">
		<?php wp_nonce_field('support-submit') ?>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label><?php _e('Your email', $this->options['namespace'])?></label>
					</th>
					<td>
						<?php if (isset($errors['email'])): ?>
							<div class="error"><?php echo esc_html($errors['email']) ?></div>
						<?php endif ?>
						<input type="text" name="email" value="<?php echo esc_attr($data['email'])?>" />
						<p class="description"><?php _e("An answer will be sent to this email, so please enter a real one.", $this->options['namespace'])?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e('Item Purchase Code', $this->options['namespace'])?></label>
					</th>
					<td>
						<?php if (isset($errors['purchase_code'])): ?>
							<div class="error"><?php echo ($errors['purchase_code']) ?></div>
						<?php endif ?>
						<input type="text" name="purchase_code" value="<?php echo esc_attr($data['purchase_code'])?>" />
						<p class="description"><?php _e("CodeCanyon product purchase code available at the <a target=\"_blank\" href=\"http://codecanyon.net/downloads\">Downloads Page</a> after clicking \"Download\" button and choosing \"License certificate and purchase code\".", $this->options['namespace'])?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label><?php _e('Your question', $this->options['namespace'])?></label></th>
					<td>
						<?php if (isset($errors['question'])): ?>
							<div class="error"><?php echo esc_html($errors['question']) ?></div>
						<?php endif ?>
						<textarea name="question" placeholder="<?php _e('Your question here. Including specific steps to reproduce the issue usually helps to resolve the question much faster.', $this->options['namespace']) ?>"><?php echo esc_textarea($data['question'])?></textarea>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label><?php _e('Gallery URL', $this->options['namespace'])?></label>
					</th>
					<td>
						<?php if (isset($errors['url'])): ?>
							<div class="error"><?php echo esc_html($errors['url']) ?></div>
						<?php endif ?>
						<input type="text" name="url" value="<?php echo esc_attr($data['url'])?>" />
						<p class="description"><?php _e("Your gallery URL", $this->options['namespace'])?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label><?php _e('Provide an admin access', $this->options['namespace'])?></label></th>
					<td>
						<label><input type="checkbox" value="1" name="admin" <?php checked($data['admin']) ?>> <?php _e('Create a temporary admin account',$this->options['namespace'])?></label>
						<p class="description">
							<?php _e('Provide me an admin access to your site. It allows me to help you on the fly without asking too many questions about details and is used really carefully. I respect my clients and their privacy - it is the only way of building a good long term business. A new admin account will be created, and the password used for this account will be strong and unique for your site.', $this->options['namespace'])?>
						</p>
					</td>
				<tr>
					<td colspan="2"><?php submit_button(__('Submit the request', $this->options['namespace']))?></td>
				</tr>
			</tbody>

		</table>
	</form>
	<div id="support-diagnostics">
		<h3><?php _e('This data will be sent along with your support request', $this->options['namespace'])?></h3>
		<table class="widefat" cellspacing="0" id="diagnostics">
			<thead>
				<tr><th colspan="2"><?php _e( 'Environment', $this->options['namespace'] ); ?></th></tr>
			</thead>
			<tbody>
				<?php foreach($this->env->get_diagnostic_data() as $item): ?>
					<tr>
						<td><?php _e( $item['name'],$this->options['namespace'] ); ?>:</td>
						<td>
							<?php if (isset($item['status'])): ?>
								<?php if ($item['status']): ?>
									<?php $this->status('ok') ?>
								<?php else: ?>
									<?php if (isset($item['warning'])): ?>
										<?php $this->status('warning') ?>
									<?php else: ?>
										<?php $this->status('error') ?>
									<?php endif ?>
									<?php echo $item['error'] ?>
								<?php endif ?>
								<?php endif ?>
							<?php if (isset($item['text'])) echo $item['text'] ?>

						</td>
					</tr>
				<?php endforeach ?>

			</tbody>

			<thead>
				<tr>
					<th colspan="2"><?php _e( 'Plugins', $this->options['namespace'] ); ?></th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($this->env->get_active_plugins() as $plugin) :?>
				<tr>
					<td><?php echo esc_html($plugin['Name']) ?> by <a href="<?php esc_attr($plugin['AuthorURI']) ?>"><?php esc_html($plugin['Author'])?></a></td>
					<td><?php ?>v.<?php echo $plugin['Version']?></td>
				</tr>
				<?php endforeach ?>
			</tbody>

			<thead>
				<tr><th colspan="2"><?php _e( 'Theme', $this->options['namespace'] ); ?></th></tr>
			</thead>

			<tbody>
				<?php foreach (array('Name', 'Version', 'Author URI') as $option): ?>
				<tr>
					<td><?php _e( 'Theme ' . $option, $this->options['namespace'] ); ?>:</td>
					<td><?php echo esc_html($this->env->get_active_theme_data($option)) ?></td>
				</tr>
				<?php endforeach ?>
				<tr>
			</tbody>
		</table>
	</div>

</div>

