<?php
require_once 'dbfunctions.php';
require_once 'userfunctions.php';
class AdminModel {
	public $conn;
	

	public function __construct() {
		$this -> conn = new dbfunctions();
		$this -> usf=new userfunctions();
	}
	function addUsersFromCsv($line) {
		//$name, $username, $email, $mobile_num, $password = $line;
		$name = $line[0];
		$username = $line[1];
		$email = $line[2];
		$mobile_num = $line[3];
		$password = $line[4];
		if (!($this -> isUserAlreadyExisting($email))) {
			$pass = md5($password);
			$salt = $this -> usf -> randomAlphaNum(5);
			$hash = crypt($pass, $salt);
			$stmt = $this -> conn -> getDBConnectionObject() -> prepare("INSERT INTO users(name, username, email, mobile_num, salt, hash) VALUES (?,?,?,?,?,?)");
			$stmt -> bind_param("sssiss", $name, $username, $email, $mobile_num, $salt, $hash);
			if ($stmt -> execute()) {
				return TRUE;
			} else {
				return FALSE;

			}
		}

	}

	function isUserAlreadyExisting($emailId) {
		$stmt = $this -> conn -> getDBConnectionObject() -> prepare("SELECT COUNT(*) as count FROM users WHERE email = ? ");
		$stmt -> bind_param("s", $emailId);
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		$count = $values[0]['count'];
		if ($count > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	}

?>