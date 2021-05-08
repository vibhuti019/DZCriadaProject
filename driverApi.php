<?php

    include_once('./databaseConnection.php');


    function encryptPassword($password){
        $encryptedPassword = md5($password);
        $chopEncryptedPassword = substr($encryptedPassword, 0, 8);
        $sendToDatabase = md5($chopEncryptedPassword);
        return $sendToDatabase; 
    }

    function driverRegister($arrayOfJson){

        $driverMobile = $arrayOfJson["driverMobile"];
        $driverPassword = $arrayOfJson["driverPassword"];
        $driverConfirmPassword = $arrayOfJson["driverConfirmPassword"];
        $driverName = $arrayOfJson["driverName"];
        $driverPicture = $arrayOfJson["driverPicture"];
        $driverEmail = $arrayOfJson["driverEmail"];
        $driverNRIC = $arrayOfJson['driverNRIC'];
        $driverVehicleType = $arrayOfJson["driverVehicleType"];
        $driverVehicleNumber = $arrayOfJson["driverVehicleNumber"];

        if($driverPassword == $driverConfirmPassword){
            $driverPassword = encryptPassword($driverPassword);
        }else {
            die('TRUE');
        }

        $sql = "INSERT INTO `DriverDetails` (`name`, `email`, `mobile`, `password`, `picture`, `NRIC`, `vehicleType`, `vehicleNumber`) VALUES ('".$driverName."', '".$driverEmail."', '".$driverMobile."', '".$driverPassword."', '".$driverPicture."', '".$driverNRIC."', '".$driverVehicleType."', '".$driverVehicleNumber."');";

        $result = executeQuery($sql);
        
        $token = md5($driverEmail);
        
        $array["driverName"] = $driverName;
        $array["driverMobile"] = $driverMobile;
        $array["driverEmail"] = $driverEmail;
        $array["Token"] = $token;

        $response["Data"] = $array;
        
        return json_encode($response);
        
    }


    function driverLogin($driverMobile,$driverPassword ){

        $driverPassword = encryptPassword($driverPassword);

        $sql = "SELECT * FROM `DriverDetails` WHERE email= 'mail@mail.com';";

        $result = executeQuery($sql);

        return $result;
        
    }

    function driverDetails(){

    }


    function driverAvailableJobs(){

    }


    function driverActiveJobs(){

    }

    function driverHistoryJobs(){


    }

    function driverJobDetail(){

    }


    function verifyDriverAuth(){
        
    }
?>