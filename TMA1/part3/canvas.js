let imgData = {};
let index = 0;
let isPlaying = false;
let isSequential = false
let slider,
    context,
    slideInterval,
    txt,
    playBtn,
    modeBtn,
    prevBtn,
    nextBtn,
    selectE;

window.onload = function () {
    loadImages();
    slider = document.getElementById('slider');
    context = slider.getContext("2d");
    txt = document.getElementById('caption');
    playBtn = document.getElementById('play');
    modeBtn = document.getElementById('mode');
    prevBtn = document.getElementById('prev');
    nextBtn = document.getElementById('next');
    selectE = document.getElementById('effect-select');

    playBtn.addEventListener("click", togglePlay);
    modeBtn.addEventListener("click", toggleMode);
    prevBtn.addEventListener("click", showPrev);
    nextBtn.addEventListener("click", showNext);
    selectE.addEventListener("change", updateCanvas);
};


function loadImages() {
    fetch('img.json')
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
    }, 3000);
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

    pic.onload = function () {
        context.clearRect(0, 0, slider.width, slider.height);
        context.drawImage(pic, 0, 0, slider.width, slider.height);
        applyEffect(selectE.value);

    };

    pic.src = images[index].img;
    txt.textContent = images[index].caption;
}

function applyEffect(effect) {
    let img = context.getImageData(0, 0, slider.width, slider.height);
    let data = img.data;

    switch (effect) {
        case "1":
            for (let i = 0; i < data.length; i += 4) {
                let red = data[i];
                let green = data[i + 1];
                let blue = data[i + 2];
                let avg = (red + green + blue) / 3;
                data[i] = data[i + 1] = data[i + 2] = avg;
            }
            break;
        case "2":
            let images = Object.values(imgData);
            if (images.length === 0) return;

            let pic = new Image();
            pic.src = images[index].img;

            pic.onload = function () {
                let cols = 3, rows = 3; // 3x3 grid
                let imgWidth = slider.width / cols;
                let imgHeight = slider.height / rows;

                context.clearRect(0, 0, slider.width, slider.height);

                for (let y = 0; y < rows; y++) {
                    for (let x = 0; x < cols; x++) {
                        context.drawImage(pic, x * imgWidth, y * imgHeight, imgWidth, imgHeight);
                    }
                }
            };
            break;
        case "3":
            let step = 10;
            for (let y = 0; y < slider.height; y += step) {
                for (let x = 0; x < slider.width; x += step) {
                    let idx = (y * slider.width + x) * 4;
                    let r = data[idx], g = data[idx + 1], b = data[idx + 2];
                    for (let dy = 0; dy < step; dy++) {
                        for (let dx = 0; dx < step; dx++) {
                            let id = ((y + dy) * slider.width + (x + dx)) * 4;
                            if (id < data.length) {
                                data[id] = r;
                                data[id + 1] = g;
                                data[id + 2] = b;
                            }
                        }
                    }
                }
            }
            break;
        case "4":
            for (let y = 0; y < slider.height; y++) {
                for (let x = 0; x < slider.width; x++) {
                    let index = (y * slider.width + x) * 4;
                    let redGradient = (x / slider.width) * 255;
                    let greenGradient = (y / slider.height) * 255;

                    data[index] = (data[index] + redGradient) / 2;
                    data[index + 1] = (data[index + 1] + greenGradient) / 2;
                    data[index + 2] = (data[index + 2] + 128) / 2;
                }
            }
            break;
        default:
            return;
    }


    context.putImageData(img, 0, 0);
}




