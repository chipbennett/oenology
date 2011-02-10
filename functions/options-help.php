<?php

global $text;

if ( isset ( $_GET['tab'] ) ) {
       	$tab = $_GET['tab'];
} else {
       	$tab = 'general';
}
switch ( $tab ) {
       	case 'general' :
       		$tabtext = oenology_get_contextual_help_options_general();
			$text .= $tabtext;
       		break;
       	case 'varietals' :
       		$tabtext = oenology_get_contextual_help_options_varietals();
			$text .= $tabtext;
       		break;
}

function oenology_get_contextual_help_options_general() {

	$tabtext = '';
	/*$tabtext .= "<h2>" . __( 'General Options', 'oenology' ) . "</h2>";
    $tabtext .= "<h3>" . __( 'Header Nav Menu Position', 'oenology' ) . "</h3>";
    $tabtext .= "<p>" . __('The default location of the header navigation menu is above the site title/description. Use this setting to display the header navigation menu below the site title/description.', 'oenology') . "</p>";
    $tabtext .= "<h3>" . __( 'Footer Credit', 'oenology' ) . "</h3>";
    $tabtext .= "<p>" . __('This setting controls the display of a footer credit link. By default, no footer credit link is displayed. You are under no obligation to display a credit link in the footer or anywhere else.', 'oenology') . "</p>";
	*/
	$tabtext .= <<<EOT
	<h2>General Options</h2>
	<h3>Header Nav Menu Position</h3>
	<p>The default location of the header navigation menu is above the site title/description. Use this setting to 
	display the header navigation menu below the site title/description.</p>
	<h3>Footer Credit</h3>
	<p>This setting controls the display of a footer credit link. By default, no footer credit link is displayed. You 
	are under no obligation to display a credit link in the footer or anywhere else.</p>
EOT;
	return $tabtext;
}

function oenology_get_contextual_help_options_varietals() {

	$tabtext = '';
	$tabtext .= "<h2>" . __( 'Varietals', 'oenology' ) . "</h2>";
    $tabtext .= "<p>" . __('"Varietals" are the "skins" or styles applied to Oenology.', 'oenology') . "</p>";
    $oenology_varietals = oenology_get_valid_varietals();
    foreach ( $oenology_varietals as $varietal ) {
	    $tabtext .= "<dl>";
	    $tabtext .= "<dt><strong>" . $varietal['name'] . "</strong></dt>";
	    $tabtext .= "<dd>" . $varietal['description'] . "</dd>";
	    $tabtext .= "</dl>";
	}
	return $tabtext;
}
?>