# gespenst

```text
南台科技大學資管系智慧型程式學習系統
由教育部111大專校院教師教學實踐研究計畫贊助
計畫主持人：張儀興教授

由計畫主持人張儀興教授委託開發
```

## Deploy Guide

### 建立DB

1. 建立`lse`資料庫
2. 透過下面指令執行migration與seeder

```shell
# 安裝相關套件
composer install

# 執行migration
php artisan migrate 

# 執行seeder
php artisan db:seed 
```

> 執行上述指令是請先確認`composer`已經安裝

### 設置環境變數

#### 透過.env

1. 執行以下面命令，已建立.env檔案

```shell
cp .env.example .env
```

2. 根據環境修改`.env`檔案中的以下參數值`DB_HOST`、`DB_PORT`、`DB_DATABASE`、`DB_USERNAME`、`DB_PASSWORD`

> 詳細環境變數值說明如下

| 參數 | 說明 |
| --- | ---- |
| DB_HOST | 資料庫位址 |
| DB_PORT | 連結資料庫用port號 |
| DB_DATABASE | 連結資料庫名稱 |
| DB_USERNAME | 登入資料庫用帳號 |
| DB_PASSWORD | 登入資料庫用密碼 |
