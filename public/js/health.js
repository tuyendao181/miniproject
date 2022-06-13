/**
 ***************************************************************************
 * ANS ASIA
 *
 * 作成日          :   2022/03/15
 * 作成者          :   tuyen – tuyendn@ans-asia.com
 *
 * @package         :   
 * @copyright       :   Copyright (c) ANS-ASIA
 * @version         :   1.0.0
 ***************************************************************************
 */
// storge data medicines
 var data_search ;
 var total_price = 0;
 $(document).ready(function () {
    try {
        initialize();
        initEvents();
    } catch (e) {
        alert('ready' + e.message);
    }
});
/*
 * initialize
 *
 * @author    :  tuyen – tuyendn@ans-asia.com - create
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function initialize() {
    try {
        // call functon data
        dataPatient();
    } catch (e) {
        alert('initEvents: ' + e.message);
    }
}
/*
 * initEvents
 * @author    : tuyen – tuyendn@ans-asia.com - create
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function initEvents() {
    try {
        var row=1;
        // add row
        $(document).on("click", "#add-row", function () {
            var new_row = `
            <tr id="row${row}">
                <td class="medicines">
                    <input name='medicines' data-id=""  class="medicine" type='text' class='form-control'/>
                </td>
                <td class="qnt">
                    <input name='qtn' value='500' type='number' class='form-control input-md' />
                </td>
                <td class="price">
                    <input name='price' class="price_medicines" type='number' class='form-control input-md' disabled/>
                </td>
                <td class="use">
                    <input name='use'  type='text' class='form-control input-md' />
                </td>
                <td>
                    <input class='btn-button delete-row' type='button' value='Delete' style="margin-bottom:0" />
                </td>
            </tr>
            `
            $('#tl-body').append(new_row);
            searchMedicines(data_search);

            row++;
        });
        // delete row
        $(document).on("click", ".delete-row", function () {
        //  alert("deleting row#"+row);
          if(row>1) {
            $(this).closest('tr').remove();
            row--;
          }
        });
        //save data 
        $(document).on("click", "#save", function () {
            let patient = $('#id_patient').val();
            let doctor = $('#doctor :selected').attr('data-id');
            let service = $('#service :selected').attr('data-id');
            let diagnois = $('#diagnois').val();
            let total_monney = $('#total_monney').attr('data-price');
            let time_re = $('#time-re').val();
            time_re = time_re.slice(0, 19).replace('T', ' ');
            var rows = [];
            $('#tl-body tr').each(function(index, val) 
            {   
                rows.push({
                    name:$(this).find('.medicines input').attr('data-id'),
                    qtn:$(this).find('.qnt input').val(),
                    price:$(this).find('.price input').val(),
                    use:$(this).find('.use input').val(),
                });
            });
            var data = {
                'diagnosis_detail': JSON.stringify(rows),
                'diagnosis': [{
                    patient     : patient,
                    doctor      : doctor,
                    diagnois    : diagnois,
                    service     : service,
                    total_monney: total_monney,
                    time_re     : time_re
                }]
            };

            $.ajax({
                type: 'get',
                url:  '/save-health',
                dataType: 'json',
                data:data,
                success: function (res) {
                    switch (res['status']) {
                        case OK:
                            jMessage(7,function(r){
                                $('#save').attr('disabled',true);
                                $('#export').removeAttr('disabled');
                                $('#export a').removeAttr('disabled');
                               
                            });
                            break;
                        case NG:
                           
                            setErrors(res['errors'])
                            break;
                        case EX:
                            jError('Exception','202 Exception');
                            break;
                        default:
                            break;
                    }
                },
            });
            
        });
         // load page
         $(document).on("click","#new_page", function () {
              location.reload();
        });

        // change service reder price
        $(document).on("change","#service", function () {
            let price = parseInt($('#service :selected').attr('data-price'));
            money_serive = price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
            $('#money_service').text(money_serive).attr('data-price',price);

            let money_medicine = parseInt($('#money_medicine').attr('data-price'));

            let total_monney = price + money_medicine;
            let total_monney_2 = total_monney.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});

            $('#total_monney').text(total_monney_2).attr('data-price','total_monney');
        });

     
    
    } catch (e) {
        alert('initEvents: ' + e.message);
    }
}
/*
 * function dataPatient get data patient
 * @author    : tuyen – tuyendn@ans-asia.com - create
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function dataPatient(){
    try {
        $.ajax({
            type: 'get',
            url:  '/list-health',
            dataType: 'json',
            success: function (res) {
                $('#service').select2();
                $('#doctor').select2();
                $.each(res.doctor, function( index, value ) {
                   $('#doctor').append(`<option data-id="${value.doctor_id}" value="${value.doctor_nm}">${value.doctor_nm}</option>`);
                });
                $.each(res.service, function( index, value ) {
                    $('#service').append(`<option data-price="${value.service_price}" data-id="${value.service_id}" value="${value.service_nm}">${value.service_nm}</option>`);
                 });
                data_search = res.medicines;
                searchPatient(res.data);
                searchMedicines(res.medicines);
            },
        });
    } catch (e) {
        alert('dataPatient: ' + e.message);
    }
}

/*
 * function listPatient search data patient
 * @author    : tuyen – tuyendn@ans-asia.com - create
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function searchPatient(data){
    try {
        $( "#search" ).autocomplete({
            source: data,
            select: function( event, ui ) {
                let id = ui.item.id;
                $.ajax({
                    type: 'get',
                    url:  '/refer-health',
                    dataType: 'json',
                    data:{id},
                    success: function (res) {
                        let data = res.data;
                        $('#blood_patient').append(`<option selected>${data.patient_blood_type}</option>`);
                        $('#gender_patient').append(`<option selected>${data.patient_gender}</option>`);
                        $('#id_patient').val(data.patient_id);
                        $('#address_patient').val(data.patient_address);
                        $('#phone_patient').val(data.patient_phone);
                        $('#cmnd_patient').val(data.patient_cmnd);
                        $('#name_patient').val(data.patient_nm);
                        $('#email_patient').val(data.patient_email);
                        $('#bird_patient').val(data.patient_birthday);
                    },
                });
            }
        });
   
    } catch (e) {
        alert('searchPatient: ' + e.message);
    }
   
}
function searchMedicines(data){
    try {
        $( ".medicine" ).autocomplete({
            source: data,
            select: function( event, ui ) {
                let price = parseInt(ui.item.Price);
                let id    = ui.item.id;
                let tbl_row =  $(this).closest('tr');
                tbl_row.find('.price_medicines').val(price).attr('data-id',id);
                tbl_row.find('.medicine').attr('data-id',id);
                
                total_price += price; 
                let money_medicine = total_price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                $('#money_medicine').text(money_medicine).attr('data-price',total_price);

                let money_service = parseInt($('#money_service').attr('data-price'));

                let total = total_price + money_service;
                $('#total_monney').attr('data-price',total);
                total = total.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                $('#total_monney').text(total)

               

            },
            change: function( event, ui ) {
                if(ui.item == null){
                    $(this).val('');
                }
            }
        });
    } catch (e) {
        alert('searchMedicines: ' + e.message);
    }
   
}



