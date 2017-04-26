<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use DB;
 
// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}
 
// Get the username and make sure it is valid
$username = Auth::user();
$username="John";
// $username = $_SESSION['login'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}
 
$full_path = sprintf("/home/luyiying/secret/userfile/%s",  $filename);
 
if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	echo "upload successfully!";
	// header("Location: welcome.php");
	exit;
}else{
	
	// header("Location: upload");
	echo "fail to upload";
	exit;
}
 
?>
