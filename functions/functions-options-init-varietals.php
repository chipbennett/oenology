<?php 
/*****************************************************************************************
* Add Theme Settings Form Sections
*******************************************************************************************/
	
// Add a form section for the General theme settings
add_settings_section('oenology_settings_varietal', 'Oenology Theme Varietals', 'oenology_settings_varietal_section_text', 'oenology');
	
/*****************************************************************************************
* Add Form Fields to General Settings Section
*******************************************************************************************/
	
// Add Header Navigation Menu Position setting to the General section
add_settings_field('oenology_setting_varietal', 'Varietal', 'oenology_setting_varietal', 'oenology', 'oenology_settings_varietal');

/*****************************************************************************************
* Add Section Text for Each Form Section
*******************************************************************************************/

// Varietal Settings Section
function oenology_settings_varietal_section_text() {

	$oenology_options = get_option( 'theme_oenology_options' );?>
	<h4>Current Varietal</h4>
	<img style="float:left;margin-right:20px;margin-bottom:20px;" src="<?php echo get_template_directory_uri() . '/varietals/' . $oenology_options['varietal'] . '.png'; ?>" width="150px" height="110px" alt="<?php echo $oenology_options['varietal']; ?>" />
	<p><?php _e( '"Varietal" refers to wine made from exclusively or predominantly one variety of grape. Each varietal has unique flavor and aromatic characteristics. Refer to the contextual help screen for descriptions and help regarding each theme option.', 'oenology' ); ?></p>
	<h4 style="clear:both;">Available Varietals</h4>
	<?php
	$oenology_varietals = oenology_get_valid_varietals(); 
	
	foreach ( $oenology_varietals as $varietal => $name ) { ?>
		<dl style="float:left;">
		<dt><?php echo $name; ?></dt>
		<dd><img src="<?php echo get_template_directory_uri() . '/varietals/' . $varietal . '.png'; ?>" width="150px" height="110px" alt="<?php echo $name; ?>" /></dd>
		</dl>
	<?php } 	
	
}

/*****************************************************************************************
* Add Form Field Markup for Each Theme Option
*******************************************************************************************/

// Varietal Setting
function oenology_setting_varietal() {
	$oenology_options = get_option( 'theme_oenology_options' ); ?>	
	<p>
		<label for="oenology_varietal">
			<select name="theme_oenology_options[varietal]">
				<?php
				$oenology_varietals = oenology_get_valid_varietals();
				foreach ( $oenology_varietals as $varietal => $name ) { ?>
					<option <?php selected( $varietal == $oenology_options['varietal'] ); ?> value="<?php echo $varietal; ?>"><?php echo $name; ?></option>
				<? } ?>
			</select>
		</label>
	</p>
<?php }

?>