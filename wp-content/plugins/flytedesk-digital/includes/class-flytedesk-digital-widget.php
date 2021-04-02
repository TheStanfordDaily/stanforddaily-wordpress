<?php

namespace Flytead;

/**
 * The file that defines our widget class
 *
 * A class definition for our custom widget type.
 *
 * @link       https://www.flytedesk.com
 * @since      20181101
 *
 * @package    Flytedesk_Digital
 * @subpackage Flytedesk_Digital/includes
 */

/**
 * The widget class.
 *
 * This is used to define the custom widget used in this plugin.
 *
 *
 * @since      20181101
 * @package    Flytedesk_Digital
 * @subpackage Flytedesk_Digital/includes
 * @author     Flytedesk <help@flytedesk.com>
 */
class Flytedesk_Digital_Widget extends \WP_Widget {
	CONST CLASS_NAME = 'flytead';
	CONST DEFAULT_TYPE = 'leaderboard';
	CONST UNIT_TYPES = [
		'Leaderboard' => 'leaderboard',
		'Medium Rectangle' => 'rectangle',
		'Small Rectangle' => 'small_rectangle',
		'Large Rectangle' => 'large_rectangle',
		'Skyscraper' => 'skyscraper',
		'Wide Skyscraper' => 'wide_skyscraper',
		'Vertical Banner' => 'vertical_banner',
		'Square' => 'square',
		'Half Page' => 'halfpage'
	];

	public function __construct() {
		$widget_options = ['classname' => 'flytedesk_ad_unit', 'description' => 'Flytedesk digital advertising unit'];
		parent::__construct('flytedesk_ad_unit', 'Flytedesk Ad Unit', $widget_options);
	}

	public function widget($args, $instance) {
		$type = !empty($instance['unit_type']) ? $instance['unit_type'] : self::DEFAULT_TYPE;
		$classes = self::CLASS_NAME . ' ' . $type;
		echo $args['before_widget'] . "<div class=\"$classes\"></div>" . $args['after_widget'];
	}

	// Create the admin area widget settings form.
	public function form($instance) {
		$type = !empty($instance['unit_type']) ? $instance['unit_type'] : self::DEFAULT_TYPE;
		$title = !empty($instance['title']) ? $instance['title'] : ''; ?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('unit_type'); ?>">Ad Unit Type:</label>
			<select id="<?php echo $this->get_field_id('unit_type'); ?>" name="<?php echo $this->get_field_name('unit_type'); ?>">
				<?php
					foreach (self::UNIT_TYPES as $type_name => $type_class) {
						$selected = ($type === $type_class) ? 'selected' : '';
						echo "<option value=\"$type_class\" $selected>$type_name</option>\n";
					}
				?>
			</select>
		</p>
		<?php
	}

	// Apply settings to the widget instance.
	public function update($new_instance, $old_instance) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['unit_type'] = $new_instance['unit_type'];
		return $instance;
	}
}
