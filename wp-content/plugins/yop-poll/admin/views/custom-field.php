<div class="poll-element" data-type="custom-field">
	<div class='sortelement'>
		<div class="topbar poll-element-header">
			<h4 class="left">
				<a href="#" class="poll-element-collapse" title="<?php _e( 'Click to Contract', 'yop-poll' );?>">
					<i class="fa fa-chevron-down"></i>
				</a>
				<span class="poll-element-collapse-text">
					<?php _e( 'CUSTOM FIELD', 'yop-poll' );?>
				</span>
			</h4>
			<div class="icon-after-field-type">
				<i class="fa fa-arrows-v" aria-hidden="true"></i>
			</div>
			<div class="right">
				<a href='#' class='custom-field-edit-more'>
					<i class="fa fa-edit"></i>
				</a>
				<a href='#' class='custom-field-edit-clone'>
					<i class="fa fa-files-o"></i>
				</a>
				<a href='#' class='custom-field-edit-delete'>
					<i class="fa fa-trash-o"></i>
				</a>
			</div>
		</div>
		<div class="content custom-field-section">
			<h5>
				<span class="custom-field-text-edit" style='width: 80%;'>
					<input type='text'
						value="<?php _e( 'Custom Field', 'yop-poll' );?>"
						class='form-control custom-field-name'
						style='width: 80%;'
					/>
				</span>
				<span class="checkboxholder">
					<label class="checkl">
						<input type="checkbox" class="custom-field-required" />
					</label>
				</span>
			</h5>
			<div class="custom-field-edit-more">
				<div class="checkbar">
					<div class="checkelement">
						<div class="checkboxholder">
							<input type="checkbox" class="custom-field-make-required" />
							<label class="checkl">
								<?php _e( 'Required', 'yop-poll' );?>
							</label>
						</div>
					</div>
				</div>
				<button class="btn btn-primary custom-field-edit-done">
					<i class="fa fa-check" aria-hidden="true"></i>
					<?php _e( 'Done', 'yop-poll' );?>
				</button>
			</div>
		</div>
	</div>
</div>
