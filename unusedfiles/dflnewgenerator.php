<div class="item"> <!-- Start dflpost --> 

    <div class="dflpanel dflpanel-white dflpost dflpanel-shadow">

      <div class="dflpost-heading">

        <div class="pull-left image">

          <img src="img/users/21.jpg" class="img-circle avatar" alt="user profile image">

        </div>

        <div class="pull-left">
          <div class="dflpost-user">
            <a href="#"><b>A</b>
            </a>
          </div>
        </div>

        <div class="dropdown">

          <btn class="dropdown-toggle" type="button" data-toggle="dropdown"><img  src="vendor/custom-icons/dots-v.png" class="dots-v pull-right"></btn>

          <ul class="dropdown-menu dropdown-menu-right dropdownadjust">
            <li class="dropdown-header">Report</li>
            <li><a href="#">Explicit Content</a></li>
            <li><a href="#">Harassment</a></li>
            <li><a href="#">Copyright Violation</a></li>
          </ul>
        </div>

        <img src="vendor/custom-icons/circle-check.png" class="circle-plus pull-right">

        <div class="pull-right">
          <h6 class="text-muted dflpost-time">3w
          </h6>
        </div>


      </div> 

      <div class="dflpost-description"> 

        <img class="img-responsive text-center" width="100%"src="img/practice4.jpg" alt="test"> 

        <p>Priyanka Chopra's Stunning Dress</p>

        <table class="table interact-bar">
          <tbody>
            <tr class="interact-bar">


              <td><img src="vendor/custom-icons/thumbsup.png" class="interact-item"><a data-toggle="modal" data-target="#likesmodal" title="See who liked this dflpost." href="#"><span class="item-count">8</span></a></td>


              <!-- Likes Modal -->
              <div class="modal fade" id="likesmodal" role="dialog">
                <div class="modal-dialog modal-sm">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>Likes (9): </b></h4>
                    </div>
                    <div class="modal-body fourpluscomments">
                      <?php include("likesfavcontent.php"); ?> 
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>

              <td><a href="#"><img src="vendor/custom-icons/favorite.png" class="interact-item"></a><a data-toggle="modal" data-target="#favmodal" title="See who favorited this dflpost." href="#"><span class="item-count">9</span></a></td>

              <!-- Likes Modal -->
              <div class="modal fade" id="favmodal" role="dialog">
                <div class="modal-dialog modal-sm">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>Favorites (9): </b></h4>
                    </div>
                    <div class="modal-body fourpluscomments">
                      <?php include("likesfavcontent.php"); ?> 
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>


              <td> 

              <div class="dropup">

                <btn data-toggle="dropdown"><img src="vendor/custom-icons/share.png" class="interact-item"><a data-toggle="modal" data-target="#sharemodal" title="See who shared this dflpost." href="#"><span class="item-count">6</span></a></btn>

                <ul class="dropdown-menu dropdown-menu-right dropdownadjust">
                  <li class="dropdown-header">Share</li>
                  <li><a href="#">Re-Hang</a></li>
                  <li><a href="#">Facebook</a></li>
                  <li><a href="#">Email</a></li>
                </ul>
              </div>

              </td>
              <!-- Likes Modal -->
              <div class="modal fade" id="sharemodal" role="dialog">
                <div class="modal-dialog modal-sm">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><b>Shares (6): </b></h4>
                    </div>
                    <div class="modal-body fourpluscomments">
                      <?php include("likesfavcontent.php"); ?> 
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div> <!-- End Likes Modal --> 
              
            </tr>
          </tbody>
        </table>
      </div>

      <div class="dflpost-footer">
        <ul class="products-list">
          <li class="product-item">
            <a class="pull-left" href="#">
              <img class="img-rounded avatar" src="img/clothing/blackdress.jpg" alt="item">
            </a>
            <a class="pull-right" href="#">
              <button type="button" class="btn btn-sm btn-success buy-button">$20</button>
            </a>
            <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
              <div class="product-item-details">
                <p class="item-name">Black Dress</p>
                <p class="item-brand">Arizona</p>
                <p class="item-merchant">macys.com</p>
              </div>
            </div>
          </li>

          <li class="product-item">
            <a class="pull-left" href="#">
              <img class="img-rounded avatar" src="img/clothing/blacksandals.jpg" alt="item">
            </a>
            <a class="pull-right" href="#">
              <button type="button" class="btn btn-sm btn-success buy-button">$42</button>
            </a>
            <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
              <div class="product-item-details">
                <p class="item-name">Designer Sandals</p>
                <p class="item-brand">Hugo</p>
                <p class="item-merchant">jcpenny.com</p>
              </div>
            </div>
          </li>

        </ul>

      </div>
    </div> <!-- End dflpost --> 
  </div>
