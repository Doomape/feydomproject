<?php
		$itemvalue=($_POST["data"]);
			$con = mysql_connect("localhost","alienper_root","kokikoki");
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			  $pom=explode('@', $itemvalue);
			  $pom1=explode('#',$itemvalue);
			 // echo $pom[0];
			  
			mysql_select_db("alienper_feydom", $con);
			if($pom[0]==="main_content")
			{
			mysql_query("UPDATE $pom[0] set imageText='".$pom1[1]."' where id='".$pom[1]."' and idmc='".$pom[2]."' ");
			}
			if($pom[0]==="galery")
			{
			mysql_query("UPDATE $pom[0] set imageText='".$pom1[1]."' where idmc='".$pom[1]."' and idpic='".$pom[2]."' ");
			}
			mysql_close($con);
			header( 'Location: ../admin/Administrator.php' );
			
?>