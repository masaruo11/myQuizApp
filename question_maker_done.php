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
    function h($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
    }

    try {
        $question = $_POST["question"];
        $correct_answer = $_POST["correct_answer"];
        $wrong_answer1 = $_POST["wrong_answer1"];
        $wrong_answer2 = $_POST["wrong_answer2"];

        $question = h($question);
        $correct_answer = h($correct_answer);
        $wrong_answer1 = h($wrong_answer1);
        $wrong_answer2 = h($wrong_answer2);

        // データベースのおまじない
        $dsn = "mysql:dbname=test_maker;host=localhost;charset=utf8";
        $user = "root";
        $password = "";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO test(question,correct_answer,wrong_answer1,wrong_answer2)VALUES(?,?,?,?)";
        $stmt = $dbh->prepare($sql);
        $data[] = $question;
        $data[] = $correct_answer;
        $data[] = $wrong_answer1;
        $data[] = $wrong_answer2;
        $stmt->execute($data);

        $dbh = null;

        echo "<p>{$question},{$correct_answer},{$wrong_answer2},{$wrong_answer2}を追加しました</p>";
    } catch (Exception $e) {
        echo "ただいま障害によりデータベースへの登録ができません";
        exit();
    }
    header('location: question_maker.html');

    ?>
    <!-- <a href="./question_maker.html">BACK</a> -->
</body>

</html>
</ul>