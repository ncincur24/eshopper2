function setLS(name, data){
    localStorage.setItem(name, JSON.stringify(data));
}
function getLS(name){
    return JSON.parse(localStorage.getItem(name));
}
function removeLS(name){
    return localStorage.removeItem(name);
}
$('.add-to-cart').click(addToCart);


function addToCart(){
    if(parseInt($('#quantity').val()) < 1){
        $('#quantity').val(1);
    }
    // formCheck("true", "true", "quantity");
    addedToCartMessage();
    let products = getLS("cart");
    let qty = 1;
    let idProduct = $(this).data("id");
    let price = $(this).data('price');
    if(idProduct == undefined){
        idProduct = $(this).data('sid');
        qty = $('#quantity').val();
        $('#quantity').val(1);
    }
    if(products){
        if(products.filter(p => p.id == idProduct).length){
            products.filter(x => x.id == idProduct)[0].quantity = parseInt(qty) + parseInt(products.filter(x => x.id == idProduct)[0].quantity);
            setLS("cart", products);
        }
        else{
            products.push({
                id: idProduct,
                quantity: qty
            });
            setLS("cart", products);
        }
    }
    else{
        let product = [];
        product[0] = {
            id: idProduct,
            //quantity: 1
            quantity: qty
        }
        setLS("cart", product);
    }
    numberOfProducts();
}
function showCart(){
    let cartProd = getLS("cart");
    let div = $("#cartDecide");

    if(cartProd == null || cartProd.length == 0){
        $(div).html("<h1 class='m-auto'>Your cart is empty</h1>");
    }
    else{
        let send = {
            ids: cartProd.map(x => x["id"]),
            btn: true
        }
        ajaxCallback(`${$(div).data('route')}`, "get", send, result=>{
            if(result.end) {
                let total = 0;
                let html = `<div class="col-lg-8 table-responsive mb-5">
                                    <table class="table table-bordered text-center mb-0">
                                        <thead class="bg-secondary text-dark">
                                        <tr>
                                            <th>Products</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                        </thead>
                                        <tbody class="align-middle">`;
                let i = 0;
                for (p of result.products) {
                    html += `<tr>
                                    <td class="align-middle"> ${p.name}</td>
                                    <td class="align-middle" data-price="${p.current_price}">$${p.current_price}</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" >
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input disabled type="text" class="form-control form-control-sm bg-secondary text-center prodQty" data-id="${p.id}" value="${cartProd[i].quantity}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle single-total">$${(parseFloat(p.current_price) * cartProd[i]["quantity"]).toFixed(2)}</td>
                                    <td class="align-middle"><button class="btn btn-sm btn-primary product-remove" data-id="${p.id}"><i class="fa fa-times"></i></button></td>
                                </tr>
                                <tr>`;
                    total += parseFloat(p.current_price) * cartProd[i]["quantity"];
                    i++;
                }
                html += `</tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-secondary mb-5">
                            <div class="card-header bg-secondary border-0">
                                <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3 pt-1">
                                    <h6 class="font-weight-medium">Subtotal</h6>
                                    <h6 class="font-weight-medium" id="final-subtotal">$${(parseFloat(total)).toFixed(2)}</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Shipping</h6>
                                    <h6 class="font-weight-medium">$10</h6>
                                </div>
                            </div>
                            <div class="card-footer border-secondary bg-transparent">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5 class="font-weight-bold">Total</h5>
                                    <h5 class="font-weight-bold" id="final-price">$${(parseFloat(total + 10)).toFixed(2)}</h5>
                                </div>
                                <button class="btn btn-block btn-primary my-3 py-3" data-price="${(parseFloat(total + 10)).toFixed(2)}" id="checkout">Proceed To Checkout</button>
                            </div>
                        </div>
                    </div>`;
                $(div).html(html);
                $('.prodQty').blur(function(){
                    if(parseInt($(this).val()) < 1){
                        $(this).val(1);
                    }
                    changeTotal();
                    // cartProd.filter(x => x.id == $(this).data('id'))[0].quantity = parseInt($(this).val());
                    // setLS("cart", cartProd);
                    // showCart();
                });
                $('.product-remove').click(function(){
                    removeFromCart($(this).data('id'));
                    numberOfProducts();
                });
                $('.btn-minus').click(function(){
                    let qty = $(this).parent().next();
                    if(parseInt($(qty).val()) > 1){
                        $(qty).val(parseInt((qty).val()) - 1);
                    }
                    let chPrice = $(this).parent().parent().parent().prev().data('price');
                    let change =  $(this).parent().parent().parent().next();
                    adjustCart(qty, chPrice, change);
                    changeTotal();
                    cartProd.filter(x => x.id == $(qty).data('id'))[0].quantity = parseInt($(qty).val());
                    setLS("cart", cartProd);
                });
                $('.btn-plus').click(function(){
                    let qty = $(this).parent().prev();
                    $(qty).val(parseInt((qty).val()) + 1);
                    let chPrice = $(this).parent().parent().parent().prev().data('price');
                    let change =  $(this).parent().parent().parent().next();
                    adjustCart(qty, chPrice, change);
                    changeTotal();
                    cartProd.filter(x => x.id == $(qty).data('id'))[0].quantity = parseInt($(qty).val());
                    setLS("cart", cartProd);
                });
                $('#checkout').click(function (){
                    window.location.href=$('#cartDecide').data('check')+"?go=true&total="+($(this).data('price'));
                });
                function changeTotal() {
                    let newTotal = 0;
                    $('.single-total').each(function (){
                        newTotal += parseFloat($(this).text().substring(1));
                    });
                    newTotal = parseFloat(newTotal.toFixed(2));
                    $('#final-price').contents().filter((_, el) => el.nodeType === 3).remove();
                    $('#final-subtotal').contents().filter((_, el) => el.nodeType === 3).remove();
                    $('#final-subtotal').text("$"+newTotal);
                    $('#final-price').text("$"+(newTotal+10));
                    $('#checkout').attr('data-price', newTotal+10);
                }
            }
        }, xhr => console.log(xhr));
    }
}
function adjustCart(qty, singlePrice, price){
    // let chPrice = $(this).parent().parent().parent().prev().data('price');
    $(price).text("$"+(parseFloat(singlePrice)*parseInt($(qty).val())).toFixed(2));
}
function removeFromCart(id) {
    let products = getLS("cart");
    let filtered = products.filter(p => p.id != id);
    setLS("cart", filtered);
    showCart();
}
function numberOfProducts(){
    let number = getLS("cart");
    if(number == null || number.length == 0){
        $("#productNumber").html(`0`);
    }
    else{
        $("#productNumber").html(`${number.length}`);
    }
}
function addedToCartMessage() {
    var x = document.getElementById("snackbar");
    x.innerHTML = "Product added to cart";
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
}
