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
        //event add
        $(document).on('click', '#btn-add', function (e) {
            try {
                e.preventDefault();
                clearErrors();
                let data = {};
                data.name=$('#name').val();
                data.birth_day=$('#birth_day').val();
                data.address=$('#address').val();
                data.gender=$('#gender').val();
                data.blood_type=$('#blood_type').val();
                data.cmnd=$('#cmnd').val();
                data.phone=$('#phone').val();
                data.email=$('#email').val();
                data.userId=$('#userId').val();
                //call function ajax_Add
                ajax_Add(data);
            } catch (e) {
                alert('#btn-add: ' + e.message);
            }
        });
        //event editable json
        $(document).on("keyup",".row_data",function(){
            var isclick = false;
            let time =  new Date();
            let update_date = time.toISOString().slice(0, 19).replace('T', ' ');
            storge_json($(this),update_date,null,isclick);
        })
        //event change json
        $(document).on("change",".select_change",function(){
            var isclick = false;
            let time =  new Date();
            let update_date = time.toISOString().slice(0, 19).replace('T', ' ');
            storge_json($(this),update_date,null,isclick);
        })

        //event delete json
        $(document).on("click",".delete",function(){
            var isclick = true;
            let time =  new Date();
            let del_date = time.toISOString().slice(0, 19).replace('T', ' ');
            storge_json($(this),null,del_date,isclick);
            $(this).closest('tr').remove();
        })
        //event save json
        $(document).on("click","#btn-save",function(e){
            try {
                e.preventDefault();
                clearErrors();
                //convert json no key
                data=JSON.stringify(Object.values(obj));
               //call function ajax_Save
                ajax_Save(data);
            } catch (e) {
                alert('#btn-save: ' + e.message);
            }
        })

         //event edit refer data
         $(document).on("click",".edit",function(e){
            try {
                e.preventDefault();
                clearErrors();
                $('.form-section').focus();
                let tbl_row = $(this).closest('tr');
                let data = {};
                data.id =parseInt(tbl_row.attr('data-id'));
                refer_ajax(data);
            } catch (e) {
                alert('#btn-save: ' + e.message);
            }
        })

         //event edit
         $(document).on('click', '#btn-edit', function (e) {
            try {
                e.preventDefault();
                clearErrors();
                let data = {};
                data.id=$('#id').val();
                data.name=$('#name').val();
                data.birth_day=$('#birth_day').val();
                data.address=$('#address').val();
                data.gender=$('#gender').val();
                data.blood_type=$('#blood_type').val();
                data.cmnd=$('#cmnd').val();
                data.phone=$('#phone').val();
                data.email=$('#email').val();
                data.userId=$('#userId').val();
                //call function ajax_Add
                ajax_Edit(data);
            } catch (e) {
                alert('#btn-add: ' + e.message);
            }
        });

          // add event click number page pagination 
        $(document).on('click', '.num_page', function (e) {
            try {
                e.preventDefault();
                let data={};
                data.curent = $(this).attr('data-curennt');
                data.limit = $('.select-paginate').val();
                //call function ajaxPagination
                ajaxPagination(data);
            } catch (e) {
                alert('.num_page' + e.message);
            }
        });
         // add event click page-link pagination 
        $(document).on('click', '.page-btn', function (e) {
            try {
                e.preventDefault();
                let data={};
                data.curent = parseInt($(this).attr('data-curennt'));
                data.limit = $('.select-paginate').val();
                //call function ajaxPagination
                console.log(data);
                ajaxPagination(data);
            } catch (e) {
                alert('#pre_page' + e.message);
            }
        });
        // change limit
        $(document).on('change','.select-paginate', function (e) {
            try {
                e.preventDefault();
                let data={};
                data.curent = $('.page-item.active').attr('data-curennt');
                data.limit = $(this).val();

                //call function ajaxPagination
                ajaxPagination(data);
            } catch (e) {
                alert('#next_page' + e.message);
            }
        });
        
    } catch (e) {
        alert('initEvents: ' + e.message);
    }
}
/*
 * function ajax_Add add data
 * @author    : tuyen – tuyendn@ans-asia.com - create
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function ajax_Add(data){
    $.ajax({
        type: 'get',
        url:  '/add-patient',
        dataType: 'json',
        data:data,
        success: function (res) {
            
            switch (res['status']) {
                case OK:
                    jMessage(10,function(r){
                        location.reload();
                    });
                     
                    break;
                case NG:
                    setErrors(res['errors']);
                    break;
                case EX:
                    jError('Exception','202 Exception');
                    break;
                default:
                    break;
            }
        }
    });
}
/*
 * function ajax_save 
 * @author    : tuyen – tuyendn@ans-asia.com - create
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function ajax_Save(data){
    $.ajax({
        type: 'get',
        url:  '/put-patient',
        dataType: 'json',
        data:{myArray:data},
        success: function (res) {
            // console.log(res);
            switch (res['status']) {
                case OK:
                    jMessage(7,function(r){
                        location.reload();
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
        }
    });
}
/*
 * function storge_json storage object json global
 * @author    : tuyen – tuyenadn@ans-asia.com - create
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function storge_json($$this,update_date,del_date,isclick){
    let tbl_row = $$this.closest('tr');
    let id =parseInt(tbl_row.attr('data-id'));
    let userId=$('#userId').val();
    tbl_row.find('.row_data').each(function(index, val) 
    {   
        if (obj[id] === undefined) {
            obj[id] = {}
        };
        var col = $(this).attr('data-colum');
        if(isclick){
            obj[id][col]=$(this).attr('val');
        }
        else{
            obj[id][col]=$(this).text();
        }
    });
    let gender=tbl_row.find('.select-gender :selected').val();
    let blood_type=tbl_row.find('.select-blood :selected').val();


    //add id in object
    $.extend(obj[id], {id:id,gender:gender,blood_type:blood_type,update_date:update_date,del_date:del_date,userId:userId}); 
}

/*
 * function refer_ajax refer data edit
 * @author    : tuyen – tuyendn@ans-asia.com - create
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function refer_ajax(data){
    $.ajax({
        type: 'get',
        url:  '/get-edit-patient',
        dataType: 'json',
        data:data,
        success: function (res) {
            switch (res['status']) {
                case OK:
                    let data = res['data'];
                    $val =data.patient_gender;
                    $blood =data.patient_blood_type;
                    $('#id').val(data.patient_id);
                    $('#name').val(data.patient_nm);
                    $('#birth_day').val(data.patient_birthday);
                    $('#address').val(data.patient_address);
                    $('.option_'+$val).attr('selected','true');
                    $('.option_'+$blood).attr('selected','true');
                    $('#phone').val(data.patient_phone);
                    $('#email').val(data.patient_email);
                    $('#cmnd').val(data.patient_cmnd);
                   
                    $('#btn-add').hide();
                    $('#btn-edit').show();
                    break;
                case EX:
                    jError('Exception','202 Exception');
                    break;
                default:
                    break;
            }
        }
    });
}
/*
 * function ajax_Edit
 * @author    : tuyen – tuyendn@ans-asia.com - create
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function ajax_Edit(data){
    $.ajax({
        type: 'get',
        url:  '/patch-patient',
        dataType: 'json',
        data:data,
        success: function (res) {
            console.log(res);
            switch (res['status']) {
                case OK:
                    jMessage(11,function(r){
                        location.reload();
                    });
                    break;
                case NG:
                    setErrors(res['errors']);
                    break;
                case EX:
                    jError('Exception','202 Exception');
                    break;
                default:
                    break;
            }
        }
    });
}

/*
 * function get data
 * @author    : tuyen – tuyendn@ans-asia.com - create
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
//function ajaxPagination
function ajaxPagination(data){
    $.ajax({
        type: 'get',
        url: '/paginate-patient',
        data:data,
        beforeSend: function() {
        },
        success: function (res) {
            console.log(res);
            $('.tl-table').html(res);
        }
    });
}

