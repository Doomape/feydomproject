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
		$pom="../";
		if($idstart<=3)
		echo "<a href=javascript: void(0);><div onclick='headerClick(".$idstart.")' class='logo' style='background:url(" .$pom.$slikalogo. ") no-repeat' >
		<form class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'>
		<input type='file' name='file' id='uploadPicture_0'><br>
		<input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'>
		<input name='src' value='".$slikalogo."' type='hidden' />
		<input name='new_name' id='new_name_0' type='hidden' />
		<input value='0' name='id_picture' id='id_picture' type='hidden' />
		</form>
		</div>
		</a>"; 
		else
		echo "<a href=javascript: void(0);><div onclick='sideClick(".$idstart.")' class='logo' style='background:url(" .$pom.$slikalogo. ") no-repeat' >
		<form class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'>
		<input type='file' name='file' id='uploadPicture_0'><br>
		<input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'>
		<input name='src' value='".$slikalogo."' type='hidden' />
		<input name='new_name' id='new_name_0' type='hidden' />
		<input value='0' name='id_picture' id='id_picture'  type='hidden' />
		</form>
		</div>
		</a>"; 
		
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
						echo "<a href='javascript: void(0);'><div id='start' onclick='headerClick(".$id.")' class='imgup' style='background:url(" .$pom.$slikaSideBar. ") no-repeat' >
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
						echo "<a href='javascript: void(0)';><div id="."img_".$id." onclick='headerClick(".$id.")' class='imgup' style='background:url(" .$pom.$slikaSideBar. ") no-repeat' >
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
					echo "<a href='javascript: void(0)';><div id='contact' onclick='headerClick(".$id.")' class='imgup' style='background:url(" .$pom.$slikaSideBar. ") no-repeat' >
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
		mysql_close($con);
	?>

	<script type="text/javascript">
		
		var pom="../";
		var whichpage=1;
		var whichgalery=1;
		
		$('input[type="file"]').change(function() 
		{
			//console.log( $(this).val() );
			var form = $(this).parent('form');
			form.find('input[name="new_name"]').val( $(this).val().split('\\')[$(this).val().split('\\').length-1] );
		});
			

		var imgTxtNext=1;
		var viewer = null;
	//	var doesExist=0;
		var imageArray=new Array();			
		var textArray=new Array();
		
		function save_text()
		{
		var e=$('textarea').attr("id")+"#"+$('textarea').val();
		$.post("../function/saveText.php", {data: e }, 
		function()	
		{	
			alert("The text is changed");
		});
		}
		function headerClick(e)
		{
			  
			$.post("../function/checkRowExist.php", {data: e },
			function(rowExist)
			{		
				if(rowExist==0)
				{
				  $("#contentBottom").empty();
				  $("#imageTop").empty();
				  $("#textTop").empty();
				  $("#contentBottom").append("<div class='contentBottom' style='position:relative'><a href='javascript: void(0);'><div id='main_content@"+e+"@1' class='contentBottom'><img class='imgBottom' src='../images/adminAdd.png' /></div></a><form style='position:absolute;top:0px;left:0px' class='probaclick' action='../function/upload_firstNewFile.php' method='post' enctype='multipart/form-data'><input type='file' name='file' id='contentUploadFirstPicture_"+10+"' ><br><input name='new_name' id='contentFirstNew_name_"+10+"' type='hidden' /><input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'><input name='src' value='images/galeryThumb/' type='hidden' /><input value='"+e+"' name='id_picture' id='content"+e+10+" ' type='hidden' /></form></div>");
//
//			
//<img class='imgBottom' src='"+pom+maincontentURL+"'/></div></a>
					$('input[type="file"]').change(function() 
					{
					//console.log( $(this).val() );
					var form = $(this).parent('form');
					form.find('input[name="new_name"]').val( $(this).val().split('\\')[$(this).val().split('\\').length-1] );
					});
				}
				if(rowExist==1)
				{
					<!--setting the global variable to clicked number to know which page are we on  -->
					whichpage=e;
					
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
					$.post("../function/contentTopImage.php", {data: e }, 
					<!--get the top image and the top text -->
					
					
					function(image_and_text)
					{ 
						var pictire_and_text=image_and_text.split('#');
						for(i=1; i<=pictire_and_text.length-1; i++)
						{
						var maincontentURL=pictire_and_text[i].split('*')[0];
						var imageText=pictire_and_text[i].split('*')[1].split('%')[0];
						var idmc=pictire_and_text[i].split('*')[1].split('%')[1];
						$("#imageTop").append("<img  class='imgtopContent' src='"+pom+maincontentURL+"'/>");
						$("#textTop").append("<div style='position:relative; width:99%; height:99%;'><textarea id='main_content@"+e+"@"+idmc+"' style='width:263px;height:410px'>"+imageText+"</textarea><button onclick='save_text();' type='button' style='position:absolute; bottom:0; left:0;'>Save</button></div>");	
						 //$("#textTop").getNiceScroll().resize();
						}
					});
					<!--content bottom images-->
					<!--send the id of the top sidebar pictire -->
					$.post("../function/contentBottomImage.php", {data: e }, 
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
								$("#contentBottom").append("<div class='contentBottom' style='position:relative'><a href='javascript: void(0);'><div onclick='headerPutOnTop("+idmc+")' id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+pom+maincontentURL+"'/></div></a><form style='position:absolute;top:0px;left:0px' class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'> <input type='file' name='file' id='contentUploadPicture_"+idmc+10+"' ><br><input name='new_name' id='contentNew_name_"+idmc+10+"' type='hidden' /><input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'><input name='src' value='"+maincontentURL+"' type='hidden' /><input value='"+idmc+"' name='id_picture' id='content"+idmc+10+" ' type='hidden' /></form></div>");
							}
							<!--normal picture; picture that is displayed in that page and have no functions-->
							if(imageCheck=="normal")
							{
								$("#contentBottom").append("<div class='contentBottom' style='position:relative'><div id='thumbPicture' class='contentBottom'><img class='imgBottom' src='"+pom+maincontentURL+"'/></div><form style='position:absolute;top:0px;left:0px' class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'> <input type='file' name='file' id='contentUploadPicture_"+idmc+10+"' ><br><input name='new_name' id='contentNew_name_"+idmc+10+"' type='hidden' /><input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'><input name='src' value='"+maincontentURL+"' type='hidden' /><input value='"+idmc+"' name='id_picture' id='content"+idmc+10+" ' type='hidden' /></form></div>");
							}
							<!--galery thumb picture;  top picture = if imageCheck=galery in the database, that image can contain another pictures -->
							if(imageCheck=="galery")
							{
								$("#contentBottom").append("<div class='contentBottom' style='position:relative'><a href='javascript: void(0);'><div onclick='headerGaleryClick("+idmc+")'  id='thumbPicture' ><img class='imgBottom' src='"+pom+maincontentURL+"'/></div></a><form style='position:absolute;top:0px;left:0px' class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'> <input type='file' name='file' id='contentUploadPicture_"+idmc+10+"' ><br><input name='new_name' id='contentNew_name_"+idmc+10+"' type='hidden' /><input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'><input name='src' value='"+maincontentURL+"' type='hidden' /><input value='"+idmc+"' name='id_picture' id='content"+idmc+10+" ' type='hidden' /></form></div>");				
							}			
						}		
						$('input[type="file"]').change(function() 
						{
					
							//console.log( $(this).val() );
							var form = $(this).parent('form');
							form.find('input[name="new_name"]').val( $(this).val().split('\\')[$(this).val().split('\\').length-1] );
								//alert(	$('textarea').val());
						});				
					});
				}
			});
		 }
		 <!-- pictures that are displayed on the imageTop container if they are clicked -->
		 function headerPutOnTop(e){
			$("#imageTop").empty();
			$("#textTop").empty();
			$.post("../function/showTopImage.php", {data: e }, 
			function(topImage)
			{
				var topPicture=topImage.split("#")[1].split("%")[0];
				var topText=topImage.split("#")[1].split("%")[1];
				$("#imageTop").append("<img class='imgtopContent' src='"+pom+topPicture+"'/>");
				$("#textTop").append("<div style='position:relative; width:99%; height:99%;'><textarea id='main_content@"+whichpage+"@"+e+"' style='width:263px;height:410px'>"+topText+"</textarea><button onclick='save_text();' type='button' style='position:absolute; bottom:0; left:0;'>Save</button></div>");	

                                //$("#textTop").getNiceScroll().resize();

			});
		 }

		 <!--enter into galery-->
		 function headerGaleryClick(e){
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
			$.post("../function/galery.php", {data: e }, 
			<!-- get all the pictures of that galery -->
			function(galeryImages)
			{
				whichgalery=e;
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
						$("#imageTop").append("<img style='max-height:410px'src='"+pom+galeryURL+"'/>");
						$("#textTop").append("<div style='position:relative; width:99%; height:99%;'><textarea id='galery@"+e+"@"+idpic+"' style='width:263px;height:410px'>"+imageText+"</textarea><button onclick='save_text();' type='button' style='position:absolute; bottom:0; left:0;'>Save</button></div>");	

						//$("#textTop").getNiceScroll().resize();
						if(videoURL!="/")
						{
							$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<a href='javascript: void(0);'><div class='contentBottom'><img class='imgBottom' onclick='headerShowOnTop("+idpic+")' src='../images/video.png'/></div></a>");
							$("#contentBottom").append("<div class='contentBottom' style='position:relative'><a href='javascript:void(viewer.show("+k+"))'><div onclick='headerShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom'  src='"+pom+galeryURL+"'/></div></a><form style='position:absolute;top:0px;left:0px' class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'> <input type='file' name='file' id='contentUploadPicture_"+idpic+10+"' ><br><input name='new_name' id='contentNew_name_"+idpic+10+"' type='hidden' /><input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'><input name='src' value='"+galeryURL+"' type='hidden' /><input value='"+idpic+"' name='id_picture' id='content"+idpic+10+" ' type='hidden' /></form></div>");	
							//viewer.add(differentPictures[i].split('*')[0]);
							k++;
						}
						else
						{
							$("#contentBottom").append("<div class='contentBottom' style='position:relative'><a href='javascript:void(viewer.show("+k+"))'><div onclick='headerShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom'  src='"+pom+galeryURL+"'/></div></a><form style='position:absolute;top:0px;left:0px' class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'> <input type='file' name='file' id='contentUploadPicture_"+idpic+10+"' ><br><input name='new_name' id='contentNew_name_"+idpic+10+"' type='hidden' /><input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'><input name='src' value='"+galeryURL+"' type='hidden' /><input value='"+idpic+"' name='id_picture' id='content"+idpic+10+" ' type='hidden' /></form></div>");	
						//viewer.add(differentPictures[i].split('*')[0]);
						k++;
						}
					}
					if(mainPicture=="false")
					{  
						if(videoURL!="/")
						{
							$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<a href='javascript: void(0);'><div onclick='headerShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom' onclick='headerShowOnTop("+idpic+")' src='../images/video.png'/></div></a>");
							$("#contentBottom").append("<div class='contentBottom' style='position:relative'><a href='javascript:void(viewer.show("+k+"))'><div onclick='headerShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom'  src='"+pom+galeryURL+"'/></div></a><form style='position:absolute;top:0px;left:0px' class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'> <input type='file' name='file' id='contentUploadPicture_"+idpic+10+"' ><br><input name='new_name' id='contentNew_name_"+idpic+10+"' type='hidden' /><input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'><input name='src' value='"+galeryURL+"' type='hidden' /><input value='"+idpic+"' name='id_picture' id='content"+idpic+10+" ' type='hidden' /></form></div>");	
							//viewer.add(differentPictures[i].split('*')[0]);
							k++;
						}
						else
						{
						$("#contentBottom").css('display', 'block');
							$("#contentBottom").append("<div class='contentBottom' style='position:relative'><a href='javascript:void(viewer.show("+k+"))'><div onclick='headerShowImgTxtOnTop("+idpic+")' class='contentBottom'><img class='imgBottom'  src='"+pom+galeryURL+"'/></div></a><form style='position:absolute;top:0px;left:0px' class='probaclick' action='../function/upload_file.php' method='post' enctype='multipart/form-data'> <input type='file' name='file' id='contentUploadPicture_"+idpic+10+"' ><br><input name='new_name' id='contentNew_name_"+idpic+10+"' type='hidden' /><input class='edit_button' style='top: 25px;' type='submit' name='submit' value='Submit'><input name='src' value='"+galeryURL+"' type='hidden' /><input value='"+idpic+"' name='id_picture' id='content"+idpic+10+" ' type='hidden' /></form></div>");	
						//viewer.add(differentPictures[i].split('*')[0]);
						k++;
						}
					}
				}
				$('input[type="file"]').change(function() 
				{
					//console.log( $(this).val() );
					var form = $(this).parent('form');
					form.find('input[name="new_name"]').val( $(this).val().split('\\')[$(this).val().split('\\').length-1] );
				});		
			});
			
		 }
		 function showNext()
		 {
		 
			 /*if(imgTxtNext<imageArray.length-1)
			 {
				imgTxtNext++;
				// console.log(imageArray);
				 $("#imageTop").empty();
				 $("#textTop").empty();
				 $("#imageTop").append("<img style='max-height:410px'src='"+pom+imageArray[imgTxtNext]+"'/>");
				 $("#textTop").append("<p class='prod_desc'>"+textArray[imgTxtNext]+"</p>");
				  //$("#textTop").getNiceScroll().resize();
			  }*/
		 }
		 function showPrevious()
		 {
		  
			/*if(imgTxtNext>1)
			{
			imgTxtNext--;
			 $("#imageTop").empty();
			 $("#textTop").empty();
			 $("#imageTop").append("<img style='max-height:410px'src='"+pom+imageArray[imgTxtNext]+"'/>");
			 $("#textTop").append("<p class='prod_desc'>"+textArray[imgTxtNext]+"</p>");
			  //$("#textTop").getNiceScroll().resize();
			 }*/
			
		 }
		 <!--change galery image-->
		  function headerShowOnTop(e){
			$("#imageTop").empty();
			$("#textTop").empty();
			$.post("../function/galeryTopImage.php", {data: e }, 
			function(topVideo)
			{
				$("#imageTop").css('display', 'block');
				$("#imageTop").css('max-width','821px');
				$("#imageTop").css('width','821px');
				$("#imageTop").css('min-height','410px');
				$("#textTop").css('max-width','0px');
				$("#textTop").css('min-height','0px');
				$("#textTop").css('width','0px');
				$("#imageTop").append("<iframe width='821' height='410' src='"+pom+topVideo+"'  frameborder='0' allowfullscreen></iframe>");
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
			
			$.post("../function/showImageTextInGalery.php", {data: e }, 
			function(topImage)
			{
				var topPicture=topImage.split("#")[1].split("%")[0];
				var topText=topImage.split("#")[1].split("%")[1];
				$("#imageTop").append("<img class='imgtopContent' src='"+pom+topPicture+"'/>");
			    $("#textTop").append("<div style='position:relative; width:99%; height:99%;'><textarea id='galery@"+whichgalery+"@"+e+"' style='width:263px;height:410px'>"+topText+"</textarea><button onclick='save_text();' type='button' style='position:absolute; bottom:0; left:0;'>Save</button></div>");	

				 //$("#textTop").getNiceScroll().resize();
			});
		 }
		 
	</script>


</div>
<div style="clear:both"></div>