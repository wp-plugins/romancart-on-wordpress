<?php
# Checks Up To 20 (10 pairs) Of Custom Field Keys
# Requires: $vars (users requested number of variations)
if($variations > 0)
{
	$v1n = rcw_getproduct_variationname($custom_fields,1);
	$v1p  = rcw_getproduct_variationprice($custom_fields,1);						
}					

if($variations > 1)
{
	$v2n = rcw_getproduct_variationname($custom_fields,2);
	$v2p  = rcw_getproduct_variationprice($custom_fields,2);						
}					

if($variations > 2)
{
	$v3n = rcw_getproduct_variationname($custom_fields,3);
	$v3p  = rcw_getproduct_variationprice($custom_fields,3);						
}					

if($variations > 3)
{
	$v4n = rcw_getproduct_variationname($custom_fields,4);
	$v4p  = rcw_getproduct_variationprice($custom_fields,4);						
}					

if($variations > 4)
{
	$v5n = rcw_getproduct_variationname($custom_fields,5);
	$v5p  = rcw_getproduct_variationprice($custom_fields,5);						
}					

if($variations > 5)
{
	$v6n = rcw_getproduct_variationname($custom_fields,6);
	$v6p  = rcw_getproduct_variationprice($custom_fields,6);						
}					

if($variations > 6)
{
	$v7n = rcw_getproduct_variationname($custom_fields,7);
	$v7p  = rcw_getproduct_variationprice($custom_fields,7);						
}					

if($variations > 7)
{
	$v8n = rcw_getproduct_variationname($custom_fields,8);
	$v8p  = rcw_getproduct_variationprice($custom_fields,8);						
}					

if($variations > 8)
{
	$v9n = rcw_getproduct_variationname($custom_fields,9);
	$v9p  = rcw_getproduct_variationprice($custom_fields,9);						
}					

if($variations > 9)
{
	$v10n = rcw_getproduct_variationname($custom_fields,10);
	$v10p  = rcw_getproduct_variationprice($custom_fields,10);						
}
?>