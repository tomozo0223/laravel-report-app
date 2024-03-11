## 業務日報アプリ

### 概要とURL
* URL(http://xs203973.xsrv.jp/)
1. 日々の業務日報を登録するためのアプリです。
2. 社員の登録、業務内容、業務に対するコメントができます。
3. 複雑な機能はそこまでないですが、アプリケーションで重要なCRUDが入ったアプリです。
![日報登録画面](https://github.com/tomozo0223/laravel-report-app/assets/145981508/da5fe1ad-d82b-4ac4-b4da-53035f25dadf)
![日報一覧画面](https://github.com/tomozo0223/laravel-report-app/assets/145981508/dbc6ba80-caea-4a6c-9aa3-e69e7385ae3c)

### 使用技術
* PHP 8.2.9
* Laravel 10.45.1
* MySQL 8.2.0
* Node 18.16.0
* Laravel-sail

### 機能一蘭
1. ユーザー登録(breeze使用)
2. ログイン、ログアウト
3. 日報登録、更新
   * 現場名、メンバー、業務内容投稿
   * 日時、画像投稿
4. 日報詳細
   * 日報詳細情報、画像表示
   * 日報詳細に対するコメント投稿
   * コメントの削除
5. 日報一覧、社員一覧
   * ページネーション(10件)
