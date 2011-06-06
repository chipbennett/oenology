<?php
/**
 * Oenology Theme Reference Contextual Help
 *
 * This file defines the Theme Reference contextual help content 
 * for the Oenology Theme.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

// Globalize the variable that holds
// the contextual text content
global $text;

if ( isset ( $_GET['tab'] ) ) {
       	$tab = $_GET['tab'];
} else {
       	$tab = 'general';
}
switch ( $tab ) {
       	case 'general' :
       		$text .= "General Theme notes";
       		break;
       	case 'faq' :
       		$text .= "Answers to questions frequently (or not-so-frequently) asked";
       		break;
       	case 'coderef' :
       		$text .= "A cross-reference of every WordPress function, hook, and global variable used in the Theme";
       		break;
       	case 'changelog' :
       		$text .= "Log of changes to the Theme";
       		break;
}

?>