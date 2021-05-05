<?php 

    if($_SERVER['SCRIPT_NAME'] != "/index.php"){
        die('FALSE');
    }


    class BasicService{
        protected $query;
        protected $requestHandler;
        protected $bodyArray;

        function __construct($requestHandler,$query){
            $this->query = $query;
            $this->requestHandler = $requestHandler;
            $this->bodyArray = $requestHandler->getBodyOfRequest();
        }
        

        private function encrypt($plaintext) {
            $method = "AES-256-CBC";
            $key = hash('sha256', $this->password, true);
            $iv = openssl_random_pseudo_bytes(16);
        
            $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
            $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);
        
            return $iv . $hash . $ciphertext;
        }


        private function createToken($userRole,$userData){
            $text = $userRole." 4.5.1.1.a.b.c.d ".$userData;
            $encryptedText = $this->encrypt($text);
            $token = base64_encode($encryptedText);
            $this->requestHandler->setRequestResponse("Auth",$token);
            $this->query->execute("INSERT INTO `SessionData` (`sessionToken`, `userRole`, `userData`) VALUES ('".$token."', '".$userRole."', '".$userData."');");
        }

        protected function login($userRole){
            $userId = $this->bodyArray["Mobile"];
            $userPassword = $this->bodyArray["Password"];
            $queryData["email"] = "mail@mail.com";
            $this->createToken($userRole,$queryData["email"]);
        }

        protected function logout(){
        }

        protected function forgotPassword($tableName){
        }

        protected function changePassword($tableName){
        }

        protected function changeDetails($tableName){
        }

    }


    class DriverRequest extends BasicService{
        function registerUser(){
            $requestData = $this->bodyArray;
            $query = "INSERT INTO `DriverDetails` (`name`, `email`, `mobile`, `password`, `picture`, `NRIC`, `vehicleType`, `vehicleNumber`) VALUES ('".$requestData["driverName"]."', '".$requestData["driverEmail"]."', '".$requestData["driverMobile"]."', '".$requestData["password"]."', '".$requestData["picture"]."', 'ksadj', '".$requestData["vehicleType"]."', '".$requestData["vehicleNumber"]."');"; 
            $this->query->execute($query);
            $this->requestHandler->setRequestResponse("Data",$requestData);
        }
    }

    class DriverCompanyRequest extends BasicService{
        function registerUser(){
        }
    }


    class AdminRequest extends BasicService{
        function registerUser(){
            
        }
    }

    class UserRequest extends BasicService{
        function registerUser(){
            
        }
    }



    // $requestHandler = new RequestHandler();
    // $response = $requestHandler->getBodyOfRequest();
    // $requestHandler->setRequestResponse("Hello",$response["Hello"]);
    // $requestHandler->setRequestResponse("Auth",$requestHandler->getAuthHeader());
    // $requestHandler->setRequestResponse("UserRole",$requestHandler->requstingUserRole());
    // $requestHandler->setRequestResponse("UserToken",$requestHandler->getAuthHeader());

?>