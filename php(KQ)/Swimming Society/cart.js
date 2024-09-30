document.addEventListener('DOMContentLoaded', function () {
    const cartItems = [];
    const cartTotal = document.getElementById('cart-total');
    const cartTable = document.getElementById('cart-table');
    const cartList = document.getElementById('cart-items');
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    

    addToCartButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const name = button.getAttribute('data-name');
            const price = parseFloat(button.getAttribute('data-price'));
            const existingItem = cartItems.find((item) => item.name === name);

            if (existingItem) {
                // If the item is already in the cart, increase the quantity
                existingItem.quantity++;
            } else {
                // Otherwise, add a new item to the cart
                cartItems.push({ name, price, quantity: 1 });
            }

            updateCart();
        });
    });

    function updateCart() {
        let total = 0;
        cartList.innerHTML = '';

        cartItems.forEach((item) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td>RM${item.price.toFixed(2)}</td>
                <td>${item.quantity}</td>
                <td><button class="remove-item" data-name="${item.name}">Remove</button></td>
            `;
            cartList.appendChild(row);

            // Update the total price
            total += item.price * item.quantity;
        });

        cartTotal.textContent = total.toFixed(2);
    }

    cartTable.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-item')) {
            const itemName = event.target.getAttribute('data-name');
            const index = cartItems.findIndex((item) => item.name === itemName);
            if (index !== -1) {
                const item = cartItems[index];
                if (item.quantity > 1) {
                    // If quantity is greater than 1, decrease it
                    item.quantity--;
                } else {
                    // Otherwise, remove the item from the cart
                    cartItems.splice(index, 1);
                }
                updateCart();
            }
        }
    });

    const checkoutButton = document.getElementById('checkout-btn');
    checkoutButton.addEventListener('click', function () {
        alert('Thank you for your purchase! Total: RM' + cartTotal.textContent);
        cartItems.length = 0; // Clear the cart
        updateCart();
    });
});

//dropdown
function toggleContent(id) {
    var content = document.getElementById(id);
    content.classList.toggle('visible');

    var borders = content.querySelectorAll('.border'); // Get all elements with class "border" inside the content
    borders.forEach(function(border) {
        border.classList.toggle('visible2');
    });
}