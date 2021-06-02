<?php

    
    //Checks if no other location is requested other than the main page
    if(end(explode('/',$_SERVER['SCRIPT_FILENAME'])) != "index.php"){
        echo "False";
        die();
    }



    include_once('./driverApi.php');
    include_once('./customerApi.php');
    include_once('./companyApi.php');
    include_once('./adminApi.php');

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
    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        die();
    }
    
    if(preg_match("/driver-/i", $requestedPath)){
        // echo "Yes";
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

            case "driver-accept-job":
                echo driverAcceptJob($arrayOfJSON);
                break;
    
            case "driver-edit":
                echo driverEdit($arrayOfJSON);
                break;

            case "driver-change-password":
                echo driverChangePassword($arrayOfJSON);
                break;
            default:
                die();
        }
    }
    elseif(preg_match("/company-/i", $requestedPath)){
        switch($requestedPath){
            case "company-register":
                echo companyRegister($arrayOfJSON);
                break;
    
            case "company-login":
                echo companyLogin($arrayOfJSON);
                break;
    
            case "company-forgot-password":
                break;    

            case "company-details":
                echo companyDetail($authHeader,$arrayOfJSON);
                break;

            case "company-edit":
                echo companyEdit($arrayOfJSON);
                break;

            case "company-change-password":
                echo companyChangePassword($arrayOfJSON);
                break;

            

            default:
                die();
        }
    }
    elseif(preg_match("/customer-/i", $requestedPath)){
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

            case "customer-job-complete":
                echo customerJobComplete($arrayOfJSON);
                break;
            
            case "customer-edit":
                echo customerEdit($arrayOfJSON);
                break;
            
            case "customer-job":
                echo customerJob($arrayOfJSON);
                break;

            case "customer-change-password":
                echo customerChangePassword($arrayOfJSON);
                break;
            
            case "customer-active-drivers":
                echo customerActiveDriver($arrayOfJSON);
                break;
            

            default:
                die();
        }
    }
    elseif(preg_match("/admin-/i", $requestedPath)){
        switch($requestedPath){
            case "admin-login":
                echo adminLogin($arrayOfJSON);
                break;
            
            case "admin-all-jobs":
                echo adminAllJobs($arrayOfJSON);
                break;

            case "admin-whole-drivers":
                echo adminWholeDrivers($arrayOfJSON);
                break;

            case "admin-whole-customers":
                echo adminWholeCustomers($arrayOfJSON);
                break;
        }
    }
    else{
        die();
    }

    die();
?>
