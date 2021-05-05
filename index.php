<?php

    //Checks if no other location is requested other than the main page
    if($_SERVER['SCRIPT_NAME'] != "/index.php"){
        die('FALSE');
    }

    include_once('./Chat.php');
    include_once('./DatabaseConnection.php');
    include_once('./Jobs.php');
    include_once('./RequestsHandler.php');
    include_once('./Service.php');
    include_once('./Transaction.php');

    $query = new Query();
    $requestHandler = new RequestHandler($query);
    
    $requestedPath = $requestHandler->getPath();

    if(preg_match("/driver/i", $requestedPath)){
        $driver = new DriverRequest($requestHandler,$query);
        switch($requestedPath){
            case "driver-register":
                $driver->registerUser();
                break;
    
            case "driver-login":
    
                break;
    
            case "driver-forgot-password":
    
                break;
    
            case "driver-details":
    
                break;
    
            case "driver-available-jobs":
    
                break;
    
            case "driver-active-jobs":
    
                break;
    
            case "driver-history-jobs":
    
                break;
    
            case "driver-job-details":
    
                break;
    
            default:
                $requestHandler->setRequestResponse("Error","Invaild path");
        }
    }
    elseif(preg_match("/drivercompany/i", $requestedPath)){
        switch($requestedPath){
            case "drivercompany-register":
    
                break;
    
            case "drivercompany-login":
    
                break;
    
            case "drivercompany-forgot-password":
    
                break;    

            case "driver-company-details":

                break;
            default:
                $requestHandler->setRequestResponse("Error","Invaild path");
        }
    }
    elseif(preg_match("/user/i", $requestedPath)){
        switch($requestedPath){
            case "customer-register":
    
                break;
    
            case "customer-login":
    
                break;
    
            case "customer-forgot-password":
    
                break;
    
            case "customer-details":
    
                break;
    
            case "customer-place-order":
    
                break;
    
            default:
                $requestHandler->setRequestResponse("Error","Invaild path");
        }
    }
    else{
        $requestHandler->setRequestResponse("Error","Invaild path");
    }

    switch($requestedPath){
        case "driver-register":

            break;

        case "driver-login":

            break;

        case "driver-forgot-password":

            break;

        case "driver-details":

            break;

        case "driver-available-jobs":

            break;

        case "driver-active-jobs":

            break;

        case "driver-history-jobs":

            break;

        case "driver-job-details":

            break;

        default:
            $requestHandler->setRequestResponse("Error","Invaild path");
    }















    $response = $requestHandler->getBodyOfRequest();
    $requestHandler->setRequestResponse("Auth",$requestHandler->getAuthHeader());
    $requestHandler->setRequestResponse("UserRole",$requestHandler->requstingUserRole());
    $requestHandler->setRequestResponse("UserToken",$requestHandler->getAuthHeader());

    

?>