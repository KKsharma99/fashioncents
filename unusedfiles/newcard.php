<?php
define('INCLUDE_CHECK',true);
require 'functions.php';
include_once("analyticstracking.php");
ini_set('display_errors','1'); 
error_reporting(E_ALL);
if(!isset($_SESSION['id']))
{
    // If you are logged in, but you don't have the tzRemember cookie (browser restart)
    // and you have not checked the rememberMe checkbox:
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
    // Destroy the session
}
if(isset($_GET['logoff']))
{
  $_SESSION = array();
  session_destroy();
  header("Location: index.php");
  exit;
}
?>





<?php include("header.php"); ?> 

<?php include("nav.php"); ?> 

<?php include("sortingbar.php"); ?> 

<div class="row">

  <div class="col-lg-12 ">

    <div class="space2"> <!-- Space2 is adjusted 3/15/17 --> 

    </div>

  </div>

</div> 

<div class="row">

  <!--============== Start Post =========================--> 
  <div class="col-lg-4"> 
    <div class="panel panel-white post panel-shadow">

      <div class="post-heading">

        <div class="pull-left image">
          <a href="account.php?userid=527">
            <img src="img/practice.jpg" class="img-circle avatar" alt="img/users/defaultuser.jpg">
          </a>
        </div> <!-- User Avatar --> 

        <div class="pull-left">
          <div class="post-user">
            <a href="account.php?userid=527"><b>Sophia Williams</b></a>
          </div>
        </div> <!-- User Name --> 

        <div class="dropdown">

          <btn id="follow527" class="dropdown-toggle" type="button" data-toggle="dropdown"><img data-toggle="tooltip" title="OPTIONS" src="vendor/custom-icons/dots-v.png" class="dots-v pull-right"></btn>

          <ul class="dropdown-menu dropdown-menu-right">
            <li><a onclick='showErrorModal("exp", 405);' data-toggle="modal" data-target="#errorconfim">Share</a></li>
            <li class="dropdown-header">Report</li>
            <li><a onclick='showErrorModal("exp", 405);' data-toggle="modal" data-target="#errorconfim">Explicit Content</a></li>
            <li><a onclick='showErrorModal("har",405);' data-toggle="modal" data-target="#errorconfim">Harassment</a></li>
            <li><a onclick='showErrorModal("copyr",405);' data-toggle="modal" data-target="#errorconfim">Copyright Violation</a></li>
          </ul> <!-- End Dropdown Menu --> 
        </div> <!-- End Dropdown --> 

        <img data-toggle="tooltip" title="FOLLOW" id="follow527" name="follow527" src="vendor/custom-icons/circle-plus.png" class="circle-plus pull-right" onclick = "follow(527 , 2, 3)">
        <div class="pull-right">
          <h6 class="text-muted post-time">2W</h6>
        </div>
      </div> <!-- End Post Heading --> 

      <div class="post-description bottom-padding"> 
        <a href="userpost.php?postid=405">
          <img class="img-responsive text-center" width="100%" src="img/practice.jpg" alt="test">
        </a>

        <div class="new-interact-bar"> 

          <!-- This Script Initializes the Tooltips --> 
          <script> 
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip(); 
            });
          </script>
          <!-- End Tooltip Initializing Script -->

          <span class="pull-left"> <!-- Reaction Section -->

            <div data-toggle="tooltip" title="132 Reactions" class="btn btn-sm total-reacts-btn"><strong>132</strong></div>
            <img  data-toggle="tooltip" title="LOVE" src="vendor/custom-icons/in-love-inactive.png" class="emoj-reacts">
            <img  data-toggle="tooltip" title="COOL" src="vendor/custom-icons/cool-inactive.png" class="emoj-reacts">
            <img  data-toggle="tooltip" title="WOW" src="vendor/custom-icons/surprised-active.png" class="emoj-reacts">
            <img  data-toggle="tooltip" title="SEXY" src="vendor/custom-icons/kiss-inactive.png" class="emoj-reacts">
            <img  data-toggle="tooltip" title="ENVY" src="vendor/custom-icons/angry-inactive.png" class="emoj-reacts">
          </span> 

          <span class="pull-right"> <!-- Post Option Section --> 
            <img  aria-controls="addComment" aria-expanded="false" data-target="#addComment" data-toggle="collapse"
            data-toggle="tooltip" title="COMMENT" src="vendor/custom-icons/comment.png" class="post-options">
            <img  data-toggle="tooltip" title="SAVE" src="vendor/custom-icons/bookmark.png" class="post-options">
          </span> 
        </div>
      </div> <!-- End Post Description --> 

      <div class="post-footer new-post-footer">
        <ul>
          <li class="text-center">
            <img data-toggle="tooltip" title="Previous Comments (6)" src="vendor/custom-icons/dots-h.png" class="dots-h"> 
          </li>
          <li>
            <p>
              <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart.png" class="heart-icon"> 
              <a href="#">Kunal Sharma
              </a> What a beautiful outfit! 
              <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 
              <span class="pull-right comment-date">2w</span>
            </p>
          </li> 
          <li>
            <p>
              <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart2.png" class="heart-icon"> 
              <a href="#">Nikhil Rajan
              </a> Love the Links! 
              <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 
               <span class="pull-right comment-date">30m</span>
            </p>
          </li> 
          <li>
            <p>
              <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart2.png" class="heart-icon"> 
              <a href="#">Spero Calamas
              </a> If only my GF dressed like you...  
              <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 
               <span class="pull-right comment-date">5m</span>
            </p>
          </li> 
        </ul> 

        <div class="collapse" id="addComment">
          <input type='text' placeholder='Press "Enter" to Comment'></input>
        </div> <!-- End Add Comment Section --> 
      </div> <!-- End Post Footer --> 

      <div class="dflpost">
        <div class="dflpost-footer">
          <ul class="products-list">

            <li class="product-item">
              <a class="pull-left" target="_blank" href="http://oldnavy.gap.com/browse/product.do?cid=98812&vid=1&pid=939735162">
                <img class="img-rounded avatar" src="http://17cd375536cff14ca7e5-8116e43d436f7ae39332df711c2936aa.r98.cf2.rackcdn.com/product-mediumsquare-318609-30808-1416426642-26650e5a4a48440bfdf35e0a5fe45f74.jpg" alt="item">
              </a>
              <a class="pull-right" target="_blank" href="http://oldnavy.gap.com/browse/product.do?cid=98812&vid=1&pid=939735162">
                <button type="button" class="btn btn-sm btn-success buy-button">$7.99</button>
              </a>
              <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                <div class="product-item-details">
                  <p class="item-name"> Crew-Neck Tee</p>
                  <p class="item-brand">Old Navy</p>
                  <p class="item-merchant">gap</p>
                </div>
              </div>
            </li>
            <li class="product-item">
              <a class="pull-left" target="_blank" href="http://oldnavy.gap.com/browse/product.do?vid=1&pid=966689002">
                <img class="img-rounded avatar" src="https://s-media-cache-ak0.pinimg.com/originals/db/3d/4a/db3d4a38fe196eeef18110cc7d7e5dbe.jpg" alt="item">
              </a>
              <a class="pull-right" target="_blank" href="http://oldnavy.gap.com/browse/product.do?vid=1&pid=966689002">
                <button type="button" class="btn btn-sm btn-success buy-button">$15.99</button>
              </a>
              <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                <div class="product-item-details">
                  <p class="item-name">Lightweight Zip-Front Hoodie</p>
                  <p class="item-brand">Old Navy</p>
                  <p class="item-merchant">gap</p>
                </div>
              </div>
            </li>
            <li class="product-item">
              <a class="pull-left" target="_blank" href="http://www.stance.com/shop/higgs">
                <img class="img-rounded avatar" src="https://ak1.ostkcdn.com/images/products/is/images/direct/8ea3cf2f7e4083cc4ee163573be36de1b47118f4/Grace-Elements-Womens-Embellished-Elastic-Waist-Palazzo-Pants.jpg" alt="item">
              </a>
              <a class="pull-right" target="_blank" href="http://www.stance.com/shop/higgs">
                <button type="button" class="btn btn-sm btn-success buy-button">$18</button>
              </a>
              <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                <div class="product-item-details">
                  <p class="item-name">Higgs Knit Socks</p>
                  <p class="item-brand">Stance</p>
                  <p class="item-merchant">Stance</p>
                </div>
              </div>
            </li>
            <li class="product-item">
              <a class="pull-left" target="_blank" href="http://www.amazon.com/dp/B0092AJQDG/">
                <img class="img-rounded avatar" src="http://content.aerosoles.com/products/DIAMOND-R/DIAMOND-R~200~AV1~508PX.JPG" alt="item">
              </a>
              <a class="pull-right" target="_blank" href="http://www.amazon.com/dp/B0092AJQDG/">
                <button type="button" class="btn btn-sm btn-success buy-button">$35</button>
              </a>
              <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                <div class="product-item-details">
                  <p class="item-name">Carson Belt</p>
                  <p class="item-brand">Fossil</p>
                  <p class="item-merchant">amazon</p>
                </div>
              </div>
            </li>
            <div class="text-center">
              <img aria-controls="addComment" aria-expanded="false" data-target="#moreItems" data-toggle="collapse"
              data-toggle="tooltip" title="COMMENT" src="vendor/custom-icons/dots-h.png" class="more-items-dots">
            </div> 

            <span class="collapse" id="moreItems"> <!-- Start More Items Hidden Section --> 
              <li class="product-item">
                <a class="pull-left" target="_blank" href="http://www.gap.com/browse/product.do?cid=48872&vid=1&pid=941439002&ssiteID=BR">
                  <img class="img-rounded avatar" src="img/icon.png" alt="item">
                </a>
                <a class="pull-right" target="_blank" href="http://www.gap.com/browse/product.do?cid=48872&vid=1&pid=941439002&ssiteID=BR">
                  <button type="button" class="btn btn-sm btn-success buy-button">$89.95</button>
                </a>
                <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                  <div class="product-item-details">
                    <p class="item-name">Selvedge Khaki Jacket</p>
                    <p class="item-brand">GAP</p>
                    <p class="item-merchant">GAP</p>
                  </div>
                </div>
              </li>
              <li class="product-item">
                <a class="pull-left" target="_blank" href="http://us.asos.com/Selected-Maximilian-Scarf/1113s2/?iid=3002744">
                  <img class="img-rounded avatar" src="img/icon.png" alt="item">
                </a>
                <a class="pull-right" target="_blank" href="http://us.asos.com/Selected-Maximilian-Scarf/1113s2/?iid=3002744">
                  <button type="button" class="btn btn-sm btn-success buy-button">$23.22</button>
                </a>
                <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                  <div class="product-item-details">
                    <p class="item-name">Maximilain Scarf</p>
                    <p class="item-brand">ASOS</p>
                    <p class="item-merchant">ASOS</p>
                  </div>
                </div>
              </li>
              <li class="product-item">
                <a class="pull-left" target="_blank" href="http://www.hm.com/us/product/12738?article=12738-A#article=12738-V">
                  <img class="img-rounded avatar" src="img/icon.png" alt="item">
                </a>
                <a class="pull-right" target="_blank" href="http://www.hm.com/us/product/12738?article=12738-A#article=12738-V">
                  <button type="button" class="btn btn-sm btn-success buy-button">$29.95</button>
                </a>
                <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                  <div class="product-item-details">
                    <p class="item-name">Chinos Slim Fit</p>
                    <p class="item-brand">H&M</p>
                    <p class="item-merchant">hm</p>
                  </div>
                </div>
              </li>
              <li class="product-item">
                <a class="pull-left" target="_blank" href="http://www.zumiez.com/rastaclat-poppy-heather-red-bracelet.html">
                  <img class="img-rounded avatar" src="img/icon.png" alt="item">
                </a>
                <a class="pull-right" target="_blank" href="http://www.zumiez.com/rastaclat-poppy-heather-red-bracelet.html">
                  <button type="button" class="btn btn-sm btn-success buy-button">$12.95</button>
                </a>
                <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                  <div class="product-item-details">
                    <p class="item-name">Rastaclat Poppy Heather Red Bracelet</p>
                    <p class="item-brand">Zumiez</p>
                    <p class="item-merchant">Zumiez</p>
                  </div>
                </div>
              </li>
              <li class="product-item">
                <a class="pull-left" target="_blank" href="https://www.amazon.com/DP/B00B1I5KFU/">
                  <img class="img-rounded avatar" src="img/icon.png" alt="item">
                </a>
                <a class="pull-right" target="_blank" href="https://www.amazon.com/DP/B00B1I5KFU/">
                  <button type="button" class="btn btn-sm btn-success buy-button">$60.96</button>
                </a>
                <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                  <div class="product-item-details">
                    <p class="item-name">Bushacre 2 Boots</p>
                    <p class="item-brand">Clarks</p>
                    <p class="item-merchant">amazon</p>
                  </div>
                </div>
              </li> 
            </span> <!-- End More Items Hidden Section -->          
          </ul>
        </div> <!-- End DFL post footer --> 
      </div> <!-- End DFL Post --> 

    </div> <!-- End Post -->
  </div> <!-- End Column --> 
  <!--============== End Post =========================--> 

</div> <!-- End  Row --> 


<?php include("footer.php"); ?> 