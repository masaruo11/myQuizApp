"use strict";

//********************<test making>****************/

const mkbtn = document.getElementById("mk_btn");
const made_questions = document.getElementById("made_question");
const correct_answers = document.getElementById("correct_answer");
const wrong_answers1 = document.getElementById("wrong_answer1");
const wrong_answers2 = document.getElementById("wrong_answer2");
const test_hidden = document.getElementById("test_completed");

let i = 1;
let max_num = 3;


function mk_event() {
    mkbtn.addEventListener("click", () => {
        clickEnter();

    })
    mkbtn.addEventListener("keydown", (e)=>{
        if (e.keyCode === 13) {
            clickEnter();
        }
    })
        
    
}
console.log(max_num, i);

if (i >= max_num) {
    test_hidden.classList.remove("hidden");
} else {
    mk_event();
}

function clickEnter() {
     let answers = [];
     const made_question = made_questions.value;
     const correct_answer = correct_answers.value;
     const wrong_answer1 = wrong_answers1.value;
     const wrong_answer2 = wrong_answers2.value;

     answers.push(correct_answer, wrong_answer1, wrong_answer2)

     mk_question(made_question, answers, i);
     console.log(made_question, answers, "test");

     made_questions.value = "";
     made_questions.focus();
     correct_answers.value = "";
     wrong_answers1.value = "";
     wrong_answers2.value = "";
     i++;
}

function mk_question(qu, ans, ids) {
    newQuestion.push({
        q: qu,
        c: ans,
        id: ids,
    }, )
}
