<div id="sidebar">

	<script type="text/javascript" src="../Scripts/slide.js"></script>
	 <?php
	 	$pom="../";
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
						echo "<a href='javascript: void(0);'><div id='start' onclick='sideClick(".$id.")' class='imgside' style='background:url(" .$pom.$slikaSideBar. ") no-repeat' >
						<form class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'>
						<input type='file' name='file' id="."uploadPicture_".$id."><br>
						<input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'>
						<input name='src' value='".$slikaSideBar."' type='hidden' />
						<input name='new_name' id="."new_name_".$id." type='hidden' />
						<input value='".$id."' name='id_picture' id='id_picture' type='hidden' />
						</form>
						</div>
						</a>"; 
						else
						echo "<a href='javascript: void(0)';><div id="."img_".$id." onclick='sideClick(".$id.")' class='imgside' style='background:url(" .$pom.$slikaSideBar. ") no-repeat' >
						<form class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'>
						<input type='file' name='file' id="."uploadPicture_".$id."><br>
						<input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'>
						<input name='src' value='".$slikaSideBar."' type='hidden' />
						<input name='new_name' id="."new_name_".$id." type='hidden' />
						<input value='".$id."' name='id_picture' id='id_picture' type='hidden' />
						</form>
						</div>
						</a>"; 
					}
					else
					{
						echo "<a href='javascript: void(0)';><div id='contact' onclick='sideClick(".$id.")' class='imgside' style='background:url(" .$pom.$slikaSideBar. ") no-repeat' >
					   <form class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'>
					
						<input type='file' name='file' id="."uploadPicture_".$id."><br>
						<input name='new_name' id="."new_name_".$id." type='hidden' />
						<input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'>
						
						<input name='src' value='".$slikaSideBar."' type='hidden' />
						<input value='".$id."' name='id_picture' id='id_picture' type='hidden' />
						</form>
						</div>
						</a>";
					}
				 }
		  }
		mysql_close($con);
	?>

	<script type="text/javascript">
		$('input[type="file"]').change(function() 
		{
			//console.log( $(this).val() );
			var form = $(this).parent('form');
			form.find('input[name="new_name"]').val( $(this).val().split('\\')[$(this).val().split('\\').length-1] );
		});
		var viewer = null;
		function sideClick(e){
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
			$("#textTop").css('height','410px');
			$('#textTop').css('max-height','410px');
			<!--content top image-->
			<!--send the id of the left sidebar pictire -->
			$.post("../function/contentTopImage.php", {data: e }, 
			<!--get the top image and the top text -->
			function(image_and_text){ 
			    var pictire_and_text=image_and_text.split('#');
				for(i=1; i<=pictire_and_text.length-1; i++)
				{
				var maincontentURL=pictire_and_text[i].split('*')[0];
				var imageText=pictire_and_text[i].split('*')[1];
				$("#imageTop").append("<img  class='imgtopContent' src='"+maincontentURL+"'/>");
				$("#imageTop").append("<input id='"+maincontentURL+"' onclick='fun(this);' class='edit_button' type='button' value='button' name='button'/>");
				$("#textTop").append("<p>"+imageText+"</p> ");	
				}
			});
			<!--content bottom images-->
			<!--send the id of the left sidebar pictire -->
			$.post("../function/contentBottomImage.php", {data: e }, 
			<!-- get the bottom pictures  -->
			function(imageBottom){
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
					    $("#contentBottom").append("<a href='javascript: void(0);'><div onclick='putOnTop("+idmc+")' id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+maincontentURL+"'/><input id="+maincontentURL+" onclick='fun(this);' class='edit_button' type='button' value='button' name='button'/></div></a>");
				    }
					<!--normal picture; picture that is displayed in that page and have no functions-->
					if(imageCheck=="normal")
					{
					    $("#contentBottom").append("<div id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+maincontentURL+"'/><input id="+maincontentURL+" onclick='fun(this);' class='edit_button' type='button' value='button' name='button'/></div>");
					}
					<!--galery thumb picture;  top picture = if imageCheck=galery in the database, that image can contain another pictures -->
					if(imageCheck=="galery")
					{
						$("#contentBottom").append("<a href='javascript: void(0);'><div onclick='galeryClick("+idmc+")'  id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+maincontentURL+"'/><input id="+maincontentURL+" onclick='fun(this);' class='edit_button' type='button' value='button' name='button'/></div></a>");
					}			
				}					
			});

		 }
		 <!-- pictures that are displayed on the imageTop container if they are clicked -->
		 function putOnTop(e){
			$("#imageTop").empty();
			$("#textTop").empty();
			$.post("../function/showTopImage.php", {data: e }, 
			function(topImage){
				var topPicture=topImage.split("#")[1].split("%")[0];
				var topText=topImage.split("#")[1].split("%")[1];
				$("#imageTop").append("<img class='imgtopContent' src='"+topPicture+"'/>");
				$("#imageTop").append("<input id='"+topPicture+"' onclick='fun(this);' class='edit_button' type='button' value='button' name='button'/>");
				$("#textTop").append("<p class='prod_desc'>"+topText+"</p>");
			});
		 }

		 <!--enter into galery-->
		 function galeryClick(e){
			viewer=new PhotoViewer();
		 	$("#imageTop").empty();
			$("#textTop").empty();
			$("#textTop").css('max-width','0px');
			$("#textTop").css('min-height','0px');
			$("#textTop").css('width','0px');
		    $("#contentBottom").empty();
			<!-- send the id of the galery that is clicked -->
			$.post("../function/galery.php", {data: e }, 
			<!-- get all the pictures of that galery -->
			function(galeryImages){
				var k=0;
				var differentPictures=galeryImages.split('#');
				for(i=1; i<=differentPictures.length-1; i++)
				{
					mainPicture=differentPictures[i].split('*')[1].split("%")[0];
					videoURL=differentPictures[i].split('*')[1].split("%")[1].split('$')[1];
					galeryURL=differentPictures[i].split('*')[0];
					idpic=differentPictures[i].split('*')[1].split("%")[1].split('$')[0];
					if(mainPicture=="true")
					{
						$("#imageTop").css('display', 'block');
						$("#imageTop").css('max-width','821px');
						$("#imageTop").css('width','821px');
						$("#imageTop").css('min-height','410px');
						$("#imageTop").append("<img style='max-height:410px'src='"+galeryURL+"'/>");
						$("#imageTop").append("<input id='"+galeryURL+"' onclick='fun(this);' class='edit_button' type='button' value='button' name='button'/>");
						if(videoURL!="/")
						{
							$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<a href='javascript: void(0);'><div class='contentBottom'><img class='imgBottom' onclick='ShowOnTop("+idpic+")' src='http://localhost/feydomproject/images/video.png'/><input id='"+idpic+"' onclick='fun(this);' class='edit_button' type='button' value='button' name='button'/></div></a>");
						}
					else
						{
						//viewer.add(differentPictures[i].split('*')[0]);
						$("#contentBottom").append("<a href='javascript:void())'><div class='contentBottom'><img class='imgBottom'  src='"+galeryURL+"'/><input id='"+galeryURL+"' onclick='fun(this);' class='edit_button' type='button' value='button' name='button'/></div></a>");	
						k++;
						}
					}
					if(mainPicture=="false")
					{  
						if(videoURL!="/")
						{
							$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<a href='javascript: void(0);'><div class='contentBottom'><img class='imgBottom' onclick='ShowOnTop("+idpic+")' src='http://localhost/feydomproject/images/video.png'/><input id='"+idpic+"' onclick='fun(this);' class='edit_button' type='button' value='button' name='button'/></div></a>");
						}
						else
						{
						viewer.add(differentPictures[i].split('*')[0]);
						$("#contentBottom").css('display', 'block');
						$("#contentBottom").append("<a href='javascript:void(viewer.show("+k+"))'><div class='contentBottom'><img class='imgBottom'  src='"+galeryURL+"'/><input id='"+galeryURL+"' onclick='fun(this);' class='edit_button' type='button' value='button' name='button'/></div></a>");	
							k++;
						}
					}
				}
			});
		 }
		 <!--change galery image-->
		 function ShowOnTop(e){
			$("#imageTop").empty();
			$.post("../function/galeryTopImage.php", {data: e }, 
			function(topVideo)
			{
				$("#imageTop").css('display', 'block');
				$("#imageTop").css('max-width','821px');
				$("#imageTop").css('width','821px');
				$("#imageTop").css('min-height','410px');
				$("#imageTop").append("<iframe width='821' height='410' src='"+topVideo+"'  frameborder='0' allowfullscreen></iframe>");
			});
		 }  
	</script>
	
	
</div>
