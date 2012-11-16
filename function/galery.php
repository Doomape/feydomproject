<?php
   $itemvalue=($_POST["data"]);
		$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			 }        
			mysql_select_db("feydom", $con);
			$galeryImages="";
			$result = mysql_query("SELECT * FROM galery where galery.idmc='".$itemvalue."' ");
			while($row = mysql_fetch_array($result))
			  {
					 $slikaB=$row['galeryURL'];
					 $checkMP=$row['mainPicture'];
					 $idpic=$row['idpic'];
					 $galeryImages=$galeryImages."#". $slikaB."*". $checkMP."%".$idpic;
			  }
		mysql_close($con);
	echo $galeryImages;
?>