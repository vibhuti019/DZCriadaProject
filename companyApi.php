<?php 


    function encrypt3($password){
        $encryptedPassword = md5($password);
        $chopEncryptedPassword = substr($encryptedPassword, 0, 8);
        $sendToDatabase = md5($chopEncryptedPassword);
        return $sendToDatabase; 
    }

    function companyRegister($arrayOfJson){

        $companyPassword = $arrayOfJson["companyPassword"];
        $companyConfirmPassword = $arrayOfJson["companyConfirmPassword"];
        $companyName = $arrayOfJson["companyName"];
        $companyEmail = $arrayOfJson["companyEmail"];
        $companyUEN = $arrayOfJson["companyUEN"];
        $companyAcra = $arrayOfJson["companyAcra"];


        if($companyPassword == $companyConfirmPassword){
            $companyPassword = encrypt2($companyPassword);
        }
        else{
            return "null";
        }

        $sql = "INSERT INTO `CompanyDetails` (`companyPassword`, `companyName`, `companyEmail`,`companyUEN`,`companyAcra`) VALUES ('".$companyPassword."', '".$companyName."', '".$companyEmail."','".$companyUEN."','".$companyAcra."');";

        
        executeQuery($sql);
        

        $token = md5($companyEmail);
        
        $array["companyName"] = $companyName;
        $array["companyEmail"] = $companyEmail;
        $array["Token"] = $token;

        $response["Data"] = $array;

        return json_encode($response);

    }


    function companyLogin($arrayOfJson){

        $companyEmail = $arrayOfJson["companyEmail"];
        $companyPassword = $arrayOfJson["companyPassword"];

        $companyPassword = encrypt($companyPassword);


        $sql = "SELECT * FROM `CompanyDetails` WHERE companyEmail= '".$companyEmail."';";

    
        $result = executeQuery($sql);

        
        if($row = $result->fetch_assoc()){
            $array["companyId"] = $row["companyId"];
            $array["companyName"] = $row["companyName"]; 
            $password = $row["companyPassword"];
            $array["companyEmail"] = $row["companyEmail"];
            if($companyPassword == $password){
                $array["token"] = encrypt($array["companyEmail"]);
                $response["Data"] = $array;
                return json_encode($response);
            }else{
                $Data["Error"] = "Invalid Credentials";
                $response["Data"] = $Data;
                return json_encode($response);
            }
        }else{
            echo "new";
        }

        return "Error In function";
        
        
    }

    function companyDetail($authToken,$arrayOfJson){
        $id = $arrayOfJson["companyId"];


        $sql = "SELECT * FROM `CompanyDetails` WHERE companyId= '".$id."';";

        $result = executeQuery($sql);

        if($row = $result->fetch_assoc()){
            $array["companyId"] = $row["companyId"];
            $array["companyName"] = $row["companyName"]; 
            $array["companyEmail"] = $row["companyEmail"];
            if(encrypt($array["companyEmail"]) == $authToken){
                $response["Data"] = $array;
                return json_encode($response);
            }
        }

        return "Error In function";

    }

    function companyEdit($arrayOfJson){
        $companyId = $arrayOfJson["companyId"];
        $companyName = $arrayOfJson["companyName"];
        $companyEmail = $arrayOfJson["companyEmail"];
        $companyUEN = $arrayOfJson["companyUEN"];
        $companyAcra = $arrayOfJson["companyAcra"];

        $sql = "UPDATE `CompanyDetails` SET `companyName` = '".$companyName."', `companyEmail` = '".$companyEmail."', `companyUEN` = '".$companyUEN."', `companyAcra` = '".$companyAcra."' WHERE `CompanyDetails`.`companyId` = ".$companyId." ";

        $result = executeQuery($sql);

        if($result){
            $response["Data"] = $arrayOfJson;
            return json_encode($response);
        }
        
        $response["Data"] = "Invalid Data";
        return json_encode($response);

    }   

    function companyChangePassword($arrayOfJson){
        $companyId = $arrayOfJson["companyId"];
        $companyPassword = $arrayOfJson["password"];
        $companyConfirmPassword = $arrayOfJson["confirmPassword"];
        
        if($companyPassword == $companyConfirmPassword){
            $companyPassword = encrypt2($companyPassword);
        }
        else{
            $response["Data"] = "Invalid Data";
            return json_encode($response);
        }

        $sql="UPDATE `CompanyDetails` SET `companyPassword` = '".$companyPassword."' WHERE `companyDetails`.`companyId` = ".$companyId." ";

        $result = executeQuery($sql);

        if($result){
            $response["Data"] = $arrayOfJson;
            return json_encode($response);
        }

        $response["Data"] = "Invalid Data";
        
        return json_encode($response);
    }
?>  
