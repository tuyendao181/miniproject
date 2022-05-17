@extends('master')
@section('asset_footer')
<script src="js/medicines.js"></script>
@endsection
@section('content')

<div class="row">
    <input type="hidden" id="userId" name="userId" value="{{$data['user_id']}}">
    <div class="col-12 btn-save">
        <button id="btn-save" class="btn-button">Lưu</button>
    </div>
    <div class="col-12">
        <div class="row tl-rowinput">
            <div class="form-groupk col-2">
                <label for="">Mã thuốc: </label>
                <input type="text" class="form-control" name="id" id="id"/>
            </div>
            <div class="form-groupk col-2">
                <label for="">Tên thuốc: </label>
                <input type="text" class="form-control form-section" name="medicines" id="medicines"/>
            </div>
            <div class="form-groupk col-2">
                <label for="">Giá thuốc: </label>
                <input type="text" class="form-control form-value" name="price" id="price"/>
            </div>
            <button id ="btn-add" class="btn-button btn-custom">Thêm</button>
            <button id ="btn-edit" class="btn-button btn-custom">Sửa</button>
        </div>
    </div>
    <div class="col-12 tl-table">
        <table class="rtable">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Id</th>
                    <th>Tên thuốc</td>
                    <th>Giá thuốc</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['data'] as $key => $item)
              
                <tr data-id="{{$item['medicines_id']}}">
                    <td class="stt">{{$item['no']}}</td>
                    <td class="" >{{$item['medicines_id']}}</td>
                    <td class="row_data" data-colum="medicines" val="{{$item['medicines_nm']}}" contenteditable>{{$item['medicines_nm']}}</td>
                    <td class="row_data" data-colum="price"   val="{{$item['medicines_price']}}" contenteditable>{{$item['medicines_price']}}</td>
                    <td class="edit">sửa</td>
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

</div>
@endsection