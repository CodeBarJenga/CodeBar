<?php
/*
 *
 *
 */
require_once 'usermodel.php';
class editormodel extends usermodel {
	public function enterContest($contest, $value) {
		if ($value) {
			$stmt = $this -> conn -> db -> prepare("SELECT * FROM problems WHERE contestname=?");
			$stmt -> bind_param('s', $contest);
		} else {
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

	//add solution
	public function addsubmission($contestname, $probcode, $username, $solpath,$status) {
		$probcode = strtoupper($probcode);
		$stmt = $this -> conn -> db -> prepare("INSERT INTO submission(contestname,probcode,username,solpath,status) VALUES (?,?,?,?,?)");
		$stmt -> bind_param("sssss", $contestname, $probcode, $username, $solpath,$status);
		if ($stmt -> execute()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	//getting All submission
	public function getsubmission() {
		$stmt = $this -> db -> prepare("SELECT * FROM submission");
		//$stmt->bind_param('s',$name);
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		return $values;
	}
	
	//Rating to user
	public function set_rating($probcode,$user,$contestname){
		$stmt = $this -> conn-> db -> prepare("SELECT points FROM problems WHERE problemcode=?");
		$stmt->bind_param('s',$probcode);
		$stmt -> execute();
		$values = array();
		$result=$stmt -> get_result();
		while ($row = $result -> fetch_assoc())
		{
			$values[] = $row;
		}
		$points = $values[0]['points'];
		//fetching time period of contest from  setup_contest table
		$stmt = $this -> conn-> db -> prepare("SELECT stampend-stampst as 'period' FROM setup_contest WHERE contestname=?");
		$stmt->bind_param('s',$contestname);
		$stmt -> execute();
		$values = array();
		$result=$stmt -> get_result();
		while ($row = $result -> fetch_assoc())
		{
			$values[] = $row;
		}
		$time_taken = $values[0]['period'];
		
		//final time taken by user for particular problem code
		$stmt = $this -> conn-> db -> prepare("SELECT ftime$probcode as 'final_time' FROM $contestname WHERE username=?");
		$stmt->bind_param('s',$user);
		$stmt -> execute();
		$values = array();
		$result=$stmt -> get_result();
		while ($row = $result -> fetch_assoc())
		{
			$values[] = $row;
		}
		$final_time = $values[0]['final_time'];
		//formula for rating :) :)
		$reduced_points=$points/($time_taken/60);
		
		$points=$points-($final_time * $reduced_points);
		//$_SESSION['temp']=$points;
		//rating to user in contest table
		$stmt = $this -> conn-> db -> prepare("UPDATE $contestname SET $probcode = ? WHERE username=?");
		$stmt->bind_param('ss',$points,$user);
		$stmt->execute();
		
	}
		
		
		
		
		function update_rating($probcode,$user,$contestname){
		
		$stmt = $this -> conn -> db -> prepare("SELECT PIET1+PIET2+PIET3 AS 'TOTAL' FROM $contestname WHERE username=?");
		$stmt->bind_param('s',$user);
		$stmt -> execute();
		$values = array();
		$result=$stmt -> get_result();
		while ($row = $result -> fetch_assoc())
		{
			$values[] = $row;
		}
		$rating = $values[0]['TOTAL'];
		echo $rating;
		$stmt = $this -> conn-> db -> prepare("UPDATE users SET rating = ? WHERE username=?");
		$stmt->bind_param('ss',$rating,$user);
		if($stmt->execute()==TRUE)
		  $_SESSION['paint']=TRUE;
		else
		{
			$_SESSION['paint']=FALSE;
		} 
	}

}
?>