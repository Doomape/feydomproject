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
<body>
	<div style="width: 1026px;margin: auto;min-height: 100%;">
			<a style="float: right;margin-top: 40px;background: url('../images/logout.png');height: 30px;display: block;width: 30px;" href="?run=logout"></a>
		<div id="container" style="margin-top:40px;">

			<div class="uploadform">
				<p class="titletext">Додавање на слика во левата колона</p>
				<form id="form1" name="form1" action="">
					<input type="file" id="file_upload" name="file_upload" /><br />
					<a id="uploadButton" href="javascript:$('#file_upload').uploadifyUpload();">Додади</a>
					<a id="removeButton"  onclick='removePicture("left_sidebar")' href="" style="display:none">Избриши</a>
					
					<div id="left_checkBox" style="display:none">Почетна страна
					<input  type="checkbox" id="checkBoxO" name="checkBoxO" onclick="checkBox3();"/></div>
				
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
					<input type="checkbox" id="checkboxT" name="checkboxT" onclick="checkBox1();"/></p>
					<p class="titletext">Додавање на слики за галерија
					<input type="checkbox" id="checkboxT1" name="checkboxT1" onclick="checkBox2();"/></p>
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
var k="";
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
			
			$("#upload2").css('display','block');
			$("#uploadButton").css('display','none');
			$("#menu").css('display','block');
			$("#removeButton").css('display','block');
			$("#left_checkBox").css('display','block');
			checkBox3(url_left_sidebar);

		}
	});
	<!--when the image is uploaded, it will be showed another image load for the contentTop image--> 
	$("#file_upload1").uploadify
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
			var url_topPicture=fileObj.filePath;
			<!--send the image url to the script that insert that url into the "left_sideBar" table-->
			$.post("../function/insertContentTop.php", {data: url_topPicture });
			$("#uploadButton1").css('display','none');
		}
	});

});

function checkBox3(e)
{
	k=e;
	//alert("koki");
 if(document.getElementById('checkBoxO').checked)
{
alert(k);
	//$.post("../function/insertLeftSideBar.php", {data: e });
}
	 if(!(document.getElementById('checkBoxO').checked))
{
	//alert(2);
} 
}
<!--get the name of the table-->
function removePicture(e)
{
	<!--send the name of the table where the picture is, and delete the last picture in that table-->
	$.post("../function/removeLastImage.php", {data: e });
}
function checkBox1()
	{
       					
	    if(document.getElementById('checkboxT').checked)
	    {
			$("#file_upload2").uploadify
			({
				'uploader': 'uploadifyit/uploadify.swf',
				'script': 'uploadifyit/uploadify.php',
				'cancelImg': 'uploadifyit/cancel.png',
				'folder': '../images/galeryThumb',
				'auto': false, // use for auto upload
				'multi': true,
				'queueSizeLimit': 100,
				'onQueueFull': function(event, queueSizeLimit) 
				{
					alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
					return false;
				},
				'onComplete': function(event, ID, fileObj, response, data) 
				{
					var url_BottomCategoryPicture=fileObj.filePath;
					//alert(url_BottomGaleryPicture);
					<!--send the image url to the script that insert that url into the "left_sideBar" table-->
					$.post("../function/insertBottomCategoryImage.php", {data: url_BottomCategoryPicture });
					$("#uploadButton2").css('display','none');
				}
			});
		  $("#upload3").css('display','block');
		}
	    if(!(document.getElementById('checkboxT').checked))
	    {
	    $("#upload3").empty();
		  $("#upload3").append("<form id='form3' name='form3' action=''><input type='file' id='file_upload2' name='file_upload2'/><br/><a id='uploadButton2' href='javascript:$('#file_upload2').uploadifyUpload();'>??????</a></form>");
		  $("#upload3").css('display','none');
		}
	}
	
	function checkBox2()
	{
       					
	    if(document.getElementById('checkboxT1').checked)
	    {
			$("#file_upload2").uploadify
			({
				'uploader': 'uploadifyit/uploadify.swf',
				'script': 'uploadifyit/uploadify.php',
				'cancelImg': 'uploadifyit/cancel.png',
				'folder': '../images/galeryThumb',
				'auto': false, // use for auto upload
				'multi': true,
				'queueSizeLimit': 100,
				'onQueueFull': function(event, queueSizeLimit) 
				{
					alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
					return false;
				},
				'onComplete': function(event, ID, fileObj, response, data) 
				{
					var url_BottomGaleryPicture=fileObj.filePath;
					//alert(url_BottomGaleryPicture);
					<!--send the image url to the script that insert that url into the "left_sideBar" table-->
					$.post("../function/insertBottomGaleryImage.php", {data: url_BottomGaleryPicture });
					$("#uploadButton2").css('display','none');
				}
			});
		  $("#upload3").css('display','block');
		}
	    if(!(document.getElementById('checkboxT1').checked))
	    {
	    $("#upload3").empty();
		  $("#upload3").append("<form id='form3' name='form3' action=''><input type='file' id='file_upload2' name='file_upload2'/><br/><a id='uploadButton2' href='javascript:$('#file_upload2').uploadifyUpload();'>??????</a></form>");
		  $("#upload3").css('display','none');
		}
	}
</script>
</body>
</html>