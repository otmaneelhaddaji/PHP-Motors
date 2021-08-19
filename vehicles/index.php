<?php
// This is the controller for the vehicles
//Get the database connection file
    require_once '../library/connections.php';
    //Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    //Get the vehicles model
    require_once '../model/vehicles-model.php';

    require_once '../library/functions.php';

    require_once '../model/uploads-model.php';

    require_once '../model/reviews-model.php';

        //Create or access a session
        session_start();

    //get array of classifications
    $classifications = getClassifications();

    $navList = createNav($classifications);

    
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
    case "add_classification":
        include '../view/add_classification.php'; 
        break;

    case "add_vehicle":
        include '../view/add_vehicle.php';
        break;

    case 'add_vehicle_to_db':
        
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_NUMBER_INT));

        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = '<p class="error">Please provide information for all empty form fields.</p>';
            
            include '../view/add_vehicle.php';
            exit;
          }

        if(empty($invImage)){
            
            $invImage = "/images/vehicles/no-image.png";
        }
        if(empty($invThumbnail)){
            
            $invThumbnail = "/images/vehicles/no-image.png";
        }
        
        $vehicleOutcome = insertVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
        echo $vehicleOutcome;
        if($vehicleOutcome === 1) {
            
            $message = "<p class="."success-msg".">Vehicle $invMake $invModel was added successfully.</p>";
            include '../view/add_vehicle.php';
            exit;
        } else {
            
            $message = "<p class="."error".">Sorry, the vehicle could not be added.</p>";
            include '../view/add_vehicle.php';
            exit;
        }

        break;

    case 'add_classification_to_db':
        $classification = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

        if(empty($classification)){
            $message = '<p class="error">Please fill in all empty fields</p>';
            include '../view/add_classification.php';
            exit;
        }

        $outcome = insertClassification($classification);
        if($outcome === 1){
            
            include header('location:http://localhost/phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='error'>Sorry, the new classification did not add correctly</p>";
            include '../view/add_classification.php';
            exit;
        }
        break;

    //For update and delete process
    case 'getInventoryItems':
        //get classification id
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        //feth the vehicles by classification id
        $inventoryArray = getInventoryByClassification($classificationId);
        //conver to a JSON object and send it back
        echo json_encode($inventoryArray);
        break;

    //for delivering modification view
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
           }
           include '../view/vehicle-update.php';
           exit;
        break;

     //for delivering deletion view
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;

    //for filtering and prepping information for update
    case 'updateVehicle':
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_NUMBER_INT));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = '<p class="error">Please provide information for all empty form fields.</p>';
            
            include '../view/vehicle-update.php';
            exit;
          }

        if(empty($invImage)){
            
            $invImage = "/phpmotors/images/no-image.png";
        }
        if(empty($invThumbnail)){
            
            $invThumbnail = "/phpmotors/images/no-image.png";
        }
        
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
        echo $updateResult;
        if($updateResult === 1) {
            
            $message = "<p class="."success-msg".">Vehicle $invMake $invModel was updated successfully.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            
            $message = "<p class="."error".">Sorry, the vehicle could not be updated.</p>";
            include '../view/vehicle-update.php';
            exit;
        }

        break;


    //for deleting a vehicle
    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>The vehicle was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not
        deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }


        break;
    
    case 'classification';
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        // var_dump($vehicles);
        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
          } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
          }

          include '../view/classification.php';
        
        break;

    //gets details of a vehicle when it is clicked on from the vehicle list.
    case 'getDetails':
        $invId = filter_input(INPUT_GET, 'invid', FILTER_SANITIZE_STRING);
        
        $carDetails = getInvItemInfo($invId);
        
        $carDetailsHtml = createVehicleDetails($carDetails);

        $thumbnails = getThumbnails($invId);
        $thumbnailsHtml = createThumbnailDisplay($thumbnails);

        //set up reviews
        $vehicleReviews = getReviewsByVehicle($invId);
        //if no reviews, invite to create the first
        if (empty($vehicleReviews)) {
            $vehicleReviewsHtml = '<p class="centered-text">Be the first to write a review for this vehicle!</p>';
        } else {
            $vehicleReviewsHtml = createReviews($vehicleReviews);
        }

        //create reviewin form
        $reviewForm = createReviewForm($invId, $_SESSION['clientData']['clientId'], $_SESSION['clientData']['clientFirstname'], $_SESSION['clientData']['clientLastname']);

        include '../view/vehicle-detail.php';
        break;

    default:

        $classificationList = buildClassificationList($classifications);

        include '../view/vehicle_management.php';
    }
    
?>