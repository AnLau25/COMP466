import prods from './prods.json' assert { type: "json" };

console.log(prods);

const tableHead = document.querySelector("#productTable thead");
const tableBody = document.querySelector("#productTable tbody");

// Create a single header row
const headerRow = document.createElement("tr");
prods.products.forEach(product => {
    const th = document.createElement("th");
    th.textContent = product.title;
    headerRow.appendChild(th);
});
tableHead.appendChild(headerRow);

// Create a single row that holds product images
const imageRow = document.createElement("tr");
prods.products.forEach(product => {
    const imageCell = document.createElement("td");
    imageCell.innerHTML = `<img src="${prods.thumbnails[product.ID]}" alt="${product.title}" width="50">`;
    imageRow.appendChild(imageCell);
});
tableBody.appendChild(imageRow);

// Create a single row that holds product prices
const priceRow = document.createElement("tr");
prods.products.forEach(product => {
    const priceCell = document.createElement("td");
    priceCell.textContent = `$${product.price.toFixed(2)}`;
    priceRow.appendChild(priceCell);
});
tableBody.appendChild(priceRow);
