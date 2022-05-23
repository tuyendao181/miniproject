@extends('master')
@section('asset_footer')
<script src="js/sendmail.js"></script>
@endsection
@section('content')

<!-- Button trigger modal -->
<div class="button-wap">
    
    <button type="button" class="btn-button" id="btn-send">
        Gửi
    </button>
</div>

<input type="hidden" id="userId" name="userId" value="">
<div class="col-12 tl-table">
    <table class="rtable">
          <thead>
              <tr >
                  <th>Stt</th>
                  <th>Mã bệnh nhân</th>
                  <th>Tên bệnh nhân</th>
                  <th>Email</td>
                  <th>Ngày tái khám</th>
              </tr>
          </thead>
          <tbody>
          @foreach($result[0] as $key => $item)
                  <tr data-id="">
                      <td class="stt">{{$item['stt']}}</td>
                      <td class="" >{{$item['patient_id']}}</td>
                      <td class="" >{{$item['patient_nm']}}</td>
                      <td class="row_data" >{{$item['patient_email']}}</td>
                      <td class="row_data" >{{$item['time_re']}}</td>
                  </tr>
            @endforeach
          </tbody>
     </table>
    
    
</div>

@endsection