$(document).ready(function() {

    //Initialized
    var add_btn = $('#intent-add-button');
    var has_variable_check = $('#has-variable-check');
    var has_operation_check = $('#has-operation-check');
    var has_forward_check = $('#has-forward-check');
    var has_variable_form = $('#has-variable-form');
    var has_operation_form = $('#has-operation-form');
    var has_forward_form = $('#has-forward-form');

    var process_error = $('.process-error');
    var process_success = $('.process-success');
    process_error.hide();
    process_success.hide();
    has_variable_form.hide();
    has_operation_form.hide();
    has_forward_form.hide();

    //Show has variable form inputs.
    has_variable_check.on("click",function (event) {
        has_variable_form.toggle();
    });

    //Show has operation form inputs.
    has_operation_check.on("click",function (event) {
        has_operation_form.toggle();
    });

    //Show has forward form inputs.
    has_forward_check.on("click",function (event) {
        has_forward_form.toggle();
    });

    var has_variable_question =
        "<div class='row m-t-15'>" +
            "<div class='col-sm-12 col-md-12 col-lg-12'>" +
                "<div class='col-sm-12 col-md-12 col-lg-12'>" +
                    "<input type='text' class='form-control' id='add-intent-variable-question' name='variable_questions[]' placeholder='Ask question to user?'" +
                "</div>" +
            "</div>" +
        "</div>";

    $('#question-add-button').on('click',function (event) {
        has_variable_form.append(has_variable_question);

        var num = +$('#add-intent-variable-question').attr("data-num");
        num = num + 1;
        $('#add-intent-variable-question').attr('data-num', num);
    });

    //Add Intent
    add_btn.on('click',function (event) {


        var name = $('#add-intent-name').val();
        var type = $('#select-intent-type').val();
        var define_words = $('#add-intent-define-words').val();
        var has_variable_check = $('#has-variable-check');
        var variable_questions = [];

        if(has_variable_check.is(':checked')){
             var has_variable = true;
             var variable_names_str = $('#add-intent-variable-names').val();
             var variable_names = variable_names_str.split(",");

             $('input[name^="variable_questions"]').each(function() {
                 variable_questions.push($(this).val());
             });
        }

        if(has_operation_check.is(':checked')){
            var has_operation = true;
            var operation_type = '';
            if ($('#add-intent-operation-type').val() == 1){
                operation_type = 'GET'
            }else{
                operation_type = 'POST'
            }
            var operation_url = $('#add-intent-operation-url').val();
        }
        if(has_forward_check.is(':checked')){
            var has_forward = true;
            var forwardID = $('#add-intent-forward-id').val();
        }

        var output = $('#add-intent-output').val();


        $.ajax({
            url: '/api/chatbot/intent',
            type: 'post',
            data: {
                name: name,
                type: type,
                define_words: define_words,

                has_variable: has_variable,
                variable_names: variable_names,
                variable_questions: variable_questions,

                has_operation: has_operation,
                operation_type: operation_type,
                operation_url: operation_url,

                forward: has_forward,
                forwardID: forwardID,

                output: output

            },
            headers: {
                Authorization: 'Bearer ' + token
            },
            dataType: 'json',
            success: function (data) {
                has_operation = false;
                has_variable = false;

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
                }
            }
        });

    });

});