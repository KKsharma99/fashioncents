</div> <!-- End Container --> 





<!-- /.container -->



<footer>

    <div class="container">



       <ul class="list-inline">

          <li>

             <h6>&copy; 2017 Fashioncents. All Rights Reserved.</h6>

         </li>

          <li>

             <a href="privacy.php">Privacy</a>

         </li>

         <li>

             <a href="terms.php">Terms</a>

         </li>

     <!--   <li>

             <a href="reporterror.php">Report Error</a>

         </li> --> 

     </ul>

 </div>

</footer>

<?php include 'deletemodal.php'; ?>
<?php include("analyticstracking.php"); ?> 

    <!-- jQuery

    <script src="js/jquery-3.1.1.js"></script>

    Bootstrap Core JavaScript -->

    <!-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> -->


<!-- Plugin JavaScript -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>



<!-- Theme JavaScript -->

<script src="js/new-age.min.js"></script> 

<script src="js/navbar.js"></script> 


<script src="js/postuploadpreview.js"></script> 

<!-- Fading in feature to see who liked the post --> 

<script type="text/javascript">
    
    $(function(){
    $(".dropdown").hover(            
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            });
    });
    

</script>


</body>



</html>