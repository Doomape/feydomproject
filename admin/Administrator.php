<?php
session_start();
/* echo $_SERVER['DOCUMENT_ROOT'];*/

/*checking if there is something in the session if not redirect to login,otherwise get in administrator.php*/

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
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../style.css">
<link rel="stylesheet" href="uploadifyit/uploadify.css" type="text/css" />
<script type="text/javascript" src="uploadifyit/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="uploadifyit/swfobject.js"></script>
<script type="text/javascript" src="uploadifyit/jquery.uploadify.v2.1.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="admin_style.css">
</head>

<body >
	<div style="width: 1026px;margin: auto;min-height: 100%;">
		<!--log out button-->
		<a style="float: right;margin-top: 40px;background: url('../images/logout.png');height: 30px;display: block;width: 30px;" href="?run=logout"></a>
		<!--add images-->
       <a href="add.php"><div id="add">Додавање</div></a>
	   	<!--edit images-->
	   <a href="edit.php"><div id="edit">Измена </div></a>
     </div>

</body>
</html>




