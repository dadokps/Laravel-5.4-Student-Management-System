@extends('layouts.master')

@section('content')

    <style>
        caption {
            height:50px;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> Student List</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="#">Home</a></li>
                <li><i class="icon_document_alt"></i>Reports /</li>
                <li><i class="fa fa-file-text-o"></i>Student List</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <b><i class="fa fa-apple"></i> Student Information</b>
            <a id="show_class_info" data-toggle="modal" data-target="#choose_academic" href="#" class="pull-right"><i class="fa fa-plus"></i></a>
        </div>
        <div class="panel-body" style="padding-bottom: 4px;">
            <div class="show-student-info">

            </div>
        </div>
    </div>

    @include('class.classPopup')

@endsection

@section('script')
    @include('script.scriptClassPopup')
    <script>

        $(document).on('click', '#edit_class', function (e) {

            e.preventDefault();
            class_id = $(this).data('id');

            $.get("{{ route('showStudentInfo') }}", {class_id:class_id}, function (data) {

                $('.show-student-info').empty().append(data);
            });

        });


    </script>
@endsection