const question = document.getElementById("question");
const qNum = document.getElementById('qNum-txt');
const qScr = document.getElementById('qScr-txt');
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

const qMax = 3;

startQuiz = () => {
    qCounter = 0;
    score = 0;
    qAvailable = [...questions];
    console.log(qAvailable);
    getNextq();
};

getNextq = () => {
    if (qAvailable.length == 0 || qCounter >= qMax) {
        return window.location.assign('/part2/end.html');
    }
    qCounter++;
    qNum.innerText = `${qCounter}/${qMax}`;
    const qIndex = Math.floor(Math.random() * qAvailable.length);
    currentQ = qAvailable[qIndex];
    question.innerText = currentQ.question;

    choices.forEach(choice => {
        const number = choice.dataset['number'];
        choice.innerText = currentQ['choice' + number];
    });

    qAvailable.splice(qIndex, 1);
    ans = true;
};


scorePlus = () =>{
    score += 10;
    qScr.innerText = score;
    localStorage.setItem('lastScore', score);
}

choices.forEach(choice => {
    choice.addEventListener("click", e => {
        if (!ans) return;

        ans = false;
        const selChoice = e.target;
        const selAns = selChoice.dataset['number'];

        const correction =
            selAns == currentQ.answer ? 'correct' : 'incorrect';

        if (correction == 'incorrect') {
            choices.forEach(choice => {
                if (choice.dataset['number'] == currentQ.answer) {
                    choice.parentElement.classList.add('correct');
                    setTimeout(() => {
                        choice.parentElement.classList.remove('correct');
                    },1000);
                }
            });
        }else{
            scorePlus();
        };

        selChoice.parentElement.classList.add(correction);

        setTimeout(() => {
            selChoice.parentElement.classList.remove(correction);
            choice.parentElement.classList.remove('correct');
            getNextq();
        },1000);

    });

});

startQuiz();
/*

        if(!ans) return;

        ans = false;
        const selChoice = e.target;
        const selAns =  selChoice.dataset['number'];

        console.log(selAns == currentQ.answer);

        const correction = 
            selAns == currentQ.answer ? 'correct' : 'incorrect';

        console.log(selAns == currentQ.answer);

        selChoice.parentElement.classList.add(correction);

        //selChoice.parentElement.classList.remove(correction);



        make 3 text file
*/