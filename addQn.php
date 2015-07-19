<?php
  require_once('dbconnect.php');

     db_connect();
session_start();
     $usrname=$_SESSION['usrname'];

$qry=mysql_query("select code from staffForSub where usrname='$usrname'");
$CodeDropDown="<select name='code'>";
     while ($line = mysql_fetch_array($qry))
     {
           $CodeDropDown = $CodeDropDown . "<option value=" . $line[0] .">".$line[0]. "</option>";
     }
     $CodeDropDown=$CodeDropDown . "</select>";

  $code=$_POST['code'];
$unit=$_POST['unit'];
$mark=$_POST['mark'];
$section=$_POST['section'];
$type=$_POST['type'];
$qn=$_POST['qn'];
$qry=mysql_query("select count(*) from sub where code='$code'");
$fetch=mysql_fetch_array($qry);
  if($_POST['submit']!="")
  {
	if(empty($_POST['unit']))
{
  	 $ckunit="Plz enter Unit number";
}
      elseif(empty($_POST['mark']))
          $ckmark="Enter marks";
  	elseif(empty($_POST['qn']))
{
   	$ckqn="Enter Question";
}
  else
{
$qry=mysql_query("insert into $code values(default, '$unit','$section','$mark','$type','$qn')");
if($qry){
    $_POST=array();
  echo "<script>alert('Question added :-)')</script>";
}
else 
 echo "Error"; 
}
}
?>
<html>
 <title>Registration Form</title>
<body background='images/kj.jpg'>
    <a href="hom.php" style="position:fixed;top:0;right:20">Home</a>
 <form action="addQn.php" method="POST">
 <center><b style="font-size:30px">Add Question to the database</b></center><br><br><br>
 <center><table bgcolor=grey border=1>
  <tr>
      <th>Subject Code</th><td>
      <?=$CodeDropDown?>
      <!--<input type="text" size="12" name='code' value="<?=$_POST['code']?>"><font color=brown><?=$ckcode?></font>--></td>
  </tr>
  <tr>
      <th>Unit</th><td><input type="number" size="1" name='unit' max="5" min="1" value="<?=$_POST['unit']?>"><font color=brown><?=$ckunit?></font></td>
  </tr>
     <th>Section</th><td><select name="section"><option value="A">A</option><option value="B">B</option></select>
   </td>
  </tr>
  <tr>
      <th>Marks</th><td><input type="number" name='mark' min="2" max="16" value="<?=$_POST['mark']?>"><font color=brown><?=$ckmark?></font></td>
  </tr>
  <tr>
      <th>Type</th><td><select name="type"><option value="Remember">Remember</option><option value="Understand">Understand</option><option value="Analyze">Analyze</option></select></td>
  </tr>
  <tr>
      <th>Question</th><td><textarea rows="5" cols="50" name="qn"><?=$_POST['qn']?></textarea><font color=brown><?=$ckqn?></font></td>
  </tr>
  <!--<tr>
      <th>Diagram</th><td><input type="file" name='diagram' accept="image/*" value="<?=$_POST['diagram']?>"><font color=brown><?=$ckdiagram?></font></td>
  </tr>-->
</table><br>
     <input type="submit" name='submit' value='Submit'>&nbsp;&nbsp;<input type="reset" name="reset" value="Reset"></form>