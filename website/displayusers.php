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
<title>WebWatcher - Admin Panel - Display Users</title>
</head>
<body>

	<div>
	
	Navigate: 
	<a href="main.php"> Home</a>
	<a href="admin.php">Admin Panel</a>
	
	</div>

	<div> <!-- List of Registed Users -->
	
		<h3>Registed Users</h3>
		
		<p>
		<font size="2" face="arial" color="blue">
			Key: username [Admin, Validated]</br>
			</br>
			Admin:</br>
			A = Admin</br>
			. = Normal User</br>
			</br>
			Validated:</br>
			V = Validated</br>
			X = Not Validated</br>
		</font>
		</p>
		
		
		<select name="userlist" id="userlist" size="8" multiple="multiple">

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

			$sql = "select * from users";
			$result = mysql_query( $sql );
			$count = mysql_num_rows( $result );

			for($i = 0; $i < $count; $i++)
			{
				// pull the username from the list
				$value_username = mysql_result($result,$i,"username");
				
				// pull the users admin and validated status.
				$value_admin = mysql_result($result,$i,"admin");
				$value_validated = mysql_result($result,$i,"validated");
				
				if( $value_admin==1)
					$value_admin_="A";
				else
					$value_admin_="x";
					
				if( $value_validated==1)
					$value_validated_="V";
				else
					$value_validated_="x";
				
				echo "<option value=\"" . $i . "\">" . $value_username . " [" . $value_admin_ . " " . $value_validated_ . "]</option>";
				echo "</br>";
			}

		?>

		</select> <!-- End of List of Registered Users -->

	</div>
	
</body>
</html>
