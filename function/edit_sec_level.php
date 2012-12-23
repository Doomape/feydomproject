<?php

$dropdownId=$_REQUEST["dropID"];
$pom=explode('@', $dropdownId);
$dropDownvalue=$_REQUEST["dropVAL"];
$id=$pom[1];
$idmc=$pom[2];
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$con = mysql_connect("localhost","alienper_root","kokikoki");
if (!$con) {  die('Could not connect: ' . mysql_error()); }
mysql_select_db("alienper_feydom", $con);
mysql_query("UPDATE main_content set imageCheck='".$dropDownvalue."' where id='".$id."' and idmc='".$idmc."' ");
mysql_close($con);
header( 'Location: ../admin/Administrator.php' );
?>
