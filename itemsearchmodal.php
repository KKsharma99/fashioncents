<!-- Modal fullscreen -->
<div class="modal modal-fullscreen fade" id="modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">


        <div id="custom-search-m-input">
          <div class="input-group col-md-12">
            <input id = "query-m" type="text" class="form-control input-sm" placeholder="Search Items..." />
            <span class="input-group-btn">
              <button class="btn btn-info btn-sm" type="button" onclick="searchMobileProducts();">
                &nbsp<i class="glyphicon glyphicon-search"></i>
              </button>
            </span>
          </div>
        </div>            


      </div>


      <div id = "productsarea-m" class="productsarea-m">

      </div> <!-- End Products Area --> 


      <div class="modal-footer">
 

        <button type="button" class="btn btn-primary custom-btn-m pull-left" 
        data-toggle="modal" data-target="#modal-fullscreen2">
        Custom Tag
        </button>

        <button type="button" class="btn btn-primary done-btn-m pull-right" data-dismiss="modal">Done</button>

    </div>
  </div>
</div>
</div>

<script type="text/javascript">
// .modal-backdrop classes
$(".modal-transparent").on('show.bs.modal', function () {
  setTimeout( function() {
    $(".modal-backdrop").addClass("modal-backdrop-transparent");
  }, 0);
});
$(".modal-transparent").on('hidden.bs.modal', function () {
  $(".modal-backdrop").addClass("modal-backdrop-transparent");
});
$(".modal-fullscreen").on('show.bs.modal', function () {
  setTimeout( function() {
    $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
  }, 0);
});
$(".modal-fullscreen").on('hidden.bs.modal', function () {
  $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
});
function searchMobileProducts() {
        $.ajax({
            url: 'searchresults.php',
            type: 'post',
            datatype: 'string',
            data: {fn : 3, query: document.getElementById("query-m").value},
            success: function(data) {
                //alert(data);
                var current = $('#productsarea-m').html();
                $('#productsarea-m').html(data);
            }
          //$('#container').html(current.concat(data,'<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">'));}
        });
    }
</script> 