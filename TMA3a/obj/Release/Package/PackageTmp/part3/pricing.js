document.addEventListener("DOMContentLoaded", function () {

    let basePrices = {
        1: 14.99, 
        2: 94,
        3: 295,
        4: 714.99,
        5: 459
    };

    function updatePrice() {
        let basePrice = basePrices[parseInt(new URLSearchParams(window.location.search).get("pc"))] || 0;
        let total = basePrice;

        let dropdowns = document.querySelectorAll("select.cta");
        dropdowns.forEach(dropdown => {
            let selectedOption = dropdown.options[dropdown.selectedIndex];
            if (selectedOption) {
                total += parseInt(selectedOption.value) || 0;
            }
        });

        document.getElementById("<%= Price.ClientID %>").innerText = "Total Price: $" + total;
    }

    document.querySelectorAll("select.cta").forEach(dropdown => {
        dropdown.addEventListener("change", updatePrice);
    });

    updatePrice(); 
});