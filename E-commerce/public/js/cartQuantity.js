"use strict"

function add(productId) {
    
    let quantity=Number(document.getElementById('quantity_' + productId).value);
    quantity+=1;
    document.getElementById('quantity_' + productId).value=quantity;
}

function substract(productId) {

    let quantity=Number(document.getElementById('quantity_' + productId).value);
    if(quantity>1){
        quantity-=1;
        document.getElementById('quantity_' + productId).value=quantity;
    }
   
}
