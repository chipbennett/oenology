<?php
/**
 * Template part file that contains the Loop header content
 *
 * Contains Archive name (single category title, single tag
 * title, Archive date, post format title, etc.), search
 * query, etc., as well as a description of the taxonomy, 
 * if provided.
 * 
 * @uses 		oenology_hook_loop_header()	Defined in /functions/hooks.php
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
 * Fire the 'oenology_hook_loop_header' custom action hook
 * 
 * @param	null
 * @return	mixed	any output hooked into 'oenology_hook_loop_header'
 */
oenology_hook_loop_header(); 
?>