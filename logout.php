<?php
include "dbconnect.php";
db_connect();
session_start();
session_unset();
session_destroy();
header('location:index.php');
?>
