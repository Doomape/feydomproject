<div id="header">

 <?php
		$con = mysql_connect("localhost","root","");
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }        
		 mysql_select_db("feydom", $con);
		$result = mysql_query("SELECT * FROM left_sidebar");
		$i=0;
		while($row = mysql_fetch_array($result))
		  {
		  		 $slikaSideBar=$row['sidebarURL'];
				 $id=$row['id'];
				 $isStartPage=$row['isStartPage'];
				if($id==0)
				{
				 echo "<a id=".$id." href=javascript: void(0);><img id="."img_".$id." onclick='headerClick(".$id.")' class='logo' style='background:url(" .$slikaSideBar. ") no-repeat' /></a>"; 
				}
				if($id>0&&$id<4)
				{
					if($row['isContact']!="true")
					{
						if($isStartPage=="true")
						echo "<a href='javascript: void(0);'><img id='start' onclick='headerClick(".$id.")' class='imgup' style='background:url(" .$slikaSideBar. ") no-repeat' /></a>"; 
						else
						echo "<a href='javascript: void(0)';><img id="."img_".$id." onclick='headerClick(".$id.")' class='imgup' style='background:url(" .$slikaSideBar. ") no-repeat' /></a>"; 
					}
					else
					echo "<a href='javascript: void(0)';><img id='contact' onclick='headerClick(".$id.")' class='imgup' style='background:url(" .$slikaSideBar. ") no-repeat' /></a>";
				}			 
		  }
		mysql_close($con);
	?>

	<script type="text/javascript">
		function headerClick(e)
		{
			$("#contentTop").css('display', 'block');
		    $("#contentBottom").css('display', 'block');
			<!--content top image-->
			$.post("function/contentTopImage.php", {data: e }, 
			function(imageTop)
			{    
				$("#imageTop").append("<img src='"+imageTop+"'/>");
				
			});
			$("#imageTop").empty();
			
			<!--content bottom images-->
			$.post("function/contentBottomImage.php", {data: e }, 
			function(imageBottom)
			{ 
				var differentPictures=imageBottom.split('#');
				for(i=1; i<=differentPictures.length-1; i++)
				{
					<!--normal picture-->
					if(differentPictures[i].split('*')[1].split("%")[0]=="false")
					{
						$("#contentBottom").append("<img style='width:205px;'src='"+differentPictures[i].split('*')[0]+"'/>");
					}
					<!--galery thumb picture-->
					if(differentPictures[i].split('*')[1].split("%")[0]=="true")
					{
						$("#contentBottom").append("<a href=javascript: void(0);><img style='width: 205px;' style='margin-right:10px;margin-bottom:10px;'onclick='headergaleryClick("+differentPictures[i].split('*')[1].split("%")[1]+")' src='"+differentPictures[i].split('*')[0]+"'></img></a>");
					}
				}
			});
			$("#contentBottom").empty();
		 }
		 <!--enter into galery-->
		 function headergaleryClick(e)
		 {
		 	$("#contentTop").empty();
		    $("#contentBottom").empty();
			
			$.post("function/galery.php", {data: e }, 
			function(galeryImages)
			{
				var differentPictures=galeryImages.split('#');
				for(i=1; i<=differentPictures.length-1; i++)
				{
					if(differentPictures[i].split('*')[1].split("%")[0]=="true")
					{
						$("#contentTop").css('display', 'block');
						$("#contentTop").append("<img src='"+differentPictures[i].split('*')[0]+"'/>");
						$("#contentBottom").append("<a href=javascript: void(0);><img  style='width: 205px;' onclick='headershowOnTop("+differentPictures[i].split('*')[1].split("%")[1]+")' src='"+differentPictures[i].split('*')[0]+"'/></a>");	
					}
					if(differentPictures[i].split('*')[1].split("%")[0]=="false")
					{  
						$("#contentBottom").css('display', 'block');
						$("#contentBottom").append("<a href=javascript: void(0);><img style='width: 205px;' onclick='headershowOnTop("+differentPictures[i].split('*')[1].split("%")[1]+")' src='"+differentPictures[i].split('*')[0]+"'/></a>");
					}
				}
			});
		 }
		 <!--change galery image-->
		  function headershowOnTop(e)
		 {
			$("#contentTop").empty();
			$.post("function/galeryTopImage.php", {data: e }, 
			function(topImage)
			{
				$("#contentTop").append("<img src='"+topImage+"'/>");
			});
		 }
	</script>

</div>
<div style="clear:both"></div>