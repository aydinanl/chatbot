/*jslint browser: true*/
/*global $, jQuery, alert*/

$(document).ready(function () {
    var spinner = new Spinner("body");

    "use strict";
    $(function () {
        $(window).on("load", function () { // On load
            $('.chat-list').css({
                'height': (($(window).height()) - 470) + 'px'
            });
        });
        $(window).on("resize", function () { // On resize
            $('.chat-list').css({
                'height': (($(window).height()) - 470) + 'px'
            });
        });



    });

    var chatList = $('.chat-list');

    $("#send-button").on("click", function () {

        var message = $("#message").val();
        var view =
        '<li  class="odd">' +
            '<div class="chat-image"> <img alt="male" src="/plugins/images/users/ritesh.jpg"> </div>' +
                '<div class="chat-body">' +
                '<div class="chat-text">' +
                    '<h4>Chatbot</h4>' +
                    '<p>' + message + '</div>' +
            '</div>' +
        '</li>';
        chatList.append(view);

        $("#message").val("");

        spinner.fadeIn('Lütfen bekleyiniz.');
        $.post("/api/chatbot", { message: message})
            .done(function( data ) {
                var response =
                '<li>' +
                    '<div class="chat-image"> <img alt="male" src="/plugins/images/users/ritesh.jpg"> </div>' +
                    '<div class="chat-body">' +
                    '<div class="chat-text">' +
                    '<h4>Chatbot</h4>' +
                    '<p>' + data + '</div>' +
                    '</div>' +
                '</li>';
                spinner.fadeOut();
                chatList.append(response);
            });


/*
        $.ajax({
            contentType: "application/json; charset=utf-8",
            method: 'POST',
            url: "http://localhost:8020/api/chatbot",
            dataType: "json",
            data: {'message' : message}
        }).success(function (data) {
            console.log(data);
        }).fail(function (error) {

            reject(error);
        });
*/
    });
});
