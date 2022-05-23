@foreach($result[0] as $key => $item)
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