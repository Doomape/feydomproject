<?php
	
	$id=($_POST["data"]);
	$pom="";
	$con = mysql_connect("localhost","alienper_root","kokikoki");
	if (!$con) {  die('Could not connect: ' . mysql_error()); }
	mysql_select_db("alienper_feydom", $con);
	$result=mysql_query("SELECT EXISTS (SELECT * FROM main_content WHERE id ='".$id."') as pom");//return true(1) of false(0)
	while($row = mysql_fetch_array($result))
	{
		$pom=$row['pom'];
	}
	mysql_close($con);
	echo $pom;
			
?>

