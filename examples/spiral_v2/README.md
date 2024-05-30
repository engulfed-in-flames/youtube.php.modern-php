# ディレクトリ構造について

`spiral_v2`ディレクトリ構造の成り立ちについて説明します。主に考慮したのは以下の 2 点です。

-   SPIRAL V2 の仕様
-   既存の PHP フレームワークのディレクトリ構造

特に参考にした PHP フレームワークは**Laravel**です。選定理由は、Laravel が PHP フレームワークの中でも一番モダンウェブ開発のやり方に近いし、使用頻度が高いからです。

## ディレクトリ構造

'()'内の内容はコメントです。

```txt
project_name/
├── public/
│   ├── pages/
│   │   ├── home/
│   │   │   ├── index.html
│   │   │   ├── main.js
│   │   │   ├── main.php
│   │   │   └── style.css
│   │   └── auth_area/
│   │       ├── login/ (以下ファイル構造はhome/と同様)
│   │       └── detail/ (以下ファイル構造はhome/と同様)
│   │
│   └── components/ (<=> ブロック)
│       ├── common/ (<=> フリーコンテンツ)
│       │   ├── header/
│       │   │   ├── index.html
│       │   │   ├── main.js
│       │   │   └── style.css
│       │   └── footer/ (以下ファイル構造はheader/と同様)
│       ├── register/
│       ├── update/
│       ├── delete/
│       ├── login/
│       ├── list/
│       ├── detail/
│       ...
│
├── src/
│   ├── controllers/
│   │   └── HomeController.php
│   ├── models/
│   │   └── User.php
│   ├── views/
│   │   ├── header.php
│   │   ├── footer.php
│   │   └── home.php
├── config/
│   └── config.php
├── .gitignore
├── .prettierrc
├── .prettierignore
└── README.md

```
