<?php
/*
 *
 *
 */
 require_once 'dbfunctions.php';
class usermodel {
	public $conn;
	public function __construct()
	{
		$this -> conn=new dbfunctions();
	}
	public function fetch_contest() {
		
		$stmt = $this -> conn-> db -> prepare("SELECT * FROM setup_contest ORDER BY stampst");
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		return $values;
	}

	public function fetch_lead($user) {
		$stmt = $this -> conn -> db -> prepare("SELECT * FROM users ORDER BY convert(rating,decimal) DESC");
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		return $values;

	}
	//getting All submission
	public function getSubmissionForUser($us) {
		$stmt = $this -> conn -> db -> prepare("SELECT * FROM submission WHERE username=?");
		$stmt->bind_param('s',$us);
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
		$values[] = $row;
	}		return $values;
}
	public function problem_archive(){
		$time=strtotime('now')+19800;
		$stmt = $this -> conn -> db -> prepare("SELECT problems.problemcode, problems.problemhead,problems.problemdiff from problems,setup_contest where setup_contest.stampend<=? AND setup_contest.contestname=problems.contestname");
		$stmt->bind_param('i',$time);
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
		$values[] = $row;
	}
		return $values;
	}
	
	public function fetch_archive_problem(){
		
	}
}
?>