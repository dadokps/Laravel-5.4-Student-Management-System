<div class="modal fade" id="program-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Program</h4>
            </div>
            <form action="{{ route('postInsertProgram') }}" method="POST" id="form_program_create">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <input required autocomplete="off" autofocus type="text" name="program" id="program" class="form-control" placeholder="Course"/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" name="description" id="program_description" class="form-control" placeholder="Description" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success btn-save-program" type="submit">Save</button>
                </div>
            </form>
            <div class="errors alert alert-danger hidden"></div>
        </div>
    </div>
</div>