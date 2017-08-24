<script>

    $(document).on("change keyup", "#Amount", function () {

        var fee = $("#Fee").val();
        var Amount = $("#Amount").val();
        var paid = $("#paid").val($("#Amount").val());
        var dis = 0;

        if (paid != "" && Amount != "")
        {
            paid = parseFloat($("#Amount").val());
            var dis = (((parseFloat(fee) - parseFloat(paid)) * 100) / fee);
            $("#lack").val(parseFloat(Amount) - parseFloat(paid));
        }

        if (paid == "" && Amount == "")
        {
            $("#paid").val();
            $("#discount").val();
        }

        if (parseFloat(Amount) > parseFloat(fee))
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
        var Amount = fee - dis;

        $("#paid").val(parseInt(Amount));
        $("#Amount").val(parseInt(Amount));
    });

    $(document).on("change keyup", "#paid", function () {

        b = $("#Amount").val();
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

    $(document).on("change keyup", "#Pay", function () {

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