<?php
rcw_header('RomanCart on Wordpress Guide','','');
?>

<div class="postbox closed">
    <div class="handlediv" title="Click to toggle"><br /></div>
    <h3>Custom Fields</h3>
    <div class="inside">
    <p>Add the required custom fields to your product posts for the information to be displayed on the post. The post content must have a shortcode placed in it also. The best way for custom fields to be setup is by using the plugins interface to add products to posts. Also, you do not need to use custom fields if you use the &quot;include&quot; method which requires all information to be placed in the shortcode itself. All custom fields are not required if you decide to use this method, please read and understnad which ones you need. </p>
        <ol>
          <li>rcw_mode <a href="#" title="Each mode triggers specific functions. Use normal until you need and understand the other modes. ( normal, stageone, stagetwo)">?</a></li>
          <li>rcw_style <a href="#" title="The style attribute value decides not only which layout is used but what content is displayed on a page using the shortcode. (default1,default2,default3)">?</a></li>
          <li>rcw_source <a href="#" title="This indicates the source of content/data values. You may leave it blank to use the default &quot;search&quot; method. (included,customfields)">?</a></li>
          <li>rcw_itemname <a href="#" title="This is the title of your product. Settings allow you to use the post title as the default item name which appears within the posts content with the form itself.">?</a></li>
          <li>rcw_baseprice <a href="#" title="The standard price of your product without any deductions or additions from special offers or your own requirements.">?</a></li>
          <li>rcw_buttontext <a href="#" title="Sometimes it might be suitable to show a different text value on your form buttom. Do not use this if you want to use the default.">?</a></li>
          <li>rcw_pricevariation1 <a href="#" title="This is part of a more advanced system still under development. It allows an increase of the base price where multiple options are offered in a form. Do not use it unless you have more than one option for a product.">?</a></li>
          <li>rcw_desc <a href="#" title="Some styles will display a product description for you. If your not entering the description into the content of your post in the normal way, you may use this custom field to hold the description for displaying with a style that uses it. The &quot;default1&quot; style does not use a description.">?</a></li>
          <li>rcw_storeid <a href="#" title="In the event that you use multiple RomanCart accounts i.e. for different currency. You can override the default store id using this. Do not use this if you only work with a single store id. Simply ensure the settings holds your store id for it to act as a default.">?</a></li>
          <li>rcw_postid <a href="#" title="This should only be used with special modes. It is required for passing to functions triggered by special modes and is only needed when you know the mode you are using requires it. The &quot;normal&quot; mode does not require this to be used.">?</a></li>
      </ol>
    </div>
</div>	

<div class="postbox closed">
    <div class="handlediv" title="Click to toggle"><br /></div>
    <h3>Short Codes Crash Course</h3>
  <div class="inside">
    <p>There are two main ways to add product data to your blog. You can either create custom fields or add all information to the RomanCart plugins shortcode.
    If you want to make sure of the plugins tools for managing products, you must use custom fields at all times. If you want to edit each product within it's own
    post at all times then simply use the alternative method. Below are two main examples to get you started however there are more advanced and flexable
    shortcode variations. Also, if you want to display multiple items on one page you currently need to use the "included" method and not "customfields" method.</p>
    <p>Hover over the ? at the end of each short code for more advice.</p>
    <h4>Included Method (source&nbsp;= included)</h4>
    <p>The included method is what it suggests, all information included in the shortcode itself. This can be good if your not getting your head around custom fields or have good reason not to use custom fields. It is recommended that you include all information possible, otherwise the plugin will use default values which won't always be suitable for your product. The first example shows all possible values for you to make use of and the second example shows the minimum. Any values not entered in the second will cause default values to be used i.e. the &quot;buttontext&quot; may end up saying &quot;Add To Basket&quot; instead of &quot;Buy Now&quot; as used in example one.</p>
    <ol>
      <li>[rcw_singleitem mode=&quot;normal&quot; style=&quot;default1&quot; source=&quot;included&quot; itemname=&quot;Your Product Name&quot; baseprice=&quot;24.99&quot;  buttontext=&quot;Buy Now&quot; pricevariation1=&quot;5.00&quot;]&nbsp; <a href="#" title="Notice that the source is &quot;included&quot;. This tells the plugin that all product information is within the short code, not in custom fields. This example has all the common values entered for maximum control over the output." target="_blank">?</a></li>
      <li>[rcw_singleitem mode=&quot;normal&quot; style=&quot;default1&quot; source=&quot;included&quot; itemname=&quot;Your Product Name&quot; baseprice=&quot;24.99&quot;]&nbsp; <a href="#" title="This example does not include the buttontext attribute. It will cause the default value for this attribute to be used. Not included any other attributes will cause the same thing to happen however all other attributes in this example are the minimum requirements in most cases." target="_blank">?</a></li>
      <li>[rcw_singleitem mode=&quot;normal&quot; style=&quot;<strong>default2</strong>&quot; source=&quot;included&quot; itemname=&quot;Your Product Name&quot; baseprice=&quot;24.99&quot; desc=&quot;Your product description&quot;]&nbsp; <a href="#" title="The difference in this example is the &quot;style&quot; attribute value. It shows &quot;default2&quot;. You will need to read about each style available to understand what it does, but in this case it expects a description made available using the &quot;desc&quot; attribute. It will cause a description to be displayed within a html table along with the product form." target="_blank">?</a></li>
    </ol>
    <h4>Custom Fields Method (source&nbsp;= customfields)</h4>
    <p>This method allows the plugin and blog to access product data in more ways, easily. However if you have no advanced needs you may use the included method as it will be a little more straight forward and simplier from a users point of view. One advantage you do get when using custom&nbsp;fields is that the RomanCart plugin allows you to edit all your products from one screen, rather than opening each individual post and messing around with custom fields directly. Below are some examples, starting with the most basic. An important thing to understand is that the plugins interface will allow you to automatically place these shortcodes in posts so you don't need to yourself.</p>
    <ol>
      <li>[rcw_singleitem mode=&quot;normal&quot; style=&quot;default1&quot; source=&quot;customfields&quot;]&nbsp;<a href="#" title="This is the sort of shortcode this plugin will enter to a post automatically when using the interface to create products. It does not need a post id or anything like that and the minimum requirements is the source attribute. If you remove &quot;normal&quot; and &quot;style&quot; they will simply rely on the default.">?</a></li>
      <li>[rcw_singleitem  source=&quot;customfields&quot;]&nbsp;<a href="#" title="This may be what you decide to use and it indicates that the plugin should find all the data it needs in custom fields. If any custom fields are not found for required values, the default will be used. If you do not setup a custom field for the &quot;mode&quot; for example, &quot;normal&quot; will be applied as the mode automatically. See the list of default values or change them in settings.">?</a></li>
    </ol>
    <h4>Search Method ( no source attribute )</h4>
    <p>If you do not include the &quot;source&quot; attribute in your shortcode, your telling the plugin to find all required values in either custom fields, the shortcode itself or use the default. This is perfect if you have other plugins that can work with some of your custom fields. Some people will add values to the shortcode and add the same values to custom fields, sort of duplicating their existance. It has no negative effect on the working of the plugin but has no real advantage unless your theme or system of working really needs it.</p>
    <ol>
      <li>[rcw_singleitem] <a href="#" title="This is the shortest possible shortcode and will cause the plugin to use the values it can find in custom fields or use default values.">?</a></li>
      <li>[rcw_singleitem style=&quot;default1&quot;] <a href="#" title="Using the shortest approach, you can add atributes to control the outcome i.e. the style attribute will allow you to control what layout (output) is used. Each style requires different data so you do not always need to create every custom field possible especially if you use &quot;default1&quot; which uses no image or descroption.">?</a></li>
    </ol>
</div>
</div>	


<div class="postbox closed">
    <div class="handlediv" title="Click to toggle"><br /></div>
    <h3>Attribute Explained</h3>
 	<div class="inside">
        
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Mode Attributes</h3>
          <div class="inside">
            <p>The mode attribute is an advanced feature and may only be available in the premium versions due to the level of support that may be required to instruct its use. In most cases we will use the normal mode but other modes allow us to activate special functions that do all sorts of cool things. More of these special functions will be added to the premium version as sales come in.</p>
              <ol>
                <li>normal <a href="#" title="In most cases you will use the normal attribute, it does nothing extra and has no complicated instructions with it.">?</a></li>
                <li>stageone <a href="#" title="The &quot;stageone&quot; mode value should not be used unless you are aware of what it does and the other attributes that it needs to work. The stageone works with stagetwo and both must be used within your blog to complete a stage to stage process. It allows us to forward customers to a secondary product page where an item requires an additional item to be selected in order to complete the adding of the main item to the cart i.e. make the user select a stand from a range of them after selecting a television. It is currently in a basic form, requireing the secondary items to be on the stagetwo page however in the premium edition we hope to add a more complex system that lists all secondary products using their ID's avoiding the need to build the stagetwo page. You must use the &quot;postid&quot; attribute when using stageone. The ID entered is the post ID for the stagetwo post.">?</a></li>
                <li>stagetwo <a href="#" title="This must only be used if you have used the &quot;stageone&quot; value in another shortcode. The post using stagetwo must also hold the products that are secondary to a main item on the stageone page. Users will be forwarded to the stagetwo page automatically and required to select an item from the page in order to complete the basket process. If no secondary item is selected, the primary item is not added to basket.">?</a></li>
            </ol>
              <p><strong>Custom Field Key: Not Applicable, can only be used in shortcode</strong></p>
          </div>
        </div>	
        
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Style Attribute</h3>
          <div class="inside">
            <p>The style value determines if the output includes a table and decides what the table holds if any. The plugin has three common style values available 
            on installation. The default style (default1) will only show the form itself without description or image. It is ideal for placing in the post manually when you have structured your own table and content. Eventually custom styles can also be created, that ability may only be offered in a premium version&nbsp;due to the level of support that will be required&nbsp;the more advanced this plugin gets.</p>
              <ol>
                <li>default1 <a href="#" title="This requires the products price and name only. No table is added to the html, only a form.">?</a></li>
                  <li>default2 <a href="#" title="Similiar to default1 but it will add a product description above your form. A table is used to structure the content in your post and the text appears above the form.">?</a></li>
                  <li>default3 <a href="#" title="Similiar to default2 but will add a product image. It means you must use the image attribute and the image will be displayed left of the description (also required) and form.">?</a></li>
                  <li>More style values in the premium edition.</li>
            </ol>
              <p><strong>Custom Field Key: Not Applicable, can only be used in shortcode</strong></p>
          </div>
        </div>	
            
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Source Attribute</h3>
          <div class="inside">
            <p>There are options available regarding where to place your product information in terms of data. You may save it in your post content as part of the shortcode or you may create custom fields. Custom fields can be done manually or you can use the plugins interface to setup new products and custom fields will be created automatically as part of that process. The premium edition&nbsp;will&nbsp;have the option for custom fields to be created and updated autmatically from the data added to the shortcode. CSV file upload will also be available in the premium edition.</p>
              <ol>
                <li>included <a href="#" title="This method is when you add your product data to the shortcode (you can make the plugin do it automatically using the interface also). You may add or avoid the use of any attributes you wish, triggering the use of many default values and finding the perfect combination to suit your needs.">?</a></li>
                <li>customfields <a href="#" title="This is where your shortcode tells the plugin to find all the data it needs in custom fields. The custom field names are similiar to the names of attributes for shortcodes when using included method but have &quot;rcw_&quot; at the beginning of each custom field key/name. That is simply to avoid conflict with other plugins. Using this method will allow you to use more of the plugins interface in this free edition. The premium edition will aim to make the interface as usable for the included approach as custom fields.">?</a></li>
                <li>Search Method (leave blank) <a href="#" title="Do not include any source attribute within your shortcode to trigger what I call the search method simply to help everyone understand it. Also it may become more advanced in the premium version with the ability to search a database table. The search method simply trys to find all the product data using all sources. If the shortcode does not hold an attribute that is required by the used style then the plugin will look for the value within custom fields. If a custom field cannot be found for the product within the post then the default value will be used. Understanding how this works can allow a high flexability especially when using other plugins that can interact with custom fields.">?</a></li>
            </ol>
              <p><strong>Custom Field Key: Not Applicable, can only be used in shortcode</strong></p>
          </div>
        </div>	
        
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Postid Attribute</h3>
          <div class="inside">
            <p>The postid attribute is not required when using mode=&quot;normal&quot; within your shortcode. If you are using a different mode you may require the postid attribute i.e. mode=&quot;stageone&quot; requires it and the id entered must be the post you want as your &quot;stagetwo&quot;.</p>
              <ol>
                <li>Example: 345 <a href="#" title="You will find your post id when you open the post in the Edit Post screen. Check the url value for the number. Only a number/intiger can be used. This attribute is not always required, please ensure you need it before using it.">?</a></li>
            </ol>
              <p><strong>Custom Field Key: wcm_postid</strong></p>
          </div>
        </div>	
        
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Itemname Attribute</h3>
          <div class="inside">
            <p>Simply your product name/title. Text and numbers are allowed.&nbsp;There are currently no special functions available within this attribute.  </p>
            <p><strong>Custom Field Key: wcm_itemname</strong></p>
          </div>
        </div>	
        
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Baseprice Attribute</h3>
          <div class="inside">
            <p>The baseprice is not a new term for RomanCart users if you have worked directly with the html forms. It is simply your standard product price without any additions/addons/extras or even deducations from discounts or refunds. Please do not enter your currency character.&nbsp;We hope to add currency calculation functions in the premium version&nbsp;for those of you who might use multiple RomanCart accounts per site. If this appeals to you please contact <a href="#" title="mailto:info@brighterwebs.com">info@brighterwebs.com</a> and register your interest. This helps us guage the level of demand.</p>
            <p><strong>Custom Field Key: wcm_baseprice</strong></p>
          </div>
        </div>	
        
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Description Attribute</h3>
          <div class="inside">
            <p>This can either be your full or partial product description. I recommend a partial, maybe a simple sentence as it is displayed close to your form. You may also type instructions for your product instead and simply enter the product description into post content. The premium version will extract keywords from your descriptions, automatically create tags if you wish and use the description elsewhere in your theme if you apply it to custom fields.</p>
            <p><strong>Custom Field Key: wcm_desc</strong> (not wcm_description)</p>
          </div>
        </div>	
        
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Image Attribute</h3>
          <div class="inside">
            <p>Provide the full url to an image which will be displayed on the page. The premium edition will have the ability to enter the Wordpress media id and other methods to making it easier to link an image to your product&nbsp;display.</p>
            <p><strong>Custom Field Key: wcm_image</strong></p>
          </div>
        </div>	
        
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Storeid Attribute</h3>
          <div class="inside">
            <p>Each RomanCart account has a store id. The plugin allows you to set a default id for your store so the attribute does not need to be used ever as it will simply use the default value. The premium edition will support multiple storeid's for those of you who want to use different currencies on a single site with ease. The storeid in use is simply switched to match the currency that the visitor selects from any made available. This would happen when prices are converted to match the selected currency.</p>
            <p><strong>Custom Field Key: wcm_storeid</strong></p>
          </div>
        </div>	
        
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Pricevariation1 Attribute</h3>
          <div class="inside">
            <p>This is the start to a function that will become far more advanced especially in the premium edition. The plugin will support variations in prices through menus on the product form. Experianced RomanCart users will be aware of this and in terms of the html form it is nothing special but what is special is the fact that this plugin will allow you to build as many variations as you need per form. Right now we're still deciding how this will work exactly in terms of the shortcode and custom fields. For now, the pricevariation1 is the only variation and will add the extra value to the baseprice to get total cost which can be displayed in selected options with the product menu.</p>
            <p>It may be best to watch videos on this and I should make clear that the BETA version may have extra form items until this area is perfected.</p>
            <p><strong>Custom Field Key: wcm_pricevariation1</strong></p>
          </div>
        </div>	
        
        <div class="postbox closed">
            <div class="handlediv" title="Click to toggle"><br /></div>
            <h3>Buttontext Attribute</h3>
          <div class="inside">
            <p>You can change the text displayed on the product form button using this attribute. Buy Now, Add To Cart etc. There are no advanced functions for this at the moment and not using the attiribute will cause the default value to be used.</p>
            <p><strong>Custom Field Key: wcm_buttontext</strong></p>
          </div>
        </div>	


  </div>
</div>	

               
<?php 
rcw_footer(); 
?>
