<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>即時聊天 - WEB</title>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-firestore.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
            https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-analytics.js"></script>

    <!-- JQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- LiveChat -->
    <script src="js/livechat.js"></script>

    <!-- BootStrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b3258fe523.js" crossorigin="anonymous"></script>
</head>

<body onload="listenChange()" class="bg-dark">
    <input type="hidden" id="liffId" value="<?php echo $_GET['id']; ?>">
    <input type="hidden" id="liffName" value="測試用戶">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/livechat.png" alt="" width="30" height="30" class="d-inline-block align-top">
                <strong>LiveChat</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">註冊會員</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">登入帳號</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container sm text-light mt-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-light">您的名稱</li>
                <li class="breadcrumb-item text-light" aria-current="page">測試用戶</li>
            </ol>
        </nav>
        <div id="chat-space" class="container fluid text-light d-flex flex-column justify-content-center align-items-center" style="position: relative; overflow-x: hidden; overflow-y: scroll; width: auto; height: 490px;">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="input-group mb-3 mt-3">
            <input id="message" type="text" class="form-control" placeholder="要傳送的訊息">
            <button onclick="sendMessage()" id="messageButton" class="btn btn-secondary" type="button"><i class="fas fa-paper-plane"></i> 發送</button>
        </div>
    </div>

    <!-- BootStrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>