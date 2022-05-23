
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title-add">Thêm bác sĩ</h5>
        <h5 class="modal-title title-edit">Thêm bác sĩ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <input type="hidden" name="id" id="id" />
          <div class="form-group col-12">
            <label class="label" for="">Họ và Tên:</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
          </div>
          <div class="form-group col-6">
            <label class="label" for="">Ngày sinh:</label>
            <input type="date" class="form-control" name="date_birth" id="date_birth" aria-describedby="helpId" placeholder="">
          </div>
          <div class="form-group col-12">
            <label class="label" for="">Địa chỉ: </label>
            <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="">
          </div>
          <div class="form-group col-7">
            <label class="label" for="">Giới tính:</label>
            <select class="form-control" name="gender" id="gender">
                @foreach($data['gender'][0] as $key => $item)
                  <option class="option_{{$item['library_id']}}" value="{{$item['library_id']}}">{{$item['library_value']}}</option>
                @endforeach
            </select>
          </div>

          <div class="form-group col-12">
            <label class="label" for="">Số điện thoại: </label>
            <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpId" placeholder="">
          </div>
          <div class="form-group col-12">
            <label class="label" for="">Email: </label>
            <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
          </div>
        
        </div>
      </div>
      <div class="modal-footer" style="display: flex">
        <button type="button" class="btn-button" data-dismiss="modal">Huỷ</button>
        <button type="button" class="btn-button" id="btn-add">Lưu</button>
        <button type="button" class="btn-button" id="btn-edit">Lưu</button>
      </div>
    </div>
  </div>
</div>