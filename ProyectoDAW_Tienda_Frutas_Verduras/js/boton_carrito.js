 document.addEventListener('DOMContentLoaded', (event) => {
            const botoncarrito = document.getElementById('cartButton');
            const cartProducts = document.getElementById('cartProducts');

            botoncarrito.addEventListener("click", () => {
                cartProducts.classList.toggle('hidden');
            });
        });