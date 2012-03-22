<?php
if (isset($_POST['url']) && isset($_POST['email']) && isset($_POST['search']))
{
	if ($db = sqlite_open('data/db.sqlite', 0666, $sqliteerror)) 
	{ 
		$url = sqlite_escape_string($_POST['url']);
		$email = sqlite_escape_string($_POST['email']);
		$search = sqlite_escape_string($_POST['search']);
	    sqlite_query($db, "INSERT INTO urls (url, email, search) VALUES ('$url', '$email', '$search')");
		echo "added";
	}
}
?>