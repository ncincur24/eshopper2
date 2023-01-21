let errors = [];
function ajaxCallback(page, method, data, result, error){
    $.ajax({
        url: page,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: method,
        dataType: "json",
        data: data,
        success: result,
        error: error
    })
}
$(document).ready(function (){
    numberOfProducts();
    let url = window.location.href;
    if(url.indexOf("/cart") != -1){
        showCart();
    }

});



$('#registerForm').keypress(event=>{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        registration();
    }
});
$("#register").click(registration);

$('#loginForm').keypress(event=>{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        login();
    }
});
$("#loginBtn").click(login);
$('#makeOrder').click(function (){
    formCheck($('#address').val(), /^([A-Z][a-z]{2,50}|\d{1,5})(\s([AZ]*[a-z]{2,50}|\d{1,5}))*$/, "address", "Please enter your address");
    if(errors.length == 0){
        let send = {
            products: getLS("cart"),
            address: $('#address').val(),
            total: $(this).data('price'),
            btn: true
        }
        let route = $(this).data('route');
        ajaxCallback(route, "post", send, result=>{
            if(result.pass){
                $(this).after("<p class='text-success'>Your order has been sent successfully, you can expect it in 2-4 days. Thank you for your purchase :), we will redirect you now</p>");
                removeLS("cart");
                setTimeout(function(){
                    window.location.replace(result.route);
                }, 2000);
            }
        }, xhr => {
            console.log(xhr);
            serverCheck(xhr.responseJSON.errors.address ,"address");
        });
    }
});
$('#btnContactMessage').click(function() {
    formCheck($('#contactName').val(), /^[A-Z][a-z]{2,15}$/, "contactName",
        "Please enter your name ex. David");
    formCheck($("#contactEmail").val(), /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/,
        "contactEmail", "Please enter your email ex. email@gmail.com");
    formCheck($("#contactMessage").val(), /^([\w\.\-\s\,\!\?\(\)\@\;\:\"\'\`\$]{10,300})+$/,
        "contactMessage", "Message should have at least 10 characters");
    if (errors.length == 0) {
        let send = {
            name: $("#contactName").val(),
            email: $("#contactEmail").val(),
            message: $("#contactMessage").val(),
            btn: true
        }
        ajaxCallback($(this).data('route'), "post", send, result => {
            if (result) {
                $('#form-contact').trigger("reset");
                $('#contactMessage').after(`<p class='help-block text-success' id='pass'>Your message has been sent successfully</p>`);
            }
        }, xhr=> {
            serverCheck(error.responseJSON.errors.name ,"name");
            serverCheck(error.responseJSON.errors.email ,"email");
            serverCheck(error.responseJSON.errors.message ,"message");
        });
    }
});
function registration(){
    formCheck($("#name").val(), /^[A-Z][a-z]{2,15}$/, "name", "Please enter your name ex. David");
    formCheck($("#lastName").val(), /^[A-Z][a-z]{2,15}(\s([A-Z][a-z]{2,15})){0,3}$/, "lastName", "Please enter your last name ex. James");
    formCheck($("#email").val(), /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/, "email", "Please enter your email ex. email@gmail.com");
    formCheck($("#password").val(), /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]{6,}$/, "password", "Password length has to be at least 6, and it has to have at least one number and no special characters");
    formCheck($("#conf-password").val(), /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]{6,}$/, "conf-password", "Password do not match");
    if(errors.length == 0){
        let send = {
            name: $("#name").val(),
            last_name: $("#lastName").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            btn: true
        }
        let route = $(this).data('route');
        ajaxCallback(route, "post", send,
            result=>{
                $('#registerForm').find('p').prev().removeClass("border border-danger");
                $('#registerForm').find('p').remove();
                    if(result.end){
                        $('#registerForm').append(`<div class="modal fade" id="deleting" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Successfull registration</h5>
                            </div>
                            <div class="modal-body">
                                You registered successfully. You can log in now.
                            </div>
                            <div class="modal-footer">
                              <a href="${result.route}" class="btn btn-primary">OK</a>
                            </div>
                          </div>
                        </div>
                      </div>`);
                        $('#deleting').modal('show');
                    }
            },
            error=>{
            console.log(error);
                serverCheck(error.responseJSON.errors.name ,"name");
                serverCheck(error.responseJSON.errors.last_name ,"lastName");
                serverCheck(error.responseJSON.errors.email ,"email");
                serverCheck(error.responseJSON.errors.password ,"password");
        });
    }
}

function login() {
    formCheck($("#email").val(), /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/, "email", "Please enter your email ex. email@gmail.com");
    formCheck($("#password").val(), /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]{6,}$/, "password", "Password length has to be at least 6, and it has to have at least one number and no special characters");
    if(errors.length == 0){
        let send = {
            email: $("#email").val(),
            password: $("#password").val(),
            btn: true
        }
        let log = $('#loginBtn');
        let route = $(log).data('route');
        ajaxCallback(route, "post", send,
            result=>{
                serverCheck(result.email ,"email");
                serverCheck(result.password ,"password");
                console.log(result);
                if(result.pass){
                    $(log).after(`<p class='mt-2 text-success'>Welcome ${result.name}</p>`);
                    setTimeout(function(){
                        window.location.replace(result.route);
                    }, 1000);

                }
            },
            error=>{
            console.log(error);
                serverCheck(error.responseJSON.errors.email ,"email");
                serverCheck(error.responseJSON.errors.password ,"password");
            });
    }
}




















function formCheck(val, reg, id, message){
    if(val.match(reg)){
        if(id == "conf-password"){
            if($('#password').val() != val){
                if($(`#message-conf-password`).is(":visible")) return;
                $('#conf-password').addClass('border border-danger').after(`<p class='text-danger mb-0' id='message-conf-password'>${message}</p>`);
                errors.push(id);
                return;
            }
        }
        // $(`#message-${id}`).fadeOut();
        $(`#message-${id}`).remove();
        $(`#${id}`).removeClass("border border-danger");
        errors = errors.filter(el=>el != id);
        return true;
    }
    else if(id == "conf-password") {
        if($(`#message-${id}`).is(":visible")) return;
        $(`#${id}`).after(`<p class='text-danger mb-0' id='message-${id}'>${message}</p>`).addClass('border border-danger');
        errors.push(id);
    }
    else{
        $('#pass').remove();
        errors.push(id);
        if($(`#message-${id}`).is(":visible")) return;
        $(`#${id}`).after(`<p class='help-block text-danger mb-0' id='message-${id}'>${message}</p>`);
        if(id.indexOf("id-") != -1) return;
        $(`#${id}`).addClass("border border-danger");
    }
}
function serverCheck(data, id){
    if(data != undefined){
        $(`#message-${id}`).remove();
        if($(`#message-${id}`).is(":visible")) return;
        $(`#${id}`).addClass('border border-danger').after(`<p class='help-block text-danger mb-0' id='message-${id}'>${data}</p>`);
    }
    else{
        formCheck("true", "true", id, "m");
    }
}
//
// let route = $('#custom-paginate').data('route');
//
//
// $('#custom-paginate a').click(function (event){
//     event.preventDefault();
//     let page = $(this).attr('href').split('page=')[1];
//     ajaxCallback(route+"?page="+page, "get", null, result => {
//         write(result.products.data);
//     });
// });
// $('.brand-filter').change(function (){
//     let selectedBrands = [];
//     $('.brand-filter:checked').each(function(){
//         selectedBrands.push(parseInt($(this).val()));
//     });
//     let send = {
//         selectedBrands: selectedBrands
//     }
//     ajaxCallback(route, "get", send, result => {
//         write(result.products.data);
//     });
// });
// function write(data){
//     let html = "";
//     for (i of data){
//         html += `<div class="col-lg-4 col-md-6 col-sm-12 pb-1">
//                         <div class="card product-item border-0 mb-4">
//                             <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
//                                 <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
//                             </div>
//                             <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
//                                 <h6 class="text-truncate mb-3">${i.name}</h6>
//                                 <div class="d-flex justify-content-center">
//                                     <h6>${i.current_price}</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
//                                 </div>
//                             </div>
//                             <div class="card-footer d-flex justify-content-between bg-light border">
//                                 <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
//                                 <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
//                             </div>
//                         </div>
//                     </div>`;
//     }
//     $('#write').html(html);
// }
