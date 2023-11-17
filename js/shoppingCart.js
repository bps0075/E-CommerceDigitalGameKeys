const cart = [];

function addToCart(item_id) {
    // Your existing code to add item_id to the cart
    cart.push(item_id);
}

function goToPayment() {
    // Assuming you have a function to redirect to the payment page
    // Create a form dynamically
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'PaymentForm.php'; // Replace with your payment processing PHP file

    // Create a hidden input field to store the cart data
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'shoppingCart';
    input.value = JSON.stringify(cart); // Convert cart array to a string before sending

    // Append the input to the form and then submit
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}
