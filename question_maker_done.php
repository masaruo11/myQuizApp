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

    $pdo = db_connect();

    if (isset($_GET["FINISH"])) {
        try {
            $question = $_GET["question"];
            $correct_answer = $_GET["correct_answer"];
            $wrong_answer1 = $_GET["wrong_answer1"];
            $wrong_answer2 = $_GET["wrong_answer2"];

            $sql = "INSERT INTO test(question,correct_answer,wrong_answer1,wrong_answer2) VALUES(:q,:ca,:wa1,:wa2)";
            $stmt = $pdo->prepare($sql);

            // $stmt=$pdo->prepare("INSERT INTO test(question,correct_answer,wrong_answer1,wrong_answer2) VALUES(
            //     :q,:ca,:wa1,wa2)");
            $stmt->bindValue(":q", $question, PDO::PARAM_STR);
            $stmt->bindValue(":ca", $correct_answer, PDO::PARAM_STR);
            $stmt->bindValue(":wa1", $wrong_answer1, PDO::PARAM_STR);
            $stmt->bindValue(":wa2", $wrong_answer2, PDO::PARAM_STR);
            // bindStr($stmt,"q",$question);
            // bindStr($stmt,"ca",$correct_answer);
            // bindStr($stmt,"wa1",$wrong_answer1);
            // bindStr($stmt,"wa2",$wrong_answer2);
            // $data[] = $question;
            // $data[] = $correct_answer;
            // $data[] = $wrong_answer1;
            // $data[] = $wrong_answer2;
            $stmt->execute();

            // $pdo = null;

            echo "<p>{h($question)},{h($correct_answer)},{h($wrong_answer2)},{h($wrong_answer2)}を追加しました</p>";
        } catch (Exception $e) {
            echo "ただいま障害によりデータベースへの登録ができません";
            exit();
        }
        redirect("question_maker.php");
        // header('location: question_maker.php');
    } else {
        redirect("question_maker_list.php");
        // header("location: question_maker_list.php");
    }


    ?>
    <!-- <a href="./question_maker.html">BACK</a> -->
</body>

</html>
</ul>