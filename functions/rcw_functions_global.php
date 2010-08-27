<?php
# Used With Form Menus - Determines A Match Of Two Values
# Input: actual value, possible value
# Output: echos html form selected attribute for specific menu item
function rcw_echoselected($value,$argument){if( $value == $argument ){echo 'selected="selected"';}}


?>
