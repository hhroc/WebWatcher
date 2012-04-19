<?php

	session_start();

	// mysql constants
	$host="localhost";
	$username="mysqluser";
	$password="mysqluser123%%%";
	$db_name="webwatcher"; 
	$tbl_name="users"; 

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password") or die("cannot connect"); //TODO: something more eligant than this ...
	mysql_select_db("$db_name")or die("cannot select DB");

	// username and password sent from form 
	$myusername=$_POST['myusername']; 
	$mypassword=$_POST['mypassword'];

	// To protect MySQL injection (ooo fancy!)
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);

	// md5 hash the password, since this is how it is stored in the database
	$mypassword = md5($mypassword);

	// get the user from the database
	$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
	$result=mysql_query($sql);
	
	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);
	
	// If result matched $myusername and $mypassword, table row must be 1 row

	if($count==1){
		
		// need to check if the user has been validated to see if we should let them login or not.
		$validated=mysql_result($result,0,"validated");
		$isadmin=mysql_result($result,0,"admin");

		/*
		echo "validated = $validated";
		echo "</br>";
		echo "admin = $admin";
		*/
		
		if($validated==1)
		{
			//echo "is valid. </br>";
		
			// Register $myusername, $mypassword and redirect to file "login_success.php"
			//session_register("myusername");
			//session_register("mypassword");
			
			// register the username and the admin state with the session
			$_SESSION['username'] = $myusername;
			$_SESSION['isadmin'] = $isadmin;
			
			//echo "redirecting ...</br>";
			
			// redirect to main.php, we are now logged in.
			header("location:main.php");
			
		}
		else
		{
			echo "<meta http-equiv=\"REFRESH\" content=\"0;url=notvalidated.html\">";
		}
		
	}
	else {
		echo "<meta http-equiv=\"REFRESH\" content=\"0;url=badlogin.html\">";
	}
	
?>