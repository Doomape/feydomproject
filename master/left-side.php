<div id="sidebar">

	<script type="text/javascript" src="Scripts/slide.js"></script>
	 <?php
		$con = mysql_connect("localhost","alienper_root","kokikoki");
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }     
		mysql_select_db("alienper_feydom", $con);
		 
		$result = mysql_query("SELECT * FROM left_sidebar");
		while($row = mysql_fetch_array($result)){
				 $slikaSideBar=$row['sidebarURL'];
				 $id=$row['id'];
				 $isStartPage1=$row['isStartPage'];
				 
				 if($id>=4)
				 {
					if($row['isContact']!="true")
					{
						if($isStartPage1=="true")
							echo "<a href='javascript: void(0);'><div id='start' onclick='sideClick(".$id.")' class='imgside' style='background:url(" .$slikaSideBar. ") no-repeat' ></div></a>";
						else
							echo "<a href='javascript: void(0);'><div id="."img_".$id." onclick='sideClick(".$id.")' class='imgside' style='background:url(" .$slikaSideBar. ") no-repeat' ></div></a>"; 
					}
					else
					{
						echo "<a href='javascript: void(0);'><div id='contact' onclick='sideClick(".$id.")' class='imgside' style='background:url(" .$slikaSideBar. ") no-repeat' ></div></a>"; 
					}
				 }
		  }
		mysql_close($con);
	?>

	<script type="text/javascript">
		var imgTxtNext=1;
		var viewer = null;
		var imageArray=new Array();
			
		var textArray=new Array();
		function sideClick(e){
		
		$('#page-switcher-start').addClass('hidden');
		$('#page-switcher-end').addClass('hidden');
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
				 $("#textTop").getNiceScroll().resize();
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
					    $("#contentBottom").append("<a href='javascript: void(0);'><div onclick='sidePutOnTop("+idmc+")' id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+maincontentURL+"'/></div></a>");
				    }
					<!--normal picture; picture that is displayed in that page and have no functions-->
					if(imageCheck=="normal")
					{
					    $("#contentBottom").append("<div id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+maincontentURL+"'/></div>");
					}
					<!--galery thumb picture;  top picture = if imageCheck=galery in the database, that image can contain another pictures -->
					if(imageCheck=="galery")
					{
						$("#contentBottom").append("<a href='javascript: void(0);'><div onclick='sideGaleryClick("+idmc+")'  id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+maincontentURL+"'/></div></a>");
					}			
				}					
			});

		 }
		 <!-- pictures that are displayed on the imageTop container if they are clicked -->
		 function sidePutOnTop(e){
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
		 function sideGaleryClick(e){
			viewer=new PhotoViewer();
			 imgTxtNext=1;
			textArray=[];
			imageArray=[];
		 	$("#imageTop").empty();
			$("#textTop").empty();
			//$("#page-switcher-start").css('visibility','visible');
			$('#page-switcher-start').removeClass('hidden');
			$('#page-switcher-end').removeClass('hidden');
			
    	//	<button id="page-switcher-end" class="page-switcher custom-appearance" tabindex="2" style="width: 238.875px; right: 13px; top: 0px; padding-bottom: 0px;" aria-label="Go to Apps">›
		//	</button>
	//	id='card-slider-frame' class='sliding_container'
			
			//$("#contentTop").append("<button onclick='showNext()' id='page-switcher-end' class='page-switcher custom-appearance' tabindex='2' style='width: 238.875px; right: 13px; top: 0px; padding-bottom: 0px;' aria-label='Go to Apps'>></button>"); 
			//$("#contentTop").append("<button id='page-switcher-start' class='page-switcher custom-appearance' tabindex='2' style='width: 251.875px; left: 0px; top: 0px; padding-bottom: 0px;' aria-label='Go Back'><</button>");
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
					imageArray[i]=galeryURL;
					textArray[i]=imageText;
					if(mainPicture=="true")
					{
						/*$("#imageTop").css('display', 'block');
						$("#imageTop").css('max-width','821px');
						$("#imageTop").css('width','821px');
						$("#imageTop").css('min-height','410px');*/
						$("#imageTop").append("<img style='max-height:410px'src='"+galeryURL+"'/>");
						$("#textTop").append("<p class='prod_desc'>"+imageText+"</p>");
						$("#textTop").getNiceScroll().resize();
						if(videoURL!="/")
						{
							$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<a href='javascript: void(0);'><div class='contentBottom'><img class='imgBottom' onclick='sideShowOnTop("+idpic+")' src='/images/video.png'/></div></a>");
							$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div onclick='sideShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom'  src='"+galeryURL+"'/></div></a>");	
							viewer.add(differentPictures[i].split('*')[0]);
							k++;
						}
						else
						{
						$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div onclick='sideShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom'  src='"+galeryURL+"'/></div></a>");	
						viewer.add(differentPictures[i].split('*')[0]);
						k++;
						}
					}
					if(mainPicture=="false")
					{  
						if(videoURL!="/")
						{
							$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<a href='javascript: void(0);'><div onclick='sideShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom' onclick='sideShowOnTop("+idpic+")' src='/images/video.png'/></div></a>");
							$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div onclick='sideShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom'  src='"+galeryURL+"'/></div></a>");	
							viewer.add(differentPictures[i].split('*')[0]);
							k++;
						}
						else
						{
						$("#contentBottom").css('display', 'block');
						$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div onclick='sideShowImgTxtOnTop("+idpic+")'  class='contentBottom'><img class='imgBottom'  src='"+galeryURL+"'/></div></a>");	
						viewer.add(differentPictures[i].split('*')[0]);
						k++;
						}
					}
				}
			});
			
		 }
		 function showNext()
		 {
		 
		 if(imgTxtNext<imageArray.length-1)
		 {
			imgTxtNext++;
			// console.log(imageArray);
			 $("#imageTop").empty();
			 $("#textTop").empty();
			 $("#imageTop").append("<img style='max-height:410px'src='"+imageArray[imgTxtNext]+"'/>");
			 $("#textTop").append("<p class='prod_desc'>"+textArray[imgTxtNext]+"</p>");
			  $("#textTop").getNiceScroll().resize();
		  }
		 }
		 function showPrevious()
		 {
		  
			if(imgTxtNext>1)
			{
			imgTxtNext--;
			 $("#imageTop").empty();
			 $("#textTop").empty();
			 $("#imageTop").append("<img style='max-height:410px'src='"+imageArray[imgTxtNext]+"'/>");
			 $("#textTop").append("<p class='prod_desc'>"+textArray[imgTxtNext]+"</p>");
			  $("#textTop").getNiceScroll().resize();
			 }
			
		 }
		 <!--change galery image-->
		  function sideShowOnTop(e){
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
		 function sideShowImgTxtOnTop(e)
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
				 $("#textTop").getNiceScroll().resize();
			});
		 }
		 
	</script>
	
	
</div>
