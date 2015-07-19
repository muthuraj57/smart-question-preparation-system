<?php
include "check.php";
require_once('dbconnect.php');

     db_connect();
session_start();
     $usrname=$_SESSION['usrname'];

$qry=mysql_query("select count(*) from staffForSub where usrname='$usrname'");
$fetch=mysql_fetch_array($qry);
if(!$fetch[0])
    header('location:subHandling.php');
?>
<html>
<body>
    <a href="logout.php" style="position:fixed;top:0;right:20">Logout</a>
    <center><b style='font-size:30px;'>Welcome <?=$usrname?></b></center>
    <div style="font-family:Helvetica; position:absolute; left:250px; top:200px;">
<a href="setQn.php">Set new question</a></div>
<div style="font-family:Helvetica; position:absolute; right:250px; top:200px;">
<a href="addQn.php">Add Question to Database</a></div>
    <div style="font-family:Helvetica; position:absolute; right:550px;left:550px; top:300px;">
<a href="subHandling.php">Update Handling Subjects</a></div>
    </body>
</html>