<script>

    $(document).on("change keyup", "#amount", function () {

        var fee = $("#Fee").val();
        var amount = $("#amount").val();
        var paid = $("#paid").val($("#amount").val());
        var dis = 0;

        if (paid != "" && amount != "")
        {
            paid = parseFloat($("#amount").val());
            var dis = (((parseFloat(fee) - parseFloat(paid)) * 100) / fee);
            $("#lack").val(parseFloat(amount) - parseFloat(paid));
        }

        if (paid == "" && amount == "")
        {
            $("#paid").val();
            $("#discount").val();
        }

        if (parseFloat(amount) > parseFloat(fee))
        {
            $("#discount").css("color", "red");
        } else {
            $("#discount").css("color", "black");
        }

        $("#discount").val(dis);

    });

    $(document).on("change keyup", "#discount", function () {

        var fee = parseFloat($("#Fee").val());
        var dis = 0;
        dis = ((fee * parseFloat($(this).val()))) / 100;
        var amount = fee - dis;

        $("#paid").val(parseInt(amount));
        $("#amount").val(parseInt(amount));
    });

    $(document).on("change keyup", "#paid", function () {

        b = $("#amount").val();
        var pay = $("#paid").val();

        if(pay == "") { $("#lack").val(0); }

        if(pay != "") {

            paid = parseFloat($("#paid").val());
        }

        if (pay != "" && b != "")
        {
            var lack = parseFloat(b) - parseFloat(paid);
            $("#lack").val(parseInt(lack));
        }

        if($("#lack").val() < 0)
        {
            $("#lack").css("color", "red");
        } else {
            $("#lack").css("color", "black");
        }
    });

    $(document).on("change keyup", "#pay", function () {

        b = $("#b").val(); var pay = $("#pay").val();

        if (pay == "")
        {
            $("#lack").val();
        }

        if (pay != "")
        {
            pay = parseFloat($("#pay").val());
        }

        if (pay != "" && b != "")
        {
            var lack = parseFloat(b) - parseFloat(paid);
            $("#lack").val(parseInt(lack));
        }

        if($("#lack").val(0) < 0)
        {
            $("#lack").css("color", "red");
        } else {
            $("#lack").css("color", "black");
        }

    });

</script>