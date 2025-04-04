let products = [];

function addProduct() {
    let name = document.getElementById("productName").value;
    let stock = parseInt(document.getElementById("productStock").value);
    let price = parseFloat(document.getElementById("productPrice").value);

    if (name && stock > 0 && price > 0) {
        products.push({ name, stock, price });
        displayProducts();
        clearInputs();
    } else {
        alert("Masukkan data yang valid!");
    }
}

function displayProducts() {
    let tableBody = document.getElementById("productList");
    tableBody.innerHTML = "";

    products.forEach((product, index) => {
        let row = `<tr>
            <td>${product.name}</td>
            <td>${product.stock}</td>
            <td>Rp ${product.price.toLocaleString()}</td>
            <td><button class="delete-btn" onclick="deleteProduct(${index})">Hapus</button></td>
        </tr>`;
        tableBody.innerHTML += row;
    });
}

function deleteProduct(index) {
    products.splice(index, 1);
    displayProducts();
}

function clearInputs() {
    document.getElementById("productName").value = "";
    document.getElementById("productStock").value = "";
    document.getElementById("productPrice").value = "";
}
