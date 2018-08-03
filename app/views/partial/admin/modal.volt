<div id="sales_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new sales price</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="p_id" value="{{ p_id }}">
                <input type="text" name="sale_price" value="">
                <input type="text" name="daterange" value="07/28/2018 - 08/28/2018">
            </div>
            <div class="modal-footer">
                <button type="submit" class="daterange btn btn-primary"><i class="glyphicon glyphicon-plus"></i>Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
