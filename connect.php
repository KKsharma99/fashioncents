<?php
//if (substr_count($_SERVER[‘HTTP_ACCEPT_ENCODING’], ‘gzip’)) ob_start(“ob_gzhandler”); else ob_start();
if(!defined('INCLUDE_CHECK')) {
	header("Location: 404.php");
	exit();
}
//if (empty($_SERVER['HTTPS'])) {
//    header("Location: https://fashioncents.me" . $_SERVER['REQUEST_URI']);
//}
/* Database config */

//Local
$db_host		= 'localhost';

$db_user		= 'root';

$db_pass		= 'g5mGfqMX';

$db_database	= 'kunalsha_fashioncents_master';

/* End config */

$GLOBALS['sqllink'] = mysqli_connect($db_host,$db_user,$db_pass,$db_database);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
function nicetime($fctime){
    $secs = time() - $fctime;
    $bit = array(
        'y' => $secs / 31556926 % 12,
        'w' => $secs / 604800 % 52,
        'd' => $secs / 86400 % 7,
        'h' => $secs / 3600 % 24,
        'm' => $secs / 60 % 60,
        's' => $secs % 60
        );

    foreach($bit as $k => $v)
        if($v > 0) return $v . $k;
}