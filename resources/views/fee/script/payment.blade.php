<script>

    $('#formFee').on('submit', function (e) {

        e.preventDefault();
        enableFormElement(this);
        var data = $(this).serialize();
        var url = $(this).attr('action');

        $.post(url, data, function (data) {
            location.reload();
        });

    });

    function enableFormElement(formName) {

        $.each($(formName).find('input, select'), function (i, element) {

            $(element).attr('disabled', false);
        });
    }

</script>