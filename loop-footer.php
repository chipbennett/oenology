<?php
/**
 * Template part file that contains the Loop footer content
 *
 * Contains Posts index pagination links
 * 
 * @uses		oenology_hook_loop_footer()	Defined in /functions/hooks.php
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/is_singular		is_singular()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?>
<?php 
if ( 
/**
 * WordPress conditional tag that returns true if
 * the current Page is a Single Blog Post, Static
 * Page, or an Attachment Page
 */
! is_singular() 
) { 
	?>
	<ul>
		<li id="bottompostnav">
		<?php 
		/**
		 * Fire the 'oenology_hook_loop_footer' custom filter hook
		 * 
		 * @param	null
		 * @return	mixed	any output hooked into 'oenology_hook_loop_footer'
		 */
		oenology_hook_loop_footer(); 
		?>
		</li>
	</ul>
	<?php 
} 
?>