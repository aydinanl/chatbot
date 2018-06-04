$(document).ready(function() {

    //Initialized
    //drawSubCategories();

    var cat_add_btn = $('#cat-add-button');
    var sub_cat_add_btn = $('#sub-cat-add-button');
    var sub_cat_modal = $('#addSubCategoryModal');
    var process_error = $('.process-error');
    var process_success = $('.process-success');
    process_error.hide();
    process_success.hide();

    //Add Category
    cat_add_btn.on('click',function (event) {
        var cat_name = $('#category_name').val();

        $.ajax({
            url: '/api/exam/categories',
            type: 'post',
            data: {
                cat_name: cat_name
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
                }
            }
        });
    });

    sub_cat_modal.on("click",function (event) {
        drawSubCategories();
    });

    //Add Sub Category
    sub_cat_add_btn.on('click',function (event) {
        console.log("Tıklandı.");
        var sub_cat_name = $('#sub_category_name').val();
        var exam_cat_selection = $('#exam_cat_selection').val();

        console.log(exam_cat_selection);
        $.ajax({
            url: '/api/exam/categories/sub',
            type: 'post',
            data: {
                sub_cat_name: sub_cat_name,
                cat_id: exam_cat_selection
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
                    console.log("burda");
                    location.reload();


                }
            }
        });
    });

    function drawSubCategories() {
        $.ajax({
            url: '/api/exam/categories/all',
            type: 'get',
            headers: {
                Authorization: 'Bearer ' + token
            },
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                var view = "<select id='exam_cat_selection' name='cat_id' class='form-control m-b-10' data-style='form-control'>";
                for(var i = 0; i<data.length; i++){
                    view += "<option value=" + data[i].id + ">"+ data[i].cat_name +"</option>";
                }
                view += '</select>';
                $('#draw-sub-categories').html(view);
            }
        });
    }
});