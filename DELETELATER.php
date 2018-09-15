<?php
function newUpload($user) {
	if ($_FILES["newProPic"]["error"] > 0) {
        			$error = $_FILES["newProPic"]["error"];
    		} 
    		else if (($_FILES["newProPic"]["type"] == "image/gif") || 
			($_FILES["newProPic"]["type"] == "image/jpeg") || 
			($_FILES["newProPic"]["type"] == "image/png") || 
			($_FILES["newProPic"]["type"] == "image/pjpeg")) {

        			$url1 = "img/users/" . $user['userid'] . "_small.png";
        			$url2 = "img/users/" . $user['userid'] . ".png";
        			compress_image($_FILES["newProPic"]["tmp_name"], $url2, 100);
        			$filename = compress_image($_FILES["newProPic"]["tmp_name"], $url1, 40);
        			//$buffer = file_get_contents($url);

        			/* Force download dialog... */
        			//header("Content-Type: application/force-download");
        			//header("Content-Type: application/octet-stream");
        			//header("Content-Type: application/download");

			/* Don't allow caching... */
        			//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

        			/* Set data type, size and filename */
        			//header("Content-Type: application/octet-stream");
        			//header("Content-Transfer-Encoding: binary");
        			//header("Content-Length: " . strlen($buffer));
        			//header("Content-Disposition: attachment; filename=$url");

        			/* Send our file... */
        			//echo $buffer;

        			mysqli_query($_SESSION['link'], "UPDATE tbl_users SET profilepic='" . $url1 . "' WHERE userid= " .$user['userid']);
    		}else {
        			$error = "Uploaded image should be jpg or gif or png";
    		}
} ?>