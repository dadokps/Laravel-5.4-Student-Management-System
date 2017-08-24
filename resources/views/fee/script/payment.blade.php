<script>

    var disabled = $('#disabled').val();

    $('#formFee').on('submit', function (e) {

        e.preventDefault();
        enableFormElement(this);
        var data = $(this).serialize();
        var url = $(this).attr('action');

        $.post(url, data, function (data) {
            location.reload();
        });

    });

    // Endable form element function
    function enableFormElement(formName) {

        $.each($(formName).find('input, select'), function (i, element) {

            $(element).attr('disabled', false);
        });
    }

    $('.btn-paid').on('click', function (e){

        e.preventDefault();
        s_fee_id = $(this).data('paid_id');
        balance = $(this).val();

        $.get("{{ route('pay') }}", {s_fee_id:s_fee_id}, function (data) {

            $('#Paid').attr('id', 'Pay');
            $('#s_fee_id').val(data.s_fee_id);
            $('#program_id').val(data.program_id);
            $('#level_ID').val(data.level_id);
            $('#level_id').val(data.level_id);
            $('#Fee').val(data.school_fee);
            $('#fee_id').val(data.fee_id);
            $('#Amount').val(data.student_amount);
            $('#discount').val(data.discount);
            $('#Pay').val(balance).focus().select();
            $('#b').val(balance);

        });
    });

    function disabledInput()
    {
        $.each($('body').find('.dd'), function(t, item){
                $(item).attr('disabled', true).css({'background' : '#f5f5f5', 'border': '1px solid #ccc'});
                $(item).attr('readonly', false);
        });
    }

    $(document).ready(function(){

        if(disabled == 0)
        {
            disabledInput();
        }
    });


</script>