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
                            <input type="text" class="form-control" name="address" id="addrest"
                                aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group col-7">
                            <label class="label" for="">Giới tính:</label>
                            <select class="form-control" name="gender" id="gender">
                                <!-- <option>-- Giới tính --</option> -->
                                <option>Nam</option>
                                <option>Nữ</option>
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
                            <input type="file" class="form-control" name="avatar" id="avatar" aria-describedby="helpId"
                                placeholder="">
                        </div>

                    </div>
                </div>
                <div class="modal-footer" style="display: flex;">
                    <button type="button" class="btn-button" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn-button" id="btn-add">Lưu</button>
                </div>
            </form>
        </div>
       
    </div>
</div>