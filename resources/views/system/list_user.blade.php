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
    
    <button type="button" class="btn-button">
        Lưu
    </button>
</div>

@include('system.add_user')

<table class="rtable">
      <thead>
          <tr >
              <th>Browser</th>
              <th>Sessions</th>
              <th>Percentage</td>
              <th>Avg. Duration</th>
              <th>Avg. Duration</th>
              <th></th>
              <th></th>
             
          </tr>
      </thead>
      <tbody>
      
          <tr id="1" data-id="1">
              <td class="row_data"  data-colum="name_1">fgf</td>
              <td class="row_data"  data-colum="name_2">68.81%</td>
              <td class="row_data"  data-colum="name_3">7,895</td>
              <td class="row_data"  data-colum="name_4">68.81%</td>
              <td class="row_data"  data-colum="name_5">01:07</td>
              <td class="edit" >sửa</td>
              <td class="delete">xóa</td>
          </tr>
          <tr id="2" data-id="2">
              <td class="row_data" data-colum="name_1">Firefox</td>
              <td class="row_data" data-colum="name_2">2,403</td>
              <td class="row_data" data-colum="name_3">17.29%</td>
              <td class="row_data" data-colum="name_4">2,046</td>
              <td class="row_data" data-colum="name_5">00:59</td>
              <td class="edit" >sửa</td>
              <td class="delete">xóa</td>
          </tr>
          <tr id="3" data-id="3">
              <td class="row_data">Safari</td>
              <td class="row_data">1,089</td>
              <td class="row_data">2.63%</td>
              <td class="row_data">904</td>
              <td class="row_data">00:59</td>
              <td class="edit" >sửa</td>
              <td class="delete">xóa</td>
          </tr>
          <tr id="4" data-id="4">
              <td class="row_data">Internet Explorer</td>
              <td class="row_data">366</td>
              <td class="row_data">2.63%</td>
              <td class="row_data">333</td>
              <td class="row_data">01:01</td>
              <td class="edit" >sửa</td>
              <td class="delete">xóa</td>
          </tr> 
        
      </tbody>
 </table>
@endsection