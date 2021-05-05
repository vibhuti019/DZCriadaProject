<?php


    class Query{

        private $conn;

        function __construct(){
          //Environment Values
          $servername = "localhost";
          $username = "root";
          $password = "root";
          $dbName = "DZCriada";

          // Create connection
          $this->conn = new mysqli($servername, $username, $password, $dbName);
          
          // Check connection
          if ($this->conn->connect_error) {
            die(json_encode(['Error Connection' => $this->conn->connect_error]));
          }
        
        }

        //Execute query
        function execute($query){

          
          $result = $this->conn->query($query);

          // echo var_dump($result);
          // echo var_dump($this);

          return $result;
      
        }

        function __destruct(){
          $this->conn->close();
        }
    }


    
?>