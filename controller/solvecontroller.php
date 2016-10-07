<?php
session_start();
/*
 *
 *
 */
 if(@$_SESSION['username']==NULL)
 {
 	header('location:index.php');
 }
global $flag;
require_once 'model/contestmodel.php';
require_once 'model/userfunctions.php';
class solvecontroller {
	function __construct() {
		$this -> conn = new contestmodel();
	}

	public function redirect($location) {
		header('location: ' . $location);
	}

	public function handlerequest() {
		$contest = $_GET['problemCode'];
		$_SESSION['problem'] = $contest;
		$result=$this -> conn->enterConest($contest,0);
		$getTime = $this -> conn -> getTime($_SESSION['contest']);
		$nav_prob = $this -> conn -> fetch_nav_prob($_SESSION['contest']);
		include 'view/viewsolve.php';
	}

}
?>