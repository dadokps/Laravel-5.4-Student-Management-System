<div class="modal fade" id="batch-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New Batch</h4>
            </div>
            <form action="{{ route('postInsertBatch') }}" method="POST" id="form_batch_create">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <input required autocomplete="off" autofocus type="text" name="batch" id="batch" class="form-control" placeholder="Batch"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success btn-save-batch" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>