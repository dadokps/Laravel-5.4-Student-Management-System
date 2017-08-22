@extends('layouts.master')

@section('content')
    @include('fee.stylesheet.cssPayment')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-3">
                <form action="{{ route('showStudentPayment') }}" class="search-payment" method="GET">
                    <input class="form-control" name="student_id" placeholder="Student ID" value="{{ $student_id }}"/>
                </form>
            </div>
            <div class="col-md-3">
                <label class="eng-name">Name: <b class="student-name"></b></label>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3" style="text-align: right">
                <label class="date-invoice">Date: <b>{{ date('d-M-Y') }}</b></label>
            </div>
            <div class="col-md-3" style="text-align: right">
                <label class="invoice-number">Receipt Number<sup>0</sup>: <b></b></label>
            </div>
        </div>
        <div class="panel-body">
            <table style="margin-top: -12px">
                <caption class="academicDetail">
                    {{ $status->program }} /
                    Level: {{ $status->level }} /
                    Shift: {{ $status->shift }} /
                    Time: {{ $status->time }} /
                    Batch: {{ $status->batch }} /
                    Group: {{ $status->group }}
                </caption>
                <thead>
                <tr>
                    <th>Program</th>
                    <th>Level</th>
                    <th>School Fee($)</th>
                    <th>Amount($)</th>
                    <th>Dis(%)</th>
                    <th>Paid($)</th>
                    <th>Amount Lack($)</th>
                </tr>
                </thead>
                <tr>
                    <td>
                        <select id="program_id" name="program_id">
                            <option value="">-------</option>
                            @foreach($programs as $key => $program)
                                <option value="{{ $program->program_id }}" {{ $program->program_id == $status->program_id ? 'selected' : null }}>{{ $program->program }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select id="level_id" name="level_id">
                            <option value="">-------</option>
                            @foreach($levels as $key => $level)
                                <option value="{{ $level->level_id }}" {{ $level->level_id == $status->level_id ? 'selected' : null }}>{{ $level->level }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="fee" id="Fee" readonly />
                        <input type="hidden" name="fee_id" id="fee_id" />
                        <input type="hidden" name="student_id" id="student_id" />
                        <input type="hidden" name="level_id" id="level_id" />
                        <input type="hidden" name="user_id" id="user_id" />
                        <input type="hidden" name="transacdate" id="transacdate" />
                    </td>
                    <td>
                        <input type="text" name="amount" id="amount" required />
                    </td>
                    <td>
                        <input type="text" name="discount" id="discount" />
                    </td>
                    <td>
                        <input type="text" name="paid" id="paid" />
                    </td>
                    <td>
                        <input type="text" name="balance" id="balance" />
                    </td>
                </tr>
                <thead>
                <tr>
                    <th colspan="2">Remark</th>
                    <th colspan="2">Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="2">
                        <input type="text" name="description" id="description" />
                    </td>
                    <td colspan="5">
                        <input type="text" name="remark" id="remark" />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="panel-footer" style="height: 40px;"></div>
    </div>

@endsection