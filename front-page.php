<?php
/**
 * Front Page template file
 *
 * This file is the Front Page template file, used to display the site
 * Front Page, whether the Front Page is set to display a static Page
 * or the Blog Posts Index.
 * 
 * @link		http://codex.wordpress.org/Function_Reference/get_header 			get_header()
 * @link 		http://codex.wordpress.org/Function_Reference/get_footer 			get_footer()
 * @link 		http://codex.wordpress.org/Function_Reference/get_sidebar 			get_sidebar()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_part 	get_template_part()
 * @link 		http://codex.wordpress.org/Function_Reference/is_active_sidebar 	is_active_sidebar()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 2.0
 */

?>

<?php
if ( 'page' == get_option( 'show_on_front' ) ) {
	include( get_page_template() );
} else {
	include( get_home_template() );
}
?>