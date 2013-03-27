<?php
/**
 * Template part file that contains the default sidebar content
 *
 * This file is called by all primary template pages
 * 
 * @uses		oenology_get_current_page_layout()	Defined in /functions/custom.php
 * @uses		oenology_get_social_networks()		Defined in /functions/custom.php
 * 
 * @link		http://codex.wordpress.org/Function_Reference/dynamic_sidebar	dynamic_sidebar()
 * @link		http://codex.wordpress.org/Function_Reference/get_bloginfo		get_bloginfo()
 * @link		http://codex.wordpress.org/Function_Reference/get_option		get_option()
 * @link		http://codex.wordpress.org/Function_Reference/get_sidebar		get_sidebar()
 * @link		http://codex.wordpress.org/Function_Reference/has_post_format	has_post_format()
 * @link		http://codex.wordpress.org/Function_Reference/is_active_sidebar	is_active_sidebar()
 * @link		http://codex.wordpress.org/Function_Reference/is_attachment		is_attachment()
 * @link 		http://codex.wordpress.org/Function_Reference/is_front_page		is_front_page()
 * @link		http://codex.wordpress.org/Function_Reference/is_single			is_single()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 2.0
 */
?>
<?php 
// Globalize the variable that contains the
// Theme's options array.
global $oenology_options;

// Do not display sidebars on attachment pages or posts with 
// format-types "gallery", "image", or "video"
if ( in_array( oenology_get_current_page_layout(), array( 'one-column', 'attachment', 'full' ) ) ) {
	return;
}

// Current layout is not three-column
if ( 'three-column' != oenology_get_current_page_layout() ) {

	?>

	<?php 
	/**
	 * Fire the 'oenology_hook_sidebars_before' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_sidebars_before'
	 */
	oenology_hook_sidebars_before(); 
	?>

	<div id="sidebar-doublecol">

		<?php 
		/**
		* Fire the 'oenology_hook_sidebars_top' custom action hook
		* 
		* @param	null
		* @return	mixed	any output hooked into 'oenology_hook_sidebars_top'
		*/
		oenology_hook_sidebars_top(); 
		?>

	<?php

	// Only display div#doublecoltop if dynamic sidebar 
	// 'sidebar-column-top is active, or if the Theme is 
	// set to display social icons
	if 
	( 
		// WordPress conditional tag that returns true if the 
		// specified dynamic sidebar is active (has Widgets
		// assigned to it)
		is_active_sidebar( 'sidebar-column-top' ) 
		// Boolean Theme option
	 || $oenology_options['display_social_icons'] 
	) { 
		?>
		<?php
		// div#doublecoltop is the top, right-colum content in the two-column
		// layout. It displays only on static Pages, including static Page as
		// Front Page, and is a double-width column, and displays above the 
		// single-width columns div#leftcol and div#rightcol.
		// 
		// Includes social icons, and the 'sidebar-column-top' dynamic sidebar,
		// and displays only if this dynamic sidebar is active (has Widgets 
		// assigned to it), or if the Theme is set to display social icons.
		?>
		<div id="doublecoltop">
		<?php
		// If Theme option is set to display social icons
		if ( $oenology_options['display_social_icons'] ) {
			oenology_social_icons();
		} 
		?>
		<!-- Begin Sidebar Top Widget Area-->
		<?php 
		// Output a dynamic sidebar
		// 
		// Codex reference: {@link http://codex.wordpress.org/Function_Reference/dynamic_sidebar}
		// 
		// Outputs the specified dynamic sidebar. A dynamic sidebar 
		// is used to output Widgets as specified by the user.
		dynamic_sidebar( 'sidebar-column-top' );
		?>
		<!-- End Sidebar Top Widget Area-->
		</div>
		<?php 
	}
}
?>

<!-- Begin Left Column (div#leftcol) -->
<?php
// div#leftcol contains the left column content of the three-column 
// layout. For the Blog Posts Index, div#rightcol and div#leftcol both
// appear to the right of the main content column. For static Pages,
// including a static Page as Front Page, div#leftcol is to the left, 
// and div#rightcol is to the right, with div#main in the center.
// 
// Includes the 'sidebar-left' dynamic sidebar
?>
<div id="leftcol">
<!-- Begin Left Column Widget Area-->
	<?php 
	// Display default sidebar content if the following conditions are true:
	//  - Dynamic sidebar 'sidebar-right' is not active, AND
	//  - A static Page as Front Page is not being displayed
	if ( 
	// WordPress conditional tag that returns true if the 
	// specified dynamic sidebar is active
	! dynamic_sidebar( 'sidebar-left' ) 
	&& ! ( 
		// WordPress conditional tag that returns true if 
		// the current page is the Front Page
			is_front_page() 
		// Returns true if the Front Page is set to display a 
		// static Page
		&& 'page' == get_option('show_on_front') ) 
	) {
		// Calls a sidebar template part file.
		// Used in all primary template pages.
		//
		// Codex reference: http://codex.wordpress.org/Function_Reference/get_sidebar
		// 
		// Child Themes can replace this template part file globally, 
		// via "sidebar-left.php"
		get_sidebar( 'left' ); 
	} 
	?>
	<!-- End Left Column Widget Area-->
</div>
<!-- End Left Column (div#leftcol) -->

<!-- Begin Right Column (div#rightcol) -->
<?php
// div#rightcol contains the right column content of the three-column 
// layout. For the Blog Posts Index, div#rightcol and div#leftcol both
// appear to the right of the main content column. For static Pages,
// including a static Page as Front Page, div#leftcol is to the left, 
// and div#rightcol is to the right, with div#main in the center.
// 
// Includes the 'sidebar-right' dynamic sidebar
?>
<div id="rightcol">
<!-- Begin Right Column Widget Area-->
	<?php 
	// Display default sidebar content if the following conditions are true:
	//  - Dynamic sidebar 'sidebar-right' is not active, AND
	//  - A static Page as Front Page is not being displayed
	if ( 
	   // WordPress conditional tag that returns true if the 
	   // specified dynamic sidebar is active
	   ! dynamic_sidebar( 'sidebar-right' ) 
	&& ! ( 
		   // WordPress conditional tag that returns true if the 
		   // current page is the Front Page
			  is_front_page() 
		   // Returns true if the Front Page is set to display a 
		   // static Page
		   && 'page' == get_option('show_on_front') ) 
	) {
		// Calls a sidebar template part file.
		// Used in all primary template pages.
		//
		// Codex reference: http://codex.wordpress.org/Function_Reference/get_sidebar
		// 
		// Child Themes can replace this template part file globally, 
		// via "sidebar-right.php"
		get_sidebar( 'right' ); 
	} 
	?>
	<!-- End Right Column Widget Area -->
</div>
<!-- End Right Column (div#rightcol) -->		
<?php 
// Current page layout is not three-column
if ( 'three-column' != oenology_get_current_page_layout() ) {

	// WordPress conditional tag that returns true if the 
	// specified dynamic sidebar is active (has Widgets
	// assigned to it)
	if ( is_active_sidebar( 'sidebar-column-bottom' ) ) {
		// div#doublecolbottom is the bottom, right-colum content in the two-column
		// layout. It displays only on static Pages, including static Page as
		// Front Page, and is a double-width column, and displays above the 
		// single-width columns div#leftcol and div#rightcol.
		// 
		// Includes sthe 'sidebar-column-bottom' dynamic sidebar, and displays only
		// if this sidebar is active (has Widgets assigned to it).
		?>
		<div id="doublecolbottom">
			<!-- Begin Sidebar Bottom Widget Area-->
			<?php 
			// Output a dynamic sidebar
			// 
			// Codex reference: {@link http://codex.wordpress.org/Function_Reference/dynamic_sidebar}
			// 
			// Outputs the specified dynamic sidebar. A dynamic sidebar 
			// is used to output Widgets as specified by the user.
			dynamic_sidebar( 'sidebar-column-bottom' ); 
			?>
			<!-- End Sidebar Bottom Widget Area-->
		</div>		
		<?php 
	}
	?>

		<?php 
		/**
		* Fire the 'oenology_hook_sidebars_bottom' custom action hook
		* 
		* @param	null
		* @return	mixed	any output hooked into 'oenology_hook_sidebars_bottom'
		*/
		oenology_hook_sidebars_bottom(); 
		?>

	</div>

	<?php 
	/**
	 * Fire the 'oenology_hook_sidebars_after' custom action hook
	 * 
	 * @param	null
	 * @return	mixed	any output hooked into 'oenology_hook_sidebars_after'
	 */
	oenology_hook_sidebars_after(); 
	?>

	<?php
}
?>