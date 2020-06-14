<?php

session_start();
require("funcs.php");
loginCheck();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Questions</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <section class="container">
        <p id="question">Question maker / Question taker</p>
            <div id="btn" class="index_btn">
                <a href="./logout.php">ログアウト</a>
            </div>
        <div id="btn" class="index_btn"><a href="question_maker.php">Teacher - click here</a></div>
        <div id="btn" class="index_btn"><a href="question_taker.php">Student - click here</a></div>      
    </section>
</body>

</html>