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

        $sql = "INSERT INTO `CompanyDetails` (`companyPassword`, `companyName`, `companyEmail`,`companyUEN`,`companyAcra`) VALUES ('".$companyPassword."', '".$companyName."', '".$companyEmail."','".$companyUEN.",".$companyAcra.");";

        executeQuery($sql);

        $token = md5($companyEmail);
        
        $array["companyName"] = $companyName;
        $array["companyEmail"] = $companyEmail;
        $array["Token"] = $token;

        $response["Data"] = $array;

        return json_encode($response);

    }


    function companyLogin($arrayOfJson){

        $companyMobile = $arrayOfJson["companyMobile"];
        $companyPassword = $arrayOfJson["companyPassword"];

        $companyPassword = encrypt($companyPassword);


        $sql = "SELECT * FROM `CompanyDetails` WHERE comapnyMobile= '".$companyMobile."';";

        
        $result = executeQuery($sql);

        
        if($row = $result->fetch_assoc()){
            $array["companyId"] = $row["companyId"];
            $array["companyName"] = $row["companyName"]; 
            $array["companyMobile"] = $row["companyMobile"];        
            $password = $row["companyPassword"];
            $array["companyEmail"] = $row["companyEmail"];
            if($companyPassword == $password){
                $array["token"] = encrypt($array["companyEmail"]);
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

    function companyDetail($authToken,$arrayOfJson){
        $id = $arrayOfJson["companyId"];

        $sql = "SELECT * FROM `CompanyDetails` WHERE mobile= '".$id."';";

        $result = executeQuery($sql);

        if($row = $result->fetch_assoc()){
            $array["companyId"] = $row["companyId"];
            $array["companyName"] = $row["companyName"]; 
            $array["companyMobile"] = $row["companyMobile"];        
            $array["companyEmail"] = $row["companyEmail"];
            if(encrypt($array["companyEmail"]) == $authToken){
                $response["Data"] = $array;
                return json_encode($response);
            }
        }

        return "Error In function";

    }

?>  