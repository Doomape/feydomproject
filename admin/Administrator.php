 
<?php
/*checking if there is something in the session if not redirect to login,otherwise get in administrator.php*/
session_start();

if (!isset( $_SESSION['myusername']) )
{
	header("location:main_login.php");
}

/*call logout function*/
if (isset($_GET['run'])) $linkchoice=$_GET['run']; 
else $linkchoice=''; 
switch($linkchoice){ 

case 'logout' : 
    logout(); 
    break; 
default : 
   
} 
function logout()
{
	session_start();
	session_destroy();
	unset($_SESSION['myusername']);
	header("location:main_login.php");
}
?>


<html>
<body>
<a href="?run=logout">Logout</a> 
</body>
</html>