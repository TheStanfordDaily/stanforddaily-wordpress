<div class="tsd-donate-header">
<div class="container">
		<div class="row">
			<a class="tsd-donate-header-close" href="#" >
				<i class="fas fa-times"></i>
			</a>

			<div class="col-12 col-lg-8">
				<h3 style="margin-top: 0px; text-align: center;">
					<mark style="color: black">
						Support independent, student-run journalism.
					</mark>
				</h3>
				<div class="tsd-hidden-sm" style="text-align: left;">
					<i class="fas fa-newspaper fa-4x" aria-hidden="true" style="float: left; margin: 5px 30px 0px 30px;"></i>
					Your support helps give staff members from all backgrounds the opportunity to conduct meaningful reporting on important issues at Stanford. All contributions are tax-deductible.
				</div>
			</div>

			<div class="col-12 col-lg-4">
				<?php $donation_location = "header"; include "donation-form.php"; ?>
			</div>
		</div>
		<?php
		$post = get_page_by_path('header');
		if ($post) {
			$content = apply_filters('the_content', $post->post_content);
			echo $content;
		}
	?>
	</div>
</div>
