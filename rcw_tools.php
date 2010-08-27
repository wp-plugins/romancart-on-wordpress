<?php rcw_header('RomanCart on Wordpress Tools','','');?>

<?php 
rcw_uninstallplugin();
?>

<?php $rcw = get_option('rcw_settings'); ?>

<div class="postbox closed">
	<div class="handlediv" title="Click to toggle"><br /></div>
	<h3>Uninstall Plugin</h3>
	<div class="inside">
    <p>This button will not delete post, pages or remove any product data. It will only delete the plugins own settings. You must delete the plugin itself the usual way, from
    the plugin administration page. Simply install the plugin again anytime in future if you want to add or edit products.</p>
      	<form method="post" name="rcw_uninstallplugin_form" action="">                   
			<input class="button-primary" type="submit" name="rcw_uninstallplugin_submit" value="Uninstall Plugin" />
        </form>
	</div>
</div>

<?php rcw_footer(); ?>