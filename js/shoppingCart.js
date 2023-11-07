const cart = [];


//NOTE only numbers should be accepted in this cart
function addToCart(item_id) {
    if (typeof item_id != "number") {
        //alert("INVALID! Not an item")
        return false;
    } else {
    cart.push(item_id);
    //alert("VALID ITEM")
    return true;
    }
}
