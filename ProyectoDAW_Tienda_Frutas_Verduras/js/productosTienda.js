const CART_PRODUCTOS = "cartProductsId";

const baseDeDatos = [

    {
        "id": 1,
        "nombre": "Aguacate",
        "imagen": "../imágenes/aguacates.jpg",
        "precio": 5.99
    },
    {
        "id": 2,
        "nombre": "Albaricoques",
        "imagen": "../imágenes/albaricoques.jpg",
        "precio": 2.99
    },
    {
        "id": 3,
        "nombre": "Arándanos",
        "imagen": "../imágenes/arándanos.jpg",
        "precio": 8.99
    },
    {
        "id": 4,
        "nombre": "Calabaza",
        "imagen": "../imágenes/calabazas.jpg",
        "precio": 5.99
    },
    {
        "id": 5,
        "nombre": "Cebollas",
        "imagen": "../imágenes/cebollas.jpg",
        "precio": 1.99
    },
    {
        "id": 6,
        "nombre": "Coles de bruselas",
        "imagen": "../imágenes/coles_bruselas.jpg",
        "precio": 3.99
    },
    {
        "id": 7,
        "nombre": "Espárragos",
        "imagen": "../imágenes/espárragos.jpg",
        "precio": 3.99
    },
    {
        "id": 8,
        "nombre": "Frambuesas",
        "imagen": "../imágenes/frambuesas.jpg",
        "precio": 6.99
    },
    {
        "id": 9,
        "nombre": "Fresas",
        "imagen": "../imágenes/fresas.jpg",
        "precio": 5.99
    },
    {
        "id": 10,
        "nombre": "Granadas",
        "imagen": "../imágenes/granadas.jpg",
        "precio": 3.99
    },
    {
        "id": 11,
        "nombre": "Manzanas",
        "imagen": "../imágenes/manzana.jpg",
        "precio": 2.99
    },
    {
        "id": 12,
        "nombre": "Melocotones",
        "imagen": "../imágenes/melocotones.jpg",
        "precio": 2.99
    },
    {
        "id": 13,
        "nombre": "Naranjas",
        "imagen": "../imágenes/naranjas.jpg",
        "precio": 1.99
    },
    {
        "id": 14,
        "nombre": "Patatas",
        "imagen": "../imágenes/patatas.jpg",
        "precio": 1.49
    },
    {
        "id": 15,
        "nombre": "Pepinos",
        "imagen": "../imágenes/pepinos.jpg",
        "precio": 1.99
    },
    {
        "id": 16,
        "nombre": "Peras",
        "imagen": "../imágenes/peras.jpg",
        "precio": 2.99
    },
    {
        "id": 17,
        "nombre": "Pimientos",
        "imagen": "../imágenes/pimientos.jpg",
        "precio": 2.49
    },
    {
        "id": 18,
        "nombre": "Plátanos",
        "imagen": "../imágenes/platano.jpg",
        "precio": 1.99
    },
    {
        "id": 19,
        "nombre": "Sandía",
        "imagen": "../imágenes/sandía.jpg",
        "precio": 1.49
    },
    {
        "id": 20,
        "nombre": "Tomates",
        "imagen": "../imágenes/tomates.jpg",
        "precio": 1.99
    },
    {
        "id": 21,
        "nombre": "Zanahorias",
        "imagen": "../imágenes/zanahorias.jpg",
        "precio": 0.99
    }
];

document.addEventListener("DOMContentLoaded", () => {
    loadProducts();
    loadProductCart();

    document.getElementById('searchForm').addEventListener('submit', (event) => {
        event.preventDefault();
        filterProducts();
    });
});
async function loadProducts(filteredProducts = null) {
    const productos = filteredProducts || baseDeDatos;

    let html = "";
    productos.forEach(producto => {
        html += `
        <div class="col-md-3 product-container">
            <div class="card product">
                <img
                    src="${producto.imagen}"
                    class="card-img-top"
                    alt="${producto.nombre}"
                />
                <div class="card-body">
                    <h5 class="card-title">${producto.nombre}</h5>
                    <h6 class="card-text">${producto.precio} € / kg</h6>
                    <button type="button" class="btn btn-primary btn-cart" onClick=(addProductCart(${producto.id}))>Añadir al carrito</button>
                </div>
            </div>
        </div>
      `;
    });
    document.getElementsByClassName("productos")[0].innerHTML = html;
}
function filterProducts() {
    const searchName = document.getElementById('searchName').value.toLowerCase();
    const minPrice = parseFloat(document.getElementById('minPrice').value);
    const maxPrice = parseFloat(document.getElementById('maxPrice').value);

    const filteredProducts = baseDeDatos.filter(product => {
        const matchesName = product.nombre.toLowerCase().includes(searchName);
        const matchesMinPrice = isNaN(minPrice) || product.precio >= minPrice;
        const matchesMaxPrice = isNaN(maxPrice) || product.precio <= maxPrice;
        return matchesName && matchesMinPrice && matchesMaxPrice;
    });

    loadProducts(filteredProducts);
}
function addProductCart(idProduct) {
    let arrayProductsId = [];

    let localStorageItems = localStorage.getItem(CART_PRODUCTOS);

    if (localStorageItems === null) {
        arrayProductsId.push(idProduct);
        localStorage.setItem(CART_PRODUCTOS, arrayProductsId);
    } else {
        let productsId = localStorage.getItem(CART_PRODUCTOS);
        if (productsId.length > 0) {
            productsId += "," + idProduct;
        } else {
            productsId = idProduct;
        }
        localStorage.setItem(CART_PRODUCTOS, productsId);
    }

    loadProductCart();
}

async function loadProductCart() {
    const products = baseDeDatos;
    let cartPrice = 0;

    const localStorageItems = localStorage.getItem(CART_PRODUCTOS);

    let html = "";
    if (!localStorageItems) {
        html = `
        <div class="cart-product empty">
            <p>Carrito vacío.</p>
        </div>
      `;
    } else {
        const idProductsSplit = localStorageItems.split(",");

        // Eliminamos los IDs duplicaos
        const idProductsCart = Array.from(new Set(idProductsSplit));

        idProductsCart.forEach(id => {
            products.forEach(product => {
                if (id == product.id) {
                    const quantity = countDuplicatesId(id, idProductsSplit);
                    const totalPrecio = product.precio * quantity;
                    cartPrice += totalPrecio;

                    html += `
            <div class="cart-product">
                <img src="${product.imagen}" alt="${product.nombre}" />
                <div class="cart-product-info">
                    <span class="quantity">${quantity}</span>
                    <p>${product.nombre}</p>
                    <p>${totalPrecio.toFixed(2)} €</p>
                    <p class="change-quantity">
                        <button onClick="decreaseQuantity(${
                            product.id
                            })">-</button>
                        <button onClick="increaseQuantity(${
                            product.id
                            })">+</button>
                    </p>
                    <p class="cart-product-delete">
                        <button onClick=(deleteProductCart(${
                            product.id
                            }))>Eliminar</button>
                    </p>
                </div>
            </div>
        `;
                }
            });
        });
        html += `<p class="mt-3">Precio total: ${cartPrice.toFixed(2)} €</p>`;
        html += '<button onclick="processPayment()"class="btn btn-primary mb-3 mr-5">Pagar</button><button onclick="clearCart()"class="btn btn-primary mb-3">Borrar carrito</button>';
    }

    document.getElementsByClassName("cart-products")[0].innerHTML = html;

}
function clearCart (){
    localStorage.removeItem(CART_PRODUCTOS);
    loadProductCart();
}
function processPayment() {
    alert("¡Realizar Pago! Redirigiendo...");
    window.location.href = "../html/pagarTarjeta.html";
}
function returnPayment() {
    document.getElementById('payment-success').style.display = 'block';
    localStorage.removeItem(CART_PRODUCTOS);
    setTimeout(function() {
            window.location.href = "../html/tienda.html";
        }, 3000);
    return false;
    
}
function deleteProductCart(idProduct) {
    const idProductsCart = localStorage.getItem(CART_PRODUCTOS);
    const arrayIdProductsCart = idProductsCart ? idProductsCart.split(",") : [];

    const resultIdDelete = deleteAllIds(idProduct, arrayIdProductsCart);

    if (resultIdDelete.length > 0) {
        localStorage.setItem(CART_PRODUCTOS, resultIdDelete.join(","));
    } else {
        localStorage.removeItem(CART_PRODUCTOS);
    }

    loadProductCart();
}


function increaseQuantity(idProduct) {
    const idProductsCart = localStorage.getItem(CART_PRODUCTOS);
    const arrayIdProductsCart = idProductsCart.split(",");
    arrayIdProductsCart.push(idProduct);

    let count = 0;
    let idsString = "";
    arrayIdProductsCart.forEach(id => {
        count++;
        if (count < arrayIdProductsCart.length) {
            idsString += id + ",";
        } else {
            idsString += id;
        }
    });
    localStorage.setItem(CART_PRODUCTOS, idsString);
    loadProductCart();
}

function decreaseQuantity(idProduct) {
    const idProductsCart = localStorage.getItem(CART_PRODUCTOS);
    const arrayIdProductsCart = idProductsCart ? idProductsCart.split(",") : [];

    const index = arrayIdProductsCart.indexOf(idProduct.toString());
    if (index > -1) {
        arrayIdProductsCart.splice(index, 1);
    }

    if (arrayIdProductsCart.length > 0) {
        localStorage.setItem(CART_PRODUCTOS, arrayIdProductsCart.join(","));
    } else {
        localStorage.removeItem(CART_PRODUCTOS);
    }

    loadProductCart();
}


function countDuplicatesId(value, arrayIds) {
    let count = 0;
    arrayIds.forEach(id => {
        if (value == id) {
            count++;
        }
    });
    return count;
}

function deleteAllIds(id, arrayIds) {
    return arrayIds.filter(itemId => {
        return itemId != id;
    });
}
