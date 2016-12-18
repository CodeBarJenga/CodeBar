<?php
session_start();

/*
 *
 *
 */
require_once 'model/usermodel.php';
require_once 'model/userfunctions.php';
if(@$_SESSION['username']==NULL)
 {
 	header('location:index.php');
 }



class usercontroller {
	function __construct() {
		$this -> conn = new usermodel();
	}

	public function redirect($location) {
		header('location: ' . $location);
	}

	public function handlerequest() {
		

		$list = $this -> conn -> fetch_contest();
		$lead = $this -> conn -> fetch_lead($_SESSION['username']);
		$archive_contest = $this -> conn -> problem_archive();
		$res = $this -> conn -> getSubmissionForUser($_SESSION['username']);
		//$_SESSION['flag'] = TRUE;
		include 'view/viewuser.php';
		if (isset($_POST['entercontest'])) {
			$_SESSION['contest'] = $_POST['entercontest'];
			$this -> redirect('contest.php');
		}
		if (isset($_POST['solution'])) {
			$_SESSION['solpath'] = $_POST['solution'];
			$this -> redirect('solution.php');
			}
		}
	

}
?>