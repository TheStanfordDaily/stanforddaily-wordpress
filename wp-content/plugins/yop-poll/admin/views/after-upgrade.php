<?php
if ( isset( $data['error'] ) && '' !== $data['error'] ) { ?>
    <div class="error" id="message">
		<?php echo $data['error'];?>
	</div>
    <?php
} else {
	if ( '' !== $data['success'] ) {
        ?>
            <div class = "updated" id = "message">
				<?php echo $data['success'];?>
			</div>
        <?php
	}
}
?>
