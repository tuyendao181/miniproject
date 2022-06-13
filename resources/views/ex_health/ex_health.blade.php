@extends('master')
@section('asset_footer')
<script src="js/health.js"></script>
@endsection
@section('content')

<div class="row">
    <div class="form-groupk col-4">
        <label for="">Bệnh nhân: </label>
        <input type="search" class="form-control" name="search" id="search" aria-describedby="helpId" placeholder="" />
    </div>
    <div class="col-12 info-customer">
        <h6>Thông tin khách hàng:</h6>
        <div class="row">
            <div class="form-group col-3">
                <label class="label" for="">Mã BN: </label>
                <input type="text" class="form-control" name="id_patient" id="id_patient" aria-describedby="helpId" placeholder="" disabled/>
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Địa chỉ: </label>
                <input type="text" class="form-control" name="address_patient" id="address_patient" aria-describedby="helpId" placeholder=""disabled />
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Số điện thoại: </label>
                <input type="text" class="form-control" name="phone_patient" id="phone_patient" aria-describedby="helpId" placeholder="" disabled/>
            </div>
            <div class="form-group col-3">
                <label class="label" for="">CMND: </label>
                <input type="text" class="form-control" name="cmnd_patient" id="cmnd_patient" aria-describedby="helpId" placeholder="" disabled/>
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Họ Và Tên: </label>
                <input type="text" class="form-control" name="name_patient" id="name_patient" aria-describedby="helpId" placeholder="" disabled/>
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Nhóm máu:</label>
                <select class="form-control" name="blood_patient" id="blood_patient" disabled>
                    <option >-- Nhóm máu --</option>
                </select>
            </div>

            <div class="form-group col-3">
                <label class="label" for="">Giới tính:</label>
                <select class="form-control" name="gender_patient" id="gender_patient" disabled>
                    <option >-- Giới tính --</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Email: </label>
                <input type="text" class="form-control" name="email_patient" id="email_patient" aria-describedby="helpId" placeholder="" disabled/>
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Ngày sinh: </label>
                <input type="date" class="form-control" name="bird_patient" id="bird_patient" aria-describedby="helpId" placeholder="" disabled/>
            </div>
        </div>
    </div>
    <div class="col-12 info-health">
        <h6>Thông tin phiếu khám bệnh:</h6>
        <div class="row">
            <div class="form-group col-3">
                <label class="label" for="">Dịch vụ:</label>
                <select class="form-control" name="service" id="service">
                    <option value=" " data-id=" ">-- Dịch vụ --</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label class="label" for="">Bác sĩ:</label>
                <select class="form-control" name="doctor" id="doctor">
                    <option value="" data-id=" ">-- Bác sĩ --</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label class="label" for="">Chuẩn đoán: </label>
                <input type="text" value=" " class="form-control" name="" id="diagnois" aria-describedby="helpId" placeholder="">
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
                <tbody id="tl-body">
                    <tr id="row0">
                        <td class="medicines" >
                            <input data-id="" name='medicines0'  class="medicine" type='text' class='form-control'/>
                        </td>
                        <td class="qnt">
                            <input name='qtn0' value='500' type='number' class='form-control input-md' />
                        </td>
                        <td class="price">
                            <input name='price0' class="price_medicines" type='text' class='form-control input-md' disabled/>
                        </td>
                        <td class="use">
                            <input name='use0'  type='text' class='form-control input-md' />
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
               <span id="money_service" data-price='0'>0</span>
            </div>
           <div> 
               <span class="text-money" >Tiền thuốc: </span> 
               <span id="money_medicine" data-price="0" >0</span>
            </div>
            <div> 
               <span class="text-money">Tổng tiền: </span> 
               <span id="total_monney" data-price="0">0</span>
            </div>
            <div class="">
                <label class="label" for="">Ngày tái khám: </label>
                <input type="datetime-local" value=" " class="form-control" name="" id="time-re" aria-describedby="helpId" placeholder="">
            </div>
            <div class="btn_order">
                <button  class='btn-button' id="save">Lưu</button>
                <button  class='btn-button' id="export" disabled><a href="{{route('healthPDF')}}" disabled sytle="text-decoration: none !important;">Xuất</a></button>
                <button  class='btn-button' id="new_page">Làm mới</button>
            </div>
       </div>
    </div>

</div>
@endsection