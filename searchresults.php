<?php session_start();
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

if(!isset($_POST['page'])) {
    $_POST['page'] = 1;
}
if($_POST['fn'] == 1) {
    search();
} else if($_POST['fn'] == 2) {
    addDetails();
} else if($_POST['fn'] == 3) {
	searchMobile();
}
function search() {

    $query = str_replace(" ", "+", $_POST['query']);
    //var_dump($query);
    $url = "https://rest.viglink.com/api/product/search?apiKey=e19ecda0ccd24f40fc36265c4d6bd140&query=" . $query;
    //foreach($_SESSION['merchants'] as $merchant) {
    //    $url .= "&merchant[]=" . $merchant;
    //}

    $url .= "&country=us&itemsPerPage=400&category=Fashion&filterImager=true&price=,300.00&page=" . $_POST['page'];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: secret 436839c7ba1c0eeb2802ac053447357608bb15f9'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, TRUE);
    //$navigation = buildFacetNavigation($response['facet'], '/searchresults.php?query=' . $_GET['query']);
    //echo $navigation;
    //var_dump($response);
    ?>

    <?php 
    $count = 1;
    foreach($response['items'] as $item) {
        if($count % 4 == 0) { ?>
            <div class="row"> 
        <?php } ?>
                <div class="col-md-3 col-xs-6 column inner-search-columns">
                  <div class="productbox"> 
                    <div id="item-photo-container text-center">

                      <img src="<?php echo $item['imageUrl'] ?>" class="img-responsive">

                    </div>

                    <div class="product-description">
                      <div class="producttitle"><?php echo $item['name'] ?></div>

                      <div class="productinfo text-center"> 
                        <div class="productbrand"><?php echo $item['brand'] ?></div>

                        <div class="productmerchant"><?php echo $item['merchant'] ?></div>
                      </div> 

                      <div class="product-price-tag"> 
                        <div class="pull-left">
                          <p class="productprice"><strong><?php echo $item['price'] ?></strong></p>
                        </div>
                        
                        <div class="pull-right">
                            <a href="javascript:void(0);" onclick="addTag('<?php echo str_replace('\'', '', $item['name'])?>','<?php echo str_replace('\'', '', $item['brand'])?>','<?php echo str_replace('\'', '', $item['merchant'])?>','<?php echo $item['price']?>','<?php echo $item['imageUrl'] ?>','<?php echo $item['url'] ?>');" class="btn btn-primary tag-item-btn">TAG</a> 
                        </div>

                      </div> 
                    </div> <!-- End Product Description --> 

                  </div> <!-- End (Inner) Product Box --> 
                </div> <!-- End Product Item --> 
        <?php if($count % 4 == 0) { ?>
            </div>
        <?php }
        $count++;
    }
}
function searchMobile() {
    $query = str_replace(" ", "+", $_POST['query']);
    //var_dump($query);
    $ch = curl_init("https://rest.viglink.com/api/product/search?apiKey=e19ecda0ccd24f40fc36265c4d6bd140&query=" . $query . "&country=us&itemsPerPage=400&category=Fashion&filterImager=true&price=,300.00&page=".$_POST['page']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: secret 436839c7ba1c0eeb2802ac053447357608bb15f9'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, TRUE);
    //$navigation = buildFacetNavigation($response['facet'], '/searchresults.php?query=' . $_GET['query']);
    //echo $navigation;
    //var_dump($response);
    ?>

    <?php 
    $count = 1;
    foreach($response['items'] as $item) {
        if($count % 2 == 0) { ?>
            <div class="row"> 
        <?php } ?>
                <div class="col-md-3 col-xs-6 column inner-search-columns-m">
            <div class="productbox-m"> 
              <div id="item-photo-container text-center">

                <img src="<?php echo $item['imageUrl'] ?>" class="img-responsive">

              </div>

              <div class="product-description-m"> 
                <div class="producttitle-m"><?php echo $item['name'] ?></div>


                      <div class="productinfo-m text-center"> 
                        <div class="productbrand-m"><?php echo $item['brand'] ?></div>

                        <div class="productmerchant-m"><?php echo $item['merchant'] ?></div>
                      </div> 

                <div class="product-price-tag-m"> 
                  <div class="pull-left">
                    <p class="productprice-m"><strong><?php echo $item['price'] ?></strong></p>
                  </div>
                  
                  <div class="pull-right">
                    <a href="javascript:void(0);" onclick="addTag('<?php echo str_replace('\'', '', $item['name'])?>','<?php echo str_replace('\'', '', $item['brand'])?>','<?php echo str_replace('\'', '', $item['merchant'])?>','<?php echo $item['price']?>','<?php echo $item['imageUrl'] ?>','<?php echo $item['url'] ?>');" data-dismiss="modal" class="btn btn-primary tag-item-btn-m">TAG</a> 
                  </div>

                </div>
              </div> <!-- End Product Description --> 

            </div> <!-- End (Inner) Product Box --> 
          </div> <!-- End Product Item --> 
        <?php if($count % 2 == 0) { ?>
            </div>
        <?php }
        $count++;
    }
}
function addDetails() {
    $items = json_decode($_POST['details']);
    //print_r(count($items));
    if(mysqli_error($_GLOBAL['sqllink']) == "") {
    $newpost = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], "SELECT postid FROM tbl_posts WHERE userid = " . $_SESSION['id'] . " ORDER BY posttime DESC LIMIT 1"));
    $newpost = $newpost['postid'];
    for($i = 0; $i < count($items); $i++) {
    	if($items[$i] != null) {
        $item = $items[$i];
        $item[4] = urldecode($item[4]);
        $item[4] = mysqli_real_escape_string($GLOBALS['sqllink'], $item[4]);
        $item[5] = urldecode($item[5]);
        $item[5] = mysqli_real_escape_string($GLOBALS['sqllink'], $item[5]);
        $query= "INSERT INTO `tbl_items`(`postid`, `itemname`, `brand`, `merchant`, `price`, `image`, `link`) VALUES('".$newpost."','".$item[0]."','".$item[1]."','".$item[2]."','".$item[3]."','".$item[4]."','".$item[5]."')";
        mysqli_query($GLOBALS['sqllink'],$query);
    	}
    }
    }
}
?>