<?php

    if($_SERVER['SCRIPT_NAME'] != "/index.php"){
        die('FALSE');
    }

    class ChatMessaging {
        private $senderId;
        private $recieverId;
        private $senderName;
        private $recieverName;
        private $messageId;

        function __construct($senderId,$recieverId,$senderName,$recieverName){
            $this->senderId = $senderId;
            $this->recieverId = $recieverId;
            $this->senderName = $senderName;
            $this->recieverName = $recieverName;
        }

        function sendMessage() {
            global $query;
        }
        
        function getAllMessages() {
            global $query;
        }
        
        function addMessage() {
            global $query;
        }

        function setMessageId(){
            global $query;
        }
    }

?>