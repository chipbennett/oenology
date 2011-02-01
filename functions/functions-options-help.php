<?php

global $text;

if ( isset ( $_GET['tab'] ) ) {
       	$tab = $_GET['tab'];
} else {
       	$tab = 'general';
}
switch ( $tab ) {
       	case 'general' :
       		$text .= "<h2>" . __( 'General Options', 'oenology' ) . "</h2>";
       		$text .= "<h3>" . __( 'Header Nav Menu Position', 'oenology' ) . "</h3>";
       		$text .= "<p>" . __('The default location of the header navigation menu is above the site title/description. Use this setting to display the header navigation menu below the site title/description.', 'oenology') . "</p>";
       		$text .= "<h3>" . __( 'Footer Credit', 'oenology' ) . "</h3>";
       		$text .= "<p>" . __('This setting controls the display of a footer credit link. By default, no footer credit link is displayed. You are under no obligation to display a credit link in the footer or anywhere else.', 'oenology') . "</p>";
       		break;
       	case 'varietals' :
       		$text .= "<h2>" . __( 'Varietals', 'oenology' ) . "</h2>";
       		$text .= "<p>" . __('"Varietals" are the "skins" or styles applied to Oenology.', 'oenology') . "</p>";
       		$oenology_varietals = oenology_get_valid_varietals();
       		foreach ( $oenology_varietals as $varietal ) {
		      $text .= "<dl>";
		      $text .= "<dt><strong>" . $varietal['name'] . "</strong></dt>";
		      $text .= "<dd>" . $varietal['description'] . "</dd>";
		      $text .= "</dl>";
       		}
       		break;
}

?>