<?php
/**
 * Template part file that contains the default left-column dynamic sidebar content
 *
 * This file is called by all primary template pages
 * 
 * @uses		oenology_get_widget_args()	Defined in /functions/widgets.php
 * 
 * @link		http://codex.wordpress.org/Function_Reference/the_widget	the_widget()
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
 * Output default widgets, using the_widget()
 *  
 * Codex reference: {@link: http://codex.wordpress.org/Function_Reference/the_widget the_widget}
 *  
 * Used to output a Widget anywhere within a Theme. This tag allows Widgets to be
 * displayed outside of a Widgetized sidebar. The tag can also be used to output 
 * "default" Widgets that will display in a defined Widgetized sidebar location 
 * if no Widgets are defined (by the user) to appear in the sidebar.
 */

/**
 * Output "Oenology Categories" custom widget
 * 
 * Outputs the custom Widget "Oenology Categories", with the Widget name as Title.
 *  
 * @uses	the_widget()
 * 
 * @param	string	$widget		name of the Widget to output; default: none
 * @param	string	$instance	Widget instance settings (e.g. Title); default: none
 * @param	array	$args		Widget arguments (before_widget, after_widget, before_title,after_title, etc.)
 * 
 * @return	mixed	Widget output
 */
the_widget( 'oenology_widget_categories' , array( 'title=Oenology Categories' ), oenology_get_widget_args() );


/**
 * Output "Oenology Tags" custom widget
 * 
 * Outputs the custom Widget "Oenology Tags", with the Widget name as Title.
 *  
 * @uses	the_widget()
 * 
 * @param	string	$widget		name of the Widget to output; default: none
 * @param	string	$instance	Widget instance settings (e.g. Title); default: none
 * @param	array	$args		Widget arguments (before_widget, after_widget, before_title,after_title, etc.)
 * 
 * @return	mixed	Widget output
 */
the_widget( 'oenology_widget_tags' , array( 'title=Oenology Tags' ), oenology_get_widget_args() );


/**
 * Output "Oenology Post Formats" custom widget
 * 
 * Outputs the custom Widget "Oenology Post Formats", with the Widget name as Title.
 *  
 * @uses	the_widget()
 * 
 * @param	string	$widget		name of the Widget to output; default: none
 * @param	string	$instance	Widget instance settings (e.g. Title); default: none
 * @param	array	$args		Widget arguments (before_widget, after_widget, before_title,after_title, etc.)
 * 
 * @return	mixed	Widget output
 */
the_widget( 'oenology_widget_post_formats' , array( 'title=Oenology Post Formats' ), oenology_get_widget_args() );