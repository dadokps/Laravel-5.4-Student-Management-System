<div class="modal fade" id="time-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New Time</h4>
            </div>
            <form action="{{ route('postInsertTime') }}" method="POST" id="form_time_create">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <input required autocomplete="off" autofocus type="text" name="time" id="time" class="form-control" placeholder="07:30AM-11:30AM for example"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success btn-save-time" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>