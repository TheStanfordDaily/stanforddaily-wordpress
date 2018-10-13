<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel-group" id="poll-style-accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default poll-style-settings">
				<div class="panel-heading" role="tab" id="style-poll-container-header">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#poll-style-accordion" href="#style-poll-container-content" aria-expanded="true" aria-controls="style-poll-container-content">
							Poll Container
						</a>
					</h4>
				</div>
				<div id="style-poll-container-content" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="style-poll-container-header">
					<div class="panel-body">
						<div class="form-horizontal">
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Background color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="poll[background-color]" value="<?php echo esc_html( $poll->meta_data['style']['poll']['backgroundColor'] );?>" class="form-control poll-background-color" style="width:100%"/>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Thickness', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" name="poll[border-size]" value="<?php echo esc_html( $poll->meta_data['style']['poll']['borderSize'] );?>" class="form-control poll-border-size" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="poll[border-color]" value="<?php echo esc_html( $poll->meta_data['style']['poll']['borderColor'] );?>" class="form-control poll-border-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Radius', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
						                <input type="text" name="poll[border-radius]" value="<?php echo esc_html( $poll->meta_data['style']['poll']['borderRadius'] );?>" class="form-control poll-border-radius" />
						                <span class="input-group-addon">px</span>
						            </div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Padding', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" name="poll[padding]" value="<?php echo esc_html( $poll->meta_data['style']['poll']['padding'] );?>" class="form-control poll-padding" />
										<span class="input-group-addon">px</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="poll[text-color]" value="<?php echo esc_html( $poll->meta_data['style']['poll']['textColor'] );?>" class="form-control poll-text-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Input elements borders color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="poll[input-elements-border-color]" value="<?php echo esc_html( $poll->meta_data['style']['poll']['inputElementsBorderColor'] );?>" class="form-control poll-input-elements-border-color" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default questions-style-settings">
				<div class="panel-heading" role="tab" id="style-questions-container-header">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#poll-style-accordion" href="#style-questions-container-content" aria-expanded="true" aria-controls="style-questions-container-content">
							Questions
						</a>
					</h4>
				</div>
				<div id="style-questions-container-content" class="panel-collapse collapse" role="tabpanel" aria-labelledby="style-questions-container-header">
					<div class="panel-body">
						<div class="form-horizontal">
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Background color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="question[background-color]" value="<?php echo esc_html( $poll->meta_data['style']['questions']['backgroundColor'] );?>" class="form-control question-background-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Thickness', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" name="poll[border-size]" value="<?php echo esc_html( $poll->meta_data['style']['questions']['borderSize'] );?>" class="form-control question-border-size" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="question[border-color]" value="<?php echo esc_html( $poll->meta_data['style']['questions']['borderColor'] );?>" class="form-control question-border-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Radius', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" name="question[radius]" value="<?php echo esc_html( $poll->meta_data['style']['questions']['borderRadius'] );?>" class="form-control question-border-radius" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Padding', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" name="question[padding]" value="<?php echo esc_html( $poll->meta_data['style']['questions']['padding'] );?>" class="form-control question-padding" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="question[text-color]" value="<?php echo esc_html( $poll->meta_data['style']['questions']['textColor'] );?>" class="form-control question-text-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text size', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<?php
						            switch ( $poll->meta_data['style']['questions']['textSize'] ) {
						                case 'small': {
						                    $questions_text_small = 'selected';
						                    $questions_text_medium = '';
						                    $questions_text_large = '';
						                    break;
						                }
						                case 'medium': {
						                    $questions_text_small = '';
						                    $questions_text_medium = 'selected';
						                    $questions_text_large = '';
						                    break;
						                }
						                case 'large': {
						                    $questions_text_small = '';
						                    $questions_text_medium = '';
						                    $questions_text_large = 'selected';
						                    break;
						                }
						                default: {
						                    $questions_text_small = '';
						                    $questions_text_medium = '';
						                    $questions_text_large = '';
						                    break;
						                }
						            }
						            ?>
									<select  name="question[text-size]"class="question-text-size" style="width:100%">
						                <option value="small" <?php echo $questions_text_small;?>><?php _e( 'Small', 'yop-poll' );?></option>
						                <option value="medium" <?php echo $questions_text_medium;?>><?php _e( 'Medium', 'yop-poll' );?></option>
						                <option value="large" <?php echo $questions_text_large;?>><?php _e( 'Large', 'yop-poll' );?></option>
						            </select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default answers-style-settings">
				<div class="panel-heading" role="tab" id="style-answers-container-header">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#poll-style-accordion" href="#style-answers-container-content" aria-expanded="true" aria-controls="style-answers-container-content">
							Answers
						</a>
					</h4>
				</div>
				<div id="style-answers-container-content" class="panel-collapse collapse" role="tabpanel" aria-labelledby="style-answers-container-header">
					<div class="panel-body">
						<div class="form-horizontal">
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<a href="#" class="upgrade-to-pro" data-screen="templates">
										<img src="<?php echo YOP_POLL_URL;?>admin/assets/images/pro-horizontal.svg" class="responsive" />
									</a>
									<?php _e( 'Skin', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<?php
									$answers_skin_minimal = '';
									$answers_skin_square = '';
									$answers_skin_flat = '';
						            switch ( $poll->meta_data['style']['answers']['skin'] ) {
										case 'minimal': {
											$answers_skin_minimal = 'selected';
											break;
										}
										case 'square': {
											$answers_skin_square = 'selected';
											break;
										}
										case 'flat': {
											$answers_skin_flat = 'selected';
											break;
										}
									}
									?>
									<select class="answers-skin" style="width:100%">
						                <option value="minimal" <?php echo $answers_skin_minimal;?>><?php _e( 'Minimal', 'yop-poll' );?></option>
						                <option value="square"<?php echo $answers_skin_square;?>><?php _e( 'Square', 'yop-poll' );?></option>
						                <option value="flat"<?php echo $answers_skin_flat;?>><?php _e( 'Flat', 'yop-poll' );?></option>
						            </select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<a href="#" class="upgrade-to-pro" data-screen="templates">
										<img src="<?php echo YOP_POLL_URL;?>admin/assets/images/pro-horizontal.svg" class="responsive" />
									</a>
									<?php _e( 'Color Scheme', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<?php
									$color_scheme_black = '';
									$color_scheme_red = '';
									$color_scheme_green = '';
									$color_scheme_blue = '';
									$color_scheme_aero = '';
									$color_scheme_grey = '';
									$color_scheme_orange = '';
									$color_scheme_yellow = '';
									$color_scheme_pink = '';
									$color_scheme_purple = '';
						            switch ( $poll->meta_data['style']['answers']['colorScheme'] ) {
										case 'black': {
											$color_scheme_black = 'active';
											break;
										}
										case 'red': {
											$color_scheme_red = 'active';
											break;
										}
										case 'green': {
											$color_scheme_green = 'active';
											break;
										}
										case 'blue': {
											$color_scheme_blue = 'active';
											break;
										}
										case 'aero': {
											$color_scheme_aero = 'active';
											break;
										}
										case 'grey': {
											$color_scheme_grey = 'active';
											break;
										}
										case 'orange': {
											$color_scheme_orange = 'active';
											break;
										}
										case 'yellow': {
											$color_scheme_yellow = 'active';
											break;
										}
										case 'pink': {
											$color_scheme_pink = 'active';
											break;
										}
										case 'purple': {
											$color_scheme_purple = 'active';
											break;
										}
										default: {
											$color_scheme_black = 'active';
											break;
										}
									}
									?>
									<ul class="color-scheme">
						                <li class="<?php echo $color_scheme_black;?>" title="Black" data-id="black"></li>
						                <li class="red <?php echo $color_scheme_red;?>" title="Red" data-id="red"></li>
						                <li class="green <?php echo $color_scheme_green;?>" title="Green" data-id="green"></li>
						                <li class="blue <?php echo $color_scheme_blue;?>" title="Blue" data-id="blue"></li>
						                <li class="aero <?php echo $color_scheme_aero;?>" title="Aero" data-id="aero"></li>
						                <li class="grey <?php echo $color_scheme_grey;?>" title="Grey" data-id="grey"></li>
						                <li class="orange<?php echo $color_scheme_orange;?>" title="Orange" data-id="orange"></li>
						                <li class="yellow<?php echo $color_scheme_yellow;?>" title="Yellow" data-id="yellow"></li>
						                <li class="pink<?php echo $color_scheme_pink;?>" title="Pink" data-id="pink"></li>
						                <li class="purple<?php echo $color_scheme_purple;?>" title="Purple" data-id="purple"></li>
					                </ul>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Background color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['answers']['backgroundColor'] );?>" class="form-control answers-background-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Thickness', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['answers']['borderSize'] );?>" class="form-control answers-border-size" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['answers']['borderColor'] );?>" class="form-control answers-border-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Radius', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['answers']['borderRadius'] );?>" class="form-control answers-border-radius" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Padding', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['answers']['padding'] );?>" class="form-control answers-padding" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['answers']['textColor'] );?>" class="form-control answers-text-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text size', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<?php
						            switch ( $poll->meta_data['style']['answers']['textSize'] ) {
						                case 'small': {
						                    $answers_text_small = 'selected';
						                    $answers_text_medium = '';
						                    $answers_text_large = '';
						                    break;
						                }
						                case 'medium': {
						                    $answers_text_small = '';
						                    $answers_text_medium = 'selected';
						                    $answers_text_large = '';
						                    break;
						                }
						                case 'large': {
						                    $answers_text_small = '';
						                    $answers_text_medium = '';
						                    $answers_text_large = 'selected';
						                    break;
						                }
						                default: {
						                    $answers_text_small = '';
						                    $answers_text_medium = '';
						                    $answers_text_large = '';
						                    break;
						                }
						            }
						            ?>
									<select class="answers-text-size" style="width:100%">
						                <option value="small" <?php echo $answers_text_small;?>><?php _e( 'Small', 'yop-poll' );?></option>
						                <option value="medium" <?php echo $answers_text_medium;?>><?php _e( 'Medium', 'yop-poll' );?></option>
						                <option value="large" <?php echo $answers_text_large;?>><?php _e( 'Large', 'yop-poll' );?></option>
						            </select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default buttons-style-settings">
				<div class="panel-heading" role="tab" id="style-buttons-container-header">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#poll-style-accordion" href="#style-buttons-container-content" aria-expanded="true" aria-controls="style-buttons-container-content">
							Buttons
						</a>
					</h4>
				</div>
				<div id="style-buttons-container-content" class="panel-collapse collapse" role="tabpanel" aria-labelledby="style-buttons-container-header">
					<div class="panel-body">
						<div class="form-horizontal">
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Background color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['buttons']['backgroundColor'] );?>" class="form-control buttons-background-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Thickness', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['buttons']['borderSize'] );?>" class="form-control buttons-border-size" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['buttons']['borderColor'] );?>" class="form-control buttons-border-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Radius', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['buttons']['borderRadius'] );?>" class="form-control buttons-border-radius" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Padding', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['buttons']['padding'] );?>" class="form-control buttons-padding" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['buttons']['textColor'] );?>" class="form-control buttons-text-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text size', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<?php
						            switch ( $poll->meta_data['style']['buttons']['textSize'] ) {
						                case 'small': {
						                    $buttons_text_small = 'selected';
						                    $buttons_text_medium = '';
						                    $buttons_text_large = '';
						                    break;
						                }
						                case 'medium': {
						                    $buttons_text_small = '';
						                    $buttons_text_medium = 'selected';
						                    $buttons_text_large = '';
						                    break;
						                }
						                case 'large': {
						                    $buttons_text_small = '';
						                    $buttons_text_medium = '';
						                    $buttons_text_large = 'selected';
						                    break;
						                }
						                default: {
						                    $buttons_text_small = '';
						                    $buttons_text_medium = '';
						                    $buttons_text_large = '';
						                    break;
						                }
						            }
						            ?>
						            <select class="buttons-text-size" style="width:100%">
						                <option value="small" <?php echo $buttons_text_small;?>><?php _e( 'Small', 'yop-poll' );?></option>
						                <option value="medium" <?php echo $buttons_text_medium;?>><?php _e( 'Medium', 'yop-poll' );?></option>
						                <option value="large" <?php echo $buttons_text_large;?>><?php _e( 'Large', 'yop-poll' );?></option>
						            </select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default errors-style-settings">
				<div class="panel-heading" role="tab" id="style-errors-container-header">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#poll-style-accordion" href="#style-errors-container-content" aria-expanded="true" aria-controls="style-errors-container-content">
							Errors
						</a>
					</h4>
				</div>
				<div id="style-errors-container-content" class="panel-collapse collapse" role="tabpanel" aria-labelledby="style-errors-container-header">
					<div class="panel-body">
						<div class="form-horizontal">
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Background color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['errors']['backgroundColor'] );?>" class="form-control errors-background-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Thickness', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['errors']['borderSize'] );?>" class="form-control errors-border-size" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['errors']['borderColor'] );?>" class="form-control errors-border-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Radius', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['errors']['borderRadius'] );?>" class="form-control errors-border-radius" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Padding', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['errors']['padding'] );?>" class="form-control errors-padding" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="<?php echo esc_html( $poll->meta_data['style']['errors']['textColor'] );?>" class="form-control errors-text-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text size', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<?php
						            switch ( $poll->meta_data['style']['errors']['textSize'] ) {
						                case 'small': {
						                    $errors_text_small = 'selected';
						                    $errors_text_medium = '';
						                    $errors_text_large = '';
						                    break;
						                }
						                case 'medium': {
						                    $errors_text_small = '';
						                    $errors_text_medium = 'selected';
						                    $errors_text_large = '';
						                    break;
						                }
						                case 'large': {
						                    $errors_text_small = '';
						                    $errors_text_medium = '';
						                    $errors_text_large = 'selected';
						                    break;
						                }
						                default: {
						                    $errors_text_small = '';
						                    $errors_text_medium = '';
						                    $errors_text_large = '';
						                    break;
						                }
						            }
						            ?>
									<select class="errors-text-size" style="width:100%">
						                <option value="small" <?php echo $buttons_text_small;?>><?php _e( 'Small', 'yop-poll' );?></option>
						                <option value="medium" <?php echo $buttons_text_medium;?>><?php _e( 'Medium', 'yop-poll' );?></option>
						                <option value="large" <?php echo $buttons_text_large;?>><?php _e( 'Large', 'yop-poll' );?></option>
						            </select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
