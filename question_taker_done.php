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

    
        try {
            $question = $_GET["question"];
            $correct_answer = $_GET["correct_answer"];
            $selected = $_GET["answer"];
            

            $sql = "INSERT INTO answer(question,correct_answer,selected) VALUES(:q,:ca,:sel)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":q", $question, PDO::PARAM_STR);
            $stmt->bindValue(":ca", $correct_answer, PDO::PARAM_STR);
            $stmt->bindValue(":sel", $selected, PDO::PARAM_STR);
            $stmt->execute();

            // $pdo = null;

            echo "<p>{h($question)},{h($correct_answer)},{h($selected)}を追加しました</p>";
        } catch (Exception $e) {
            echo "ただいま障害によりデータベースへの登録ができません";
            exit();
        }
        // redirect("question_taker.php");//! 次の質問にうまくいくようにする。ローカルストレージに入れて、セッションの最後のDBに組み込む？
    ?>
    <!-- <a href="./question_maker.html">BACK</a> -->
</body>

</html>
</ul>