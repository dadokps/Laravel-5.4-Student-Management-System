<div class="modal fade" id="level-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New Level</h4>
            </div>
            <form action="{{ route('postInsertLevel') }}" method="POST" id="form_level_create">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <select class="form-control" name="program_id" id="program_id">
                                <option class="text-center" value="">Select</option>
                                @foreach($programs as $key => $program)
                                    <option value="{{ $program->program_id }}">{{ $program->program }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <input required autocomplete="off" autofocus type="text" name="level" id="level" class="form-control" placeholder="Level"/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" name="description" id="level_description" class="form-control" placeholder="Description" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success btn-save-level" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>