<?php
    require_once('userfunctions.php');
   
    class dbfunctions 
       {
        	
        public $db;
		
        function __construct() 
        {
            $servername = 'localhost';
			$username = 'root';
			$password = '';
			$dbname = 'codebar';
			$this->db = mysqli_connect($servername,$username,$password,$dbname);	
			
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
		
		function addproblem($contestname, $probcode, $probhead, $probdiff, $probstatement,$timelimit, $inputtestcases, $outputtestcases,$points) 
		{
			
		    $probcode = strtoupper($probcode);
			$stmt = $this->db->prepare("INSERT INTO problems(contestname,problemcode,problemhead,problemdiff,statement,timelimit,input,output,points) VALUES (?,?,?,?,?,?,?,?,?)");
			$stmt->bind_param("sssssissi",$contestname,$probcode,$probhead,$probdiff,$probstatement,$timelimit,$inputtestcases,$outputtestcases,$points);
			if($stmt->execute())
			   {
			   	return TRUE;
			   }
			else
		    {
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
		
		
	 
		function Delete($uid) 
		{
			$stmt = $this->db->prepare("DELETE FROM users WHERE uid = ?");
			$stmt->bind_param('i',$uid);
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
			$stmt = $this->db->prepare("SELECT * FROM users WHERE name = ?");
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