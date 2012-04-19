<? 
	//Make sure we are logined in, and we are admin.
	session_start();
	if( !( isset($_SESSION['username']) && ($_SESSION['isadmin']==1) ) )
	{
		header("location:login.html");
	}
?>

<html>
<head>
<title>WebWatcher - Edit WebWatcher Entry</title>
</head>
<body>

	<?
	
		// mysql constants
		$host="localhost";
		$username="mysqluser";
		$password="mysqluser123%%%";
		$db_name="webwatcher"; 
		$tbl_name="watcherlist"; // table of url's to watch
		
		// Connect to server and select databse.
		mysql_connect("$host", "$username", "$password") or die("cannot connect"); //TODO: something more eligant than this ...
		mysql_select_db("$db_name")or die("cannot select DB");

		//echo "Username: " . $_SESSION['username'];

		// get this users ID
		$sql = "select userid from users where username='" . $_SESSION['username'] . "'";
		$result = mysql_query( $sql );
		$userid = mysql_result($result,0,"userid");

		//echo "UserID: " . $userid . "</br>";

		//echo "DisplayName: " . $_POST['displayname'] . "</br>"; 

		// pull from the database all url's currently being watched by this user
		$sql = "select * from watcherlist where owneruserid='$userid' and displayname='" . $_POST['displayname'] . "'";
		$result = mysql_query( $sql );
		$count = mysql_num_rows( $result );
	
		//echo "Count: " . $count;
	
		$displayname = mysql_result($result,0,"displayname");
		$url = mysql_result($result,0,"url");
		$frequency = mysql_result($result,0,"frequency");
		$keyword = mysql_result($result,0,"keyword");
		$contact = mysql_result($result,0,"contact");
		$enabled = mysql_result($result,0,"enabled");
	
	?>
	
	<form name="loginform" method="post" action="updatewebwatcher.php">
	
		Display Name:</br>
		<input name="displaynametext" type="text" id="displayname" size="60" value="<?php echo $displayname; ?>"></br>
		
		URL to Watch:</br>
		<input name="urltext" type="text" id="url" size="60" value="<?php echo $url; ?>"></br>
		
		Frequency to perform check:</br>
		<input name="frequencytext" type="text" id="frequency" size="60" value="<?php echo $frequency; ?>"></br>
		
		Keyword to check for:</br>
		<input name="keywordtext" type="text" id="keyword" size="60" value="<?php echo $keyword; ?>"></br>
		
		Contact to use:</br>
		<input name="contacttext" type="text" id="contact" size="60" value="<?php echo $contact; ?>"></br>
		
		Enabled:</br>
		<input name="keywordtext" type="text" id="keyword" size="60" value="<?php echo $enabled; ?>"></br>
		
		</br>
		
		<input type="submit" name="updatebutton" value="update"></br>

	</form>
	

</body>
</html>