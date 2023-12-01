let cart = [];

function addToCart(item_id) {
    if (typeof item_id !== "number" || !Number.isInteger(item_id)) {
    // Invalid item_id
    return false;
    }  else {
    // Valid item_id
    cart.push(item_id);
    console.log(cart.length - 1);
    return true;
    }
}

function goToPayment() {
    // Create a form dynamically
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'PaymentForm.php'; // Replace with the correct path to PaymentForm.php

    // Create a hidden input field to store the cart data
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'shoppingCart';
    input.value = JSON.stringify(cart); // Convert cart array to a string before sending

    // Append the input to the form
    form.appendChild(input);

    // Create another hidden input field to specify that the data should be treated as an array in PHP
    const arrayFlag = document.createElement('input');
    arrayFlag.type = 'hidden';
    arrayFlag.name = 'is_array';
    arrayFlag.value = '1'; // Set a value to indicate it's an array

    // Append the arrayFlag to the form
    form.appendChild(arrayFlag);

    // Append the form to the body
    document.body.appendChild(form);

    // Submit the form
    form.submit();

    // Remove the form from the DOM after submission
    document.body.removeChild(form);
}

// The JavaScript function goToPayment() creates a form dynamically, sets its action to the PHP payment processing file (PaymentForm.php), adds the shopping cart data as a hidden input, and submits the form.
