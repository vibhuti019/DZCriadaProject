<?php


    class Query{

        private $conn;

        function __construct(){
          //Environment Values
          $servername = "localhost";
          $username = "vibhuti";
          $password = "root";
          $dbName = "DZCriada";

          // Create connection
          $this->conn = new mysqli($servername, $username, $password, $dbName);

          echo var_dump($this);
          die();          
          
          // Check connection
          if ($this->conn->connect_error) {
            die(json_encode(['Error Connection' => $this->conn->connect_error]));
          }

          echo var_dump($this);

        
        }

        //Execute query
        function execute($query){

          
          $result = $this->conn->query($query);

          
          return $result;
      
        }

        function __destruct(){
          $this->conn->close();
        }
    }


    
?>