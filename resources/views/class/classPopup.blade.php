<div class="modal fade" id="choose_academic" role="dialog">
    <div class="modal-dialog modal-xs">
        <section class="panel panel-default">
            <header class="panel-heading">
                Choose Academic
            </header>
            <form action="{{ route('postCreateClass') }}" method="POST" class="form-horizontal" id="form_view_class">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
                            <label for="level">Level</label>
                            <div class="input-group">
                                <select class="form-control" name="level_id" id="level_id"></select>
                                <div class="input-group-addon">
                                    <span id="add_more_level" class="fa fa-plus" data-toggle="modal" data-target="#level-show"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
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

                    </div>
                </div>
            </form>

            <!-- Class Information -->
            <form action="#" method="GET" id="form-multi-class">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Class Information
                        <button type="button" id="btn-go" class="btn btn-info btn-xs pull-right" style="margin-top: 5px;">Go</button>
                    </div>
                    <div class="panel-body" id="add_class_info" style="overflow-y: auto;height: 250px;">
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>