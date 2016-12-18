<?php
    require_once('userfunctions.php');
    $_SESSION['i']=1;
	
	
    class dbfunctions 
       {
        	
        private $db;
		//static $i=0;
        function __construct() 
        {
            $servername = 'localhost';
			$username = 'root';
			$password = '';
			$dbname = 'codebar';
			$this->db = mysqli_connect($servername,$username,$password,$dbname);	
			
        }
		
		function getDBConnectionObject() {
			return $this -> db;
		}
		
		function Check()
		{
			if($this->db)
			{
				return TRUE;
			}
			else 
		    {
		    	return FALSE;
			}
		}
		
		function loginfetch($username, $pass) {
		$stmt = $this -> db -> prepare("SELECT hash, salt from users where username = '$username'");
		$stmt -> execute();
		$result = $stmt -> get_result();
		$row = $result -> fetch_assoc();
		return $row;

	}
		//to populate users
		function Show()
		{
			$stmt = $this->db->prepare("SELECT * FROM users");
			//$stmt->bind_param("i",$uid);
			$stmt->execute();
			$values = array();
			$result = $stmt->get_result();
			while($row = $result->fetch_assoc())
			{
				$values[] = $row;
			}
			return $values;
		}
		function setup_contest($name, $startdt, $enddt, $nop,$setup) 
		{
			echo $startdt;
		    $start = strtotime($startdt);
			$end = strtotime($enddt);
			if($start>=$end)
			{
				return False;
			}
		 if($setup == 0)
		 {	
			$stmt = $this->db->prepare("INSERT INTO setup_contest(contestname,startdt,stampst,enddt,stampend,num_prb) VALUES (?,?,?,?,?,?)");
			$stmt->bind_param("ssisii",$name,$startdt,$start,$enddt,$end,$nop);
		 }
		 else 
		 {
			$stmt = $this->db->prepare("UPDATE setup_contest SET startdt=?,stampst=?,enddt=?,stampend=?,num_prb=? WHERE contestname=?");
			$stmt->bind_param("sisiis",$startdt,$start,$enddt,$end,$nop,$name); 
		 }
			
			
			if($stmt->execute())
			   {
			   	return TRUE;
			   }
			else
		    {
		    	return FALSE;
				
			}   
		    	
		}
		
		function addproblem($contestname, $probcode, $probhead, $probdiff, $probstatement,$timelimit, $inputtestcases, $outputtestcases, $sampleinputtestcases, $sampleoutputtestcases, $points) 
		{
			
		    $probcode = strtoupper($probcode);
			$stmt = $this->db->prepare("INSERT INTO problems(contestname,problemcode,problemhead,problemdiff,statement,timelimit,input,output,sample_input,sample_output,points) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->bind_param("sssssissssi",$contestname,$probcode,$probhead,$probdiff,$probstatement,$timelimit,$inputtestcases,$outputtestcases,$sampleinputtestcases,$sampleoutputtestcases,$points);
			
		
			if($stmt->execute())
			   {
			   	return TRUE;
			   }
			else
		    {
		    	return FALSE;
				
			}   
		    	
		}
		
		function createcontest($contestname,$probcode)
		{
			$stmt = $this->db->prepare("CREATE TABLE $contestname (username varchar(50) primary key,$probcode varchar(10) DEFAULT 0,stime$probcode varchar(20) DEFAULT 0,ftime$probcode varchar(20) DEFAULT 0)");
			//$stmt->bind_param("ss",$contestname,$probcode);
			if($stmt->execute()){return TRUE;}
		else 
			{
				$stmt = $this->db->prepare("ALTER TABLE $contestname ADD $probcode varchar(10) DEFAULT 0");
				$stmt->execute();
				$stmt = $this->db->prepare("ALTER TABLE $contestname ADD stime$probcode varchar(20) DEFAULT 0");
				$stmt->execute();
				$stmt = $this->db->prepare("ALTER TABLE $contestname ADD ftime$probcode varchar(20) DEFAULT 0");
				$stmt->execute();
				return FALSE;
			}
		}
		
		
		function fetch_problems() 
		{
			$stmt = $this->db->prepare("SELECT * FROM setup_contest ORDER BY stampst");
			$stmt->execute();
			$values = array();
			$result =$stmt->get_result();
			while($row = $result->fetch_assoc())
			{
				$values[] = $row;
			}
			return $values;
			
		}
		
		
		
	/*	public function getcontest_ques($probCode)
		{
			$stmt = $this->db->prepare("SELECT  FROM problems WHERE contestname=?");
			$stmt->bind_param('s',$contest);
			$stmt->execute();
			$values = array();
			$result =$stmt->get_result();
			while($row = $result->fetch_assoc())
			{
				$values[] = $row;
			}
			return $values;
		}
	 */
		function del_problem($contestname,$probcode) 
		{
			$stmt = $this->db->prepare("DELETE FROM problems WHERE contestname = ? AND problemcode=?");
			$stmt->bind_param('ss',$contestname,$probcode);
			if($stmt->execute())
			{
				return TRUE;
			}
			else 
			{
				return FALSE;
			}
		}
		function Search($name) 
		{
			$stmt = $this->db->prepare("SELECT * FROM probems WHERE name = ?");
			$stmt->bind_param('s',$name);
			$stmt->execute();
			$values = array();
			$result =$stmt->get_result();
			while($row = $result->fetch_assoc())
			{
				$values[] = $row;
			}
			return $values;
			
		}
    }
    
?>