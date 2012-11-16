<?php
   $itemvalue=($_POST["data"]);
		$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			 }        
			mysql_select_db("feydom", $con);
			$slikaTop="";
			$result = mysql_query("SELECT contentTopURL FROM left_sidebar where id='".$itemvalue."' ");
			while($row = mysql_fetch_array($result))
			  {
					 $slikaTop=$row['contentTopURL'];
			  }
		mysql_close($con);
	echo $slikaTop;
?>