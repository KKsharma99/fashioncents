
<div class="row hidden-xs ">
  <div class="col-md-7 col-xs-12">

    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#default">Our Items</a></li>
      <li><a data-toggle="tab" href="#custom">Custom Items</a></li>
    </ul>

    <div class="tab-content">
      <div id="default" class="tab-pane fade in active">

        <div class="search-main-card">
          <br> 

          <div id="custom-search-input">
            <div class="input-group col-md-12">
              <input name = "query" id = "query" type="text" class="form-control input-lg" placeholder="Search for a Similar Clothing Item..." />
              <span class="input-group-btn">
                <button id = "searchbutton" class="btn btn-info btn-lg" type="button" onclick="searchProducts();">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </span>
            </div>
          </div>

          <br>

          <div id="productsarea" class="productsarea">

          </div> <!-- End Products Area --> 
        </div> <!-- End Search Main Card -->
        <button id = "loadmore" class = "btn btn-md btn-primary" style = "width:100%;" type = "button" onclick="loadMore()">Load More</button> 

        <script>
          function searchProducts() {
            $.ajax({
              url: 'searchresults.php',
              type: 'post',
              datatype: 'string',
              data: {fn : 1, query: document.getElementById("query").value},
              success: function(data) {
                //alert(data);
                var current = $('#productsarea').html();
                $('#productsarea').html(data);
              }
          //$('#container').html(current.concat(data,'<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">'));}
        });
          }

              //var flag;
              //var flags;
              var page = 1;
              //$('#productsarea').scroll(function() {
              //if($('#productsarea').scrollTop() + $('#productsarea').height() >= $('#productsarea').height()-10) {
              //if(!flag && !flags){
              //flag=true;
              //setTimeout(function() { flag=false;}, 500);
              function loadMore() {
                page++;
                $.ajax({
                  url: 'searchresults.php',
                  type: 'post',
                  datatype: 'string',
                  data: {fn : 1, query: document.getElementById("query").value, page:page},
                  success: function(data) {
                //alert(data);
                var current = $('#productsarea').html();
                $('#productsarea').append(data);
              }
          //$('#container').html(current.concat(data,'<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">'));}
        });
              }
              //}
            //}
            //});
</script>


</div> <!-- End Default Section -->
<div id="custom" class="tab-pane fade">
  <input type="hidden" name = "itemcount" id = "itemcount" value = "0"/>
  <br> 

  <div class= "items">
                <!--<div class="outfit-item-card outfit-item-height">
                  <div class="outfit-item-interior">
                    <div class="outfit-item-header">
                      <span class="pull-left">
                        <h4>
                          <b>Custom Item 1</b>
                        </h4>
                      </span>-->

            <!--<a class="pull-right" href="#">
            <img src="vendor/custom-icons/cross1.png" class="outfit-item-cross">
          </a>-->

        <!--</div>
        <div class="outfit-item-body">
          <div class="form-group"> 
            <div class="col-md-5 col-sm-12">
              <input id="item1" name="item1" type="text" placeholder="Clothing Type" class="form-control input-md item-feild-spacing" required="">
            </div>
            <div class="col-md-4 col-sm-12">
              <input id="brand1" name="brand1" type="text" placeholder="Brand" class="form-control input-md item-feild-spacing" required="">
            </div>
            <div class="col-md-3 col-sm-12">
              <input id="price1" name="price1" type="number" step="0.01" placeholder="Price" class="form-control input-md item-feild-spacing" required="">
            </div>
            <div class="col-md-12 col-sm-12">
              <input id="amazon1" name="amazon1" type="url" placeholder="Link to same/similar item online" class="form-control input-md amazon-link-margin" required="">
            </div>
          </div>--> <!-- End Form Group --> 

          <!--</div>--> <!-- End Outfit Item Body --> 

          <!--</div>--> <!-- Close interior --> 
          <!--</div>--> <!-- Close Card --> 
        </div> <!-- End Items --> 



        <div class="text-center"> 
          <img id = "add" src="vendor/custom-icons/circle-plus-gray.png" onClick="duplicateCustom();" class="outfit-item-plus">
        </div> 


      </div> <!-- End Custom Section --> 

    </div> <!-- End Tab Content --> 

  </div> <!-- End  Column --> 
</div> <!-- End Row --> 

<script>
  var customi = 0;
  var customTagCopy = '<div id = customtag@@>' +
  '<div class="outfit-item-card outfit-item-height">' +
  '<div class="outfit-item-interior">' +
  '<div class="outfit-item-header">' +
  '<span class="pull-left">' +
  '<h4>' +
  '<b>Custom Item @@</b>' +
  '</h4>' +
  '</span>' +

  '<a class="pull-right" onClick="removeCustom()">'+
  '<img src="vendor/custom-icons/cross1.png" class="outfit-item-cross">'+
  '</a>'+


  '<btn class="btn btn-sm btn-primary custom-tag-btn pull-right">TAG</btn>' + 

  '<label class="btn btn-sm btn-default btn-file pull-right" style="margin-right: 15px;">' +
  '<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Item Image' +
  '<input id="filebutton" name="filebutton" style="display: none;" type="file">' + 
  '</label>' +

  '</div>' +
  '<div class="outfit-item-body">' +
  '<div class="form-group">' +
  '<div class="col-md-4 col-sm-12">' +
  '<input id="item@@" name="item@@" type="text" placeholder="Clothing Type" class="form-control input-md item-feild-spacing" required="">' +
  '</div>' +
  '<div class="col-md-3 col-sm-12">' +
  '<input id="brand@@" name="brand@@" type="text" placeholder="Brand" class="form-control input-md item-feild-spacing" required="">' +
  '</div>' +
  '<div class="col-md-3 col-sm-12">' +
  '<input id="merchant@@" name="merchant@@" type="text" placeholder="Merchant" class="form-control input-md item-feild-spacing" required="">' +
  '</div>' +
  '<div class="col-md-2 col-sm-12">' +
  '<input id="price@@" name="price@@" type="number" step="0.01" placeholder="Price" class="form-control input-md item-feild-spacing" required="">' +
  '</div>' +
  '<div class="col-md-12 col-sm-12">' +
  '<input id="amazon@@" name="amazon@@" type="url" placeholder="Link to same/similar item online" class="form-control input-md amazon-link-margin" required="">' +
  '</div>' +
  '</div> <!-- End Form Group -->' +
  '</div> <!-- End Outfit Item Body -->' +
  '</div> <!-- Close interior -->' +
  '</div> <!-- Close Card -->' + 
  '</div>';
  function duplicateCustom() {
    customi++;
    document.getElementById("itemcount").value = "" + customi;
    var clone = customTagCopy.replace(/\@\@/g, customi);  // "deep" clone
    //clone.id = "duplicate" + ++i;
    // or clone.id = ""; if the divs don't need an ID
    $('.items').append(clone);
  } 
  function removeCustom() {
    document.getElementById("customtag" + customi).parentElement.removeChild(document.getElementById("customtag" + customi));
    customi--; 
    document.getElementById("itemcount").value = "" + customi;
  }
</script>
