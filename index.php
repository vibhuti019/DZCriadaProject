<?php

    //Checks if no other location is requested other than the main page
    if($_SERVER['SCRIPT_NAME'] != "/index.php"){
        die('FALSE');
    }


    include_once('./driverApi.php');
    include_once('./customerApi.php');
    include_once('./driverCompanyApi.php');

    $bodyOfRequest = file_get_contents('php://input');
    $arrayOfJSON = json_decode($bodyOfRequest, true);
    
    if(isset($_SERVER["HTTP_AUTH"])){
        $authHeader =  $_SERVER["HTTP_AUTH"];
    }else{
        $authHeader = "NO AUTH";
    }
    
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $path = explode('/',$_SERVER['PATH_INFO']);
    $requestedPath = $path[1];
    
    
    if(preg_match("/driver/i", $requestedPath)){
        switch($requestedPath){
            case "driver-register":
                echo driverRegister($arrayOfJSON);
                die();
                break;
    
            case "driver-login":
                echo driverLogin($arrayOfJson['driverMobile'],$arrayOfJson['driverPassword']);
                die();
                break;
    
            
            case "driver-forgot-password":

                break;
    
            case "driver-details":
                echo driverDetails();
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
                die();
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
                die();
        }
    }
    elseif(preg_match("/customer/i", $requestedPath)){
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
                die();
        }
    }
    else{
        die();
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
            die();
    }
    die();















    $response = $requestHandler->getBodyOfRequest();
    $requestHandler->setRequestResponse("Auth",$requestHandler->getAuthHeader());
    $requestHandler->setRequestResponse("UserRole",$requestHandler->requstingUserRole());
    $requestHandler->setRequestResponse("UserToken",$requestHandler->getAuthHeader());

    

?>
