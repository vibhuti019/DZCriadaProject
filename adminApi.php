<?php

    include_once('./databaseConnection.php');


    function encrypt4($password){
        $encryptedPassword = md5($password);
        $chopEncryptedPassword = substr($encryptedPassword, 0, 8);
        $sendToDatabase = md5($chopEncryptedPassword);
        return $sendToDatabase; 
    }


    function adminLogin($arrayOfJson){

        $adminMobile = $arrayOfJson["adminMobile"];
        $adminPassword = $arrayOfJson["adminPassword"];

        if($adminMobile == "987654321" && $adminPassword == "Password"){
            $response["Status"] = "200";
            return json_encode($response);
        }
        return "Database Error";
        
    }

    

    function adminAllJobs($arrayOfJson){
        
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

        $Data["unallocatedJobs"] = $responseData;

        $sql = "SELECT * FROM `Jobs` WHERE status= 'Assigned';";

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

        $Data["assignedJobs"] = $responseData;

        $sql = "SELECT * FROM `Jobs` WHERE status= 'Done';";

        $result = executeQuery($sql);

        $i =0;
        while($row = $result->fetch_assoc()){
            $array["jobId"] = $row["jobId"];
            $array["customerName"] = $row["customerName"]; 
            $array["deliveryTime"] = $row["deliveryTime"];        
            $array["dropOffLocation"] = $row["dropOffLocation"];        
            $array["pickupLocation"] = $row["pickupLocation"];        
            $array["requiredVehicle"] = $row["requiredVehicle"];  
            $array["assignedDriver"] = $row["assignedDriver"];
            $array["status"] = $row["status"];      
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $Data["completedJobs"] = $responseData;
        $response["Data"] = $Data;
        return json_encode($response);
    }


    function adminWholeDrivers($arrayOfJson){
        
        $sql = "SELECT * FROM `DriverDetails`;";

        $result = executeQuery($sql);

        $i =0;

        
        

        while($row = $result->fetch_assoc()){
            $array["driverId"] = $row["id"];
            $array["driverName"] = $row["name"]; 
            $array["driverMobile"] = $row["mobile"];        
            $array["driverMail"] = $row["email"];
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $response["Drivers"] = $responseData;

        return json_encode($response);

    }

    function adminWholeCompany($arrayOfJson){
        
        $sql = "SELECT * FROM `companyDetails`;";

        $result = executeQuery($sql);

        $i =0;

        while($row = $result->fetch_assoc()){
            $array["companyId"] = $row["id"];
            $array["companyName"] = $row["name"]; 
            $array["companyMobile"] = $row["mobile"];        
            $array["companyMail"] = $row["email"];
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $response["Drivers"] = $responseData;

        return json_encode($response);

    }

    function adminWholeCustomers($arrayOfJson){
        $sql = "SELECT * FROM `CustomerDetails`;";

        $result = executeQuery($sql);

        $i =0;

        while($row = $result->fetch_assoc()){
            $array["customerId"] = $row["customerId"];
            $array["customerName"] = $row["customerName"]; 
            $array["customerMobile"] = $row["customerMobile"];        
            $array["customerEmail"] = $row["customerEmail"];
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $response["Customer"] = $responseData;

        return json_encode($response);


    }

?>