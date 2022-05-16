@extends('master')
@section('asset_footer')
<script src="js/library.js"></script>
@endsection
@section('content')

<div class="row">
    <div class="col-12 btn-save">
        <button id="btn-save" class="btn-button">Lưu</button>
    </div>
    <div class="col-12">
        <div class="row tl-rowinput">
            <!-- <div class="form-groupk col-2">
                <label for="">Mã id: </label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
            </div> -->
            <div class="form-groupk col-2">
                <label for="">Mã id: </label>
                <input type="text" class="form-control" name="id" id="id"/>
            </div>
            <div class="form-groupk col-2">
                <label for="">Section: </label>
                <input type="text" class="form-control form-section" name="section" id="section"/>
            </div>
            <div class="form-groupk col-2">
                <label for="">Value: </label>
                <input type="text" class="form-control form-value" name="value" id="value"/>
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
                    <th>Section</td>
                    <th>Value</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($result[0]  as $key => $item)
                <tr data-id="{{$item['id']}}">
                    <td class="stt">{{$item['stt']}}</td>
                    <td class="" >{{$item['id']}}</td>
                    <td class="row_data" data-colum="section">{{$item['library_section']}}</td>
                    <td class="row_data" data-colum="value">{{$item['library_value']}}</td>
                    <td class="edit">sửa</td>
                    <td class="delete">xóa</td>
                </tr>
                @endforeach
              

            </tbody>
        </table>
    </div>

</div>
@endsection