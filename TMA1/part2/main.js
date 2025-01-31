const question = document.getElementById("question");
const choices = Array.from(document.getElementsByClassName("choice-def"));

let currentQ = {};
let ans = true;
let score = 0;
let qCounter = 0;
let qAvailable = [];

let questions = [
    {
        question: "Here q?",
        choice1: "q?",
        choice2: "no q",
        choice3: "q q",
        choice4: "yes q",
        answer: 1
    },

    {
        question: "Here q?",
        choice1: "q?",
        choice2: "no q",
        choice3: "q q q",
        choice4: "yes q",
        answer: 1
    },

    {
        question: "Here q?",
        choice1: "q?",
        choice2: "no q",
        choice3: "qq qq",
        choice4: "yes q",
        answer: 1
    }
];

const maxQ = 3; 

startQuiz = () => {
    qCounter = 0;
    score = 0;
    qAvailable = [...questions];
    console.log(qAvailable);
    getNextq();
};

getNextq = () => {
    qCounter++;
    const qIndex = Math.floor(Math.random()*qAvailable.length);
    currentQ =  qAvailable[qIndex];
    question.innerText =  currentQ.question; 

    choices.forEach(choice => {
        const number = choice.dataset['number'];
        choice.innerText = currentQ['choice' + number];
    });
};

startQuiz();

//Make work