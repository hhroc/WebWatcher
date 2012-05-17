<? 
	//Make sure we are logined in, and we are admin.
	session_start();
	if( !( isset($_SESSION['username']) && ($_SESSION['isadmin']==1) ) )
	{
		header("location:login.html");
	}
?> 

<html>
<title>WebWatcher - Add New WebWatcher URL</title>
<body>



</body>
</html>