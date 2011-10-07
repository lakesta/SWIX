<?php
require_once('Classes/Class_Table.php');
require_once('Interface/Interface_Table.php');
require_once('Interface/Interface_Paging.php');

/**
 * Create an HTML anchor tag
 * @param $href URL for the link
 * @param $label Text title want shown for link
 * @param $target Target for the window
 * @return HTML anchor tag
 */
function A($href, $label, $target = "_self") {
	return "<a href='".$href."' target='".$target."'>".$label."</a>";
}

/**
 * Create an HTML image tag
 * @param $src URL for image
 * @param $id ID for image
 * @param $alt Alt tag for image
 * @param $class Class for image
 * @param $width Width of the image
 * @param $height Height of the image
 * @return HTML image tag
 */
function IMG($src, $id="", $alt="", $class = "", $width=-1, $height=-1){
	$return = "<img src='".$src."' id='".$id."' alt='".$alt."' class='".$class."'";
	if ($width != -1)
		$return .= " width='".$width."'";
	if ($height != -1)
		$return .= " height='".$height."'";
	$return .= "/>";
	return $return;
}

/**
 * Return link to current page user is on
 * @return href reference to url currently on
 */
function here() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]))
		$pageURL .= "s";
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
?>