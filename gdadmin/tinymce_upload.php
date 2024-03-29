<?php
include(__DIR__.'/../configuration.php');
// Allowed origins to upload images
$accepted_origins = [substr(BASE_URL,0,-1),];
// Images upload path
$imageFolder = __DIR__."/../themes/assets/upload/";

reset($_FILES);
$temp = current($_FILES);
if(is_uploaded_file($temp['tmp_name'])){
    // Sanitize input
    if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])){
        header("HTTP/1.1 400 Invalid file name.");
        return;
    }
  
    // Verify extension
    if(!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))){
        header("HTTP/1.1 400 Invalid extension.");
        return;
    }
  
    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imageFolder . $temp['name'];
    move_uploaded_file($temp['tmp_name'], $filetowrite);
  
    // Respond to the successful upload with JSON.
    echo json_encode(array('location' => URL.URI.'/themes/assets/upload/'.$temp['name'])); //$filetowrite
} else {
    // Notify editor that the upload failed
    header("HTTP/1.1 500 Server Error");
}
?>