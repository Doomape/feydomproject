<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
<link rel="stylesheet" type="text/css" href="style.css">
 <script type="text/javascript" src="Scripts/jquery.js"></script>
 <script src="http://code.jquery.com/jquery-latest.js"></script>
 <script type="text/javascript" src="Scripts/jquery-1.4.2.min.js"></script>

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
				<div id="textTop" style="float:left; min-height: 410px; max-width:275px; width:275px;">
					<div id="contact_form" style="display:none">
						<section class="body">
							<form method="post" action="http://www.tangledindesign.com/blog/demos/contact-form/index.php">
								<label>Name</label>
								<input name="name" placeholder="Type Here">
								<label>Email</label>
								<input name="email" type="email" placeholder="Type Here">
								<label>Message</label>
								<textarea name="message" placeholder="Type Here"></textarea>
								<label>*What is 2+2? (Anti-spam)</label>
								<input name="human" placeholder="Type Here">
								<input id="submit" name="submit" type="submit" value="Submit">
							</form>
							
						</section>
					</div>
				</div> 
		    </div>
		   <div style="clear:both"></div>
			<div id="contentBottom">
			</div>
        </div>
        <div style="clear:both"></div>
    </div>
</div>
<!--footer-->
<?php include 'master/footer.php'; ?>

<script type="text/javascript">
$("#contact").click(function(event){
    $("#contact_form").css('display','block');
});
</script>
</body>
</html>