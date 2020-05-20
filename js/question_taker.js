"use strict ";
//*********************<Test Taking>******************/

let quizSet = [];//クイズ格納配列

//FirebaseからデータをPULL
newQuestion.on("child_added", function (data) {
    let v = data.val();
    let k = data.key;
    console.log(v, "v", k, "k");
    // console.log("Previous Post ID: " + prevChildKey);
    // console.log(newPost.c, "Data Pull Time - C array")
    // console.log(snapshot, "snapshot");
    // console.log(newPost, "newPost");
    let qs = String(v.q);

    let as = [];
    quizSet.push({
        q: v.q,
        c: v.c,
        // id:v.id,
    });

})

//FirebaseのChild_addedのイベントをトリガーするのに必要か？
console.log(quizSet, "contain check");

quizSet.push({
    q: "Press Correct below to initiate",
    c:["Correct - Press ME!", "Wrong","Wrong"],
});



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

    function shuffle(arr) {
        for (let i = arr.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [arr[j], arr[i]] = [arr[i], arr[j]];
        }


        return arr;
    }

    //正誤判定
    function checkAnswer(li) {
        if (isAnswered) {
            return;
        }

        isAnswered = true;
        if (li.textContent === quizSet[currentNum].c[0]) {
            li.classList.add("correct");
            score++;
        } else {
            // console.log("wrong");
            li.classList.add("wrong");
        }

        btn.classList.remove("disabled");
    }

    // クイズをランダムに表示
    function setQuiz() {
        isAnswered = false;
        console.log(quizSet, "quizset");
        console.log(currentNum, "currentNUm");
        console.log(quizSet[currentNum].q,"q");
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
            btn.textContent = "Show Score";
        }
    }

    setQuiz();

    btn.addEventListener("click", () => {
        if (btn.classList.contains("disabled")) {
            return;
        }
        btn.classList.add("disabled");

        if (currentNum === quizSet.length - 1) {
            // console.log(`Score:${score}/${quizSet.length}`);
            scoreLabel.textContent = `Score:${score-1}/${quizSet.length-1}`//0スコアの時にマイナスかするのが問題
            result.classList.remove("hidden");
        } else {
            currentNum++;
            setQuiz();
        }
    })
}