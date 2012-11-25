<?php
		 $itemvalue=($_POST["data"]);
			$con = mysql_connect("localhost","root","");
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			mysql_select_db("feydom", $con);
			$id = mysql_query("SELECT max(id) FROM left_sidebar");
		    while($row = mysql_fetch_array($id))
		    {
				 $idP=$row['max(id)'];
			}
			mysql_query("UPDATE left_sidebar set ContentTopURL='".$itemvalue."' where id='".$idP."' ");
			mysql_close($con);
?>