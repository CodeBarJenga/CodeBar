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
 
require_once 'model/contestmodel.php';
require_once 'model/userfunctions.php';
class contestcontroller {
	function __construct() {
		$this -> conn = new contestmodel();
		
	}

	public function redirect($location) {
		header('location: ' . $location);
	}

	public function handlerequest() {
		$result = $this -> conn -> enterConest($_SESSION['contest'], 1);
		$getTime = $this -> conn -> getTime($_SESSION['contest']);
		include 'view/viewcontest.php';
	}

}
?>