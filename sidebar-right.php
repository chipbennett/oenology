<?php
/**
 * Template part file that contains the default right-column dynamic sidebar content
 *
 * This file is called by all primary template pages
 * 
 * @uses 		the_widget()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?>
<?php
// Output default widgets, using the_widget()
// 
// Codex reference: {@link: http://codex.wordpress.org/Function_Reference/the_widget the_widget}
// 
// Used to output a Widget anywhere within a Theme. This tag allows Widgets to be
// displayed outside of a Widgetized sidebar. The tag can also be used to output 
// "default" Widgets that will display in a defined Widgetized sidebar location 
// if no Widgets are defined (by the user) to appear in the sidebar.
// 
// @param	string	$widget		name of the Widget to output; default: none
// @param	string	$instance	Widget instance settings (e.g. Title); default: none
// @param	array	$args		Widget arguments (before_widget, after_widget, before_title,after_title, etc.)
// 
// @return	mixed	Widget output
//
// Calls the core "Calendar" Widget, with no Title
the_widget('WP_Widget_Calendar' , 'title=' , oenology_get_widget_args() );
// Calls the custom Widget "Oenology Links by Cat", with Widget name as Title
the_widget( 'oenology_widget_linkrollbycat' , 'title=Oenology Links by Cat' , oenology_get_widget_args() );
// Calls the core "Meta" Widget, with "Meta" as Title
the_widget('WP_Widget_Meta' , 'title=Meta' , oenology_get_widget_args() );
?>