<? 
	//Make sure we are logined in, and we are admin.
	session_start();
	if( !isset($_SESSION['username']) )
	{
		header("location:login.html");
	}
?>

<html>
<head>
<title>WebWatcher</title>

<script type="text/javascript">

	function editWebWatcher()
	{
		// find our text box with the display name
		var TheTextBox = document.getElementById("webwatcherdisplayname");
		
		//check to see that there is actually text there.
		if( TheTextBox.value != "" )
		{
		
			// create a ghost form to submit our data
			document.body.innerHTML += '<form id="dynForm" action="editwebwatcher.php" method="post"><input type="hidden" name="displayname" value="' + TheTextBox.value + '"></form>';
			
			// perform the post
			document.getElementById("dynForm").submit();
			
		}
	}
	
	function populatetextbox(displayname)
	{
		var TheTextBox = document.getElementById("webwatcherdisplayname");
		var text = displayname.substr(0,displayname.indexOf("|",0)-1);
		TheTextBox.value = text;
	}

</script>

</head>
<body>

	<?php
	
		function resolveContactType($contactType)
		{
			$returnStr = "";
		
			switch($contactType)
			{
				case 0:
					$returnStr = "Email";
				case 1:
					$returnStr = "Twitter";
				case 2:
					$returnStr = "Phone SMS";
				default:
					$returnStr = "ERROR";
			}
			
			return $returnStr;
		}
	
		function spaces($spacesCount)
		{
			$outputString = "";
		
			for($i = 0; $i < $spacesCount; $i++)
			{
				$outputString = $outputString . " ";
			}
			
			return $outputString;
		}
	
	
		function formatString($inputString,$maxlength)
		{
			$returnStr="";
			
			if( strlen($inputString) > $maxlength)
			{
				$returnStr = substr($inputString,0,$maxlength-4) . " ...";
			}
			elseif( strlen($inputString) < $maxlength)
			{
				$returnStr = $inputString . spaces($maxLength - strlen($inputString));
			}
			else
			{
				$returnStr = $inputString;
			}
			
			return $returnStr;
		}
		
		
	?>

	
	</br>

	<div style="position:relative;width:100%;margin-top:0px;margin-bottom:0px;">

		<a id="top"></a>

		<div style="width:760px;margin-top:5px;margin-left:auto;margin-right:auto">

			<!-- Top Nav Bar -->

			<div id="topnav" style="clear:both;width:760px;height:25px;">

				<!-- 
				<div style="float:left;width:400px;word-spacing:12px;font-size:80%;padding-left:15px;padding-top:6px;white-space:nowrap;text-align:left;">
 
					<a class="topnav" href="newwatcher.php" target="_top">New</a> |
					<a class="topnav" href="editwatcher.php" target="_top">Edit</a> | 
					<a class="topnav" href="deletewatcher.php" target="_top">Delete</a>
			
				</div>
				-->

				<div style="float:right;width:280px;word-spacing:6px;font-size:80%;padding-right:15px;padding-top:6px;white-space:nowrap;text-align:right;">
					
					<a class="topnav" href="logout.php" target="_top">Logout</a>
					
					<?
						// check to see if the user is admin
						if( $_SESSION['isadmin']==1 )
						{
							// display the admin page link
							echo " | <a class=\"topnav\" href=\"admin.php\" target=\"_top\">Admin Panel</a>";
						}	
					?>
					
				</div>

			</div>

			<!-- End Top Nav Bar -->
	
			<hr>
			
			<!-- Watcher List -->
			
			<div>
		
			<a id="list"></a>
			
				<div id="watcherlist" style="clear:both;width:760px;height:25px;">
				
					<h4>Your WebWatcher URL's:</h4>
				
					</br>
				
					
		
	
						<!-- Control Buttons -->
							<!-- <input type="button" name="buttonNew" value="New" onclick="newWebWatcher()"> -->
							<!-- <input type="button" name="buttonEdit" value="Edit" onclick="editWebWatcher()"> -->
							<input type="button" name="buttonToggleEnabled" value="Toggle Enabled" onclick="">
							<input type="button" name="buttonDelete" value="Delete" onclick="">
							
						<!-- HACK: this is how we keep track of which item we are looking at. -->
						<input name="textinput" type="hidden" id="webwatcherdisplayname" readonly="readonly">
						
						</br>
						
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

							$myusername = $_SESSION['username'];

							//echo "Username: " . $myusername;
							//echo "</br>";
							

							// get this users ID
							$sql = "select userid from users where username='$myusername'";
							$result = mysql_query( $sql );
							$userid = mysql_result($result,0,"userid");

							//echo "UserID: " . $userid;
							//echo "</br>";

							// pull from the database all url's currently being watched by this user
							$sql = "select * from watcherlist where userid='$userid'";
							$result = mysql_query( $sql );
							$count = mysql_num_rows( $result );

							//echo "Count: " . $count;
							//echo "</br>";

							if( $count==0 )
							{
								echo "</br></br>";
								echo "You do not currently have any WebWatcher URL's loaded.  Click \"New\" above to create one!</br>";
							}
							else
							{

								echo "<select name=\"userlist\" id=\"urlwatcherlist\" size=\"12\" multiple=\"multiple\" STYLE=\"font-family:monospace;font-size:10pt;\" onchange=\"populatetextbox(this.options[selectedIndex].text)\">";

								for($i = 0; $i < $count; $i++)
								{
									
									$name = mysql_result($result,$i,"name");
									$url = mysql_result($result,$i,"url");
									$keyword = mysql_result($result,$i,"keyword");
									$contact = mysql_result($result,$i,"contact");
									$frequency = mysql_result($result,$i,"frequency");
									$enabled = mysql_result($result,$i,"enabled");
									
									//$frequency_ = $frequency . " hours";
									
									//$contact_ = resolveContactType($contact);
									
									// string-o-stuff
									//$displaystring = "";
									
									/*
									
									echo "name: " . $name . "</br>";
									echo "url: " . $url . "</br>";
									echo "keyword: " . $keyword . "</br>";
									echo "contact: " . $contact . "</br>";
									echo "frequency: " . $frequency . "</br>";
									echo "enabled: " . $enabled . "</br>";
									
									*/
									
									/*
									
									echo "</br>";
									
									echo "displayname: " . formatString($displayname,17) . "</br>";
									echo "url: " . formatString($url,25) . "</br>";
									echo "frequency: " . formatString($frequency_,9) . "</br>";
									echo "keyword: " . formatString($keyword,13) . "</br>";
									echo "contact: " . formatString($contact,13) . "</br>";
									echo "enabled: " . formatString($enabled_,8) . "</br>";
									
									*/
									
									/*
									
									$displaystring =                  formatString($displayname,17) . " | ";
									$displaystring = $displaystring . formatString($url,25) . " | ";
									$displaystring = $displaystring . formatString($frequency_,9) . " | ";
									$displaystring = $displaystring . formatString($keyword,13) . " | ";
									$displaystring = $displaystring . formatString($contact_,13) . " | ";
									$displaystring = $displaystring . formatString($enabled_,8);
									
									*/
									
									
									
									$displaystring = formatString($name,16) . " | ";
									
									// see if the entry is disable
									if( $enabled==0 )
										$displaystring = $displaystring . "[DISABLED] | ";
									
									$displaystring = $displaystring . formatString($url,44) . " | ";
									
									// if there is no keyword, then we will display a msg appropreately
									if( $keyword=="" )
										$displaystring = $displaystring . "[Any Change]";
									else
										$displaystring = $displaystring . "[" . formatString($keyword,16) . "]";
									
									
									
									echo "<option value=\"" . $i . "\">" . $displaystring ."</option>";
									echo "</br>";
									
									
								}
							
								echo "</select>";
								
							}
						
						?>
						
						
						
					
					
				</div>
			
			</div>

			<!-- End Watcher List -->
	
		</div>
		
	</div>


</body>
</html>