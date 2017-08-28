@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> Fee Report</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="#">Home</a></li>
                <li><i class="icon_document_alt"></i>Fees</li>
                <li><i class="fa fa-file-text-o"></i>Fee Report</li>
            </ol>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">

            <table>
                <tr>
                    <td>
                        <b><i class="fa fa-apple"></i> Fee Information</b>
                    </td>
                    <td>
                        <input type="text" name="from" id="from" class="form-control"
                               placeholder="yyyy-mm-dd" value="{{ date('Y-m-d') }}" required/>
                    </td>
                    <td>
                        <input type="text" name="to" id="to" class="form-control"
                               placeholder="yyyy-mm-dd" value="{{ date('Y-m-d') }}" required/>
                    </td>
                </tr>
            </table>
            <br>
         </div>
        <div class="panel-body" style="padding-bottom: 4px;">
            <p style="text-align: center;font-size: 20px;font-weight: bold;">Fee Report</p>
            <div class="show-student-paid">

            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>

        $('#from').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            onSelect: function (from) {

                showFee(from, $('#to').val());
            }
        });

        $('#to').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            onSelect: function (to) {

                showFee($('#from').val(), to);
            }
        });

        function showFee(from, to)
        {
            $.get("{{ route('showFeeReport') }}", {from:from, to:to}, function (data) {

                $('.show-student-paid').empty().append(data);
            });
        }

    </script>
@endsection