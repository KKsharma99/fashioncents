<?php 
function createPost() {
  if (isset($_SESSION['id']) && $_SESSION['id'] != -1) {
    $text = "INSERT INTO tbl_posts(userid,description,posttime)
      VALUES(
      '" . $_SESSION['id'] . "',
      '" . mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['desc']) . "',
      ".time()."
      )";
    var_dump($text);
    mysqli_query($GLOBALS['sqllink'],$text);
    if (mysqli_error($GLOBALS['sqllink']) == "") {
      $newpost = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'],"SELECT LAST_INSERT_ID() FROM tbl_posts"));
      //var_dump($newpost);
      $newpost = $newpost['LAST_INSERT_ID()'];
      $imagename = saveImage($newpost);
      mysqli_query($GLOBALS['sqllink'], "UPDATE tbl_posts SET image_small='" . $imagename . "' WHERE postid= " .$newpost);
      for($i = 1; $i <= ((int)$_POST['itemcount']); $i++) {
        $_POST['item'.$i] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['item'.$i]);
        $_POST['brand'.$i] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['brand'.$i]);
        $_POST['amazon'.$i] = urldecode($_POST['amazon'.$i]);
        $_POST['amazon'.$i] = mysqli_real_escape_string($GLOBALS['sqllink'], $_POST['amazon'.$i]);
        $query= "INSERT INTO `tbl_items`(`postid`, `itemname`, `brand`, `price`, `link`) VALUES('".$newpost."','".$_POST['item'.$i]."','".$_POST['brand'.$i]."','".$_POST['price'.$i]."','".$_POST['amazon'.$i]."')";
        //echo $query;
        mysqli_query($GLOBALS['sqllink'],$query);
        generateSingleHash($newpost);

      }
          //sets first post to profile pic if its not set
      $sql = "SELECT profilepic FROM tbl_masterusers WHERE userid = " . $_SESSION['id'];
      $pic = mysqli_fetch_assoc(mysqli_query($GLOBALS['sqllink'], $sql));
      if ($pic['profilepic'] == null || $pic['profilepic'] == 'img/users/defaultuser.png') {
        $updatesql = "UPDATE tbl_masterusers SET profilepic = '" . $imagename . "' WHERE userid = " . $_SESSION['id'];
        mysqli_query($GLOBALS['sqllink'], $updatesql);
      }
      return $newpost;
    }

  }
}
function saveImage($id) {
    //Stores the filename as it was on the client computer.
  $imagename = $id . "_small.png";
  $imagenameL = $id . "_large.png";
    //Stores the filetype e.g image/jpeg
  $imagetype = $_FILES['image']['type'];
    //Stores any error codes from the upload.
  $imageerror = $_FILES['image']['error'];
    //Stores the tempname as it is given by the host when uploaded.
  $imagetemp = $_FILES['image']['tmp_name'];
    //The path you wish to upload the image to
  $imagePath = "img/posts/";
  if(is_uploaded_file($imagetemp)) {
    //compress_image($imagetemp, $imagePath.$imagenameL, 100);
    smart_resize_image($imagetemp, null, 1000, 1618, true, $imagePath.$imagenameL, false, false, 100);
    return smart_resize_image($imagetemp, null, 1000, 1618, true, $imagePath.$imagename, true, false, 40);
  }
  else {
    echo "Failed to upload your image.";
  }
}

/**
 * easy image resize function
 * @param  $file - file name to resize
 * @param  $string - The image data, as a string
 * @param  $width - new image width
 * @param  $height - new image height
 * @param  $proportional - keep image proportional, default is no
 * @param  $output - name of the new file (include path if needed)
 * @param  $delete_original - if true the original image will be deleted
 * @param  $use_linux_commands - if set to true will use "rm" to delete the image, if false will use PHP unlink
 * @param  $quality - enter 1-100 (100 is best quality) default is 100
 * @return boolean|resource
 */
  function smart_resize_image($file,
                              $string             = null,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = false, 
                              $output             = 'file', 
                              $delete_original    = true, 
                              $use_linux_commands = false,
                              $quality = 100
         ) {
      
    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null && $string === null ) return false;
 
    # Setting defaults and meta
    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
    $cropHeight = $cropWidth = 0;
 
    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );
 
      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
      $widthX = $width_old / $width;
      $heightX = $height_old / $height;
      
      $x = min($widthX, $heightX);
      $cropWidth = ($width_old - $width * $x) / 2;
      $cropHeight = ($height_old - $height * $x) / 2;
    }
 
    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
      default: return false;
    }
    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);
 
      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
    
    
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }
 
    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
    
    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }
    echo '<script>alert('.$output.'); </script>';
    return $output;
  }

  function generateSingleHash($id) {

$existing = array();
$query = mysqli_query($GLOBALS['sqllink'], "SELECT hash FROM tbl_posts WHERE 1");
if($query) {
    while($row = mysqli_fetch_assoc($query)) {
        $existing[] = $row['hash'];
    }
}
    $newhash = generateRandomString(10);
    while(in_array($newhash,$existing) && $newhash == null) {
        $newhash = generateRandomString(10);
    }
    mysqli_query($GLOBALS['sqllink'], "UPDATE tbl_posts SET hash = '" . $newhash . "' WHERE postid = " . $id);
    copy("asinglepost_template.php", "singlepost_" . $newhash . ".php");

  }

  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>