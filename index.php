<?php
    //This is the main controller for the site.

    //Get the database connection file
    require_once 'library/connections.php';
    //Get the PHP Motors model for use as needed
    require_once 'model/main-model.php';

    require_once 'library/functions.php';
 
    //Create or access a session
    session_start();

    //Get array of classifications
    $classifications = getClassifications();
   session_start();

    $navList = createNav($classifications);
    if(isset($_SESSION['loggedin'])){
        $loggedin = $_SESSION['loggedin'];
    } else {
        $loggedin = false;
    }

    // $action is used to store the type of content being requested. 
    // filter_input() is used to eliminate harmful code.
    // Check the POST and GET objects to look for name/value pairs, store the value in the $action variable

    //save cookie
    if(isset($_COOKIE['firstname'])){
      $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
    }

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){


  case 'template':
    include 'view/template.php';
  
  break;
 
 default:
  include 'view/home.php';
 }
 ?>