<?php



if(!defined('INCLUDE_CHECK')) header("Location: 404.php");





/* Database config */

//Local
$db_host		= 'localhost';

$db_user		= 'root';

$db_pass		= 'password';

$db_database	= 'kunalsha_fashioncents_blog';

/* Server
$db_host		= 'sql308.byethost22.com';

$db_user		= 'b22_19030898';

$db_pass		= 'F4shion$ents';

$db_database	= 'b22_19030898_fashioncents';
*/


/* End config */

//example hange







//$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
$GLOBALS['bloglink'] = mysqli_connect($db_host,$db_user,$db_pass,$db_database);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
