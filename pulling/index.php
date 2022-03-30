<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.3/tocas.css">
        <title>LiveChat</title>
        <style>
        #result {
            height:400px;
            width:100%;
            overflow:scroll;
        }
        </style>
    </head>
    <body>
        <div id="loader" class="ts active dimmer" style="z-index:9999;">
            <div class="ts text loader">讀取中</div>
        </div>
        
        <div class="ts container">
            <h1>LiveChat</h1>
            <hr>
        </div>
        
        <div class="ts container">
            <div class="ts speeches">
                <div id="result">
                <?php
                require "config.php";
                if ($_GET['userid'] != null) {
                    $userid = $_GET['userid'];
                    $mysql = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
                    $mysql->query("SET NAMES utf8");
                    $data = $mysql->query("SELECT * FROM messages WHERE userid = '$userid'");
                    for ($i=1; $i<=mysqli_num_rows($data); $i++) {
                        $datas = mysqli_fetch_row($data);
                        if ($datas[2] == "user") {
                            echo '<div class="right pointing positive speech"><div class="content">' . $datas[1] . '</div></div>';
                        }
                        else {
                            echo '<div class="left pointing speech"><div class="author">Admin</div><div class="avatar"><img src="user.png"></div><div class="content">' . $datas[1] . '</div></div>';
                        }
                    }
                    //$mysql->close();
                    echo '<script>document.getElementById("loader").setAttribute("class", "ts disabled loader");</script>';
                }
                ?>
                </div>
            </div>
        </div>
        
        <div class="ts container">
            <hr>
            <form id="demo">
                <div class="ts fluid action input">
                    <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                    <input id="msg" type="text" placeholder="你要說甚麼？" onchange="check()">
                    <button class="ts disabled button" type="button" id="submitExample">發送</button>
                </div>
            </form>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
        function check() {
            if (document.getElementById("msg").value.split(' ').join('').length < 1) {
                document.getElementById("submitExample").setAttribute("class", "ts disabled button");
            }
            else {
                document.getElementById("submitExample").setAttribute("class", "ts button");
            }
        }
        
        $(document).ready(function() {
            $("#result").scrollTop( $(document).height()+100 );
            
            $("#submitExample").click(function() {
                $.ajax({
                    type: "POST",
                    url: "service.php",
                    dataType: "json",
                    data: {
                        msg: $("#msg").val(),
                        userid: $("#userid").val(),
                        type: "user"
                    },
                    success: function(data) {
                        if (data) {
                            $("#demo")[0].reset();
                            document.getElementById("submitExample").setAttribute("class", "ts disabled button");
                            $("#result").html('');
                            for(var i = 0; i < data.length; i++) {
                                if (data[i][2] == "user") {
                                    $("#result").html($("#result").html() + '<div class="right pointing positive speech"><div class="content">' + data[i][1] + '</div></div>');
                                }
                                else {
                                    $("#result").html($("#result").html() + '<div class="left pointing speech"><div class="author">Admin</div><div class="avatar"><img src="user.png"></div><div class="content">' + data[i][1] + '</div></div>');
                                }
                            }
                            $("#result").scrollTop( $(document).height()+100 );
                        }
                    }
                })
            })
        });
        
        setInterval(function(){
            $.ajax({
                type: "POST",
                url: "refresh.php",
                dataType: "json",
                data: {
                    userid: $("#userid").val()
                },
                success: function(data) {
                    if (data) {
                        $("#result").html('');
                        for(var i = 0; i < data.length; i++) {
                            if (data[i][2] == "user") {
                                $("#result").html($("#result").html() + '<div class="right pointing positive speech"><div class="content">' + data[i][1] + '</div></div>');
                            }
                            else {
                                $("#result").html($("#result").html() + '<div class="left pointing speech"><div class="author">Admin</div><div class="avatar"><img src="user.png"></div><div class="content">' + data[i][1] + '</div></div>');
                            }
                        }
                        //$("#result").scrollTop( $(document).height()+100 );
                    }
                }
            })
        }, 100);
        </script>
        </div>
    </body>
</html>