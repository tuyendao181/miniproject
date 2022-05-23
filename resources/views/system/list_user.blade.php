@extends('master')
@section('asset_footer')
<script src="js/user.js"></script>
@endsection
@section('content')

<!-- Button trigger modal -->
<div class="button-wap">
    <button type="button" class="btn-button" data-toggle="modal" data-target="#modelId">
        Thêm
    </button>
</div>

@include('system.add_user')

<table class="rtable">
      <thead>
          <tr >
              <th>Stt</th>
              <th>Id</th>
              <th>Avatar</td>
              <th>Tên</th>
              <th>Ngày sinh</th>
              <th>Giới tính</th>
              <th>Số điện thoại</th>
              <th>Email</th>
              <th>Địa chỉ</th>
              <th></th>
              <th></th>
             
          </tr>
      </thead>
      <tbody>
        @foreach($result['data'][0] as $item)
          <tr  data-id="{{$item['user_id']}}" data-user={{$result['user_id']}}>
              <td class="row_data" >{{$item['stt']}}</td>
              <td class="row_data" >{{$item['user_id']}}</td>
              <td class="row_data" > <img class="img_user" src="{{url('/uploads/')}}/{{$item['user_avatar']}}" alt=""></td>
              <td class="row_data" >{{$item['user_nm']}}</td>
              <td class="row_data" >{{$item['user_birthday']}}</td>
              <td class="row_data" >@if($item['user_gender'] == 1) Nữ @else Nam  @endif</td>
              <td class="row_data" >{{$item['user_phone']}}</td>
              <td class="row_data" >{{$item['user_email']}}</td>
              <td class="row_data" >{{$item['user_address']}}</td>
              <td class="edit" data-toggle="modal" data-target="#modelId">sửa</td>
              <td class="delete">xóa</td>
          </tr>
        @endforeach
       
        
      </tbody>
 </table>
@endsection