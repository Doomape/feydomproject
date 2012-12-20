<?php
   $itemvalue=($_POST["data"]);
		$con = mysql_connect("localhost","alienper_root","kokikoki");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			 }        
			mysql_select_db("alienper_feydom", $con);
			$slikaTop="";
			$imageText="";
			$image_text="";
			$idmc="";
			$result = mysql_query("SELECT idmc, maincontentURL, imageCheck, imageText,isOnTop FROM main_content where id='".$itemvalue."' ");
			while($row = mysql_fetch_array($result))
			  {
					if($row['imageCheck']=="top" && $row['isOnTop']=="true" || $row['imageCheck']=="galery" && $row['isOnTop']=="true")
					{
					 $slikaTop=$row['maincontentURL'];
					 $imageText=$row['imageText'];
					 $idmc=$row['idmc'];
					 $image_text=$image_text."#". $slikaTop."*". $imageText."%".$idmc;
					 }
			  }
		mysql_close($con);
	echo $image_text;
?>