<?php
/*
Template Name: Sidebar-Left
*/
?>
<!-- Page Subnavigation Menu -->
<?php if ( is_page() ) { // display the sidebar-left widget area only on pages
	
	if ( has_nav_menu( 'nav-sidebar' ) ) { // If a nav menu named 'nav-sidebar' is configured, output it
		wp_nav_menu( array( 
			'container' => '',
			'container_class' => 'nav-sidebar', 
			'menu_id' => 'nav', 
			'menu_class' => 'subnavmenu', 
			'fallback_cb' => '', 
			'depth' => 4, 
			'theme_location' => 'nav-sidebar' 
		) ); 
	} else { // otherwise, output wp_list_pages ?>
			<ul class="subnavmenu">
			<?php wp_list_pages('depth=4&sort_column=menu_order&title_li=');
				// depth=4 indicates that four levels of hierarchy of pages (i.e. three levels of child pages) will be displayed
				// sort_column=menu_order indicates that the pages will be sorted as defined by the user in the Pages administration panel
				// title_li= (blank) indicates that the list will not be wrapped in <ul> tags, and the <li> tags will not be given a title				
				// NOTE: list items are set to overflow:hidden. Long page titles will be cut off, but the full Page Title will display in the tooltip?>
			</ul>
<?php }
}
if ( ! is_page() ) { // don't display the sidebar-left widget area on pages ?>
<!-- Begin Left Column Widget Area-->
<?php if ( !dynamic_sidebar( 'sidebar-left' ) ) {

$widgetsidebarleftargs = array(
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<div class="title widgettitle">',
	'after_title' => '</div>'
);

the_widget( 'oenology_widget_recentposts' , 'title=Oenology Recent Posts' , $widgetsidebarleftargs );
the_widget( 'oenology_widget_archives' , 'title=Oenology Recent Posts' , $widgetsidebarleftargs );
the_widget( 'oenology_widget_categories' , 'title=Oenology Categories' , $widgetsidebarleftargs );
the_widget( 'oenology_widget_tags' , 'title=Oenology Tags' , $widgetsidebarleftargs );
the_widget( 'oenology_widget_post_formats' , 'title=Oenology Post Formats' , $widgetsidebarleftargs );

} ?>
<!-- End Left Column Widget Area--><?php } 
 /*
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
has_nav_menu()
----------------------------------
has_nav_menu() is a WordPress template conditional tag.
Codex reference: N/A

has_nav_menu( $menu ) is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a nav_menu named $menu has been configured by the user; otherwise it returns false.

has_nav_menu() is useful for defining a fallback option for a navigation menu, in case the
user does not define a particular nav menu in the Menus administration panel.

***********************
is_page()
----------------------------------
is_page() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_page

is_page() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a page ("page" post-type) is currently displayed.

A page corresponds to the page.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="page".

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

***********************
wp_list_pages()
----------------------------------
wp_list_pages() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_list_pages

wp_list_pages() is used to output a list of pages (as links). This function is
extremely powerful,  with several available arguments, including depth of
hierarchy to display, pages (or hierarchies) to include/exclude, display order
(ascending/descending/menu order).

To see the full list of arguments for wp_list_pages(), see the Codex.

***********************
wp_nav_menu()
----------------------------------
get_template_part() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_nav_menu

wp_nav_menu( $menu ) is used to output a nav menu named $menu. This menu must be configured
in the Menus administration panel.

wp_nav_menu() (note: no argument for a specific menu) is used to output the default nav menu. This
menu must be configured in the Menus administration panel.

=============================================================================
*/ ?>