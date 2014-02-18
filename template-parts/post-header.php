<?php
/**
 * Template part file that contains the Post header content
 *
 * Contains Post date, Post Thumbnail, Post Title, Post
 * Metadata, and Post Taxonomies (Categories and Tags)
 * 
 * @uses 		oenology_hook_post_header_after()		Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_header_before()		Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_header_date()		Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_header_thumbnail()	Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_header_title()		Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_header_metadata()	Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_header_taxonomies()	Defined in /functions/hooks.php
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?>
<?php 
// Fire the 'oenology_hook_post_header_before' custom action hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_header_before'
oenology_hook_post_header_before(); 
?> 
<!-- Post Header Begin -->
<?php 
// Fire the 'oenology_post_header_date' custom filter hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_header_date'
oenology_hook_post_header_date(); 
?>
<?php 
// Fire the 'oenology_hook_post_header_thumbnail' custom filter hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_header_thumbnail'
oenology_hook_post_header_thumbnail(); 
?>
<?php 
// Fire the 'oenology_hook_post_header_title' custom filter hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_header_title'
oenology_hook_post_header_title(); 
?>
<?php 
// Fire the 'oenology_hook_post_header_metadata' custom filter hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_header_metadata'
oenology_hook_post_header_metadata(); 
?>
<?php 
// Fire the 'oenology_hook_post_header_taxonomies' custom filter hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_header_taxonomies'
oenology_hook_post_header_taxonomies(); 
?>
<!-- Post Header End -->

<?php 
// Fire the 'oenology_hook_post_header_after' custom action hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_header_after'
oenology_hook_post_header_after(); 
?> 
