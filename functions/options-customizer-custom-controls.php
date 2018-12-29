<?php
/**
 * Oenology Options Theme Customizer Integration
 *
 * This file registers custom controls for the
 * Theme Customizer
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2015, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 3.4
 */

/**
 * Oenology Theme Customizer Custom Controls
 *
 * Add custom controls to the Theme Customizer.
 * 
 * @param 	object	$wp_customize	Object that holds the customizer data.
 * 
 * @link	http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/	Otto
 */
function oenology_customizer_custom_controls( $wp_customize ){
	// Failsafe is safe.
	if ( ! isset( $wp_customize ) ) {
		return;
	}	
	/**
	 * Create a Radio-Image control
	 * 
	 * This class incorporates code from the Kirki Customizer Framework
	 * and from a tutorial written by Otto Wood
	 * 
	 * The Kirki Customizer Framework, @copyright Aristeides Stathopoulos (@aristath),
	 * is licensed under the terms of the GNU GPL, Version 2 (or later)
	 * 
	 * @link	https://github.com/reduxframework/kirki/
	 * @link	http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
	 */
	class Oenology_Custom_Radio_Image_Control extends WP_Customize_Control {
		/**
		 * Declare radio-image as control type
		 * 
		 * @var string $type	Type of customizer control; radio-image.
		 */
		public $type = 'radio-image';
		/**
		 * The markup for the label.
		 */
		public function label() {
			// The label has already been sanitized in the Fields class, no need to re-sanitize it.
			echo '<span class="customize-control-title">';
			echo $this->label;
			echo '</span>';
		}
		/**
		 * Markup for the field's description
		 */
		public function description() {
			if ( ! empty( $this->description ) ) {
				// The description has already been sanitized in the Fields class, no need to re-sanitize it.
				echo '<span class="description customize-control-description">' . $this->description . '</span>';
			}
		}
		/**
		 * Markup for the field's title
		 */
		public function title() {
			$this->label();
			$this->description();
		}
		/**
		 * Render content
		 */
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}				
			$name = '_customize-radio-' . $this->id;
			?>
			<?php $this->title(); ?>
			<div id="input_<?php echo $this->id; ?>" class="image">
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $this->id . $value; ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
						<label for="<?php echo $this->id . $value; ?>">
							<img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?> title="<?php echo esc_attr( $value ); ?>">
						</label>
					</input>
				<?php endforeach; ?>
			</div>
			<script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
			<?php
		}
	}
}
// Hook custom controls into 'customizer_register'.
add_action( 'customize_register', 'oenology_customizer_custom_controls' );

/**
 * Add CSS for custom controls
 * 
 * This function incorporates CSS from the Kirki Customizer Framework
 * 
 * The Kirki Customizer Framework, @copyright Aristeides Stathopoulos (@aristath),
 * is licensed under the terms of the GNU GPL, Version 2 (or later)
 * 
 * @link	https://github.com/reduxframework/kirki/
 */
function oenology_customizer_custom_control_css() {	
	?>
	<style>
	.customize-control-radio-image .image.ui-buttonset input[type=radio] {
		height: auto; 
	}
	.customize-control-radio-image .image.ui-buttonset label {
		display: inline-block;
		margin-right: 5px;
		margin-bottom: 5px; 
	}
	.customize-control-radio-image .image.ui-buttonset label.ui-state-active {
		background: none;
	}
	.customize-control-radio-image .customize-control-radio-buttonset label {
		padding: 5px 10px;
		background: #f7f7f7;
		border-left: 1px solid #dedede;
		line-height: 35px; 
	}
	.customize-control-radio-image label img {
		border: 1px solid #bbb;
		opacity: 0.5;
	}
	#customize-controls .customize-control-radio-image label img {
		max-width: 50px;
		height: auto;
	}
	.customize-control-radio-image label.ui-state-active img {
		background: #dedede; 
		border-color: #000; 
		opacity: 1;
	}
	.customize-control-radio-image label.ui-state-hover img {
		opacity: 0.9;
		border-color: #999; 
	}
	.customize-control-radio-buttonset label.ui-corner-left {
		border-radius: 3px 0 0 3px;
		border-left: 0; 
	}
	.customize-control-radio-buttonset label.ui-corner-right {
		border-radius: 0 3px 3px 0; 
	}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'oenology_customizer_custom_control_css' );
/**
 * Enqueue scripts for custom controls
 */
 function oenology_customizer_custom_control_scripts() {
	wp_enqueue_script( 'jquery-ui-button' );
 }
 add_action( 'customize_controls_enqueue_scripts', 'oenology_customizer_custom_control_scripts' );