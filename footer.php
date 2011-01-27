<span><a href="<?php home_url();  ?>"><?php bloginfo('name'); ?></a></span> <?php
if ( function_exists( 'oenology_copyright' ) ) { // if the oenology_copyright() function exists, use it to output the copyright date span
	echo oenology_copyright();  // function to output XXXX-YYYY, where 'XXXX' is the year of the oldest post, and 'YYYY' is the current year
} else {  // otherwise, just output the current year
	?>  
	&copy;  
	<?php echo date('Y');  // current year
} ?>  | Powered by <a href="http://wordpress.org" target="_new">WordPress <?php bloginfo('version'); ?></a><?php 
global $oenology_options;
if ( 'true' == $oenology_options['display_footer_credit'] ) { // Disabled by default 
	oenology_footer_credit();  
}
	/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
bloginfo()
----------------------------------
bloginfo() is a WordPress template tag.  
Codex reference: http://codex.wordpress.org/Bloginfo

bloginfo() can be used to print several useful WordPress-related parameters. For example:

	name =  (blog name, as defined on the General Settings page in the administration panel)
	version = (version of WordPress installed)
	
For the full list of parameters returned by bloginfo(), see the Codex.

bloginfo() prints (displays/outputs) the data requested. To get, but not display/output the data, use get_bloginfo() instead.

***********************
date()
----------------------------------
date() is a PHP function that returns the current date.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.date.php

date() accepts one argument: a string indicating the date format.

***********************
home_url()
----------------------------------
home_url() is a WordPress function
Codex reference: http://codex.wordpress.org/Function_Reference/home_url

home_url() is used to return the home URL (the 'home' option), using the appropriate protocol 
(http or https), based on value of is_ssl().

home_url() accepts no arguments.

Example:
home_url(); returns e.g. "http://www.domain.tld"

Used in the following template files:
infobar.php, site-navigation.php

***********************
oenology_copyright()
----------------------------------
oenology_copyright() is a custom Theme function.
Codex reference: N/A

oenology_copyright() is used to output the copyright date range, in the format 'XXXX - YYYY',
where 'XXXX' is the year the oldest post was published, and'YYYY' is the current year.

oenology_copyright() is defined in functions.php.

=============================================================================
*/ ?>