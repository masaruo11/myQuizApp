<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question-Maker</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <!-- 質問を作成し、question_maker_doneに渡す -->
    <section class="container">
        <p id="mk_question">Your Question?</p>
        <form action="./question_maker_done.php" method="post">
            <input id="made_question" name="question" type="text" class="mk_question" placeholder="input your questions">
            <p>Your Answers (please type correct answer in the first box.)</p>
            <input type="text" name="correct_answer" id="correct_answer" class="mk_question" placeholder="input correct answer">
            <input type="text" name="wrong_answer1" id="wrong_answer1" class="mk_question" placeholder="input wrong answer1">
            <input type="text" name="wrong_answer2" id="wrong_answer2" class="mk_question" placeholder="input wrong answer2">
            <input type="submit" name="next" value="NEXT Question" id="mk_btn">
            <input type="submit" name="finish" value="FINISH" id="mk_btn" onclick="location.href='./question_maker_list.php'">
        </form>
        <section id="complete" class="hidden">
            <p></p>
            <a href="" id="test_completed" class="hidden">Test Made!</a>
        </section>
    </section>

    <script src="js/question_maker.js"></script>

</body>

</html>
</ul>