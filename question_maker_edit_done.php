<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>question maker</title>
</head>

<body>
    <?php
    require("funcs.php");
    session_start();
    loginCheck();
    $pdo = db_connect();
    try {
        // XSS対策が必要
        $q_id = $_GET["q_id"];
        $question = $_GET["question"];
        $correct_answer = $_GET["correct_answer"];
        $wrong_answer1 = $_GET["wrong_answer1"];
        $wrong_answer2 = $_GET["wrong_answer2"];

        // $dsn = "mysql:dbname=test_maker;host=localhost;charset=utf8";
        // $user = "root";
        // $password = "";
        // $dbh = new PDO($dsn, $user, $password);
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
        $sql = "UPDATE test SET question=:q,correct_answer=:ca, wrong_answer1=:wa1, wrong_answer2=:wa2 WHERE q_id=:q_id";
        $stmt = $pdo->prepare($sql);
        bindStr($stmt,"q",h($question));
        bindStr($stmt,"ca",h($correct_answer));
        bindStr($stmt,"wa1",h($wrong_answer1));
        bindStr($stmt,"wa2",h($wrong_answer2));
        bindInt($stmt,"q_id",h($q_id));
        // $data[] = $question;
        // $data[] = $correct_answer;
        // $data[] = $wrong_answer1;
        // $data[] = $wrong_answer2;
        // $data[] = $q_id;
        $stmt->execute();

        $dbh = null;
    } catch (Exception $e) {
        echo "problem occured";
        exit();
    }
    header("location:./question_maker_list.php")
?>

</body>

</html>