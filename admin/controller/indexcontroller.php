<?php
session_start();
/*
 *
 *
 */
 
require_once 'model/dbfunctions.php';
require_once 'model/userfunctions.php';
class indexcontroller {
	function __construct() {
		$this -> conn = new dbfunctions();
		$this -> usf=new userfunctions();
	}

	public function redirect($location) {
		header('location: ' . $location);
	}

	public function handlerequest() {
		//$_SESSION['flag'] = FALSE;
		$msg = $this -> conn -> Check();
		if ($msg) {
			echo 'Connection Established ';
		} else {
			echo 'Connection not established';
		}
		include 'view/viewindex.php';
		if (isset($_POST['login'])) {
			$this -> validateuser();
		}
		if (isset($_POST['signup'])) {
			$this -> adduser();
		}
	}

	public function validateuser() {
		$username = mysql_real_escape_string($_POST['username']);
		if (trim($username) == "" or trim($_POST['password'] == "")) {
			$this -> redirect('index.php?error=1');
		} else {
			$password = $_POST['password'];
			$result = $this -> conn -> loginfetch($username, $password);

			$pass = md5($password);
			$currhash = crypt($pass, $result['salt']);
			if ($username == "admin" && $currhash == $result['hash']) {
				echo 'login success';

				$_SESSION['username'] = $username;
				$this -> redirect('admin.php');
			} /*else if ($currhash == $result['hash']) {

				$usf = new userfunctions();

				$values = $usf -> messages("login");

				$_SESSION['username'] = $username;
				$_SESSION['messages'] = $values[0];
				$_SESSION['class'] = $values[1];
				$_SESSION['flag'] = TRUE;
				$this -> redirect('user.php');

			}*/ else {
				echo ' wrong username or password';
			}

		}
	}

	public function adduser() {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$_SESSION['username'] = $username;
		$password = $_POST['password'];
		$msg = $this -> conn -> Add($name, $username, $email, $password);
		if ($msg) {
			$usf = new userfunctions();
			$values = $this -> usf -> messages("signup");

			$_SESSION['messages'] = $values[0];
			$_SESSION['class'] = $values[1];
			header("location:user.php");
		} else {
			echo 'Error';
		}
	}

}
?>