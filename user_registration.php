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
        <p id="mk_question">Your details to register</p>
        <form method="post" action="./user_registration_act.php">
            <!-- <input name="id" type="hidden" value="#"> -->
            <p>Your Name</p>
            <input id="made_question" name="user_name" type="text" class="mk_question" placeholder="user name">
            <p>Your Email</p>
            <input id="made_question" name="user_email" type="text" class="mk_question" placeholder="user email">
            <p>Your Password</p>
            <input type="password" name="user_password" id="correct_answer" class="mk_question" placeholder="password">
            <input type="submit" value="FINISH" id="mk_btn">
        </form>
    </section>
</body>

</html>