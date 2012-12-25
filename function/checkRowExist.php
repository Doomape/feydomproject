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
	$boolRow="";
	$boolRow1="";
	$videoid="";
	mysql_select_db("alienper_feydom", $con);
	$result=mysql_query("SELECT EXISTS (SELECT * FROM galery WHERE idmc ='".$idmc."' AND galeryURL not like 'images/video.png') as pom");//return true(1) of false(0)
		while($row = mysql_fetch_array($result))
		{
			$boolRow=$row['pom'];
		}
		$result1=mysql_query("SELECT EXISTS (SELECT * FROM galery WHERE idmc ='".$idmc."' AND galeryURL = 'images/video.png') AS pom1");//return true(1) of false(0)
		while($row1 = mysql_fetch_array($result1))
		{
			$boolRow1=$row1['pom1'];
		}
    $result2=mysql_query("SELECT idpic FROM galery WHERE idmc ='".$idmc."' AND galeryURL like 'images/video.png' ");
		while($row2 = mysql_fetch_array($result2))
		{
			$videoid=$row2['idpic'];
		}
	
		echo $boolRow."@".$boolRow1."@".$videoid;
	}
	mysql_close($con);

			
?>

