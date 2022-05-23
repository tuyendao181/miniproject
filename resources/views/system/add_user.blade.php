<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="upload-image-form_1" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" id="userId" name="userId" value="{{$result['user_id']}}">
                        <div class="form-group col-12">
                            <label class="label" for="">Họ và Tên:</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                                placeholder="">
                        </div>
                        <div class="form-group col-7">
                            <label class="label" for="">Ngày sinh:</label>
                            <input type="date" class="form-control" name="date_birth" id="date_birth"
                                aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-12">
                            <label class="label" for="">Địa chỉ: </label>
                            <input type="text" class="form-control" name="address" id="address"
                                aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-7">
                            <label class="label" for="">Giới tính:</label>
                            <select class="form-control" name="gender" id="gender">
                                <!-- <option>-- Giới tính --</option> -->
                                @foreach($result['gender'][0] as $key => $item)
                                    <option class="option_{{$item['library_id']}}" value="{{$item['library_id']}}">{{$item['library_value']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label class="label" for="">Số điện thoại: </label>
                            <input type="text" class="form-control" name="phone" id="phone" aria-describedby="helpId"
                                placeholder="">
                        </div>
                        <div class="form-group col-12">
                            <label class="label" for="">Email: </label>
                            <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId"
                                placeholder="">
                        </div>
                        <div class="form-group col-12">
                            <label class="label" for="">Password: </label>
                            <input type="password" class="form-control" name="password" id="password"
                                aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-12">
                            <label class="label" for="">Ảnh: </label>
                            <input type="file" accept="image/*" name="avatar" id="avatar" value="" />
                            <input type="hidden" id="thumbnil" name="avatar_old">
                        </div>


                    </div>
                </div>
                <div class="modal-footer" style="display: flex;">
                    <button type="button" class="btn-button" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn-button" id="btn-add">Lưu</button>
                    <button type="button" class="btn-button" id="btn-edit" >Lưu</button>
                </div>
            </form>
        </div>
       
    </div>
</div>