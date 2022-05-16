# livechat-liff
English | [繁體中文](docs/README_zh-tw.md)
## About The Project
This is an online chat room website that can be an alternative to LINE original chat room when it can't provide one-to-one chat during your LINE@ account is in bot mode.
### Built With
* Firebase JS SDK
* LIFF API
* jQuery
* Bootstrap
* Font Awesome
* Flaticon
### Project Directory Structure
```
livechat-liff/
├── js/
│   └── livechat.js
├── php/
│   └── handler.php
├── index.php
└── liffPage.php
```
## Getting Started
Follow the instructions to set up the project locally.
### Prerequisites
* Apache
* PHP 7.2
* JavaScript ES6
### Installation
1. Clone the repo
   ```sh
   git clone https://github.com/hqn21/livechat-liff.git
   ```
2. Enter your Firebase Information in `js/livechat.js`
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
3. Enter your LIFF Information in `js/livechat.js`
   ```js
   liff.init({
       liffId: ''
   })
   ```
## License
Distributed under the MIT License. See [LICENSE](LICENSE) for more information.
## Contact
劉顥權 Haoquan Liu - [contact@haoquan.me](mailto:contact@haoquan.me)

Project Link: [https://github.com/hqn21/livechat-liff/](https://github.com/hqn21/livechat-liff/)
