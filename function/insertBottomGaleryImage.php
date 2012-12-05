<?php
		$itemvalue=($_POST["data"]);
			$con = mysql_connect("localhost","alienper_root","kokikoki");
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
	        $idP=0;
			$idM=0;
			mysql_select_db("alienper_feydom", $con);
			$id = mysql_query("SELECT max(id) FROM left_sidebar");
		    while($row = mysql_fetch_array($id))
		    {
				 $idP=$row['max(id)'];
			}
			$idmc = mysql_query("SELECT max(idmc) FROM main_content");
		    while($row = mysql_fetch_array($idmc))
		    {
				 $idM=$row['max(idmc)'];
			}
		    $idM++;
		//	echo $idP;
		//	echo "--------";
			//echo $idM;
			mysql_query("INSERT INTO main_content (id, idmc, contentBottomURL, galeryCheck) VALUES('".$idP."', '".$idM."','".$itemvalue."','true')");
			mysql_close($con);
?>