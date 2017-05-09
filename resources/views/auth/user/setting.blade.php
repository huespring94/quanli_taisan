<div class="active tab-pane" id="settings">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Mã tài khoản</label>

            <div class="col-sm-10">
                <input type="text" disabled class="form-control" id="inputName" placeholder="Mã tài khoản" value="{{Auth::user()->id}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Họ và tên lót</label>

            <div class="col-sm-10">
                <input type="text" disabled class="form-control" id="inputName" placeholder="Họ và tên lót" value="{{Auth::user()->lastname}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tên</label>

            <div class="col-sm-10">
                <input type="text" disabled class="form-control" id="inputName" placeholder="Tên" value="{{Auth::user()->firstname}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputSkills" class="col-sm-2 control-label">Ngày sinh</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputSkills" placeholder="Ngày sinh" value="{{Auth::user()->dob}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputSkills" class="col-sm-2 control-label">Chức vụ</label>

            <div class="col-sm-10">
                <input type="text" disabled class="form-control" id="inputSkills" placeholder="Chức vụ" value="{{Auth::user()->role->name}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>

            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{Auth::user()->email}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputExperience" class="col-sm-2 control-label">Số điện thoại</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail" placeholder="Số điện thoại" value="{{Auth::user()->phone}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputExperience" class="col-sm-2 control-label">Địa chỉ</label>

            <div class="col-sm-10">
                <textarea class="form-control" id="inputExperience" placeholder="Địa chỉ">{{Auth::user()->address}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Cập nhật</button>
            </div>
        </div>
    </form>
</div>