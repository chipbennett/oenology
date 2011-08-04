<?php
/**
 * Default Page template file
 *
 * This file is the default Page template file, used to display static
 * Pages if no custom Page template is defined.
 * 
 * @link		http://codex.wordpress.org/Function_Reference/get_header 			get_header()
 * @link 		http://codex.wordpress.org/Function_Reference/get_footer 			get_footer()
 * @link 		http://codex.wordpress.org/Function_Reference/get_sidebar 			get_sidebar()
 * @link 		http://codex.wordpress.org/Function_Reference/get_template_part 	get_template_part()
 * @link 		http://codex.wordpress.org/Function_Reference/is_attachment			is_attachment()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?>

<?php
/**
 * Global variable that contains the
 * Theme's options array.
 * 
 * @global array	$oenology_options
 */
global $oenology_options;
$layout = $oenology_options['default_static_page_layout'];

/**
 * Include the template file for the default layout
 */
get_template_part( 'page', $layout );
?>