<?php
rcw_header('RomanCart on Wordpress Developer Notes','','');
?>
38254
<p>Author: Ryan Bayne </p>
<p>Updated: 21st August 2010</p>
<p>Version: 0.2</p>
<div class="postbox closed">
<div class="handlediv" title="Click to toggle"><br /></div>
    <h3>High Priority</h3>
    <div class="inside">
        <ol>
          <li>Provide setting&nbsp;for default store id.</li>
          <li>Hide or mark recently edited products on edit page&nbsp;(probably best having ability to reset, $_SESSION the best approach I think)</li>
          <li>Provide option to override store id stored in shortcode or custom field at product display point</li>
          <li>Create question and answer system&nbsp;that must be&nbsp;done to operate the plugin.</li>
          <li>Paged list of products for bulk edit (retrieve custom field data and display in forms).</li>
          <li>Make a proper shopping cart with product management before submitting anything to RomanCart. Submit all products at once during checkout. Not perfect as the cart wont update changes made on RomanCarts own pages.</li>
          <li>Create a conditions system. Conditions that can be applied to specific post id's which overwrite attribute values etc.&nbsp;Provide ability to make them temporary such as discounts with </li>
      </ol>
    </div>
</div>	

<div class="postbox closed">
    <div class="handlediv" title="Click to toggle"><br /></div>
    <h3>Low Priority</h3>
    <div class="inside">
        <ol>
          <li>More short code styles.</li>
          <li>Provide optional ability to stop customers going to RomanCart checkout page every time they add an item to the cart. We would do this by storing the id's of items selected&nbsp;then on checkout, build a form for submission that includes all the requested items.</li>
          <li>CSV product file upload.</li>
          <li>Automated tags from product descriptions plus overall post content.</li>
          <li>Shortcodes for displaying a list of products with paging. Search criteria would be by existing tags, category or standard keyword.</li>
          <li>On the plugin interface, provide multimedia uploading and automatically place the id into shortcode or custom field.</li>
          <li>Setup system for user creating pre-set shortcode templates with all the attributes they select.</li>
          <li>Allow user to setup their own pre-set button text.</li>
          <li>Add function for more indepth checking of submitted post id value to ensure that it matches existing post and confirm the post with the user on interface.</li>
          <li>Setup wyswigy editor with tokens to create product display templates.</li>
          <li>Allow wysiwyg editing of widget display.</li>
      </ol>
    </div>
</div>	

<div class="postbox closed">
    <div class="handlediv" title="Click to toggle"><br /></div>
    <h3>Requested Priority</h3>
    <div class="inside">
        <ol>
          <li>Coming Soon</li>
      </ol>
    </div>
  <?php 
rcw_footer(); 
?>
</div>