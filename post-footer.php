<?php
/**
 * Template part file that contains the Post footer content
 *
 * Contains author avatar, footer metadata, and footer license
 * 
 * @uses 		oenology_hook_post_footer_after()		Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_footer_avatar()		Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_footer_before()		Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_footer_license()		Defined in /functions/hooks.php
 * @uses 		oenology_hook_post_footer_metadata()	Defined in /functions/hooks.php
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?>
<?php 
// Fire the 'oenology_hook_post_footer_before' custom action hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_footer_before'
oenology_hook_post_footer_before(); 
?>
<!-- Post footer Begin -->
<div class="postmetadata">
	<?php 
	// Fire the 'oenology_hook_post_footer_avatar' custom action hook
	// 
	// @param	null
	// @return	mixed	any output hooked into 'oenology_hook_post_footer_avatar'
	oenology_hook_post_footer_avatar(); 
	?>
	<?php 
	// Fire the 'oenology_hook_post_footer_metadata' custom action hook
	// 
	// @param	null
	// @return	mixed	any output hooked into 'oenology_hook_post_footer_metadata'
	oenology_hook_post_footer_metadata(); 
	?>
	<?php 
	// Fire the 'oenology_hook_post_footer_license' custom action hook
	// 
	// @param	null
	// @return	mixed	any output hooked into 'oenology_hook_post_footer_license'
	oenology_hook_post_footer_license(); 
	?>
</div>
<!-- Post Footer End -->
<?php 
// Fire the 'oenology_hook_post_footer_after' custom action hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_post_footer_after'
oenology_hook_post_footer_after(); 
?>