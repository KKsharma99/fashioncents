<?php 
session_start();
$db_host        = 'localhost';
$db_user        = 'root';
$db_pass        = 'g5mGfqMX';
$db_database    = 'fashioncentsbeta'; 
/* Server
$db_host        = 'sql308.byethost22.com';
$db_user        = 'b22_19030898';
$db_pass        = 'F4shion$ents';
$db_database    = 'b22_19030898_fashioncents'; 
*/
/* End config */
//$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
$_SESSION['link'] = mysqli_connect($db_host,$db_user,$db_pass,$db_database);
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
ini_set('display_errors','1'); 
error_reporting(E_ALL);
if(!empty($_POST['err'])) {
    switch ($_POST['err']) {
        case "exp":
        	if (!empty($_POST['postid'])) {
            	mysqli_query($_SESSION['link'], "INSERT INTO tbl_reports(userid,type,postid) VALUES('".$_SESSION['id']."','Explict Content','".$_POST['postid']."')");
            	echo true;
        	} else {
        		header("Location: 404.php");
        	}
        break;

        case "har":
         	if (!empty($_POST['postid'])) {
            	mysqli_query($_SESSION['link'], "INSERT INTO tbl_reports(userid,type,postid) VALUES('".$_SESSION['id']."','Harassment','".$_POST['postid']."')");
            	echo true;
        	} else {
        		header("Location: 404.php");
        	}
        break;

        case "copyr":
         	if (!empty($_POST['postid'])) {
            	mysqli_query($_SESSION['link'], "INSERT INTO tbl_reports(userid,type,postid) VALUES('".$_SESSION['id']."','Copyright Violation','".$_POST['postid']."')");
        		echo true;
        	} else {
        		
        	}
        break;
        
        default:
        	header("Location: 404.php");
        break;
    }
} else {
	header("Location: 404.php");
}
//header("Location: home.php");
?>