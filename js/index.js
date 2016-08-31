// nav 메뉴에 active 클래스 넣는 소스
var path = location.pathname.slice(1);

if (path != "") {
    $("#" + path).addClass("active");
} else {
    $("#home").addClass("active");
}

$("#join-id").keyup(function () {
    if ($("#join-id").val() == "") {
        $('#span-id').removeClass('glyphicon');
        $('#span-id').removeClass('glyphicon-remove');
        $('#div-id').removeClass('has-error');
        $('#span-id').removeClass('glyphicon-ok');
        $('#div-id').removeClass('has-success');
    } else {
        $.ajax({
            type: 'post',
            url: 'config/validate.php',
            data: 'id=' + $("#join-id").val(),
            success: function (data) {
                if (data == 1) {
                    $('#span-id').removeClass('glyphicon');
                    $('#span-id').removeClass('glyphicon-remove');
                    $('#div-id').removeClass('has-error');

                    $('#span-id').addClass('glyphicon');
                    $('#span-id').addClass('glyphicon-ok');
                    $('#div-id').addClass('has-success');
                } else {
                    $("input[name=sel]").attr("disabled", true);
                    $('#span-id').removeClass('glyphicon');
                    $('#span-id').removeClass('glyphicon-ok');
                    $('#div-id').removeClass('has-success');

                    $('#span-id').addClass('glyphicon');
                    $('#span-id').addClass('glyphicon-remove');
                    $('#div-id').addClass('has-error');
                }
            }
        });
    }
});

$("#join-password").keyup(function () {
    if ($("#join-password").val() == "") {
        $('#span-password').removeClass('glyphicon');
        $('#span-password').removeClass('glyphicon-remove');
        $('#div-password').removeClass('has-error');
        $('#span-password').removeClass('glyphicon-ok');
        $('#div-password').removeClass('has-success');
    } else {
        if ($('#join-password').val().length >= 6) {
            $('#span-password').removeClass('glyphicon');
            $('#span-password').removeClass('glyphicon-remove');
            $('#div-password').removeClass('has-error');

            $('#span-password').addClass('glyphicon');
            $('#span-password').addClass('glyphicon-ok');
            $('#div-password').addClass('has-success');
        } else {
            $('#span-password').removeClass('glyphicon');
            $('#span-password').removeClass('glyphicon-ok');
            $('#div-password').removeClass('has-success');

            $('#span-password').addClass('glyphicon');
            $('#span-password').addClass('glyphicon-remove');
            $('#div-password').addClass('has-error');
        }
    }
});

$("#join-username").keyup(function () {
    if ($("#join-username").val() == "") {
        $('#span-username').removeClass('glyphicon');
        $('#span-username').removeClass('glyphicon-ok');
        $('#div-username').removeClass('has-success');

        $('#span-username').addClass('glyphicon');
        $('#span-username').addClass('glyphicon-remove');
        $('#div-username').addClass('has-error');
    } else {
        $('#span-username').removeClass('glyphicon');
        $('#span-username').removeClass('glyphicon-remove');
        $('#div-username').removeClass('has-error');

        $('#span-username').addClass('glyphicon');
        $('#span-username').addClass('glyphicon-ok');
        $('#div-username').addClass('has-success');
    }
});

$("#join-form").submit(function (event) {
    if (check_id && check_username && check_password) {
        event.preventDefault();
    } else {
        alert('정보를 확인해주세요.');
        return;
    }
});

$('#keyword').keyup(function () {
    $.ajax({
        type: 'post',
        url: 'config/list.php',
        data: 'type=' + $('#type').val() + '&keyword=' + $('#keyword').val(),
        success: function (data) {
            $('#list').html(data);
        }
    });
});

$('#type').change(function () {
    $.ajax({
        type: 'post',
        url: 'config/list.php',
        data: 'type=' + $('#type').val() + '&keyword=' + $('#keyword').val(),
        success: function (data) {
            $('#list').html(data);
        }
    });
});

function delete_content(no) {
    $.ajax({
        type: 'post',
        url: 'config/delete.php',
        data: 'no=' + no,
        success: function (data) {
            alert('글을 성공적으로 삭제했습니다.');
        }
    });
}
