var $messages = $('.messages-content'),
    d, h, m,
    i = 0;

$(window).load(function () {
    $messages.mCustomScrollbar();

    giveAnswer();
});

function updateScrollbar() {
    $messages.mCustomScrollbar("update").mCustomScrollbar('scrollTo', 'bottom', {
        scrollInertia: 10,
        timeout: 0
    });
}

function setDate() {
    d = new Date();
    if (m != d.getMinutes()) {
        m = d.getMinutes();
        $('<div class="timestamp">' + d.getHours() + ':' + m + '</div>').appendTo($('.message:last'));
    }
}

function insertMessage() {
    msg = $('.message-input').val();
    if ($.trim(msg) == '') {
        return false;
    }
    $('<div class="message message-personal">' + msg + '</div>').appendTo($('.mCSB_container')).addClass('new');
    setDate();
    updateScrollbar();


    setTimeout(function () {
        giveAnswer();
    }, 100);
}

$('.message-submit').click(function () {
    insertMessage();
});

$(window).on('keydown', function (e) {
    if (e.which == 13) {
        insertMessage();
        return false;
    }
});

var insert = false;
var intent = [];
function giveAnswer() {
    var message = $('.message-input').val();
    console.log(message);
    $('<div class="message loading new">' +
        '<figure class="avatar">' +
        '<img src="/img/avatar.jpg" />' +
        '</figure><span></span></div>').appendTo($('.mCSB_container'));
    updateScrollbar();
    $('.message-input').val(null);

    if(insert === true){
        console.log(intent);
        $.post("/api/chatbot/intent/" + intent.intent_id + "/"+ intent.value_order + "/insert-value", {message: message})
            .done(function (data) {
                console.log("Diğer soru.");
                console.log(data);
                intent.value_order++;

                $('<div class="message new"><figure class="avatar"><img src="/img/avatar.jpg" /></figure>' + data.answer + '</div>').appendTo($('.mCSB_container')).addClass('new');
                setDate();
                updateScrollbar();
                $('.message.loading').remove();

                if(intent.value_order == (intent.question_count)){
                    insert = false;
                    intent = [];
                    setDate();
                    updateScrollbar();
                    $('.message.loading').remove();
                }

            });
    }else {
        $.post("/api/chatbot", {message: message})
            .done(function (data) {
                if(data.has_value === true){
                    console.log("Soru başlangıcı.");
                    console.log(data);
                    insert = true;
                    intent = data;
                    $('<div class="message new"><figure class="avatar"><img src="/img/avatar.jpg" /></figure>' + data.answer + '</div>').appendTo($('.mCSB_container')).addClass('new');
                    setDate();
                    updateScrollbar();
                    $('.message.loading').remove();

                }else{
                    $('<div class="message new"><figure class="avatar"><img src="/img/avatar.jpg" /></figure>' + data + '</div>').appendTo($('.mCSB_container')).addClass('new');
                    setDate();
                    updateScrollbar();
                    $('.message.loading').remove();
                }

            });
    }
}