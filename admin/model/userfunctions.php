<?php
   require_once 'dbfunctions.php';
   class userfunctions
   {
   	function __userfunctions()
	{
		
	}
	function randomAlphaNum($length)
	{
		 $rangeMin = pow(36, $length-1);
         $rangeMax = pow(36, $length)-1;
         $base10Rand = mt_rand($rangeMin, $rangeMax);
         $newRand = base_convert($base10Rand, 10, 36);
         return $newRand;
	}
	function messages($string)
	{
		if($string == "login")
		{
			$values = array();	
			$values[0]="You have successfully logged in!";
			$values[1]="alert-success";
			return $values;
		}
		else if($string == "signup")
		{
			$values = array();	
			$values[0]="You have successfully registered!";
			$values[1]="alert-success";
			return $values;
		} 
		
	}
	// converts text to an uniform only '\n' newline break
	function treat($text) 
	{
			$s1 = str_replace("\n\r", "\n", $text);
			return str_replace("\r", "", $s1);
	}
	
   }    
?>