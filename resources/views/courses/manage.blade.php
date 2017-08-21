@extends('layouts.master')

@section('content')
@include('courses.popup.academic')
@include('courses.popup.program')
@include('courses.popup.level')
@include('courses.popup.shift')
@include('courses.popup.time')
@include('courses.popup.batch')
@include('courses.popup.group')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"> Courses</i></h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                <li><i class="icon_document_alt"></i>Course</li>
                <li><i class="fa fa-file-text-o"></i>Manage Course</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel panel-default">
                <header class="panel-heading">
                    Manage Course
                </header>
                <form action="{{ route('postCreateClass') }}" method="POST" class="form-horizontal" id="form_create_class">
                    <input type="hidden" name="active" id="active" value="1">
                    <input type="hidden" name="class_id" id="class_id">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label for="academic-year">Academic Year</label>
                                <div class="input-group">
                                    <select class="form-control" name="academic_id" id="academic_id">
                                        <option value="">Select</option>
                                        @foreach($academics as $key => $academic)
                                            <option value="{{ $academic->academic_id }}">{{ $academic->academic }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-addon">
                                        <span data-toggle="modal" data-target="#academic-year-show" class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="program">Course</label>
                                <div class="input-group">
                                    <select class="form-control" name="program_id" id="program_id">
                                        <option class="text-center" value="">Select</option>
                                        @foreach($programs as $key => $program)
                                            <option value="{{ $program->program_id }}">{{ $program->program }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-addon">
                                        <span data-toggle="modal" data-target="#program-show" class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="level">Level</label>
                                <div class="input-group">
                                    <select class="form-control" name="level_id" id="level_id"></select>
                                    <div class="input-group-addon">
                                        <span id="add_more_level" class="fa fa-plus" data-toggle="modal" data-target="#level-show"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="shift">Shift</label>
                                <div class="input-group">
                                    <select class="form-control" name="shift_id" id="shift_id">
                                        <option class="text-center" value="">Select</option>
                                        @foreach($shifts as $key => $shift)
                                            <option value="{{ $shift->shift_id }}">{{ $shift->shift }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-addon">
                                        <span data-toggle="modal" data-target="#shift-show" class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="time">Time</label>
                                <div class="input-group">
                                    <select class="form-control" name="time_id" id="time_id">
                                        <option class="text-center" value="">Select</option>
                                        @foreach($times as $key => $time)
                                            <option value="{{ $time->time_id }}">{{ $time->time }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-addon">
                                        <span data-toggle="modal" data-target="#time-show" class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="batch">Batch</label>
                                <div class="input-group">
                                    <select class="form-control" name="batch_id" id="batch_id">
                                        <option class="text-center" value="">Select</option>
                                        @foreach($batches as $key => $batch)
                                            <option value="{{ $batch->batch_id }}">{{ $batch->batch }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-addon">
                                        <span data-toggle="modal" data-target="#batch-show" class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="group">Group</label>
                                <div class="input-group">
                                    <select class="form-control" name="group_id" id="group_id">
                                        <option class="text-center" value="">Select</option>
                                        @foreach($groups as $key => $group)
                                            <option value="{{ $group->group_id }}">{{ $group->group }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-addon">
                                        <span class="fa fa-plus" data-toggle="modal" data-target="#group-show"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="start_date">Start Date</label>
                                <div class="input-group">
                                    <input required type="text" name="start_date" id="start_date" class="form-control" />
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="end_date">End Date</label>
                                <div class="input-group">
                                    <input required type="text" name="end_date" id="end_date" class="form-control" />
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-default btn-sm">Create Course</button>
                        <button type="submit" class="btn btn-success btn-sm btn-update-class">Update Course</button>
                    </div>
                </form>

                <!-- Class Information -->

                <div class="panel panel-default">
                    <div class="panel-heading">Class Information</div>
                    <div class="panel-body" id="add_class_info"></div>
                </div>

            </section>
        </div>
    </div>

@endsection

@section('script')
    <script>

        $('#start_date, #end_date').datepicker({
            changeYear:true,
            changeMonth:true,
            dateFormat: 'yy-mm-dd'
        });

        $('#form_academic_year_create').on('submit', function (e) {

            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.post(url, data, function (data) {
                $('#academic_id').append($("<option>",{
                    value : data.academic_id,
                    text  : data.academic
                }));

                $('#new_academic_year').val("");
            });
        });

        $('#form_program_create').on('submit', function (e) {

            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.post(url, data, function (data) {

                $('#form_create_class #program_id, #form_level_create #program_id').append($("<option>",{
                    value : data.program_id,
                    text  : data.program
                }));
                $('#program').val("");
                $('#program_description').val("");

            }) .fail(function(xhr, status, error) {

                var errors = JSON.parse(xhr.responseText);
                var programError = errors.program;
                var descriptionError = errors.description;

                if(errors) {
                    $('.errors').removeClass('hidden');
                    $('.errors').html(programError).append('<br />').append(descriptionError);
                }
            });
        });

        $('#form_level_create').on('submit', function (e) {

            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.post(url, data, function (data) {
                $('#level_id').append($("<option>", {
                    value : data.level_id,
                    text  : data.level
                }));
            });
            $('#level').val("");
            $('#level_description').val("");
        });

        $('#form_create_class #program_id').on('change', function (e) {

            var program_id = $(this).val();
            var level = $('#level_id');
            $(level).empty();

            $.get("{{ route('showLevel') }}", {program_id:program_id}, function (data) {
                $.each(data, function (i, l) {
                    $(level).append($("<option>", {
                        value : l.level_id,
                        text  : l.level
                    }));
                });
            });
        });

        $('#form_shift_create').on('submit', function (e) {

            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.post(url, data, function (data) {
                $('#shift_id').append($("<option>", {
                    value : data.shift_id,
                    text  : data.shift
                }));
            });
            $(this).trigger('reset');
        });

        $('#form_time_create').on('submit', function (e) {

            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.post(url, data, function (data) {
                $('#time_id').append($("<option>", {
                    value : data.time_id,
                    text  : data.time
                }));
            });
            $(this).trigger('reset');
        });

        $('#form_batch_create').on('submit', function (e) {

            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.post(url, data, function (data) {
                $('#batch_id').append($("<option>", {
                    value : data.batch_id,
                    text  : data.batch
                }));
            });
            $(this).trigger('reset');
        });

        $('#form_group_create').on('submit', function (e) {

            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.post(url, data, function (data) {
                $('#group_id').append($("<option>", {
                    value : data.group_id,
                    text  : data.group
                }));
            });
            $(this).trigger('reset');
        });

        $('#form_create_class').on('submit', function (e) {

            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.post(url, data, function (data) {

                showClassInfo(data.academic_id);
            });
            $(this).trigger('reset');
        });

        function showClassInfo(academic_id)
        {
            $.get("{{ route('showClassInfo') }}", {academic_id:academic_id}, function (data) {
                $('#add_class_info').empty().append(data);
                mergeCommonRows($("#table_class_info"));
            });
        }

        showClassInfo($('#academic_id').val());

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

        $(document).on('click', '.delete_class', function (e) {
            class_id = $(this).val();
            $.post('{{ route('deleteClass') }}', {class_id:class_id}, function (data) {
                //showClassInfo($('#academic_id').val());
            });
        });

        $(document).on('click', '#edit_class', function (data) {
            var class_id = $(this).data('id');
            $.get("{{ route('editClass') }}", {class_id:class_id}, function (data) {
                $('#academic_id').val(data.academic_id);
                $('#level_id').val(data.level_id);
                $('#shift_id').val(data.shift_id);
                $('#time_id').val(data.time_id);
                $('#group_id').val(data.group_id);
                $('#batch_id').val(data.batch_id);
                $('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
                $('#class_id').val(data.class_id);
            });
        });

        $('.btn-update-class').on('click', function (e) {

            e.preventDefault();
            var data = $('#form_create_class').serialize();
            $.post('{{ route('updateClassInfo') }}', data, function (data) {
                showClassInfo(data.academic_id);
            });

        });
    </script>
@endsection