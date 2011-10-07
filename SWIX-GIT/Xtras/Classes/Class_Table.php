<?php
/**
 * 
 * @author Jake Lake
 * @version 1.0
 * @date December 9, 2010
 * @brief Table class file for Xtras library
 * @notes In order to use paging, an ID must be present 
 *
 */
class Table {
	
	private $id;
	private $result;
	private $db;
	private $statement;
	private $class;
	private $showTitles;
	private $maxRows;
	private $paging;
	private $hiddenColumns;
	
	function __construct($db, $statement, $id="", $class="Xtras_Table", $showTitles=True, $maxRows=-1, $paging=False, $hiddenColumns=array()){
		$this->db = $db;
		$this->statement = $statement;
		$this->setResult();
		$this->id = $id;
		$this->class = $class;
		$this->showTitles = $showTitles;
		$this->maxRows = $maxRows;
		$this->paging = $paging;
		$this->hiddenColumns = $hiddenColumns;
	}
	
	function draw(){
		if ($this->getPaging()) {
			if (isset($_GET[$this->getID()]))
				$page = $_GET[$this->getID()];
			else
				$page = 1;
			Interface_Table($this, $page);
			Interface_Paging($this, $page);
		}
		else
			Interface_Table($this);
	}
	
		
	/* Getters */
	function getResult(){
		return $this->result;
	}
	
	function getDB(){
		return $this->db;
	}
	
	function getStatement(){
		return $this->statement;
	}
		
	function getID(){
		return $this->id;
	}
	
	function getClass(){
		return $this->class;
	}
	
	function getShowTitles(){
		return $this->showTitles;
	}
	
	function getMaxRows(){
		return $this->maxRows;
	}
	
	function getPaging(){
		return $this->paging;
	}
	
	function getHiddenColumns(){
		return $this->hiddenColumns;
	}
	
	/* Setters */
	function setDB($db){
		$this->db = $db;
		$this->setResult();
	}
	
	function setStatement($statement){
		$this->statement = $statement;
		$this->setResult();
	}
	
	private function setResult(){
		$this->result = pg_query($this->db, $this->statement);
	}
	
	function setID($id){
		$this->id = $id;
	}
	
	function setClass($class){
		$this->class = $class;
	}
	
	function setShowTitles($showTitles){
		$this->showTitles = $showTitles;
	}
	
	function setMaxRows($maxRows){
		$this->maxRows = $maxRows;
	}
	
	function setPaging($paging){
		$this->paging = $paging;
		if ($this->maxRows == -1)
			$this->maxRows = 25;
	}
	
	function setHiddenColumns($hiddenColumns=array()){
		$this->hiddenColumns = $hiddenColumns;
	}
}
?>