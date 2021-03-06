<?php

//! 実行PHPファイル
require("funcs.php");//! 関数機能の読込
session_start();

$user_name=$_POST["user_name"];
$email=$_POST["user_email"];
$password=$_POST["user_password"];

$pdo = db_connect();//funcs.php

// $sql="SELECT * FROM user WHERE user_email =:email AND user_password=:password";
$sql="INSERT INTO user (user_name, user_email,user_password) VALUES(:user_name, :email,:password)";
$stmt=$pdo->prepare($sql);
bindStr($stmt, "user_name", $user_name);//funcs.php
bindStr($stmt, "email", $email);//funcs.php
bindStr($stmt,"password",$password);
$res = $stmt->execute(); //間違った時にはエラーが変数格納

if ($res==false){
    sql_error($stmt);//funcs.php
    // $error = $stmt->errorInfo();
    // exit("QUeryError:".$error[2]);
}

//1レコードをとってくる：配列で入ってくる
$val = $stmt->fetch();

if($val["id"]!=""){
    $_SESSION["chk_ssid"]=session_id();
    $_SESSION["user_name"]=$val["user_name"];
    // var_dump($_SESSION);
    redirect("select.php");
}else{
    redirect("login.php");
}
