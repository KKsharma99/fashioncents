 <?php
$db_host		= 'localhost';

$db_user		= 'kunalsha_fc';

$db_pass		= 'g5mGfqMX';

$db_database	= 'kunalsha_fashioncents_master';
$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="shortcut icon" href="img/logo2.jpg" />

    <link rel="apple-touch-icon" href="img/logo2.jpg"/>

    <title>Admin Panel</title>


    <!-- Bootstrap Core CSS -->

    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">


    <!-- Custom Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">



    <!-- Plugin CSS -->

    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.css">

    <link rel="stylesheet" href="../vendor/device-mockups/device-mockups.min.css">



    <!-- Theme CSS -->

    <link href="../css/newera8.css" rel="stylesheet">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>



    <body>

        <div class="container-fluid"> 
            <div class="row"> 
                <div class="col-lg-4 col-lg-offset-4"> 

                    <br> <br> 

                    <h1 class="text-center">Admin Panel</h1> 

                    <br> <hr> 
                    <h3 class="text-center">User Demographics</h3> 
                    <hr> <br> 

                    <h4 >Sum</h4>
                    <p>Total User Count: <b><?php
                    $query = "SELECT COUNT(userid) FROM tbl_account";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_assoc($result);
                    $totaluser = $row['COUNT(userid)'];
                    echo $row['COUNT(userid)'];
                    ?></b></p> 

                    <h4>Gender Breakdown</h4>
                    <p>Total Male: <b><?php
                    $query = "SELECT COUNT(userid) FROM tbl_masterusers WHERE gender = 1 AND utype = 1";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_assoc($result);
                    $totalmale = $row['COUNT(userid)'];
                    echo $row['COUNT(userid)'];
                    ?></b></p>
                    <p>Total Female: <b>
                    <?php
                    $query = "SELECT COUNT(userid) FROM tbl_masterusers WHERE gender = 2 AND utype = 1";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_assoc($result);
                    $totalfemale = $row['COUNT(userid)'];
                    echo $row['COUNT(userid)'];
                    ?></b></p>
                    <p>Percent Male: <b><?php
                    $percent = $totalmale/$totaluser * 100;
                    echo $percent;
                    ?>%</b></p> 
                    <p>Percent Female: <b><?php
                    $percent = $totalfemale/$totaluser * 100;
                    echo $percent;
                    ?>%</b></p>

                    <h4>Age Breakdown</h4>
                    <p>Number of Users Age 13-17: <b><?php
                    $query = "SELECT dob FROM tbl_account WHERE dob != null";
                    $result = mysqli_query($link, $query);
                    $today = new DateTime('today');
                    $age13 = 0;
                    $age18 = 0;
                    $age23 = 0;
                    $age28 = 0;
                    $age33 = 0;
                    $age38 = 0;
                    $age43 = 0;
                    $age48 = 0;
                    $age53 = 0;
                    $age58 = 0;
                    $age64 = 0;
                    $age69 = 0;
                    while($row = mysqli_fetch_assoc($result)){
                    $date = new DateTime($row['dob']);
                    $age = $date->diff($today)->y;
                    if($age<18) $age13++;
                    else if($age<23) $age18++;
                    else if($age<28) $age23++;
                    else if($age<33) $age28++;
                    else if($age<38) $age33++;
                    else if($age<43) $age38++;
                    else if($age<48) $age43++;
                    else if($age<53) $age48++;
                    else if($age<58) $age53++;
                    else if($age<64) $age58++;
                    else if($age<69) $age64++;                                                                                                                         
                    else $age69++;
                    }
                    echo $age13;

                    ?></b></p>
                    <p>Number of Users Age 18-22: <b><?php
                    echo $age18;
                    ?></b></p>
                    <p>Number of Users Age 23-27: <b><?php
                    echo $age23;
                    ?></b></p>
                    <p>Number of Users Age 28-32: <b><?php
                    echo $age28;
                    ?></b></p>
                    <p>Number of Users Age 33-37: <b><?php
                    echo $age33;
                    ?></b></p>
                    <p>Number of Users Age 38-42: <b><?php
                    echo $age38;
                    ?></b></p>
                    <p>Number of Users Age 43-47: <b><?php
                    echo $age43;
                    ?></b></p>
                    <p>Number of Users Age 53-57: <b><?php
                    echo $age53;
                    ?></b></p>
                    <p>Number of Users Age: 58-63: <b><?php
                    echo $age58;
                    ?></b></p>
                    <p>Number of Users Age: 64-68: <b><?php
                    echo $age64;
                    ?></b></p>
                    <p>Number of Users Age 69+: <b><?php
                    echo $age69;
                    ?></b></p>

                    <p>Percentage of Users Age 13-17: <b><?php
                    echo $age13/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age 18-22: <b><?php
                    echo $age18/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age 23-27: <b><?php
                    echo $age23/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age 28-32: <b><?php
                    echo $age28/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age 33-37: <b><?php
                    echo $age33/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age 38-42: <b><?php
                    echo $age38/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age 43-47: <b><?php
                    echo $age43/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age 48-52: <b><?php
                    echo $age48/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age 53-57: <b><?php
                    echo $age53/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age: 58-63: <b><?php
                    echo $age58/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age: 64-68: <b><?php
                    echo $age64/$totaluser * 100;
                    ?>%</b></p>
                    <p>Percentage of Users Age 69+: <b><?php
                    echo $age69/$totaluser * 100;
                    ?>%</b></p>

                    <br> <hr>  
                    <h3 class="text-center">User Activity</h3> 
                    <hr> <br> 

                    <?php 
                        $visitlimit = time() - (2 * 60 * 60);
                        $activelimit = time() - (2 * 60);
                        $query = "SELECT visitid, scrollnum, query, fctime FROM tbl_scroll WHERE fctime > " . $visitlimit;
                        $query = mysqli_query($link, $query);
                        $usersonline = 0;
                        if($query) {
                            while($row = mysqli_fetch_assoc($query)) {
                                if($row['fctime'] > $activelimit) {
                                    $usersonline++;
                                }
                            }
                        }
                    ?>
                    <p>Number of Users Online Currently: <b><?php echo $usersonline; ?></b></p>
                    <!--<p>Number of Males Logged in Currently: <b>100</b></p>
                    <p>Number of Females Logged in Currently: <b>100</b></p>
                    <p>Percentage of Users Logged in that are Male: <b>100</b></p> 
                    <p>Percentage of Users Logged in that are Female: <b>100</b></p>-->
                    <?php
                    $weektime = time() - (7 * 24 * 60 * 60);
                    $query = "SELECT visitid, timespent, userid, fctime FROM tbl_visit WHERE fctime > " . $weektime;
                    $query = mysqli_query($link, $query);
                    $avg = 0;
                    if($query) {
                        $count = mysqli_num_rows($query);
                        while($row = mysqli_fetch_assoc($query)) {
                            $avg += $row['timespent'];
                        }
                        $avg /= $count;
                    }
                    ?>
                    <p>Average Session Duration for all Users: <b><?php echo $avg; ?></b></p>
                    <p>Average Session Duration for Males: <b>100</b></p>
                    <p>Average Session Duration for Females: <b>100</b></p>

                    <p>Number of Users Online Today: <b>100</b></p>
                    <p>Number of Users Online Yesterday: <b>100</b></p>
                    <p>Number of Users Online Yesterday: <b>100</b></p>
                    <p>Number of Users Online Yesterday by the Hour: <b>100</b></p>
                    <p>Percent of Users Online Today: <b>100</b></p>
                    <p>Percent of Users Online Yesterday: <b>100</b></p>
                    <p>Number of Users Online the Last 7 Days: <b>100</b></p>
                    <p>Number of Users Online the Last 14 Days: <b>100</b></p>
                    <p>Number of Users Online the Last 21 Days: <b>100</b></p>
                    <p>Number of Users Online the Last 30 Days: <b>100</b></p>
                    <p>Percent of Users Online the Last 7 Days: <b>100</b></p>
                    <p>Percent of Users Online the Last 14 Days: <b>100</b></p>
                    <p>Percent of Users Online the Last 21 Days: <b>100</b></p>
                    <p>Percent of Users Online the Last 30 Days: <b>100</b></p>

                    <!--<br> <hr> 
                    <h3 class="text-center">User Posts</h3>
                    <hr> <br> 

                    <h4>Total Posts:</h4> 
                    <p>Number of Users Who Have Posted: <b>100</b></p>
                    <p>Percent of Users Who Have Posted: <b>100</b></p>
                    <p>Average Number of Posts Per User: <b>100</b></p>


                    <h4>Gender Breakdown</h4>
                    <p>Number of Males Who Have Posted: <b>100</b></p>
                    <p>Number of Females Who Have Posted: <b>100</b></p>
                    <p>Number of Others Who Have Posted: <b>100</b></p>
                    <p>Percent of Male that Post: <b>100</b></p> 
                    <p>Percent of Female that Post: <b>100</b></p>
                    <p>Percent of Others that Post: <b>100</b></p>
                    <p>Percent of Posts that are from Males: <b>100</b></p>
                    <p>Percent of Posts that are from Females: <b>100</b></p>  
                    <p>Percent of Posts that are from Others: <b>100</b></p>
                    <p>Average Number of Posts Per Male: <b>100</b></p>
                    <p>Average Number of Posts Per Female: <b>100</b></p>
                    <p>Average Number of Posts Per Other: <b>100</b></p>

                    <h4>Age Breakdown</h4>
                    <p>Number of Posts Age 13-17: <b>100</b></p>
                    <p>Number of Posts Age 18-22: <b>100</b></p>
                    <p>Number of Posts Age 23-27: <b>100</b></p>
                    <p>Number of Posts Age 28-32: <b>100</b></p>
                    <p>Number of Posts Age 33-37: <b>100</b></p>
                    <p>Number of Users Age 38-42: <b>100</b></p>
                    <p>Number of Users Age 43-47: <b>100</b></p>
                    <p>Number of Users Age 48-52: <b>100</b></p>
                    <p>Number of Users Age 53-57: <b>100</b></p>
                    <p>Number of Users Age: 58-63: <b>100</b></p>
                    <p>Number of Users Age: 64-68: <b>100</b></p>
                    <p>Number of Users Age 69+: <b>100</b></p>

                    <p>Percentage of Users Age 13-17: <b>100</b></p>
                    <p>Percentage of Users Age 18-22: <b>100</b></p>
                    <p>Percentage of Users Age 23-27: <b>100</b></p>
                    <p>Percentage of Users Age 28-32: <b>100</b></p>
                    <p>Percentage of Users Age 33-37: <b>100</b></p>
                    <p>Percentage of Users Age 38-42: <b>100</b></p>
                    <p>Percentage of Users Age 43-47: <b>100</b></p>
                    <p>Percentage of Users Age 48-52: <b>100</b></p>
                    <p>Percentage of Users Age 53-57: <b>100</b></p>
                    <p>Percentage of Users Age: 58-63: <b>100</b></p>
                    <p>Percentage of Users Age: 64-68: <b>100</b></p>
                    <p>Percentage of Users Age 69+: <b>100</b></p>-->

                    <br> <hr> 
                    <h3 class="text-center">User Engagement</h3>
                    <hr> <br> 

                    <p>Total Likes on Site: <b>100</b></p>
                    <p>Number of Posts With Likes: <b>100</b></p>
                    <p>Percentage of Posts With Likes: <b>100</b></p>
                    <p>Of Liked Posts, Average Number Likes: <b>100</b></p>
                    <p>Average Likes Per All Posts: <b>100</b></p>

                    <p>Total Favorites on Site:  <b>100</b></p>
                    <p>Number of Posts Favorited: <b>100</b></p>
                    <p>Percentage of Posts Favorited: <b>100</b></p>
                    <p>Of Favorited posts, average number of Favorites: <b>100</b></p>
                    <p>Average Favorites Per Post: <b>100</b></p>

                    <p>Total Number of Comments: <b>100</b></p>
                    <p>Number of Posts with Comments: <b>100</b></p>
                    <p>Percentage of Posts with Comments: <b>100</b></p>
                    <p>Of Posts With Comments, Average number of comments: <b>100</b></p>
                    <p>Average Number of Comments Per Post: <b>100</b></p>

                    <p>Total Number of Shares: <b>100</b></p>
                    <p>Number of Posts Shared: <b>100</b></p>
                    <p>Percentage of Posts Shared: <b>100</b></p>
                    <p>Of Posts Shared, Average number of shares: <b>100</b></p>
                    <p>Average Number of Shares Per Post: <b>100</b></p>

                    <p>Total Number of Follows/Following: <b>100</b></p><p>
                    <p>Average Number of Followers/Following per User: <b>100</b></p>
                    <p>Number of Users with no followers: <b>100</b></p>
                    <p>Percentage of Users with no followers: <b>100</b></p>
                    <p>Number of Users that are not Following Anyone: <b>100</b></p>
                    <p>Percentage of Users that are not Following Anyone: <b>100</b></p>

                    <br> <hr> 
                    <h3 class="text-center">User Earnings</h3>
                    <hr> <br> 

                    <p>Total Earnings: <b>100</b></p>
                    <p>Number of Posts that have earned money: <b>100</b></p>
                    <p>Percent of Posts that have earned money: <b>100</b></p> 
                    <p>Average Earnings Per Post: <b>100</b></p>
                    <p>Average Earnings Per User: <b>100</b></p>
                    <p>Average Earnings Per Male User: <b>100</b></p>
                    <p>Average Earning Per Female User: <b>100</b></p>
                    <p>Average Earning Per Other User: <b>100</b></p>

                    <p>Percent of All Earnings Male: <b>100</b></p>
                    <p>Percent of All Earnings Female: <b>100</b></p>
                    <p>Percent of All Earnings Others: <b>100</b></p>

                    <p>Number of Posts that Earned Money Age 13-17: <b>100</b></p>
                    <p>Number of Posts that Earned Money Age 18-22: <b>100</b></p>
                    <p>Number of Posts that Earned Money Age 23-27: <b>100</b></p>
                    <p>Number of Posts that Earned Money Age 28-32: <b>100</b></p>
                    <p>Number of Posts that Earned Money Age 33-37: <b>100</b></p>
                    <p>Number of Users that Earned Money Age 38-42: <b>100</b></p>
                    <p>Number of Users that Earned Money Age 43-47: <b>100</b></p>
                    <p>Number of Users that Earned Money Age 48-52: <b>100</b></p>
                    <p>Number of Users that Earned Money Age 53-57: <b>100</b></p>
                    <p>Number of Users that Earned Money Age 58-63: <b>100</b></p>
                    <p>Number of Users that Earned Money Age 64-68: <b>100</b></p>
                    <p>Number of Users that Earned Money Age 69+: <b>100</b></p>

                    <p>Percentage of Users that Earned Money Age 13-17: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 18-22: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 23-27: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 28-32: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 33-37: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 38-42: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 43-47: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 48-52: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 53-57: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 58-63: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 64-68: <b>100</b></p>
                    <p>Percentage of Users that Earned Money Age 69+: <b>100</b></p>

                    <p>Amount of Money Earned Age 13-17: <b>100</b></p>
                    <p>Amount of Money Earned Age 18-22: <b>100</b></p>
                    <p>Amount of Money Earned Age 23-27: <b>100</b></p>
                    <p>Amount of Money Earned Age 28-32: <b>100</b></p>
                    <p>Amount of Money Earned Age 33-37: <b>100</b></p>
                    <p>Amount of Money Earned Age 38-42: <b>100</b></p>
                    <p>Amount of Money Earned Age 43-47: <b>100</b></p>
                    <p>Amount of Money Earned Age 48-52: <b>100</b></p>
                    <p>Amount of Money Earned Age 53-57: <b>100</b></p>
                    <p>Amount of Money Earned Age 58-63: <b>100</b></p>
                    <p>Amount of Money Earned Age 64-68: <b>100</b></p>
                    <p>Amount of Money Earned Age 69+: <b>100</b></p>

                    <p>Percent of Total Money Earned Age 13-17: <b>100</b></p>
                    <p>Percent of Total Money Earned Age 18-22: <b>100</b></p>
                    <p>Percent of Total Money Earned Age 23-27: <b>100</b></p>
                    <p>Percent of Total Money Earned Age 28-32: <b>100</b></p>
                    <p>Percent of Total Money Earned Age 33-37: <b>100</b></p>
                    <p>Percent of Total Money Earned Age 38-42: <b>100</b></p>
                    <p>Percent of Total Money Earned Age 43-47: <b>100</b></p>
                    <p>Percent of Total Money Earned Age 48-52: <b>100</b></p>
                    <p>Percent of Total Money Earned Age 53-57: <b>100</b></p>
                    <p>Percent of Total Money Earned Age: 58-63: <b>100</b></p>
                    <p>Percent of Total Money Earned Age: 64-68: <b>100</b></p>
                    <p>Percent of Total Money Earned Age 69+: <b>100</b></p>

                </div> <!-- Close Row Specs -->
            </div> <!-- Close Row -->
        </div> <!-- Close the Container -->


        <footer>

            <div class="container">

                <p>&copy; 2016 Fashion Cents. All Rights Reserved.</p>

            </div>

        </footer>



        <!-- jQuery -->

        <script src="../vendor/jquery/jquery.min.js"></script>



        <!-- Bootstrap Core JavaScript -->

        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>



        <!-- Plugin JavaScript -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>


    </body>


    </html>