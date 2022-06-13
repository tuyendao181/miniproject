@extends('master')
@section('asset_footer')
<script src="js/patient.js"></script>
@endsection
@section('content')

<!-- Button trigger modal -->
<div class="button-wap">
    <button type="button" class="btn-button" data-toggle="modal" data-target="#modelId">
        Thêm
    </button>
    
    <button type="button" class="btn-button" id="btn-save">
        Lưu
    </button>
</div>

@include('ex_health.add_patient')
<input type="hidden" id="userId" name="userId" value="{{$data['user_id']}}">
<div class="col-12 tl-table">
    <table class="rtable">
          <thead>
              <tr >
                  <th>Stt</th>
                  <th>Id</th>
                  <th>Họ tên</td>
                  <th>Ngày sinh</th>
                  <th>Địa chỉ</th>
                  <th>Giới tính</th>
                  <th>Nhóm máu</th>
                  <th>Số điện thoại</th>
                  <th>Email</th>
                  <th>Cmnd</th>
                  <th></th>
                  <th></th>
    
              </tr>
          </thead>
          <tbody>
          @foreach($data['data'] as $key => $item)
                  <tr data-id="{{$item['patient_id']}}">
                      <td class="stt">{{$item['no']}}</td>
                      <td class="" >{{$item['patient_id']}}</td>
                      <td class="row_data name" data-colum="name"    val="{{$item['patient_nm']}}"      contenteditable>{{$item['patient_nm']}}</td>
                      <td class="row_data birthday" data-colum="birthday"val="{{$item['patient_birthday']}}"contenteditable>{{$item['patient_birthday']}}</td>
                      <td class="row_data address" data-colum="address" val="{{$item['patient_address']}}" contenteditable>{{$item['patient_address']}}</td>
                      <td class="gender"   data-colum="gender"  val="{{$item['patient_gender']}}" >
                            <select class="select-gender select_change" name="" id="">
                            @foreach($data['gender'][0] as $key => $gender)
                                <option  @if( $gender['library_id'] == $item['patient_gender'] ) selected @endif  class="option_{{$gender['library_id']}}" value="{{$gender['library_id']}}">{{$gender['library_value']}}</option>
                            @endforeach
                            </select>
                      </td>
                      <td class="gender"   data-colum="gender"  val="{{$item['patient_blood_type']}}" >
                            <select class="select-blood select_change" name="" id="">
                            @foreach($data['blood_type'][0] as $key => $gender)
                                <option  @if( $gender['library_id'] == $item['patient_blood_type'] ) selected @endif  class="option_{{$gender['library_id']}}" value="{{$gender['library_id']}}">{{$gender['library_value']}}</option>
                            @endforeach
                            </select>
                      </td>
                      <td class="row_data phone" data-colum="phone"   val="{{$item['patient_phone']}}" contenteditable>{{$item['patient_phone']}}</td>
                      <td class="row_data email" data-colum="email"   val="{{$item['patient_email']}}" contenteditable>{{$item['patient_email']}}</td>
                      <td class="row_data cmnd" data-colum="cmnd"   val="{{$item['patient_cmnd']}}" contenteditable>{{$item['patient_cmnd']}}</td>
                      <td class="edit" data-toggle="modal" data-target="#modelId">sửa</td>
                      <td class="delete">xóa</td>
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