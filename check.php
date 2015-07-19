<?php
session_start();
if(!isset($_SESSION['usrname']))
 header('location:index.php');
?>
