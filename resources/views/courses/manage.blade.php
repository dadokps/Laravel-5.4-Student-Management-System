@extends('layouts.master')

@section('content')
@include('courses.popup.academic')
@include('courses.popup.program')
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
                <form class="form-horizontal">
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
                                    <select class="form-control" name="level_id" id="level_id">

                                    </select>
                                    <div class="input-group-addon">
                                        <span class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="shift">Shift</label>
                                <div class="input-group">
                                    <select class="form-control" name="shift_id" id="shift_id">

                                    </select>
                                    <div class="input-group-addon">
                                        <span class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="time">Time</label>
                                <div class="input-group">
                                    <select class="form-control" name="time_id" id="time_id">

                                    </select>
                                    <div class="input-group-addon">
                                        <span class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="batch">Batch</label>
                                <div class="input-group">
                                    <select class="form-control" name="batch_id" id="batch_id">

                                    </select>
                                    <div class="input-group-addon">
                                        <span class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="group">Group</label>
                                <div class="input-group">
                                    <select class="form-control" name="group_id" id="group_id">

                                    </select>
                                    <div class="input-group-addon">
                                        <span class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="start_date">Start Date</label>
                                <div class="input-group">
                                    <input type="text" name="start_date" id="start_date" class="form-control" />
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="end_date">End Date</label>
                                <div class="input-group">
                                    <input type="text" name="end_date" id="end_date" class="form-control" />
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-default btn-sm">Create Course</button>
                    </div>
                </form>
            </section>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('#start_date, #end_date').datepicker({
            changeYear:true,
            changeMonth:true
        });

        $('.btn-save-academic').on('click', function () {
            var academic = $('#new-academic').val();
            $.post("{{route('postInsertAcademic')}}", { academic:academic }, function(data){
                $('#academic_id').append($("<option>",{
                    value : data.academic_id,
                    text  : data.academic
                }));
                $('#new-academic').val("");
            });
        });

        $('.btn-save-program').on('click', function () {
            var program = $('#program').val();
            var description = $('#description').val();
            $.post("{{route('postInsertProgram')}}", { program:program, description:description }, function(data){
                $('#program_id').append($("<option>",{
                    value : data.program_id,
                    text  : data.program
                }));
                $('#program').val("");
                $('#description').val("");
            });
        });
    </script>
@endsection