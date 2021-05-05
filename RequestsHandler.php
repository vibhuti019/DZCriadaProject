<?php 

    class RequestHandler{
        private $bodyOfRequest;
        private $authHeader;
        private $responseForRequest;
        private $password = "Password";
        private $query;
        private $path;
        function __construct($query)
        {   
            $this->bodyOfRequest = file_get_contents('php://input');
            if(isset($_SERVER["HTTP_AUTH"])){
                $this->authHeader =  $_SERVER["HTTP_AUTH"];
            }
            $this->query = $query;
            $path = explode('/',$_SERVER['PATH_INFO']);
            $this->path = $path[1];
        }

        function getBodyOfRequest(){
            $arrayOfJSON = json_decode($this->bodyOfRequest, true);
            return $arrayOfJSON;
        }

        function getAuthHeader(){
            return $this->authHeader;
        }

        function getPath(){
            return $this->path;
        }
        
        function setRequestResponse($identifier,$value){
            $this->responseForRequest[$identifier] = $value; 
        }
        
        private function decrypt($ivHashCiphertext) {
            $method = "AES-256-CBC";
            $iv = substr($ivHashCiphertext, 0, 16);
            $hash = substr($ivHashCiphertext, 16, 32);
            $ciphertext = substr($ivHashCiphertext, 48);
            $key = hash('sha256', $this->password, true);
        
            if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;
        
            return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
        }      

        private function verifyTokenAndGetData(){
            $text = $this->getAuthHeader();
            $text = base64_decode($text);
            $data = preg_split('/ 4.5.1.1.a.b.c.d /',$this->decrypt($text));
            if($data[0] == "Admin" || $data[0] == "User" || $data[0] == "Driver" || $data[0] == "Driver Company"){
                return $data;
            }
            return null;
        }
        
        
        function requstingUserRole(){
            if($this->authHeader == null){
                return "crawler";
            }
            $tokenData = $this->verifyTokenAndGetData();
            if($tokenData == null){
                return "crawler";
            }
            else{
                return $tokenData[0];
            }
        }

        function __destruct()
        {
            header('X-Developed-By: DZ-Criada');
            // header("Content-Type: application/json");
            echo json_encode($this->responseForRequest);
        }
    }

    ?>