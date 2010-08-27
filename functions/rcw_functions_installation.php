<?php
# Iniitial Wordpress Options Table Data Insertion
function rcw_insert_pluginsettings()
{
	$rcw = array();
	
	// shortcode default values
	$rcw['shortcodedefaults']['mode'] = 'normal';
	$rcw['shortcodedefaults']['style'] = 'default1';
	$rcw['shortcodedefaults']['source'] = 'search';
	$rcw['shortcodedefaults']['itemname'] = 'New Product';
	$rcw['shortcodedefaults']['baseprice'] = '9999.99';
	$rcw['shortcodedefaults']['buttontext'] = 'Add To Cart';
	$rcw['shortcodedefaults']['v1n'] = 'Variation One';
	$rcw['shortcodedefaults']['v1p'] = '9999.99';
	$rcw['shortcodedefaults']['desc'] = 'The description for a new product';
	$rcw['shortcodedefaults']['storeid'] = '0';
	$rcw['shortcodedefaults']['postid'] = '1';

	// currency settings
	$rcw['currency']['symbol'] = '&pound;';
	$rcw['currency']['code'] = 'GBP';
	
	// post creation settings
	$rcw['postcreation']['tags'] = 'No';
	$rcw['postcreation']['ping'] = 'No';
	
	// sidebar widget settings
	$rcw['widgetone']['title'] = 'Shopping Cart';
	
	add_option('rcw_settings',$rcw);
}
?>