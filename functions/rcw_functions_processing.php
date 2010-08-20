<?php
# Creates New Post With Added Product From Post Variables
# Requires: $POST['rcw_newproductpage_submit']
function rcw_newproductpage_process()
{
	if(isset($_POST['rcw_newproductpage_submit']))
	{
		$fail=false;
		
		// ensure required values submitted for text field values
		if(empty($_POST['rcw_itemname'])){$fail=true;rcw_mes('Item Name Required','');}
		if(empty($_POST['rcw_baseprice'])){$fail=true;rcw_mes('Base Price Required','');}
		
		// ensure numeric values are not text
		if(!is_numeric($_POST['rcw_baseprice'])){$fail=true;rcw_mes('Base Price Is Required To Be Numeric Only','');}
		
		// process variable option prices
		if(!empty($_POST['rcw_varprice1_name'])&&!is_numeric($_POST['rcw_varprice1_value'])){$fail=true;rcw_mes('Variable One Price Must Be A Numeric Value','');}
		
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
				
				# VARIATION SETTINGS ARE TO BE ADDED - THE BETA IS DESIGNED TO HOLD THEM IN THE PRODUCT FORM OUTPUT
				
				// add description (desc) only if submitted
				if(!empty($_POST['rcw_desc'])){$shortcode .= ' desc="'.$_POST['rcw_desc'].'"';}
				
				// if the mode is "stageone" add post id to the shortcode
				if($_POST['rcw_mode']=='stageone'){$shortcode .= ' postid="'.$_POST['rcw_postid'].'"';}
				
				// add the closing bracket
				$shortcode .= ']';
			}
			else
			{
				$shortcode = ' No Short Code - This message is for testing only during BETA. It mean that shortcode method was not selected. ';
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
				// dynamically change message content depending on settings
				if($_POST['rcw_source']=='included'){$method='You selected "included" as your source and so a shortcode has been saved to your product content. See the shortcode below for review. ';}
				elseif($_POST['rcw_source']=='customfields'){$method='You selected "customfields" as your source and product content has been added to custom fields. ';}
				
				if($_POST['rcw_mode']=='stagetwo'){$stage='You will need the id for creating the stage one page and product, please note it. ';}
				else{$stage='';}
				
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
?>
