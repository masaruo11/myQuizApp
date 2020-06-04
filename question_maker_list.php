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
    // <script src="./js.question_taker.js"></script>
    try {
        // データベースのおまじない
        $dsn = "mysql:dbname=test_maker;host=localhost;charset=utf8";
        $user = "root";
        $password = "";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT question,correct_answer,wrong_answer1,wrong_answer2 FROM test WHERE 1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        echo "list of questions";

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rec == false) {
                break;
            }
            var_dump($rec);
            $test_txt = "test from php";
            $text = array(1,2,3);
            $php_q_list = json_encode($rec);
        }
    } catch (Exception $e) {
        echo "ただいま障害によりデータベースへの登録ができません";
        exit();
    }
    ?>
    <script type="text/javascript">
        let php_q_list = JSON.parse("<?php echo $php_q_list; ?>");
        let test = JSON.parse("<?php echo $text;?>");
        let test_txt = "<?php echo $test_txt?>";
    </script>

    <script type="text/javascript" src=".//MyQuizApp/js/question_taker.js"></script>
</body>

</html>