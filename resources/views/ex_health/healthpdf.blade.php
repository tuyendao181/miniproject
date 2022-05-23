<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Document</title>
    <style>
        *{ font-family: DejaVu Sans; font-size: 12px;}
        
  
    </style>
</head>
<body>
    <div class="container">
        <h5 class="modal-title">Chi tiết Hóa Đơn</h5>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <h6>Thông tin khám bệnh:</h6>
                </div>

                <div class="form-group col-3">
                    <label class="label-2" for="">Dịch vụ:</label>
                    <span id="text-service">{{$data['service_nm']}}</span>
                </div>
                <div class="form-group col-3">
                    <label class="label-2" for="">Bác sĩ:</label>
                    <span id="text-doctor">{{$data['doctor_nm']}}</span>
                </div>
                <div class="form-group col-6">
                    <label class="label-2" for="">Chuẩn đoán:</label>
                    <span id="text-remark">{{$data['remark']}}</span>
                </div>
                <div class="col-12">
                    <h6>Đơn thuốc:</h6>
                </div>
                <div class="div" style="display: flex;width: 100%;justify-content: center;">
                    <table class="rtable" style="width:unset">
                    
                        <thead>
                            <tr>
                                <th>Tên thuốc</th>
                                <th>số lượng</th>
                                <th>Giá</td>
                                <th>Cách dùng</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-table">
                            @foreach($medicines as $item)
                            <tr>
                                <td class="row_data">{{$item['medicines_nm']}}</td>
                                <td class="row_data">{{$item['quantity']}}</td>
                                <td class="row_data">{{$item['medicines_price']}}</td>
                                <td class="row_data">{{$item['use_medicine']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    
                    </table>
                </div>

                <div class="col-12 info-order">
                    <div class="wap_total">
                        <div> 
                            <span class="text-money">Tổng tiền: </span> 
                            <span id="money-total">{{$data['total']}}</span>
                         </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>

    
</body>
</html>