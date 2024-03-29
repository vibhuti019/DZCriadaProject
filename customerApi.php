<?php

    function encrypt2($password){
        $encryptedPassword = md5($password);
        $chopEncryptedPassword = substr($encryptedPassword, 0, 8);
        $sendToDatabase = md5($chopEncryptedPassword);
        return $sendToDatabase; 
    }

    function customerRegister($arrayOfJson){

        $customerMobile = $arrayOfJson["customerMobile"];
        $customerPassword = $arrayOfJson["customerPassword"];
        $customerConfirmPassword = $arrayOfJson["customerConfirmPassword"];
        $customerName = $arrayOfJson["customerName"];
        $customerEmail = $arrayOfJson["customerEmail"];

        if($customerPassword == $customerConfirmPassword){
            $customerPassword = encrypt2($customerPassword);
        }
        else{
            return "null";
        }

        $sql = "INSERT INTO `CustomerDetails` (`customerMobile`, `customerPassword`, `customerName`, `customerEmail`) VALUES ('".$customerMobile."', '".$customerPassword."', '".$customerName."', '".$customerEmail."');";

        executeQuery($sql);



        $token = md5($customerEmail);
        
        $array["customerName"] = $customerName;
        $array["customerMobile"] = $customerMobile;
        $array["customerEmail"] = $customerEmail;
        $array["Token"] = $token;

        $response["Data"] = $array;

        return json_encode($response);

    }


    function customerLogin($arrayOfJson){

        
        $customerMobile = $arrayOfJson["customerMobile"];
        $customerPassword = $arrayOfJson["customerPassword"];

        $customerPassword = encrypt($customerPassword);


        $sql = "SELECT * FROM `CustomerDetails` WHERE customerMobile= '".$customerMobile."';";

        
        $result = executeQuery($sql);

        
        if($row = $result->fetch_assoc()){
            $array["customerId"] = $row["customerId"];
            $array["customerName"] = $row["customerName"]; 
            $array["customerMobile"] = $row["customerMobile"];        
            $password = $row["customerPassword"];
            $array["customerMail"] = $row["customerEmail"];
            if($customerPassword == $password){
                $array["token"] = encrypt($array["customerMail"]);
                $response["Data"] = $array;
                return json_encode($response);
            }else{
                echo "new2";
            }
        }else{
            echo "new";
        }

        return "Error In function";
        
        
    }

    function customerDetail($authToken,$arrayOfJson){
        $id = $arrayOfJson["customerId"];
                      
        $sql = "SELECT * FROM `CustomerDetails` WHERE customerId= '".$id."';";

        $result = executeQuery($sql);

        if($row = $result->fetch_assoc()){
            $array["customerId"] = $row["customerId"];
            $array["customerName"] = $row["customerName"]; 
            $array["customerMobile"] = $row["customerMobile"];        
            $array["customerMail"] = $row["customerEmail"];
            if(encrypt($array["customerMail"]) == $authToken){
                $response["Data"] = $array;
                return json_encode($response);
            }
        }

        return "Error In function";

    }


    function customerCreateJobs($arrayOfJson){
        

        $customerId = $arrayOfJson["customerId"];
        $customerName = $arrayOfJson["customerName"];
        $customerMobile = $arrayOfJson["customerMobile"];
        $deliveryTime = $arrayOfJson["deliveryTime"];
        $dropOffLocation = $arrayOfJson["dropOffLocation"];
        $dropUnitNumber = $arrayOfJson["dropUnitNumber"];
        $pickupLocation = $arrayOfJson["pickupLocation"];
        $pickupUnitNumber = $arrayOfJson["pickupUnitNumber"];
        $requiredVehicle = $arrayOfJson["requiredVehicle"];
        $priceOfDelivery = $arrayOfJson["priceOfDelivery"];
        $scheduleDelivery = $arrayOfJson["scheduleDelivery"];
        $scheduleDate = $arrayOfJson["scheduleDate"];
        $scheduleTime = $arrayOfJson["scheduleTime"];
        $driverNotes = $arrayOfJson["driverNotes"];
        $paymentMode = $arrayOfJson["paymentMode"];
        $paymentId = $arrayOfJson["paymentId"];
        $jobId = rand();


        $sql = "INSERT INTO `Jobs` (`jobId`, `customerName`, `customerMobile`, `deliveryTime`, `dropOffLocation`, `dropUnitNumber`, `pickupLocation`, `pickupUnitNumber`, `requiredVehicle`, `priceOfDelivery`, `scheduleDelivery`, `scheduleDate`, `scheduleTime`, `driverNotes`, `paymentMode`, `paymentId`, `status`, `assignedDriver`,`customerId`) VALUES (".$jobId.", '".$customerName."', '".$customerMobile."', '".$deliveryTime."', '".$dropOffLocation."', '".$dropUnitNumber."', '".$pickupLocation."', '".$pickupUnitNumber."', '".$requiredVehicle."', '".$priceOfDelivery."', '".$scheduleDelivery."', '".$scheduleDate."', '".$scheduleTime."', '".$driverNotes."', '".$paymentMode."', '".$paymentId."', 'Booked', 'None','".$customerId."') ;";

        executeQuery($sql);

        $array["jobId"] = $jobId;
        $array["message"] = "Job created successfully";
        $array["dropOffLocation"] = $dropOffLocation;

        $response["Data"] = $array;

        return json_encode($array);

    }

    function customerJobComplete($arrayOfJson){
        $jobId = $arrayOfJson["jobId"];
        
        $sql = "Update `Jobs` Set status=\"Done\" Where jobId=\"".$jobId."\";";

        $result = executeQuery($sql);

        if($result){
            $response["Data"] = "Customer Reached";
            return json_encode($response);
        }
        
        $response["Data"] = "Invalid Data";
        return json_encode($response);

    }

    function customerEdit($arrayOfJson){
        $customerMobile = $arrayOfJson["customerMobile"];
        $customerId = $arrayOfJson["customerId"];
        $customerName = $arrayOfJson["customerName"];
        $customerEmail = $arrayOfJson["customerEmail"];

        $sql="UPDATE `CustomerDetails` SET `customerMobile` = '".$customerMobile."', `customerName` = '".$customerName."', `customerEmail` = '".$customerEmail."' WHERE `CustomerDetails`.`customerId` = ".$customerId." ";

        $result = executeQuery($sql);

        if($result){
            $response["Data"] = $arrayOfJson;
            return json_encode($response);
        }
        
        $response["Data"] = "Invalid Data";
        return json_encode($response);

    }

    function customerJob($arrayOfJson){
        $id = $arrayOfJson["customerId"];

        $sql = "SELECT * FROM `Jobs` WHERE customerId='".$id."';";

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
            $array["scheduleTime"] = $row["scheduleTime"];
            $array["status"] = $row["status"];
            $array["assignedDriverId"] = $row["assignedDriver"];
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $response["Data"] = $responseData;
        
        return json_encode($response);
    }
    
    function customerChangePassword($arrayOfJson){
        $customerId = $arrayOfJson["customerId"];
        $customerPassword = $arrayOfJson["password"];
        $customerConfirmPassword = $arrayOfJson["confirmPassword"];
        
        if($customerPassword == $customerConfirmPassword){
            $customerPassword = encrypt2($customerPassword);
        }
        else{
            $response["Data"] = "Invalid Data";
            return json_encode($response);
        }

        $sql="UPDATE `CustomerDetails` SET `customerPassword` = '".$customerPassword."' WHERE `CustomerDetails`.`customerId` = ".$customerId." ";

        $result = executeQuery($sql);

        if($result){
            $response["Data"]["Message"] = "Password successfully changed";
            return json_encode($response);
        }

        $response["Data"] = "Invalid Data";
        
        return json_encode($response);
    }

    function customerActiveDriver($arrayOfJson){
        $customerId = $arrayOfJson["customerId"];
        

        $sql = "Select * from DriverDetails Where id IN (Select assignedDriver from Jobs Where customerId = ".$customerId." AND assignedDriver <> 'None');";
    
        $result = executeQuery($sql);

        $i =0;
        while($row = $result->fetch_assoc()){
            $array["driverId"] = $row["id"];
            $array["driverName"] = $row["name"]; 
            $array["driverMobile"] = $row["mobile"];        
            $array["driverMail"] = $row["email"];
            $array["driverPicture"] = $row["picture"];
            $array["driverVehicleType"] = $row["vehicleType"];
            $array["driverVehicleNumber"] = $row["vehicleNumber"];
            $array["driverNRIC"] = $row["NRIC"];
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $response["Data"] = $responseData;
        
        return json_encode($response);
    }
?>