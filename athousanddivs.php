<div class="row the-main-slider" > <!-- MAIN SLIDER -->
	<div class="col-xs-12 jssor-column-fix">

		<!-- #region Jssor Slider Begin -->
		<script src="js/jssor.slider-23.1.6.min.js" type="text/javascript">
		</script>
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
			<div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('img/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);">
			</div>

			<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;">
				<div>
					<img data-u="image" src="img/slide1.jpg" alt="Slideshow Image 1"/>
				</div>
				<div >
					<img data-u="image" src="img/slide2.jpg" alt="Slideshow Image 2"/>
				</div>
				<div>
					<img data-u="image" src="img/slide3.jpg" alt="Slideshow Image 3"/>
				</div>
				<a data-u="any" href="https://www.jssor.com/wordpress.html" style="display:none">
					blank
				</a>
			</div>
			<!-- Bullet Navigator -->
			<div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
				<!-- bullet navigator item prototype -->
				<div data-u="prototype" style="width:16px;height:16px;">
				</div>
			</div>
			<!-- Arrow Navigator -->
			<span data-u="arrowleft" class="jssora22l" style="top:0px;left:55px;width:40px;height:58px;" data-autocenter="2">
			</span>
			<span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;" data-autocenter="2">
			</span>
		</div>
		<script type="text/javascript">jssor_1_slider_init();
		</script>
		<!-- #endregion Jssor Slider End --> 


	</div> <!-- End Column -->
</div> <!-- End Row --> 

<!-- 
<div class="row visible-xs">
<div class="col-xs-12" style="padding-left:0px; padding-right:0px">

			
					<img data-u="image" src="img/slide1.jpg" alt="Slideshow Image 1" width="100%"/>
		
					<img data-u="image" src="img/slide2.jpg" alt="Slideshow Image 2" width="100%"/>

					<img data-u="image" src="img/slide3.jpg" alt="Slideshow Image 3" width="100%"/>
	
<br> <br>
</div> 
</div> 
--> 

<div class="row" >
	<div class="col-xs-12">

            <span href="#" data-toggle="modal" data-target="#register-modal" >
              <button class="btn m-main-join smooth-button" style="width:100%;">CREATE AN ACCOUNT</button>
            </span> 
</div> <!-- End Column -->

</div> <!-- End Row --> 

<div class="row " >
	<div class="col-xs-12">

            <span href="#" data-toggle="modal" data-target="#login-modal" >
              <button class="btn m-main-login smooth-button" style="width:100%;">LOGIN</button>
            </span> <br> <br>
</div> <!-- End Column -->

</div> <!-- End Row -->


