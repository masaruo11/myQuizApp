<?php
// これはお呪いとして使いまわし
require("funcs.php");
session_start();

//sessionを初期化（空）
$_SESSION=array();

//ユーザー側のクッキーのセッションIDを過去にして破棄
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-42000,'/');
}

// サーバー側のセッションIDを破棄
session_destroy();

// 処理後、index.phpへリダイレクト
redirect("login.php");//todo update to new index.html