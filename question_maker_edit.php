<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question-Maker</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php

    try {
        //amend the question ordered by question maker list.php
        $q_amend = $_POST["q_amend"];
        // var_dump($q_amend);
        // $q_amend = "where is the capital of China?";
        $dsn = "mysql:dbname=test_maker;host=localhost;charset=utf8";
        $user = "root";
        $password = "";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT id,question,correct_answer,wrong_answer1,wrong_answer2 FROM test WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $q_amend;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $rec["id"];
        $question = $rec["question"];
        $correct_answer = $rec["correct_answer"];
        $wrong_answer1 = $rec["wrong_answer1"];
        $wrong_answer2 = $rec["wrong_answer2"];

        $dbh = null;
    } catch (Exception $e) {
        print "ただいま障害により大変ご迷惑をおかけしております";
        exit();
    }
    ?>
    <section class="container">
        <p id="mk_question">Your Question?</p>
        <form method="post" action="./question_maker_edit_done.php">
            <input name="id" type="hidden" value="<?php echo $id ?>">
            <input id="made_question" name="question" type="text" class="mk_question" value="<?php echo $question ?>">
            <p>Your Answers (please type correct answer in the first box.)</p>
            <input type="text" name="correct_answer" id="correct_answer" class="mk_question" value="<?php echo $correct_answer ?>">
            <input type="text" name="wrong_answer1" id="wrong_answer1" class="mk_question" value="<?php echo $wrong_answer1 ?>">
            <input type="text" name="wrong_answer2" id="wrong_answer2" class="mk_question" value="<?php echo $wrong_answer2 ?>">
            <input type="submit" value="FINISH" id="mk_btn">
        </form>
    </section>



</body>

</html>