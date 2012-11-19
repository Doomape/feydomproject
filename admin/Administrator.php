 
<?php
 echo $_SERVER['DOCUMENT_ROOT'];

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
<head>

<link rel="stylesheet" href="uploadifyit/uploadify.css" type="text/css" />
<script type="text/javascript" src="uploadifyit/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="uploadifyit/swfobject.js"></script>
<script type="text/javascript" src="uploadifyit/jquery.uploadify.v2.1.4.min.js"></script>
</head>
<body>

<a href="?run=logout">Logout</a>

<form id="form1" name="form1" action="">
<input type="file" id="file_upload" name="file_upload" /><br />
<a href="javascript:$('#file_upload').uploadifyUpload();">Upload File</a>
</form>
 
<script type="text/javascript">

$(document).ready(function() {
	
	//alert('I am ready to use uploadify!');
	$("#file_upload").uploadify({
		'uploader': 'uploadifyit/uploadify.swf',
		'script': 'uploadifyit/uploadify.php',
		'cancelImg': 'uploadifyit/cancel.png',
		'folder': 'uploads',
		'auto': false, // use for auto upload
		'multi': true,
		'queueSizeLimit': 2,
		'onQueueFull': function(event, queueSizeLimit) {
			alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
			return false;
		},
		'onComplete': function(event, ID, fileObj, response, data) {
			alert("Filename: " + fileObj.name + "\nSize: " + fileObj.size + "\nFilepath: " + fileObj.filePath);

			
			// you can use here jQuery AJAX method to send info at server-side.
		}
	});


	
});

</script>


</body>
</html>