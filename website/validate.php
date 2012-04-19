<? 
	//Make sure we are logined in, and we are admin.
	session_start();
	if( !( isset($_SESSION['username']) && ($_SESSION['isadmin']==1) ) )
	{
		header("location:login.html");
	}
?>

<?

	// mysql constants
	$host="localhost";
	$username="mysqluser";
	$password="mysqluser123%%%";
	$db_name="webwatcher"; 
	$tbl_name="users"; 

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password") or die("cannot connect"); //TODO: something more eligant than this ...
	mysql_select_db("$db_name")or die("cannot select DB");

	// get the username to validate from the post
	$usertovalidate=$_POST['usertovalidate'];
	
	// our query to update the user to validated state
	$sql = "update users set validated = '1' where username='tim'";
	
	// peform query.
	$result=mysql_query($sql);

	// all done, go back to the validateusers.php page - note that the user should not show up now once it is validated.
	echo "<meta http-equiv=\"REFRESH\" content=\"0;url=validateusers.php\">";

?>