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
require_once 'model/userfunctions.php';
class solutioncontroller {
	function __construct() {
		
	}

	public function redirect($location) {
		header('location: ' . $location);
	}

	public function handlerequest() {
		
		include 'view/viewsolution.php';
	}

}
?>