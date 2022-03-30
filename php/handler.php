<?php 

date_default_timezone_set("Asia/Taipei");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mode = $_POST['mode'];
    if($mode == 'time') {
        echo time();
    }
}