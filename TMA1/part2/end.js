const lastScore = localStorage.getItem('lastScore');
const lastFile = localStorage.getItem('lastFile');
const endScore = document.getElementById('endScr-txt');
const backbtn = document.getElementById("goback");
backbtn.setAttribute('href',`/part2/quiz.html?quiz=${lastFile}`)
endScore.innerText = ((lastScore/200)*100).toFixed(2) + "%"

/*up to 20q*/