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
									<input type="text" name="poll[background-color]" value="#fff" class="form-control poll-background-color" style="width:100%"/>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Thickness', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" name="poll[border-size]" value="1" class="form-control poll-border-size" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="poll[border-color]" value="#000" class="form-control poll-border-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Radius', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
						                <input type="text" name="poll[border-radius]" value="0" class="form-control poll-border-radius" />
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
										<input type="text" name="poll[padding]" value="0" class="form-control poll-padding" />
										<span class="input-group-addon">px</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="poll[text-color]" value="#000" class="form-control poll-text-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Input elements borders color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="poll[input-elements-border-color]" value="#000" class="form-control poll-input-elements-border-color" />
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
									<input type="text" name="question[background-color]" value="#FFF" class="form-control question-background-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Thickness', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" name="poll[border-size]" value="1" class="form-control question-border-size" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="question[border-color]" value="#FFF" class="form-control question-border-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Radius', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" name="question[radius]" value="0" class="form-control question-border-radius" />
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
										<input type="text" name="question[padding]" value="0" class="form-control question-padding" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" name="question[text-color]" value="#000" class="form-control question-text-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text size', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<select  name="question[text-size]" class="question-text-size" style="width:100%">
						                <option value="small"><?php _e( 'Small', 'yop-poll' );?></option>
						                <option value="medium"><?php _e( 'Medium', 'yop-poll' );?></option>
						                <option value="large"><?php _e( 'Large', 'yop-poll' );?></option>
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
									<select class="answers-skin" style="width:100%">
						                <option value="minimal"><?php _e( 'Minimal', 'yop-poll' );?></option>
						                <option value="square"><?php _e( 'Square', 'yop-poll' );?></option>
						                <option value="flat"><?php _e( 'Flat', 'yop-poll' );?></option>
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
									<ul class="color-scheme">
						                <li class="active" title="Black" data-id="black"></li>
						                <li class="red" title="Red" data-id="red"></li>
						                <li class="green" title="Green" data-id="green"></li>
						                <li class="blue" title="Blue" data-id="blue"></li>
						                <li class="aero" title="Aero" data-id="aero"></li>
						                <li class="grey" title="Grey" data-id="grey"></li>
						                <li class="orange" title="Orange" data-id="orange"></li>
						                <li class="yellow" title="Yellow" data-id="yellow"></li>
						                <li class="pink" title="Pink" data-id="pink"></li>
						                <li class="purple" title="Purple" data-id="purple"></li>
					                </ul>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Background color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="#FFF" class="form-control answers-background-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Thickness', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="0" class="form-control answers-border-size" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="#FFF" class="form-control answers-border-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Radius', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="0" class="form-control answers-border-radius" />
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
										<input type="text" value="0" class="form-control answers-padding" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="#000" class="form-control answers-text-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text size', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<select  class="answers-text-size" style="width:100%">
						                <option value="small"><?php _e( 'Small', 'yop-poll' );?></option>
						                <option value="medium"><?php _e( 'Medium', 'yop-poll' );?></option>
						                <option value="large"><?php _e( 'Large', 'yop-poll' );?></option>
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
									<input type="text" value="#EE7600" class="form-control buttons-background-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Thickness', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="0" class="form-control buttons-border-size" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="#FFF" class="form-control buttons-border-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Radius', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="0" class="form-control buttons-border-radius" />
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
										<input type="text" value="0" class="form-control buttons-padding" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="#FFF" class="form-control buttons-text-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text size', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<select  class="buttons-text-size" style="width:100%">
						                <option value="small"><?php _e( 'Small', 'yop-poll' );?></option>
						                <option value="medium"><?php _e( 'Medium', 'yop-poll' );?></option>
						                <option value="large"><?php _e( 'Large', 'yop-poll' );?></option>
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
									<input type="text" value="#FFF" class="form-control errors-background-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Thickness', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="0" class="form-control errors-border-size" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="#FFF" class="form-control errors-border-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Border Radius', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" value="0" class="form-control errors-border-radius" />
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
										<input type="text" value="0" class="form-control errors-padding" />
										<div class="input-group-addon">px</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text color', 'yop-poll' );?>
								</div>
								<div class="col-md-9 colorpicker-component">
									<input type="text" value="#000" class="form-control errors-text-color" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3 field-caption">
									<?php _e( 'Text size', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<select  class="errors-text-size" style="width:100%">
						                <option value="small"><?php _e( 'Small', 'yop-poll' );?></option>
						                <option value="medium"><?php _e( 'Medium', 'yop-poll' );?></option>
						                <option value="large"><?php _e( 'Large', 'yop-poll' );?></option>
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
