<?php
// 関数の倉庫

//!XSS対策（エコーする場所で使用！）
function h($value)
{
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

//!DB接続(XAMPP)
function db_connect()
{
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=test_maker;charset=utf8;host=localhost', 'root', '');
    } catch (PDOException $e) {
        exit('DBConnectError:' . $e->getMessage());
    }
    return $pdo;
}

//!SQLエラー関数
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
}

//!リダイレクト関数
function redirect($file_name)
{
    header("Location: " . $file_name);
    exit();
}

//!文字のバインド関数
function bindStr($stmt, $bind_variable, $bind_item)
{
    $stmt->bindValue(":$bind_variable", $bind_item, PDO::PARAM_STR);
}

//!数値のバインド関数
function bindInt($stmt, $bind_variable, $bind_item)
{
    $stmt->bindValue(":$bind_variable", $bind_item, PDO::PARAM_INT);
}

//!認証チェック関数
function loginCheck()
{
    if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()) {
        echo "LOGIN ERROR";
        exit();
    } else {
        //!セッションのリジェネレート
        session_regenerate_id();
        $_SESSION["chk_ssid"] = session_id();
    }
}

//!どこでエラーになったかわかるおまじない：実装前です
// <?php ini_set( 'display_errors', 1 ); ?>