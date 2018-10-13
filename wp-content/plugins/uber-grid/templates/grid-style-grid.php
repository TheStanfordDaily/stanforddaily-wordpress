<style type="text/css">
<?php $layout = $this['layout']['default'] ?>
<?php if (!$this['layout']['cell_autosize']): ?>
div#uber-grid-wrapper-<?php echo $this->id ?>{
	min-width: <?php echo $this->get_columns_width($this->has_2x_cells($cells) ? 2 : 1)?>px !important;
}
<?php endif ?>
/* Cell layouts */


#uber-grid-<?php echo $this->id ?> div.uber-grid-cell {
	border-width: <?php echo (int)$layout['cell_border_width'] ?>px;
	border-color: <?php echo uber_grid_color($layout['cell_border_color'], $layout['cell_border_opacity']) ?>;
}
<?php if ((int)$layout['cell_shadow_radius'] > 0 ): ?>
#uber-grid-<?php echo $this->id ?> div.uber-grid-cell-outer {
		box-shadow: 0px 0px <?php echo $layout['cell_shadow_radius'] ?>px 0px rgba(0, 0, 0, 0.15);
		-o-box-shadow: 0px 0px <?php echo $layout['cell_shadow_radius'] ?>px 0px rgba(0, 0, 0, 0.15);
		-ms-box-shadow: 0px 0px <?php echo $layout['cell_shadow_radius'] ?>px 0px rgba(0, 0, 0, 0.15);
		-moz-box-shadow: 0px 0px <?php echo $layout['cell_shadow_radius'] ?>px 0px rgba(0, 0, 0, 0.15);
		-webkit-box-shadow: 0px 0px <?php echo $layout['cell_shadow_radius'] ?>px 0px rgba(0, 0, 0, 0.15);
}
<?php endif ?>

<?php if ((int)$layout['cell_border_radius'] > 0 ): ?>
	#uber-grid-<?php echo $this->id ?>  div.uber-grid-cell,
	#uber-grid-<?php echo $this->id ?>  div .uber-grid-hover,
	#uber-grid-<?php echo $this->id ?>  div .uber-grid-blur,
	#uber-grid-<?php echo $this->id ?>  div .uber-grid-cell-wrapper,
	#uber-grid-<?php echo $this->id ?>  div.io .uber-grid-cell-image,
	#uber-grid-<?php echo $this->id ?>  div.io .uber-grid-cell-title-wrapper,
	#uber-grid-<?php echo $this->id ?>  div.io .uber-grid-cell-title,
	#uber-grid-<?php echo $this->id ?>  div.io .uber-grid-cell-content{
		overflow: hidden !important;
		<?php if ((int)$layout['cell_border_radius'] > 0): ?>
			border-radius: <?php echo $layout['cell_border_radius'] ?>px !important;
			-o-border-radius: <?php echo $layout['cell_border_radius'] ?>px;
			-ms-border-radius: <?php echo $layout['cell_border_radius'] ?>px;
			-moz-border-radius: <?php echo $layout['cell_border_radius'] ?>px;
			-webkit-border-radius: <?php echo $layout['cell_border_radius'] ?>px !important;
		<?php endif ?>
	}
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-cell-wrapper{
		<?php if ((int)$layout['cell_border_width'] > 0): ?>
			border-radius: <?php echo $layout['cell_border_radius'] - 3 ?>px;
			-o-border-radius: <?php echo $layout['cell_border_radius'] - 3 ?>px;
			-ms-border-radius: <?php echo $layout['cell_border_radius'] - 3 ?>px;
			-moz-border-radius: <?php echo $layout['cell_border_radius'] - 3?>px;
			-webkit-border-radius: <?php echo $layout['cell_border_radius'] - 3 ?>px;
		<?php endif ?>
	}
	#uber-grid-<?php echo $this->id ?> > div.uber-grid-has-label .uber-grid-cell-wrapper{
		-webkit-border-bottom-right-radius: 0 !important;
		-webkit-border-bottom-left-radius: 0 !important;
		-moz-border-radius-bottomright: 0 !important;
		-moz-border-radius-bottomleft: 0 !important;
		border-bottom-right-radius: 0 !important;
		border-bottom-left-radius: 0 !important;
		overflow: hidden;
	}
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-cell-label{
		-webkit-border-bottom-right-radius: <?php echo $layout['cell_border_radius'] - 3 ?>px !important;
		-webkit-border-bottom-left-radius: <?php echo $layout['cell_border_radius'] - 3 ?>px !important;
		-moz-border-radius-bottomright: <?php echo $layout['cell_border_radius'] - 3 ?>px !important;
		-moz-border-radius-bottomleft: <?php echo $layout['cell_border_radius'] - 3 ?>px !important;
		border-bottom-right-radius: <?php echo $layout['cell_border_radius'] - 3 ?>px !important;
		border-bottom-left-radius: <?php echo $layout['cell_border_radius'] - 3 ?>px !important;
		overflow: hidden;
	}
<?php endif ?>
<?php $layout_768 = $this['layout']['768'] ?>
<?php if ((int)$layout_768['cell_border_radius'] > 0 ): ?>
	@media screen and (max-width: 768px){
	#uber-grid-<?php echo $this->id ?> > div,
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-hover,
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-blur,
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-cell-wrapper,
	#uber-grid-<?php echo $this->id ?> > div.io .uber-grid-cell-image,
	#uber-grid-<?php echo $this->id ?> > div.io .uber-grid-cell-title-wrapper,
	#uber-grid-<?php echo $this->id ?> > div.io .uber-grid-cell-title,
	#uber-grid-<?php echo $this->id ?> > div.io .uber-grid-cell-content{
		overflow: hidden !important;
		<?php if ((int)$layout_768['cell_border_radius'] > 0): ?>
			border-radius: <?php echo $layout_768['cell_border_radius'] ?>px !important;
			-o-border-radius: <?php echo $layout_768['cell_border_radius'] ?>px;
			-ms-border-radius: <?php echo $layout_768['cell_border_radius'] ?>px;
			-moz-border-radius: <?php echo $layout_768['cell_border_radius'] ?>px;
			-webkit-border-radius: <?php echo $layout_768['cell_border_radius'] ?>px !important;
		<?php endif ?>
	}
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-cell-wrapper{
		<?php if ((int)$layout_768['cell_border_width'] > 0): ?>
			border-radius: <?php echo $layout_768['cell_border_radius'] - 3 ?>px;
			-o-border-radius: <?php echo $layout_768['cell_border_radius'] - 3 ?>px;
			-ms-border-radius: <?php echo $layout_768['cell_border_radius'] - 3 ?>px;
			-moz-border-radius: <?php echo $layout_768['cell_border_radius'] - 3?>px;
			-webkit-border-radius: <?php echo $layout_768['cell_border_radius'] - 3 ?>px;
		<?php endif ?>
	}
	#uber-grid-<?php echo $this->id ?> > div.uber-grid-has-label .uber-grid-cell-wrapper{
		-webkit-border-bottom-right-radius: 0 !important;
		-webkit-border-bottom-left-radius: 0 !important;
		-moz-border-radius-bottomright: 0 !important;
		-moz-border-radius-bottomleft: 0 !important;
		border-bottom-right-radius: 0 !important;
		border-bottom-left-radius: 0 !important;
		overflow: hidden;
	}
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-cell-label{
		-webkit-border-bottom-right-radius: <?php $layout_768['cell_border_radius'] - 3 ?>px !important;
		-webkit-border-bottom-left-radius: <?php echo $layout_768['cell_border_radius'] - 3 ?>px !important;
		-moz-border-radius-bottomright: <?php echo $layout_768['cell_border_radius'] - 3 ?>px !important;
		-moz-border-radius-bottomleft: <?php echo $layout_768['cell_border_radius'] - 3 ?>px !important;
		border-bottom-right-radius: <?php echo $layout_768['cell_border_radius'] - 3 ?>px !important;
		border-bottom-left-radius: <?php echo $layout_768['cell_border_radius'] - 3 ?>px !important;
		overflow: hidden;
	}
}
<?php endif ?>
<?php $layout_440 = $this['layout']['440'] ?>
<?php if ((int)$layout_440['cell_border_radius'] > 0 ): ?>
	@media screen and (max-width: 440px){
	#uber-grid-<?php echo $this->id ?>  div.uber-grid-cell,
	#uber-grid-<?php echo $this->id ?>  div .uber-grid-hover,
	#uber-grid-<?php echo $this->id ?>  div .uber-grid-blur,
	#uber-grid-<?php echo $this->id ?>  div .uber-grid-cell-wrapper,
	#uber-grid-<?php echo $this->id ?>  div.io .uber-grid-cell-image,
	#uber-grid-<?php echo $this->id ?>  div.io .uber-grid-cell-title-wrapper,
	#uber-grid-<?php echo $this->id ?>  div.io .uber-grid-cell-title,
	#uber-grid-<?php echo $this->id ?>  div.io .uber-grid-cell-content{
		overflow: hidden !important;
		<?php if ((int)$layout_440['cell_border_radius'] > 0): ?>
			border-radius: <?php echo $layout_440['cell_border_radius'] ?>px !important;
			-o-border-radius: <?php echo $layout_440['cell_border_radius'] ?>px;
			-ms-border-radius: <?php echo $layout_440['cell_border_radius'] ?>px;
			-moz-border-radius: <?php echo $layout_440['cell_border_radius'] ?>px;
			-webkit-border-radius: <?php echo $layout_440['cell_border_radius'] ?>px !important;
		<?php endif ?>
	}
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-cell-wrapper{
		<?php if ((int)$layout_440['cell_border_width'] > 0): ?>
			border-radius: <?php echo $layout_440['cell_border_radius'] - 3 ?>px;
			-o-border-radius: <?php echo $layout_440['cell_border_radius'] - 3 ?>px;
			-ms-border-radius: <?php echo $layout_440['cell_border_radius'] - 3 ?>px;
			-moz-border-radius: <?php echo $layout_440['cell_border_radius'] - 3?>px;
			-webkit-border-radius: <?php echo $layout_440['cell_border_radius'] - 3 ?>px;
		<?php endif ?>
	}
	#uber-grid-<?php echo $this->id ?> > div.uber-grid-has-label .uber-grid-cell-wrapper{
		-webkit-border-bottom-right-radius: 0 !important;
		-webkit-border-bottom-left-radius: 0 !important;
		-moz-border-radius-bottomright: 0 !important;
		-moz-border-radius-bottomleft: 0 !important;
		border-bottom-right-radius: 0 !important;
		border-bottom-left-radius: 0 !important;
		overflow: hidden;
	}
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-cell-label{
		-webkit-border-bottom-right-radius: <?php echo $layout_440['cell_border_radius'] - 3 ?>px !important;
		-webkit-border-bottom-left-radius: <?php echo $layout_440['cell_border_radius'] - 3 ?>px !important;
		-moz-border-radius-bottomright: <?php echo $layout_440['cell_border_radius'] - 3 ?>px !important;
		-moz-border-radius-bottomleft: <?php echo $layout_440['cell_border_radius'] - 3 ?>px !important;
		border-bottom-right-radius: <?php echo $layout_440['cell_border_radius'] - 3 ?>px !important;
		border-bottom-left-radius: <?php echo $layout_440['cell_border_radius'] - 3 ?>px !important;
		overflow: hidden;
	}
}
<?php endif ?>


<?php if ((float)$layout['cell_border_opacity'] < 1): ?>
#uber-grid-<?php echo $this->id ?> li:hover{
	border-color: <?php echo uber_grid_color($layout['cell_border_color'], 0.7) ?>;
}
<?php endif ?>
/*#uber-grid-<?php echo $this->id ?> > div.r1c1 .uber-grid-cell-wrapper{
	width: <?php echo $layout['cell_width']  ?>px;
	height: <?php echo $layout['cell_height'] ?>px;
}
#uber-grid-<?php echo $this->id ?> > div.r2c2 .uber-grid-cell-wrapper{
	width: <?php echo $layout['cell_width'] * 2 + $layout['cell_border_width'] * 2  + $layout['cell_gap'] ?>px;
	height: <?php echo $layout['cell_height'] * 2 + $layout['cell_border_width'] * 2  + $layout['cell_gap'] ?>px;
}
#uber-grid-<?php echo $this->id ?> > div.r2c1 .uber-grid-cell-wrapper{
	width: <?php echo $layout['cell_width'] ?>px;
	height: <?php echo $layout['cell_height'] * 2 + $layout['cell_border_width'] * 2 + $layout['cell_gap'] ?>px;
}
#uber-grid-<?php echo $this->id ?> > div.r1c2 .uber-grid-cell-wrapper{
	width: <?php echo $layout['cell_width'] * 2 + $layout['cell_border_width'] * 2  + $layout['cell_gap'] ?>px;
	height: <?php echo $layout['cell_height']  ?>px;
}
#uber-grid-<?php echo $this->id ?> > div.r1c1, #uber-grid-<?php echo $this->id ?> div.r2c1{
	width: <?php echo $layout['cell_width'] ?>px;
}
#uber-grid-<?php echo $this->id ?> > div.r2c2, #uber-grid-<?php echo $this->id ?> div.r1c2{
	width: <?php echo $layout['cell_width'] * 2 + $layout['cell_border_width'] * 2  + $layout['cell_gap'] ?>px;
}
*/

@media screen and (max-width: 768px){
	#uber-grid-<?php echo $this->id ?> .uber-grid-cell{
		border-width: <?php echo $layout_768['cell_border_width']?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r1c1 .uber-grid-cell-wrapper{
		width: <?php echo $layout_768['cell_width'] ?>px;
		height: <?php echo $layout_768['cell_height'] ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r2c2 .uber-grid-cell-wrapper{
		width: <?php echo $layout_768['cell_width'] * 2 + $layout_768['cell_border_width'] * 2  + $layout['cell_gap'] ?>px;
		height: <?php echo $layout_768['cell_height'] * 2 + $layout['cell_border_width'] * 2  + $layout['cell_gap'] ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r2c1 .uber-grid-cell-wrapper{
		width: <?php echo $layout_768['cell_width'] ?>px;
		height: <?php echo $layout_768['cell_height'] * 2 + $layout_768['cell_border_width'] * 2 + $layout_768['cell_gap'] ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r1c2 .uber-grid-cell-wrapper{
		width: <?php echo $layout_768['cell_width'] * 2 + $layout_768['cell_border_width'] * 2  + $layout_768['cell_gap'] ?>px;
		height: <?php echo $layout_768['cell_height'] ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r1c1, #uber-grid-<?php echo $this->id ?> > div.r2c1{
		width: <?php echo $layout_768['cell_width'] ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r2c2, #uber-grid-<?php echo $this->id ?> > div.r1c2{
		width: <?php echo $layout_768['cell_width'] * 2 + $layout_768['cell_border_width'] * 2  + $layout_768['cell_gap'] ?>px;
	}
}

@media screen and (max-width: 440px){
	#uber-grid-<?php echo $this->id ?> .uber-grid-cell{
		border-width: <?php echo $layout_440['cell_border_width'] ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r1c1 .uber-grid-cell-wrapper{
		width: <?php echo $layout_440['cell_width'] ?>px;
		height: <?php echo $layout_440['cell_height'] ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r2c2 .uber-grid-cell-wrapper{
		width: <?php echo $layout_440['cell_width'] * 2 + $layout_440['cell_border_width'] * 2  + $layout_440['cell_gap'] ?>px;
		height: <?php echo $layout_440['cell_height'] * 2 + $layout_440['cell_border_width'] * 2  + $layout_440['cell_gap'] ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r2c1 .uber-grid-cell-wrapper{
		width: <?php echo $layout_440['cell_width'] ?>px;
		height: <?php echo $layout_440['cell_height'] * 2 + $layout_440['cell_border_width'] * 2 + $layout_440['cell_gap'] ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r1c2 .uber-grid-cell-wrapper{
		width: <?php echo $layout_440['cell_width'] * 2 + $layout_440['cell_border_width'] * 2  + $layout_440['cell_gap']  ?>px;
		height: <?php echo $layout_440['cell_height']  ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r1c1, #uber-grid-<?php echo $this->id ?> > div.r2c1{
		width: <?php echo $layout_440['cell_width'] ?>px;
	}
	#uber-grid-<?php echo $this->id ?> > div.r2c2, #uber-grid-<?php echo $this->id ?> > div.r1c2{
		width: <?php echo $layout_440['cell_width'] * 2 + $layout_440['cell_border_width'] * 2  + $layout_440['cell_gap'] ?>px;
	}
}


/* Fonts */

<?php $font_settings = array(
	'title' => "#uber-grid-{$this->id} > div .uber-grid-cell-title strong",
	'tagline' => "#uber-grid-{$this->id} > div .uber-grid-cell-title small",
	'hover_text' => "#uber-grid-{$this->id} > div .uber-grid-hover .uber-grid-hover-text",
	'hover_title' => "#uber-grid-{$this->id} > div .uber-grid-hover .uber-grid-hover-title strong",
	'lightbox_title' => ".uber-grid-{$this->id}-lightbox h3",
	'lightbox_text' => ".uber-grid-{$this->id}-lightbox",
	'label_title' => "#uber-grid-{$this->id} .uber-grid-cell-label .uber-grid-label-heading",
	'label_tagline' => "#uber-grid-{$this->id} .uber-grid-cell-label .uber-grid-label-text",
	'label_price' => "#uber-grid-{$this->id} .uber-grid-price-tag",
	'lightbox_text' => ".uber-grid-{$this->id}-lightbox-content",
	'lightbox_title' => ".uber-grid-{$this->id}-lightbox-content h3",
	'filters' => "#uber-grid-wrapper-{$this->id} .uber-grid-filters div a",
	'pagination' => "#uber-grid-wrapper-{$this->id} .uber-grid-pagination div a"
);
?>
<?php foreach($font_settings as $var => $selector): ?>
	<?php $font = $this['fonts'][$var] ?>
	<?php if ($font['family'] || $font['size'] || $font['style']): ?>
	<?php echo $selector ?>{
		<?php if ($font['family']): ?>
			font-family: "<?php echo $font['family'] ?>", 'Helvetica Neue', Helvetica, sans-serif;
		<?php endif ?>
		<?php if ($font['style']): ?>
			font-weight: <?php echo $this->parse_font_weight($font['style']) ?>;
			font-style: <?php echo $this->parse_font_style($font['style'])?>;
		<?php endif ?>

		<?php if($font['size']): ?>
			font-size: <?php echo $font['size'] ?>px;
		<?php endif ?>
	}
	<?php endif ?>
<?php endforeach ?>

<?php if ($layout['label_max_height']): ?>
#uber-grid-<?php echo $this->id ?> > div .uber-grid-cell-label{
	height: <?php echo $layout['label_max_height'] ?>px;
}
<?php endif ?>

<?php $font_settings = array(
	'title' => "#uber-grid-{$this->id} > div .uber-grid-cell-title strong",
	'tagline' => "#uber-grid-{$this->id} > div .uber-grid-cell-title small",
	'hover_text' => "#uber-grid-{$this->id} > div .uber-grid-hover .uber-grid-hover-text",
	'hover_title' => "#uber-grid-{$this->id} > div .uber-grid-hover .uber-grid-hover-title strong",
	'label_title' => "#uber-grid-{$this->id} .uber-grid-cell-label .uber-grid-label-heading",
	'label_tagline' => "#uber-grid-{$this->id} .uber-grid-cell-label .uber-grid-label-text",
	'label_price' => "#uber-grid-{$this->id} .uber-grid-price-tag"
);
?>
@media screen and (max-width: 768px){
	<?php foreach($font_settings as $var => $selector): ?>
		<?php if ($size = $layout_768[$var . "_font_size"]): ?>
			<?php echo $selector ?>{
				font-size: <?php echo $size ?>px;
			}
		<?php endif ?>
	<?php endforeach ?>

	<?php if ($layout_768['label_max_height']): ?>
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-cell-label{
		height: <?php echo $layout_768['label_max_height'] ?>px;
	}
	<?php endif ?>
}

@media screen and (max-width: 440px){
	<?php foreach($font_settings as $var => $selector): ?>
		<?php if ($size = $layout_440[$var . "_font_size"]): ?>
		<?php echo $selector ?>{
			font-size: <?php echo $size ?>px !important;
		}
		<?php endif ?>
	<?php endforeach ?>

	<?php if ($layout_440['label_max_height']): ?>
	#uber-grid-<?php echo $this->id ?> > div .uber-grid-cell-label{
		height: <?php echo $layout_440['label_max_height'] ?>px;
	}
	<?php endif ?>
}

#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-filters{
	text-align: <?php echo $this['filters']['align'] ?>;
}
#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-filters > div a,
#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-filters > div a:visited{
	color: <?php echo uber_grid_color($this['filters']['color']) ?> !important;
	background-color: <?php echo uber_grid_color($this['filters']['background_color'])?> !important;
	<?php if ($this['filters']['border_color']): ?>
	border: 1px solid <?php echo $this['filters']['border_color'] ?>;
	<?php endif ?>
}
#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-filters > div a:hover{
	background-color: <?php echo uber_grid_color($this['filters']['accent_background_color']) ?> !important;
	<?php if ($this['filters']['accent_border_color']): ?>
		border: 1px solid <?php echo $this['filters']['accent_border_color'] ?>;
	<?php endif ?>

}

#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-filters > div.active a,
#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-filters > div.active a:visited{
	color: <?php echo uber_grid_color($this['filters']['accent_color']) ?> !important;
	background-color: <?php echo uber_grid_color($this['filters']['accent_background_color'])?> !important;
	<?php if ($this['filters']['accent_border_color']): ?>
		border: 1px solid <?php echo $this['filters']['accent_border_color'] ?>;
	<?php endif ?>

}


#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-pagination{
	text-align: <?php echo $this['pagination']['align'] ?>;
}
#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-pagination > div a,
#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-pagination > div a:visited{
	color: <?php echo uber_grid_color($this['pagination']['color']) ?> !important;
	background-color: <?php echo uber_grid_color($this['pagination']['background_color'])?> !important;
	border-color: <?php echo uber_grid_color($this['pagination']['border_color'])?> !important;
}
#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-pagination div a:hover,
#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-pagination div.uber-grid-current a,
#uber-grid-wrapper-<?php echo $this->id ?> div.uber-grid-pagination div.uber-grid-current a:visited {
	color: <?php echo uber_grid_color($this['pagination']['current_page_color']) ?> !important;
	background-color: <?php echo uber_grid_color($this['pagination']['current_page_background_color']) ?> !important;
	border-color: <?php echo uber_grid_color($this['pagination']['current_page_border_color'])?> !important;
}

</style>
