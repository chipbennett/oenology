/**
 * Oenology tinynav JS implementation
 *
 * This file includes tinynav.js integration for the Theme.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 */

jQuery(".nav-header").tinyNav({
	active: 'current_page_item', // Set the "active" class for default menu.
	label: '', // String: Sets the <label> text for the <select> (if not set, no label will be added).
	header: '' // String: Specify text for "header" and show header instead of the active item.
});