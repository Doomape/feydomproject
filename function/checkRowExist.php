<?php
	$con = mysql_connect("localhost","alienper_root","kokikoki");
	if (!$con) {  die('Could not connect: ' . mysql_error()); }
	$id=($_POST["data"]);
	$boolRow="";
	$pom1=explode('@',$id);
	$id=$pom1[0];
	$idmc=$pom1[0];
	if($pom1[1]==="main_content")
	{
	mysql_select_db("alienper_feydom", $con);
	$result=mysql_query("SELECT EXISTS (SELECT * FROM main_content WHERE id ='".$id."') as pom");//return true(1) of false(0)
		while($row = mysql_fetch_array($result))
		{
			$boolRow=$row['pom'];
		}
		echo $boolRow;
	}
	if($pom1[1]==="galery")
	{
	mysql_select_db("alienper_feydom", $con);
	$result=mysql_query("SELECT EXISTS (SELECT * FROM galery WHERE idmc ='".$idmc."') as pom");//return true(1) of false(0)
		while($row = mysql_fetch_array($result))
		{
			$boolRow=$row['pom'];
		}
		echo $boolRow;
	}
	mysql_close($con);

			
?>

