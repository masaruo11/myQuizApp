<?php

session_start();
require("funcs.php");
loginCheck();
?>
<!DOCTYPE html>
<html lang="ja">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Questions</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div id="logout"><a href="./logout.php">ログアウト</a></div>
    <section class="container">
        <p id="question">Question maker / Question taker</p>
        <p id="question">Welecome <?= $_SESSION["user_name"] ?></p>
        <div id="btn" class="index_btn"><label for="teacher-click"><a href="question_maker.php" id="teacher-click">Teacher - click here</a></label></div>
        <div id="btn" class="index_btn"><a href="question_taker.php" id="student-click">Student - click here</a></div>
    </section>

</body>

</html>