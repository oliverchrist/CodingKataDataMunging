<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileData
 *
 * @author christ
 */
class FileData {
	private $lines;
	
	public function __construct($filepath){
		$this->lines = file($filepath);
	}
	
	public function getLines() {
		return $this->lines;
	}
	
	public function getLine($row) {
		return $this->lines[$row];
	}
	
	public function getSmallestSpread($from, $to, $retCol, $diffCol1, $diffCol2) {
		
		$smallestSpread = -1;
		$smallestSpreadIndex = -1;
		for($x = $from; $x < $to; $x++){
			if($this->invalidRow($x)) continue;
			$tempSpread = abs($this->getValue($x, $diffCol1) - $this->getValue($x, $diffCol2));
			if($tempSpread < $smallestSpread || $smallestSpread == -1){
				$smallestSpread = $tempSpread;
				$smallestSpreadIndex = $this->getValue($x, $retCol);
			}
		}
		return $smallestSpreadIndex;
	}
	
	public function getValue($row, $col) {
		$lineData = trim($this->getLine($row));
		$cols = preg_split('/\s+/', $lineData);
		return $cols[$col];
	}
	
	private function invalidRow($row) {
		return preg_match('/[-]{10,}/', $this->getLine($row));
	}
}

?>
