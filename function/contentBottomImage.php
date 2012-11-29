<?php
   $itemvalue=($_POST["data"]);
		$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			 }        
			mysql_select_db("feydom", $con);
			$slikaBottom="";
			$result = mysql_query("SELECT * FROM main_content where main_content.id='4' ");
			while($row = mysql_fetch_array($result))
			  {
					 $slikaB=$row['maincontentURL'];
					 $checkG=$row['imageCheck'];
					 $idMC=$row['idmc'];
					 $imageText=$row['imageText'];
					 $slikaBottom=$slikaBottom."#". $slikaB."*". $checkG."%".$idMC."&".$imageText;
			  }
		mysql_close($con);
	echo $slikaBottom;
?>