$(document).ready(function() {

    //Initialized
    drawProductsList();
    var product_add_btn = $('#product-add-button');
    var model_add_btn = $('#add-model-button');
    var model_modal = $('#addModelModal');

    var process_error = $('.process-error');
    var process_success = $('.process-success');
    process_error.hide();
    process_success.hide();

    //Add Procuts
    product_add_btn.on('click',function (event) {
        var product_name = $('#add-product-name');

        $.ajax({
            url: '/api/products',
            type: 'post',
            data: {
                name: product_name.val()
            },
            headers: {
                Authorization: 'Bearer ' + token
            },
            dataType: 'json',
            success: function (data) {
                if(data.error){
                    process_error.fadeIn();
                    $('.error-message').html(data.error.message);
                    //console.log(data.error.message);
                    process_error.fadeOut(1000);
                }else{
                    process_success.fadeIn();
                    $('.success-message').html("Ekleme Başarılı.");
                    process_success.fadeOut(1000);

                    //Clear values after inserting to db successfully.
                    product_name.val("");

                    drawProductsList();
                }
            }
        });
    });
    function drawProductsList() {
        $.ajax({
            url: '/api/products',
            type: 'get',
            headers: {
                Authorization: 'Bearer ' + token
            },
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                var ul = $('#draw-products-list');

                if (data.length === 0){
                    var view = "<li style='width: calc(50% - 30px);display: inline-block;margin: 10px 5px;padding: 5px;border-bottom: 1px solid #ccc'>";
                    view += "Hiç bir ürün eklenmemiş.";
                    ul.append(view);
                }else{
                    ul.html("");
                    for (var i=0;i<data.length;i++){
                        var product = data[i];

                        var view = "<li style='width: calc(50% - 30px);display: inline-block;margin: 10px 5px;padding: 5px;border-bottom: 1px solid #ccc'>";
                        view += product.name + " - " + "<a href='/admin/products/edit/"+product.id+"'>Edit Product</a>";
                        ul.append(view);
                    }
                }
            }
        });
    }


});