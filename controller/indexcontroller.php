<?php
session_start();

/*
 *
 *
 */
 
 if(@$_SESSION['username']!=NULL)
 {
 	header('location:user.php');
 }
 
 
require_once 'model/indexmodel.php';
require_once 'model/userfunctions.php';
class indexcontroller {
	function __construct() {
		$this -> conn = new indexmodel();
		$this -> usf=new userfunctions();
	}

	public function redirect($location) {
		header('location: ' . $location);
	}

	public function handlerequest($err) {
		$msg = $this -> conn -> Check();
		$upComingTime = $this -> conn -> getTimeForUpComing();
		$presentcontest = $this -> conn -> fetch_present_contest();
		$futurecontest = $this -> conn -> fetch_future_contest();
		$pastcontest = $this -> conn -> fetch_past_contest();
		if (isset($_POST['login'])) {
			$this -> validateuser();
		}
		if (isset($_POST['signup'])) {//header("location:index.php?error=1");
			$this -> adduser();
		}
		include 'view/viewindex.php';
	}
	
    public function validateuser() {
		$link = $this -> conn -> getLinkToDBConnectionObject();	
		$username = mysqli_real_escape_string($link, $_POST['username']);
		if (trim($username) == "" or trim($_POST['password'] == "")) {
			$this -> redirect('index.php?error=1');
			//$this -> invalidate();
		} else {
			$password = $_POST['password'];
			$result = $this -> conn -> loginfetch($username, $password);

			$pass = md5($password);
			$currhash = crypt($pass, $result['salt']);
			if ($currhash == $result['hash']) {
				$values = $this -> usf -> messages("login");

				$_SESSION['username'] = $username;
				$_SESSION['messages'] = $values[0];
				$_SESSION['class'] = $values[1];
				//$_SESSION['flag'] = TRUE;
				$this -> redirect('user.php');

			} else {
				$this -> redirect('index.php?error=1');
				//echo 'wrong';
				//echo "error=1";
				//include 'view/viewindex.php?';
			//	$this -> invalidate();
			}
		}
	}

	public function adduser() {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$mobile_num = $_POST['mobile_num'];
		$username = $_POST['username'];
		$_SESSION['username'] = $username;
		$password = $_POST['password'];
		$msg = $this -> conn -> Add($name, $username, $email,$mobile_num, $password);
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

	public function invalidate()
	{

		echo"<script>
				$('#invalidate').modal('show');
			</script>";
	}
	

}

?>