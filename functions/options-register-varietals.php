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
add_settings_field('oenology_setting_varietal', 'Available Varietals', 'oenology_setting_varietal', 'oenology', 'oenology_settings_varietal');

/*****************************************************************************************
* Add Section Text for Each Form Section
*******************************************************************************************/

// Varietal Settings Section
function oenology_settings_varietal_section_text() {

	$oenology_options = get_option( 'theme_oenology_options' );
	$oenology_varietals = oenology_get_valid_varietals();
	$imgstyle = 'float:left;margin-right:20px;margin-bottom:20px;border: 1px solid #bbb;-moz-box-shadow: 2px 2px 2px #777;-webkit-box-shadow: 2px 2px 2px #777;box-shadow: 2px 2px 2px #777;';
	foreach ( $oenology_varietals as $varietal ) {
		if ( $varietal['slug'] == $oenology_options['varietal'] ) {
		      $oenology_current_varietal = $varietal;
		}
	} ?>
	<p><?php _e( '"Varietal" refers to wine made from exclusively or predominantly one variety of grape. Each varietal has unique flavor and aromatic characteristics. Refer to the contextual help screen for descriptions and help regarding each theme option.', 'oenology' ); ?></p>
	<img style="<?php echo $imgstyle; ?>" src="<?php echo get_template_directory_uri() . '/varietals/' . $oenology_options['varietal'] . '.png'; ?>" width="150px" height="110px" alt="<?php echo $oenology_options['varietal']; ?>" />
	<h4>Current Varietal</h4>
	<dl>
	<dt><strong><?php echo $oenology_current_varietal['name']; ?></strong></dt>
	<dd><?php echo $oenology_current_varietal['description']; ?></dd>
	</dl> 	
	
<?php }

/*****************************************************************************************
* Add Form Field Markup for Each Theme Option
*******************************************************************************************/

// Varietal Setting
function oenology_setting_varietal() {
	$oenology_options = get_option( 'theme_oenology_options' );
	$oenology_varietals = oenology_get_valid_varietals();
	$dlstylebase = 'float:left;padding:5px;text-align:center;max-width:160px;';
	$dlstylecurrent = 'border: 1px solid #999;-moz-box-shadow: 2px 2px 2px #777;-webkit-box-shadow: 2px 2px 2px #777;box-shadow: 2px 2px 2px #777;';

	foreach ( $oenology_varietals as $varietal ) {
		$currentvarietal = ( $varietal['slug'] == $oenology_options['varietal'] ? true : false );
		$dlstyle = ( $currentvarietal ? $dlstylebase . $dlstylecurrent : $dlstylebase ); ?>
		<dl style="<?php echo $dlstyle; ?>">
		<dt><strong><?php echo $varietal['name']; ?></strong></dt>
		<dd><img style="border: 1px solid #bbb;" src="<?php echo get_template_directory_uri() . '/varietals/' . $varietal['slug'] . '.png'; ?>" width="150px" height="110px" alt="<?php echo $varietal['name']; ?>" /></dd>
		<dd><input type="radio" name="theme_oenology_options[varietal]" <?php checked( $currentvarietal ); ?> value="<?php echo $varietal['slug']; ?>" /></dd>
		<dd><small><?php echo $varietal['description']; ?></small></dd>
		</dl>
	<?php } 
} ?>