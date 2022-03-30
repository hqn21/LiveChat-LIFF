<html>
    <head>
        <meta charset="utf8">
    </head>
    <body>
        <form id="damo">
            <select id="sel">
                <?php
                require "config.php";
                $already = "";
                $mysql = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
                $mysql->query("SET NAMES utf8");
                $data = $mysql->query("SELECT * FROM messages");
                for ($i=1; $i<=mysqli_num_rows($data); $i++) {
                    $datas = mysqli_fetch_row($data);
                    if ($already != $datas[0]) {
                        echo '<option value=' . $datas[0] . '>' . $datas[0] . '</option>';
                        $already = $datas[0];
                    }
                }
                ?>
            </select>
            <input id="mes" type="text">
            <button type="button" id="baton">發送</button>
        </form>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            $("#baton").click(function() {
                $.ajax({
                    type: "POST",
                    url: "service.php",
                    dataType: "json",
                    data: {
                        msg: $("#mes").val(),
                        userid: $("#sel").val(),
                        type: "admi"
                    },
                    success: function(data) {
                        $("#damo")[0].reset();
                    }
                })
            })
        });
        </script>
        
        
    </body>
</html>