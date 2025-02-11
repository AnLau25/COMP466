document.addEventListener("DOMContentLoaded", function () {
 
    const conversionFactors = {
        lengths: [2.54, 0.0254, 30.48, 0.3048, 1.60934], 
        weights: [28.3495, 0.453592], 
        areas: 0.092903, 
        volumes: 3.78541 
    };

    function convert(input, factor, target) {
        if (input.value.trim() !== "") {
            target.value = (parseFloat(input.value) * factor).toFixed(4);
        } else {
            target.value = "";
        }
    }

    /*Meassurements logic*/
    const lengthSelect = document.getElementById("lengths");
    const lengthImp = document.querySelector("input[name='limp']");
    const lengthMet = document.querySelector("input[name='lmet']");
    const lengthPlaceholders = [
        ["inches", "cm"],
        ["inches", "meters"],
        ["feet", "cm"],
        ["feet", "meters"],
        ["miles", "km"]
    ];

    function updateLengthConversion() {
        const factor = conversionFactors.lengths[lengthSelect.value];
        const placeholders = lengthPlaceholders[lengthSelect.value];
        lengthImp.placeholder = placeholders[0];
        lengthMet.placeholder = placeholders[1];
        lengthImp.addEventListener("input", () => convert(lengthImp, factor, lengthMet));
        lengthMet.addEventListener("input", () => convert(lengthMet, 1 / factor, lengthImp));
    }
    lengthSelect.addEventListener("change", updateLengthConversion);
    updateLengthConversion();


    const weightSelect = document.getElementById("weights");
    const weightImp = document.querySelector("input[name='wimp']");
    const weightMet = document.querySelector("input[name='wnmet']");
    const weightPlaceholders = [
        ["oz", "gr"],
        ["lb", "kg"]
    ];

    function updateWeightConversion() {
        const factor = conversionFactors.weights[weightSelect.value];
        const placeholders = weightPlaceholders[weightSelect.value];
        weightImp.placeholder = placeholders[0];
        weightMet.placeholder = placeholders[1];
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

    /*Mortgage logic*/
    document.getElementById("calcMortgage").addEventListener("click", function () {
        const amount = parseFloat(document.querySelector('input[name="amnt"]').value);
        const rate = parseFloat(document.querySelector('input[name="rate"]').value);
        const term = parseInt(document.querySelector('input[name="term"]').value);

        if (isNaN(amount) || isNaN(rate) || isNaN(term) || amount <= 0 || rate <= 0 || term <= 0) {
            alert("Please enter valid positive numbers for all fields.");
            return;
        }

        const monthlyRate = rate / 100 / 12;
        const totalPayments = term * 12;

        const mortgage = (amount * monthlyRate * Math.pow(1 + monthlyRate, totalPayments)) /
                         (Math.pow(1 + monthlyRate, totalPayments) - 1);

        document.getElementById("soln").querySelector("span").textContent = mortgage.toFixed(2) + "$";
    });

    /*Temperature logic*/
    const far = document.querySelector("input[name='heit']");
    const cel = document.querySelector("input[name='cius']");
    const kel = document.querySelector("input[name='vin']");

    function fahrenheitToCelsius(f) {
        return ((f - 32) * 5) / 9;
    }

    function celsiusToFahrenheit(c) {
        return (c * 9) / 5 + 32;
    }

    function celsiusToKelvin(c) {
        return c + 273.15;
    }

    function kelvinToCelsius(k) {
        return k - 273.15;
    }

    far.addEventListener("input", () => {
        if (far.value.trim() !== "") {
            const f = parseFloat(far.value);
            const c = fahrenheitToCelsius(f);
            const k = celsiusToKelvin(c);
            cel.value = c.toFixed(2);
            kel.value = k.toFixed(2);
        } else {
            cel.value = "";
            kel.value = "";
        }
    });

    cel.addEventListener("input", () => {
        if (cel.value.trim() !== "") {
            const c = parseFloat(cel.value);
            const f = celsiusToFahrenheit(c);
            const k = celsiusToKelvin(c);
            far.value = f.toFixed(2);
            kel.value = k.toFixed(2);
        } else {
            far.value = "";
            kel.value = "";
        }
    });

    kel.addEventListener("input", () => {
        if (kel.value.trim() !== "") {
            const k = parseFloat(kel.value);
            const c = kelvinToCelsius(k);
            const f = celsiusToFahrenheit(c);
            cel.value = c.toFixed(2);
            far.value = f.toFixed(2);
        } else {
            cel.value = "";
            far.value = "";
        }
    });
});
