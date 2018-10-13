<?php
include( YOP_POLL_PATH . 'admin/views/yop-poll-elements-definitions.php' )
?>
<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
<div class="row">
	<div class="col-md-12 buttons-row">
		<span class="regular-buttons">
			<a class="btn btn-primary add-custom-field" href="#" role="button">
				<i class="glyphicon glyphicon-asterisk" aria-hidden="true"></i>
				<br>
				<?php _e( 'Custom Field', 'yop-poll' );?>
			</a>
		</span>
		<span class="premium-buttons">
			<span class="premium">
				<a href="#" class="upgrade-to-pro" data-screen="multiple-questions">
					<img src="<?php echo YOP_POLL_URL;?>admin/assets/images/pro-vertical.svg" class="responsive" />
				</a>
			</span>
			<a class="btn btn-warning add-text-question" href="#" role="button">
				<i class="glyphicon glyphicon-asterisk" aria-hidden="true"></i>
				<br>
				<?php _e( 'Text Question', 'yop-poll' );?>
			</a>
			<a class="btn btn-warning add-media-question" href="#" role="button">
				<i class="glyphicon glyphicon-asterisk" aria-hidden="true"></i>
				<br>
				<?php _e( 'Media Question', 'yop-poll' );?>
			</a>
			<a class="btn btn-warning add-space-separator" href="#" role="button">
				<i class="glyphicon glyphicon-asterisk" aria-hidden="true"></i>
				<br>
				<?php _e( 'Space Separator', 'yop-poll' );?>
			</a>
			<a class="btn btn-warning add-text-block" href="#" role="button">
				<i class="glyphicon glyphicon-asterisk" aria-hidden="true"></i>
				<br>
				<?php _e( 'Text Block', 'yop-poll' );?>
			</a>
			</span>
		<hr>
	</div>
</div>
<div class="row">
	<div class="poll-elements" data-remove="">
		<div class="poll-elements-list" style="min-height: 200px;">
			<div class="poll-element question" data-type="text-question" data-id="" data-remove="">
				<div class="title-bar">
					<span class="bar-title pull-left poll-element-collapse">
						<?php _e( 'Question', 'yop-poll' );?>
						<span class="glyphicon glyphicon-chevron-up hspace" aria-hidden="true"></span>
					</span>
					<span class="pull-right actions">
						<a href="#" class="hspace add-text-answer" title="<?php _e( 'Add Answer', 'yop-poll' );?>">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</a>
						<a href="#" class="hspace text-question-edit-clone" title="<?php _e( 'Duplicate', 'yop-poll' );?>">
							<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
						</a>
						<a href="#" class="hspace text-question-edit-delete" title="<?php _e( 'Delete', 'yop-poll' );?>">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</span>
				</div>
				<div class="content-inside">
					<div class="question-text">
						<div class="form-group">
							<input type="text" class="form-control input-lg question-value" name="question text" value="<?php _e( 'Do you have a question?', 'yop-poll' );?>" placeholder="<?php _e( 'Question text', 'yop-poll' );?>">
						</div>
					</div>
					<div class="answers">
						<div class="answer" data-id="">
							<div class="title-bar">
								<span class="bar-title pull-left">
									<?php _e( 'Answer', 'yop-poll' );?>
								</span>
								<span class="pull-right actions">
									<a href="#" class="hspace text-answer-edit-more" title="<?php _e( 'Edit', 'yop-poll' );?>">
										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
									</a>
									<a href="#" class="hspace text-answer-edit-clone" title="<?php _e( 'Duplicate', 'yop-poll' );?>">
										<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
									</a>
									<a href="#" class="hspace text-answer-edit-delete" title="<?php _e( 'Delete', 'yop-poll' );?>">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</a>
								</span>
							</div>
							<div class="content-inside">
								<div class="answer-text">
									<div class="form-horizontal">
										<div class="form-group">
											<div class="col-sm-11">
												<input type="text" class="form-control answer-value" name="question text" value="Yes" placeholder="Question text">
											</div>
											<div class="col-sm-1">
												<label class="pull-right set-as-default-inline" title="Set as default">
													<input type="checkbox" class="answer-is-default">
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="answer-options">
									<div class="form-group">
										<div class="row">
											<div class="col-md-4">
												<div class="checkbox">
													<label>
													  <input type="checkbox" class="answer-make-default"> <?php _e( 'Set as default', 'yop-poll' );?>
													</label>
												  </div>
											</div>
											<div class="col-md-4">
												<div class="checkbox">
													<label>
													  <input type="checkbox" class="answer-make-link"> <?php _e( 'Make it a link', 'yop-poll' );?>
													</label>
												  </div>
											</div>
											<div class="col-md-4">
												<div class="checkbox">
													<label>
														<?php _e( 'Results color', 'yop-poll' );?>
													</label>
													<input type="text" value="#000" class="form-control answer-results-color" />
												</div>
											</div>
										</div>
										<div class="row answer-link-section hide">
											<div class="col-md-12">
												<input type="text" class="form-control border answer-link" name="" placeholder="http://">
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 text-right">
												<button type="button" class="btn btn-default text-answer-edit-done">
													<?php _e( 'Done', 'yop-poll' );?>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="answer" data-id="">
							<div class="title-bar">
								<span class="bar-title pull-left">
									<?php _e( 'Answer', 'yop-poll' );?>
								</span>
								<span class="pull-right actions">
									<a href="#" class="hspace text-answer-edit-more" title="<?php _e( 'Edit', 'yop-poll' );?>">
										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
									</a>
									<a href="#" class="hspace text-answer-edit-clone" title="<?php _e( 'Duplicate', 'yop-poll' );?>">
										<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
									</a>
									<a href="#" class="hspace text-answer-edit-delete" title="<?php _e( 'Delete', 'yop-poll' );?>">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</a>
								</span>
							</div>
							<div class="content-inside">
								<div class="answer-text">
									<div class="form-horizontal">
										<div class="form-group">
											<div class="col-sm-11">
												<input type="text" class="form-control answer-value" name="question text" value="Yes" placeholder="Question text">
											</div>
											<div class="col-sm-1">
												<label class="pull-right set-as-default-inline" title="Set as default">
													<input type="checkbox" class="answer-is-default">
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="answer-options">
									<div class="form-group">
										<div class="row">
											<div class="col-md-4">
												<div class="checkbox">
													<label>
													  <input type="checkbox" class="answer-make-default"> <?php _e( 'Set as default', 'yop-poll' );?>
													</label>
												  </div>
											</div>
											<div class="col-md-4">
												<div class="checkbox">
													<label>
													  <input type="checkbox" class="answer-make-link"> <?php _e( 'Make it a link', 'yop-poll' );?>
													</label>
												  </div>
											</div>
											<div class="col-md-4">
												<div class="checkbox">
													<label>
														<?php _e( 'Results color', 'yop-poll' );?>
													</label>
													<input type="text" value="#000" class="form-control answer-results-color" />
												</div>
											</div>
										</div>
										<div class="row answer-link-section hide">
											<div class="col-md-12">
												<input type="text" class="form-control border answer-link" name="" placeholder="http://">
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 text-right">
												<button type="button" class="btn btn-default text-answer-edit-done">
													<?php _e( 'Done', 'yop-poll' );?>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="question-options">
						<h4>
							<?php _e( 'OPTIONS', 'yop-poll' );?>
						</h4>
						<div class="form-horizontal">
							<div class="form-group">
								<div class="col-md-3">
									<?php _e( 'Allow other answers', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<select class="allow-other-answers" style="width:100%">
										<option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
										<option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
									</select>
								</div>
							</div>
							<div class="other-answers-section hide">
								<div class="form-group">
									<div class="col-md-3">
										<?php _e( 'Label for Other Answers', 'yop-poll' );?>
									</div>
									<div class="col-md-9">
										<input type="text" name="" value="<?php _e( 'Other', 'yop-poll' );?>" class="form-control other-answers-label" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-3">
										<?php _e( 'Add other answers in answers list', 'yop-poll' );?>
									</div>
									<div class="col-md-9">
										<select class="add-other-answers" style="width:100%">
											<option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
											<option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-3">
										<?php _e( 'Display other answers in results list', 'yop-poll' );?>
									</div>
									<div class="col-md-9">
										<select class="display-other-answers-in-results" style="width:100%">
											<option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
											<option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<?php _e( 'Allow multiple answers', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<select class="allow-multiple-answers" style="width:100%">
										<option value="yes"><?php _e( 'Yes', 'yop-poll' );?></option>
										<option value="no" selected><?php _e( 'No', 'yop-poll' );?></option>
									</select>
								</div>
							</div>
							<div class="multiple-answers-section hide">
								<div class="form-group">
									<div class="col-md-3">
										<?php _e( 'Minimum answers required', 'yop-poll' );?>
									</div>
									<div class="col-md-9">
										<input type="text" name="" value="1" class="form-control multiple-answers-minim"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-3">
										<?php _e( 'Maximum answers allowed', 'yop-poll' );?>
									</div>
									<div class="col-md-9">
										<input type="text" name="" value="1" class="form-control multiple-answers-maxim"/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<?php _e( 'Display answers', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<select class="answers-display" style="width:100%">
										<option value="vertical" selected>
											<?php _e( 'Vertical', 'yop-poll' );?>
										</option>
										<option value="horizontal">
											<?php _e( 'Horizontal', 'yop-poll' );?>
										</option>
										<option value="columns">
											<?php _e( 'Columns', 'yop-poll' );?>
										</option>
									</select>
								</div>
							</div>
							<div class="form-group answers-display-section hide">
								<div class="col-md-3">
									<?php _e( 'Display answers', 'yop-poll' );?>
								</div>
								<div class="col-md-9">
									<input type="text" name="button-label" class="form-control answers-columns"/>&nbsp;<?php _e( 'columns', 'yop-poll' );?>
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
