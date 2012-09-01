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
 * @uses 		oenology_hook_extent_after()		Defined in /functions/hooks.php
 * @uses 		oenology_hook_site_footer()			Defined in /functions/hooks.php
 * @uses 		oenology_hook_site_footer_after()	Defined in /functions/hooks.php
 * @uses 		oenology_hook_site_footer_before()	Defined in /functions/hooks.php
 * 
 * @link 		http://codex.wordpress.org/Function_Reference/has_nav_menu	has_nav_menu()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_footer		wp_footer()
 * @link 		http://codex.wordpress.org/Function_Reference/wp_nav_menu	wp_nav_menu()
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

	<?php 
	/**
	 * Fire the 'oenology_hook_content_after' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_content_after'
	 */
	oenology_hook_content_after(); 
	?>

	<?php 
	/**
	 * Fire the 'oenology_hook_site_footer_before' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_site_footer_before'
	 */
	oenology_hook_site_footer_before(); 
	?>
	
	<!-- Begin Footer (div#footer) -->
	<?php
	// div#footer contains the site copyright notice
	// and credit links
	?>
	<div id="footer">
	
		<?php
		/**
		 * Output the footer navigation menu
		 * 
		 * If the user has defined a custom navigation menu
		 * and has applied that menu to the 'nav-footer'
		 * theme location, then output that menu. Otherwise,
		 * output nothing.
		 * 
		 * The menu will output only one level of Page
		 * hierarchy.
		 */
		if ( 
		/**
		 * WordPress conditional tag that returns true if
		 * the user has applied a custom navigation menu 
		 * to the specified theme location
		 */
		has_nav_menu( 'nav-footer' ) 
		) { 
			/**
			 * Output a custom navigation menu
			 * 
			 * Output a custom navigation menu
			 * according to the parameters
			 * specified by the options array
			 * 
			 * @param	array	options defining menu output
			 */
			wp_nav_menu( array( 
				// apply 'id="footernav"' to the <ul> tag that 
				// contains the menu
				'menu_id' => 'footernav', 
				// apply 'class="nav-footer"' to the <ul> 
				// tag that contains the menu
				'menu_class' => 'nav-footer', 
				// Use the default fallback if the user has 
				// not applied a menu to the specified theme 
				// location
				'fallback_cb' => '', 
				// Apply one level of hierarchical depth
				'depth' => 1, 
				// Output the menu the user has applied to
				// the 'nav-footer' Theme Location
				'theme_location' => 'nav-footer' 
			) ); 
		}
		?>

		<?php 
		// Fire the 'oenology_hook_site_footer_text_before' custom action hook
		// 
		// @param	null
		// @return	mixed	any output hooked into 'oenology_hook_site_footer_text_before'
		oenology_hook_site_footer_text_before(); 
		?>

		<?php 
		// Fire the 'oenology_hook_site_footer' custom filter hook
		// 
		// @param	null
		// @return	mixed	filtered output of 'oenology_hook_site_footer'
		oenology_hook_site_footer(); 
		?>

		<?php 
		// Fire the 'oenology_hook_site_footer_text_after' custom action hook
		// 
		// @param	null
		// @return	mixed	any output hooked into 'oenology_hook_site_footer_text_after'
		oenology_hook_site_footer_text_after(); 
		?>
	
	</div>
	<!-- End Footer (div#footer) -->

	<?php 
	/**
	 * Fire the 'oenology_hook_site_footer_after' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_site_footer_after'
	 */
	oenology_hook_site_footer_after(); 
	?>

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