document.addEventListener("DOMContentLoaded", function () {
 
    const conversionFactors = {
        lengths: [2.54, 0.0254, 30.48, 0.3048, 1.60934], // inches-cm, inches-m, feet-cm, feet-m, miles-km
        weights: [28.3495, 0.453592], // Oz-gr, lb-kg
        areas: 0.092903, // square feet to square meters
        volumes: 3.78541 // gallons to liters
    };

    function convert(input, factor, target) {
        if (input.value.trim() !== "") {
            target.value = (parseFloat(input.value) * factor).toFixed(4);
        } else {
            target.value = "";
        }
    }


    const lengthSelect = document.getElementById("lengths");
    const lengthImp = document.querySelector("input[name='limp']");
    const lengthMet = document.querySelector("input[name='lmet']");

    function updateLengthConversion() {
        const factor = conversionFactors.lengths[lengthSelect.value];
        lengthImp.addEventListener("input", () => convert(lengthImp, factor, lengthMet));
        lengthMet.addEventListener("input", () => convert(lengthMet, 1 / factor, lengthImp));
    }
    lengthSelect.addEventListener("change", updateLengthConversion);
    updateLengthConversion();


    const weightSelect = document.getElementById("weights");
    const weightImp = document.querySelector("input[name='wimp']");
    const weightMet = document.querySelector("input[name='wnmet']");

    function updateWeightConversion() {
        const factor = conversionFactors.weights[weightSelect.value];
        weightImp.addEventListener("input", () => convert(weightImp, factor, weightMet));
        weightMet.addEventListener("input", () => convert(weightMet, 1 / factor, weightImp));
    }
    weightSelect.addEventListener("change", updateWeightConversion);
    updateWeightConversion();

    const areaImp = document.querySelector("input[name='aimp']");
    const areaMet = document.querySelector("input[name='amet']");
    areaImp.addEventListener("input", () => convert(areaImp, conversionFactors.areas, areaMet));
    areaMet.addEventListener("input", () => convert(areaMet, 1 / conversionFactors.areas, areaImp));


    const volumeImp = document.querySelector("input[name='vimp']");
    const volumeMet = document.querySelector("input[name='vmet']");
    volumeImp.addEventListener("input", () => convert(volumeImp, conversionFactors.volumes, volumeMet));
    volumeMet.addEventListener("input", () => convert(volumeMet, 1 / conversionFactors.volumes, volumeImp));
});
