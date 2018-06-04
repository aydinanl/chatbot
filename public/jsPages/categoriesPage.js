$(document).ready(function() {

    //Initialized
    drawProductsList();
    var category_add_btn = $('#add-categories-button');
    var category_update_btn = $('#update-categories-button');

    var process_error = $('.process-error');
    var process_success = $('.process-success');
    process_error.hide();
    process_success.hide();

    //Add Product
    category_add_btn.on('click',function (event) {
        var product_name = $('#add-categories-name');
        var product_keywords = $('#add-categories-keywords');

        $.ajax({
            url: '/api/categories',
            type: 'post',
            data: {
                name: product_name.val(),
                keywords: product_keywords.val()
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
                    product_keywords.val("");
                    drawProductsList();
                }
            }
        });
    });

    //Update Product
    category_update_btn.on('click',function (event) {
        var product_name = $('#add-categories-name');
        var product_keywords = $('#add-categories-keywords');

        $.ajax({
            url: '/api/categories/edit/' + id,
            type: 'put',
            data: {
                name: product_name.val(),
                keywords: product_keywords.val(),
                id : id
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
                    $('.success-message').html("Updated.");
                    process_success.fadeOut(1000);
                }
            }
        });
    });

    function drawProductsList() {
        $.ajax({
            url: '/api/categories',
            type: 'get',
            headers: {
                Authorization: 'Bearer ' + token
            },
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                var ul = $('#draw-category-list');

                if (data.length === 0){
                    var view = "<li style='width: calc(100% - 30px);display: inline-block;margin: 10px 5px;padding: 5px;border-bottom: 1px solid #ccc'>";
                    view += "Hiç bir kategori eklenmemiş.";
                    ul.append(view);
                }else {
                    ul.html("");
                    for (var i = 0; i < data.length; i++) {
                        var category = data[i];
                        var view = "<li style='width: calc(33% - 30px);display: inline-block;margin: 10px 5px;padding: 5px;border-bottom: 1px solid #ccc'>";
                        view += category.name + " - " + "<a href='/admin/categories/edit/" + category.id + "'>Edit Category</a>";
                        ul.append(view);
                    }
                }
            }
        });
    }
});