<?php
function Interface_Table($obj, $page=1){
	$result = $obj->getResult();
	echo '<table id="'.$obj->getID().'" class="'.$obj->getClass().'" cell-padding=0 cell-spacing=0>';
	if ($obj->getShowTitles()) {
		echo '<thead>';
		echo '<tr>';
		$row = pg_fetch_assoc($result);
		$rowTitle = array_keys($row);
		for ($x=0; $x < count($rowTitle); $x++) {
			if (!in_array($rowTitle[$x], $obj->getHiddenColumns())){
				echo '<th>';
				echo $rowTitle[$x];
				echo '</th>';
			}
		} 
		echo '</tr>';
		echo '</thead>';
	}
	
	/**
	 * Want to add your own header to the table?  Turn off showTitles and write your own below!
	 */
	
	echo '<tbody>';
	$rows = 1;
	if ($obj->getMaxRows() != -1) {
		if ($page != 1) {
			pg_result_seek($result, ((($page-1) * $obj->getMaxRows())+1));
		}
		while (($row = pg_fetch_row($result)) && ($rows <= $obj->getMaxRows())) {
			echoRows($row, $rows, $rowTitle, $obj);
			$rows++;
		}
	}
	else {
		while ($row = pg_fetch_row($result)) {
			echoRows($row, $rows, $rowTitle, $obj);
			$rows++;
		}
	}
	echo '</tbody>';
	echo '</table>';
}

function echoRows($row, $rows, $rowTitle, $obj){
	echo '<tr>';
		
	/*
	 * If you want to enter extra columns before the data, do it here!
	 * Example: (ID's on each line) [uncomment the following to implement]
	 * 
	 * echo '<td'>;
	 * echo $rows;
	 * echo '</td>';
	 */
	
	for ($x=0; $x<count($row); $x++){
		
		/**
		 * Want to do something special to a specific column?  Example...
		 * if ($rowTitle[$x] == "movieid") {
		 *    echo '<td class="movie">';
		 *    echo $row[$x];
		 *    echo '</td>';
		 * }
		 */
		
		if (!in_array($rowTitle[$x], $obj->getHiddenColumns())){
			echo '<td>';
			echo $row[$x];
			echo '</td>';
		}
	}
	
	/*
	 * If you want to enter extra columns after the data, do it here!
	 */
	
	echo '</tr>';
}
?>