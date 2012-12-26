<?php

$dropdownId=$_POST["dropIDD"];
$dropDownStart=$_POST["firstLevel"];
$dropdownContact=$_POST["firstLevel_contact"];
$id=explode('@',$dropdownId);


$con = mysql_connect("localhost","alienper_root","kokikoki");
if (!$con) {  die('Could not connect: ' . mysql_error()); }
mysql_select_db("alienper_feydom", $con);

if($dropDownStart==="true")
{
	mysql_query("UPDATE left_sidebar set isStartPage='true'  where id='".$id[1]."' ");
	mysql_query("UPDATE left_sidebar set isStartPage='false'  where id<>'".$id[1]."' ");
}
if($dropdownContact==="true")
{
	mysql_query("UPDATE left_sidebar set isContact='true'  where id='".$id[1]."' ");
	mysql_query("UPDATE left_sidebar set isContact='false'  where id<>'".$id[1]."' ");
}

if($dropDownStart==="false")
{
	mysql_query("UPDATE left_sidebar set isStartPage='false'  where id='".$id[1]."' ");
}
if($dropdownContact==="false")
{
	mysql_query("UPDATE left_sidebar set isContact='false'  where id='".$id[1]."' ");
}
mysql_close($con);
header( 'Location: ../admin/Administrator.php' );
?>