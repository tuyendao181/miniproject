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
        @foreach($data['data'] as $key => $item)

        <tr data-id="{{$item['id']}}">
            <td class="stt">{{$item['no']}}</td>
            <td class="">{{$item['id']}}</td>
            <td class="row_data section" data-colum="section" val="{{$item['library_section']}}" contenteditable>
                {{$item['library_section']}}</td>
            <td class="row_data value" data-colum="value" val="{{$item['library_value']}}" contenteditable>
                {{$item['library_value']}}</td>
            <td class="edit">sửa</td>
            <td class="delete">xóa</td>
        </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation" class="nav-paginate">
    <select class="form-control select-paginate" name="" id="">
        <option @if( $data['paginate']['limit'] == 5) selected @endif >5</option>
        <option @if( $data['paginate']['limit'] == 10) selected @endif >10</option>
        <option @if( $data['paginate']['limit'] == 15) selected @endif >15</option>
    </select>
    <ul class="pagination justify-content-center">
        <!-- Previous -->
        @if($data['paginate']['curent'] > 1 && $data['paginate']['total'] > 1)
        <li class="page-item">
            <a class="page-link page-btn" href="#" aria-label="Previous" id="pre_page"
                data-curennt="{{$data['paginate']['curent'] - 1}}" data-url="">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @endif

        @if($data['paginate']['curent'] > 2 )
            <li class="page-item num_page number_curennt_1" data-curennt="1" data-url=""><a class="page-link" href="#">1</a>
            </li>
            @if($data['paginate']['curent'] > 3)
            <div class="dots">...</div>
            @endif
        @endif

        @for($i = $data['paginate']['before'] ;$i <= $data['paginate']['after'] ;$i++) 
            @if($i> $data['paginate']['total'])
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
                <li class="page-item num_page number_curennt_1" data-curennt="{{$data['paginate']['total']}}"
                data-url=""><a class="page-link" href="#">{{$data['paginate']['total']}}</a></li>
        @endif

         @if($data['paginate']['curent'] < $data['paginate']['total'] && $data['paginate']['total']> 1)
            <li class="page-item">
                <a class="page-link page-btn " href="#" aria-label="Next" id="next_page" class="page-btn"
                    data-curennt="{{$data['paginate']['curent'] + 1}}" data-url="">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
         @endif
    </ul>
</nav>