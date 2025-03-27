let imgData = {};
let index = 0;
let isPlaying = false;
let isSequential = false;
let slider,
    context,
    slideInterval,
    txt,
    playBtn,
    modeBtn,
    prevBtn,
    nextBtn;

window.onload = function () {
    loadImages();
    slider = document.getElementById('slider');
    context = slider.getContext("2d");
    txt = document.getElementById('caption');
    playBtn = document.getElementById('play');
    modeBtn = document.getElementById('mode');
    prevBtn = document.getElementById('prev');
    nextBtn = document.getElementById('next');

    playBtn.addEventListener("click", togglePlay);
    modeBtn.addEventListener("click", toggleMode);
    prevBtn.addEventListener("click", showPrev);
    nextBtn.addEventListener("click", showNext);
};


function loadImages() {
    fetch('part2.aspx?getImages=true')
        .then(response => response.json())
        .then(data => {
            imgData = data;
            updateCanvas();
        })
        .catch(error => console.error('Error loading JSON:', error));
}

function togglePlay() {
    if (isPlaying) {
        clearInterval(slideInterval);
        playBtn.textContent = "Play";
    } else {
        runSlides();
        playBtn.textContent = "Pause";
    }
    isPlaying = !isPlaying;
}

function toggleMode() {
    if (isSequential) {
        modeBtn.textContent = "RANDOM";
        prevBtn.className = 'cta';
        prevBtn.disabled = false;
        nextBtn.className = 'cta';
        nextBtn.disabled = false;
    } else {
        modeBtn.textContent = "SEQUENTIAL";
        prevBtn.className = 'cta-disabled';
        prevBtn.disabled = true;
        nextBtn.className = 'cta-disabled';
        nextBtn.disabled = true;
    }
    isSequential = !isSequential;
    if (isPlaying) runSlides();
}

function runSlides() {
    clearInterval(slideInterval);
    slideInterval = setInterval(() => {
        if (isSequential) {
            index = Math.floor(Math.random() * Object.values(imgData).length);
        } else {
            index++;
            if (index >= Object.values(imgData).length) index = 0;
        }
        updateCanvas();
    }, 4000);
}

function showPrev() {
    index--;
    if (index < 0) index = Object.values(imgData).length - 1;
    updateCanvas();
    setTimeout(() => {
    }, 2000);
}

function showNext() {
    index++;
    if (index >= Object.values(imgData).length) index = 0;
    updateCanvas();
    setTimeout(() => {
    }, 2000);
}

function updateCanvas() {
    if (!slider || !slider.getContext) return;
    let images = Object.values(imgData);
    let pic = new Image();

    let prevWidth = slider.width;
    let prevHeight = slider.height;

    let oldPic = context.getImageData(0, 0, slider.width, slider.height);

    pic.onload = function () {
        slider.width = pic.width;
        slider.height = pic.height;
        context.drawImage(pic, 0, 0, slider.width, slider.height);
    };

    pic.src = images[index].ImgURL;
    txt.textContent = images[index].ImgCaption;
}









