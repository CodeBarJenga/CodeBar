<?php
/*
 *
 *
 */
require_once 'dbfunctions.php';
class evalmodel {
	public $conn;
	public function __construct() {
		$this -> conn = new dbfunctions();
	}

	public function get_submission($contest) {
		$stmt = $this -> conn -> db -> prepare("SELECT * FROM submission WHERE contestname=?");
		$stmt -> bind_param('s', $contest);
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		return $values;
	}

}
?>