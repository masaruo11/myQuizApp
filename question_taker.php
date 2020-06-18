<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question-Taker</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
    require("funcs.php"); //! 関数機能の読込
    session_start();
    loginCheck();
    $pdo = db_connect();
    // var_dump($_SESSION);
    try {
        //データベースのおまじない
        // $dsn = "mysql:dbname=test_maker;host=localhost;charset=utf8";
        // $user = "root";
        // $password = "";
        // $dbh = new PDO($dsn, $user, $password);
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT question,correct_answer,wrong_answer1,wrong_answer2 FROM test WHERE 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // $dbh = null;
        //DBからデータを取り出し、JSに渡すための変数に格納
        // echo "list of questions";
        $question_list = [];
        $question_list_js = [];
        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rec == false) {
                break;
            }
            // var_dump($rec);
            array_push($question_list, $rec);
            // var_dump($question_list);
            $question_list_js = json_encode($question_list);
            // var_dump($question_list_js);
        }
    } catch (Exception $e) {
        echo "ただいま障害によりデータベースへの登録ができません";
        exit();
    }

    ?>

    <section class="container">
        
             
            <p id="question"></p>
            <ul id="choices"></ul>
            <div id="btn" class="disabled">Next</div>
            <section id="result" class="hidden">
                <p></p>
                <a href="">Replay?</a>
                <canvas width="300" height="50">
                    Canvas not supported.
                </canvas>
        </section>
    </section>
    <!-- //*********************<Test Taking>******************/ -->
    <script>
        "use strict ";
        let quizSet_php = JSON.parse('<?php echo $question_list_js; ?>')
        console.log(quizSet_php, "PHP");
        quizSet = [];
        quizSet_php.forEach(obj => {
            let q1 = obj.question;
            let a1 = obj.correct_answer;
            let a2 = obj.wrong_answer1;
            let a3 = obj.wrong_answer2;
            quizSet.push({
                q: q1,
                c: [a1, a2, a3],
            });
        });


        console.log(quizSet, "quizSET");

        {
            const question = document.getElementById("question");
            const choices = document.getElementById("choices");
            const btn = document.getElementById("btn");
            const result = document.getElementById("result");
            const scoreLabel = document.querySelector("#result > p")

            // Question take
            let currentNum = 0;
            let isAnswered;
            let score = 0;

            //クイズをランダム化。最後のファイルと任意のファイルを入れ替えシャッフル化
            //フィッシャー–イェーツのシャッフル
            function shuffle(arr) {
                for (let i = arr.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [arr[j], arr[i]] = [arr[i], arr[j]];
                }


                return arr;
            }

            //正誤判定
            function checkAnswer(li) {
                sessionStorage.setItem("question", quizSet[currentNum].q);
                sessionStorage.setItem("correct_answer", quizSet[currentNum].c[0]);

                if (isAnswered) {
                    return;
                }

                isAnswered = true;
                if (li.textContent === quizSet[currentNum].c[0]) {
                    li.classList.add("correct");
                    score++;
                    sessionStorage.setItem("answer", li.textContent);
                    sessionStorage.setItem("flag", 1);


                } else {
                    // console.log("wrong");
                    li.classList.add("wrong");
                    sessionStorage.setItem("answer", li.textContent);
                    sessionStorage.setItem("flag", 0);
                }

                btn.classList.remove("disabled");
            }

            // クイズを表示
            function setQuiz() {
                isAnswered = false;
                console.log(quizSet, "quizset");
                console.log(currentNum, "currentNUm");
                console.log(quizSet[currentNum].q, "q");
                question.textContent = quizSet[currentNum].q;

                while (choices.firstChild) {
                    choices.removeChild(choices.firstChild);
                }

                const shuffledChoices = shuffle([...quizSet[currentNum].c]);
                // console.log(quizSet[currentNum].c);
                shuffledChoices.forEach(choice => {
                    const li = document.createElement("li");
                    li.textContent = choice;
                    li.addEventListener("click", () => {
                        checkAnswer(li);
                    })
                    choices.appendChild(li);

                });

                if (currentNum === quizSet.length - 1) {
                    btn.textContent = "Next";
                }
            }
            console.log(quizSet.length, "length");
            setQuiz();

            //NEXTボタンを押したときの挙動
            btn.addEventListener("click", () => {
                if (btn.classList.contains("disabled")) {
                    return;
                }
                btn.classList.add("disabled");

                if (currentNum === quizSet.length - 1) {
                    // console.log(`Score:${score}/${quizSet.length}`);
                    scoreLabel.textContent = `Score:${score - 1}/${quizSet.length}`
                    result.classList.remove("hidden");
                } else {
                    currentNum++;
                    setQuiz();
                }
            })
        }
        // XMLHttpRequestでPHPに変数を渡そうとしたが・・・
        // if (window.XMLHttpRequest) {
        //     xmlhttp = new XMLHttpRequest();
        // } else {
        //     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        // }

        // var PageToSendTo = "question_taker_done.php";
        // var MyVariable = "variableData";
        // var VariablePlaceholder = "variableName=";
        // var UrlToSend = PageToSendTo + VariablePlaceholder + MyVariable;

        // xmlhttp.open("GET", UrlToSend, false);
        // xmlhttp.send();
    </script>



    <script src="js/canvas.js"></script>

</body>

</html>
</ul>