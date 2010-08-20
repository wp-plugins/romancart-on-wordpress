<?php
# New Product Form - Displays The Common Fields For Creating A New Product
function rcw_newproduct_formstart()
{
	echo '<label>Title:<input name="rcw_itemname" type="text" value="" size="50" maxlength="100" /></label>      
        <br />
        <label>Description:<input name="rcw_desc" type="text" value="" size="50" maxlength="250" /></label>      
        <br />        
        <label>Base Price:<input name="rcw_baseprice" type="text" value="" size="7" maxlength="7" /></label>';
}

# Displays Controls For Creation Item Variation/Options With Name And Price Increase
function rcw_variationlist_fields()
{
	echo '<label>Variation One Name:<input name="rcw_varprice1_name" type="text" value="" size="20" maxlength="20" /></label>      
	<label>Variation One Price:<input name="rcw_varprice1_value" type="text" value="" size="20" maxlength="20" /></label>';      
}

# Mode Attribute Menu - Displays Menu For Selecting Mode
function rcw_mode_menu()
{
	echo '<label>Mode:<select name="rcw_mode">
		<option value="normal">Normal</option>
		<option value="stageone">Stage One</option>
		<option value="stagetwo">Stage Two</option>
	</select></label>';
}

# Style Attribute - Displays Menu For Selecting Style
function rcw_style_menu()
{
	echo '
        <label>Style:<select name="rcw_style">
            <option value="default1">Default 1</option>
            <option value="default2">Default 2</option>
            <option value="default3">Default 3</option>
        </select></label>';
}

# Source Attribute - Displays Menu For Selecting Source
function rcw_source_menu()
{
	echo '<label>Source:<select name="rcw_source">
            <option value="search">Search Mode</option>
            <option value="included">Included In Shortcode</option>
            <option value="customfields">Custom Fields Only</option>
        </select></label>';
}

# Button Text Attribute - Displays Menu For Selecting Form Button Text
function rcw_buttontext_menu()
{
 	echo '<label>Button Text:<select name="rcw_buttontext">
            <option value="Buy Now">Buy Now</option>
            <option value="Checkout">Checkout</option>
            <option value="Add To Basket">Add To Basket</option>
            <option value="Add To Cart">Add To Cart</option>
            <option value="Add To Shopping Cart">Add To Shopping Cart</option>
            <option value="Add To Shopping Basket">Add To Shopping Basket</option>
        </select></label>';
}        

# Builds The Form For A Single Product With Button And Variation Menu If Required - No Table, No Image, No Description
# Input: $actionurl, $baseprice, $storeid, $itemname, $postid (if required),$pricevariation,$buttontext,$pricevariation1(will need to be an array eventually)
# Output: returns built form, the display is done by shortcode function
function rcw_displayproduct_default1($mode,$actionurl,$baseprice,$storeid,$itemname,$postid,$buttontext,$pricevariation1)
{
	$romancartform = '
	<form action="'.$actionurl.'" method="post">
		<input name="price" type="hidden" value="'.$baseprice.'" /> 
		<input name="storeid" type="hidden" value="'.$storeid.'" /> 
		<input name="itemname" type="hidden" value="'.$itemname.'" />'.$itemname.':';

		// if this is a stage 1 submission then include the post id for 2nd stage
		if($mode=='stage1' && isset($postid) && !empty($postid))
		{
			$romancartform .= '<input name="rcw_secondstagepostid" type="hidden" value="'.$postid.'" /> ';	
		}
		elseif( $mode == 'stage1' && !isset($postid) || $mode=='stage1' && empty( $postid ) )
		{
			rcw_err('Post ID Missing','There has been error in the multiple stage system for RomanCart. Please seek support and report this issue, thank you for your patience.');
		}
		
		$romancartform .= '<select name="itemname2">';				
		
		// get current posts custom fields - we use loop but we only need one of each custom field
		$custom_fields = get_post_custom($postid);
		
		$variationtotal = $baseprice + $pricevariation1;
		
		$romancartform .= '
			<option value="Birmingham {00.00}">Birmingham (&pound;'.$baseprice.' + VAT)</option> 
			<option value="Coventry (inc Stoneleigh &amp; Ricoh) {00.00}">Coventry (inc Stoneleigh &amp; Ricoh) (&pound;'.$baseprice.' + VAT)</option> 
			<option value="Manchester {'.$pricevariation1.'}">Manchester (&pound;'.$variationtotal.' + VAT)</option> 
			<option value="London {'.$pricevariation1.'}">London (&pound;'.$variationtotal.' + VAT)</option>
			<option value="Other {'.$pricevariation1.'}">Other (&pound;'.$variationtotal.' + VAT)</option> 
			</select><br />
			Quantity
			<select name="quantity"> 
				<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option> 
			</select><br />
			<input name="rcw_productsubmission" type="submit" value="'.$buttontext.'" /> 
		</form>';
	return $romancartform;
}

# Builds The Form For A Single Product With Button And Variation Menu If Required - Has Table, Has Description ($desc), No Image
# Input: $actionurl, $baseprice, $storeid, $itemname, $postid (if required),$pricevariation,$buttontext,$pricevariation1(will need to be an array eventually),$desc
# Output: returns built form, the display is done by shortcode function
function rcw_displayproduct_default2($mode,$actionurl,$baseprice,$storeid,$itemname,$postid,$desc,$buttontext,$pricevariation1)
{
	
	// add descriotion - for not now keeping it very simple
	$romancartform = $desc;
	
	$romancartform .= '
	<form action="'.$actionurl.'" method="post">
		<input name="price" type="hidden" value="'.$baseprice.'" /> 
		<input name="storeid" type="hidden" value="'.$storeid.'" /> 
		<input name="itemname" type="hidden" value="'.$itemname.'" />'.$itemname.':';

		// if this is a stage 1 submission then include the post id for 2nd stage
		if($mode=='stage1' && isset($postid) && !empty($postid))
		{
			$romancartform .= '<input name="rcw_secondstagepostid" type="hidden" value="'.$postid.'" /> ';	
		}
		elseif( $mode == 'stage1' && !isset($postid) || $mode=='stage1' && empty( $postid ) )
		{
			rcw_err('Post ID Missing','There has been error in the multiple stage system for RomanCart. Please seek support and report this issue, thank you for your patience.');
		}
		
		$romancartform .= '<select name="itemname2">';				
		
		// get current posts custom fields - we use loop but we only need one of each custom field
		$custom_fields = get_post_custom($postid);
		
		$variationtotal = $baseprice + $pricevariation1;
		
		$romancartform .= '
			<option value="Birmingham {00.00}">Birmingham (&pound;'.$baseprice.' + VAT)</option> 
			<option value="Coventry (inc Stoneleigh &amp; Ricoh) {00.00}">Coventry (inc Stoneleigh &amp; Ricoh) (&pound;'.$baseprice.' + VAT)</option> 
			<option value="Manchester {'.$pricevariation1.'}">Manchester (&pound;'.$variationtotal.' + VAT)</option> 
			<option value="London {'.$pricevariation1.'}">London (&pound;'.$variationtotal.' + VAT)</option>
			<option value="Other {'.$pricevariation1.'}">Other (&pound;'.$variationtotal.' + VAT)</option> 
			</select><br />
			Quantity
			<select name="quantity"> 
				<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option> 
			</select><br />
			<input name="rcw_productsubmission" type="submit" value="'.$buttontext.'" /> 
		</form>';
		
	return $romancartform;
}

# Builds The Form And Table For A Single Product With Button And Variation Menu If Required - Has Table, Has Description ($desc), Has Image
# Input: $actionurl, $baseprice, $storeid, $itemname, $postid (if required),$pricevariation,$buttontext,$pricevariation1(will need to be an array eventually),$desc, $image
# Output: returns built form, the display is done by shortcode function
function rcw_displayproduct_default3($mode,$actionurl,$baseprice,$storeid,$itemname,$postid,$desc,$image,$buttontext,$pricevariation1)
{		
	$productdisplay = '<form action="'.$actionurl.'" method="post">
		<input name="price" type="hidden" value="'.$baseprice.'" /> 
		<input name="storeid" type="hidden" value="'.$storeid.'" /> 
		<input name="itemname" type="hidden" value="'.$itemname.'" />'.$itemname.':';

		// if this is a stage 1 submission then include the post id for 2nd stage
		if($mode=='stage1' && isset($postid) && !empty($postid))
		{
			$productdisplay .= '<input name="rcw_secondstagepostid" type="hidden" value="'.$postid.'" /> ';	
		}
		elseif( $mode == 'stage1' && !isset($postid) || $mode=='stage1' && empty( $postid ) )
		{
			rcw_err('Post ID Missing','There has been error in the multiple stage system for RomanCart. Please seek support and report this issue, thank you for your patience.');
		}
		
		$productdisplay .= '<select name="itemname2">';				
		
		// get current posts custom fields - we use loop but we only need one of each custom field
		$custom_fields = get_post_custom($postid);
		
		$variationtotal = $baseprice + $pricevariation1;
		
		$productdisplay .= '
			<option value="Birmingham {00.00}">Birmingham (&pound;'.$baseprice.' + VAT)</option> 
			<option value="Coventry (inc Stoneleigh &amp; Ricoh) {00.00}">Coventry (inc Stoneleigh &amp; Ricoh) (&pound;'.$baseprice.' + VAT)</option> 
			<option value="Manchester {'.$pricevariation1.'}">Manchester (&pound;'.$variationtotal.' + VAT)</option> 
			<option value="London {'.$pricevariation1.'}">London (&pound;'.$variationtotal.' + VAT)</option>
			<option value="Other {'.$pricevariation1.'}">Other (&pound;'.$variationtotal.' + VAT)</option> 
			</select><br />
			Quantity
			<select name="quantity"> 
				<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option> 
			</select><br />
			<input name="rcw_productsubmission" type="submit" value="'.$buttontext.'" /> 
		</form>';
	
	// add descriotion - for not now keeping it very simple
	$romancartform = '
	<table border="0" width="592">
		<tbody>
		<tr>
		<td width="178"><img src="'.$image.'" alt="" '. rcw_getimagewidth() . rcw_getimageheight() .' /></td>
		<td width="398">'.$desc.'
		
		'.$productdisplay.'</td>
		</tr>
		</tbody>
	</table>';

	
	return $romancartform;
}

# Creates "width=" Attribute Value For Use In Product Table
# Input:
# Output: returns a string, either with no characters or the width attribute
function rcw_getimagewidth()
{
	$width = '250';// will become user setting
	if( empty( $width ) || $width == NULL  )
	{
		return ' ';
	}
	elseif( !empty( $width ) && $width != NULL  )
	{
		return 'width="'.$width.'"';		
	}
}

# Creates "height=" Attribute Value For Use In Product Table
# Input:
# Output: returns a string, either with no characters or the height attribute
function rcw_getimageheight()
{
	$height = '250';// will become user setting
	if( empty( $height ) || $height == NULL  )
	{
		return ' ';
	}
	else
	{
		return 'height="'.$height.'"';		
	}
}

# Post Box Object Styled By Wordpress
# Input: box title, instructions paragraph, form or table, "open or closed"
# Output: echo the box with passed content in it
function rcw_dropdownbox($title,$instructions,$form,$control)
{?>
	<div class="postbox <?php echo $control; ?>">
		<div class="handlediv" title="Click to toggle"><br /></div>
		<h3><?php echo $title; ?></h3>
		<div class="inside">
			<p><?php echo $instructions; ?></p>
            <?php echo $form; ?>
		</div>
	</div><?php 
}

# Applys Wrap Style And Displays Page Title - Also Displays Tutorial Link If Required
function rcw_header($title,$tutorialurl,$tutorialname)
{
	echo '<div class="wrap">';
	echo '<div id="poststuff" class="meta-box-sortables" style="position: relative; margin-top:10px;"><br />';
	echo '<h1>'. $title .'</h1>';	
}

function rcw_footer()
{?>
	<p>Developed By <a href="http://www.brighterwebs.eu" title="Visit BrighterWebs, the plugin author website">BrighterWebs 2010</a></p> 
   <script type="text/javascript">
        // <![CDATA[
        jQuery('.postbox div.handlediv').click( function() { jQuery(jQuery(this).parent().get(0)).toggleClass('closed'); } );
        jQuery('.postbox h3').click( function() { jQuery(jQuery(this).parent().get(0)).toggleClass('closed'); } );
        jQuery('.postbox.close-me').each(function(){
        jQuery(this).addClass("closed");
        });
        //-->
    </script><?php
	$wtgdebug=1;
	if($wtgdebug==1){echo'<h2>Debuggin Data</h2>';$rcw=get_option('rcw_settings' );print"<pre>";print_r($rcw);print"</pre>";}
}	

# Outputs A Standard/Success Message
# Requires: title, message
function rcw_mes($t,$m){echo'<div id="message" class="updated fade"><strong>'.$t.'</strong><p>'.$m.'</p></div>';}

# Ouputs Error/Fail
# Requires: title, message
function rcw_err($t,$m){echo'<div id="error" class="error"><strong>'.$t.'</strong><p>'.$m.'</p></div>';}
?>
