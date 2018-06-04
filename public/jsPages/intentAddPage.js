$(document).ready(function() {

    //Initialized
    var add_btn = $('#product-add-button');
    var has_variable_check = $('#has-variable-check');
    var has_variable_form = $('#has-variable-form');
    var model_modal = $('#addModelModal');

    var process_error = $('.process-error');
    var process_success = $('.process-success');
    process_error.hide();
    process_success.hide();
    //has_variable_form.hide();

    has_variable_check.on("click",function (event) {
        console.log();
        has_variable_form.toggle();
    });

    var membership_option_content =
        "<div class='row m-t-15'>" +
        "<div class='col-sm-12 col-md-12 col-lg-12'>" +
        "<div class='col-sm-12 col-md-12 col-lg-12'>" +
        "<input type='text' class='form-control' id='add-product-name' placeholder='Ask question to user?'>" +
        "</div>";
        "</div>";

    $('#question-add-button').on('click',function () {
        has_variable_form.append(membership_option_content);
    });


    //Add Procuts
    add_btn.on('click',function (event) {
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

});