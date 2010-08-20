<?php
/*
	Plugin Name: <a href="http://www.webtechglobal.co.uk/services/downloads/romancart-on-wordpress-plugin">RomanCart On Wordpress</a>
	Version: 0.0.1
	Plugin URI: http://www.webtechglobal.co.uk/services/downloads/romancart-on-wordpress-plugin
	Description: RomanCart on Wordpress is easy to use, simply add product information to a shortcode and save. Your product will be displayed instantly. Use widget to display cart information.
	Author: Ryan Bayne
	Author URI: http://www.webtechglobal.co.uk/about
*/
$wtgdebugmode = 0;
if( $wtgdebugmode == 1 )
{
	ini_set('display_errors',1);
	$wordpressmu = false;
	error_reporting(E_ALL);
}

require_once('functions/rcw_functions_public.php');
	
function rcw_toppage1(){rcw_commonincludes();require_once('rcw_home.php');}
function rcw_subpage1(){rcw_commonincludes();require_once('rcw_settings.php');}
function rcw_subpage2(){rcw_commonincludes();require_once('rcw_developernotes.php');}
function rcw_subpage3(){rcw_commonincludes();require_once('rcw_updates.php');}
function rcw_subpage4(){rcw_commonincludes();require_once('rcw_guide.php');}
function rcw_subpage5(){rcw_commonincludes();require_once('rcw_create.php');}
function rcw_subpage6(){rcw_commonincludes();require_once('rcw_forum.php');}

// plugin admin pages
function rcw_createmenu() 
{
	require_once('functions/rcw_functions_global.php');

	$rcw = get_option( 'rcw_settings' );

	// set permission level for all rcw pages
	$per = 10;
	
	add_menu_page('RomanCart', 'RomanCart', $per, __FILE__, 'rcw_toppage1');
	add_submenu_page(__FILE__, 'Settings', 'Settings', $per, 'rcw_settings', 'rcw_subpage1');
    add_submenu_page(__FILE__, 'Developer Notes', 'Developer Notes', $per, 'rcw_developer', 'rcw_subpage2');
    add_submenu_page(__FILE__, 'Plugin Updates', 'Plugin Updates', $per, 'rcw_updates', 'rcw_subpage3');
    add_submenu_page(__FILE__, 'Plugin Forum', 'Plugin Forum', $per, 'rcw_forum', 'rcw_subpage6');
    add_submenu_page(__FILE__, 'User Manual', 'User Manual', $per, 'rcw_guide', 'rcw_subpage4');
    add_submenu_page(__FILE__, 'Create Product', 'Create Product', $per, 'rcw_create', 'rcw_subpage5');
}

// includes the most common function files - I try to avoid calling all functions when not needed
function rcw_commonincludes()
{
	require_once('functions/rcw_functions_global.php');
	require_once('functions/rcw_functions_interface.php');
	require_once('functions/rcw_functions_processing.php');
}

// plugin installation
function rcw_installation() 
{	
	rcw_commonincludes();
	rcw_insert_pluginsettings();	
}		

// register widget - makes it available for use in admin
function rcw_registerwidget1()
{
	rcw_commonincludes();
	$widget_ops = array('classname' => 'rcw_widget_basket', 'description' => "Display RomanCart Shopping Basket In Sidebar" );
	wp_register_sidebar_widget('rcw_widget_basket', 'RomanCart Basket', 'rcw_widget_basket', $widget_ops);
}

// actions
add_shortcode('rcw_singleitem', 'rcw_singleitem_display');
add_action('plugins_loaded','rcw_registerwidget1');
add_action('wp', 'rcw_productsubmissionprocessing_stage1');	
add_action('wp', 'rcw_productsubmissionprocessing_stage2');	

add_action('admin_menu', 'rcw_createmenu');
// installation trigger
register_activation_hook(__FILE__,'rcw_installation');
?>