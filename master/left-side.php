
<div id="sidebar">

	<script type="text/javascript" src="Scripts/slide.js"></script>
	 <?php
		$con = mysql_connect("localhost","root","");
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }     
		mysql_select_db("feydom", $con);
		 
		$result = mysql_query("SELECT * FROM left_sidebar");
		while($row = mysql_fetch_array($result))
		  {
				 $slikaSideBar=$row['sidebarURL'];
				 $id=$row['id'];
				 $isStartPage1=$row['isStartPage'];
				 
				 if($id>=4)
				 {
					if($row2['isContact']!="true")
					{
						if($isStartPage1=="true")
							echo "<a href='javascript: void(0);'><img id='start' onclick='sideClick(".$id.")' class='imgside' style='background:url(" .$slikaSideBar. ") no-repeat' /></a>";
						else
							echo "<a href='javascript: void(0);'><img id="."img_".$id." onclick='sideClick(".$id.")' class='imgside' style='background:url(" .$slikaSideBar. ") no-repeat' /></a>"; 
					}
					else
					{
						echo "<a href='javascript: void(0);'><img id='contact' onclick='sideClick(".$id.")' class='imgside' style='background:url(" .$slikaSideBar. ") no-repeat' /></a>"; 
					}
				 }
		  }
		mysql_close($con);
	?>

	<script type="text/javascript">
		var viewer = null;
		
		function sideClick(e)
		{
		   	$("#imageTop").empty();
			$("#textTop").empty();
			$("#contentTop").css('display', 'block');
		    $("#contentBottom").css('display', 'block');
			$("#imageTop").css('max-width','546px');
			$("#imageTop").css('width','546px');
			$("#textTop").css('max-width','275px');
			$("#textTop").css('min-height','410px');
			$("#textTop").css('width','275px');
			
			<!--content top image-->
			$.post("function/contentTopImage.php", {data: e }, 
			function(image_and_text)
			{ 
			    var pictire_and_text=image_and_text.split('#');
				for(i=1; i<=pictire_and_text.length-1; i++)
				{
				$("#imageTop").append("<img  style='max-width: 546px; float:left' src='"+pictire_and_text[i].split('*')[0]+"'/>");
				$("#textTop").append("<p>"+pictire_and_text[i].split('*')[1]+"</p> ");	
				}
			});

			<!--content bottom images-->
			$.post("function/contentBottomImage.php", {data: e }, 
			function(imageBottom)
			{ 
				$("#contentBottom").empty();
				var differentPictures=imageBottom.split('#');
				for(i=1; i<=differentPictures.length-1; i++)
				{				
				var idmc=differentPictures[i].split('*')[1].split("%")[1].split("&")[0];
				var maincontentURL=differentPictures[i].split('*')[0];
				var imageCheck=differentPictures[i].split('*')[1].split("%")[0];
					<!--top picture-->
					if(imageCheck=="top")
					{
					    $("#contentBottom").append("<a href='javascript: void(0);'><div onclick='putOnTop("+idmc+")' id='thumbPicture' style='float:left; min-height:205px;'><img style='max-width:205px;' src='"+maincontentURL+"'/></div></a>");
				    }
					//	$("#textTop").append("<p>"+differentPictures[i].split('*')[1].split("%")[1].split("&")[1].split("@")[0]+"</p> ");	
					
					<!--normal picture-->
					if(imageCheck=="normal")
					{
					    $("#contentBottom").append("<div id='thumbPicture' style='float:left; min-height:205px;'><img style='max-width:205px;' src='"+maincontentURL+"'/></div>");
					}
					<!--galery thumb picture-->
					if(imageCheck=="galery")
					{
						$("#contentBottom").append("<a href='javascript: void(0);'><div onclick='galeryClick("+idmc+")'  id='thumbPicture' style='float:left; min-height:205px;'><img style='max-width:205px;' src='"+maincontentURL+"'/></div></a>");
					}			
				}					
			});

		 }
		 
		 function putOnTop(e)
		 {
			$("#imageTop").empty();
			$("#textTop").empty();
			$.post("function/showTopImage.php", {data: e }, 
			function(topImage)
			{
			//	alert(topImage.split("#")[1].split("%")[0]);
				var topPicture=topImage.split("#")[1].split("%")[0];
				var topText=topImage.split("#")[1].split("%")[1];
				$("#imageTop").append("<img style='max-width: 546px;' src='"+topPicture+"'/>");
				$("#textTop").append("<p>"+topText+"</p>");
			});
		 }

		 <!--enter into galery-->
		 function galeryClick(e)
		 {
			viewer=new PhotoViewer();
		 	$("#imageTop").empty();
			$("#textTop").empty();
		//	min-height: 410px; max-width:275px; width:275px;
			$("#textTop").css('max-width','0px');
			$("#textTop").css('min-height','0px');
			$("#textTop").css('width','0px');
		    $("#contentBottom").empty();
			
			$.post("function/galery.php", {data: e }, 
			function(galeryImages)
			{
				var k=0;
				var differentPictures=galeryImages.split('#');
				for(i=1; i<=differentPictures.length-1; i++)
				{ //alert(differentPictures[i].split('*')[0]);
			//	 viewer.add(differentPictures[i].split('*')[0]);
			//	 alert(viewer);
					if(differentPictures[i].split('*')[1].split("%")[0]=="true")
					{
				//	alert(differentPictures[i].split('*')[0]);
						$("#imageTop").css('display', 'block');
						$("#imageTop").css('max-width','821px');
						$("#imageTop").css('width','821px');
						$("#imageTop").css('min-height','410px');
						$("#imageTop").append("<img style='max-height:410px'src='"+differentPictures[i].split('*')[0]+"'/>");
						if(differentPictures[i].split('*')[1].split("%")[1].split('$')[1]!="/")
						{
							$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<a href='javascript: void(0);'><div style='float:left; min-height:205px;max-width:205px;'><img style='max-width:205px;' onclick='showOnTop("+differentPictures[i].split('*')[1].split("%")[1].split('$')[0]+")' src='http://localhost/feydomproject/images/video.png'/></div></a>");
						}
					else
						{
					//	alert(differentPictures[i].split('*')[0]);
					 viewer.add(differentPictures[i].split('*')[0]);
			//		 alert(viewer);
						$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div style='float:left; min-height:205px;max-width:205px;'><img style='max-width:205px;'  src='"+differentPictures[i].split('*')[0]+"'/></div></a>");	
						k++;
						}
					}
					if(differentPictures[i].split('*')[1].split("%")[0]=="false")
					{  
						if(differentPictures[i].split('*')[1].split("%")[1].split('$')[1]!="/")
						{
							$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<a href='javascript: void(0);'><div style='float:left; min-height:205px;max-width:205px;'><img style='max-width:205px;' onclick='showOnTop("+differentPictures[i].split('*')[1].split("%")[1].split('$')[0]+")' src='http://localhost/feydomproject/images/video.png'/></div></a>");
						}
						else
						{
					//	alert(differentPictures[i].split('*')[0]);
						viewer.add(differentPictures[i].split('*')[0]);
					//	alert(viewer);
						//alert(differentPictures[i].split('*')[1].split("%")[1].split('$')[0]);
						$("#contentBottom").css('display', 'block');
						$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div style='float:left; min-height:205px;max-width:205px;'><img style='max-width:205px;'  src='"+differentPictures[i].split('*')[0]+"'/></div></a>");	
							k++;
						}
					}
				}
			});
		 }
		 <!--change galery image-->
		  function showOnTop(e)
		 {
			$("#imageTop").empty();
			$.post("function/galeryTopImage.php", {data: e }, 
			function(topVideo)
			{
		//	alert(topVideo);
						$("#imageTop").css('display', 'block');
						$("#imageTop").css('max-width','821px');
						$("#imageTop").css('width','821px');
						$("#imageTop").css('min-height','410px');
						$("#imageTop").append("<iframe width='821' height='410' src='"+topVideo+"'  frameborder='0' allowfullscreen></iframe>");
			});
		 }  
	</script>
	
	
</div>
