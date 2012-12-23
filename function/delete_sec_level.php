<?php

$con = mysql_connect("localhost","alienper_root","kokikoki");
if (!$con) {  die('Could not connect: ' . mysql_error()); }

$main_contet_Id=$_REQUEST["deleteButton"];
$pom=explode('@', $main_contet_Id);

$imageCheck=$pom[0];
$id=$pom[1];
$idmc=$pom[2];
$idpic=$pom[2];
if($imageCheck==="galeryImage")
{
	mysql_select_db("alienper_feydom", $con);
	$galeryPic = mysql_query("SELECT galeryURL FROM galery where idpic='".$idpic."' ");
	while($row = mysql_fetch_array($galeryPic))
	{
				 $galery_pic=$row['galeryURL'];
				 unlink("../".$galery_pic);
	}

	mysql_query("delete from galery where idpic='".$idpic."' ");
}
if($imageCheck==="galery")
{
	mysql_select_db("alienper_feydom", $con);
	$galeryURL = mysql_query("SELECT galeryURL FROM galery where idmc='".$idmc."' ");
	while($row = mysql_fetch_array($galeryURL))
	{
				 $galery_url=$row['galeryURL'];
				 unlink("../".$galery_url);
	}

	mysql_query("delete from galery where idmc='".$idmc."' ");
	mysql_query("delete from main_content where id='".$id."' ");
}
else
{
		mysql_select_db("alienper_feydom", $con);
		$maincontentURL = mysql_query("SELECT maincontentURL FROM main_content where id='".$id."' ");
		while($row1 = mysql_fetch_array($maincontentURL))
		{
					 $main_url=$row1['maincontentURL'];
					 unlink("../".$main_url);
		}
		mysql_query("delete from main_content where id='".$id."' ");

}
mysql_close($con);
header( 'Location: ../admin/Administrator.php' );

?>