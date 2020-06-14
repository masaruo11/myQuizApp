<?php

require("funcs.php");
session_start();

$email=$_POST["user_email"];
$password=$_POST["user_password"];

$pdo = db_connect();

$sql="SELECT * FROM user WHERE user_email =:email AND user_password=:password";
$stmt=$pdo->prepare($sql);
$stmt->bindValue(":email",$email, PDO::PARAM_STR);
$stmt->bindValue(":password",$password, PDO::PARAM_STR);
//todo bindStr($stmt,":email",$email);//! - function works?
//todo bindStr($stmt,":password",$password);
$res = $stmt->execute();//間違った時にはエラーが変数格納

if ($res==false){
    $error = $stmt->errorInfo();
    exit("QUeryError:".$error[2]);
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
