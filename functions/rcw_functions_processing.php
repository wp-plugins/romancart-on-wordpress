<?php
# Processes $_POST Data Submitted On Product Edit Page - Updates Records
function rcw_saveproducts_basic()
{
	if( isset( $_POST['rcw_saveproducts_basic'] ) )
	{
		// loop through records submitted - update all data edited or not (simplest way)
		$formobjectid = 0;
		$updated = 0;

		while($formobjectid < $_POST['rcw_count'])
		{
			$id = 'rcw_postid'.$formobjectid;// form field name = not data value
			$bp = 'rcw_baseprice'.$formobjectid;// form field name = not data value
			$d = 'rcw_desc'.$formobjectid;// form field name - not data value
			
			$success1 = false;
			$success2 = false;

			// can use counter or post id as unique object code - using post id to test - doesnt require specific order etc
			if( update_post_meta($_POST[$id], 'rcw_baseprice', $_POST[$bp]))
			{
				$success1 = true;
			}
			

			// if form view = prices - update variation custom fields
			if( $_POST['rcw_formview'] == 'standard' )
			{
				if( update_post_meta($_POST[$id], 'rcw_desc', $_POST[$d]))
				{
					$success2 = true;
				}
			}
			elseif( $_POST['rcw_formview'] == 'prices' )
			{
				
				// output variations
				$productvariations = $_POST['rcw_productvariations'. $formobjectid] + 1;// plus one to make it do full number of loop
				$varno = 1;// number in variation key "v1n,v4p" - starts at 1
				
				while( $varno < $productvariations )
				{					
					update_post_meta($_POST[$id], 'rcw_v'.$varno.'n', $_POST['rcw_v'.$varno.'n'.$formobjectid]);
					update_post_meta($_POST[$id], 'rcw_v'.$varno.'p', $_POST['rcw_v'.$varno.'p'.$formobjectid]);
					
					++$varno;
				}
			}
			
			++$formobjectid;
		}

		rcw_mes('Successfull','');
	}
}

# Creates New Post With Added Product From Post Variables
# Requires: $POST['rcw_newproductpage_submit']
function rcw_newproductpage_process()
{
	if(isset($_POST['rcw_newproductpage_submit']))
	{
		$fail=false;
		
		$rcw = get_option('rcw_settings');
		
		// ensure required values submitted for text field values
		if(empty($_POST['rcw_itemname'])){$fail=true;rcw_mes('Item Name Required','');}
		if(empty($_POST['rcw_baseprice'])){$fail=true;rcw_mes('Base Price Required','');}
		
		// ensure numeric values are not text
		if(!is_numeric($_POST['rcw_baseprice'])){$fail=true;rcw_mes('Base Price Is Required To Be Numeric Only','');}
		
		// if user selects mode stageone we require a post id
		if($_POST['rcw_mode']=='stageone' && empty($_POST['rcw_postid']) || $_POST['rcw_mode']=='stageone' && !is_numeric($_POST['rcw_postid']))
		{$fail=true;rcw_mes('Post ID Invalid','The post id has either not been provided or it is not numeric please try again');}

		// if no failures continue creating post
		if(!$fail)
		{
			// if source method is shortcode build it now
			if($_POST['rcw_source']=='included')
			{
				// must be on one line of code or it does not work
				$shortcode = '[rcw_singleitem mode="'.$_POST['rcw_mode'].'" style="'.$_POST['rcw_style'].'" source="'.$_POST['rcw_source'].'" itemname="'.$_POST['rcw_itemname'].'"	baseprice="'.$_POST['rcw_baseprice'].'"	buttontext="'.$_POST['rcw_buttontext'].'"';
				
	            // add description (desc) only if submitted
				if(!empty($_POST['rcw_desc'])){$shortcode .= ' desc="'.$_POST['rcw_desc'].'"';}
				
				// if the mode is "stageone" add post id to the shortcode
				if($_POST['rcw_mode']=='stageone'){$shortcode .= ' postid="'.$_POST['rcw_postid'].'"';}
				
				// add variation total request and any variation values
				if(!empty($_POST['rcw_variations']) && is_numeric($_POST['rcw_variations']))
				{
					$shortcode .= ' variations="'.$_POST['rcw_variations'].'"';
					if($_POST['rcw_variations'] != 0){require('rcw_shortcodevariations.php');}
				}
				
				// add the closing bracket
				$shortcode .= ']';
			}
			elseif($_POST['rcw_source']=='search'||$_POST['rcw_source']=='customfields')
			{
				// add a basic shortcodes with minimum attributes
				$shortcode = '[rcw_singleitem mode="'.$_POST['rcw_mode'].'" style="'.$_POST['rcw_style'].'" source="'.$_POST['rcw_source'].'"]';
			}
			
			// put strings together to complete content - eventually wysiwyg editor may be used to prepare none form content
			$content = $shortcode;
			
			// Create post object
			$my_post = array();
			$my_post['post_title'] = $_POST['rcw_itemname'];
			$my_post['post_content'] = $content;
			$my_post['post_status'] = 'publish';
			$my_post['post_author'] = 1;
			$my_post['post_category'] = array(1);
			$newpostid = wp_insert_post( $my_post );
			
			if($newpostid)
			{
				// if custom field or search method, add custom fields now		
				$cffail = false;

				if(!add_post_meta($newpostid, 'rcw_itemname', $_POST['rcw_itemname'], true))
				{
					rcw_err('Failure','The plugin could not create a custom field for storing the item name.');
					$cffail = true;
				}
				
				if(!add_post_meta($newpostid, 'rcw_baseprice', $_POST['rcw_baseprice'], true))
				{
					rcw_err('Failure','The plugin could not create a custom field for storing the base price.');
					$cffail = true;
				}
				
				if(!add_post_meta($newpostid, 'rcw_buttontext', $_POST['rcw_buttontext'], true))
				{
					rcw_err('Failure','The plugin could not create a custom field for storing the button text.');
					$cffail = true;
				}
				
				if(!empty($_POST['rcw_postid']))
				{	
					if(!add_post_meta($newpostid, 'rcw_postid', $_POST['rcw_postid'], true))
					{
						rcw_err('Failure','The plugin could not create a custom field for storing the post id.');
						$cffail = true;
					}
				}
				
				if(!empty($_POST['rcw_desc']))
				{
					if(!add_post_meta($newpostid, 'rcw_desc', $_POST['rcw_desc'], true))
					{
						rcw_err('Failure','The plugin could not create a custom field for storing the description.');
						$cffail = true;
					}
				}				
				
				if(!empty($_POST['rcw_variations']) && is_numeric($_POST['rcw_variations']))
				{
					if(!add_post_meta($newpostid, 'rcw_variations', $_POST['rcw_variations'], true))
					{
						rcw_err('Failure','The plugin could not create a custom field for storing the variations number.');
						$cffail = true;
					}
					
					// add individual custom fields for each variation value
					if($_POST['rcw_variations'] > 0)
					{
						$created = 0;
						$item = 1;
						while($created != $_POST['rcw_variations'])
						{
							if(!add_post_meta($newpostid, 'rcw_v'.$item.'n', $_POST['rcw_v'.$item.'n'], true))
							{
								rcw_err('Failure','The plugin could not create a custom field for holding variation '.$item.' name. You should consider deleting the 
										post and trying again. Please seek support from the webmaster@webtechglobal.co.uk if you continue to experiance problems.
										Please copy this message so we can solve the matter quickly.');
								$cffail = true;
							}
							
							if(!add_post_meta($newpostid, 'rcw_v'.$item.'p', $_POST['rcw_v'.$item.'p'], true))
							{
								rcw_err('Failure','The plugin could not create a custom field for holding variation '.$item.' price value. You should consider deleting the 
										post and trying again. Please seek support from the webmaster@webtechglobal.co.uk if you continue to experiance problems.
										Please copy this message so we can solve the matter quickly.');
								$cffail = true;
							}	
							
							++$item;
							++$created;
						}											
					}
				}
				
				if(!add_post_meta($newpostid, 'rcw_storeid', $rcw['shortcodedefaults']['postid'], true))
				{
					rcw_err('Failure','The plugin could not create a custom field for storing the RomanCart store id.');
					$cffail = true;
				}
				
				// dynamically change message content depending on settings
				if($_POST['rcw_source']=='included'){$method='You selected "included" as your source and so a shortcode has been saved to your product content. See the shortcode below for review. ';}
				elseif($_POST['rcw_source']=='customfields'){$method='You selected "customfields" as your source and product content has been added to custom fields. ';}
				
				if($_POST['rcw_mode']=='stagetwo'){$stage='You will need the id for creating the stage one page and product, please note it. ';}else{$stage='';}
				
				// display final message
				rcw_mes('Post Created Successfully','A post was created with id '.$newpostid.' and your product information entered into that post. '.$stage.''.$method.'');	
				
				// if shortcode used display it for users review - will help with debugging also
				if($_POST['rcw_source']=='included'){rcw_mes('Shortcode Created','A post was created and your product information entered into that post. '.$method.' ');}			
			}
			else
			{
				rcw_err('Failed To Create Post','There has been a failure in post creation. No post was created and so no new products are being displayed on your website.');
			}
		}
	}
}

# Saves Post Creation Settings - Called On Settings Page
# Requires: $_POST['rcw_postcreationsettings_submit']
function rcw_savesettings_postcreationsettings() 
{
	if(isset($_POST['rcw_postcreationsettings_submit']))
	{	
		$rcw = get_option('rcw_settings');

		$rcw['postcreation']['tags'] = $_POST['rcw_tags'];
		$rcw['postcreation']['ping'] = $_POST['rcw_pings'];
		
		if(update_option('rcw_settings',$rcw))
		{
			rcw_mes('Success','Your post creation settings have been saved and will apply to all new product posts you create from here on.');
		}
		else
		{
			rcw_err('Failed','There was a problem updating the Wordpress options table with your post creation setttings, please try again then seek help.');
		}
	}
}


# Saves Shortcode Default Settings - Called On Settings Page
# Requires: $_POST['rcw_shortcodesettings_submit']
function rcw_savesettings_shortcodedefaults()
{
	if(isset($_POST['rcw_shortcodesettings_submit']))
	{
		$rcw = get_option('rcw_settings');

		$rcw['shortcodedefaults']['mode'] = $_POST['rcw_mode'];
		$rcw['shortcodedefaults']['style'] = $_POST['rcw_style'];
		$rcw['shortcodedefaults']['source'] = $_POST['rcw_source'];
		$rcw['shortcodedefaults']['itemname'] = $_POST['rcw_itemname'];
		$rcw['shortcodedefaults']['baseprice'] = $_POST['rcw_baseprice'];
		$rcw['shortcodedefaults']['buttontext'] = $_POST['rcw_buttontext'];
		$rcw['shortcodedefaults']['desc'] = $_POST['rcw_desc'];
		$rcw['shortcodedefaults']['postid'] = $_POST['rcw_postid'];
	
		if(update_option('rcw_settings',$rcw))
		{
			rcw_mes('Success','Your shortcode settings have been saved, the defaults will be applied to all shortcodes where attributes have not been added.');
		}
		else
		{
			rcw_err('Failed','There was a problem updating the Wordpress options table with your shortcode setttings, please try again then seek help.');
		}
	}
}

# Saves Currency Settings - Called On Settings Page
# Requires: $_POST['rcw_currencysettings_submit']
function rcw_savesettings_currencysettings() 
{
	if(isset($_POST['rcw_currencysettings_submit']))
	{
		$rcw = get_option('rcw_settings');
		
		$rcw['currency']['symbol'] = $_POST['rcw_symbol'];
		$rcw['currency']['code'] = $_POST['rcw_code'];
		
		if(update_option('rcw_settings',$rcw))
		{
			rcw_mes('Success','Your currency settings have been saved and will apply to all existing and new products in your blog.');
		}
		else
		{
			rcw_err('Failed','There was a problem updating the Wordpress options table with your setttings, please try again then seek help.');
		}
	}
}

# Saves Widget One Settings - Called On Settings Page
# Requires: $_POST['rcw_widgetonesettings_submit']
function rcw_savesettings_widgetonesettings() 
{
	if(isset($_POST['rcw_currencysettings_submit']))
	{
		$rcw = get_option('rcw_settings');
	
		$rcw['widgetone']['title'] = $_POST['rcw_title'];
		
		if(update_option('rcw_settings',$rcw))
		{
			rcw_mes('Success','Your post creation settings have been saved and will apply to all new product posts you create from here on.');
		}
		else
		{
			rcw_err('Failed','There was a problem updating the Wordpress options table with your setttings, please try again then seek help.');
		}
	}
}

# Uses Included Class To Calculate Exchange Rate
# Input: money value (no symbol decimal value only), original currency code, requested currency code
# Output: returns decimal value
function rcw_getexchangerate($money,$original,$requested)
{
	include('functions/currencyconvertor.php');
	//$x = new CurrencyConverter('your_host','your_username','your_password','your_database_name','your_table_name');
	$x = new CurrencyConverter();
	return $x->convert($money,$original,$requested);//                2.50,'GBP','USD'
}

# Deletes Plugins Setting Data From Wordpress Options Table
# Requires: $_POST['rcw_uninstallplugin_submit']
function rcw_uninstallplugin()
{
	if( isset( $_POST['rcw_uninstallplugin_submit'] ) )
	{
		if( delete_option('rcw_settings') )
		{
			rcw_mes('Settings Deleted Successfully','');
		}
		else
		{
			rcw_err('Failed To Delete Plugin Settings','Please try again then contact webmaster@webtechglobal.co.uk for support.');
		}
	}
}
?>