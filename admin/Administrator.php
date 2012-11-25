 
<?php
// echo $_SERVER['DOCUMENT_ROOT'];

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
<link rel="stylesheet" type="text/css" href="../style.css">
<link rel="stylesheet" href="uploadifyit/uploadify.css" type="text/css" />
<script type="text/javascript" src="uploadifyit/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="uploadifyit/swfobject.js"></script>
<script type="text/javascript" src="uploadifyit/jquery.uploadify.v2.1.4.min.js"></script>

<style>
.titletext
{
	margin-bottom: 20px;
	color: #4B4B4B;
	font-weight: bold;
}
.uploadform
{
	margin-bottom: 2px;
	float: left;
	border-radius: 15px;
	border: 2px solid gray;
	padding: 10px;
	background: skyBlue;
	width:300px;
	margin-right: 5px;
}
body
{
	color: #333;
	background: url(//s.ytimg.com/yts/img/refresh/body_noise-vfl_60-qt.png);
	background-color: #EBEBEB;
	background-repeat: repeat;
}
#add
{
background:url('../images/add.png') no-repeat center center;
height:128px;
width:128px;
  position: absolute;
    top: 40%;
    left: 50%;
    margin-left: -24px;
}
#edit
{
background:url('../images/edit.png') no-repeat center center;
height:128px;
width:128px;
  position: absolute;
    top: 40%;
    left: 50%;
    margin-left: -144px;
}
#addtext
{
  position: absolute;
    top: 35%;
    left: 52.3%;
    margin-left: -24px;
	font-weight:bold;
}
#edittext
{
  position: absolute;
    top: 35%;
    left: 52.8%;
    margin-left: -144px;
	font-weight:bold;
}
</style>
</head>

<body >
<div id="addtext">Додавање</div>
<div id="edittext">Измена</div>
<div onclick="show_add();" id="add"></div>
<div onclick="show_edit();" id="edit"></div>

	<div style="width: 1026px;margin: auto;min-height: 100%;">
		<!--log out button-->
		<a style="float: right;margin-top: 40px;background: url('../images/logout.png');height: 30px;display: block;width: 30px;" href="?run=logout"></a>
		
		<!--edit images-->
		<div style="margin-top:40px;display:none;float:left" id="edit_page">
			<div id="wrap">
				<div id="main">
					<!--header-->
					<?php include '../master/header.php'; ?>
					<!--left-side-->
					<?php include '../master/left-side.php'; ?>
					<!--main content-->
					<div id="maincontent">
						<div id="contentTop">
						</div>
						<div id="contentBottom">
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
			</div>
		</div>
		
		<!--add images-->
		<div id="container" style="margin-top:40px;display:none">

			<div class="uploadform">
				<p class="titletext">Додавање на слика во левата колона</p>
				<form id="form1" name="form1" action="">
					<input type="file" id="file_upload" name="file_upload" /><br />
					<a id="uploadButton" href="javascript:$('#file_upload').uploadifyUpload();">Додади</a>
				</form>
			</div>
			<div id="upload2" class="uploadform" style="display:none">
				<p class="titletext">Додавање на главна слика</p>
				<form id="form2" name="form2" action="">
				<input type="file" id="file_upload1" name="file_upload1"/><br/>
				<a id="uploadButton1" href="javascript:$('#file_upload1').uploadifyUpload();">Додади</a>
				</form>
			</div>
			<div style="clear:both"></div>
				<div id="menu" class="uploadform" style="display:none; float:right">
					<p class="titletext">Додавање на слики за категорија
					<input type="checkbox" id="checkboxT" name="checkboxT" onclick="calc();"/></p>
				</div>
				<div style="clear:both"></div>
				<div id="upload3" class="uploadform" style="display:none; float: right;">
					<form id="form3" name="form3" action="">
						<input type="file" id="file_upload2" name="file_upload2"/><br/>
						<a id="uploadButton2" href="javascript:$('#file_upload2').uploadifyUpload();">Додади</a>
					</form>
				</div>
		 </div>
	 </div>
 
<script type="text/javascript">

$(document).ready(function() {
<!--upload image for left side bar-->
	$("#file_upload").uploadify
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
			$.post("../function/insertLeftSideBar.php", {data: url_left_sidebar });
			$("#upload2").css('display','block');
			$("#uploadButton").css('display','none');
			$("#menu").css('display','block');
		}
	});
	<!--when the image is uploaded, it will be showed another image load for the contentTop image--> 
	$("#file_upload1").uploadify
	({
		'uploader': 'uploadifyit/uploadify.swf',
		'script': 'uploadifyit/uploadify.php',
		'cancelImg': 'uploadifyit/cancel.png',
		'folder': '../images/galeryThumb',
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
			var url_topPicture=fileObj.filePath;
			<!--send the image url to the script that insert that url into the "left_sideBar" table-->
			$.post("../function/insertContentTop.php", {data: url_topPicture });
			$("#uploadButton1").css('display','none');
		}
	});

});

function calc()
	{

	  if(document.getElementById('checkboxT').checked)
	
		    $("#upload3").css('display','block');
			$("#file_upload2").uploadify
			({
				'uploader': 'uploadifyit/uploadify.swf',
				'script': 'uploadifyit/uploadify.php',
				'cancelImg': 'uploadifyit/cancel.png',
				'folder': '../images/galeryThumb',
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
				//	var url_topPicture=fileObj.filePath;
					<!--send the image url to the script that insert that url into the "left_sideBar" table-->
				//	$.post("../function/insertContentTop.php", {data: url_topPicture });
				//	$("#uploadButton1").css('display','none');
				}
			});
		
	}
function show_add()
{
	$("#container").css("display","block");
	$("#addtext").css("display","none");
	$("#edittext").css("display","none");
	$("#edittext").css("display","none");
	$("#edit").css("display","none");
	$("#add").css("display","none");
}
function show_edit()
{
	$("#edit_page").css("display","block");
	$("#addtext").css("display","none");
	$("#edittext").css("display","none");
	$("#edittext").css("display","none");
	$("#edit").css("display","none");
	$("#add").css("display","none");
}
</script>

</body>
</html>




