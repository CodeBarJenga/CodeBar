<?php
session_start();
	//$_SESSION['cntstname']=$_POST['contestname'];
/*
 *
 *
 */

require_once 'model/dbfunctions.php';
require_once 'model/userfunctions.php';
require_once 'model/markdown.php';
class admincontroller {
	function __construct() {
		$this -> conn = new dbfunctions();

	}

	public function handlerequest() {
		if (isset($_POST['save'])) {
			$this -> add_contest();
		}else if (isset($_POST['addprob'])) {
			$this -> add_problem();
		} else if (isset($_POST['delprob'])) {
			$msg = $this -> conn -> del_problem($_POST['contestname'],$_POST['probcode']);
			if($msg){
				echo 'Problem';echo $_POST['probcode'];echo 'is successfully deleted';
			}
			else{
				echo 'Error while deleting';
			}
		}
		include 'view/viewadmin.php';
	}

	public function add_problem() {
		$contestname = $_POST['contestname'];
		$probcode = $_POST['probcode'];
		$probhead = $_POST['problemhead'];
		$probdiff = $_POST['problemdiff'];
		$probstatement = ($_POST['problemstatement']);
		$inputtestcases = $_POST['inputtestcases'];
		$sampleinputtestcases = $_POST['sampleinputtestcases'];
		
		$outputtestcases = $_POST['outputtestcases'];
		$sampleoutputtestcases = $_POST['sampleoutputtestcases'];
		//echo $sampleoutputtestcases;
		$points = $_POST['points'];
		$timelimit = $_POST['Timelimit'];
		$msg = $this -> conn -> addproblem($contestname, $probcode, $probhead, $probdiff, $probstatement, $timelimit, $inputtestcases,  $outputtestcases, $sampleinputtestcases, $sampleoutputtestcases, $points);
		if ($msg) {
			echo 'Success';
		} else {
			echo 'ERROR';
		}
		$msg = $this -> conn -> createcontest($contestname, $probcode);
		if ($msg) {
			echo 'First time';
		} else {
			echo 'second time';
		}

	}

	public function add_contest() {
		$name = $_POST['contestname'];
		$start = $_POST['starttime'];
		$end = $_POST['endtime'];
		$nop = $_POST['problemnum'];
		if (isset($_POST['save'])) {
			$msg = $this -> conn -> setup_contest($name, $start, $end, $nop, 0);
			//This will call with status = 0 i.e a fresh entry
		} else {
			$msg = $this -> conn -> setup_contest($name, $start, $end, $nop, 1);
			//This will call with status = 1 i.e updating an existing entry
		}
		if ($msg) {
			echo 'Success';
		} else {
			echo 'error';
		}
	}

}
?>