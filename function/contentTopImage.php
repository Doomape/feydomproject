<?php
   $itemvalue=($_POST["data"]);
		$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			 }        
			mysql_select_db("feydom", $con);
			$slikaTop="";
			$imageText="";
			$image_text="";
			$result = mysql_query("SELECT maincontentURL, imageCheck, imageText,isOnTop FROM main_content where id='".$itemvalue."' ");
			while($row = mysql_fetch_array($result))
			  {
					if($row['imageCheck']=="top" && $row['isOnTop']=="true")
					{
					 $slikaTop=$row['maincontentURL'];
					 $imageText=$row['imageText'];
					 $image_text=$image_text."#". $slikaTop."*". $imageText;
					 }
			  }
		mysql_close($con);
	echo $image_text;
?>