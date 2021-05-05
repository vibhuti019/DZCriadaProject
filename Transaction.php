<?php

    if($_SERVER['SCRIPT_NAME'] != "/index.php"){
        die('FALSE');
    }


    class PaymentTransaction {
        private $query;
        private $requestHandler;
        
        function __construct($query,$requestHandler){
            $this->query = $query;
            $this->requestHandler = $requestHandler;
        }

        function makeTransaction() {
        }

        function getTransactions() {
        }

        function addMoneyToWallet() {
        }

        function getWalletDetails() {
        }
    }

?>