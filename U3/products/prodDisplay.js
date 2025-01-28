import products from 'prods.json';
import descriptions from 'descripts.json';
import thumbnails from 'thubs.json';

console.log(products);
console.log(descriptions);
console.log(thumbnails);

const tableHead = document.querySelector("#productTable thead");
const tableBody = document.querySelector("#productTable tbody");

products.products.forEach(product => {
    const row = document.createElement("tr");

    // Create table cells for each property
    row.innerHTML = `
      <td>${product.id}</td>
      <td>${product.title}</td>
      <td>${product.price}</td>
      <td><img src="${product.thumbnail}" alt="${product.title}" width="50"></td>
    `;

    // Append the row to the table body
    tableBody.appendChild(row);
});