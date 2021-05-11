<?php

    //Checks if no other location is requested other than the main page
    if($_SERVER['SCRIPT_NAME'] != "/index.php"){
        echo var_dump(explode('/',$_SERVER['SCRIPT_FILENAME']));
        echo "False";
        die();
    }


    include_once('./driverApi.php');
    include_once('./customerApi.php');
    include_once('./companyApi.php');

    $bodyOfRequest = file_get_contents('php://input');
    $arrayOfJSON = json_decode($bodyOfRequest, true);
    
    if(isset($_SERVER["HTTP_AUTH"])){
        $authHeader =  $_SERVER["HTTP_AUTH"];
    }else{
        $authHeader = "NO AUTH";
    }
    
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Auth, X-Requested-With");

    $path = explode('/',$_SERVER['PATH_INFO']);
    $requestedPath = $path[1];
    
    
    if(preg_match("/driver/i", $requestedPath)){
        switch($requestedPath){
            case "driver-register":
                echo driverRegister($arrayOfJSON);
                die();
                break;
    
            case "driver-login":
                echo driverLogin($arrayOfJSON);
                die();
                break;
    
            
            case "driver-forgot-password":

                break;
    
            case "driver-details":
                echo driverDetails($authHeader,$arrayOfJSON);
                break;
    
            case "driver-available-jobs":
                echo driverAvailableJobs($authHeader,$arrayOfJSON);
                break;
    
            case "driver-active-jobs":
                echo driverActiveJobs($arrayOfJSON);
                break;
    
            case "driver-history-jobs":
                echo driverHistoryJobs($arrayOfJSON);
                break;
    
            case "driver-job-details":
                echo driverJobDetail($arrayOfJSON);
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
                echo customerRegister($arrayOfJSON);
                break;
    
            case "customer-login":
                echo customerLogin($arrayOfJSON);
                break;
    
            case "customer-forgot-password":
    
                break;
    
            case "customer-details":
                echo customerDetail($authHeader,$arrayOfJSON);
                break;
    
            case "customer-create-job":
                echo customerCreateJobs($arrayOfJSON);
                break;
    
            default:
                die();
        }
    }
    else{
        die();
    }

    die();
?>
