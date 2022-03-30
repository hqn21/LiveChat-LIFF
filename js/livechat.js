// firebase 配置
var firebaseConfig = {
    apiKey: "",
    authDomain: "",
    projectId: "",
    storageBucket: "",
    messagingSenderId: "",
    appId: "",
    measurementId: ""
};
// 初始化 firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();

// 功能開始
var dataBase = firebase.firestore();

let user = firebase.auth().currentUser;

alert(user.uid);

function formatDate(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours ? hours : 12;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strDate = hours + ':' + minutes + ' ' + ampm;
    return strDate;
}

function sendMessage() {
    $('#chat-space').append('<div class="d-flex justify-content-end mb-3"><div class="card text-dark bg-light" style="max-width: 18rem;"><div class="card-body lh-1"><p class="card-text lh-sm mb-1">' + $('#message').val() + '</p><div class="d-flex flex-column justify-content-end align-items-end"><small class="align-bottom" style="font-size: 12px">' + formatDate(new Date()) + ' <div class="spinner-border spinner-border-sm align-top" style="width: 12px; height: 12px" role="status"><span class="visually-hidden">Loading...</span></div></small></div></div></div></div>');
    $('#message').attr('disabled', '');
    $('#messageButton').attr('disabled', '');
    $('#messageButton').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 發送');
    $.ajax({
        type: "POST",
        url: "php/handler.php",
        dataType: "json",
        data: {
            mode: 'time'
        },
        success: function (data) {
            insertData(data.toString(), $('#message').val());
            $('#message').val('');
        }
    });
}

function insertData(timestamp, message) {
    dataBase.collection($('#liffId').val()).doc(timestamp).set({
        timestamp: timestamp,
        seen: 'no',
        name: $('#liffName').val(),
        message: message
    })
        .then(function () {
            $('#message').removeAttr('disabled');
            $('#messageButton').removeAttr('disabled');
            $('#messageButton').html('<i class="fas fa-paper-plane"></i> 發送');
        })
}

function listenChange(userId) {
    var userId = userId ? userId : $('#liffId').val();
    var ref = dataBase.collection(userId).orderBy("timestamp", "asc");
    ref.onSnapshot(querySnapshot => {
        $('#chat-space').empty();
        $('#chat-space').removeClass('align-items-center');
        $('#chat-space').removeClass('justify-content-center');
        $('#chat-space').removeClass('flex-column');
        $('#chat-space').removeClass('d-flex');
        $('#message').removeAttr('disabled');
        $('#messageButton').removeAttr('disabled');
        $('#message').attr('placeholder', '要傳送的訊息');
        querySnapshot.forEach(doc => {
            var date = new Date(Number(doc.data()['timestamp']) * 1000);
            date = formatDate(date);
            if(doc.data()['name'] == $('#liffName').val()) {
                var check = doc.data()['seen'] == 'no' ? '' : '-double';
                $('#chat-space').append('<div class="d-flex justify-content-end mb-3"><div class="card text-dark bg-light" style="max-width: 18rem;"><div class="card-body lh-1"><p class="card-text lh-sm mb-1">' + doc.data()['message'] + '</p><div class="d-flex flex-column justify-content-end align-items-end"><small class="align-bottom" style="font-size: 12px">' + date + ' <i class="fas fa-check' + check + ' align-top" style="width: 12px; height: 12px"></i></small></div></div></div></div>');
            }
            else {
                if(doc.data()['seen'] == 'no') {
                    dataBase.collection(userId).doc(doc.data()['timestamp']).set({
                        timestamp: doc.data()['timestamp'],
                        seen: 'yes',
                        name: doc.data()['name'],
                        message: doc.data()['message']
                    })
                }
                var check = doc.data()['seen'] == 'no' ? '' : '-double';
                $('#chat-space').append('<div class="d-flex mb-3"><div class="card text-light bg-primary" style="max-width: 18rem;"><div class="card-body lh-1"><h5 class="card-title fs-6 mb-0">' + doc.data()['name'] + '</h5><p class="card-text lh-sm mb-1">' + doc.data()['message'] + '</p><div class="d-flex flex-column justify-content-end align-items-end"><small class="align-bottom" style="font-size: 12px">' + date + ' <i class="fas fa-check' + check + ' align-top" style="width: 12px; height: 12px"></i></small></div></div></div></div>');
            }
        });
        $('#chat-space').scrollTop($('#chat-space')[0].scrollHeight);
    });
}

// LIFF 部分
function liffInit() {
    liff.init({
        liffId: ''
    })
    .then(() => {
        if(!liff.isInClient()) {
            alert("請透過LINE官方帳號造訪此網頁。");
            window.location.href = 'https://lin.ee/EhAdvvy'
        }
        else {
            liff.getProfile().then(function(profile) {
                listenChange(profile.userId);
                $("#liffId").val(profile.userId);
                $("#liffName").val(profile.displayName);
                $("#liffNameShow").html(profile.displayName);
            })
            .catch(function(error) {
                alert("[錯誤] " + error);
            });
        }
    })
    .catch((error) => {
        alert("[錯誤] " + error);
    });
}

function getChatUrl() {
    liff.sendMessages([
        {
            type: 'text',
            text: "[即時聊天][取得連結]"
        }
    ])
    .then(() => {
        alert("[成功] 聊天室連結已顯示於聊天室。")
    })
    .catch((error) => {
        alert("[錯誤] " + error);
    });
}