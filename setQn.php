<?php
require_once('dbconnect.php');
db_connect();
session_start();
     $usrname=$_SESSION['usrname'];
$code = $_GET['code'];
    $exam = $_GET['exam'];
    $table=$code.$exam;
$qur=mysql_query("SELECT id from exam where code='$code' and name='$exam'");
    $temp = mysql_fetch_array(mysql_query("select sum(mark) from $code where id in (select id from exam where code='$code')"));
    $totalMarks = $temp[0];

function fetchTable($unit, $section, $code){
    global $qur;
    $qry = mysql_query("select id, qn, mark, type from $code where unit='$unit' and section='$section'");
    $msg="<table border='0' style='font-size: 10pt; font-family: verdana, arial;color:black'>
    <tr><th>Select</th><th>S.No</th><th>Question</th><th>Marks</th><th>Type</th></tr>";
    $sno=1;
     while ($line = mysql_fetch_array($qry))
     {
        $msg = $msg. "<tr><td><input type='checkbox' name='check[]' value='".$line['id']."'>&nbsp;</td>"."<td>".$sno++."</td><td>".$line['qn']."</td><td>".$line['mark']."</td><td>".$line['type']."</td></tr>";
     }
        while($fet=mysql_fetch_array($qur)){
        echo " ".$fet[id];
        //$msg = str_replace("value='$fet[id]'", "value='$fet[id]' disabled", $msg);
        $msg = str_replace("<tr><td><input type='checkbox' name='check[]' value='$fet[id]'>", "<tr style='color:#3366ff;'><td><input type='checkbox' name='check[]' value='$fet[id]' disabled>", $msg);
        }
     $msg=$msg . "</table>";
    return $msg;
    }

if($_POST['submit']!="")
{
    $total=0;
    foreach($_POST['check'] as $selected)
    {
        $tem=mysql_fetch_array(mysql_query("select mark from $code where id='$selected'"));
        $total+=$tem[0];
    }
    if($total!=82)
        echo "<script>alert('Total marks is $total. Please select qns for 82 marks')</script>";
    else{
        foreach($_POST['check'] as $selected){
        mysql_query("insert into exam values('$code', '$selected', '$exam', '$usrname')");}
        echo "<script>alert('Question set added')</script>";
    }
}

?>
<html>
    <body>
        <a href="hom.php" style="position:fixed;top:0;right:20">Home</a>
        <center><b style="font-size:30px">Set a question</b></center><br><br><br>
    <?php
if(!isset($_GET['code]']) && !isset($_GET['exam']))
{
    $qry=mysql_query("select code from staffForSub where usrname='$usrname'");
$CodeDropDown="<select name='code'>";
     while ($line = mysql_fetch_array($qry))
     {
           $CodeDropDown = $CodeDropDown . "<option value=" . $line[0] .">".$line[0]. "</option>";
     }
     $CodeDropDown=$CodeDropDown . "</select>";

?>
        <center>
        <form action="setQn.php" method="get">
            <table>
            <tr><th>Subject Code</th>
                <td>
                <?=$CodeDropDown?>
                </td>
                </tr>
                <tr><th>Exam Name</th><td><input type="text" name="exam"></td></tr>
            </table>
            <input type="submit" value="Submit">
            </form>
            Exam name should be in lower case with no spaces.<br>Ex: For periodical 1, put pt1. For pre-periodical 1, give as ppt1.
        </center>
        <?php }else{ 
    echo "<center>";
    $subName = mysql_fetch_array(mysql_query("select name from sub where code='$code'"));
    echo "<form action='setQn.php?code=$code&exam=$exam' method='post'>";
    echo strtoupper($subName[0]);
    echo "<br><b>Part A</b>";
    for($i=1;$i<=5;$i++)
    {
        echo "<br>Unit ".$i;
     echo fetchTable($i, "A", $code);   
    }
    echo "<br><b>Part B</b>";
    for($i=1;$i<=5;$i++)
    {
        echo "<br>Unit ".$i;
     echo fetchTable($i, "B", $code);   
    }
    echo "<input type='submit' name='submit' value='Submit'></form>";
    
        ?>
        
        <?php } ?>
    </body>
</html>