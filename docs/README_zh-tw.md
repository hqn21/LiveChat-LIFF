# livechat-liff
[English](https://github.com/hqn21/livechat-liff/blob/main/README.md) | 繁體中文
## 關於專案
此專案為一個線上即時聊天室網站，它可以在您的 LINE@ 開啟 Bot 模式而無法使用一對一聊天室的功能時，作為 LINE 原生聊天室的替代品，以達到與用戶一對一聊天的目的。
### 使用資源
* Firebase JS SDK
* LIFF API
* jQuery
* Bootstrap
* Font Awesome
* Flaticon
### 檔案結構
```
livechat-liff/
├── js/
│   └── livechat.js
├── php/
│   └── handler.php
├── index.php
└── liffPage.php
```
## 開始部屬
跟隨指示以在本地端部屬此專案。
### 事先準備
* Apache
* PHP 7.2
* JavaScript ES6
### 安裝步驟
1. 複製此 repo
   ```sh
   git clone https://github.com/hqn21/livechat-liff.git
   ```
2. 在 `js/livechat.js` 中輸入您的 Firebase 資訊
   ```js
   var firebaseConfig = {
       apiKey: "",
       authDomain: "",
       projectId: "",
       storageBucket: "",
       messagingSenderId: "",
       appId: "",
       measurementId: ""
   };
   ```
3. 在 `js/livechat.js` 中輸入您的 LIFF 資訊
   ```js
   liff.init({
       liffId: ''
   })
   ```
## License
根據 MIT License 發布，查看 [LICENSE](https://github.com/hqn21/livechat-liff/blob/main/LICENSE) 以獲得更多資訊。
## 聯絡我
劉顥權 Haoquan Liu - [contact@haoquan.me](mailto:contact@haoquan.me)

專案連結：[https://github.com/hqn21/livechat-liff/](https://github.com/hqn21/livechat-liff/)
