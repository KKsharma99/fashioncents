<?php 
session_start();
class DB_Functions {
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new DB_Connect();
        $_SESSION['conn'] = ($db->connect());
    }
 
    // destructor
    function __destruct() {
         
    }

    function register($firstname, $lastname, $email, $gender, $pass, $dob, $privacy) {
        $sql = "INSERT INTO tbl_users(first_name,last_name,gender,email,pass,date_of_birth,privacy) VALUES(
                    '".$firstname."',
                    '".$lastname."',
                    '".$gender."',
                    '".$email."',
                    '".$pass."', 
                    '".$dob."',
                    '".$privacy."'
                    )";
        $query = mysqli_query($_SESSION['conn'], $sql);
        
        $check = mysqli_query($_SESSION['conn'], "SELECT userid,first_name,last_name,email,gender,privacy,date_of_birth FROM tbl_users WHERE email= '" . $email . "'");
        if($query) {
            $row = mysqli_fetch_assoc($check);
            return $row;
        } else {
            return false;
        }
    }
    
    function login($email, $pass) {
        $row = mysqli_fetch_assoc(mysqli_query($_SESSION['conn'], "SELECT userid,email,pass,first_name,last_name FROM tbl_users WHERE email= '" . $email . "'"));

        if($row['email']) {
            if($pass == $row['pass']) {
                return $row;
            } else {
                return false;
            }
        }
    }

    function doesUserExist($email) {
        $row = mysqli_fetch_assoc(mysqli_query($_SESSION['conn'], "SELECT userid,email FROM tbl_users WHERE email= '" . $email . "'"));
        if($row['userid']) {
            return true;
        } else {
            return false;
        }
    }

    function getNextPost($uid, $lastpostid) {
        $SQLCommand = "SELECT a.postid,a.userid,a.description,a.image,a.postdate FROM tbl_posts a INNER JOIN tbl_users b ON a.userid = b.userid LEFT JOIN tbl_followers c ON a.userid = c.userid";
        if(isset($lastpostid)){
            $SQLCommand .= " WHERE a.postid < ". $lastpostid." AND (b.privacy=1 OR a.userid = ".$uid." OR c.followerid = ".$uid.")";
        } else{
            $SQLCommand .= " WHERE b.privacy=1 OR a.userid = ".$uid." OR c.followerid = ".$uid;
        }
        $SQLCommand .= " ORDER BY a.postid DESC LIMIT 1";
        $result = mysqli_query($_SESSION['conn'], $SQLCommand); // This line executes the MySQL query that you typed above
        //add a fix for posts made within different calls
        if($result) {
            $post = mysqli_fetch_assoc($result); // loop to store the data in an associative array.
            $urlimg = "http://fashioncents.me/img/posts/" . $post['postid'];
            $post['image'] = $urlimg;
            return $post;
        }
        return false;
    }

    function getPostDetails($uid, $post) {
        $postdetails = array();
        //convert data into an array to be generated
        $SQLCommand = "SELECT postid,type,brand,link FROM details WHERE postid =" . $post['postid'];
        $result = mysqli_query($_SESSION['conn'], $SQLCommand); // This line executes the MySQL query that you typed above
        $details = array(); // make a new array to hold all your data
        $detailcount = 0;
        while($row = mysqli_fetch_assoc($result)){ // loop to store the data in an associative array.
            $singlerow = array(
            0 => $row['postid'],
            $row['type'],
            $row['brand'],
            $row['link']
            );
            $details[$detailcount] = $singlerow;
            $detailcount++;
        }

        $query = "SELECT userid,first_name,last_name,profilepic,privacy FROM tbl_users WHERE userid = '" . $post['userid'] . "'";
        $postuser = mysqli_fetch_assoc(mysqli_query($_SESSION['conn'], $query));
        $query = "SELECT COUNT(userid) FROM tbl_likes WHERE postid = '" . $post['postid'] . "'";
        $likes = mysqli_fetch_assoc(mysqli_query($_SESSION['conn'], $query));
        $query = "SELECT userid FROM tbl_likes WHERE postid = '" . $post['postid'] . "' AND userid = '" . $uid . "'";
        $liked = mysqli_fetch_assoc(mysqli_query($_SESSION['conn'], $query));
        $query = "SELECT COUNT(userid) FROM tbl_favorites WHERE postid = '" . $post['postid'] . "'";
        $favs = mysqli_fetch_assoc(mysqli_query($_SESSION['conn'], $query));
        $query = "SELECT userid FROM tbl_favorites WHERE postid = '" . $post['postid'] . "' AND userid = '" . $uid ."'";
        $faved = mysqli_fetch_assoc(mysqli_query($_SESSION['conn'], $query));
        $query = "SELECT confirmed from tbl_following WHERE followerid = '" . $uid . "' AND userid = '" . $post['userid'] . "'";
        $following = mysqli_query($_SESSION['conn'], $query);
        if($following) {
            $following = mysqli_fetch_assoc($following);
        }
        $postdetails['items'] = $details;
        $postdetails['postuser'] = $postuser;
        $postdetails['likes'] = $likes;
        $postdetails['liked'] = $liked;
        $postdetails['favs'] = $favs;
        $postdetails['faved'] = $faved;
        $postdetails['following'] = $following;
        return $postdetails;
    }
}

?>