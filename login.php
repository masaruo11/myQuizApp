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
        <p id="mk_question">Your Question?</p>
        <form method="post" action="./login_act.php">
            <input name="id" type="hidden" value="#">
            <p>Your Email</p>
            <input id="made_question" name="user_email" type="text" class="mk_question" placeholder="user email">
            <p>Your Password</p>
            <input type="password" name="user_password" id="correct_answer" class="mk_question" placeholder="password">
            <input type="submit" value="FINISH" id="mk_btn">
        </form>
    </section>
</body>

</html>