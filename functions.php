<?php

// functions-theme-setup.php includes all of the various Theme setup:
// add_theme_support()
// $content_width
// Define custom image sizes, custom headers, nav menus
require_once( 'functions/functions-theme-setup.php' );

// functions-custom.php includes all of the Theme's custom functions
// filter wp_title
// filter comment_count
// Custom footer copyright notice
// Gallery image links and metadata handling
// 404 error handling
// current-cat CSS class
// navigation breadcrumb
require_once( 'functions/functions-custom.php' );

// functions-widgets.php includes the Theme's Widgetized sidebars and custom Widgets
// register_sidebar
// define custom widgets
// register_widget
require_once( 'functions/functions-widgets.php' );

// functions-options.php includes the Theme options and Admin Settings page
// Define default Theme Options
// Register/Initialize Theme Options
// Admin Settings Page
// Contextual Help
require_once( 'functions/functions-options.php' );


/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
require_once()
----------------------------------
require_once() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.require-once.php

require_once( $file ) will include the file specified by the $file argument

require_once() will return a fatal error if the specified file cannot be included. Also, if theme
specified file has already been included, require_once() will not attempt to include it again.

require_once( $file ) accepts one argument:
 - $file (string): file to be included.

require_once( 'foo.php' )
 - will include the file "foo.php".

=============================================================================
*/ 
?>