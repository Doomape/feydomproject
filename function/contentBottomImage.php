<?php
   $itemvalue=($_POST["data"]);
		$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			 }        
			mysql_select_db("feydom", $con);
			$slikaBottom="";
			$result = mysql_query("SELECT * FROM main_content where main_content.id='".$itemvalue."' ");
			while($row = mysql_fetch_array($result))
			  {
					 $slikaB=$row['maincontentURL'];
					 $checkG=$row['imageCheck'];
					 $idMC=$row['idmc'];
					 $imageText=$row['imageText'];
					 $isOnTop=$row['isOnTop'];
					 $slikaBottom=$slikaBottom."#". $slikaB."*". $checkG."%".$idMC."&".$imageText."@".$isOnTop;
			  }
		mysql_close($con);
	echo $slikaBottom;
?>