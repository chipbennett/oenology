<?php
/*
Template Name: Sidebar-Right
*/
?>

<!-- Begin Right Column Widget Area-->
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-right') ) :  ?><?php endif; ?>
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
function_exists()
----------------------------------
function_exists() is a boolean (returns TRUE or FALSE) conditional PHP function.
Codex reference: N/A

function_exists( 'foo' ) returns TRUE if a function named foo() is found; otherwise, it returns FALSE.

=============================================================================
*/ ?>