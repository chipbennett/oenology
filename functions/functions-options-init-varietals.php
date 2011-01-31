<?php 
/*****************************************************************************************
* Add Theme Settings Form Sections
*******************************************************************************************/
	
// Add a form section for the General theme settings
add_settings_section('oenology_settings_varietal', 'Varietal', 'oenology_settings_varietal_section_text', 'oenology');
	
/*****************************************************************************************
* Add Form Fields to General Settings Section
*******************************************************************************************/
	
// Add Header Navigation Menu Position setting to the General section
add_settings_field('oenology_setting_varietal', 'Varietal', 'oenology_setting_varietal', 'oenology', 'oenology_settings_varietal');

/*****************************************************************************************
* Add Section Text for Each Form Section
*******************************************************************************************/

// Varietal Settings Section
function oenology_settings_varietal_section_text() { ?>
	<p><?php _e( '"Varietal" refers to wine made from exclusively or predominantly one variety of grape. Each varietal has unique flavor and aromatic characteristics.', 'oenology' ); ?></p>
<?php }

/*****************************************************************************************
* Add Form Field Markup for Each Theme Option
*******************************************************************************************/

// Varietal Setting
function oenology_setting_varietal() {
	$oenology_options = get_option( 'theme_oenology_options' ); ?>
	<p>
		<label for="oenology_varietal">
			Select a varietal<br />
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