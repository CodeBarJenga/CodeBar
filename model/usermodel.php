<?php
/*
 *
 *
 */
require_once 'dbfunctions.php';

class usermodel {
	public $conn;
	public function __construct() {
		$this -> conn = new dbfunctions();
	}

	public function fetch_contest() {

		$stmt = $this -> conn -> db -> prepare("SELECT * FROM setup_contest ORDER BY stampst");
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		return $values;
	}

	public function fetch_lead($user) {
		$stmt = $this -> conn -> db -> prepare("SELECT * FROM users ORDER BY convert(rating,decimal) DESC");
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		return $values;

	}

	//getting All submission
	public function getSubmissionForUser($username) {
		$stmt = $this -> conn -> db -> prepare("SELECT * FROM submission WHERE username=?");
		$stmt -> bind_param('s', $username);
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		return $values;
	}

	public function problem_archive() {
		$time = strtotime('now') + 19800;
		$stmt = $this -> conn -> db -> prepare("SELECT problems.problemcode, problems.problemhead,problems.problemdiff from problems,setup_contest where setup_contest.stampend<=? AND setup_contest.contestname=problems.contestname");
		$stmt -> bind_param('i', $time);
		$stmt -> execute();
		$values = array();
		$result = $stmt -> get_result();
		while ($row = $result -> fetch_assoc()) {
			$values[] = $row;
		}
		return $values;
	}

	public function fetch_archive_problem() {

	}

	function getDashBoardStats($username, $contestList) {
		$numberOfProblemsSolved;
		$numberOfProblemsUnsolved;
		$completeResult = array();
		for ($i = 0; $i < count($contestList); $i++) {
			$numberOfProblemsSolved = 0;
			$numberOfProblemsUnsolved = 0;
			$contestName = $contestList[$i]['contestname'];
			$stmt = $this -> conn -> db -> prepare("SELECT problemcode from problems WHERE contestname =?");
			$stmt -> bind_param('s', $contestName);
			$stmt -> execute();
			$values = array();
			$result = $stmt -> get_result();
			while ($row = $result -> fetch_assoc()) {
				$values[] = $row;
			}
			$totalNumberOfProblems = count($values);
			for ($j = 0; $j < count($values); $j++) {
				$problemCode = $values[$j]['problemcode'];
				$tableExist = mysqli_query($this -> conn -> db, "SELECT 1 FROM $contestName LIMIT 1");
				if($tableExist){
					$stmt = $this -> conn -> db -> prepare("SELECT COUNT(*) as total FROM $contestName WHERE username = ? AND ftime$problemCode > 0");
					$stmt -> bind_param('s', $username);
					$stmt -> execute();
					$solvedProblems = array();
					$result = $stmt -> get_result();
					while ($row = $result -> fetch_assoc()) {
						$solvedProblems[] = $row;
					}
					if ($solvedProblems[0]['total'] > 0) {
						$numberOfProblemsSolved += 1;
					}
				}
			}
			$numberOfProblemsUnsolved = $totalNumberOfProblems - $numberOfProblemsSolved;
			$completeResult[$contestName]['solvedProblems'] = $numberOfProblemsSolved;
			$completeResult[$contestName]['unsolvedProblems'] = $numberOfProblemsUnsolved;
		}
        
     return $completeResult;
	}

}
?>