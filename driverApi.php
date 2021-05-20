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
            return "Error In function";
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

        return "Database Error";
        
    }

    function driverDetails($authToken, $arrayOfJson){
        $id = $arrayOfJson["driverId"];

        $sql = "SELECT * FROM `DriverDetails` WHERE id= '".$id."';";

        $result = executeQuery($sql);

        if($row = $result->fetch_assoc()){
            $array["driverId"] = $row["id"];
            $array["driverName"] = $row["name"]; 
            $array["driverMobile"] = $row["mobile"];        
            $array["driverMail"] = $row["email"];
            if(encrypt($array["driverMail"]) == $authToken){
                $response["Data"] = $array;
                return json_encode($response);
            }
        }

        return "Wrong Driver Id";
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

        $i =0;
        $result = executeQuery($sql);
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
        $id = $arrayOfJson["jobId"];

        $sql = "SELECT * FROM `Jobs` WHERE jobId='".$id."';";

        $result = executeQuery($sql);


        $i =0;
        while($row = $result->fetch_assoc()){
            $array["jobId"] = $row["jobId"];
            $array["customerName"] = $row["customerName"]; 
            $array["customerMobile"] = $row["customerMobile"]; 
            $array["deliveryTime"] = $row["deliveryTime"];        
            $array["dropOffLocation"] = $row["dropOffLocation"];        
            $array["dropUnitNumber"] = $row["dropUnitNumber"];
            $array["pickupLocation"] = $row["pickupLocation"];
            $array["pickupUnitNumber"] = $row["pickupUnitNumber"];        
            $array["requiredVehicle"] = $row["requiredVehicle"];  
            $array["priceOfDelivery"] = $row["priceOfDelivery"];
            $array["driverNotes"] = $row["driverNotes"];     
            $array["scheduleDelivery"] = $row["scheduleDelivery"];     
            $array["scheduleDate"] = $row["scheduleDate"];
            $array["status"] = $row["status"];
            $array["assignedDriverId"] = $row["assignedDriver"];
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $response["Data"] = $responseData;
        
        return json_encode($response);
    
    }


    function driverAcceptJob($arrayOfJson){
        $driverId = $arrayOfJson["driverId"];
        $jobId = $arrayOfJson["jobId"];

        
        $sql = "Update `Jobs` Set assignedDriver=\"".$driverId."\", status=\"Assigned\" Where jobId=\"".$jobId."\";";
        $result= executeQuery($sql);

        if($result){
            $response["Data"] = "Driver Assigned";
            return json_encode($response);
        }
        
        $response["Data"] = "Invalid Data";
        return json_encode($response);


    }

?>