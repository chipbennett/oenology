<?php
/*
Template Name: Sidebar-Right
*/
?>

<!-- Begin Right Column Widget Area-->
<?php if ( !dynamic_sidebar( 'sidebar-right' ) ) {

$widgetsidebarrightargs = array(
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<div class="title widgettitle">',
	'after_title' => '</div>'
);

the_widget('WP_Widget_Calendar' , 'title=' , $widgetsidebarrightargs );
the_widget( 'oenology_widget_linkrollbycat' , 'title=Oenology Links by Cat' , $widgetsidebarrightargs );
the_widget('WP_Widget_Meta' , 'title=Meta' , $widgetsidebarrightargs );

} ?>
<!-- End Right Column Widget Area -->
<?php /*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
dynamic_sidebar()
----------------------------------
dynamic_sidebar() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/dynamic_sidebar

dynamic_sidebar() is used to insert widgetized areas ("sidebars") into a Theme.
dynamic_sidebar( 'foo' ) will insert a dynamic sidebar named "foo".

Dynamic sidebars must be defined and registered. Refer to functions.php for more information.

***********************
the_widget()
----------------------------------
the_widget() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_widget

the_widget() is used to output a Widget anywhere within a Theme. This tag allows Widgets to be
displayed outside of a Widgetized sidebar. The tag can also be used to output "default" Widgets that will 
display in a defined Widgetized sidebar location if no Widgets are defined (by the user) to appear in
the sidebar.

the_widget( 'WP_Widget_Calendar' ) will display the Calendar Widget.

the_widget( $widget, $instance, $args ) accepts 3 arguments:
 - $widget: name of the Widget to be output (can be a core Widget, such as WP_Widget_Calendar, or a custom, Theme-defined Widget)
 - $instance: Widget instance settings (e.g. Title)
 - $args:  Widget arguments (before_widget, after_widget, before_title,after_title, etc.)

the_widget() can be used anywhere within a template.

=============================================================================
*/ ?>