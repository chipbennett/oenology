<?php
/**
 * License Reference Help Tab Content
 */

$tabtext = '';
$tabtext .= <<<EOT
<h2>Oenology WordPress Theme License Information</h2>

<p>Oenology WordPress Theme, Copyright (C) 2010 Chip Bennett</p>
<ol>
	<li>License: GNU General Public License, v2 (or newer)</li>
	<li>License URI: <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html">http://www.gnu.org/licenses/old-licenses/gpl-2.0.html</a></li>
</ol>

<p>This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.</p>

<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.</p>

<h3>Bundled Fonts</h3>

<p>TexGyre Schola Font, Copyright 2005, 2006 C. R. Holder</p>
<ol>
	<li>Source: <a href="http://www.fontsquirrel.com/fonts/TeX-Gyre-Schola">TeXGyre Schola Font</a></li>
	<li>License: GUST Font License (GFL) (GPL-compatible)</li>
	<li>License URI: <a href="<?php echo get_template_directory_uri(); ?>/fonts/GUST-FONT-LICENSE.txt">/fonts/GUST-FONT-LICENSE.txt</a></li>
</ol>

<h3>Bundled Images</h3>
<ol>
	<li>Image sprites are custom-created, using bundled icons, listed below.</li>
	<li>pxwhite.jpg is a single-pixel image, and not copyrightable</li>
</ol>

<h3>Bundled Icons</h3>

<p>IconSweets2 Icons, Copyright 2010 YummyGum</p>
<ol>
	<li>Source: <a href="http://www.iconsweets2.com">IconSweets2</a></li>
	<li>License: "You may use these icons for both commercial and for 
	personal use and customize them any way you like."</li>
	<li>License URI: <a href="<?php echo get_template_directory_uri(); ?>/images/iconsweets2/License.rtf">/images/iconsweets2/License.rtf</a></li>
</ol>

<p>InFocus Social Media Icons, Copyright 2010 WebTreats</p>
<ol>
	<li>Source: <a href="http://webtreats.mysitemyway.com/1540-infocus-social-media-icon-mega-set/">InFocus Social Media Icons</a></li>
	<li>License: "This resource is free for personal and commercial use ~ no attribution necessary."</li>
	<li>License URI: <a href="<?php echo get_template_directory_uri(); ?>/images/infocus/readme.txt">/images/infocus/readme.txt</a></li>
</ol>	
EOT;
return $tabtext;
?>