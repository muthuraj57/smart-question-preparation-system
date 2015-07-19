<?php
  require_once('dbconnect.php');

     db_connect();
  $fname=$_POST['fname'];
$lname=$_POST['lname'];
$dept=$_POST['dept'];
$desig=$_POST['desig'];
$usrname=$_POST['usrname'];
$pswrd=$_POST['pswrd'];
$qry=mysql_query("select count(*) from user where usrname='$usrname'");
$fetch=mysql_fetch_array($qry);
  if($_POST['submit']!="")
  {	
 	 if(empty($_POST['fname']))
{
  	 $ckfname="Plz enter first name";
}
	elseif(empty($_POST['lname']))
{
  	 $cklname="Plz enter last name";
}
      elseif(empty($_POST['dept']))
          $ckdept="Enter your Department";
  	elseif(empty($_POST['desig']))
{
   	$ckemail="Enter your Designation";
}
  	elseif(empty($_POST['usrname']))
{
  	 $ckusrname="Enter your username";
}
	elseif (!preg_match("/^[a-zA-Z0-9]*$/",$_POST['usrname'])) {
  $ckusrname = "Only letters and numbers allowed"; 
}
        elseif($fetch[0])
	 $ckusrname="Username already exists";
  	elseif(empty($_POST['pswrd']))
{
  	 $ckpswrd="Enter your password";
}
  	elseif(empty($_POST['repswrd']))
{
   	$ckrepswrd="Retype your password";
}
	elseif($_POST['pswrd']!=$_POST['repswrd'])
		$ckrepswrd="Password not match";
  else
{
$qry=mysql_query("insert into user values('$fname','$lname','$dept','$desig','$usrname', password('$pswrd'))");
if($qry)
  echo "<script>alert('Successfully Registered :-)')</script>";
else 
 echo "Error"; 
}
}
?>
<html>
 <title>Registration Form</title>
<body background='images/kj.jpg'>
 <form action="reg.php" method="POST">
 <center><b style="font-size:30px">Registration Form</b></center><br><br><br>
 <center><table bgcolor=grey border=1>
  <tr>
      <th>First Name</th><td><input type="text" size="12" name='fname' value="<?=$_POST['fname']?>"><font color=brown><?=$ckfname?></font></td>
  </tr>
  <tr>
      <th>Last Name</th><td><input type="text" size="12" name='lname' value="<?=$_POST['lname']?>"><font color=brown><?=$cklname?></font></td>
  </tr>
     <th>Department</th><td><input type="text" name="dept" value="<?=$_POST['dept']?>"><font color=brown><?=$ckdept?></font>
   </td>
  </tr>
  <tr>
      <th>Designation</th><td><input type="text" name='desig' value="<?=$_POST['desig']?>"><font color=brown><?=$ckdesig?></font></td>
  </tr>
  <tr>
      <th>Username</th><td><input type="text" size='12' name='usrname' value="<?=$_POST['usrname']?>" maxlength="15"><font color=brown><?=$ckusrname?></font></td>
  </tr>
  <tr>
      <th>Password</th><td><input type="password" size='12' name='pswrd' value="<?=$_POST['pswrd']?>"><font color=brown><?=$ckpswrd?></font></td>
  </tr>
  <tr>
      <th>Re-type Password</th><td><input type="password" size='12' name='repswrd' value="<?=$_POST['repswrd']?>"><font color=brown><?=$ckrepswrd?></font></td>
  </tr>
</table>
<input type="submit" name='submit' value='Submit'><input type="reset" name="reset" value="Reset"><br>
 <center><h3>Note: Don't include space or special characters in username</h3></center>
<h3> Already Registered? <a href="index.php">Login</a>.</h3>
