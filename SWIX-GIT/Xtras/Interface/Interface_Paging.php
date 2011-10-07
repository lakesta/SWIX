<?php
function Interface_Paging($obj, $page=1, $pageNumbers=5){
	echo "<table class='Xtras_Paging'>";
	echo "<tbody>";
	echo "<tr>";
	$result = $obj->getResult();
	$count = count(pg_fetch_all($result));
	$pages = ceil($count / $obj->getMaxRows());
	
	/*
	 * Create first part of link using current location and all parameters 
	 * except the one for our current object which needs to be updated
	 */
	$here = here();
	$hereSplit = explode($here, "?");
	$here = $hereSplit[0];
	$gets = array_keys($_GET);
	
	
	for ($x=0; $x<count($gets); $x++){
		if ($gets[$x] != $obj->getID())
			$here += "&".$gets[$x]."=".$_GET[$x];
	}
	
	/*
	 * First Arrow
	 * Back Arrow
	 */
	if ($page != 1) {
		echo "<td><span>".A($here."&".$obj->getID()."=1","<<")."</span></td>";
		echo "<td><span>".A($here."&".$obj->getID()."=".($page-1),"<")."</span></td>";
	}
	
	
	/**
	 * $pages : total number of pages available
	 * $pageNumbers : amount of pages we want to show at a time
	 * $page : current page number
	 */
	$halfPages = floor($pageNumbers / 2);
	if ($pages <= $pageNumbers){
		echoPages($pages, $page, $pageNumbers, $here, $obj, 1);
	}
	else {
		if ($page <= $halfPages) {
			echoPages($pages, $page, $pageNumbers, $here, $obj, 1);
		}
		else {
			if ($page >= ($pages - $halfPages)){
				if ($page == ($pages - $halfPages)) {
					echoPages($pages, $page, $pageNumbers, $here, $obj, ($page - $halfPages));
				}
				else{
					echoPages($pages, $page, $pageNumbers, $here, $obj, ($pages - $pageNumbers + 1));
				}
			}
			else {
				echoPages($pages, $page, $pageNumbers, $here, $obj, ($page - $halfPages));
			}
		}
	}
	
	/*
	 * Next Arrow
	 * Last Arrow
	 */
	if ($page != $pages) {
		echo "<td><span>".A($here."&".$obj->getID()."=".($page+1),">")."</span></td>";
		echo "<td><span>".A($here."&".$obj->getID()."=".$pages,">>")."</span></td>";
	}
	
	echo "</tr>";
	echo "</tbody>";
	echo "</table>";
}

function echoPages($pages, $page, $pageNumbers, $here, $obj, $x) {
	$count = 1;
	for ($x; (($x <= $pages) && ($count <= $pageNumbers)); $x++) {
		if ($x == $page)
			echo "<td><span class='current'>".$x."</span></td>";
		else {
			$link = $here."&".$obj->getID()."=".$x;
			echo "<td><span>".A($link,$x)."</span></td>";
		}
		$count++;
	}
}
?>