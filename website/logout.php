
<? 
// logout and redirect to our landing page
session_start();
session_destroy();
header("location:index.html");
?>