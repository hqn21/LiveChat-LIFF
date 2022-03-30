<?php

require("config.php");

function saveMsg($userid, $msg, $type, $mysql_hostname, $mysql_username, $mysql_password, $mysql_database) {
    $time = time();
    $mysql = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
    $mysql->query("SET NAMES utf8");
    $mysql->query("INSERT INTO messages (userid, message, type) VALUES ('$userid' , '$msg' , '$type')");
    $select = $mysql->query("SELECT * FROM timing WHERE userid='$userid'");
    if (mysqli_num_rows($select)) {
        $mysql->query("UPDATE timing SET timestamp='$time' WHERE userid='$userid'");
    }
    else {
        $mysql->query("INSERT INTO timing (userid, timestamp) VALUES ('$userid' , '$time')");
    }
}

header('Content-Type: application/json; charset=UTF-8'); 

if ($_SERVER['REQUEST_METHOD'] == "POST") { 
    $msg = $_POST["msg"];
    $userid = $_POST["userid"];
    $type = $_POST["type"];
    if ($msg != null) {
        saveMsg($userid, $msg, $type, $mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
        $mysql = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
        $mysql->query("SET NAMES utf8");
        $data = $mysql->query("SELECT * FROM messages WHERE userid='$userid'");
        $info = array();
        while ($datas = mysqli_fetch_row($data)) {
            $info[] = $datas;
        }
        echo json_encode($info);
    }
} else {
    echo json_encode(array(
        'errorMsg' => '請使用正確的請求方式。'
    ));
}
?>