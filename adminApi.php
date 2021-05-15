<?php

    include_once('./databaseConnection.php');


    function encrypt3($password){
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
        $id = $arrayOfJson["adminId"];

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
            $responseData[$i] = $array;
            $i = $i + 1;
        }

        $Data["completedJobs"] = $responseData;


        $response["Data"] = $Data;
        return json_encode($response);
    }


    function adminWholeDrivers($arrayOfJson){
        $id = $arrayOfJson["adminId"];

        $sql = "SELECT * FROM `DriverDetails`;";

        $result = executeQuery($sql);

        if($row = $result->fetch_assoc()){
            $array["driverId"] = $row["id"];
            $array["driverName"] = $row["name"]; 
            $array["driverMobile"] = $row["mobile"];        
            $array["driverMail"] = $row["email"];
        
            $response["Data"] = $array;
            return json_encode($response);
            
        }

    }

    function adminWholeCompany($arrayOfJson){
        $id = $arrayOfJson["adminId"];

        $sql = "SELECT * FROM `companyDetails`;";

        $result = executeQuery($sql);

        if($row = $result->fetch_assoc()){
            $array["companyId"] = $row["id"];
            $array["companyName"] = $row["name"]; 
            $array["companyMobile"] = $row["mobile"];        
            $array["companyMail"] = $row["email"];
            $response["Data"] = $array;
            return json_encode($response);
        }

        return "Error In function";

    }

    function adminWholeCustomers($arrayOfJson){
        $sql = "SELECT * FROM `CustomerDetails`;";

        $result = executeQuery($sql);

        if($row = $result->fetch_assoc()){
            $array["customerId"] = $row["id"];
            $array["customerName"] = $row["name"]; 
            $array["customerMobile"] = $row["mobile"];        
            $password = $row["password"];
            $array["customerMail"] = $row["email"];
            $response["Data"] = $array;
            return json_encode($response);
        }

        return "Error In function";

    }

?>