<?php
   $itemvalue=($_POST["data"]);
		$con = mysql_connect("localhost","root","");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			 }        
			mysql_select_db("feydom", $con);
			$slikaBottom="";
			$i=0;
			$result = mysql_query("SELECT * FROM main_content where main_content.id='".$itemvalue."' ");
			while($row = mysql_fetch_array($result))
			  {
					 $slikaB=$row['contentBottomURL'];
					 $checkG=$row['galeryCheck'];
					 $idMC=$row['idmc'];
					 $slikaBottom=$slikaBottom."#". $slikaB."*". $checkG."%".$idMC;
					 $i++;
			  }
		mysql_close($con);
	echo $slikaBottom;
?>