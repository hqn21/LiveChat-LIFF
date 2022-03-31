# livechat-liff
利用 Firebase 和 MySQL 兩種方法完成即時聊天的效果。
## Firebase
主要由 JavaScript 編寫，利用其中 Firestore 提供的寫入資料、讀取資料、監聽實時資料的 function 以達成即時聊天的目的。
### 網頁結構
```
livechat-liff/
│
├── js/
│   └── livechat.js           ｜ LIFF API 與 FireBase 主要檔案
│
├── php/
│   └── handler.php           ｜ 後端資料主要處理檔案
│
├── index.php                 ｜ 
│
└── liffPage.php              ｜ 
```

## MySQL
