<?php
  if($_POST['submit']!="")
  {
  if(empty($_POST['usr']))
{
   $ckname="Plz enter username";
}
  elseif(empty($_POST['pswrd']))
{
   $ckpswrd="Enter your password";
}
  else
{
 require_once('dbconnect.php');

     db_connect();
 $usrname=$_POST['usr'];
 $pswrd=$_POST['pswrd'];
 $pd=mysql_query("select password('$pswrd')");
 $pq=mysql_fetch_array($pd);
 $qry=mysql_query("select pswrd from user where usrname='$usrname'");
 $fetch=mysql_fetch_array($qry);
 if(strcmp($pq[0],$fetch[0])=='0')
{
 session_start();
 $_SESSION['usrname']=$usrname;
 header('location:hom.php');  
//echo "<meta http-equiv='refresh' content='0;URL=home.php'>";
}
 else
  echo "<font color=red>Login error:Check your details.</font>";
}
}
?>
<html>
<!-- <title>Smart Question Preparation System</title>-->
<body background='images/bg.jpg'> 
 <form action="index.php" method="POST">
 <a href="reg.php"><img src='images/reg.jpeg' align=right width='100'></a>
 <!--<b align=left>New user Register <a href="reg.php">here</a></b>-->
 <center><b style="font-size:30px;color:red">Smart Question Preparation System</b></center><br><br><br><br>
 <center><table>
 <tr><th style="color:green">Username</th><td><input type="text" name="usr" value="<?=$_POST['usr']?>" autofocus="autofocus"><font color=red><?=$ckname?></font></td></tr>
 <tr><th style="color:green">Password</th><td><input type="password" name="pswrd" value="<?=$_POST['pswrd']?>"><font color=red><?=$ckpswrd?></font></td></tr>
 </table>
 <input type="submit" name="submit" value="Login">
 <input type="reset" name="reset" value="Clear">

</body>
</html>
