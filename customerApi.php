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
                $array["token"] = encrypt($array["customerEmail"]);
                $response["Data"] = $array;
                return json_encode($response);
            }else{
                echo "new2";
            }
        }else{
            echo "new";
        }

        return false;
        
        
    }

    function customerDetail($authToken,$arrayOfJson){
        $id = $arrayOfJson["customerId"];

        $sql = "SELECT * FROM `CustomerDetails` WHERE mobile= '".$id."';";

        $result = executeQuery($sql);

        if($row = $result->fetch_assoc()){
            $array["customerId"] = $row["id"];
            $array["customerName"] = $row["name"]; 
            $array["customerMobile"] = $row["mobile"];        
            $password = $row["password"];
            $array["customerMail"] = $row["email"];
            if(encrypt($array["customerMail"]) == $authToken){
                $response["Data"] = $array;
                return json_encode($response);
            }
        }

        return false;

    }


    function customerCreateJobs($arrayOfJson){
        

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


        $sql = "INSERT INTO `Jobs` (`jobId`, `customerName`, `customerMobile`, `deliveryTime`, `dropOffLocation`, `dropUnitNumber`, `pickupLocation`, `pickupUnitNumber`, `requiredVehicle`, `priceOfDelivery`, `scheduleDelivery`, `scheduleDate`, `scheduleTime`, `driverNotes`, `paymentMode`, `paymentId`, `status`, `assignedDriver`) VALUES (".$jobId.", '".$customerName."', '".$customerMobile."', '".$deliveryTime."', '".$dropOffLocation."', '".$dropUnitNumber."', '".$pickupLocation."', '".$pickupUnitNumber."', '".$requiredVehicle."', '".$priceOfDelivery."', '".$scheduleDelivery."', '".$scheduleDate."', '".$scheduleTime."', '".$driverNotes."', '".$paymentMode."', '".$paymentId."', 'Booked', 'None') ;";

        executeQuery($sql);

        $array["jobId"] = $jobId;
        $array["message"] = "Job created successfully";
        $array["dropOffLocation"] = $dropOffLocation;

        $response["Data"] = $array;

        return json_encode($array);

    }

    
?>