<?php

/*
 *
 *
 */
require_once 'dbfunctions.php';

$time_value;
$username = $_SESSION['username'];
$contestname = $_SESSION['contest'];
class contestmodel {
	private $conn;
	public function __construct() {
		$this -> conn = new dbfunctions();
	}

	public function enterConest($contest, $value) {
		
		global $username, $contestname, $time_value;
		$_SESSION['prob_code']=$contest;
		if ($value) {
			$stmt = $this -> conn -> db -> prepare("INSERT INTO $contest (username) values ('$username')");
			$stmt -> execute();
			$stmt = $this -> conn -> db -> prepare("SELECT * FROM problems WHERE contestname=?");
			$stmt -> bind_param('s', $contest);
		} else {
			$time=time();
			$stmt = $this -> conn -> db -> prepare("SELECT stime$contest FROM $contestname WHERE username='$username'");
			$stmt -> execute();
			$values = array();
			$result = $stmt -> get_result();
			while ($row = $result -> fetch_assoc()) {
				$values[] = $row;
			}
			$time_value = $values[0]["stime$contest"];
			if ($time_value == 0) {
				$stmt = $this -> conn -> db -> prepare("UPDATE $contestname SET stime$contest = '$time' WHERE username='$username'");
				$stmt -> execute();
			}
			$_SESSION['time_value']=$time;
			$stmt = $this -> conn -> db -> prepare("SELECT * FROM problems WHERE problemcode=?");
			$stmt -> bind_param('s', $contest);
		}
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		return $values;
	}
	public function fetch_nav_prob($contest){
		$stmt = $this -> conn -> db -> prepare("SELECT * FROM problems WHERE contestname=?");
			$stmt -> bind_param('s', $contest);
			$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		return $values;
	}
	public function final_time($time) {
		global $username, $contestname, $time_value;
		$prob_code=$_SESSION['problem'];
		$time_value=$_SESSION['time_value'];
		$final_time=($time-$time_value)/60;
		//$final_time=$time;
		echo $time_value;
		$stmt = $this -> conn -> db -> prepare("UPDATE $contestname SET ftime$prob_code = '$final_time' WHERE username='$username'");
		$stmt -> execute();
	}

	//for countdown time
	public function getTime($contest) {
		$stmt = $this -> conn -> db -> prepare("SELECT * FROM setup_contest WHERE contestname=?");
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