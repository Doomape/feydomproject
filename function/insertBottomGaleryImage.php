<?php
		$itemvalue=($_POST["data"]);
		$some=explode('/',$itemvalue);
		$path=$some[2]."/".$some[3]."/".$some[4];
		echo $path;
		echo "<br/>";
		$idmc=$some[5];
		$con = mysql_connect("localhost","alienper_root","kokikoki");
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			$idM=0;
			mysql_select_db("alienper_feydom", $con);
			$id = mysql_query("SELECT max(idpic) FROM galery");
		    while($row = mysql_fetch_array($id))
		    {
				 $idM=$row['max(idpic)'];
			}
		    $idM++;
			mysql_query("INSERT INTO galery (idmc, idpic, galeryURL, mainPicture, videoURL,imageText) VALUES('".$idmc."', '".$idM."','".$path."','false','/','')");
			mysql_close($con);
		//	header( 'Location: ../admin/Administrator.php' );
?>