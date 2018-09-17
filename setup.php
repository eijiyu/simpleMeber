<?php
//系統基本資料
define("_WEB_ROOT_URL","http://{$_SERVER['SERVER_NAME']}/user/");
define("_WEB_ROOT_PATH","{$_SERVER['DOCUMENT_ROOT']}/user/");
//系統變數
$title="客戶管理系統";
//資料庫連線
$db_id="aandd";//資料庫使用者//
$db_passwd="123456";//資料庫使用者密碼//
$db_name="user";//資料庫名稱//
//連入資料庫
$link=mysqli_connect('localhost',$db_id,$db_passwd,$db_name) or die_content(mysqli_connect_errno().mysqli_connect_error()."資料庫無法連線");
mysqli_query($link,"SET NAMES 'utf8'");
//自定輸出錯誤訊息
function die_content($content=""){
    $main="
        <!DOCTYPE html>
        <html lang='zh_TW'>
        <head>
        <meta charset='utf-8'>
        <title>輸出錯誤訊息</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='description' content='輸出錯誤訊息'>
        <meta name='author' content='aandd'>
        <link href='css/bootstrap.css' rel='stylesheet'>
        <link href='css/bootstrap-responsive.css' rel='stylesheet'>        
        <link href='css/jquery-ui-1.8.23.custom.css' rel='stylesheet'>
        <!-- 引入js檔案開始 -->
        <script src='js/jquery1.8.js'></script>
        <script src='js/jquery-ui-1.8.23.custom.min.js'></script>
        <script src='js/bootstrap.js'></script>
        <!-- 引入js檔案結束 -->
        </head>
        <body>
        <!--放入網頁主體-->
        <div class='container' id='main_content'>
          <!-- 主要內容欄位開始 -->
            <div class='hero-unit'>
            <div class='alert alert-error'>
            <a class='close' data-dismiss='alert'>×</a>
            <strong>{$content}</strong>
            </div>
            </div>
          <!-- 主要內容欄位結束 -->
          <!-- 頁腳開始 -->
          <footer>
          </footer>
          <!-- 頁腳結束 -->
        </div> 
        <!-- 主要內容欄位結束 -->
        </body>
        </html>
    ";
    die($main);
}
function bootstrap($content=""){
    global $title;
    $main="
        <!DOCTYPE html>
        <html lang='zh_TW'>
        <head>
        <meta charset='utf-8'>
        <title>{$title}</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='description' content='{$title}'>
        <meta name='author' content='aandd'>
        <link href='css/bootstrap.css' rel='stylesheet'>
        <link href='css/bootstrap-responsive.css' rel='stylesheet'>        
        <link href='css/jquery-ui-1.8.23.custom.css' rel='stylesheet'>
        <style type='text/css'>
          body {
            padding-top: 60px;
            padding-bottom: 20px;
          }
        </style>
        <!-- 引入js檔案開始 -->
        <script src='js/jquery1.8.js'></script>
        <script src='js/jquery-ui-1.8.23.custom.min.js'></script>
        <script src='js/bootstrap.js'></script>
        <!-- 引入js檔案結束 -->
        </head>
        <body>
        <!--放入網頁主體-->
        <!--放入選單開始-->
    <div class='navbar navbar-inverse navbar-fixed-top'>
      <div class='navbar-inner'>
        <div class='container'>
          <button type='button' class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='brand' href='{$_SERVER['PHP_SELF']}'> 客戶管理首頁</a>
          <div class='nav-collapse collapse'>
            <ul class='nav'>
              <li class='active'>
                <a href='{$_SERVER['PHP_SELF']}?op=add_user_form'>新增客戶資料</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
        <!--放入選單結束-->
        <div class='container' id='main_content'>
          <!-- 主要內容欄位開始 -->
          {$content}
          <!-- 主要內容欄位結束 -->
          <!-- 頁腳開始 -->
          <footer>
          </footer>
          <!-- 頁腳結束 -->
        </div> 
        <!-- 主要內容欄位結束 -->
        </body>
        </html>
    ";
    return $main;
}
?>