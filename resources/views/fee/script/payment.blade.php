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

            $(element).attr('disabled', false).css({ 'background':'#fff', 'border':'1px solid #ccc' });
        });
    }

    $('.btn-paid').on('click', function (e){

        e.preventDefault();
        s_fee_id = $(this).data('paid_id');
        balance = $(this).val();

        $.get("{{ route('pay') }}", {s_fee_id:s_fee_id}, function (data) {

            $('#Paid').attr('id', 'Pay');
            $('#s_fee_id').val(data.s_fee_id);
            $('#LevelId').val(data.level_id);
            $('#Fee').val(data.school_fee);
            $('#FeeId').val(data.fee_id);
            $('#Amount').val(data.student_amount);
            $('#discount').val(data.discount);
            $('#Pay').val(balance).focus().select();
            $('#b').val(balance);
            addItem(data);
            showStudentLevel(data);

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

    $('.btn-reset').on('click', function (e) {

        e.preventDefault();
        var caption = $(this).val();

        if(caption == 'Reset')
        {
            $(this).val('Cancel');
            $('#btn-go').val('Save');
            $('#Pay').attr('id', 'Paid');
            $('#form_payment').attr('action', "{{ route('savePayment') }}");
            enableFormElement('#form_payment');
            return;
        }
        location.reload();
    });

    function addItem(data)
    {
        $('#program_id').empty().append($('<option>', {
           value: data.program_id,
           text : data.program
        }));

        $('#level_ID').empty().append($('<option>', {
            value: data.level_id,
            text : data.level
        }));
    }

    function  showStudentLevel(data)
    {
       $.get("{{ route('showStudentLevel') }}", {level_id:data.level_id, student_id:data.student_id}, function (data) {

           $('.academicDetail').text(data.detail);
       });
    }


</script>