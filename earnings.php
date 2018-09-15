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



<div class="text-center"> 

          <h2>Summary of Your Earnings</h2>

          <p>Redeem your earnings through paypal.</p> 

          <br> 

</div>



<div class="alert alert-warning">
  <strong>Note!</strong> This is only a sample of the earnings page. This feature is coming soon. 
</div>


          <div class="row">

            <div class="col-md-6 col-xs-12">



              <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

              <div id="piechart" style="width = 100%"></div>



            </div>

          





          <div class="col-md-6 col-xs-12 ">

           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

           <div id="chart_div" style="width= 100%"></div>

         </div>

       </div> 
       

       <br> 

       <br> 

    <div class="table-responsive"> 
       <table class="table table-striped">

        <thead>

          <tr>

            <th>Date</th>

            <th>Outfit Number</th>

            <th>Type</th>

            <th>Brand</th>

            <th>Color</th>

            <th>Item Cost</th>

            <th>Comm Rate</th>

            <th>Price Per Item</th>

            <th>Number Sold</th>

            <th>Earnings</th>

          </tr>

        </thead>

        <tbody>

          <tr>

            <td>9/21/2016</td>

            <td>Outfit 1</td>

            <td>Shirt</td>

            <td>Polo</td>

            <td>Red</td>

            <td>$25</td>

            <td>8%</td>

            <td>$2</td>

            <td>10</td>

            <td>$20</td>

          </tr>

          <tr>

            <td>9/22/2016</td>

            <td>Outfit 2</td>

            <td>Jeans</td>

            <td>Arizona</td>

            <td>Dark Blue</td>

            <td>$30</td>

            <td>8%</td>

            <td>$2.4</td>

            <td>12</td>

            <td>$28.8</td>

          </tr>

          <tr>

            <td>9/22/2016</td>

            <td>Outfit 2</td>

            <td>Sandals</td>

            <td>Peters</td>

            <td>Black</td>

            <td>$50</td>

            <td>8%</td>

            <td>$4</td>

            <td>6</td>

            <td>$24</td>

          </tr>

          <tr>

            <td>9/23/2016</td>

            <td>Outfit 3</td>

            <td>Jacket</td>

            <td>Polo</td>

            <td>Black</td>

            <td>$60</td>

            <td>8%</td>

            <td>$4.8</td>

            <td>6</td>

            <td>$28.8</td>

          </tr>

          <tr>

            <td>9/23/2016</td>

            <td>Outfit 3</td>

            <td>Shoes</td>

            <td>Calvin K</td>

            <td>White</td>

            <td>$60</td>

            <td>8%</td>

            <td>$4.8</td>

            <td>6</td>

            <td>$28.8</td>

          </tr>

          <tr>

            <td>9/24/2016</td>

            <td>Outfit 4</td>

            <td>Belt</td>

            <td>Alfani</td>

            <td>Brown</td>

            <td>$50</td>

            <td>8%</td>

            <td>$4</td>

            <td>10</td>

            <td>$40</td>

          </tr>

          <tr>

            <td>9/24/2016</td>

            <td>Outfit 4</td>

            <td>Pants</td>

            <td>Alfani</td>

            <td>Black</td>

            <td>$60</td>

            <td>8%</td>

            <td>$4.8</td>

            <td>6</td>

            <td>$28.8</td>

          </tr>

                    <tr>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

            <td>TOTAL</td>

            <td><b>$208</b></td>

          </tr>

        </tbody>

      </table>

      </div> <!-- Closes table-responsive --> 

    </div>

  </div> 



<script> 
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Outfit Number', 'Hours per Day'],
      ['Outfit 1',     57.60],
      ['Outfit 2',      46.40],
      ['Outfit 3',  57.60],
      ['Outfit 4', 46.40]
      ]);
    var options = {
      title: 'Earnings Per Outfit'
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
</script> 



<script> 
  google.charts.load('current', {packages: ['corechart', 'line']});
  google.charts.setOnLoadCallback(drawBasic);
  function drawBasic() {
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'X');
    data.addColumn('number', 'Earnings');
    data.addRows([
      [21, 57.6],   [22, 104.00],  [23,161.60],  [24, 208]
      ]);
    var options = {
      hAxis: {
        title: 'Date (September)'
      },
      vAxis: {
        title: 'Total Earnings'
      }
    };
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script> 





<?php include("footer.php"); ?> 