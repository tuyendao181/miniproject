@extends('master')
@section('content')

<div class="row">
    <div class="form-groupk col-4">
        <label for="">Bệnh nhân: </label>
        <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
    </div>
    <div class="col-12 info-customer">
        <h6>Thông tin khách hàng:</h6>
        <div class="row">
            <div class="form-group col-3">
                <label class="label" for="">Mã BN: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Địa chỉ: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Số điện thoại: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group col-3">
                <label class="label" for="">CMND: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Họ Và Tên: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Nhóm máu: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>

            <div class="form-group col-3">
                <label class="label" for="">Giới tính:</label>
                <select class="form-control" name="" id="">
                    <option>-- Giới tính --</option>
                    <option>Nam</option>
                    <option>Nữ</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Email: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Ngày sinh: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 info-health">
        <h6>Thông tin phiếu khám bệnh:</h6>
        <div class="row">
            <div class="form-group col-3">
                <label class="label" for="">Dịch vụ:</label>
                <select class="form-control" name="" id="">
                    <option>-- Dịch vụ --</option>
                    <option>Nam</option>
                    <option>Nữ</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Bác sĩ: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group col-6">
                <label class="label" for="">Chuẩn đoán: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 info-medicine">
        <h6>Đơn thuốc:</h6>
        <div class="table-responsive">
            <table id="test-table" class="table table-condensed">
                <thead>
                    <tr>
                        <th>Tên thuốc</th>
                        <th>Số lượng</th>
                        <th>Đơn Giá</th>
                        <th>Cách dùng</th>
    
                    </tr>
                </thead>
                <tbody id="test-body">
                    <tr id="row0">
                        <td>
                            <input name='from_value0' value='100' type='text' class='form-control' />
                        </td>
                        <td>
                            <input name='to_value0' value='500' type='number' class='form-control input-md' />
                        </td>
                        <td>
                            <input name='to_value0' value='500' type='number' class='form-control input-md' />
                        </td>
                        <td>
                            <input name='to_value0' value='500' type='text' class='form-control input-md' />
                        </td>
                        <td>
                            <input class='btn-button delete-row' type='button' value='Delete' style="margin-bottom:0" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <button id='add-row' class='btn-button' style="margin-left:0.7rem">+</button>
           
        </div>
    </div>

    <div class="col-12 info-order">
       <div class="wap_total">
           <div> 
               <span class="text-money">Tiền khám: </span> 
               <span>12333 vnđ</span>
            </div>
           <div> 
               <span class="text-money">Tổng tiền: </span> 
               <span>12333 vnđ</span>
            </div>
           <div> 
               <span class="text-money">Tổng tiền: </span> 
               <span>12333 vnđ</span>
            </div>
            <div class="btn_order">
                <button  class='btn-button' >Lưu</button>
                <button  class='btn-button' >Làm mới</button>
            </div>
       </div>
    </div>

</div>
@endsection