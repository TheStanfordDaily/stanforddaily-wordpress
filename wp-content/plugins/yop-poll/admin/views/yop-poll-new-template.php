<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div id="templates-carousel" class="carousel slide" data-ride="carousel" data-interval="false">
			<ol class="carousel-indicators">
			<?php
			$i = 0;
			$item_active = '';
			?>
			<?php foreach ( $templates as $template ) {
				if ( 0 === $i ) {
					$item_active = 'active';
				} else {
					$item_active = '';
				}
				?>
				<li data-target="#templates-carousel"
					data-slide-to="<?php echo $i;?>"
					data-template-base="<?php echo $template->base?>"
					data-template-id="<?php echo $template->id?>"
					class="<?php echo $item_active;?>"></li>
			<?php
				$i++;
			}
			?>
			</ol>
			<div class="carousel-inner" role="listbox">
				<?php
				$i = 0;
				$item_active = '';
				foreach ( $templates as $template ) {
					if ( 0 === $i ) {
						$item_active = 'active';
					} else {
						$item_active = '';
					}
					?>
					<div class="item <?php echo $item_active;?>">
						<img src="<?php echo YOP_POLL_URL;?>admin/assets/images/templates/<?php echo $template->image_preview;?>" alt="...">
						<div class="carousel-caption">
							<h3>
								<?php echo $template->name;?>
							</h3>
							<p>
								<?php echo $template->description;?>
							</p>
						</div>
					</div>
					<?php
					$i++;
				}
				?>
			</div>
			<a class="left carousel-control" href="#templates-carousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">
					<?php _e( 'Previous', 'yop-poll' );?>
				</span>
			</a>
			<a class="right carousel-control" href="#templates-carousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">
					<?php _e( 'Next', 'yop-poll' );?>
				</span>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
<div class="row">
	<div class="col-md-12 text-center">
		<input name="publish" id="publish" data-template="" data-template-base=""
	        class="button button-primary button-large center"
	        value="<?php _e( 'Use and customize', 'yop-poll' );?>" type="button" />
	    <input type="hidden" name="poll[template]" value="">
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		&nbsp;
	</div>
</div>
