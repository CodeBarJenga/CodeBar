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
global $status, $message, $class;
require_once 'model/evalmodel.php';
//require_once 'model/userfunctions.php';
class evalcontroller {
	function __construct() {
		$this -> conn = new evalmodel();
		//$this -> usf = new userfunctions();
	}

	public function redirect($location) {
		header('location: ' . $location);
	}

	public function handlerequest() {
			$res = $this -> conn -> get_submission($_SESSION['contest']);
			include 'view/viewevaluation.php';
	}

}
?>