
<html>
<title>WebWatcher - Registration</title>
<body>

<?
	
	// mysql constants
	$host="localhost";
	$username="mysqluser";
	$password="mysqluser123%%%";
	$db_name="webwatcher"; 
	$tbl_name="watchlist"; 

	// Connect to server and select databse.
	$con = mysql_connect("$host", "$username", "$password") or die("cannot connect"); //TODO: something more eligant than this ...
	mysql_select_db("$db_name") or die("cannot select DB");

	// get data sent from the register.html submit
	$myusername=$_POST['myusername']; 
	$mypassword=$_POST['mypassword'];
	$mydisplayname=$_POST['mydisplayname'];
	$myemail=$_POST['myemail'];
	$mytwitter=$_POST['mytwitter'];
	$myphone=$_POST['myphone'];
	$myphonecarrier=$_POST['myphonecarrier'];

	//echo "done."

	// To protect MySQL injection (ooo fancy!)
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$mydisplayname = stripslashes($mydisplayname);
	$myemail = stripslashes($myemail);
	$mytwitter = stripslashes($mytwitter);
	$myphone = stripslashes($myphone);
	$myphonecarrier = stripslashes($myphonecarrier);
	
	// and some more ...
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	$mydisplayname = mysql_real_escape_string($mydisplayname);
	$myemail = mysql_real_escape_string($myemail);
	$mytwitter = mysql_real_escape_string($mytwitter);
	$myphone = mysql_real_escape_string($myphone);
	$myphonecarrier = mysql_real_escape_string($myphonecarrier);

	// we need to check to see if the username is available
	$check="SELECT username FROM users WHERE username='$myusername'";
	$checkresult=mysql_query($check);
	$checkcount=mysql_num_rows($checkresult);
	
	/*
	echo $check;
	echo "</br>";
	echo $checkcount;
	echo "</br>";
	echo "----";
	*/

	if($checkcount>=1)
	{
		echo "I'm sorry, the username you requested isn't available.  Please try a different username.";
		echo "</br></br>";
		echo "<A HREF=\"javascript:javascript:history.go(-1)\">Go Back</A>";
	}
	else
	{
	
		// create the md5 hash of our user password to be saved
		$mypassword = md5($mypassword);
		
		//echo "done";
		
		// setup our insertion string
		$sql="INSERT INTO users (username, password, displayname, email, twitter, phone, phonecarrier, validated, admin, extra)
			  VALUES ('$myusername','$mypassword','$mydisplayname','$myemail', '$mytwitter','$myphone','$mycarrier', '0', '0','')";

		// TODO: Error check this!	
		
		mysql_query($sql) or die("insert failed");

		//echo "Success!";
		echo "<meta http-equiv=\"REFRESH\" content=\"0;url=registersuccess.html\">";
	
	}

?>
	
	

</body>
</html>
