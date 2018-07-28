ClassicEditor
    .create( document.querySelector('#body'))
    .catch( error => {
        console.error( error );
    });

$(document).ready(function () {
    var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $('body').prepend(div_box);
    $('#load-screen').delay(700).fadeOut(600, function () {
        $(this).remove();
    });

    $('#selectAllBoxes').click(function () {
        if (this.checked) {
            $('.checkBoxes').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function () {
                this.checked = false;
            });
        }
    });
});

function loadUsersOnline() {
    $.get("../functions/general_functions.php?online_users=result", function (data) {
        $('.users_online').text(data);
    });
}

setInterval(function () {
    loadUsersOnline();
}, 500);