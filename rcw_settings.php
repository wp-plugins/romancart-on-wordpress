<?php rcw_header('RomanCart on Wordpress Settings','','');?>

<?php 
rcw_savesettings_shortcodedefaults(); 
rcw_savesettings_postcreationsettings(); 
rcw_savesettings_currencysettings(); 
rcw_savesettings_widgetonesettings(); 
?>

<?php $rcw = get_option('rcw_settings'); ?>

<div class="postbox closed">
	<div class="handlediv" title="Click to toggle"><br /></div>
	<h3>Post Creation Options</h3>
	<div class="inside">
      	<form method="post" name="rcw_postcreationsettings_form" action="">            
            
            <label>Generate Tags<select name="rcw_tags" size="1">
            	<option value="No" <?php rcw_echoselected($rcw['postcreation']['tags'],'No'); ?>>No</option>
            	<option value="Yes" <?php rcw_echoselected($rcw['postcreation']['tags'],'Yes'); ?>>Yes</option>
            </select></label>

            <label>Allow Pings<select name="rcw_pings" size="1">
            	<option value="No" <?php rcw_echoselected($rcw['postcreation']['ping'],'No'); ?>>No</option>
            	<option value="Yes" <?php rcw_echoselected($rcw['postcreation']['ping'],'Yes'); ?>>Yes</option>
            </select></label>
       
			<input class="button-primary" type="submit" name="rcw_postcreationsettings_submit" value="Save Post Creation Settings" />
        </form>
	</div>
</div>

<div class="postbox closed">
	<div class="handlediv" title="Click to toggle"><br /></div>
	<h3>Shortcode Default Configuration</h3>
	<div class="inside">
      	<form method="post" name="rcw_shortcodesettings_form" action="">  
			<?php rcw_mode_menu($rcw['shortcodedefaults']['mode']); ?>
            <br />
            <?php rcw_style_menu($rcw['shortcodedefaults']['style']); ?>     
            <br />
            <?php rcw_source_menu($rcw['shortcodedefaults']['source']); ?>     
            <br />
            <?php rcw_buttontext_menu($rcw['shortcodedefaults']['buttontext']); ?>
            <br />
            <label>Item Name<input name="rcw_itemname" type="text" value="<?php echo $rcw['shortcodedefaults']['itemname']; ?>" size="10" maxlength="20" /></label>
            <br />
            <label>Base Price<input name="rcw_baseprice" type="text" value="<?php echo $rcw['shortcodedefaults']['baseprice']; ?>" size="10" maxlength="20" /></label>
            <br />
            <label>Description<input name="rcw_desc" type="text" value="<?php echo $rcw['shortcodedefaults']['desc']; ?>" size="10" maxlength="100" /></label>
            <br />
            <label>Post ID<input name="rcw_postid" type="text" value="<?php echo $rcw['shortcodedefaults']['postid']; ?>" size="10" maxlength="100" /></label>
            <br />
			<input class="button-primary" type="submit" name="rcw_shortcodesettings_submit" value="Save Shortcode Settings" />
        </form>
	</div>
</div>

<div class="postbox closed">
	<div class="handlediv" title="Click to toggle"><br /></div>
	<h3>Currency Setup</h3>
	<div class="inside">
      	<form method="post" name="rcw_currencysettings_form" action="">            
            <label>Symbol<input name="rcw_symbol" type="text" value="<?php echo $rcw['currency']['symbol']; ?>" size="3" maxlength="1" /></label>
            <br />
            <label>Code<input name="rcw_postid" type="text" value="<?php echo $rcw['currency']['code']; ?>" size="3" maxlength="3" /></label>
            <br />      
			<input class="button-primary" type="submit" name="rcw_currencysettings_submit" value="Save Currency Settings" />
        </form>
	</div>
</div>

<div class="postbox closed">
	<div class="handlediv" title="Click to toggle"><br /></div>
	<h3>Shopping Cart Widget Settings</h3>
	<div class="inside">
      	<form method="post" name="rcw_widgetonesettings_form" action="">            
            <label>Title<input name="rcw_title" type="text" value="<?php echo $rcw['widgetone']['title']; ?>" size="15" maxlength="15" /></label>
            <br />      
			<input class="button-primary" type="submit" name="rcw_widgetonesettings_submit" value="Save Shopping Cart Widget Settings" />
        </form>
	</div>
</div>

<?php rcw_footer(); ?>