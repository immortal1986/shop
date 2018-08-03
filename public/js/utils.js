var Profile = {
    check: function (id) {
        if ($.trim($("#" + id)[0].value) == '') {
            $("#" + id)[0].focus();
            $("#" + id + "_alert").show();

            return false;
        }
        ;

        return true;
    },
    validate: function () {
        if (SignUp.check("name") == false) {
            return false;
        }
        if (SignUp.check("email") == false) {
            return false;
        }
        $("#profileForm")[0].submit();
    }
};

var SignUp = {
    check: function (id) {
        if ($.trim($("#" + id)[0].value) == '') {
            $("#" + id)[0].focus();
            $("#" + id + "_alert").show();

            return false;
        }
        ;

        return true;
    },
    validate: function () {
        if (SignUp.check("name") == false) {
            return false;
        }
        if (SignUp.check("username") == false) {
            return false;
        }
        if (SignUp.check("email") == false) {
            return false;
        }
        if (SignUp.check("password") == false) {
            return false;
        }
        if ($("#password")[0].value != $("#repeatPassword")[0].value) {
            $("#repeatPassword")[0].focus();
            $("#repeatPassword_alert").show();

            return false;
        }
        $("#registerForm")[0].submit();
    }
}

$(document).ready(function () {
    $("#registerForm .alert").hide();
    $("div.profile .alert").hide();

    $('input[name="daterange"]').daterangepicker({
        opens: 'left'
    }, function (start, end, label) {
        var sd = start.format('YYYY-MM-DD');
        var ed = end.format('YYYY-MM-DD');
        $(".daterange").click(function (e) {
            //   e.defaultPrevented;
            var sale_price = $('input[name="sale_price"]')[0].value;
            var p_id = $('input[name="p_id"]')[0].value;
            window.console.log(sale_price);
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "salesadd/",
                data: {
                    p_id: p_id,
                    sp: sale_price,
                    sd: sd,
                    ed: ed
                },
                success: function () {
                    window.location.href = location.href;
                }
            });
        });
    });


    /*$(".daterange").click(function (e) {
        //   e.defaultPrevented;
        var sale_price = $('input[name="sale_price"]')[0].value;
        var p_id = $('input[name="p_id"]')[0].value;
        window.console.log(sale_price);
        $.ajax({
            type: "POST",
            dataType: 'json',
             url: "<?php echo $this->url->get("xml/posalji") ?>",
            data: {
                p_id: p_id,
                sp: sale_price,
                sd: sd,
                ed: ed
            },
            success: function () {
                window.location.href = location.href;
            }
        });
    });*/
});
