<?php
   $itemvalue=($_POST["data"]);
		$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			 }        
			mysql_select_db("feydom", $con);
			$TopImage="";
			$result = mysql_query("SELECT * FROM main_content where idmc='".$itemvalue."' ");
			while($row = mysql_fetch_array($result))
			  {
					 $slikaT=$row['maincontentURL'];
					 $textT=$row['imageText'];
					 $TopImage=$TopImage."#".$slikaT."%".$textT;
			  }
		mysql_close($con);
	echo $TopImage;
?>