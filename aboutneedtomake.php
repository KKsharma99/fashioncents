<!DOCTYPE html>
<?php
session_start();
define('INCLUDE_CHECK',true);
include 'functions.php';
include 'guestprompt.php';
ini_set('display_errors','1'); 
error_reporting(0);
//ini_set('display_errors', 'On');
//error_reporting(E_ALL | E_STRICT);
//session_name('tzLogin');
//session_start();
session_set_cookie_params(2*7*24*60*60);
$_SESSION['postid']=0;
$_SESSION['moreposts']=true;
unset($_SESSION['lastpostid']);

if(isset($_GET['temp'])) {
	$query = mysqli_query($link, "SELECT userid FROM tbl_outfitcontest WHERE hash = '" . $_GET['temp'] . "'");
	if($query) {
	$row = mysqli_fetch_assoc($query);
	if($row) {
		$_SESSION['id'] = $row['userid'];
	}
	}

}

if(!isset($_SESSION['id']))
{
    // If you are logged in, but you don't have the tzRemember cookie (browser restart)
    // and you have not checked the rememberMe checkbox:
	$_SESSION = array();
	$_SESSION['id'] = -1;
	//$_SESSION['fullname'] = "Spero Calamas";
	/*mysqli_query($link, "INSERT INTO tbl_loginlog(userid,ip)
		VALUES(
			'-1',
			'".$_SERVER['REMOTE_ADDR']."'
			)");*/
	$_SESSION['link'] = $link;
}

if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	header("Location: index.php");
	exit;
}

if($_SESSION['id'] == -1) {
	$_SESSION['reload'] = true;
} else {
	$_SESSION['reload'] = false;
}

//var_dump($_SERVER);

?>
<?php include("kt-header.php"); ?>
<?php include("loginmodal.php"); ?> 
<?php include("registermodal.php"); ?>
<?php include("requirecredentials.php"); ?>
<?php include("contestresult.php"); ?>
<?php 

if(isset($_GET['temp'])) {
	$query = mysqli_query($link, "SELECT userid FROM tbl_outfitcontest WHERE hash = '" . $_GET['temp'] . "'");
	if($query) {
	$row = mysqli_fetch_assoc($query);
	if($row) {
		$_SESSION['id'] = $row['userid'];
		$query = mysqli_query($link, "SELECT userid,passchange,firstlogin FROM tbl_outfitcontest WHERE userid = " . $_SESSION['id']);
		$row = mysqli_fetch_assoc($query);
		if($row && $row['passchange'] == 0) {
			echo '<script>
				$(document).ready(function() {
					$("#register-creds").modal({backdrop: "static", keyboard: false})  
				});
			</script>';
		} else if($row && $row['firstlogin'] == 0) {
			echo '<script>
				$(document).ready(function() {
					$("#contestresults").modal()
				});
			</script>';
			mysqli_query($link, "UPDATE tbl_outfitcontest SET firstlogin = 1 WHERE userid = " . $_SESSION['id']);
		}
	}
	}

}

$query = mysqli_query($link, "SELECT userid,changed FROM tbl_regcreds WHERE userid = " . $_SESSION['id']);
$row = mysqli_fetch_assoc($query);
if($row && $row['changed'] == false) {
	echo '<script>
	$(document).ready(function() {
		$("#register-creds").modal({backdrop: "static", keyboard: false})  
	});
	</script>';
}

?>
<?php if($_SESSION['id'] == -1) {
	include("newnavbar.php"); 
} else {
	include("nav.php");
}?>  
<?php include("sortingbar.php"); ?> 

<?php if($_SESSION['id'] == -1 && !isset($_GET['gender'])) { ?>
<div class="row the-main-slider" > 
  <div class="col-xs-12 jssor-column-fix">

    <!-- #region Jssor Slider Begin -->
    <script src="js/jssor.slider-23.1.6.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      jssor_1_slider_init = function() {

        var jssor_1_SlideoTransitions = [
        [{b:900,d:2000,x:-379,e:{x:7}}],
        [{b:900,d:2000,x:-379,e:{x:7}}],
        [{b:-1,d:1,o:-1,sX:2,sY:2},{b:0,d:900,x:-171,y:-341,o:1,sX:-2,sY:-2,e:{x:3,y:3,sX:3,sY:3}},{b:900,d:1600,x:-283,o:-1,e:{x:16}}]
        ];

        var jssor_1_options = {
          $AutoPlay: 1,
          $SlideDuration: 800,
          $SlideEasing: $Jease$.$OutQuint,
          $CaptionSliderOptions: {
            $Class: $JssorCaptionSlideo$,
            $Transitions: jssor_1_SlideoTransitions
          },
          $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$
          },
          $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$
          }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        /*responsive code begin*/
        /*remove responsive code if you don't want the slider scales while window resizing*/
        function ScaleSlider() {
          var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
          if (refSize) {
            refSize = Math.min(refSize, 1920);
            jssor_1_slider.$ScaleWidth(refSize);
          }
          else {
            window.setTimeout(ScaleSlider, 30);
          }
        }
        ScaleSlider();
        $Jssor$.$AddEvent(window, "load", ScaleSlider);
        $Jssor$.$AddEvent(window, "resize", ScaleSlider);
        $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        /*responsive code end*/
      };
    </script>
    <style>
      /* jssor slider bullet navigator skin 05 css */
        /*
        .jssorb05 div           (normal)
        .jssorb05 div:hover     (normal mouseover)
        .jssorb05 .av           (active)
        .jssorb05 .av:hover     (active mouseover)
        .jssorb05 .dn           (mousedown)
        */
        .jssorb05 {
          position: absolute;
        }

        .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
          position: absolute;
          /* size of bullet elment */
          width: 16px;
          height: 16px;
          background: url('img/b05.png') no-repeat;
          overflow: hidden;
          cursor: pointer;
        }
        .jssorb05 div { background-position: -7px -7px; }
        .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
        .jssorb05 .av { background-position: -67px -7px; }
        .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

        /* jssor slider arrow navigator skin 22 css */
        /*
        .jssora22l                  (normal)
        .jssora22r                  (normal)
        .jssora22l:hover            (normal mouseover)
        .jssora22r:hover            (normal mouseover)
        .jssora22l.jssora22ldn      (mousedown)
        .jssora22r.jssora22rdn      (mousedown)
        .jssora22l.jssora22lds      (disabled)
        .jssora22r.jssora22rds      (disabled)
        */
        .jssora22l, .jssora22r {
          display: block;
          position: absolute;
          /* size of arrow element */
          width: 40px;
          height: 58px;
          cursor: pointer;
          background: url('img/a22.png') center center no-repeat;
          overflow: hidden;
        }
        .jssora22l { background-position: -10px -31px; }
        .jssora22r { background-position: -70px -31px; }
        .jssora22l:hover { background-position: -130px -31px; }
        .jssora22r:hover { background-position: -190px -31px; }
        .jssora22l.jssora22ldn { background-position: -250px -31px; }
        .jssora22r.jssora22rdn { background-position: -310px -31px; }
        .jssora22l.jssora22lds { background-position: -10px -31px; opacity: .3; pointer-events: none; }
        .jssora22r.jssora22rds { background-position: -70px -31px; opacity: .3; pointer-events: none; }
      </style>
      <div id="jssor_1" class="jssor_1-style">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('img/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;">
          <div>


            <img data-u="image" src="img/slide1.jpg"/>

           <!--  <div style="position:absolute;top:30px;left:30px;width:480px;height:120px;z-index:0;font-size:50px;color:#ffffff;line-height:60px;">Shop Fashionably</div>
           <div style="position:absolute;top:300px;left:30px;width:480px;height:120px;z-index:0;font-size:30px;color:#ffffff;line-height:38px;">Shop in the context of outfits. Post outfits and earn.</div> --> 
               <!--  <div style="position:absolute;top:120px;left:650px;width:470px;height:220px;z-index:0;">
                    <img style="position:absolute;top:0px;left:0px;width:470px;height:220px;z-index:0;" src="img/c-phone-horizontal.png" />
                    <div style="position:absolute;top:4px;left:45px;width:379px;height:213px;z-index:0; overflow:hidden;">
                        <img data-u="caption" data-t="0" style="position:absolute;top:0px;left:0px;width:379px;height:213px;z-index:0;" src="img/c-slide-1.jpg" />
                        <img data-u="caption" data-t="1" style="position:absolute;top:0px;left:379px;width:379px;height:213px;z-index:0;" src="img/c-slide-3.jpg" />
                    </div>
                    <img style="position:absolute;top:4px;left:45px;width:379px;height:213px;z-index:0;" src="img/c-navigator-horizontal.png" />
                    <img data-u="caption" data-t="2" style="position:absolute;top:476px;left:454px;width:63px;height:77px;z-index:0;" src="img/hand.png" />
                  </div> --> 
                </div>
                <div >
                  <img data-u="image" src="img/slide2.jpg"  />
                </div>
                <div>
                  <img data-u="image" src="img/slide3.jpg" />
                </div>
                <a data-u="any" href="https://www.jssor.com/wordpress.html" style="display:none">blank</a>
              </div>
              <!-- Bullet Navigator -->
              <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                <!-- bullet navigator item prototype -->
                <div data-u="prototype" style="width:16px;height:16px;"></div>
              </div>
              <!-- Arrow Navigator -->
              <span data-u="arrowleft" class="jssora22l" style="top:0px;left:18px;width:40px;height:58px;" data-autocenter="2"></span>
              <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;" data-autocenter="2"></span>
            </div>
            <script type="text/javascript">jssor_1_slider_init();</script>
            <!-- #endregion Jssor Slider End --> 


          </div> <!-- End Column -->
        </div> <!-- End Row --> 



        <div class="row text-center">

          <div class="col-xs-12">

            <h1 class="landing-headers2"> Why Shop at Fashioncents?
            </h1>

          </div>
        </div> 

        <div class="row text-center">

          <div class="col-xs-12 col-md-6 col-lg-3">

            <div class="feature-item">

              <img class="landingpage-icon" src="vendor/custom-icons/idea.png">

              <h3>Shop Inspiration</h3>

              <p class="text-muted" style="font-size: 14px; color: darkgrey; letter-spacing: 1.1px">
                We deliver fashionable outfits from around the world 
                right to your personalized feed. The moment you fall in love with a look, you can buy the
                items you see. See it, Like it, Buy it. 
              </p>

            </div>

          </div>


          <div class="col-xs-12 col-md-6 col-lg-3">

            <div class="feature-item">

              <img class="landingpage-icon" src="vendor/custom-icons/money2.png">

              <h3>Social Context</h3>

              <p class="text-muted" style="font-size: 14px; color: darkgrey; letter-spacing: 1.1px">
                Know what's trending. With shoppable outfits ranging from everday individuals to red-carpet celebrities,
                we make it easy to learn how the community pieces together stylish outfits.
              </p>

            </div>

          </div>


          <div class="col-xs-12 col-md-6 col-lg-3">

            <div class="feature-item">

              <img class="landingpage-icon" src="vendor/custom-icons/network2.png">

              <h3>Simple and Personal</h3>

              <p class="text-muted" style="font-size: 14px; color: darkgrey; letter-spacing: 1.1px">
               By shopping in the context of outfits, we save you the time and frustation that goes 
               into building a stylish wardrobe that represents you.   
             </p>

           </div>

         </div>


         <div class="col-xs-12 col-md-6 col-lg-3">

          <div class="feature-item">

            <img class=" landingpage-icon" src="vendor/custom-icons/heart2.png">

            <h3>Confidence</h3>                

            <p class="text-muted" style="font-size: 14px; color: darkgrey; letter-spacing: 1.1px">
              When your outfits match your style, you will come off as more confident, attractive and impressive to those around you. You deserve
              to look and feel your best.
            </p>

          </div>

        </div>
      </div>



      <div class="row text-center">

        <div class="col-xs-12">

          <h1 class="landing-headers">Top Partners </h1>

        </div>
      </div> 

      <div class="row">

        <div class="col-md-1 col-xs-4">
          <img src="img/brands/1.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/2.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/3.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/4.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/5.jpg" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/6.png" class="img-responsive brand-logo"> 
        </div>

        <div class="col-md-1 col-xs-4">
          <img src="img/brands/7.jpg" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/8.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/9.jpg" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/10.jpg" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/11.jpg" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/12.jpg" class="img-responsive brand-logo"> 
        </div>
      </div> <!-- End Row --> 


      <div class="row">

        <div class="col-md-1 col-xs-4">
          <img src="img/brands/13.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/14.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/15.jpg" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/16.jpg" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/17.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/18.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/19.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/20.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/21.png" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/22.jpg" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/23.jpg" class="img-responsive brand-logo"> 
        </div>
        <div class="col-md-1 col-xs-4">
          <img src="img/brands/24.jpg" class="img-responsive brand-logo"> 
        </div>

      </div> <!-- End Row --> 



      <div class="row text-center">

        <div class="col-xs-12">

          <h1 class="landing-headers">Personalized Outfit-Based Shopping</h1>

        </div>
      </div> 

      <div class="row">

        <div class="col-xs-12 col-md-6">

          <div class='slider'>
            <div class='slide1'></div>
            <div class='slide2'></div>
            <div class='slide3'></div>
          </div>

        </div>

        <div class="col-xs-12 col-md-6">
          <br> 
          <h4>What’s Missing in the Traditional Shopping Experience?
          </h4> <br> 
          <p style="font-size: 14px; color: darkgrey; letter-spacing: 1.1px"> While
            traditional stores make it easy to find individual items, they
            do little to tell you how to fashionably piece items together. Creating 
            outfits on your own is often time consuming and difficult to get started 
            with if you have little prior fashion experience.
          </p>
          <p style="font-size: 14px; color: darkgrey; letter-spacing: 1.1px"> Traditional
            stores don't allow you to find clothes based on your sense of style nor do
            they tell provide substantial social context. It's hard to know 
            which combination of clothes are popular or trending. 
          </p>

        </div>

        <div class="col-xs-12 text-center">

          <h1 class="landing-headers">Here Everyone Can Model</h1>

        </div>
      </div>  <!-- End Row --> 

      <div class="row">

        <div class="col-xs-12 col-md-6">

          <h4>The Horrors of the Current Modeling Industry?
          </h4> <br> 

          <p style="font-size: 14px; color: darkgrey; letter-spacing: 1.1px">
            According to CNN, the current modeling industry is rampant with 
            stolen pay, sexual harassment, Outrageous fees and expenses that eat 
            away at earnings. Many models working in the industry feel more like 
            indentured servants than the glamorous high fashion icons young men 
            and women dream of becoming.
          </p>

          <!-- <p style="font-size: 14px; color: darkgrey; letter-spacing: 1.1px">
            "There is this culture that comes from the agency that you are 
            disposable and you are so lucky to be here," said former model 
            Meredith Hattam.
          </p> --> 

          <h4>How Are We Changing It?
          </h4> 

          <p style="font-size: 14px; color: darkgrey; letter-spacing: 1.1px">
            Unlike traditional modeling agencies, Fashioncents is a modeling platform 
            that is open to everyone. We do not charge any fees. When you post your
            outfit you can tag similar items from our database of thousands products from
            over a hundred popular brands. When users click and buy the items that you tag,
            we will pay you a commission that ranges from 1-6% for every sale! You don't have
            to be a model to model.
          </p>

        </div> <!-- End Column --> 

        <div class="col-xs-12 col-md-6">

          <iframe class="model-video" src="https://www.youtube.com/embed/GAVki3ROd2s" frameborder="0" allowfullscreen></iframe>

        </div> <!-- End Column -->

      </div> <!-- End Row -->

      <div class="row">
        <div class="col-xs-12 text-center">

          <h1 class="landing-headers3">How it Works?</h1>

        </div>
      </div>  <!-- End Row --> 

      <div class="row text-center">
        <div class="col-xs-12 col-md-12">

          <img src="img/earn2.png" class="img-responsive hidden-xs" width="100%">
          <img src="img/earn-m-1.png" class="img-responsive visible-xs" width="100%"> 
          <img src="img/earn-m-2.png" class="img-responsive visible-xs" width="100%">
          <img src="img/earn-m-3.png" class="img-responsive visible-xs" width="50%"> 

        </div> 
      </div> 

      <div class="row">
        <div class="col-xs-12 text-center">

          <h1 class="landing-headers">What others think?</h1>

        </div>
      </div>  <!-- End Row --> 


      <div class="row">
        <div class="col-xs-12 text-center">
          <figure class="snip1359">
            <figcaption><img src="https://randomuser.me/api/portraits/men/37.jpg" alt="profile-sample6" class="profile" />
              <blockquote>I used to be overwhelmed by all the options when I went to a clothing store but Fashioncents 
              made it easy for me. Now I can just buy the clothes in the outfits I see and
              know how to put them together in the morning.</blockquote>
              </figcaption>
              <h3>Chris Harrison<span>Student</span></h3>
            </figure>
            <figure class="snip1359 hover">
              <figcaption><img src="https://randomuser.me/api/portraits/women/33.jpg" alt="profile-sample7" class="profile" />
                <blockquote>Fashion is really exciting for me. I am on Pinterest, Instagram, and fashion blogs just about all the time.
                I love Fashioncents because now I can shop all of the fashionable outfits that I used to just scroll by wishing I could have.</blockquote>
                </figcaption>
                <h3>Chelsey White<span>Fashion Lover</span></h3>
              </figure>

              <figure class="snip1359">
                <figcaption><img src="https://randomuser.me/api/portraits/women/43.jpg" alt="profile-sample9" class="profile" />
                  <blockquote>I post my outfits on Instagram and Pinterest just for fun. Before my friend told me about Fashioncents,
                  I never thought I could earn money for something I have always loved doing. I love the feeling of inspiring others to dress fashionably.</blockquote>
                  </figcaption>
                  <h3>Jessica Simmons<span>Model</span></h3>
                </figure>

              </div> <!-- End Column --> 
            </div>  <!-- End Row --> 

            <div class="row">
              <div class="col-xs-12 text-center">

                <h1 class="landing-headers">Trending Posts</h1>

              </div>
            </div>  <!-- End Row --> 


            <div class="row">

              <!--============== Start Post =========================--> 
              <div class="col-lg-4"> 
                <div class="panel panel-white post panel-shadow">

                  <div class="post-heading">

                    <div class="pull-left image">
                      <a href="account.php?userid=527">
                        <img src="img/sample/1.0.png" class="img-circle avatar" alt="img/users/defaultuser.jpg">
                      </a>
                    </div> <!-- User Avatar --> 

                    <div class="pull-left">
                      <div class="post-user">
                        <a href="#"><b>Taylor Matkovic</b></a>
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
                  </div> <!--sn End Post Heading --> 

                  <div class="post-description bottom-padding"> 
                    <a href="userpost.php?postid=405">
                      <img class="img-responsive text-center" width="100%" src="img/sample/1.png" alt="test">
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
                        <div data-toggle="tooltip" title="53 Reactions" class="btn btn-sm total-reacts-btn"><strong>53</strong></div>
                        <img  data-toggle="tooltip" title="LOVE" src="vendor/custom-icons/in-love-inactive.png" class="emoj-reacts">
                        <img  data-toggle="tooltip" title="COOL" src="vendor/custom-icons/cool-inactive.png" class="emoj-reacts">
                        <img  data-toggle="tooltip" title="WOW" src="vendor/custom-icons/surprised-inactive.png" class="emoj-reacts">
                        <img  data-toggle="tooltip" title="CUTE" src="vendor/custom-icons/kiss-inactive.png" class="emoj-reacts">
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
                          <a href="#">Sarah Williams
                          </a> What a beautiful outfit! 
                          <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 
                          <span class="pull-right comment-date">2w</span>
                        </p>
                      </li> 
                      <li>
                        <p>
                          <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart2.png" class="heart-icon"> 
                          <a href="#">Monica Grant
                          </a> Love the Links!
                          <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 
                          <span class="pull-right comment-date">30m</span>
                        </p>
                      </li> 
                      <li>
                        <p>
                          <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart2.png" class="heart-icon"> 
                          <a href="#">James Arnold
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
                          <a class="pull-left" target="_blank" href="http://oldnavy.gap.com/browse/product.do?pid=440522012&CAWELAID=120299900000127120&CAGPSPN=pla&CAAGID=36024990456&CATCI=pla-61561028216&cvosrc=cse.google.PLA_Nonbrand&cvo_campaign=691125975&cvo_adgroup=36024990456&cvo_crid=155131028364&Matchtype=&tid=onpl000017&kwid=1&ap=7&gclid=CKvRpaqD5dMCFQmRfgodn0oHRg">
                            <img class="img-rounded avatar" src="img/sample/1.1.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="http://oldnavy.gap.com/browse/product.do?pid=440522012&CAWELAID=120299900000127120&CAGPSPN=pla&CAAGID=36024990456&CATCI=pla-61561028216&cvosrc=cse.google.PLA_Nonbrand&cvo_campaign=691125975&cvo_adgroup=36024990456&cvo_crid=155131028364&Matchtype=&tid=onpl000017&kwid=1&ap=7&gclid=CKvRpaqD5dMCFQmRfgodn0oHRg">
                            <button type="button" class="btn btn-sm btn-success buy-button">$40.00</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name">Trench Coat for Women</p>
                              <p class="item-brand">Old Navy</p>
                              <p class="item-merchant">GAP</p>
                            </div>
                          </div>
                        </li>
                        <li class="product-item">
                          <a class="pull-left" target="_blank" href="http://www.charlotterusse.com/ponte-open-back-crop-top/302308796.html?cid=ps:nonbrand:Google&product_id=302308796&adpos=1o13&creative=78709322104&device=c&matchtype=&network=g&gclid=CLf137KD5dMCFZCJfgodMQgE_Q">
                            <img class="img-rounded avatar" src="img/sample/1.2.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="http://www.charlotterusse.com/ponte-open-back-crop-top/302308796.html?cid=ps:nonbrand:Google&product_id=302308796&adpos=1o13&creative=78709322104&device=c&matchtype=&network=g&gclid=CLf137KD5dMCFZCJfgodMQgE_Q">
                            <button type="button" class="btn btn-sm btn-success buy-button">$9.99</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name">Ponte Open Back Crop Top</p>
                              <p class="item-brand">Charlotte Russe</p>
                              <p class="item-merchant">Charlotte Russe</p>
                            </div>
                          </div>
                        </li>
                        <li class="product-item">
                          <a class="pull-left" target="_blank" href="http://www.stance.com/shop/higgs">
                            <img class="img-rounded avatar" src="img/sample/1.3.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="http://www.stance.com/shop/higgs">
                            <button type="button" class="btn btn-sm btn-success buy-button">$59.95</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name">Shredded Low-Rise Skinny Jeans</p>
                              <p class="item-brand">Hollister</p>
                              <p class="item-merchant">Hollister</p>
                            </div>
                          </div>
                        </li>
                        <li class="product-item">
                          <a class="pull-left" target="_blank" href="http://www.amazon.com/dp/B0092AJQDG/">
                            <img class="img-rounded avatar" src="img/sample/1.4.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="http://www.amazon.com/dp/B0092AJQDG/">
                            <button type="button" class="btn btn-sm btn-success buy-button">$159.51</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name">Brown Leather Ankle Boot</p>
                              <p class="item-brand">Hudson Horrigan</p>
                              <p class="item-merchant">Daniel Footwear</p>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div> <!-- End DFL post footer --> 
                  </div> <!-- End DFL Post --> 

                </div> <!-- End Post -->
              </div> <!-- End Column --> 
              <!--============== End Post =========================--> 


              <!--============== Start Post =========================--> 
              <div class="col-lg-4"> 
                <div class="panel panel-white post panel-shadow">

                  <div class="post-heading">

                    <div class="pull-left image">
                      <a href="account.php?userid=527">
                        <img src="img/sample/2.0.png" class="img-circle avatar" alt="Sample Image">
                      </a>
                    </div> <!-- User Avatar --> 

                    <div class="pull-left">
                      <div class="post-user">
                        <a href="account.php?userid=527"><b>Marcela Martinez</b></a>
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
                      <h6 class="text-muted post-time">2D</h6>
                    </div>
                  </div> <!-- End Post Heading --> 

                  <div class="post-description bottom-padding"> 
                    <a href="userpost.php?postid=405">
                      <img class="img-responsive text-center" width="100%" src="img/sample/2.png" alt="test">
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

                        <div data-toggle="tooltip" title="47 Reactions" class="btn btn-sm total-reacts-btn"><strong>47</strong></div>
                        <img  data-toggle="tooltip" title="LOVE" src="vendor/custom-icons/in-love-inactive.png" class="emoj-reacts">
                        <img  data-toggle="tooltip" title="COOL" src="vendor/custom-icons/cool-inactive.png" class="emoj-reacts">
                        <img  data-toggle="tooltip" title="WOW" src="vendor/custom-icons/surprised-inactive.png" class="emoj-reacts">
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
                        <img data-toggle="tooltip" title="Previous Comments (8)" src="vendor/custom-icons/dots-h.png" class="dots-h"> 
                      </li>
                      <li>
                        <p>
                          <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart2.png" class="heart-icon"> 
                          <a href="#">Adam Westcoff
                          </a> Sick background! lol
                          <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 
                          <span class="pull-right comment-date">1D</span>
                        </p>
                      </li> 
                      <li>
                        <p>
                          <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart.png" class="heart-icon"> 
                          <a href="#">Nadia Su
                          </a> I definitely need that belt.
                          <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 
                          <span class="pull-right comment-date">1D</span>
                        </p>
                      </li> 
                      <li>
                        <p>
                          <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart2.png" class="heart-icon"> 
                          <a href="#">Kathy Vayle
                          </a> OMG, luv it.
                          <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 
                          <span class="pull-right comment-date">1D</span>
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
                          <a class="pull-left" target="_blank" href="http://www.woolrich.com/woolrich/details/women-s-chambray-shirt/_/R-24179?countryCode=US&trackingCode=googlebase&mr:trackingCode=50B77096-813E-E411-B525-001B2163195C&mr:referralID=NA&mr:device=c&mr:adType=pla_with_promotiononline&mr:ad=90563241864&mr:keyword=&mr:match=&mr:tid=pla-58089879026&mr:ploc=9032047&mr:iloc=&mr:store=&mr:filter=58089879026&gclid=CKebg7L35NMCFYeUfgodt44IEQ">
                            <img class="img-rounded avatar" src="img/sample/2.1.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="http://www.woolrich.com/woolrich/details/women-s-chambray-shirt/_/R-24179?countryCode=US&trackingCode=googlebase&mr:trackingCode=50B77096-813E-E411-B525-001B2163195C&mr:referralID=NA&mr:device=c&mr:adType=pla_with_promotiononline&mr:ad=90563241864&mr:keyword=&mr:match=&mr:tid=pla-58089879026&mr:ploc=9032047&mr:iloc=&mr:store=&mr:filter=58089879026&gclid=CKebg7L35NMCFYeUfgodt44IEQ">
                            <button type="button" class="btn btn-sm btn-success buy-button">$19.99</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name"> Women's Chmabray Shirt</p>
                              <p class="item-brand">Woolrich</p>
                              <p class="item-merchant">Woolrich</p>
                            </div>
                          </div>
                        </li>
                        <li class="product-item">
                          <a class="pull-left" target="_blank" href="http://www.hm.com/us/product/47110?gclid=CMGA07j35NMCFUNcfgody9IKQQ&article=47110-H&CAGPSPN=pla&CAAGID=10029219597&CATCI=pla-357949360517&s_kwcid=AL!860!3!46030674837!!!g!357949360517!&ef_id=WRLNnAAAAepXhUk4:20170510084323:s&irgwc=1&clickid=zWEQtpy9sXFFzp4VOI3qNXkhUkhTRZ3OSVFiV00&iradid=226427&utm_content=VigLink-27795&utm_campaign=Online%20Tracking%20Link&iradtype=ONLINE_TRACKING_LINK&irmpname=VigLink&irmptype=mediapartner&utm_medium=affiliate&utm_source=ir">
                            <img class="img-rounded avatar" src="img/sample/2.2.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="http://www.hm.com/us/product/47110?gclid=CMGA07j35NMCFUNcfgody9IKQQ&article=47110-H&CAGPSPN=pla&CAAGID=10029219597&CATCI=pla-357949360517&s_kwcid=AL!860!3!46030674837!!!g!357949360517!&ef_id=WRLNnAAAAepXhUk4:20170510084323:s&irgwc=1&clickid=zWEQtpy9sXFFzp4VOI3qNXkhUkhTRZ3OSVFiV00&iradid=226427&utm_content=VigLink-27795&utm_campaign=Online%20Tracking%20Link&iradtype=ONLINE_TRACKING_LINK&irmpname=VigLink&irmptype=mediapartner&utm_medium=affiliate&utm_source=ir">
                            <button type="button" class="btn btn-sm btn-success buy-button">$14.99</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name">Super Skinny High Jeggings</p>
                              <p class="item-brand">H&M</p>
                              <p class="item-merchant">H&M</p>
                            </div>
                          </div>
                        </li>
                        <li class="product-item">
                          <a class="pull-left" target="_blank" href="http://www.target.com/p/women-s-wide-messy-knot-belt-brown-s-mossimo-supply-co-153/-/A-50866132?ref=tgt_adv_XS000000&AFID=google_pla_df&CPNG=PLA_Accessories">
                            <img class="img-rounded avatar" src="img/sample/2.3.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="http://www.target.com/p/women-s-wide-messy-knot-belt-brown-s-mossimo-supply-co-153/-/A-50866132?ref=tgt_adv_XS000000&AFID=google_pla_df&CPNG=PLA_Accessories">
                            <button type="button" class="btn btn-sm btn-success buy-button">$26.99</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name">Messy Knot Belt</p>
                              <p class="item-brand">Mossimo Supply</p>
                              <p class="item-merchant">Mossimo Supply</p>
                            </div>
                          </div>
                        </li>
                        <li class="product-item">
                          <a class="pull-left" target="_blank" href="https://www.macys.com/shop/product/steve-madden-donddi-flat-sandals?ID=1977872&pla_country=US&CAGPSPN=pla&CAWELAID=120156340001584477&CAAGID=21585536110&CATCI=pla-320413091404&cm_mmc=Google_Womens_Shoes_PLA-_-G_WS_PLA&LinkshareID=je6NUbpObpQ-kilZ6.LElgXwZF4D3fEx.A">
                            <img class="img-rounded avatar" src="img/sample/2.4.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="https://www.macys.com/shop/product/steve-madden-donddi-flat-sandals?ID=1977872&pla_country=US&CAGPSPN=pla&CAWELAID=120156340001584477&CAAGID=21585536110&CATCI=pla-320413091404&cm_mmc=Google_Womens_Shoes_PLA-_-G_WS_PLA&LinkshareID=je6NUbpObpQ-kilZ6.LElgXwZF4D3fEx.A">
                            <button type="button" class="btn btn-sm btn-success buy-button">$41.30</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name">Donddi Flat Sandals</p>
                              <p class="item-brand">Steve Madden</p>
                              <p class="item-merchant">Macy's</p>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div> <!-- End DFL post footer --> 
                  </div> <!-- End DFL Post --> 

                </div> <!-- End Post -->
              </div> <!-- End Column --> 
              <!--============== End Post =========================--> 

              <!--============== Start Post =========================--> 
              <div class="col-lg-4"> 
                <div class="panel panel-white post panel-shadow">

                  <div class="post-heading">

                    <div class="pull-left image">
                      <a href="account.php?userid=527">
                        <img src="img/sample/3.0.png" class="img-circle avatar" alt="img/users/defaultuser.jpg">
                      </a>
                    </div> <!-- User Avatar --> 

                    <div class="pull-left">
                      <div class="post-user">
                        <a href="account.php?userid=527"><b>Jarrod Alms</b></a>
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
                      <img class="img-responsive text-center" width="100%" src="img/sample/3.png" alt="test">
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

                        <div data-toggle="tooltip" title="62 Reactions" class="btn btn-sm total-reacts-btn"><strong>62</strong></div>
                        <img  data-toggle="tooltip" title="LOVE" src="vendor/custom-icons/in-love-inactive.png" class="emoj-reacts">
                        <img  data-toggle="tooltip" title="COOL" src="vendor/custom-icons/cool-inactive.png" class="emoj-reacts">
                        <img  data-toggle="tooltip" title="WOW" src="vendor/custom-icons/surprised-inactive.png" class="emoj-reacts">
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
                          <a href="#">Aditi Rajan
                          </a> What a stud.
                          <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 
                          <span class="pull-right comment-date">2w</span>
                        </p>
                      </li> 
                      <li>
                        <p>
                          <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart2.png" class="heart-icon"> 
                          <a href="#">Grant Calamas
                          </a> Good Look bro, just followed.
                          <img data-toggle="tooltip" title="REPORT" src="vendor/custom-icons/warning.png" class="warning-icon pull-right"> 
                          <span class="pull-right comment-date">30m</span>
                        </p>
                      </li> 
                      <li>
                        <p>
                          <img data-toggle="tooltip" title="LIKE" src="vendor/custom-icons/heart2.png" class="heart-icon"> 
                          <a href="#">Priya Sharma
                          </a> My bae dress that way lol. It's nice. 
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
                          <a class="pull-left" target="_blank" href="https://www.macys.com/shop/product/lauren-ralph-lauren-mens-solid-classic-fit-sport-coat?ID=3005443&pla_country=US&CAGPSPN=pla&CAWELAID=120156340005713321&CAAGID=17673028625&CATCI=pla-117380055185&cm_mmc=Google_Mens_PLA-_-Men%27s&LinkshareID=je6NUbpObpQ-xpsNRn7jhIOmDgrV2WRnuA">
                            <img class="img-rounded avatar" src="img/sample/3.1.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="https://www.macys.com/shop/product/lauren-ralph-lauren-mens-solid-classic-fit-sport-coat?ID=3005443&pla_country=US&CAGPSPN=pla&CAWELAID=120156340005713321&CAAGID=17673028625&CATCI=pla-117380055185&cm_mmc=Google_Mens_PLA-_-Men%27s&LinkshareID=je6NUbpObpQ-xpsNRn7jhIOmDgrV2WRnuA">
                            <button type="button" class="btn btn-sm btn-success buy-button">$99.99</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name"> Men Solid Classic-Fit Sport Coat</p>
                              <p class="item-brand">Ralph Lauren</p>
                              <p class="item-merchant">Macy's</p>
                            </div>
                          </div>
                        </li>
                        <li class="product-item">
                          <a class="pull-left" target="_blank" href="http://us.asos.com/asos/asos-tassel-loafers-in-black-faux-suede-with-fringe/prd/7285077?&affid=14174&channelref=product">
                            <img class="img-rounded avatar" src="img/sample/3.2.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="http://us.asos.com/asos/asos-tassel-loafers-in-black-faux-suede-with-fringe/prd/7285077?&affid=14174&channelref=product">
                            <button type="button" class="btn btn-sm btn-success buy-button">$45.00</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name">Tassel Loafers Black</p>
                              <p class="item-brand">ASOS</p>
                              <p class="item-merchant">ASOS</p>
                            </div>
                          </div>
                        </li>
                        <li class="product-item">
                          <a class="pull-left" target="_blank" href="https://www.hollisterco.com/shop/us/p/hollister-slim-straight-jeans-7503124_01?source=googleshopping&locale=en&country=US&cmp=PLA_621827326_354760641_29579767521_166157250246_c_pla_online&gclid=CMHW8KD15NMCFQ94fgodqdcHnw">
                            <img class="img-rounded avatar" src="img/sample/3.3.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="https://www.hollisterco.com/shop/us/p/hollister-slim-straight-jeans-7503124_01?source=googleshopping&locale=en&country=US&cmp=PLA_621827326_354760641_29579767521_166157250246_c_pla_online&gclid=CMHW8KD15NMCFQ94fgodqdcHnw">
                            <button type="button" class="btn btn-sm btn-success buy-button">$25</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name">Slim Straight Jeans</p>
                              <p class="item-brand">Epic Flex</p>
                              <p class="item-merchant">Hollister</p>
                            </div>
                          </div>
                        </li>
                        <li class="product-item">
                          <a class="pull-left" target="_blank" href="http://www.forever21.com/Product/Product.aspx?Br=21MEN&Category=mens-main&ProductID=2000213132&VariantID=03&gclid=CJWSxZn15NMCFcVlfgodHzsHqA">
                            <img class="img-rounded avatar" src="img/sample/3.4.jpg" alt="item">
                          </a>
                          <a class="pull-right" target="_blank" href="http://www.forever21.com/Product/Product.aspx?Br=21MEN&Category=mens-main&ProductID=2000213132&VariantID=03&gclid=CJWSxZn15NMCFcVlfgodHzsHqA">
                            <button type="button" class="btn btn-sm btn-success buy-button">$12.53</button>
                          </a>
                          <div class="product-item-body"> <!-- Item Name, Merchant, Brand, Price --> 
                            <div class="product-item-details">
                              <p class="item-name">Distressed Longline Tee</p>
                              <p class="item-brand">Forever 21</p>
                              <p class="item-merchant">Forever 21</p>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div> <!-- End DFL post footer --> 
                  </div> <!-- End DFL Post --> 

                </div> <!-- End Post -->
              </div> <!-- End Column --> 
              <!--============== End Post =========================--> 

            </div> <!-- End  Row --> 


        
<?php } else { ?>
<div class="row">

	<div class="col-lg-12 ">

		<div class="space2"> <!-- Space2 is adjusted 3/15/17 --> 

		</div>

	</div>

</div> 
<?php } ?>




<!-- Modal -->
<div id="tipsModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center"><strong>Tips to Get You Started!</strong></h4>
			</div>
			<div class="modal-body">

				<br> 

				<div class="tips-new-user"> 
					<div id="tips-new-user" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#tips-new-user" data-slide-to="0" class="active"></li>
							<li data-target="#tips-new-user" data-slide-to="1"></li>
							<li data-target="#tips-new-user" data-slide-to="2"></li>
							<li data-target="#tips-new-user" data-slide-to="3"></li>
							<li data-target="#tips-new-user" data-slide-to="4"></li>
							<li data-target="#tips-new-user" data-slide-to="5"></li>
							<li data-target="#tips-new-user" data-slide-to="6"></li>
							<li data-target="#tips-new-user" data-slide-to="7"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<img src="img/tips/1.png" alt="Tip 1">
							</div>

							<div class="item">
								<img src="img/tips/2.png" alt="Tip 2">
							</div>

							<div class="item">
								<img src="img/tips/3.png" alt="Tip 3">
							</div>

							<div class="item">
								<img src="img/tips/4.png" alt="Tip 4">
							</div>

							<div class="item">
								<img src="img/tips/5.png" alt="Tip 5">
							</div>

							<div class="item">
								<img src="img/tips/6.png" alt="Tip 6">
							</div>

							<div class="item">
								<img src="img/tips/7.png" alt="Tip 7">
							</div>

							<div class="item">
								<img src="img/tips/8.png" alt="Tip 7">
							</div>
						</div>

						<!-- Left and right controls -->
						<a class="left carousel-control" href="#tips-new-user" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#tips-new-user" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div> <!-- End Carousel --> 
				</div>  <!-- End Tips-New-User Class Wrapper --> 

				<br> 




			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>

<?php 

$result = mysqli_fetch_assoc(mysqli_query($link, "SELECT tips FROM tbl_users WHERE userid = " . $_SESSION['id']));

if($result['tips'] == 1) { 
	echo "<script type='text/javascript'>
	$(document).ready(function(){
		$('#tipsModal').modal('show');
	});
</script>";

mysqli_query($link, "UPDATE tbl_users SET tips = 0 WHERE userid = " . $_SESSION['id']);

}

?>



<script type="text/javascript">
// This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                console.log("connected");
                // Logged into your app and Facebook.
                testAPI();
            } else if (response.status === 'not_authorized') {
                console.log("not_authorized");
                // The person is logged into Facebook, but not your app.
                //document.getElementById('status').innerHTML = 'Please log ' +
                //    'into this app.';
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                //document.getElementById('status').innerHTML = 'Please log ' +
                //    'into Facebook.';
            }
        }

        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }

        function fb_login() {
            FB.login(function(response) {

                checkLoginState();

            });
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId      : '258249911282302',
                cookie     : true,  // enable cookies to allow the server to access 
                                // the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.8' // use graph api version 2.8
            });

            // Now that we've initialized the JavaScript SDK, we call 
            // FB.getLoginStatus().  This function gets the state of the
            // person visiting this page and can return one of three states to
            // the callback you provide.  They can be:
            //
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into
            //    your app or not.
            //
            // These three cases are handled in the callback function.

            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });

        };

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me?fields=id,name,first_name,last_name,email,picture,gender,birthday', function(response) {
                $.ajax({
                    url: 'fbfunctions.php',
                    type: 'post',
                    data: { fn: "login", info: response},
                    success: function(data) {
                        console.log(JSON.stringify(response));
                        //console.log(JSON.stringify(data));
                        if(data) {
                        	<?php if($_SESSION['reload']) { ?>
                            	window.location.href = "index.php";
                        	<?php } ?>
                        }
                    }
                })
                //console.log('Successful login for: ' + response.name);
                //document.getElementById('status').innerHTML =
                //  'Thanks for logging in, ' + response.name + '!';
            });
        }

var likeflag = false;
function like(a, b, c) {
  if(!likeflag){
    likeflag = true;
    
  var h = $(document.getElementById("like".concat(a))).html();
  i = parseInt(h);
  if (b==1) {
    i = i-1;
  } else {
    i = i+1;
  }
  
  $.ajax({
    url: 'like.php',
    type: 'post',
    data: {postid: a, status: b, type: c},
    success: function(data) {
      if(data==1){
        var newevent = "like(" + a + ", 2, 1);";
        document.getElementById("likeimage".concat(a)).src = "vendor/custom-icons/thumbsup.png";
      } else {
        var newevent = "like(" + a + ", 1, 1);";
        document.getElementById("likeimage".concat(a)).src = "vendor/custom-icons/thumbsup-blue.png";
      }
      document.getElementById("likeimage".concat(a)).setAttribute("onclick", newevent);
      $(document.getElementById("like".concat(a))).html(i);
    }

  })
  setTimeout(function() {likeflag=false;} , 500);
}
}
var favflag=false;
function fav(a, b, c) {
  if(!favflag){
    favflag=true;
    
  var h = $(document.getElementById("fav".concat(a))).html();
  i = parseInt(h);
  if (b==1) {
    i = i-1;
  } else {
    i = i+1;
  }
  
  $.ajax({
    url: 'fav.php',
    type: 'post',
    data: {postid: a, status: b, type: c},
    success: function(data) {
      
      if(data==1){
        var newevent = "fav(" + a + ", 2, 1);";
        document.getElementById("favimage".concat(a)).src = "vendor/custom-icons/favorite.png";
      } else {
        var newevent = "fav(" + a + ", 1, 1);";
        document.getElementById("favimage".concat(a)).src = "vendor/custom-icons/favorite-yellow.png";
      }
      document.getElementById("favimage".concat(a)).setAttribute("onclick", newevent);
      $(document.getElementById("fav".concat(a))).html(i);
    }


  })
  setTimeout(function() {favflag=false;}, 500);
}
}
function follow(a, c, b) {
  $.ajax({
    url: 'followuser.php',
    type: 'post',
    data: {id: a, status: b, type:c},
    success: function(data) {
      //alert(data);
      //data = data.substr(data.length-2, data.length -1)
      var follownames = document.getElementsByName("follow".concat(a));
      var followlist = Array.prototype.slice.call(follownames);
      var i = "follow(" + a + ", 2, 1);";
      var j = "follow(" + a + ", 2, 3);";
      if(data=="1") {
      	for( var count = 0; count < followlist.length; count++){
      		followlist[count].src = "vendor/custom-icons/circle-plus.png";
      		followlist[count].setAttribute("onclick", i);
      	}
      }
      if(data=="3") {
      	for ( var count = 0; count < followlist.length; count++) {
      		followlist[count].src = 'vendor/custom-icons/circle-check.png';
      		followlist[count].setAttribute("onclick", j);
      	}
      }
  }
})
	}


	function comment(postid, numcomments, postuserid) {
		var textvar = document.getElementById("commentbox" + postid).value;
		if(textvar!="") {
			document.getElementById("commentbox" + postid).value = "";
			$.ajax({
				url: 'homecomment.php',
				type: 'post',
				data: { postid: postid, comment: textvar, number: 3, id: postuserid},
				success: function(data) {
					var commentamount = numcomments + 1;
					var newevent = "comment(" + postid + ", " + commentamount + ", " + postuserid + ");";
					$(document.getElementById("commentlist" + postid)).html(data);
					document.getElementById("commentimage" + postid).setAttribute("onclick", newevent);
					if(numcomments = 3) {

					}
				}
			})

		}
	}
	var flag;
	var flags;
	var id = 0;
	var scrollcounter = 0;
	<?php 
	if(isset($_GET['gender']) && $_GET['gender'] == "Male") print("id = -1;\n");
	if(isset($_GET['gender']) && $_GET['gender'] == "Female") print("id = -2;\n");
	?>
	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $(document).height()-400) {

			if(!flag && !flags){
				flag=true;
				scrollcounter++;
				<?php
				if ($_SESSION['id'] == -1) { ?>
					if (scrollcounter > 5) {
						//if($(window).scrollTop() + $(window).height() == $(document).height()) {
							$("#guestprompt").modal({backdrop: "static", keyboard: false});
						//}
					} else {
						$.ajax({
							url: 'feedgenerator.php',
							type: 'post',
							datatype: 'string',
							data: {id: id},
							success: function(data) {
								var current = $('#container').html();
								$('#container').append(data);}
        					//$('#container').html(current.concat(data,'<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">'));}
    						});

					setTimeout(function() { flag=false;}, 500);
					}
					<?php } else { ?>
						setTimeout(function() { flag=false;}, 500);
						$.ajax({
							url: 'feedgenerator.php',
							type: 'post',
							datatype: 'string',
							data: {id: id},
							success: function(data) {
								var current = $('#container').html();
								$('#container').append(data);}
        					//$('#container').html(current.concat(data,'<link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">'));}
    						});

						<?php } ?>
					} 
				}
		});

</script>

<?php
if (isset($_GET['gender']) && ($_GET['gender'] == "Male" || $_GET['gender'] == "Female")) {
    //generateGenderCarousel($_GET['gender']);
	generateGenderRow(3, $_GET['gender']);
} else {
    //generateCarousel();
	generateRow(3); 
}

?>
</div>

<?php include("footer.php"); ?> 