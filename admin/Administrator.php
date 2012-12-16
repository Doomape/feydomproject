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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
<link rel="stylesheet" type="text/css" href="../style.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="../Scripts/slide.js"></script>
<link rel="stylesheet" type="text/css" href="admin_style.css">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../style.css">
<script type="text/javascript" src="uploadifyit/swfobject.js"></script>
<script type="text/javascript" src="uploadifyit/jquery.uploadify.v2.1.4.min.js"></script>
<link rel="stylesheet" href="uploadifyit/uploadify.css" type="text/css" />
<title>Feydom</title>
</head>

<body>
<div id="wrap">
    <div id="main">
		<div style="width:1026px; height:30px;position:relative;"><a style="top: 0;right:0;position:absolute; background: url('../images/logout.png');height: 30px;display: block;width: 30px;" href="?run=logout"></a></div>
        <!--header-->
        <?php include 'master/admin_header.php'; ?>
        <!--left-side-->
        <?php include 'master/admin_left-side.php'; ?>
        <!--main content-->
        <div id="maincontent">
			<div  id="contentTop">
				<div id="imageTop" style="float:left; max-width: 546px; width: 546px; min-height: 410px;position:relative"></div>
				<div id="textTop" style="float: left;min-height: 404px;max-width: 275px;width: 275px;max-height: 404px;overflow: overlay;">
					
				</div> 
		    </div>
		   
			<div id="contentBottom">
			</div>
        </div>
        	<!--<div class="uploadform">
				
				<form id="form1" name="form1" action="">
					<input type="file" id="file_upload" name="file_upload" /><br />
					<a id="uploadButton" href="javascript:$('#file_upload').uploadifyUpload();">Додади</a>
				
				</form>-->
			</div>
    </div>
</div>
<!--footer-->
<?php include 'master/footer.php'; ?>
<script type="text/javascript">

function startpage(){

	
  $('#start').trigger('click');
}
startpage();

$("#contact").click(function(event){
	$("#textTop").css('height','496px');
	$("#textTop").css('max-height','496px');
    $("#textTop").empty();
	$("#textTop").append("<div id='contact_form'><section class='body'><form method='post' action='/function/sendmail.php'><label>Name</label><input  name='name' placeholder='Type Here'><label>Email</label><input name='email' type='email' placeholder='Type Here'><label>Message</label><textarea name='message' placeholder='Type Here'></textarea><button type='submit' id='submit' name='submit' value='Submit'/></form></section></div>");
});

/*$("#file_upload").uploadify
	({
		'uploader': 'uploadifyit/uploadify.swf',
		'script': 'uploadifyit/uploadify.php',
		'cancelImg': 'uploadifyit/cancel.png',
		'folder': '../images/sidebarImages',
		'auto': false, // use for auto upload
		'multi': true,
		'queueSizeLimit': 1,
		'onQueueFull': function(event, queueSizeLimit) 
		{
			alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
			return false;
		},
		'onComplete': function(event, ID, fileObj, response, data) 
		{
			var url_left_sidebar=fileObj.filePath;
			<!--send the image url to the script that insert that url into the "left_sideBar" table-->
			

		}
	});*/
</script>
</body>
</html>


