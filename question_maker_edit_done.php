<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>question maker</title>
</head>

<body>
    <?php

    try {
        // XSS対策が必要
        $id = $_POST["id"];
        $question = $_POST["question"];
        $correct_answer = $_POST["correct_answer"];
        $wrong_answer1 = $_POST["wrong_answer1"];
        $wrong_answer2 = $_POST["wrong_answer2"];

        $dsn = "mysql:dbname=test_maker;host=localhost;charset=utf8";
        $user = "root";
        $password = "";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE test SET question=?,correct_answer=?, wrong_answer1=?, wrong_answer2=? WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $question;
        $data[] = $correct_answer;
        $data[] = $wrong_answer1;
        $data[] = $wrong_answer2;
        $data[] = $id;
        $stmt->execute($data);

        $dbh = null;
    } catch (Exception $e) {
        echo "problem occured";
        exit();
    }
    header("location:./question_maker_list.php")
?>

</body>

</html>