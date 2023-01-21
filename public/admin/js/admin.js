window.onload = function() {
    var reloading = sessionStorage.getItem("reloading");
    var type = sessionStorage.getItem("type");
    if (reloading) {
        sessionStorage.removeItem("reloading");
        sessionStorage.removeItem("type");
        $('#'+type).before(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-exclamation-circle me-2"></i>Successfully deleted
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`);
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    }
    if(url.indexOf("/admin/home") != -1){
        $(".navbar-nav a[href='index.php?page=category']").addClass("active");
    }
}

$('.status').change(function (){
    let field = $(this).parent().parent().find('input[type=hidden]');
    let route = $(field).data('route');
    let send = {
        dataValue: $("option:selected", this).val(),
        column: $(this).data('type'),
        btn: true
    }
    ajaxCallback(route, "patch", send, result=>{
        console.log(result)
    }, xhr=>console.log(xhr));
});
$('#addUser').click(function (){
    registration(true);
});

$('#editProduct').click(function (){
    formCheck($("#name").val(), /^([\w\.\-\s\!\?\,\(\)\"\'\:\;\@]){3,80}$/, "name", "Name of product should be from 5 to 40 characters");
    formCheck($("#price").val(), /^\d+(\.?\d+)?$/, "priceErr", "Enter price ex. 43.22 (use . not ,)");
    formCheck($("#description").val(), /^(\w|\?|\!|\.|\,|\'|\‘|\-|\(|\)|\:|\;|\"|\d|\s){20,}$/, "description", "Description should have at least 20 charecters");

    if(errors.length == 0){
        let send = {
            name: $('#name').val(),
            price: $('#price').val(),
            brand: $('#brandAdmin option:selected').val(),
            type: $('#typeAdmin option:selected').val(),
            description: $('#description').val(),
            update: true
        }
        ajaxCallback($(this).data('route'), "patch", send,
            result=>{
                if(result.end){
                    $('#editProductForm').append(`<div class="modal fade" id="successful-registration" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content bg-secondary">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Product added</h5>
                            </div>
                            <div class="modal-body text-white">
                                You have successefuly edited product
                            </div>
                            <div class="modal-footer">
                              <a href="${result.route}" class="btn btn-primary">OK</a>
                            </div>
                          </div>
                        </div>
                      </div>`);
                    $('#successful-registration').modal({backdrop: 'static', keyboard: false}).modal('show');
                }
            },
            xhr=>{            console.log(xhr);
                serverCheck(xhr.responseJSON.errors.name ,"name");
                serverCheck(xhr.responseJSON.errors.price ,"priceErr");
                serverCheck(xhr.responseJSON.errors.description ,"description");
                serverCheck(xhr.responseJSON.errors.brand ,"brandAdmin");
                serverCheck(xhr.responseJSON.errors.type ,"typeAdmin");
        });
    }
});
$('.delete-icon').click(function (){
    let route = $(this).data('route');
    let element = $(this).parent().parent().parent();
    let type = $(element).data('type');
    let id = $(this).parent().parent().attr('id');

    $(element).append(`<div class="modal fade" id="deleting" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content bg-secondary">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete a product</h5>
                            </div>
                            <div class="modal-body text-white">
                                Are you sure that you want to delete a ${type}?
                            </div>
                            <div class="modal-footer">
                              <button id="confirm" class="btn btn-success">YES</button>
                            </div>
                          </div>
                        </div>
                      </div>`);
    $('#deleting').modal('show');
    $('#confirm').click(function (){
        $('#deleting').modal('hide');
        $('#deleting').remove();
        ajaxCallback(route, "delete", send, result=>{
            if (result){
                sessionStorage.setItem("reloading", "true");
                sessionStorage.setItem("type", type);
                location.reload();
            }
            else {
                serverCheck("You can't delete this "+type, id);
            }

        }, xhr=>console.log(xhr));
    });

    let send = {
        btn: true
    }
});
$('.soft-delete').change(function (){
   console.log($(this).val());
});
$('#addBrand').click(function (){
    let brand = $('#addBrandColumn').val();
    let route = $(this).data('route');
    formCheck(brand, /^([A-Z][a-z]{2,15}){1,5}(\s[A-Z]{0,2}[a-z]{2,15}){0,4}$/, "addBrandColumn", "Please enter brand name ex. Adidas");

    if(errors.length == 0){
        let send = {
            name: brand,
            btn: true
        }
        ajaxCallback(route, "post", send, result=>{
            if (result){
                $(this).after("<p class='text-success mt-2'>Brand added successfully</p>")
                setTimeout(function (){
                   location.reload();
                }, 1000);
            }

        }, xhr=> {
            console.log(xhr)
            serverCheck(xhr.responseJSON.errors.name ,"addBrandColumn");
        });
    }

});
$('.editBtn').click(function (){
    let route = $(this).data('route');
    let elem = $(this).parent().prev().children().first();
    formCheck($(elem).val(), /^([A-Z][a-z]{2,15}){1,5}(\s[A-Z]{0,2}[a-z]{2,15}){0,4}$/, $(elem).attr('id'), "Please enter brand name ex. Adidas");

    if(errors.length == 0){
        let send = {
            name: $(elem).val(),
            update: true
        }
        ajaxCallback(route, "patch", send, result=>{
            if (result){
                $(elem).after("<p class='text-success mt-2'>Successfully changed</p>");
                setTimeout(function (){
                    location.reload();
                },1000);
            }

        }, xhr=> {
            console.log(xhr)
            serverCheck(xhr.responseJSON.errors.name ,$(elem).attr('id'));
        });
    }
});
