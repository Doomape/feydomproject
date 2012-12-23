<?php

	$con = mysql_connect("localhost","alienper_root","kokikoki");
	if (!$con){	die('Could not connect: ' . mysql_error());}
	
	$videoURL=$_POST["videoURL"];
	$id=$_POST["id_picture"];

	
		mysql_select_db("alienper_feydom", $con);
		$idmc="";
		$idmaincontent = mysql_query("SELECT idmc FROM galery where idpic='".$id."' and galeryURL='images/video.png' ");
		while($row = mysql_fetch_array($idmaincontent))
		{
		 $idmc=$row['idmc'];
		}
		$galeryURL="images/video.png";
		$imageText="/";
		$mainPicture="false";
			mysql_query("UPDATE galery set videoURL='".$videoURL."' where idpic='".$id."' and idmc='".$idmc."' ");
			//mysql_query("INSERT INTO galery (idmc, idpic, galeryURL, mainPicture, videoURL, imageText) VALUES('".$id."', '".$idpic."', '". $galeryURL."','".$mainPicture."','".$videoURL."','".$imageText."')");
			mysql_close($con);
			header( 'Location: ../admin/Administrator.php' );

	mysql_close($con);
?>

