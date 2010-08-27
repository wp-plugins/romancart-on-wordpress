<?php
# Processes Detection Of Shortcode [rcw_singleitem mode="normal" style="default"]
# Input: shortcode attributes
# Output: Displays A Product Form With Either Action URL LOCAL Or To RomanCart
function rcw_singleitem_display($atts) 
{
	extract(shortcode_atts(array(
		'mode' => 'normal',
		'style' => 'default1',
		'postid' => '1',
		'source' => 'search',
		'itemname' => '',
		'baseprice' => '0.00',
		'desc' => '',
		'image' => '',
		'storeid' => '38254',
		'buttontext' => 'Buy Now',
		'v1n' => 'Variation Item 1',
		'v1p' => '1.00',
		'v2n' => 'Variation Item 2',
		'v2p' => '2.00',
		'v3n' => 'Variation Item 3',
		'v3p' => '3.00',
		'v4n' => 'Variation Item 4',
		'v4p' => '4.00',
		'v5n' => 'Variation Item 5',
		'v5p' => '5.00',
		'v6n' => 'Variation Item 6',
		'v6p' => '6.00',
		'v7n' => 'Variation Item 7',
		'v7p' => '7.00',
		'v8n' => 'Variation Item 8',
		'v8p' => '8.00',
		'v9n' => 'Variation Item 9',
		'v9p' => '9.00',
		'v10n' => 'Variation Item 10',
		'v10p' => '10.00',
		'variations' => 0,
	), $atts));
	
	global $wpdb, $post;
	
	if ($post->ID) 
	{		
		// if source is not "included" then get posts custom fields now
		if( $source != 'included' )
		{
			$custom_fields = get_post_custom($post->ID);
	
			if( $style == 'default1' )// itemname,baseprice required (no table)
			{
				// if custom_fields is set, indicates we need to use them - any not existing will cause the default shortcode  attributes
				if( isset( $custom_fields ) )
				{
					// get standard values
					$itemname = rcw_getproduct_itemname($custom_fields);
					$baseprice = rcw_getproduct_baseprice($custom_fields);
					$storeid = rcw_getproduct_storeid($custom_fields);
					
					// get variation number
					$variations = rcw_getproduct_variations($custom_fields);
					
					// get all required custom fields
					require_once('rcw_inc_getvariations.php');
				}
			}
			elseif( $style == 'default2' )// itemname,baseprice and description required (small table)
			{
				if( isset( $custom_fields ) )
				{
					$itemname = rcw_getproduct_itemname($custom_fields);
					$baseprice = rcw_getproduct_baseprice($custom_fields);
					$desc = rcw_getproduct_desc($custom_fields);
					$storeid = rcw_getproduct_storeid($custom_fields);
					
					// get variation number
					$variations = rcw_getproduct_variations($custom_fields);
					
					// get all required custom fields
					require_once('rcw_inc_getvariations.php');
				}
				
			}
			elseif( $style == 'default3' )// itemname,baseprice,description and image required (full table)
			{
				if( isset( $custom_fields ) )
				{
					$itemname = rcw_getproduct_itemname($custom_fields);
					$baseprice = rcw_getproduct_baseprice($custom_fields);
					$desc = rcw_getproduct_desc($custom_fields);
					$image = rcw_getproduct_image($custom_fields);
					$storeid = rcw_getproduct_storeid($custom_fields);
					
					// get variation number
					$variations = rcw_getproduct_variations($custom_fields);
					
					// get all required custom fields
					require_once('rcw_inc_getvariations.php');
				}
			}
		}
	
		// last chance to fill variables
		$itemnameisposttitle = true;// if no item name passed, will cause title to be used
		
		// decide on action url for product form - blank for local process or straight to romancart
		if($mode=='normal'){$actionurl = 'http://www.romancart.com/cart.asp';}
		elseif($mode=='stageone'||$mode=='stagetwo'){$actionurl = '';}
		
		// ensure item name is not blank else use
		if( $itemnameisposttitle == true && !isset($itemname) || $itemnameisposttitle == true && empty($itemname) ){$itemname = $post->post_title;}
		elseif( $itemnameisposttitle == false && !isset($itemname) ||  $itemnameisposttitle == false && empty($itemname) ){$itemname = 'Default Product Name';}
		
		# ALL PRODUCT VALUES MUST BE OBTAINED BEFORE HERE - NOW BUILD THE LAYOUT
		if( $style == 'default1' )// itemname,baseprice required (no table)
		{                      
			$romancartdisplay = rcw_displayproduct_default1($mode,$actionurl,$baseprice,$storeid,$itemname,$postid,$buttontext,
			$v1p,$v1n,$v2p,$v2n,$v3p,$v3n,$v4p,$v4n,$v5p,$v5n,$v6p,$v6n,$v7p,$v7n,$v8p,$v8n,$v9p,$v9n,$v10p,$v10n,$variations);
		}
		elseif( $style == 'default2' )// itemname,baseprice and description required (small table)
		{
			$romancartdisplay = rcw_displayproduct_default2($mode,$actionurl, $baseprice, $storeid, $itemname, $postid, $desc,$buttontext,
			$v1p,$v1n,$v2p,$v2n,$v3p,$v3n,$v4p,$v4n,$v5p,$v5n,$v6p,$v6n,$v7p,$v7n,$v8p,$v8n,$v9p,$v9n,$v10p,$v10n,$variations);
		}
		elseif( $style == 'default3' )// itemname,baseprice,description and image required (full table)
		{
			$romancartdisplay = rcw_displayproduct_default3($mode,$actionurl, $baseprice, $storeid, $itemname, $postid, $desc, $image,$buttontext,
			$v1p,$v1n,$v2p,$v2n,$v3p,$v3n,$v4p,$v4n,$v5p,$v5n,$v6p,$v6n,$v7p,$v7n,$v8p,$v8n,$v9p,$v9n,$v10p,$v10n,$variations);
		}

		return @"{$romancartdisplay}";
	}
}

function rcw_getproduct_variationname($custom_fields,$count)
{
	$rcw_pricevariation1 = $custom_fields['rcw_v'.$count.'n'];
	if(isset($custom_fields['rcw_v'.$count.'n']))
	{
		foreach ( $rcw_pricevariation1 as $key => $value )
		{
			return $value;
		}
	}
}

function rcw_getproduct_variationprice($custom_fields,$count)
{
	$rcw_pricevariation1 = $custom_fields['rcw_v'.$count.'p'];
	if(isset($custom_fields['rcw_v'.$count.'p']))
	{
		foreach ( $rcw_pricevariation1 as $key => $value )
		{
			return $value;
		}
	}
}

# Returns The Number Of Variations Expected For An Item
function rcw_getproduct_variations($custom_fields)
{
	$rcw_variations = $custom_fields['rcw_variations'];
	if(isset($custom_fields['rcw_variations']))
	{
		foreach ( $rcw_variations as $key => $value )
		{
			return $value;
		}
	}
}

# Gets The storeid From Custom Fields
# Input: custom fields array
# Output: returns the storeid if found
function rcw_getproduct_storeid($custom_fields)
{
	$rcw_storeid = $custom_fields['rcw_storeid'];
	if(isset($custom_fields['rcw_storeid']))
	{
		foreach ( $rcw_storeid as $key => $value )
		{
			$storeid = $value;
		}
		return $storeid;	
	}
}

# Gets The image From Custom Fields
# Input: custom fields array
# Output: returns the image if found
function rcw_getproduct_image($custom_fields)
{
	$rcw_image = $custom_fields['rcw_image'];
	if(isset($custom_fields['rcw_image']))
	{
		foreach ( $rcw_image as $key => $value )
		{
			$image = $value;
		}
		return $image;	
	}
}

# Gets The desc From Custom Fields
# Input: custom fields array
# Output: returns the desc if found
function rcw_getproduct_desc($custom_fields)
{
	$rcw_desc = $custom_fields['rcw_desc'];
	if(isset($custom_fields['rcw_desc']))
	{
		foreach ( $rcw_desc as $key => $value )
		{
			$desc = $value;
		}
		return $desc;	
	}
}

# Gets The itemname From Custom Fields
# Input: custom fields array
# Output: returns the itemname if found
function rcw_getproduct_itemname($custom_fields)
{
	$rcw_itemname = $custom_fields['rcw_itemname'];
	if(isset($custom_fields['rcw_itemname']))
	{
		foreach ( $rcw_itemname as $key => $value )
		{
			$itemname = $value;
		}
		return $itemname;	
	}
}

# Gets The Base Price From Custom Fields
# Input: custom fields array
# Output: returns the base price if found
function rcw_getproduct_baseprice($custom_fields)
{
	$rcw_baseprice = $custom_fields['rcw_baseprice'];
	if(isset($custom_fields['rcw_baseprice']))
	{
		foreach ( $rcw_baseprice as $key => $value )
		{
			$baseprice = $value;
		}
		return $baseprice;	
	}
}

# Returns The Current Page Type
function rcw_returnpagetype(){global $post;if(is_front_page()||is_home()){return'home';}elseif(is_single()||is_page()||is_singular()){return'single';}elseif(is_category()||is_archive()){return'many';}}

# Creates A Widget For Displaying Basket Item Number And Total ETC
# Input: standard widget arguments
# Ouput: new widget available for sidebar and basket totals etc
function rcw_widget_basket($args)
{
	$rcw = get_option('rcw_settings');
	$pagetype = rcw_returnpagetype();

	// extracts before_widget,before_title,after_title,after_widget all required and cannot be deleted
	extract($args); 
	echo $before_widget . $before_title . ' '. $rcw['widgetone']['title'] .' ' . $after_title;
	
	// display different cart values depending on users settings
	echo '<br />
	Items: <SCRIPT LANGUAGE="JavaScript" SRC="http://www.romancart.com/cartinfo.asp?storeid=38254&type=1"></SCRIPT><br />
	Total: <SCRIPT LANGUAGE="JavaScript" SRC="http://www.romancart.com/cartinfo.asp?storeid=38254&type=2"></SCRIPT><br />
	Total: <SCRIPT LANGUAGE="JavaScript" SRC="http://www.romancart.com/cartinfo.asp?storeid=38254&type=3"></SCRIPT>';
	
	/*  THESE ARE OTHER VALUES - I THINK ITS TAX AND TOTAL WITHOUT TAX - WILL BE IN USE WHEN SETTINGS PROVIDED
	<SCRIPT LANGUAGE="JavaScript" SRC="http://www.romancart.com/cartinfo.asp?storeid=38254&type=4"></SCRIPT><br />
	<SCRIPT LANGUAGE="JavaScript" SRC="http://www.romancart.com/cartinfo.asp?storeid=38254&type=5"></SCRIPT><br />
	*/
	
	// display after widget
	echo $after_widget;
}

# Replaces Spaces With Plus Signs
function rcw_cleanproductname()
{
}

# Processes LOCAL Product Form Submission - Forwards User To Another Page For Secondary Item Selection - Stage 1 (stage 2 forwards to RomanCart)
# Requires: $_POST['rcw_productsubmission']
function rcw_productsubmissionprocessing_stage1()	
{
	if(isset($_POST['rcw_productsubmission_stage2']))
	{	
		if(!isset($_SESSION)){session_start();}	
		
		$a = rcw_cleanproductname($_POST['itemname']);
		$b = rcw_cleanproductname($_POST['itemname2']);
		
		// we put first item and second item into url, the secondary stage shortcode function creates form for both on a final submission to romancart
		header("Location: SITE URL HERE + specific page with stage 2 shortcode on it   ?itemname=".$a."&itemname2=".$b."&storeid=".$_POST['storeid']."&quantity=".$_POST['quantity']."&price=".$_POST['price']."");
	}
}

# Processes LOCAL Product Form Submission - Forwards User To RomanCart URL With GET Value - Stage 2 (stage 1 forwards to a specific page)
# Requires: $_POST['rcw_productsubmission']
function rcw_productsubmissionprocessing_stage2()	
{
	if(isset($_POST['rcw_productsubmission_stage2']))
	{	
		if(!isset($_SESSION)){session_start();}	
		
		$a = rcw_cleanproductname($_POST['itemname']);
		$b = rcw_cleanproductname($_POST['itemname2']);
		
		header("Location:http://www.romancart.com/cart.asp?itemname=".$a."&itemname2=".$b."&storeid=".$_POST['storeid']."&quantity=".$_POST['quantity']."&price=".$_POST['price']."");
	}
}


?>