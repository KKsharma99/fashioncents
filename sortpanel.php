<!-- SORT BUTTON ON MOBILE --> 
<?php if(strpos($_SERVER['PHP_SELF'],'index.php') !== false) { ?>
<button type="button" id="fixedsort" onclick="openNav()" class="btn btn-md fixed-sort-btn visible-xs" style="background-color: #c79730;">
  <!-- <img height="18px" style="margin-top:10px; margin-bottom:10px; margin-left: 5px; margin-right: 5px;" src="vendor/custom-icons/funnel-white.png"> --> 
  <span height="18px" style="margin-top:15px; margin-bottom:15px; margin-left: 2px; margin-right: 2px; letter-spacing: 0.8; color: white;">SORT</span>
</button>
<?php } ?>

<!-- SORTING PANEL -->
<form method="GET" action="index.php"> 
<div id="sortpanel" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>



  <div style="padding-left:15px; padding-right:15px; color: white;"> 
    <div class="text-left"> 
    <h2>SORT</h2>
    </div> 



    <h4>Gender</h4>

    <div class="control-group" name="gender">
      <label class="control control--radio">All
        <input type="radio" name="gender" value="All" checked="checked">
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">Male
        <input type="radio" name="gender" value="Male"/>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">Female
        <input type="radio" name="gender" value="Female"/>
        <div class="control__indicator"></div>
      </label>
    </div>

    <h4>Type</h4>

    <div class="control-group" name="type" id="genderradio">
      <label class="control control--radio">All
        <input type="radio" name="type" value="All" checked="checked"/>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">Community
        <input type="radio" name="type" value="Community"/>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">Celebrity
        <input type="radio" name="type" value="Celebrity"/>
        <div class="control__indicator"></div>
      </label>
    </div>


    <h4>Outfit Category</h4>
    
    <label class="control control--checkbox">Formal
      <input type="checkbox" name = "category1" value="Formal"/>
      <div class="control__indicator"></div>
    </label>
    <label class="control control--checkbox">Casual
      <input type="checkbox" name = "category2" value="Casual"/>
      <div class="control__indicator"></div>
    </label>


    <h4>Feed Type</h4>
    
    <div class="control-group" name = "feed">
      <label class="control control--radio">Newest
        <input type="radio" name="feed" value="Newest" checked="checked"/>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">Featured
        <input type="radio" name="feed" value="Featured"/>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">Popular This Week
        <input type="radio" name="feed" value="PopularWeek"/>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">Popular This Month
        <input type="radio" name="feed" value="PopularMonth"/>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">Popular This Year
        <input type="radio" name="feed" value="PopularYear"/>
        <div class="control__indicator"></div>
      </label>
      <label class="control control--radio">Popular All Time
        <input type="radio" name="feed" value="PopularAll"/>
        <div class="control__indicator"></div>
      </label>
    </div>

  </div>
  <br> 
  <div class="text-center"> 
    <button class="btn btn-md smoothbutton btn-secondary" style="margin-bottom:25px;">SUBMIT</button>
    <br> 
  </div>

</div> <!-- End Inner Sort Panel --> 
</form>
<!-- The Script Below Opens the Sorting Panel --> 

<script>
  function openNav() {
    document.getElementById("sortpanel").style.width = "200px";
  }

  function closeNav() {
    document.getElementById("sortpanel").style.width = "0";
  }
</script>