<?php rcw_header('RomanCart on Wordpress Edit Products','','');?>

<p>This page displays products found in posts using "customfields" source method only. Later upgrades will allow editing of shortcode based products.</p>

<?php
// processsing begins here
rcw_saveproducts_basic();
// processing ends here
?>
<a href="?page=rcw_edit&view=standard" title="Show the base price and short description only, most common required">Standard</a> - 
<a href="?page=rcw_edit&view=prices" title="Hide the description and show price variations">Prices</a> - 
<a href="#" title="View products with statistics on views (more statistics will come much later)">Statistical (comming soon)</a> - 
<a href="#" title="Images for products will be displayed in the list. (we're hoping to allow quick editing of the edit i.e. delete and reupload)">Images (comming soon)</a> - 
<?php
// set requested view
if(!isset($_GET['view']))
{
	$view = 'standard';
	$title = 'Description';
}
else
{
	$view = $_GET['view'];
	$title = 'Variations';
}

// display search results
$limit = 100;

// begin building table
$output = '
<form method="post" name="rcw_editproducts" action="?page=rcw_edit&view='.$view.'">            
<table class="widefat post fixed">
<tr>
	<th width="50" scope="col">Post ID</th>
	<th width="200" scope="col">Title</th>
	<th width="75" scope="col">Base Price</th>
	<th scope="col">'.$title.'</th>
</tr>';

// check if paging has been clicked
if (isset($_GET['product_page'])){$page = $_GET['product_page']; }else{$page = 1;}

// calculate paging starting record
$start = ( $page - 1 ) * $limit;

global $wpdb;
$posttable = $wpdb->prefix . "posts";
$postmetatable = $wpdb->prefix . "postmeta";

// get records from pagings start and the per page limit passed to function
$results = $wpdb->get_results("
SELECT $posttable.ID,$posttable.post_title,$postmetatable.meta_value
FROM $posttable
INNER JOIN 
$postmetatable
ON $postmetatable.post_id = $posttable.ID
WHERE $postmetatable.meta_key = 'rcw_storeid' 
ORDER BY $posttable.ID DESC LIMIT $start, $limit", OBJECT);

//get total rows using exact same query
$totalrows = $wpdb->get_var("
SELECT COUNT(*) 
FROM $posttable
INNER JOIN 
$postmetatable
ON $postmetatable.post_id = $posttable.ID
WHERE $postmetatable.meta_key = 'rcw_storeid' 
ORDER BY $posttable.ID DESC LIMIT $start, $limit");
	
// if records retrieved list them     
if ($results)
{
	$formobjectid = 0;// used to increment form objects for tracking the submission

	// add the view to hidden field - we need to know what form data to expect on submission
	$output .= '<input name="rcw_formview" type="hidden" value="'. $view .'" />';

	foreach ($results as $record)
	{
		// add post id to hidden field
		$output .= '<input name="rcw_postid'. $formobjectid .'" type="hidden" value="'. $record->ID .'" />';
		
		// create new table row for a single record
		$output .= '<tr>';
		$output .= '<td>'. $record->ID .'</td>';
		$output .= '<td><strong>'. $record->post_title .'</strong></td>';

		// add base price in text box for edit
		$output .= '<td><input name="rcw_baseprice'. $formobjectid .'" type="text" size="8" maxlength="8" value="'. get_post_meta($record->ID, 'rcw_baseprice', true) .'" /></td>';

		if( $view == 'standard' )
		{
			// add description in text box for edit
			$output .= '<td><input name="rcw_desc'. $formobjectid .'" type="text" size="100" maxlength="100" value="'. get_post_meta($record->ID, 'rcw_desc', true) .'" /></td>';	
		}
		elseif( $view == 'prices' )
		{
			// get variation count
			$productvariations = get_post_meta($record->ID, 'rcw_variations', true);
			
			// does the product have any variations set at all - if not do not attempt to display variation fields
			if( $productvariations == 0 )
			{
				$output .= '<td>No Variations Options Have Been Set For This Product</td>';
				$output .= '<input name="rcw_productvariations'. $formobjectid .'" type="hidden" value="0" />';
			}
			elseif( $productvariations > 0 )
			{			
				// hidden field for vars count save us gtting it later
				$output .= '<input name="rcw_productvariations'. $formobjectid .'" type="hidden" value="'. $productvariations .'" />';
	
				$looptrack = 0;// counts loops
				
				$varno = 1;// form object number, increased during loop, starts at 1 not 0
				
				$output .= '<td>';
				
				while( $looptrack < $productvariations )
				{				
					$output .= 'Name '.$varno.':<input name="rcw_v'.$varno.'n'. $formobjectid .'" type="text" size="50" maxlength="100" value="'. get_post_meta($record->ID, 'rcw_v'.$varno.'n', true) .'" /> ';	
					
					$output .= 'Price '.$varno.':<input name="rcw_v'.$varno.'p'. $formobjectid .'" type="text" size="8" maxlength="8" value="'. get_post_meta($record->ID, 'rcw_v'.$varno.'p', true) .'" />';	
					
					$output .= '<br />';
					
					++$varno;
					++$looptrack;
				}
				
				$output .= '</td>';	
			}
		}
				
		// end row
		$output .= '</tr>';
		
		++$formobjectid;
	}
}
else
{
}

// add total number of items on display to hidden field - used in loop when processing submission
$output .= '<input name="rcw_count" type="hidden" value="'. $formobjectid .'" />';

$output .= '</table><br /><input class="button-primary" name="rcw_saveproducts_basic" type="submit" value="Save Changes (do this before viewing a different record set)" /> </form>';

//Number of pages setup
$pages = ceil($totalrows / $limit)+1;
for($r = 1;$r<$pages;$r++) 
{
	$output .= "<br /><a href='admin.php?page=". $_GET['page'] ."&product_page=".$r."' class=\"button rbutton\">".$r."</a>&nbsp;";
}

// dislplay resulting list
echo $output;
?>

<?php rcw_footer(); ?>