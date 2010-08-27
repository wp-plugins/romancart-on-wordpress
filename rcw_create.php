<?php rcw_header('RomanCart on Wordpress Create Product','','');?>

<?php 
rcw_newproductpage_process();
?>

<p>The tools on this page will allow you to automatically create new pages in your blog and also add products to those pages at the same time.
You may add products to existing post or pages also and you have the option of placing a product form at the start or end of existing content.</p>

<div class="postbox closed">
<div class="handlediv" title="Click to toggle"><br /></div>
    <h3>New Page &amp; New Product</h3>
    <div class="inside">
    <form method="post" name="rcw_newproductpage_form" action=""> 
        <label>Post Type:<select name="rcw_postype">
            <option value="post">Post</option>
            <option value="page">Page</option>
        </select></label>
        <br />
        <label>Main Category:<select name="rcw_maincategory">
            <option value="1">Default (uncategorised)</option>
        </select></label>
        <br />
    	<?php rcw_newproduct_formstart(); ?>   
        <br />   
        <br />   
        <br />   
            <div class="postbox closed">
                <div class="handlediv" title="Click to toggle"><br /></div>
                <h3>Product Options And Price Variations (not required)</h3>
                <div class="inside">
                	<p>Price values added here are added to the base price. If a variation costs equal to the base price then enter 0.00.</p>
                    <label>Variations:<input name="rcw_variations" type="text" value="" size="7" maxlength="7" /></label>     
			        <br />
					<?php rcw_variationlist_fields(); ?>   
                    <br />               
                    <p>The system for handling multiple variations is not yet in place please do not use these fields in this version.</p>
                </div>
            </div>         
        <h4>Shortcode Attributes</h4>
        <?php rcw_mode_menu(); ?>
        <br />
        <?php rcw_style_menu(); ?>     
        <br />
        <?php rcw_source_menu(); ?>     
        <br />
        <?php rcw_buttontext_menu(); ?>
        <br />
        <label>Stage Two Post ID:<input name="rcw_postid" type="text" value="" size="7" maxlength="7" />(only required shortcode mode is not normal)</label>     
        <br /><br />
        <input class="button-primary" type="submit" name="rcw_newproductpage_submit" value="Submit" />
    </form>	
    </div>
</div>

<div class="postbox closed">
    <div class="handlediv" title="Click to toggle"><br /></div>
    <h3>Add New Product To Existing Page</h3>
    <div class="inside">
	Not yet available in the beta edition.
    </div>
</div>

<?php rcw_footer(); ?>