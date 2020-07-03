<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question-Maker</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
    require("funcs.php"); //! 関数機能の読込
    session_start();
    loginCheck();
    echo '<div id="logout"><a href="./logout.php">ログアウト</a></div>';
    $pdo = db_connect();

    // 質問と答えの一覧を表示
    try {
        // データベースのおまじない
        // $dsn = "mysql:dbname=test_maker;host=localhost;charset=utf8";
        // $user = "root";
        // $password = "";
        // $dbh = new PDO($dsn, $user, $password);
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



        $sql = "SELECT answer_id,question,correct_answer,selected FROM answer WHERE 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        // var_dump($stmt);
        // $dbh = null;

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rec == false) {
                break;
            }
            // echo '<div id="logout"><a href="./logout.php">ログアウト</a></div>';
            //質問回答をリストとして出力
            foreach ($rec as $key => $value) {
                echo '<section class="container">';
                echo "<p>$key => $value</p>";
                echo '</section>';
            }
        }
    } catch (Exception $e) {
        echo "ただいま障害によりデータベースへの登録ができません";
        exit();
    }
    ?>
</body>

</html>