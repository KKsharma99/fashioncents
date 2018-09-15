<?php
define('INCLUDE_CHECK',true);
session_start();
include 'connect.php';

if(isset($_POST['time']) && isset($_POST['firstload'])) {
    if(empty($_SESSION['sessiontime'])) {
        $_SESSION['sessiontime'] = 1;
        echo $_SESSION['sessiontime'];
    } else {
        if($_POST['firstload'] == 'true') {
            echo $_SESSION['sessiontime'];
        } else {
            $_SESSION['sessiontime'] = $_POST['time'];
            echo $_SESSION['sessiontime'];
        }
    }
    $sql = "UPDATE tbl_visit set timespent = " . $_SESSION['sessiontime'] . " WHERE visitid = " . $_SESSION['visitid'];
    mysqli_query($GLOBALS['sqllink'], $sql);
}


?>