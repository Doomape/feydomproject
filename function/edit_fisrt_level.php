<?php

$dropdownId=$_POST["dropID0"];
$dropDownOnTop=$_POST["firstLevel"];

echo $dropdownId;
echo "<br/>";
echo $dropDownOnTop;

/*

$con = mysql_connect("localhost","alienper_root","kokikoki");
if (!$con) {  die('Could not connect: ' . mysql_error()); }
mysql_select_db("alienper_feydom", $con);

if($dropDownOnTop==="onbottom")
{
	mysql_query("UPDATE galery set mainPicture='false' where idmc='".$idmc."' and idpic='".$idpic."' ");
}
if($dropDownOnTop==="ontop")
{
	mysql_query("UPDATE galery set mainPicture='true' where idmc='".$idmc."' and idpic='".$idpic."' ");
	mysql_query("UPDATE galery set mainPicture='false' where idmc='".$idmc."' and idpic<>'".$idpic."' ");
}

mysql_close($con);
header( 'Location: ../admin/Administrator.php' );*/

?>