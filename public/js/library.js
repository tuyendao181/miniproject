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
                data.id=$('#id').val();
                data.section=$('#section').val();
                data.value=$('#value').val();
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
                data.section=$('#section').val();
                data.value=$('#value').val();
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
        url:  '/add-library',
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
        url:  '/put-library',
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
 * @author    : tuyen – tuyendn@ans-asia.com - create
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
    //add id in object
    $.extend(obj[id], {id:id,update_date:update_date,del_date:del_date,userId:userId}); 
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
        url:  '/get-edit-library',
        dataType: 'json',
        data:data,
        success: function (res) {
            switch (res['status']) {
                case OK:
                    let data = res['data'];
                    $('#value').val(data.library_value);
                    $('#section').val(data.library_section);
                    $('#id').val(data.library_id).attr('disabled','disabled');
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
        url:  '/patch-library',
        dataType: 'json',
        data:data,
        success: function (res) {
            console.log(res);
            switch (res['status']) {
                case OK:
                    location.reload();
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
        url: '/paginate-library',
        data:data,
        beforeSend: function() {
        },
        success: function (res) {
            $('.tl-table').html(res);
        }
    });
}

