<?php   $itemvalue=($_POST["data"]);		$con = mysql_connect("localhost","root","");			if (!$con)			{				die('Could not connect: ' . mysql_error());			 }        			mysql_select_db("feydom", $con);			$galeryTopImage="";			$result = mysql_query("SELECT galeryURL FROM galery where galery.idpic='".$itemvalue."' ");			while($row = mysql_fetch_array($result))			  {					 $slikaT=$row['galeryURL'];					 $galeryTopImage=$slikaT;			  }		mysql_close($con);	echo $galeryTopImage;?>