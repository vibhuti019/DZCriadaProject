<?php

    include_once('./databaseConnection.php');


    function encrypt($password){
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
            $driverPassword = encrypt($driverPassword);
        }else {
            return false;
        }

        $sql = "INSERT INTO `DriverDetails` (`name`, `email`, `mobile`, `password`, `picture`, `NRIC`, `vehicleType`, `vehicleNumber`) VALUES ('".$driverName."', '".$driverEmail."', '".$driverMobile."', '".$driverPassword."', '".$driverPicture."', '".$driverNRIC."', '".$driverVehicleType."', '".$driverVehicleNumber."');";

        executeQuery($sql);
        
        $token = md5($driverEmail);
        
        $array["driverName"] = $driverName;
        $array["driverMobile"] = $driverMobile;
        $array["driverEmail"] = $driverEmail;
        $array["Token"] = $token;

        $response["Data"] = $array;
        
        return json_encode($response);
        
    }


    function driverLogin($arrayOfJson){

        $driverMobile = $arrayOfJson["driverMobile"];
        $driverPassword = $arrayOfJson["driverPassword"];

        $driverPassword = encrypt($driverPassword);


        $sql = "SELECT * FROM `DriverDetails` WHERE mobile= '".$driverMobile."';";

        
        $result = executeQuery($sql);

        
        if($row = $result->fetch_assoc()){
            $array["driverId"] = $row["id"];
            $array["driverName"] = $row["name"]; 
            $array["driverMobile"] = $row["mobile"];        
            $password = $row["password"];
            $array["driverMail"] = $row["email"];
            if($driverPassword == $password){
                $array["token"] = encrypt($array["driverMail"]);
                $response["Data"] = $array;
                return json_encode($response);
            }
        }

        return false;
        
    }

    function driverDetails($authToken, $arrayOfJson){
        $id = $arrayOfJson["driverId"];

        $sql = "SELECT * FROM `DriverDetails` WHERE mobile= '".$id."';";

        $result = executeQuery($sql);

        if($row = $result->fetch_assoc()){
            $array["driverId"] = $row["id"];
            $array["driverName"] = $row["name"]; 
            $array["driverMobile"] = $row["mobile"];        
            $password = $row["password"];
            $array["driverMail"] = $row["email"];
            if(encrypt($array["driverMail"]) == $authToken){
                $response["Data"] = $array;
                return json_encode($response);
            }
        }

        return false;
    }


    function driverAvailableJobs($authToken,$arrayOfJson){
        $id = $arrayOfJson["driverId"];

        $sql = "SELECT * FROM `Jobs` WHERE status= 'Booked';";

        $result = executeQuery($sql);

        $i =0;
        while($row = $result->fetch_assoc()){
            $array["jobId"] = $row["jobId"];
            $array["customerName"] = $row["customerName"]; 
            $array["deliveryTime"] = $row["deliveryTime"];        
            $array["dropOffLocation"] = $row["dropOffLocation"];        
            $array["pickupLocation"] = $row["pickupLocation"];        
            $array["requiredVehicle"] = $row["requiredVehicle"];        
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $response["Data"] = $responseData;
        
        return json_encode($response);
    }


    function driverActiveJobs($arrayOfJson){
        $id = $arrayOfJson["driverId"];

        $sql = "SELECT * FROM `Jobs` WHERE status= 'Assigned' AND assignedDriver='".$id."';";

        $result = executeQuery($sql);
        $array = 0;
        $responseData = 0;

        $i =0;
        while($row = $result->fetch_assoc()){
            $array["jobId"] = $row["jobId"];
            $array["customerName"] = $row["customerName"]; 
            $array["deliveryTime"] = $row["deliveryTime"];        
            $array["dropOffLocation"] = $row["dropOffLocation"];        
            $array["pickupLocation"] = $row["pickupLocation"];        
            $array["requiredVehicle"] = $row["requiredVehicle"];        
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $response["Data"] = $responseData;
        
        return json_encode($response);
    
    }

    function driverHistoryJobs($arrayOfJson){
        $id = $arrayOfJson["driverId"];

        $sql = "SELECT * FROM `Jobs` WHERE status= 'Done' AND assignedDriver='".$id."';";

        $result = executeQuery($sql);
        $array = 0;
        $responseData = 0;

        $i =0;
        while($row = $result->fetch_assoc()){
            $array["jobId"] = $row["jobId"];
            $array["customerName"] = $row["customerName"]; 
            $array["deliveryTime"] = $row["deliveryTime"];        
            $array["dropOffLocation"] = $row["dropOffLocation"];        
            $array["pickupLocation"] = $row["pickupLocation"];        
            $array["requiredVehicle"] = $row["requiredVehicle"];        
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $response["Data"] = $responseData;
        
        return json_encode($response);
    

    }

    function driverJobDetail($arrayOfJson){
        $id = $arrayOfJson["driverId"];

        $sql = "SELECT * FROM `Jobs` WHERE assignedDriver='".$id."';";

        $result = executeQuery($sql);
        $array = 0;
        $responseData = 0;


        $i =0;
        while($row = $result->fetch_assoc()){
            $array["jobId"] = $row["jobId"];
            $array["customerName"] = $row["customerName"]; 
            $array["deliveryTime"] = $row["deliveryTime"];        
            $array["dropOffLocation"] = $row["dropOffLocation"];        
            $array["pickupLocation"] = $row["pickupLocation"];        
            $array["requiredVehicle"] = $row["requiredVehicle"];        
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $response["Data"] = $responseData;
        
        return json_encode($response);
    
    }


?>