<?php
include "check.php";
require_once('dbconnect.php');

     db_connect();
     session_start();
     $usrname=$_SESSION['usrname'];

//to add subjects to database
$code=$_POST['code'];
$qry=mysql_query("select count(*) from sub where code='$code'");
$fetch=mysql_fetch_array($qry);
if($_POST['submit']!="")
  {	
    if(empty($_POST['code']))
{
  	 $ckcode="Please Enter subject code";
}
    elseif(!$fetch[0])
        $ckcode="Enter a valid code";
    else
    {
        $qry=mysql_query("insert into staffForSub values('$usrname', '$code')");
if($qry)
  header('location:subHandling.php');
else 
 echo "Error"; 
    }
}

//to fetch subjects already handled
$qry=mysql_query("select count(*) from staffForSub where usrname='$usrname'");
$fetch=mysql_fetch_array($qry);
if($fetch[0])
{
    $sql="select code from staffForSub where usrname='$usrname'";
    $result = mysql_query($sql) or die('Username incorrect');
    
     $sub="<table border='0' style='font-size: 10pt; color:brown ; font-family: verdana, arial;'><tr><th>Code</th><th>Name</th></tr>";
     while ($line = mysql_fetch_array($result))
     {
         $name=mysql_fetch_array(mysql_query("select name from sub where code='$line[0]'"));
           $sub = $sub . "<tr><td>" . $line[0] ."</td><td>".$name[0] . "&nbsp;</td></tr>";
     }
     $sub=$sub . "</table>";
}

?>
<html>
<body>
    <a href="hom.php" style="position:fixed;top:0;right:20">Home</a>
    <center>
        <?php
    if($fetch[0])
    {
        echo "<b style='font-size:30px;'>Subjects you are handling</b>";
        echo $sub;
        echo "<br><br><br>";
    }
?>
        <b style="font-size:20px;">Add the subjects you are handling.</b>
        <br>
        <br>
        <form action="subHandling.php" method="POST">
    <table>
        <tr>
        <th>Subject Code</th>
            <td><input type="text" name="code" value="<?=$_POST['code']?>"><font color=red><?=$ckcode?></font></td>
        </tr>
        <br>
        <tr><td></td><td><input type="submit" name="submit" value="Add">&nbsp;&nbsp;<input type="reset" value="Clear"></td></tr>
        </table>
        </form>
        </center>
    </body>
</html>