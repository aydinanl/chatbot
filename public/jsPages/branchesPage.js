$(document).ready(function() {
    //Initialized
    drawModelBranches();
    var add_btn = $('#add-button');

    var process_error = $('.process-error');
    var process_success = $('.process-success');
    process_error.hide();
    process_success.hide();

    //Add Procuts
    add_btn.on('click',function (event) {
        var name = $('#add-branch-name');

        $.ajax({
            url: '/api/branches',
            type: 'post',
            data: {
                name: name.val()
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
                    name.val("");

                    drawModelBranches();
                }
            }
        });
    });

    function drawModelBranches() {
        $.ajax({
            url: '/api/branches',
            type: 'get',
            headers: {
                Authorization: 'Bearer ' + token
            },
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                var ul = $('#draw-list');

                if (data.length === 0){
                    var view = "<li style='width: calc(100% - 30px);display: inline-block;margin: 10px 5px;padding: 5px;border-bottom: 1px solid #ccc'>";
                    view += "There is no branch added.";
                    ul.append(view);
                }else{
                    ul.html("");
                    for (var i=0;i<data.length;i++){
                        var branch = data[i];

                        var view = "<li style='width: calc(33% - 30px);display: inline-block;margin: 10px 5px;padding: 5px;border-bottom: 1px solid #ccc'>";
                        view += branch.name + " - " + "<a href='/admin/products/edit/"+branch.id+"'>Edit</a>";
                        view +=  " - " + "<a href='/admin/products/delete/"+branch.id+"'>Delete</a>";
                        ul.append(view);
                    }
                }
            }
        });
    }

});