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
            $question_list = json_encode($rec);
        }
    } catch (Exception $e) {
        echo "ただいま障害によりデータベースへの登録ができません";
        exit();
    }
    
    $sample = "testfromphp";
    ?>
    
    <script type="text/javascript">
        let sample = "<?php echo $sample; ?>";
        let question_list = JSON.parse("<?php echo $question_list;?>");
        console.log(question_list);
    </script>

    <script type="text/javascript" src="js/question_taker.js"></script>
</body>

</html>