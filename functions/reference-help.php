<?php

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