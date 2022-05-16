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
        $('.row_data').attr('contenteditable', 'true');   
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
                //call function ajax_Add
                ajax_Add(data);
            } catch (e) {
                alert('#btn-add: ' + e.message);
            }
        });
        //event editable json
        $(document).on("keyup",".row_data",function(){
            let time =  new Date();
            let update_date = time.toISOString().slice(0, 19).replace('T', ' ');
            storge_json($(this),update_date,null);
        })
        //event delete json
        $(document).on("click",".delete",function(){
            let time =  new Date();
            let del_date = time.toISOString().slice(0, 19).replace('T', ' ');
            storge_json($(this),null,del_date);
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
                //call function ajax_Add
                ajax_Edit(data);
            } catch (e) {
                alert('#btn-add: ' + e.message);
            }
        });
       

    } catch (e) {
        alert('initEvents: ' + e.message);
    }
}
/*
 * function ajax_Add
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
                   
                    setErrors2(res['errors'])
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
function storge_json($$this,update_date,del_date){
    let tbl_row = $$this.closest('tr');
    let id =parseInt(tbl_row.attr('data-id'));
    tbl_row.find('.row_data').each(function(index, val) 
    {   
        if (obj[id] === undefined) {
            obj[id] = {}
        };
        var col = $(this).attr('data-colum');
        obj[id][col]=$(this).text();
    });
    //add id in object
    $.extend(obj[id], {id:id,update_date:update_date,del_date:del_date}); 
}

/*
 * function storge_json storage object json global
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

