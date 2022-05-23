@extends('master')
@section('asset_footer')
<script src="js/history.js"></script>
@endsection
@section('content')

<!-- Button trigger modal -->


@include('ex_health.history_detail')
    <div class="col-12">
        <input id="tl-search" type="serach" placeholder="Tìm kiếm số cmnd"/>
    </div>
    <div class="col-12 tl-table">
        <table class="rtable">
          <thead>
              <tr >
                  <th>STT</th>
                  <th>Mã bệnh nhân</th>
                  <th>Họ tên</th>
                  <th>Ngày sinh</th>
                  <th>Cmnd</th>
                  <th>Số điện thoại </td>
                  <th>Bác sĩ</th>
                  <th>Tổng tiền</th>
                  <th>Ngày Khám</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
                @foreach($data['data'] as $key => $item)
                      <tr data-id="{{$item['diagnosis_id']}}">
                          <td class="stt">{{$item['no']}}</td>
                          <td class="" >{{$item['patient_id']}}</td>
                          <td class="row_data" >{{$item['patient_nm']}}</td>
                          <td class="row_data" >{{$item['patient_birthday']}}</td>
                          <td class="row_data" >{{$item['patient_cmnd']}}</td>
                          <td class="row_data" >{{$item['patient_phone']}}</td>
                          <td class="row_data">{{$item['doctor_nm']}}</td>
                          <td class="row_data">{{$item['total']}}</td>
                          <td class="row_data" >{{$item['cre_date']}}</td>
                          <td class="edit" data-toggle="modal" data-target="#modelId">Chi Tiết</td>
                      </tr>
                @endforeach
          </tbody>
        </table>
        <nav aria-label="Page navigation" class="nav-paginate">
                <select class="form-control select-paginate" name="" id="">
                  <option>5</option>
                  <option>10</option>
                  <option>15</option>
                </select>
              <ul class="pagination justify-content-center">
                  <!-- Previous -->
                  @if($data['paginate']['curent'] > 1 && $data['paginate']['total'] > 1)
                  <li class="page-item">
                      <a class="page-link page-btn " href="#" aria-label="Previous" id="pre_page" data-curennt="{{$data['paginate']['curent'] - 1}}"
                          data-url="">
                          <span aria-hidden="true">&laquo;</span>
                          <span class="sr-only">Previous</span>
                      </a>
                  </li>
                  @endif
                  @if($data['paginate']['curent'] > 2 )
                  <li class="page-item num_page number_curennt_1" data-curennt="1" data-url=""><a
                          class="page-link" href="#">1</a></li>
                  @if($data['paginate']['curent'] > 3)
                  <div class="dots">...</div>
                  @endif
                  @endif
                  @for($i = $data['paginate']['before'] ;$i <= $data['paginate']['after'] ;$i++)
                      @if($i > $data['paginate']['total'])
                          @continue
                      @endif
                      @if($i != 0)
                      <li class="page-item num_page number_curennt_{{$i}} @if( $data['paginate']['curent'] == $i) active @endif "
                          data-curennt="{{$i}}" data-url=""><a class="page-link" href="#">{{$i}}</a></li>
                      @endif
                  @endfor
                  @if($data['paginate']['curent'] < $data['paginate']['total'] - 1 )
                      @if($data['paginate']['curent'] < $data['paginate']['total'] - 2 )
                          <div class="dots">...</div>
                      @endif
                          <li class="page-item num_page number_curennt_1" data-curennt="{{$data['paginate']['total']}}" data-url=""><a class="page-link" href="#">{{$data['paginate']['total']}}</a></li>
                  @endif
                   @if($data['paginate']['curent'] < $data['paginate']['total'] && $data['paginate']['total']> 1)
                       <li class="page-item">
                           <a class="page-link  page-btn" href="#" aria-label="Next" id="next_page" class="page-btn"
                               data-curennt="{{$data['paginate']['curent'] + 1}}" data-url="">
                               <span aria-hidden="true">&raquo;</span>
                               <span class="sr-only">Next</span>
                           </a>
                       </li>
                   @endif
              </ul>
        </nav>
    </div>
@endsection