<?php
		 $itemvalue=($_POST["data"]);
			$con = mysql_connect("localhost","alienper_root","kokikoki");
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
	        $idP=0;
			mysql_select_db("alienper_feydom", $con);
			$id = mysql_query("SELECT max(id) FROM left_sidebar");
		    while($row = mysql_fetch_array($id))
		    {
				 $idP=$row['max(id)'];
			}
		    $idP= $idP+1;
			mysql_query("INSERT INTO left_sidebar (id, sidebarURL) VALUES('".$idP."', '". $itemvalue."')");
			mysql_close($con);
?>