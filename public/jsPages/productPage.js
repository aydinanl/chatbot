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

    model_modal.on("click",function (event) {
        drawModelCategories();
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
                    var view = "<li style='width: calc(100% - 30px);display: inline-block;margin: 10px 5px;padding: 5px;border-bottom: 1px solid #ccc'>";
                    view += "Hiç bir ürün eklenmemiş.";
                    ul.append(view);
                }else{
                    ul.html("");
                    for (var i=0;i<data.length;i++){
                        var product = data[i];

                        var view = "<li style='width: calc(33% - 30px);display: inline-block;margin: 10px 5px;padding: 5px;border-bottom: 1px solid #ccc'>";
                        view += product.name + " - " + "<a href='/admin/products/edit/"+product.id+"'>Edit Product</a>";
                        ul.append(view);
                    }
                }
            }
        });
    }

    //Add Model To Product
    model_add_btn.on('click',function (event) {
        console.log("Tıklandı.");
        var model_name = $('#product_model_name').val();
        var product_id = $('#product_id').val();

        console.log(product_id);
        $.ajax({
            url: '/api/products/models',
            type: 'post',
            data: {
                model_name: model_name,
                product_id: product_id
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
                    console.log(data);
                    location.reload();
                }
            }
        });
    });

    function drawModelCategories() {
        $.ajax({
            url: '/api/products',
            type: 'get',
            headers: {
                Authorization: 'Bearer ' + token
            },
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                var view = "<select id='product_id' name='product_id' class='form-control m-b-10' data-style='form-control'>";
                for(var i = 0; i<data.length; i++){
                    view += "<option value=" + data[i].id + ">"+ data[i].name +"</option>";
                }
                view += '</select>';
                $('#draw-sub-categories').html(view);
            }
        });
    }
});