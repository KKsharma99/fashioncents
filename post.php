<?php
define('INCLUDE_CHECK',true);
$disallowguest = true;
require 'sessionsguest.php';
ini_set('display_errors','1'); 
error_reporting(E_ALL);
?>

<?php include("itemsearchmodal.php"); ?> 
<?php include 'thisfilenamewillconfusekunal.php'; ?>

<script>    
    var i = 0;
    var items;
    if(localStorage.getItem("items") != null) {
        items = JSON.parse(localStorage.getItem("items"));
        localStorage.removeItem("items");
    } else {
        items = [];
    }
    var tagCopy = '<div id = "tag@@">' +
    '<div class="col-xs-12 tagged-item">' +
    '<img src="##" class="img-responsive item-image">' +
    '<div class="tagged-item-name-container">' + 
    '<p class="tagged-item-name">$$</p>' +
    '</div>' + 
    '<div class="tagged-item-price-container">' +
    '<p class="tagged-item-price">$%%</p>' +
    '</div>' +
    '<div class="tagged-item-remove-container">' +
    '<a class="pull-right" onClick="remove(@@)">'+ 
    '<img src="vendor/custom-icons/circle-cross.png" class="img-responsive tagged-item-remove">' +
    '</a>' +
    '</div>' +
    '</div>' +
    '</div>';
    function addTag(name, brand, merchant, price, image, link) {
        i++;
        items[i-1] = new Array(5);
                //var newItem = [];
                //newItem.push(name);
                //newItem.push(brand);
                //newItem.push(price);
                //newItem.push(link);
                //newItem.push(image);
                items[i-1][0] = name;
                items[i-1][1] = brand;
                items[i-1][2] = merchant;
                items[i-1][3] = price;
                items[i-1][4] = image;
                items[i-1][5] = link;
                if(name.length > 30) {
                    var maxLength = 30 // maximum number of characters to extract
                    //trim the string to the maximum length
                    name = name.substr(0, maxLength);
                    //re-trim if we are in the middle of a word
                    name = name.substr(0, Math.min(name.length, name.lastIndexOf(" "))) + "...";
                }
                var clone = tagCopy.replace(/\@\@/g, i);
                clone = clone.replace(/\#\#/g, image);
                clone = clone.replace(/\$\$/g, name);
                clone = clone.replace(/\%\%/g, price);
                $('#taggedItems').append(clone);
            }
            function remove(num) {
                document.getElementById("tag" + num).parentElement.removeChild(document.getElementById("tag" + num));
                items[num-1] = null;
                while(items[num] != null) {
                    items[num-1] = items[num];
                    num++;
                }
                i--;
                items[num-1] = null;
                //alert(items);
                //document.getElementById("itemcount").value = "" + i;
            }
            function addDetails() {
                $.ajax({
                    url: 'searchresults.php',
                    type: 'post',
                    data: {fn : 2, details: JSON.stringify(items)},
                    success: function(data) {
                        //$("#container").append(data);
                        window.location.href = "index.php";
                    }
                    //$('#container').html(current.concat(data,'<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">'));}
                });
            }
            function saveItems() {
                localStorage.setItem("items",JSON.stringify(items));
            }
        </script>

        <?php
        if(isset($_POST['submit'])) {
            if($_FILES['image']['error'] == 1) {
                echo'<script> alert("Image too large! Max file size 2MB"); </script>';
            } else {
    //var_dump($_FILES);
                createPost();
                echo '<script>
                addDetails();
            </script>';
        }
    }
//print(time());
    ?>


    <div class="row text-center"> 
        <div class="col-xs-12">

            <h1 class="text-center">Post an Outfit</h1> 
            <br>

        </div>
    </div>


    <div class="row">

        <div class="col-md-6 col-xs-12">

            <h4 class="text-center">FAQ</h4>

            <div class="panel-group" id="accordion">
                <div class="panel panel-default">

                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                      <div class="panel-heading">
                        <h4 class="panel-title">How Do I Post?
                        </h4>
                    </div>
                </a>

                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">In the “Our Items” tab, you can simply search the name of the items
                       that you are wearing. Once you find something as similar as possible, simply click “Tag” 
                       and it will show up below your post. By tagging the items in your outfit you are informing 
                       the community where they can buy similar items and become more fashionable

                       If you cannot find anything similar using our search box, then you can make a custom 
                       item by clicking on the “Custom Items” tab. If you would like to promote the products that 
                       you sell, you can do so here.</div>
                   </div>
               </div>
               <div class="panel panel-default">

                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                       What Should I Post?
                   </h4>
               </div>
           </a>
           <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body"> A picture where there is only one person in the photo and your 
                full outfit is clearly visible. There should not be any nudity or inappropriate content 
                in the picture.</div>
            </div>
        </div>

        <div class="panel panel-default">

           <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
              <div class="panel-heading">
                <h4 class="panel-title">
                   How Many Items Should I Tag?
               </h4>
           </div>
       </a>

       <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body"> You should have one tag for all the main items in your outfit. 
            You can also tag accessories if you would like. For example, if you are wearing a 
            leather jacket, jeans, and a blue t-shirt, you would find items that are similar to 
            each one of these and tag them.</div>
        </div>
    </div>

    <div class="panel panel-default">
       <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
          <div class="panel-heading">
            <h4 class="panel-title">
               Why Do I Need to Tag Items?
           </h4>
       </div>
   </a>

   <div id="collapse4" class="panel-collapse collapse">
    <div class="panel-body">  Tagging is very important because it allows users to 
        know where the items have been purchased. Tagging is the essence of this website.</div>
    </div>
</div>

<div class="panel panel-default">
   <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
      <div class="panel-heading">
        <h4 class="panel-title">
           What if I Can't Find the Exact Item?
       </h4>
   </div>
</a>

<div id="collapse5" class="panel-collapse collapse">
    <div class="panel-body">   That’s okay, just find an item that is as possible. This site 
        is for fashion inspiration after all.</div>
    </div>
</div>


<div class="panel panel-default">
   <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
      <div class="panel-heading">
        <h4 class="panel-title">
           Can I Promote My Products Here?
       </h4>
   </div>
</a>

<div id="collapse6" class="panel-collapse collapse">
    <div class="panel-body">  Yes! Post a picture of the outfit then you can link the outfit 
        by using our custom link tab. You then will be required to provide the type of clothing 
        it is, the brand, the price, and copying and pasting the link from the website it comes 
        from.</div>
    </div>
</div>
</div> <!-- End Panel Group --> 

</div> <!-- End Column --> 

<div class="col-md-5 col-xs-12">

<h4 class="text-center">Example</h4>
    <img class="img-responsive" src="img/explainpost.jpg"> 
</div> <!-- End Column --> 
</div> <!-- End Row -->
<br>  <br> <br>


<form enctype="multipart/form-data" method = "post" class="form-horizontal">
    <fieldset>
        <div class="row">
            <div class="col-md-4 col-xs-12">

                <div class="outfit-item-card">
                    <div class="outfit-item-interior">

                        <script type="text/javascript">
                            $(document).ready(function() {
                                $.uploadPreview({
                                    input_field: "#image-upload",
                                    preview_box: "#image-preview",
                                    label_field: "#image-label"
                                });
                            });
                        </script>

                        <div id="image-preview">
                            <label for="image-upload" id="image-label">Upload Outfit</label>
                            <input type="file" name="image" id="image-upload" required=""/>
                        </div>

                        <br> 

                        <div class="form-group">
                            <div class="col-xs-12"> 
                                <textarea class="form-control" id="styled" name="desc" placeholder="Description..."></textarea>
                            </div>
                        </div>

                        <br> 

                        <h4 class="text-center">Tagged Items</h4>

                        <div id = "taggedItems" class="row tagged-item-list">

                        </div> <!-- End Tagged Item List --> 


                        <!-- Button modal fullscreen -->
                        <div class="text-center">


                            <span class="visible-xs">
                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" style="background-color:black; margin-top:8px;" data-target="#modal-fullscreen">
                                    TAG ITEMS
                                </button>
                            </span>

                        </div> 
                        <br>
                    </div> <!-- End  Outfit Item Interior --> 
                </div> <!-- End Outfit Item Card --> 
            </div> <!-- End Row --> 



            <?php include("itemsearch.php"); ?> 

            <div class="row">
                <div class="col-xs-12">
                    <br> <br> 
                    <div class="text-center" onclick="saveItems();"> 

                    <input id="submit" name="submit" type="image" value="Submit Outfit" class="btn btn-md btn-default" alt="Submit Outfit" onclick="saveItems();"></button> 
                       <!-- <input id="submit" type="image" name="submit" value="submit" src="vendor/custom-icons/post-upload.png" class="outfit-item-checked" onclick="saveItems();" alt="submit"> --> 
                    </div>
                </div> <!-- End  Column --> 
            </div> <!-- End Row --> 

        </fieldset>
    </form>

    <script>
        document.getElementById('query').onkeypress = function(e){
            if (!e) e = window.event;
            var keyCode = e.keyCode || e.which;
            if (keyCode == '13'){
                $('#searchbutton').trigger('click');
                return false;
            }
        }
    </script>




    <?php include("footer.php"); ?> 