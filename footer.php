<?php
/**
 * Footer Template Part File
 * 
 * Template part file that contains the site footer and
 * closing HTML body elements
 *
 * This file is called by all primary template pages
 * 
 * Child Themes can override this template part file globally,
 * via "footer.php", or in a given specific context, via
 * "footer-{context}.php". For example, to replace this
 * template part file on static Pages, a Child Theme would
 * include the file "footer-page.php".
 * 
 * @uses 		oenology_hook_extent_after()
 * @uses 		oenology_hook_site_footer()
 * @uses 		oenology_hook_site_footer_after()
 * @uses 		oenology_hook_site_footer_before()
 * @uses 		wp_footer()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?>
	</div>
	<!-- End Content  (div#content)-->
	
	<!-- Begin Footer (div#footer) -->
	<?php
	// div#footer contains the site copyright notice
	// and credit links
	?>
	<div id="footer">

		<?php 
		// Fire the 'oenology_hook_site_footer_before' custom action hook
		// 
		// @param	null
		// @return	mixed	any output hooked into 'oenology_hook_site_footer_before'
		oenology_hook_site_footer_before(); 
		?>

		<?php 
		// Fire the 'oenology_hook_site_footer' custom filter hook
		// 
		// @param	null
		// @return	mixed	filtered output of 'oenology_hook_site_footer'
		oenology_hook_site_footer(); 
		?>

		<?php 
		// Fire the 'oenology_hook_site_footer_after' custom action hook
		// 
		// @param	null
		// @return	mixed	any output hooked into 'oenology_hook_site_footer_after'
		oenology_hook_site_footer_after(); 
		?>
	
	</div>
	<!-- End Footer (div#footer) -->

<?php 
// Fire the 'oenology_hook_extent_after' custom action hook
// 
// @param	null
// @return	mixed	any output hooked into 'oenology_hook_extent_after'
oenology_hook_extent_after(); 
?>

</div>
<!-- End Extent (div#extent) -->

<?php 
// Fire the 'wp_footer' action hook
// 
// Codex reference: {@link http://codex.wordpress.org/Hook_Reference/wp_footer wp_footer}
// 
// This hook is used by WordPress core, Themes, and Plugins to 
// add scripts, CSS styles, meta tags, etc. to the document footer.
// 
// MUST come immediately before the closing </body> tag
// 
// @param	null
// @return	mixed	any output hooked into 'wp_footer'
wp_footer(); 
?>
</body>
</html>