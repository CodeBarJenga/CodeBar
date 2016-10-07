<?php
/*
 *
 *
 */
require_once 'userfunctions.php';
$time = strtotime('now')+19800;
class indexmodel {
	private $conn;
	function __construct()
	{
		$this -> conn=new dbfunctions();
		$this -> usf=new userfunctions();
	}

	function Check() {
		if ($this -> conn -> db) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function Add($name, $username, $email, $mobile_num, $password) {
		$pass = md5($password);
		$salt = $this -> usf -> randomAlphaNum(5);
		$hash = crypt($pass, $salt);
		$stmt = $this -> conn -> db -> prepare("INSERT INTO users(name, username, email, mobile_num, salt, hash) VALUES (?,?,?,?,?,?)");
		$stmt -> bind_param("sssiss", $name, $username, $email, $mobile_num, $salt, $hash);
		if ($stmt -> execute()) {
			return TRUE;
		} else {
			return FALSE;

		}

	}

	function loginfetch($username, $pass) {
		$stmt = $this -> conn -> db -> prepare("SELECT hash, salt from users where username = '$username'");
		$stmt -> execute();
		$result = $stmt -> get_result();
		$row = $result -> fetch_assoc();
		return $row;

	}
	// upcoming time
	public function getTimeForUpComing() {
	
			$stmt = $this -> conn -> db -> prepare("SELECT * FROM setup_contest ORDER BY stampst");
		//	$stmt -> bind_param('s', $contest);
		
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			   if( ( $row['stampst']-time()-16200) > 0 ) return $row;
			//$values[] = $row;
			
		}
		return 0;
	}
	public function fetch_present_contest(){
		    global $time;
			$stmt = $this -> conn -> db -> prepare("SELECT contestname FROM setup_contest WHERE stampend>=? AND stampst<=?");
			$stmt -> bind_param('ii' ,$time,$time);
				$stmt -> execute();
				$values = array();
				$result = $stmt -> get_result();
				while ($row = $result -> fetch_assoc()) {
				$values[] = $row;

				}
				return $values;

	}
	public function fetch_future_contest(){
		    global $time;
			$stmt = $this -> conn -> db -> prepare("SELECT contestname FROM setup_contest WHERE stampst>?");
			$stmt -> bind_param('i' ,$time);
				$stmt -> execute();
				$values = array();
				$result = $stmt -> get_result();
				while ($row = $result -> fetch_assoc()) {
				$values[] = $row;

				}
				return $values;

				}
	public function fetch_past_contest(){
            global $time;
			$stmt = $this -> conn -> db -> prepare("SELECT contestname FROM setup_contest WHERE stampend<?");
			$stmt -> bind_param('i' ,$time);
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