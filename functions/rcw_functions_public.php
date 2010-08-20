<?php
/*

# SHORT CODE VALUES EXPLAINED
MODES (uses special functions in plugin)
1. Normal:
2. StageOne:
3. StageTwo:
STYLE (layout and css)
1. Default1: button only
2. Default2: description,button
3. Default3: description,image,button
SOURCE (where content comes from) (not required - plugin will check both for a value if empty)
1. Included: added to the shortcode
2. Customfields: created in custom fields
3. (blank): causes search of both included and customfields

# POSSIBLE SOURCE DATA
'mode' => normal,stageone,stagetwo (dont add any for default normal)
'style' => default1,default2,default3 or dont add any for default1
'source' => included,customfields,(or dont add any)
'postid' => integer only, required for stages
'itemname' => 'Product Name'
'baseprice' => '0.00'
'description' => text can be html also
'image' => url path
'storeid' => can be blank, will rely on a default if not set
'pricevariation1' => '2.00' (not required)
'buttontext' => (not required will rely on default)

# EXAMPLE SHORT CODES
[rcw_singleitem mode="normal" styles="default1" source="customfields"]   custom fields only
[rcw_singleitem mode="normal" styles="default1" source="include"]   included only
[rcw_singleitem mode="normal" styles="default1"]   both custom fields and included
[rcw_singleitem mode="stage1" style="default" postid="344"]   DONE
[rcw_multipleitems mode="normal" style="default"]	
[rcw_multipleitems mode="stage1" style="default"  postid="344"]
[rcw_multipleitems mode="stage2" style="default"]

*/

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
		'itemname' => '',// default must be blank to trigger use of post title
		'baseprice' => '0.00',
		'desc' => '',
		'image' => '',
		'storeid' => '38254',
		'pricevariation1' => '2.00',
		'buttontext' => 'Buy Now',
	), $atts));

	global $wpdb, $post;
	
	if ($post->ID) 
	{		
		// if source is not "included" then get posts custom fields now
		if( $source != 'included' )
		{
			$custom_fields = get_post_custom($post->ID);}
	
			if( $style == 'default1' )// itemname,baseprice required (no table)
			{
				// if custom_fields is set, indicates we need to use them - any not existing will cause the default shortcode  attributes
				if( isset( $custom_fields ) )
				{
					$itemname = rcw_getproduct_itemname($custom_fields);
					$baseprice = rcw_getproduct_baseprice($custom_fields);
					$storeid = rcw_getproduct_storeid($custom_fields);
					$pricevariation1 = rcw_getproduct_pricevariation1($custom_fields);
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
					$pricevariation1 = rcw_getproduct_pricevariation1($custom_fields);
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
					$pricevariation1 = rcw_getproduct_pricevariation1($custom_fields);			
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
			$romancartdisplay = rcw_displayproduct_default1($mode,$actionurl,$baseprice,$storeid,$itemname,$postid,$buttontext,$pricevariation1);
		}
		elseif( $style == 'default2' )// itemname,baseprice and description required (small table)
		{
			$romancartdisplay = rcw_displayproduct_default2($mode,$actionurl, $baseprice, $storeid, $itemname, $postid, $desc,$buttontext,$pricevariation1);
		}
		elseif( $style == 'default3' )// itemname,baseprice,description and image required (full table)
		{
			$romancartdisplay = rcw_displayproduct_default3($mode,$actionurl, $baseprice, $storeid, $itemname, $postid, $desc, $image,$buttontext,$pricevariation1);
		}

		return @"{$romancartdisplay}";
}


# Gets The storeid From Custom Fields
# Input: custom fields array
# Output: returns the storeid if found
function rcw_getproduct_pricevariation1($custom_fields)
{
	@$rcw_pricevariation1 = $custom_fields['rcw_pricevariation1'];
	if(isset($custom_fields['rcw_pricevariation1']))
	{
		foreach ( $rcw_pricevariation1 as $key => $value )
		{
			$pricevariation1 = $value;
		}
		return $pricevariation1;	
	}
}

# Gets The storeid From Custom Fields
# Input: custom fields array
# Output: returns the storeid if found
function rcw_getproduct_storeid($custom_fields)
{
	@$rcw_storeid = $custom_fields['rcw_storeid'];
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
	@$rcw_image = $custom_fields['rcw_image'];
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
	@$rcw_desc = $custom_fields['rcw_desc'];
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
	@$rcw_itemname = $custom_fields['rcw_itemname'];
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
	@$rcw_baseprice = $custom_fields['rcw_baseprice'];
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
	$rcw = get_option( 'rcw_settings' );
	$pagetype = rcw_returnpagetype();

	// extracts before_widget,before_title,after_title,after_widget all required and cannot be deleted
	extract($args); 
	echo $before_widget . $before_title . ' Videos ' . $after_title;
	
	// display different cart values depending on users settings
	echo '<SCRIPT LANGUAGE="JavaScript" SRC="http://www.romancart.com/cartinfo.asp?storeid=38254&type=1"></SCRIPT><br />
	<SCRIPT LANGUAGE="JavaScript" SRC="http://www.romancart.com/cartinfo.asp?storeid=38254&type=2"></SCRIPT><br />
	<SCRIPT LANGUAGE="JavaScript" SRC="http://www.romancart.com/cartinfo.asp?storeid=38254&type=3"></SCRIPT><br />';
	
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