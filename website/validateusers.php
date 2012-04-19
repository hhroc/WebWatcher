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
<title>WebWatcher - Admin Panel - Validate Users</title>

<script type="text/javascript">

	function populatetextbox(username)
	{
		var TheTextBox = document.getElementById("username");
		var text = username.substr(0,username.indexOf("[",0)-1);
		TheTextBox.value = text;
	}

</script>

</head>
<body>

	<div>
	
	Navigate: 
	<a href="main.php"> Home</a>
	<a href="admin.php">Admin Panel</a>
	
	</div>

	<div> <!-- List of Registed Users -->
	
		<h4>Users not yet Validated:</h4>	
		
		<form name="loginform" method="post" action="validate.php">
		
			<select name="userlist" id="userlist" size="8" multiple="multiple" onchange="populatetextbox(this.options[selectedIndex].text)">

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

				// pull from the database all users that ar enot validated
				$sql = "select * from users where validated='0'";
				$result = mysql_query( $sql );
				$count = mysql_num_rows( $result );

				for($i = 0; $i < $count; $i++)
				{
					// pull the username from the list
					$value_username = mysql_result($result,$i,"username");
					$email = mysql_result($result,$i,"email");
					
					echo "<option value=\"" . $i . "\">" . $value_username . " [ " . $email . " ]</option>";
					echo "</br>";
				}

			?>

			</select> <!-- End of List of Registered Users -->

			</br> </br>

			User To Validate: </br>
			<input name="textinput" type="text" id="username">
			
			<input type="submit" name="Submit" value="validate">

		</form>

	</div>

</body>
</html>