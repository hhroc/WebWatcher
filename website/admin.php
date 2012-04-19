<? 
	//Make sure we are logined in, and we are admin.
	session_start();
	if( !( isset($_SESSION['username']) && ($_SESSION['isadmin']==1) ) )
	{
		header("location:login.html");
	}
?>

<html>
<title>WebWatcher - Admin Control panel</title>
<body>

	<h3>As Admin, you can do the following things:</h3>

	<a href="validateusers.php">Validate Users</a> </br>
	<a href="displayusers.php">Display All Users</a> </br>
	<a href="removeuser.php">Remove a User</a> </br>
	<a href="displaystatistics.php">Display Statistics</a> </br>
	<a href="promoteusertoadmin.php">Promote User to Admin</a> </br>

</body>
</html>
