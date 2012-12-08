<div id="header">

 <?php
		$con = mysql_connect("localhost","alienper_root","kokikoki");
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }        
		 mysql_select_db("alienper_feydom", $con);

		$isStartPage=null;
		$idstart=null;
		$slikalogo=null;
		
		//get logo image
		$result1=mysql_query("SELECT sidebarURL FROM left_sidebar where id=0");
		while($row1 = mysql_fetch_array($result1)){
			$slikalogo=$row1['sidebarURL'];
		}
		
		//check which page is start page and get that id
		$result = mysql_query("SELECT * FROM left_sidebar");
		while($row2 = mysql_fetch_array($result)){
			$isStartPage=$row2['isStartPage'];
			if($isStartPage=="true")
			{
					$idstart=$row2['id'];
			}
		}
		
		//print logo
		if($idstart<=3)
		echo "<a href=javascript: void(0);><div onclick='headerClick(".$idstart.")' class='logo' style='background:url(" .$slikalogo. ") no-repeat' ></div></a>"; 
		else
		echo "<a href=javascript: void(0);><div onclick='sideClick(".$idstart.")' class='logo' style='background:url(" .$slikalogo. ") no-repeat' ></div></a>"; 
		
		$result2 = mysql_query("SELECT * FROM left_sidebar");
		while($row2 = mysql_fetch_array($result2)){
		  		 $slikaSideBar=$row2['sidebarURL'];
				 $id=$row2['id'];
				 $isStartPage1=$row2['isStartPage'];

				if($id>0&&$id<4)
				{
					if($row2['isContact']!="true")
					{
						if($isStartPage1=="true")
						echo "<a href='javascript: void(0);'><div id='start' onclick='headerClick(".$id.")' class='imgup' style='background:url(" .$slikaSideBar. ") no-repeat' ></div></a>"; 
						else
						echo "<a href='javascript: void(0)';><div id="."img_".$id." onclick='headerClick(".$id.")' class='imgup' style='background:url(" .$slikaSideBar. ") no-repeat' ></div></a>"; 
					}
					else
					echo "<a href='javascript: void(0)';><div id='contact' onclick='headerClick(".$id.")' class='imgup' style='background:url(" .$slikaSideBar. ") no-repeat' ></div></a>";
				}			 
		  }
		mysql_close($con);
	?>

	<script type="text/javascript">
	
		var viewer = null;
		function headerClick(e){
			<!--empty the imageTop and the text container in case they are full-->
		   	$("#imageTop").empty();
			$("#textTop").empty();
			<!--show the containers -->
			$("#contentTop").css('display', 'block');
		    $("#contentBottom").css('display', 'block');
			<!--setting width and height in case they are changed in another entering level -->
			$("#imageTop").css('max-width','546px');
			$("#imageTop").css('min-height','410px');
			$("#imageTop").css('width','546px');
			<!---//--->
			$("#textTop").css('max-width','275px');
			$("#textTop").css('min-height','410px');
			$("#textTop").css('width','275px');
			<!--content top image-->
			<!--send the id of the top sidebar pictire -->
			$("#textTop").css('height','410px');
			$('#textTop').css('max-height','410px');
			$.post("function/contentTopImage.php", {data: e }, 
			<!--get the top image and the top text -->
			
			
			function(image_and_text)
			{ 
			    var pictire_and_text=image_and_text.split('#');
				for(i=1; i<=pictire_and_text.length-1; i++)
				{
				var maincontentURL=pictire_and_text[i].split('*')[0];
				var imageText=pictire_and_text[i].split('*')[1];
				$("#imageTop").append("<img  class='imgtopContent' src='"+maincontentURL+"'/>");
				$("#textTop").append("<p class='prod_desc'>"+imageText+"</p> ");	
				}
			});
			<!--content bottom images-->
			<!--send the id of the top sidebar pictire -->
			$.post("function/contentBottomImage.php", {data: e }, 
			<!-- get the bottom pictures  -->
			function(imageBottom)
			{
				$("#contentBottom").empty();
				var differentPictures=imageBottom.split('#');
				for(i=1; i<=differentPictures.length-1; i++)
				{				
				var idmc=differentPictures[i].split('*')[1].split("%")[1].split("&")[0];
				var maincontentURL=differentPictures[i].split('*')[0];
				var imageCheck=differentPictures[i].split('*')[1].split("%")[0];
					<!--top picture; if imageCheck=top in the database, that image can be display in the imageTop container, in the same page-->
					if(imageCheck=="top")
					{
					    $("#contentBottom").append("<a href='javascript: void(0);'><div onclick='headerPutOnTop("+idmc+")' id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+maincontentURL+"'/></div></a>");
				    }
					<!--normal picture; picture that is displayed in that page and have no functions-->
					if(imageCheck=="normal")
					{
					    $("#contentBottom").append("<div id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+maincontentURL+"'/></div>");
					}
					<!--galery thumb picture;  top picture = if imageCheck=galery in the database, that image can contain another pictures -->
					if(imageCheck=="galery")
					{
						$("#contentBottom").append("<a href='javascript: void(0);'><div onclick='headerGaleryClick("+idmc+")'  id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+maincontentURL+"'/></div></a>");
					}			
				}					
			});

		 }
		 <!-- pictures that are displayed on the imageTop container if they are clicked -->
		 function headerPutOnTop(e){
			$("#imageTop").empty();
			$("#textTop").empty();
			$.post("function/showTopImage.php", {data: e }, 
			function(topImage)
			{
				var topPicture=topImage.split("#")[1].split("%")[0];
				var topText=topImage.split("#")[1].split("%")[1];
				$("#imageTop").append("<img class='imgtopContent' src='"+topPicture+"'/>");
				$("#textTop").append("<p class='prod_desc'>"+topText+"</p>");
                                $("#textTop").getNiceScroll().resize();

			});
		 }

		 <!--enter into galery-->
		 function headerGaleryClick(e){
			viewer=new PhotoViewer();
		 	$("#imageTop").empty();
			$("#textTop").empty();
			/*$("#textTop").css('max-width','0px');
			$("#textTop").css('min-height','0px');
			$("#textTop").css('width','0px');*/
		    $("#contentBottom").empty();
			<!-- send the id of the galery that is clicked -->
			$.post("function/galery.php", {data: e }, 
			<!-- get all the pictures of that galery -->
			function(galeryImages)
			{
				var k=0;
				var differentPictures=galeryImages.split('#');
				for(i=1; i<=differentPictures.length-1; i++)
				{
					mainPicture=differentPictures[i].split('*')[1].split('%')[0];
					videoURL=differentPictures[i].split('*')[1].split('%')[1].split('$')[1].split('&')[0];
					galeryURL=differentPictures[i].split('*')[0];
					idpic=differentPictures[i].split('*')[1].split('%')[1].split('$')[0];
					imageText=differentPictures[i].split('*')[1].split('%')[1].split('$')[1].split('&')[1];
					if(mainPicture=="true")
					{
						/*$("#imageTop").css('display', 'block');
						$("#imageTop").css('max-width','821px');
						$("#imageTop").css('width','821px');
						$("#imageTop").css('min-height','410px');*/
						$("#imageTop").append("<img style='max-height:410px'src='"+galeryURL+"'/>");
						$("#textTop").append("<p class='prod_desc'>"+imageText+"</p>");
						if(videoURL!="/")
						{
							$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<a href='javascript: void(0);'><div class='contentBottom'><img class='imgBottom' onclick='headerShowOnTop("+idpic+")' src='http://localhost/feydomproject/images/video.png'/></div></a>");
							$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div onclick='headerShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom'  src='"+galeryURL+"'/></div></a>");	
							viewer.add(differentPictures[i].split('*')[0]);
							k++;
						}
					else
						{
						$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div onclick='headerShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom'  src='"+galeryURL+"'/></div></a>");	
						viewer.add(differentPictures[i].split('*')[0]);
						k++;
						}
					}
					if(mainPicture=="false")
					{  
						if(videoURL!="/")
						{
							$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<a href='javascript: void(0);'><div onclick='headerShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom' onclick='headerShowOnTop("+idpic+")' src='http://localhost/feydomproject/images/video.png'/></div></a>");
							$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div onclick='headerShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom'  src='"+galeryURL+"'/></div></a>");	
							viewer.add(differentPictures[i].split('*')[0]);
							k++;
						}
						else
						{
						$("#contentBottom").css('display', 'block');
						$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div onclick='headerShowImgTxtOnTop("+idpic+")'  class='contentBottom'><img class='imgBottom'  src='"+galeryURL+"'/></div></a>");	
						viewer.add(differentPictures[i].split('*')[0]);
						k++;
						}
					}
				}
			});
		 }
		 <!--change galery image-->
		  function headerShowOnTop(e){
			$("#imageTop").empty();
			$("#textTop").empty();
			$.post("function/galeryTopImage.php", {data: e }, 
			function(topVideo)
			{
				$("#imageTop").css('display', 'block');
				$("#imageTop").css('max-width','821px');
				$("#imageTop").css('width','821px');
				$("#imageTop").css('min-height','410px');
				$("#textTop").css('max-width','0px');
				$("#textTop").css('min-height','0px');
				$("#textTop").css('width','0px');
				$("#imageTop").append("<iframe width='821' height='410' src='"+topVideo+"'  frameborder='0' allowfullscreen></iframe>");
			});
		 }  
		 function headerShowImgTxtOnTop(e)
		 {
		 	$("#imageTop").empty();
			$("#textTop").empty();
			<!--show the containers -->
			$("#contentTop").css('display', 'block');
		    $("#contentBottom").css('display', 'block');
			<!--setting width and height in case they are changed in another entering level -->
			$("#imageTop").css('max-width','546px');
			$("#imageTop").css('min-height','410px');
			$("#imageTop").css('width','546px');
			<!---//--->
			$("#textTop").css('max-width','275px');
			$("#textTop").css('min-height','410px');
			$("#textTop").css('width','275px');
			<!--content top image-->
			<!--send the id of the top sidebar pictire -->
			$("#textTop").css('height','410px');
			$('#textTop').css('max-height','410px');
			
			$.post("function/showImageTextInGalery.php", {data: e }, 
			function(topImage)
			{
				var topPicture=topImage.split("#")[1].split("%")[0];
				var topText=topImage.split("#")[1].split("%")[1];
				$("#imageTop").append("<img class='imgtopContent' src='"+topPicture+"'/>");
				$("#textTop").append("<p class='prod_desc'>"+topText+"</p>");
			});
		 }
	</script>


</div>
<div style="clear:both"></div>