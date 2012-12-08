<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="Scripts/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="Scripts/slide.js"></script>
<script type="text/javascript" src="Scripts/jquery.nicescroll.js"></script>

<title>Feydom</title>
</head>

<body>
<div id="wrap">
    <div id="main">
        <!--header-->
        <?php include 'master/header.php'; ?>
        <!--left-side-->
        <?php include 'master/left-side.php'; ?>
        <!--main content-->
        <div id="maincontent">
			<div  id="contentTop">
				<div id="imageTop" style="float:left; max-width: 546px; width: 546px; min-height: 410px;"></div>
				<div id="textTop" style="float: left;min-height: 404px;max-width: 275px;width: 275px;max-height: 404px;overflow: overlay;">
					
				</div> 
		    </div>
		   
			<div id="contentBottom">
			</div>
        </div>
        
    </div>
</div>
<!--footer-->
<?php include 'master/footer.php'; ?>

<script type="text/javascript">

var html_scroller = false;

$(document).ready(

  function() { 
    $("#textTop").niceScroll();
    html_scroller = $("html").niceScroll();
    
  }

);


function startpage(){

	
  $('#start').trigger('click');
}
startpage();

$("#contact").click(function(event){
	$("#textTop").css('height','496px');
	$("#textTop").css('max-height','496px');
    $("#textTop").empty();
	$("#textTop").append("<div id='contact_form'><section class='body'><form class='from' method='post' action='/function/sendmail.php'><label class='contactLabel'>Name</label><input class='contactInput' name='name' placeholder='Type Here'><label class='contactLabel'>Email</label><input class='contactInput' name='email' type='email' placeholder='Type Here'><label class='contactLabel'>Message</label><textarea class='textarea' name='message' placeholder='Type Here'></textarea><button type='submit' class='submit' name='submit' value='Submit'/></form></section></div>");
});
</script>
</body>
</html>