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
        $sql = "SELECT q_id, question,correct_answer,wrong_answer1,wrong_answer2 FROM test WHERE 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
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
        <!-- 回答をDBに格納するためのフォーム（非表示） -->

        <form action="./question_taker_done.php" method="get" id="answer_db_connect">
            <input id="question_r" type="hidden" name="question">
            <input id="correct_answer_r" type="hidden" name="correct_answer">
            <input id="answer_r" type="hidden" name="answer">
        </form>
    </section>
    <!-- //*********************<Test Taking>******************/ -->
    <script>
        "use strict ";
        let quizSet_php = JSON.parse('<?php echo $question_list_js; ?>')
        quizSet = [];
        quizSet_php.forEach(obj => {
            let q1 = obj.question;
            let a1 = obj.correct_answer;
            let a2 = obj.wrong_answer1;
            let a3 = obj.wrong_answer2;
            // let q_id = obj.q_id;
            quizSet.push({
                q: q1,
                c: [a1, a2, a3],
            });
        });

        const question = document.getElementById("question");
        const choices = document.getElementById("choices");
        const btn = document.getElementById("btn");
        const result = document.getElementById("result");
        const scoreLabel = document.querySelector("#result > p")

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
            // console.log(quizSet, "quizset");
            // console.log(currentNum, "currentNUm");
            // console.log(quizSet[currentNum].q, "q");
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

        setQuiz();

        //NEXTボタンを押したときの挙動
        btn.addEventListener("click", () => {
            if (btn.classList.contains("disabled")) {
                return;
            }
            btn.classList.add("disabled");
            //START 回答をDBに格納
            document.getElementById("question_r").value = sessionStorage.getItem("question");
            document.getElementById("correct_answer_r").value = sessionStorage.getItem("correct_answer");
            document.getElementById("answer_r").value = sessionStorage.getItem("answer");
            // document.getElementById("answer_db_connect").submit();
            //!フォームデータをPHPにFETCHでPUSH
            const myForm = document.getElementById("answer_db_connect");
            const url = "./question_taker_done.php";
            
            myForm.addEventListener("submit", function(e) {
                e.preventDefault();
    
                const formData = new FormData(this);
                fetch(url, {
                    method: "GET",
                    body: formData,
                }).then(function(response) {
                    return response.text();
                }).then(function(text) {
                    console.log(text);
                }).catch(function(error) {
                    console.error(error);
                })
            });
            //END 回答をDBに格納
            if (currentNum === quizSet.length - 1) {
                scoreLabel.textContent = `Score:${score}/${quizSet.length}`
                result.classList.remove("hidden");
            } else {
                currentNum++;
                setQuiz();
            }
        })

    </script>


    <script src="js/canvas.js"></script>

</body>

</html>