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
    // 質問と答えの一覧を表示
    try {
        // データベースのおまじない
        $dsn = "mysql:dbname=test_maker;host=localhost;charset=utf8";
        $user = "root";
        $password = "";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT question,correct_answer,wrong_answer1,wrong_answer2 FROM test WHERE 1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rec == false) {
                break;
            }
            //質問回答をリストとして出力
            foreach ($rec as $key => $value) {
                if ($key == "question") {
                    echo '<section class="container">';
                    echo '<form method ="get" action="./question_maker_edit.php">';
                    // echo '<input type="radio" name="q_amend" value="'.$value.'">';
                    // var_dump($value);
                    echo $key . "=>" . $value;
                    echo "</form>";
                } else if ($key == "wrong_answer2") {
                    echo $key . "=>" . $value;
                    echo '<p>';
                    echo '<input type="input" name="q_amend" value="' . $value . '">';
                    echo '</p>';
                    echo '<p>';
                    echo '<input type="submit" value="Amend" id="mk_btn">';
                    echo '</p>';
                    echo '</section>';
                } else {
                    echo "<p>$key => $value</p>";
                }
            }
        }
    } catch (Exception $e) {
        echo "ただいま障害によりデータベースへの登録ができません";
        exit();
    }
    ?>
</body>

</html>