<?php
# Adds Variations To Product Form In A Menu
# Requires: $variations (users requested number of variations), $baseprice (used to calculate variation total)
if($variations > 0)
{
	$total = $baseprice + $v1p;
	$romancartform .= '<option value="'.$v1n.' {'.$v1p.'}">'.$v1n.' (&pound;'.$total.' + VAT)</option>';
}									
				
if($variations > 1)
{
	$total = $baseprice + $v2p;
	$romancartform .= '<option value="'.$v2n.' {'.$v2p.'}">'.$v2n.' (&pound;'.$total.' + VAT)</option>';
}					

if($variations > 2)
{
	$total = $baseprice + $v3p;
	$romancartform .= '<option value="'.$v3n.' {'.$v3p.'}">'.$v3n.' (&pound;'.$total.' + VAT)</option>';
}					

if($variations > 3)
{
	$total = $baseprice + $v4p;
	$romancartform .= '<option value="'.$v4n.' {'.$v4p.'}">'.$v4n.' (&pound;'.$total.' + VAT)</option>';
}					

if($variations > 4)
{
	$total = $baseprice + $v5p;
	$romancartform .= '<option value="'.$v5n.' {'.$v5p.'}">'.$v5n.' (&pound;'.$total.' + VAT)</option>';
}					

if($variations > 5)
{
	$total = $baseprice + $v6p;
	$romancartform .= '<option value="'.$v6n.' {'.$v6p.'}">'.$v6n.' (&pound;'.$total.' + VAT)</option>';
}					

if($variations > 6)
{
	$total = $baseprice + $v7p;
	$romancartform .= '<option value="'.$v7n.' {'.$v7p.'}">'.$v7n.' (&pound;'.$total.' + VAT)</option>';
}					

if($variations > 7)
{
	$total = $baseprice + $v8p;
	$romancartform .= '<option value="'.$v8n.' {'.$v8p.'}">'.$v8n.' (&pound;'.$total.' + VAT)</option>';
}					

if($variations > 8)
{
	$total = $baseprice + $v9p;
	$romancartform .= '<option value="'.$v9n.' {'.$v9p.'}">'.$v9n.' (&pound;'.$total.' + VAT)</option>';
}					

if($variations > 9)
{
	$total = $baseprice + $v10p;
	$romancartform .= '<option value="'.$v10n.' {'.$v10p.'}">'.$v10n.' (&pound;'.$total.' + VAT)</option>';
}
?>