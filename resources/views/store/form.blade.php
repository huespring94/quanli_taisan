<input type="text" hidden="true" name="import_store_id" value="{{$storeImport->id}}">
<div class="box-body">
    <div class="form-group">
        <label class="col-sm-2 control-label">Chọn tài sản</label>
        <div class="col-sm-8">
            <select name="stuff_id" class="form-control">
                <option>Chon</option>
                @foreach($stuffs as $stuff)
                <option {{!isset($detailImport) ? '' : ($detailImport->stuff_id == $stuff->stuff_id ? "selected" : '')}} value="{{$stuff->stuff_id}}">{{$stuff->name}}</option>
                @endforeach
            </select>
            <div class="has-error">
                @foreach ($errors->get('stuff_id') as $error)
                <span class="help-block">
                    {{ $error }}
                </span>
                @endforeach
            </div>
        </div>
        <div class="col-sm-2">
            <div class="input-group-addon">
                <i class="fa fa-plus-circle"></i>
            </div>
            <div class="input-group-btn">
                <button type="button" class="btn btn-danger">Tạo mới</button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Số lượng</label>
        <div class="col-sm-10">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-database"></i>
                </div>
                <input type="number" min="1" name="quantity" value="{{isset($detailImport) ? $detailImport->quantity : ''}}"  class="form-control pull-right">
                <div class="has-error">
                    @foreach ($errors->get('quantity') as $error)
                    <span class="help-block">
                        {{ $error }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Đơn giá (VND)</label>
        <div class="col-sm-10">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                </div>
                <input type="number" name="price_unit" value="{{isset($detailImport) ? $detailImport->price_unit : ''}}" class="form-control pull-right">
            </div>
            <div class="has-error">
                @foreach ($errors->get('price_unit') as $error)
                <span class="help-block">
                    {{ $error }}
                </span>
                @endforeach
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Trạng thái (%)</label>
        <div class="col-sm-10">
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-bars"></i>
                </div>
                <input type="number" max="100" min="1" name="status"
                       value="{{isset($detailImport) ? $detailImport->status : 100}}" class="form-control pull-right">
                <div class="has-error">
                    @foreach ($errors->get('status') as $error)
                    <span class="help-block">
                        {{ $error }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
<div class="box-footer">
    <button type="submit" class="btn btn-info pull-right">Xử lí chi tiết kho hàng</button>
</div>

