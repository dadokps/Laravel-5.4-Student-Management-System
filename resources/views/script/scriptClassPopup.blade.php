<script>

    function showClassInfo()
    {
        var data = $('#form_view_class').serialize();

        $.get("{{ route('showClassInfo') }}", data, function (data) {
            $('#add_class_info').empty().append(data);
            $('td#hidden').addClass('hidden');
            $('th#hidden').addClass('hidden');
            mergeCommonRows($("#table_class_info"));
        });
    }

    $('#academic_id, #level_id, #shift_id, #time_id, #batch_id, #group_id').on('change', function () {
        showClassInfo();
    });

    //Merge Common Rows Function
    function mergeCommonRows(table) {

        var firstColumnBrakes = [];

        $.each(table.find('th'), function (i) {

            var previous = null, cellToExtend = null, rowspan = 1;

            table.find("td:nth-child(" + i +")").each(function (index, e) {

                var jthis = $(this), content = jthis.text();
                if(previous === content && content !== "" && $.inArray(index, firstColumnBrakes) === -1) {
                    jthis.addClass('hidden');
                    cellToExtend.attr("rowspan", (rowspan = rowspan + 1));
                } else {
                    if(i === 1) firstColumnBrakes.push(index);
                    rowspan = 1;
                    previous = content;
                    cellToExtend = jthis;
                }
            });
        });
        $('td.hidden').remove();
    }

    $('#form_view_class #program_id').on('change', function (e) {

        var program_id = $(this).val();
        var level = $('#level_id');
        $(level).empty();

        $.get("{{ route('showLevel') }}", {program_id:program_id}, function (data) {
            $.each(data, function (i, lvl) {
                $(level).append($("<option>", {
                    value : lvl.level_id,
                    text  : lvl.level
                }));
            });
            showClassInfo();
        });
    });

    $('#show_class_info').on('click', function (e) {

        e.preventDefault();
        showClassInfo();
    });

</script>