<?php

$con = mysql_connect("localhost","alienper_root","kokikoki");
if (!$con) {  die('Could not connect: ' . mysql_error()); }
$i=0;
$id=$_REQUEST["first_deleteButton"];
/*echo $id;
	echo "<br/>";*/
$nizaIDMC=array();
mysql_select_db("alienper_feydom", $con);
	$main = mysql_query("SELECT idmc FROM main_content where id='".$id."' ");
	while($row = mysql_fetch_array($main))
	{
				 $idmc=$row['idmc'];
				// unlink("../".$galery_pic);
				$nizaIDMC[$i]=$idmc;
				$i++;
	}
	for($j=0;$j<$i;$j++)
	{

		// $nizaIDMC[$j];
		mysql_select_db("alienper_feydom", $con);
		$galeryPic = mysql_query("SELECT galeryURL FROM galery where idmc='".$nizaIDMC[$j]."' ");
		while($row = mysql_fetch_array($galeryPic))
		{
					 $galery_pic=$row['galeryURL'];
					 unlink("../".$galery_pic);
		}
		mysql_query("delete from galery where idmc='".$nizaIDMC[$j]."' ");

	}
	
	$main_content = mysql_query("SELECT maincontentURL FROM main_content where id='".$id."' ");
	while($row = mysql_fetch_array($main_content))
	{
				 $maincontentURL=$row['maincontentURL'];
				 unlink("../".$maincontentURL);		
	}
	mysql_query("delete from main_content where id='".$id."' ");
	
	$left_sidebar = mysql_query("SELECT sidebarURL FROM left_sidebar where id='".$id."' ");
	while($row = mysql_fetch_array($left_sidebar))
	{
				 $sidebarURL=$row['sidebarURL'];
				 unlink("../".$sidebarURL);		
	}
	mysql_query("delete from left_sidebar where id='".$id."' ");
	
mysql_close($con);
header( 'Location: ../admin/Administrator.php' );

?>