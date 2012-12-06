<?php
	/*echo $_REQUEST["src"];*/
	$path=$_REQUEST["src"];
	$some=explode('/', $path);
	$fullpath="";
	
	for($i=0;$i<count($some)-1;$i++)
	{
		
		$fullpath.=$some[$i].'/';
	}
	$imagename = $some[count($some)-1];
	
	/*
		if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
*/
?>