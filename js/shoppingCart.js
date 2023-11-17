const cart = [];

function addToCart(item_id) {
    if (typeof item_id != "number") {
        //alert("INVALID! Not an item")
        return false;
    } else {
    cart.push(item_id);
    //alert("VALID ITEM")
    return true;
    }
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


// The JavaScript function goToPayment() creates a form dynamically, sets its action to the PHP payment processing file (PaymentForm.php), adds the shopping cart data as a hidden input, and submits the form.
