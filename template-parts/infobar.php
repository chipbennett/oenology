<?php
/**
 * Template part file that contains the Infobar content
 *
 * Includes the navigation breadcrumb, Login/Admin links, and search form.
 * 
 * @uses 		oenology_breadcrumb()			Defined in /functions/custom.php
 * @uses 		oenology_infobar_navigation()	Defined in /functions/custom.php
 * 
 * @link 		function_exists()
 * @link 		yoast_breadcrumb()
 * @link 		is_user_logged_in()
 * @link 		wp_get_current_user()
 * @link 		wp_register()
 * @link 		wp_loginout()
 * @link 		get_search_form()
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
 * @todo	move documentation inline
 */
?>
<ul class="infobar-items">
	<?php 
	if ( 
	//
	//
	function_exists('yoast_breadcrumb') 
	) {
		//
		//
		yoast_breadcrumb('<li id="breadcrumbs" class="infobar-item">','</li>');
	} else {
		//
		//
		oenology_breadcrumb();
	} 
	?>
	<li id="infobar-nav" class="infobar-item">
		<?php 
		//
		//
		oenology_infobar_navigation(); 
		?>
	</li>
    <li id="infobar-login" class="infobar-item">
    <?php 
	if ( 
	//
	//
	is_user_logged_in() 
	) {
		//
		//
		wp_get_current_user();
		//
		//
		global $current_user;
		echo $current_user->display_name;
		echo ' | ';
		//
		//
		wp_register('','');
		echo ' | ';
    }
	//
	//
    wp_loginout(); ?>
    </li>
    <li id="infobar-search" class="infobar-item">
      <?php 
	  //
	  //
	  get_search_form(); 
	  ?>
    </li>
</ul>