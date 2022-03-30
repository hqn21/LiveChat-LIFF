<?
header('Content-Type: application/json; charset=UTF-8'); 

require("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") { 
    $userid = $_POST["userid"];
    if ($userid != null) {
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