<div class="modal fade" id="create_document_modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="create_document_form">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Create New Document</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="Enter a document name" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input class="form-control" type="text" name="description" id="description" placeholder="Enter document description" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="0">Select a category</option>
                                    @foreach($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="url">Document url</label>
                                <input type="text" class="form-control" name="url" id="url" placeholder="Enter document url" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="thumbnail_url">Thumbnail url</label>
                                <input type="text" class="form-control" name="thumbnail_url" id="thumbnail_url" placeholder="Enter document thumbnail url" autocomplete="off">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="create_document" disabled>Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>