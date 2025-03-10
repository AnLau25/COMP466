document.addEventListener("DOMContentLoaded", function () {
    console.log("Script loaded and running...");

    const form = document.getElementById("quiz-form");
    if (!form) {
        console.error("Form not found");
        return;
    }

    const submitButton = form.querySelector("input[type='submit']");
    const scoreDisplay = document.getElementById("qScr-txt");
    const questionCountDisplay = document.getElementById("qNum-txt");

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        console.log("Form submitted");

        let correctCount = 0;
        let totalQuestions = 0;

        document.querySelectorAll("fieldset").forEach((fieldset) => {
            totalQuestions++;
            let selected = fieldset.querySelector("input[type='radio']:checked");

            if (selected) {
                if (selected.classList.contains("correct")) {
                    fieldset.classList.add("green");
                    correctCount++;
                } else {
                    fieldset.classList.add("red");
                }
            } else {
                fieldset.classList.add("red");
            }
        });

        console.log(`Correct answers: ${correctCount} out of ${totalQuestions}`);
        scoreDisplay.textContent = `${(correctCount / 40) * 100}%`;
        questionCountDisplay.textContent = `${correctCount}/40`;

        const urlParams = new URLSearchParams(window.location.search);
        const _id = urlParams.get("id");

        fetch('done.php?id=' + _id,{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('done.php response:', data);
        })
        .catch(error => {
            console.error('Error:', error);
        });        

        const newLink = document.createElement("a");
        newLink.className = "cta"; 
        newLink.textContent = "Go Back to Lesson"; 
        newLink.href = "/part2/unit.php?id="+ _id;

        submitButton.parentNode.replaceChild(newLink, submitButton);
    });
});
