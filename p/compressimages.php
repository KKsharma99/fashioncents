<?php 
define('INCLUDE_CHECK',true);
include 'connect.php';
include 'thisfilenamewillconfusekunal.php';

$query = "SELECT postid,image_small FROM tbl_posts WHERE 1 ORDER BY posttime DESC";
$posts = mysqli_query($GLOBALS['sqllink'], $query);

while($post = mysqli_fetch_assoc($posts)) {
    if(file_exists($post['image_small'])) {
    if(filesize($post['image_small']) > 181*1024) {
        $initsize = filesize($post['image_small']);
        smart_resize_image($post['image_small'], null, 1000, 1618, true, $post['image_small'], false, false, 40);
        echo $post['image_small'] . ": " . $initsize . ' --> ' . filesize($post['image_small']) . '<br>';
    }
    }
}
?>