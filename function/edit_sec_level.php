<?php

$dropdownId=$_REQUEST["dropID"];
$pom=explode('@', $dropdownId);
$dropDownvalue=$_REQUEST["dropVAL"];
$dropDownOnTop=$_REQUEST["dropVAL1"];
$id=$pom[1];
$idmc=$pom[2];


$con = mysql_connect("localhost","alienper_root","kokikoki");
if (!$con) {  die('Could not connect: ' . mysql_error()); }
mysql_select_db("alienper_feydom", $con);

if($dropDownOnTop==="onbottom")
{
	mysql_query("UPDATE main_content set IsOnTop='false' where id='".$id."' and idmc='".$idmc."' ");
}
if($dropDownOnTop==="ontop")
{
	mysql_query("UPDATE main_content set IsOnTop='true' where id='".$id."' and idmc='".$idmc."' ");
	mysql_query("UPDATE main_content set IsOnTop='false' where id='".$id."' and idmc<>'".$idmc."' ");
}
mysql_query("UPDATE main_content set imageCheck='".$dropDownvalue."' where id='".$id."' and idmc='".$idmc."' ");
mysql_close($con);
header( 'Location: ../admin/Administrator.php' );

?>
