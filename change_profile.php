<?php
session_start();
require_once('classes/class.user.php');

$user = new USER();
$user_id = $_SESSION['user_session'];

if(isset($_POST['btn-update-profile'])){
  $uname = strip_tags($_POST['name']);
  $umail = strip_tags($_POST['email']);
  $old_password = strip_tags($_POST['old_password']);
  $new_password = strip_tags($_POST['new_password']);  
  $new_password_confirmation = strip_tags($_POST['new_password_confirmation']);  
  $description = strip_tags($_POST['description']);
  $address = strip_tags($_POST['address']);
  $image_url = strip_tags($_POST['image_url']);
  $website = strip_tags($_POST['website']);
  
  $error[] = $user->update_profile($user_id, array(":uname" => $uname,
                                                  ":email" => $umail,
                                                  ":description" => $description,
                                                  ":website" => $website,
                                                  ":address" => $address,
                                                  ":image_url" => $image_url),
                                  $new_password);

}
?>