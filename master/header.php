<div id="header">

 <?php
		$con = mysql_connect("localhost","root","");
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }        
		 mysql_select_db("feydom", $con);
		
		
		$isStartPage=null;
		$idstart=null;
		$slikalogo=null;
		
		//get logo image
		$result1=mysql_query("SELECT sidebarURL FROM left_sidebar where id=0");
		while($row1 = mysql_fetch_array($result1))
		{
			$slikalogo=$row1['sidebarURL'];
		}
		
		//check which page is start page and get that id
		$result = mysql_query("SELECT * FROM left_sidebar");
		while($row2 = mysql_fetch_array($result))
		{
			$isStartPage=$row2['isStartPage'];
			if($isStartPage=="true")
			{
					$idstart=$row2['id'];
			}
		}
		
		//print logo
		if($idstart<=3)
		echo "<a href=javascript: void(0);><img onclick='headerClick(".$idstart.")' class='logo' style='background:url(" .$slikalogo. ") no-repeat' /></a>"; 
		else
		echo "<a href=javascript: void(0);><img onclick='sideClick(".$idstart.")' class='logo' style='background:url(" .$slikalogo. ") no-repeat' /></a>"; 
		
		$result2 = mysql_query("SELECT * FROM left_sidebar");
		while($row2 = mysql_fetch_array($result2))
		  {
		  		 $slikaSideBar=$row2['sidebarURL'];
				 $id=$row2['id'];
				 $isStartPage1=$row2['isStartPage'];

				if($id>0&&$id<4)
				{
					if($row2['isContact']!="true")
					{
						if($isStartPage1=="true")
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
		   	$("#imageTop").empty();
			$("#textTop").empty();
			
			$("#contentTop").css('display', 'block');
		    $("#contentBottom").css('display', 'block');
			
			$("#imageTop").css('max-width','546px');
			$("#imageTop").css('min-height','410px');
			$("#imageTop").css('width','546px');
			//	min-height: 410px; max-width:275px; width:275px;
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
				$("#imageTop").append("<img  style='max-width: 546px; max-height:410px; float:left' src='"+pictire_and_text[i].split('*')[0]+"'/>");
				$("#textTop").append("<p>"+pictire_and_text[i].split('*')[1]+"</p> ");	
				}
			});

			<!--content bottom images-->
			$.post("function/contentBottomImage.php", {data: e }, 
			function(imageBottom)
			{ 
		//	alert(imageBottom);
				$("#contentBottom").empty();
				var differentPictures=imageBottom.split('#');
				for(i=1; i<=differentPictures.length-1; i++)
				{				
			//	alert(differentPictures[i].split('*')[1].split("%")[1].split("&")[0]);
			//alert(differentPictures[i].split('*')[1].split("%")[1]);
				var idmc=differentPictures[i].split('*')[1].split("%")[1].split("&")[0];
				var maincontentURL=differentPictures[i].split('*')[0];
				var imageCheck=differentPictures[i].split('*')[1].split("%")[0];
					<!--top picture-->
					if(imageCheck=="top")
					{
						//debugger;
					    $("#contentBottom").append("<a href=javascript: void(0);><div onclick='headerPutOnTop("+idmc+")' id='thumbPicture' style='float:left; min-height:210px; width: 205px;'><img style='max-width:205px; max-height:205px;' src='"+maincontentURL+"'/></div></a>");
				    }
					//	$("#textTop").append("<p>"+differentPictures[i].split('*')[1].split("%")[1].split("&")[1].split("@")[0]+"</p> ");	
					
					<!--normal picture-->
					if(imageCheck=="normal")
					{
					    $("#contentBottom").append("<div id='thumbPicture' style='float:left; min-height:210px;width: 205px;'><img style='max-width:205px; max-height:205px;' src='"+maincontentURL+"'/></div>");
					}
					<!--galery thumb picture-->
					if(imageCheck=="galery")
					{
						$("#contentBottom").append("<a href=javascript: void(0);><div onclick='headerGaleryClick("+idmc+")'  id='thumbPicture' style='float:left; min-height:210px;width: 205px;'><img style='max-width:205px; max-height:205px;' src='"+maincontentURL+"'/></div></a>");
					}			
				}					
			});

		 }
		 
		 function headerPutOnTop(e)
		 {
			$("#imageTop").empty();
			$("#textTop").empty();
			$.post("function/showTopImage.php", {data: e }, 
			function(topImage)
			{
			//	alert(topImage.split("#")[1].split("%")[0]);
				var topPicture=topImage.split("#")[1].split("%")[0];
				var topText=topImage.split("#")[1].split("%")[1];
				$("#imageTop").append("<img style='max-width: 546px;max-height:410px;' src='"+topPicture+"'/>");
				$("#textTop").append("<p>"+topText+"</p>");
			});
		 }

		 <!--enter into galery-->
		 function headerGaleryClick(e)
		 {
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
				var differentPictures=galeryImages.split('#');
				for(i=1; i<=differentPictures.length-1; i++)
				{// alert(differentPictures[i].split('*')[1].split("%")[1]);
					if(differentPictures[i].split('*')[1].split("%")[0]=="true")
					{
						$("#imageTop").css('display', 'block');
						$("#imageTop").css('max-width','821px');
						$("#imageTop").css('width','821px');
						$("#imageTop").css('min-height','410px');
						$("#imageTop").append("<img style='max-height:410px'src='"+differentPictures[i].split('*')[0]+"'/>");
						$("#contentBottom").append("<a href=javascript: void(0);><div style='float:left; min-height:210px;max-width:205px;max-height:205px;width: 205px;'><img style='max-width:205px; max-height:410px;' onclick='headerShowOnTop("+differentPictures[i].split('*')[1].split("%")[1]+")' src='"+differentPictures[i].split('*')[0]+"'/></div></a>");	
					}
					if(differentPictures[i].split('*')[1].split("%")[0]=="false")
					{  
						$("#contentBottom").css('display', 'block');
						$("#contentBottom").append("<a href=javascript: void(0);><div style='float:left; min-height:210px;max-width:205px;width: 205px;'><img style='max-width:205px; max-height:205px;'  onclick='headerShowOnTop("+differentPictures[i].split('*')[1].split("%")[1]+")' src='"+differentPictures[i].split('*')[0]+"'/></div></a>");
					}
				}
			});
		 }
		 <!--change galery image-->
		  function headerShowOnTop(e)
		 {
			$("#imageTop").empty();
			$.post("function/galeryTopImage.php", {data: e }, 
			function(topImage)
			{
						$("#imageTop").css('display', 'block');
						$("#imageTop").css('max-width','821px');
						$("#imageTop").css('width','821px');
						$("#imageTop").css('min-height','410px');
				$("#imageTop").append("<img style='max-height:410px' src='"+topImage+"'/>");
			});
		 }  
	</script>


</div>
<div style="clear:both"></div>