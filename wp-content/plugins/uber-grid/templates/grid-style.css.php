<?php $i = 0 ?>
<style type="text/css">
<?php foreach($cells as $cell): ?>
	<?php $hover = $cell['hover'] ?>
	<?php $link = $cell['link'] ?>
	<?php $label = $cell['label'] ?>
	<?php if ($cell['background_color']): ?>
		li#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?>{
			background-color: <?php echo uber_grid_color($cell['background_color']) ?>;
		}
	<?php endif ?>
	<?php if ($cell['title_background_color'] || $cell['title_background_image']): ?>
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title-wrapper{
			background-color: <?php echo uber_grid_color($cell['title_background_color'], preg_match('/\-io$/', $cell['layout'])) ?>;
			background-color: <?php echo uber_grid_color($cell['title_background_color'], preg_match('/\-io$/', $cell['layout']) ? $cell['title_background_gradient_opacity'] : 1) ?>;
			background: -moz-linear-gradient(top left,  rgba(0,0,0,0) 0%, rgba(0,0,0,0) 100%), <?php echo uber_grid_color($cell['title_background_color'], preg_match('/\-io$/', $cell['layout']) ? $cell['title_background_gradient_opacity'] : 1) ?>; /* FF3.6+ */
			background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(0,0,0,0.1)), color-stop(100%,rgba(0,0,0,0))), <?php echo uber_grid_color($cell['title_background_color'], preg_match('/\-io$/', $cell['layout']) ? $cell['title_background_gradient_opacity'] : 1) ?>; /* Chrome,Safari4+ */
			background: -o-linear-gradient(to top left,  rgba(0,0,0,0) 0%, rgba(0,0,0,0) 100%), <?php echo uber_grid_color($cell['title_background_color'], preg_match('/\-io$/', $cell['layout']) ? $cell['title_background_gradient_opacity'] : 1); ?>; /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0) 100%), <?php echo uber_grid_color($cell['title_background_color'], preg_match('/\-io$/', $cell['layout']) ? $cell['title_background_gradient_opacity'] : 1); ?>; /* IE10+ */
			background: linear-gradient(to top left,  rgba(0,0,0, 0) 0%,rgba(0,0,0,0) 100%), <?php echo uber_grid_color($cell['title_background_color'], preg_match('/\-io$/', $cell['layout']) ? $cell['title_background_gradient_opacity'] : 1);?>; /* W3C */
			<?php if ($cell['background_image']): ?>
				background-image: url(<?php echo $cell->get_title_background_image_src($this, $cell['title_background_image_position'] == 'fill') ?>) !important;
				<?php if ($cell['title_background_image_position'] == 'fill'): ?>
					background-size: 100% 100% !important;
					background-image-repeat: no-repeat;
				<?php endif ?>
			<?php endif ?>

		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title-wrapper:after{
			<?php if ($cell->imageLocation() == 'ir'): ?>
				border-left-color: <?php echo uber_grid_color($cell['title_background_color']) ?>;
			<?php elseif ($cell->imageLocation() == 'il'): ?>
				border-right-color: <?php echo uber_grid_color($cell['title_background_color']) ?>;
			<?php elseif ($cell->imageLocation() == 'ib'): ?>
				border-top-color: <?php echo uber_grid_color($cell['title_background_color']) ?>;
			<?php elseif ($cell->imageLocation() == 'it'): ?>
				border-bottom-color: <?php echo uber_grid_color($cell['title_background_color']) ?>;
			<?php endif ?>
		}
	<?php endif ?>
	<?php switch($cell['title_position']): ?><?php case 'center': ?>
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title-wrapper{
			display: flex;
		  align-items: center;
		  justify-content: center;
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?>
			.uber-grid-cell-title{
			text-align: center !important;
			line-height: 1.4 !important;
			box-sizing: border-box !important;
			-moz-box-sizing: border-box !important;
			padding-left: 4%;
			padding-right: 4%;
			width: 100%;
      left: 0;
      height: auto;
			position: static;
			display: table-cell;
			vertical-align: middle;
		}
		@media screen and (max-width: 768px){
			div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title{
				margin-top: -<?php echo (($this['layout']['768']['title_font_size'] ? $this['layout']['768']['title_font_size'] : 13) * 1.2 +  trim($cell['tagline']) ? (($this['layout']['768']['tagline_font_size'] ? $this['layout']['768']['tagline_font_size'] : 13) * 1.2) : 0) / 2 ?>px;
			}
		}
		@media screen and (max-width: 440px){
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title{
					margin-top: -<?php echo (($this['layout']['440']['title_font_size'] ? $this['layout']['440']['title_font_size'] : 13) * 1.2 +  trim($cell['tagline']) ? (($this['layout']['440']['tagline_font_size'] ? $this['layout']['440']['tagline_font_size'] : 13) * 1.2) : 0) / 2 ?>px;
			}
		}
	div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title strong{
		text-align: <?php echo preg_replace('/(top\-|bottom\-|center\-)/', '', $cell['title_position'])?>;
	}
	<?php break ?><?php case 'top-center'?><?php case 'top-left' ?><?php case 'top-right'?>
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title{
			padding: 4%;
			text-align: <?php echo str_replace('top-', '', $cell['title_position'])?>;
			padding-top: 0;
			padding-bottom: 0;
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?>
			.uber-grid-cell-title .scrollarea-content > div {
			padding-top: 4%;
			padding-bottom: 4%;
		}
	<?php break ?>
	<?php break ?><?php case 'bottom-center'?><?php case 'bottom-left' ?><?php case 'bottom-right'?>
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title{
			bottom: 0;
			right: 0;
			top: auto;
			position: absolute;
			padding: 8%;
			text-align: <?php echo str_replace('bottom-', '', $cell['title_position'])?>;
		}
	<?php break ?>
	<?php break ?><?php case 'top-left-bottom-left'?><?php case 'top-left-bottom-right'?>
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title{
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			text-align: left;
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title strong{
			position: absolute;
			top: 8%;
			left: <?php echo $cell->get_image_columns() == 1 ? '8' : '4' ?>%;
			right: <?php echo $cell->get_image_columns() == 1 ? '8' : '4' ?>%
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title small{
			position: absolute;
			bottom: 8%;
			left: 8%;
			right: 8%;
			<?php echo str_replace('top-left-bottom-', '', $cell['title_position']) ?>: <?php echo $cell->get_image_columns() == 1 ? '8' : '4' ?>%;
		}
	<?php break ?><?php case 'top-right-bottom-left'?><?php case 'top-right-bottom-right'?>
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title{
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			text-align: right;
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title strong{
			position: absolute;
			left: <?php echo $cell->get_image_columns() == 1 ? '8' : '4' ?>%;
			right: <?php echo $cell->get_image_columns() == 1 ? '8' : '4' ?>%
			text-aligh: right;
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title small{
			position: absolute;
			bottom: 8%;
			<?php echo str_replace('top-right-bottom-', '', $cell['title_position']) ?>: 8%;
			max-width: 92%
		}

	<?php endswitch ?>
	<?php if ($cell['title_color']): ?>
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title strong{
			color: <?php echo uber_grid_color($cell['title_color']) ?>;
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?>.io .uber-grid-cell-title strong{
			color: <?php echo $cell['title_color'] ?>;
		}
	<?php endif ?>

	<?php if ($cell['tagline_color']): ?>
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-title small{
			color: <?php echo uber_grid_color($cell['tagline_color']) ?>;
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?>.io .uber-grid-cell-title small{
			color: <?php echo $cell['tagline_color'] ?>;
		}
	<?php endif ?>

	<?php if ($hover['enable']): ?>
			<?php if ($hover['text_color']): ?>
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover,
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover a,
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-title,
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-title strong{
					color: <?php echo uber_grid_color($hover['text_color']) ?>;
				}
			<?php endif ?>
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover{
			<?php if ($hover['background_color']): ?>
				background-color: <?php echo uber_grid_color($hover['background_color']) ?>;
				background-color: <?php echo uber_grid_color($hover['background_color'], $hover['background_opacity']) ?>;
			<?php endif ?>
			<?php if ($hover['background_image']): ?>
				background-image: url(<?php echo $cell->get_hover_background_image_src($this, $hover['background_image_position'] == 'fill' ) ?>) !important;
				<?php if ($hover['background_image_position'] == 'fill'): ?>
					background-size: 100% 100%;
				<?php endif ?>
			<?php endif ?>
			padding: <?php echo $cell->get_columns() == 1 ? '8' : '4'?>%;
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover strong.uber-grid-hover-title{
			margin-bottom: <?php echo (($this['fonts']['title']['size'] ? $this['fonts']['title']['size'] : 13) * 1.2 + ($this['fonts']['tagline']['size'] ? $this['fonts']['tagline']['size'] : 13) * 1.2) / 4 ?>px;
		}

		<?php switch ($hover['position']):
			case 'top-right': ?>
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner{
					 text-align: right;
				}
			<?php break;
			case 'top-center': ?>
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner{
				text-align: center;
				}
			<?php break;
			case 'bottom-center': ?>
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner{
					text-align: center;
					position: absolute;
					left: <?php $cell->echo_horizontal_padding() ?>;
					bottom: <?php $cell->echo_vertical_padding() ?>;
					right: <?php $cell->echo_horizontal_padding() ?>;
					max-height: 90%;
				}
			<?php break;
			case 'bottom-left': ?>
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner{
					text-align: left;
					position: absolute;
					left: <?php $cell->echo_horizontal_padding() ?>;
					right: <?php $cell->echo_horizontal_padding() ?>;
					bottom: <?php $cell->echo_vertical_padding() ?>;
					max-height: 90%;
				}
			<?php break;
			case 'bottom-right': ?>
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner{
				text-align: right;
				position: absolute;
				left: <?php $cell->echo_horizontal_padding() ?>;
				bottom: <?php $cell->echo_vertical_padding() ?>;
				right: <?php $cell->echo_horizontal_padding() ?>;
				max-height: 90%;
				}
			<?php break;
			case 'center': ?>
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner{
				position: absolute;
				top: 50%;
				left: 8%;
				right: 8%;
				-webkit-transform: translate(0, -50%);
				-moz-transform: translate(0, -50%);
				-ms-transform: translate(0, -50%);
				-o-transform: translate(0, -50%);
				transform: translate(0, -50%);
				text-align: center;
				vertical-align: middle;
				max-height: 60%;
				}
				<?php break;
			case 'top-left-bottom-right': ?>
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner{
					height: 100%;
				}
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner .uber-grid-hover-title{
					position: absolute;
					left: <?php $cell->echo_horizontal_padding() ?>;
					top: <?php $cell->echo_vertical_padding() ?>;
					display: block;
				}
				div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner .uber-grid-hover-text{
					position: absolute;
					right: <?php $cell->echo_horizontal_padding() ?>;
					bottom: <?php $cell->echo_vertical_padding() ?>;
					display: block;
				}
				<?php break;
				case 'top-left-bottom-left': ?>
					div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner{
					height: 100%;
					}
					div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner .uber-grid-hover-title{
					position: absolute;
					left: <?php $cell->echo_horizontal_padding() ?>;
					top: <?php $cell->echo_vertical_padding() ?>;
					display: block;
					}
					div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner .uber-grid-hover-text{
					position: absolute;
					left: <?php $cell->echo_horizontal_padding() ?>;
					bottom: <?php $cell->echo_vertical_padding() ?>;
					display: block;
					}
				<?php break;
				case 'top-right-bottom-right': ?>
					div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner{
					height: 100%;
					}
					div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner .uber-grid-hover-title{
					position: absolute;
					right: <?php $cell->echo_horizontal_padding() ?>;
					top: <?php $cell->echo_vertical_padding() ?>;
					display: block;
					}
					div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-hover-inner .uber-grid-hover-text{
					position: absolute;
					right: <?php $cell->echo_horizontal_padding() ?>;
					bottom: <?php $cell->echo_vertical_padding() ?>;
					display: block;
					}
					<?php break;
			default:

			endswitch ?>
	<?php endif ?>
	<?php if ($label['enable']): ?>
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-label{
			background-color: <?php echo uber_grid_color($cell['label']['background_color']) ?>;
			<?php if ($cell['label']['border_top']): ?>
				border-top: <?php echo $cell['label']['border_top'] ?>px solid <?php echo uber_grid_color($cell['label']['border_top_color']) ?>;
			<?php endif ?>
			<?php if ($cell['label']['border_bottom']): ?>
				border-bottom: <?php echo $cell['label']['border_bottom'] ?>px solid <?php echo uber_grid_color($cell['label']['border_bottom_color']) ?>;
			<?php endif ?>
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-label .uber-grid-label-heading,
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-label .uber-grid-price-tag{
			color: <?php echo uber_grid_color($cell['label']['title_color']) ?>;
		}
		div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-label .uber-grid-label-text{
			color: <?php echo uber_grid_color($cell['label']['tagline_color']) ?>;
		}
		<?php if ($cell['label_price_color']): ?>
			div#uber-grid-<?php echo $this->id ?>-cell-<?php echo $i ?> .uber-grid-cell-label .uber-grid-price-tag{
				color: <?php echo uber_grid_color($cell['label']['price_color']) ?>;
			}
		<?php endif ?>
	<?php endif ?>
	<?php $i++ ?>
<?php endforeach ?>
</style>
