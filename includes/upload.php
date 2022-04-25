<?php
if ( !defined('ABSPATH') ) {
    //If wordpress isn't loaded load it up.
    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once $path . '/wp-load.php';
}

if(isset($_FILES["img_imp"]["name"]) &&  $_FILES["img_imp"]["name"] != '')
{
    
 $test = explode('.', $_FILES["img_imp"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) . '.' . $ext;
 $location = CONSTRUCTOR_RESUME_DIR . 'uploads/' . $name; 
 move_uploaded_file($_FILES["img_imp"]["tmp_name"], $location);

 $arr = [
     'html' => '<img src="'. CONSTRUCTOR_RESUME_URL . 'uploads/' . $name .'" height="150" width="225" class="img-thumbnail " id="img_ajax" />',
     'html_close' => '<span class="delete_img"><img src="'. CONSTRUCTOR_RESUME_URL . 'assets/img/cancel.png'.'"></span>',
     'img_name' => $name
 ];

 $arr = json_encode($arr);
 print($arr);die();

}
