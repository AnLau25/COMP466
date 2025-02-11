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
    let effect = selectE.value;
    let oldPic = context.getImageData(0, 0, slider.width, slider.height);

    pic.onload = function () {
        applyTransitionEffect(pic, effect, oldPic);
    };

    pic.src = images[index].img;
    txt.textContent = images[index].caption;
}

function applyTransitionEffect(pic, effect, oldPic) {
    context.clearRect(0, 0, slider.width, slider.height);

    switch (effect) {
        case "1":
            let alpha = 0;
            let fadeIn = setInterval(() => {
                context.clearRect(0, 0, slider.width, slider.height);
                context.globalAlpha = alpha;
                context.drawImage(pic, 0, 0, slider.width, slider.height);
                alpha += 0.1;
                if (alpha >= 1) {
                    context.globalAlpha = 1;
                    clearInterval(fadeIn);
                }
            }, 50);
            break;

        case "2": 
            context.putImageData(oldPic, 0, 0);
            let pixels = oldPic.data;
            let totalPixels = pixels.length / 4;
            let pixelIndexes = Array.from({ length: totalPixels }, (_, i) => i);

            let pixelOutInterval = setInterval(() => {
                if (pixelIndexes.length === 0) {
                    clearInterval(pixelOutInterval);
                    context.drawImage(pic, 0, 0, slider.width, slider.height); // Draw new image after effect completes
                    return;
                }
                for (let i = 0; i < 500; i++) {
                    if (pixelIndexes.length === 0) break;
                    let randomIndex = Math.floor(Math.random() * pixelIndexes.length);
                    let pixelPos = pixelIndexes.splice(randomIndex, 1)[0] * 4;
                    pixels[pixelPos + 3] = 0;
                }
                context.putImageData(oldPic, 0, 0);
            }, 10);
            break;

        case "3":
            let scale = 1.5;
            let shrinkInterval = setInterval(() => {
                context.clearRect(0, 0, slider.width, slider.height);
                context.save();
                context.translate(slider.width / 2, slider.height / 2);
                context.scale(scale, scale);
                context.drawImage(pic, -slider.width / 2, -slider.height / 2, slider.width, slider.height);
                context.restore();

                scale -= 0.05;
                if (scale <= 1) {
                    clearInterval(shrinkInterval);
                }
            }, 50);
            break;

        default: // Default No Effect
            context.drawImage(pic, 0, 0, slider.width, slider.height);
            break;
    }
}






