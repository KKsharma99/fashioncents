<?php 
define('INCLUDE_CHECK',true);
include 'connect.php'; ?>
<script type="text/javascript">
    var vglnk = { key: 'e19ecda0ccd24f40fc36265c4d6bd140' };
    (function(d, t) {
        var s = d.createElement(t); s.type = 'text/javascript'; s.async = true;
        s.src = '//cdn.viglink.com/api/vglnk.js';
        var r = d.getElementsByTagName(t)[0]; r.parentNode.insertBefore(s, r);
    }(document, 'script'));
</script>
<?php

/*if(!isset($_SESSION['merchants'])) {
$cpamerch = array();

$ch = curl_init("https://publishers.viglink.com/api/merchant/search?apiKey=e19ecda0ccd24f40fc36265c4d6bd140&category=FS");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: secret 436839c7ba1c0eeb2802ac053447357608bb15f9'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$merchants = curl_exec($ch);
curl_close($ch);
$merchants = json_decode($merchants, TRUE);
$pagecount = $merchants['totalPages'];
for($i = 1; $i <= $pagecount && $i < 100; $i++) {
    $ch = curl_init("https://publishers.viglink.com/api/merchant/search?apiKey=e19ecda0ccd24f40fc36265c4d6bd140&category=FS");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: secret 436839c7ba1c0eeb2802ac053447357608bb15f9'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $merchants = curl_exec($ch);
    curl_close($ch);
    $merchants = json_decode($merchants, TRUE);
    foreach($merchants['merchants'] as $merch) {
        if($merch['affiliateCPA'] == true) {
            $cpamerch[] = $merch['name'];
        }
    }
}
$_SESSION['merchants'] = $cpamerch;
}*/
//var_dump($cpamerch);

search();
function search() {

    $query = "";//str_replace(" ", "+", $_POST['query']);
    //var_dump($query);
    $url = "https://rest.viglink.com/api/product/search?apiKey=e19ecda0ccd24f40fc36265c4d6bd140&query=" . $query;
    //foreach($_SESSION['merchants'] as $merchant) {
    //    $url .= "&merchant[]=" . $merchant;
    //}

    $url .= "&country=us&itemsPerPage=400&category=Fashion&filterImager=true&price=,300.00";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: secret 436839c7ba1c0eeb2802ac053447357608bb15f9'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, TRUE);
    //$navigation = buildFacetNavigation($response['facet'], '/searchresults.php?query=' . $_GET['query']);
    //echo $navigation;
    var_dump($response);
}
?>