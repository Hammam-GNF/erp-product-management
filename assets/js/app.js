document.addEventListener("DOMContentLoaded", () => {
    loadProducts();

    const form = document.getElementById("productForm");

    loadCategories();

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const data = {
            category_id: document.getElementById("category_id").value,
            name_product: document.getElementById("name_product").value,
            price: document.getElementById("price").value,
            stock: document.getElementById("stock").value
        };

        try {
            const response = await fetch("api/product.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.status === "success") {
                alert("Product added successfully");
                form.reset();
                loadProducts();
            } else {
                alert(result.message);
            }

        } catch (error) {
            alert("Error adding product");
        }
    });
});

async function loadProducts() {
    try {
        const response = await fetch("api/product.php");
        const result = await response.json();

        const table = document.getElementById("productTable");
        table.innerHTML = "";

        result.data.forEach(product => {
            table.innerHTML += `
                <tr>
                    <td>${product.id}</td>
                    <td>${product.name_product}</td>
                    <td>${product.name_category}</td>
                    <td>${product.price}</td>
                    <td>${product.stock}</td>
                    <td>
                        <button class="btn btn-sm btn-info"
                            onclick="checkStock(${product.stock})">
                            Cek Status
                        </button>
                    </td>
                </tr>
            `;
        });

    } catch (error) {
        console.error("Error loading products");
    }
}

function checkStock(stock) {
    if (stock > 0) {
        alert("Tersedia");
    } else {
        alert("Habis");
    }
}

async function loadCategories() {
    const response = await fetch("api/category.php");
    const result = await response.json();

    const select = document.getElementById("category_id");
    select.innerHTML = '<option value="">Select Category</option>';

    result.data.forEach(cat => {
        select.innerHTML += `
            <option value="${cat.id}">
                ${cat.name_category}
            </option>
        `;
    });
}
