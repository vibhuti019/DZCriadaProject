<?php 


    function encrypt3($password){
        $encryptedPassword = md5($password);
        $chopEncryptedPassword = substr($encryptedPassword, 0, 8);
        $sendToDatabase = md5($chopEncryptedPassword);
        return $sendToDatabase; 
    }

    function companyRegister($arrayOfJson){

        $companyMobile = $arrayOfJson["companyMobile"];
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

        $sql = "INSERT INTO `companyDetails` (`companyMobile`, `companyPassword`, `companyName`, `companyEmail`,`companyUEN`,`companyAcra`) VALUES ('".$companyMobile."', '".$companyPassword."', '".$companyName."', '".$companyEmail."','".$companyUEN.",".$companyAcra.");";

        executeQuery($sql);

        $token = md5($companyEmail);
        
        $array["companyName"] = $companyName;
        $array["companyMobile"] = $companyMobile;
        $array["companyEmail"] = $companyEmail;
        $array["Token"] = $token;

        $response["Data"] = $array;

        return json_encode($response);

    }


    function companyLogin($arrayOfJson){

        $companyMobile = $arrayOfJson["companyMobile"];
        $companyPassword = $arrayOfJson["companyPassword"];

        $companyPassword = encrypt($companyPassword);


        $sql = "SELECT * FROM `companyDetails` WHERE mobile= '".$companyMobile."';";

        
        $result = executeQuery($sql);

        
        if($row = $result->fetch_assoc()){
            $array["companyId"] = $row["id"];
            $array["companyName"] = $row["name"]; 
            $array["companyMobile"] = $row["mobile"];        
            $password = $row["password"];
            $array["companyMail"] = $row["email"];
            if($companyPassword == $password){
                $array["token"] = encrypt($array["email"]);
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

        $sql = "SELECT * FROM `companyDetails` WHERE mobile= '".$id."';";

        $result = executeQuery($sql);

        if($row = $result->fetch_assoc()){
            $array["companyId"] = $row["id"];
            $array["companyName"] = $row["name"]; 
            $array["companyMobile"] = $row["mobile"];        
            $password = $row["password"];
            $array["companyMail"] = $row["email"];
            if(encrypt($array["companyMail"]) == $authToken){
                $response["Data"] = $array;
                return json_encode($response);
            }
        }

        return "Error In function";

    }

?>  