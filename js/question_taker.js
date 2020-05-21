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
            btn.textContent = "Next";
        }
    }
    console.log(quizSet.length,"length");
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



/* -------------------------------------- */
/* ------------  Settings  -------------- */
/* -------------------------------------- */

// text = 'REPLAY'; // The message displayed
// chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ?'; // All possible Charactrers
// scale = 50; // Font size and overall scale
// breaks = 0.003; // Speed loss per frame
// endSpeed = 0.05; // Speed at which the letter stops
// firstLetter = 220; // Number of frames untill the first letter stopps (60 frames per second)
// delay = 40; // Number of frames between letters stopping



// canvas = document.querySelector('canvas');
// ctx = canvas.getContext('2d');

// text = text.split('');
// chars = chars.split('');
// charMap = [];
// offset = [];
// offsetV = [];

// for (var i = 0; i < chars.length; i++) {
//     charMap[chars[i]] = i;
// }

// for (var i = 0; i < text.length; i++) {
//     var f = firstLetter + delay * i;
//     offsetV[i] = endSpeed + breaks * f;
//     offset[i] = -(1 + f) * (breaks * f + 2 * endSpeed) / 2;
// }

// (onresize = function () {
//     canvas.width = canvas.clientWidth;
//     canvas.height = canvas.clientHeight;
// })();

// requestAnimationFrame(loop = function () {
//     ctx.setTransform(1, 0, 0, 1, 0, 0);
//     ctx.clearRect(0, 0, canvas.width, canvas.height);
//     ctx.globalAlpha = 1;
//     ctx.fillStyle = '#622';
//     ctx.fillRect(0, (canvas.height - scale) / 2, canvas.width, scale);
//     for (var i = 0; i < text.length; i++) {
//         ctx.fillStyle = '#ccc';
//         ctx.textBaseline = 'middle';
//         ctx.textAlign = 'center';
//         ctx.setTransform(1, 0, 0, 1, Math.floor((canvas.width - scale * (text.length - 1)) / 2), Math.floor(canvas.height / 2));
//         var o = offset[i];
//         while (o < 0) o++;
//         o %= 1;
//         var h = Math.ceil(canvas.height / 2 / scale)
//         for (var j = -h; j < h; j++) {
//             var c = charMap[text[i]] + j - Math.floor(offset[i]);
//             while (c < 0) c += chars.length;
//             c %= chars.length;
//             var s = 1 - Math.abs(j + o) / (canvas.height / 2 / scale + 1)
//             ctx.globalAlpha = s
//             ctx.font = scale * s + 'Verdana'
//             ctx.fillText(chars[c], scale * i, (j + o) * scale);
//         }
//         offset[i] += offsetV[i];
//         offsetV[i] -= breaks;
//         if (offsetV[i] < endSpeed) {
//             offset[i] = 0;
//             offsetV[i] = 0;
//         }
//     }

//     requestAnimationFrame(loop);
// });