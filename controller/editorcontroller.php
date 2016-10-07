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
global $list, $lead;
require_once 'model/editormodel.php';
require_once 'model/contestmodel.php';
require_once 'model/userfunctions.php';
class editorcontroller {
	function __construct() {
		$this -> conn = new editormodel();
		$this -> usf = new userfunctions();
		$this -> conn1 = new contestmodel();
	}

	public function redirect($location) {
		header('location: ' . $location);
	}

	public function handlerequest() {
		$getTime = $this -> conn1 -> getTime($_SESSION['contest']);
		$this -> conn = new editormodel();
		$problemattr = $this -> conn -> enterContest($_SESSION['problem'],0);
		$status = "";
		//$list = $this -> conn -> fetch_contest();
		//$lead = $this -> conn -> fetch_lead();
		include 'view/vieweditor.php';
		
		
		if(isset($_POST['ctsubmit'])){
			//socket code for compile and test start
					
			$solution = $_POST['code'];
			$_SESSION[$_SESSION['problem'].'code'] = $_POST['code'];
			$language = $_POST['lang'];
			$_SESSION['lang_code']=$language;
			$_SESSION['problem'];
			switch($language) {
				case 'c' :
					$ext = "c";
					break;
				case 'cpp' :
					$ext = "cpp";
					break;
				case 'java' :
					$ext = "java";
					break;
			}
			$socket = fsockopen('localhost', 3029);
			fwrite($socket, $_SESSION['username'] . "\n");
			fwrite($socket, $_SESSION['problem'] . "\n");
			fwrite($socket, 'solution.' . $ext . "\n");
			$problemattr = $this -> conn -> enterContest($_SESSION['problem'], 0);
			fwrite($socket, $ext . "\n");
			fwrite($socket, $problemattr[0]['timelimit'] . "\n");
			$soln = str_replace("\n", '$_n_$', $this -> usf -> treat($solution));
			fwrite($socket, $soln . "\n");
			$input = str_replace("\n", '$_n_$', $this -> usf -> treat($problemattr[0]['sample_input']));
			fwrite($socket, $input . "\n");
			$_SESSION['status'] = fgets($socket);

			$content = "";
			$contents = "";
			$solpath = "";
			$flag = 0;
			while (!feof($socket))
				$content = $content . fgets($socket);
			if ($_SESSION['status'] == 0) {
				for ($i = 0; $i < strlen($content); $i += 1) {
					if ($content[$i] != '$' && $flag == 0)
						$contents = $contents . htmlspecialchars($content[$i]);
					else {
						if ($content[$i] != '$')
							$solpath = $solpath . $content[$i];
						$flag = 1;
					}
				}
			} else {
				for ($i = 0; $i < strlen($content); $i += 1) {
					if ($content[$i] != '/' && $flag == 0)
						$contents = $contents . $content[$i];
					else {
						$solpath = $solpath . $content[$i];
						$flag = 1;
					}
				}
			}

			$_SESSION['contents'] = $contents;

			if ($_SESSION['status'] == 0) {
				$_SESSION['message'] = "Compile Time Error";
				$_SESSION['class'] = "alert-warning";
				$status = "Compile Time Error";
				$_SESSION['status']=1;
				
			} else if ($_SESSION['status'] == 1) {
				
				$_SESSION['message'] = "Time Limit Exceeded";
				$_SESSION['class'] = "alert-warning";
				$status = "Time Limit Exceeded";
				$_SESSION['status']=2;
			} else if ($_SESSION['status'] == 2) {
				if (trim($contents) == trim($this -> usf -> treat($problemattr[0]['sample_output']))) {
					$_SESSION['message'] = "Output matched with sample cases.";
					$_SESSION['class'] = "alert-success";
					$status = "Problem Solved";
					$_SESSION['status']=3;
				} else {
					$_SESSION['message'] = "Output Not Matched with sample cases.";
					$_SESSION['class'] = "alert-warning";
					$status = "Wrong Answer";
					$_SESSION['status']=4;
				}
			}

			fclose($socket);
			//socket code for compile and test stop
			
			$this -> redirect('editor.php');
			
		}
		
else if (isset($_POST['csubmit'])) {
			// socket code starts
			$solution = $_POST['code'];
			$_SESSION[$_SESSION['problem'].'code'] = $_POST['code'];
			$language = $_POST['lang'];
			$_SESSION['lang_code']=$language;
			$_SESSION['problem'];
			switch($language) {
				case 'c' :
					$ext = "c";
					break;
				case 'cpp' :
					$ext = "cpp";
					break;
				case 'java' :
					$ext = "java";
					break;
			}
			$socket = fsockopen('localhost', 3029);
			fwrite($socket, $_SESSION['username'] . "\n");
			fwrite($socket, $_SESSION['problem'] . "\n");
			fwrite($socket, 'solution.' . $ext . "\n");
			$problemattr = $this -> conn -> enterContest($_SESSION['problem'], 0);
			fwrite($socket, $ext . "\n");
			fwrite($socket, $problemattr[0]['timelimit'] . "\n");
			$soln = str_replace("\n", '$_n_$', $this -> usf -> treat($solution));
			fwrite($socket, $soln . "\n");
			$input = str_replace("\n", '$_n_$', $this -> usf -> treat($problemattr[0]['input']));
			fwrite($socket, $input . "\n");
			$_SESSION['status'] = fgets($socket);

			$content = "";
			$contents = "";
			$solpath = "";
			$flag = 0;
			while (!feof($socket))
				$content = $content . fgets($socket);
			if ($_SESSION['status'] == 0) {
				for ($i = 0; $i < strlen($content); $i += 1) {
					if ($content[$i] != '$' && $flag == 0)
						$contents = $contents . htmlspecialchars($content[$i]);
					else {
						if ($content[$i] != '$')
							$solpath = $solpath . $content[$i];
						$flag = 1;
					}
				}
			} else {
				for ($i = 0; $i < strlen($content); $i += 1) {
					if ($content[$i] != '/' && $flag == 0)
						$contents = $contents . $content[$i];
					else {
						$solpath = $solpath . $content[$i];
						$flag = 1;
					}
				}
			}

			$_SESSION['contents'] = $contents;

			if ($_SESSION['status'] == 0) {
				$this -> conn -> update_rating($_SESSION['problem'], $_SESSION['username'], $_SESSION['contest']);
				$_SESSION['message'] = "Compile Time Error :(";
				$_SESSION['class'] = "alert-warning";
				$status = "Compile Time Error";
				//echo trim($contents);
			} else if ($_SESSION['status'] == 1) {
				$this -> conn -> update_rating($_SESSION['problem'], $_SESSION['username'], $_SESSION['contest']);
				$_SESSION['message'] = "Time Limit Exceeded :(";
				$_SESSION['class'] = "alert-warning";
				$status = "Time Limit Exceeded";
			} else if ($_SESSION['status'] == 2) {
				if (trim($contents) == trim($this -> usf -> treat($problemattr[0]['output']))) {
					$time=time();
					$this -> conn1 -> final_time($time);
					$this -> conn -> set_rating($_SESSION['problem'], $_SESSION['username'], $_SESSION['contest']);
					$this -> conn -> update_rating($_SESSION['problem'], $_SESSION['username'], $_SESSION['contest']);
					$_SESSION['message'] = "Congratulations!!! Problem Solved";
					$_SESSION['class'] = "alert-success";
					$status = "Problem Solved";
				} else {
					$this -> conn -> update_rating($_SESSION['problem'], $_SESSION['username'], $_SESSION['contest']);
					$_SESSION['message'] = "Wrong Answer :(";
					$_SESSION['class'] = "alert-warning";
					$status = "Wrong Answer";
				}
			}

			fclose($socket);
			//socket code ends
			$msg = $this -> conn -> addsubmission($_SESSION['contest'], $_SESSION['problem'], $_SESSION['username'], $solpath, $status);
			if ($msg) {
				echo 'success';
			} else {
				echo 'error';
			}
			$this -> redirect('evaluation.php');
		}
	}

}
?>