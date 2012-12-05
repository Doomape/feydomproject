<?php
   $itemvalue=($_POST["data"]);
		$con = mysql_connect("localhost","alienper_root","kokikoki");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			 }        
			mysql_select_db("alienper_feydom", $con);
			$galeryImages="";
			$result = mysql_query("SELECT * FROM galery where galery.idmc='".$itemvalue."' ");
			while($row = mysql_fetch_array($result))
			  {
					 $slikaB=$row['galeryURL'];
					 $checkMP=$row['mainPicture'];
					 $idpic=$row['idpic'];
					 $videoURL=$row['videoURL'];
					 $galeryImages=$galeryImages."#". $slikaB."*". $checkMP."%".$idpic."$".$videoURL;
			  }
		mysql_close($con);
	echo $galeryImages;
?>