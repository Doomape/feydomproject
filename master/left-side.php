<div id="sidebar">

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
				 if($id>=4)
				 {
				 echo "<a href=javascript: void(0);><img onclick='sideClick(".$id.")' class='imgside' style='background:url(" .$slikaSideBar. ") no-repeat' /></a>"; 
				 }
		  }
		mysql_close($con);
	?>

	<script type="text/javascript">
		function sideClick(e)
		{
			$("#contentTop").css('display', 'block');
		    $("#contentBottom").css('display', 'block');
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
			$("#imageTop").empty();
			$("#textTop").empty();
			
			
			
			
		
			 
			<!--content bottom images-->
			$.post("function/contentBottomImage.php", {data: e }, 
			function(imageBottom)
			{ 
			//	alert(imageBottom);
				var differentPictures=imageBottom.split('#');
			//	alert(differentPictures);
				for(i=1; i<=differentPictures.length-1; i++)
				{
				alert(differentPictures[i].split('*')[1].split("%")[0]);
					<!--normal picture-->
					if(differentPictures[i].split('*')[1].split("%")[0]=="normal")
					{
						$("#contentBottom").append("<img style='width:205px;' src='"+differentPictures[i].split('*')[0]+"'/>");
					}
					<!--galery thumb picture-->
					if(differentPictures[i].split('*')[1].split("%")[0]=="galery")
					{
						$("#contentBottom").append("<a href=javascript: void(0);><img style='margin-left:10px' onclick='galeryClick("+differentPictures[i].split('*')[1].split("%")[1]+")' src='"+differentPictures[i].split('*')[0]+"'/></a>");
					}
				}
			});
			$("#contentBottom").empty();
		 }
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 <!--enter into galery-->
		 function galeryClick(e)
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
						$("#contentBottom").append("<a href=javascript: void(0);><img onclick='showOnTop("+differentPictures[i].split('*')[1].split("%")[1]+")' src='"+differentPictures[i].split('*')[0]+"'/></a>");	
					}
					if(differentPictures[i].split('*')[1].split("%")[0]=="false")
					{  
						$("#contentBottom").css('display', 'block');
						$("#contentBottom").append("<a href=javascript: void(0);><img onclick='showOnTop("+differentPictures[i].split('*')[1].split("%")[1]+")' src='"+differentPictures[i].split('*')[0]+"'/></a>");
					}
				}
			});
		 }
		 <!--change galery image-->
		  function showOnTop(e)
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


