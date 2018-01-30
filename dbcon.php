<?php	
		$db_host = 'localhost';
		$db_user = 'username';
		$db_pass = 'userpassword';
		$db_name = 'userdbname';	

		
		$dbcon = mysql_connect($db_host,$db_user,$db_pass)  or die("Error connecting to database");
		mysql_select_db($db_name, $dbcon)or die("Connecting database Fail"); 		
		$query= "SET NAMES utf8;";
		mysql_query($query);
?>