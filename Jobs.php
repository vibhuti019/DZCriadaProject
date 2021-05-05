<?php


    if($_SERVER['SCRIPT_NAME'] != "/index.php"){
        die('FALSE');
    }


    trait Jobs {
        function availableJobs($driverId, $jobLocation) {
            global $query;
        }
        function jobsHistory() {
            global $query;
        }
        function modifyJob() {
            global $query;
        }
        function createJob($jobLocation) {
            global $query;
        }
    }

?>