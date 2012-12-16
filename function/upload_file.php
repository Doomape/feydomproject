<?php
	/*echo $_REQUEST["src"];*/
	//http://localhost/feydomproject/images/topbarImages/feydom_logo.png
	//echo $_REQUEST["src"];
	//	echo "<br/>";
	$path="../".$_REQUEST["src"];
	$new_name=$_REQUEST["new_name"];
	$id=$_REQUEST["id_picture"];
	$some=explode('/', $path);
	$fullpath="";
//	echo $path;
//	echo "<br/>";
//	echo $id;
//	echo "<br/>";
//	echo $new_name;
//		echo "<br/>";
	for($i=0;$i<count($some)-1;$i++)
	{
		$fullpath.=$some[$i].'/';
	}

//	echo $fullpath.$new_name;
//	echo "<br/>";
	if (file_exists($path)) 
	{
	
	//	echo "The file $path exists";
		unlink($path);
		move_uploaded_file($_FILES['file']['tmp_name'], $fullpath.$new_name);
		$con = mysql_connect("localhost","alienper_root","kokikoki");
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			  $itemvalue="images/".$some[2]."/".$new_name;
			mysql_select_db("alienper_feydom", $con);
			mysql_query("UPDATE left_sidebar set sidebarURL='".$itemvalue."' where id='".$id."' ");
		mysql_close($con);
		header( 'Location: ../admin/Administrator.php' );
	} 
	else 
	{
		//echo "The file $path does not exist";
		move_uploaded_file($_FILES['file']['tmp_name'], $fullpath.$new_name);
		$con = mysql_connect("localhost","alienper_root","kokikoki");
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			  $itemvalue="images/".$some[2]."/".$new_name;
			mysql_select_db("alienper_feydom", $con);
			mysql_query("UPDATE left_sidebar set sidebarURL='".$itemvalue."' where id='".$id."' ");
		mysql_close($con);
		header( 'Location: ../admin/Administrator.php' );
	}

	/*for($i=0;$i<count($some)-1;$i++)
	{
		
		$fullpath.=$some[$i].'/';
	}
	$imagename = $some[count($some)-1];
	
	if (file_exists($fullpath . $_FILES["file"][$imagename]))
    {
      echo $_FILES["file"][$imagename] . " already exists. ";
    }
	
			 $itemvalue=($_POST["data"]);
			$con = mysql_connect("localhost","alienper_root","kokikoki");
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			mysql_select_db("alienper_feydom", $con);
			$id = mysql_query("SELECT max(id) FROM left_sidebar");
		    while($row = mysql_fetch_array($id))
		    {
				 $idP=$row['max(id)'];
			}
			mysql_query("UPDATE left_sidebar set ContentTopURL='".$itemvalue."' where id='".$idP."' ");
			mysql_close($con);
	
	
	
	
			$con = mysql_connect("localhost","alienper_root","kokikoki");
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			  $itemvalue="../images/".$new_name;
			mysql_select_db("alienper_feydom", $con);
			mysql_query("UPDATE left_sidebar set sidebarURL='".$itemvalue."' where id='".$id."' ");
		mysql_close($con);
	
	*/

?>

