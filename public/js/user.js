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
                $.ajax({
                    type: "post",
                    url: "/add-user",
                    data: new FormData($('#upload-image-form_1')[0]),
                     contentType: false,
                     processData: false,
                    beforeSend: function() {
                      
                    },
                    success: function(res){
                        switch (res['status']) {
                            case OK:
                                jMessage(10,function(r){
                                    location.reload();
                                });
                                break;
                            case NG:
                                console.log(res);
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
          
            } catch (e) {
                alert('#login: ' + e.message);
            }
        });

         //event edit refer data
        $(document).on("click",".edit",function(e){
            try {
                e.preventDefault();
                clearErrors();
                let tbl_row = $(this).closest('tr');
                let data = {};
                data.id =parseInt(tbl_row.attr('data-id'));
               
                refer_ajax(data);
            } catch (e) {
                alert('#btn-save: ' + e.message);
            }
        })

        //delete
        $(document).on("click",".delete",function(e){
            try {
                e.preventDefault();
                clearErrors();
                let tbl_row = $(this).closest('tr');
                let data = {};
                data.id =parseInt(tbl_row.attr('data-id'));
                data.user =parseInt(tbl_row.attr('data-user'));
                $.ajax({
                    type: 'get',
                    url:  '/delete-user',
                    dataType: 'json',
                    data:data,
                    success: function (res) {
                        switch (res['status']) {
                            case OK:
                                jMessage(7,function(r){
                                    location.reload();
                                });
                                break;
                            case EX:
                                jError('Exception','202 Exception');
                                break;
                            default:
                                break;
                        }
                    }
                });

            } catch (e) {
                alert('#btn-save: ' + e.message);
            }
        })

          //event edit
        $(document).on('click', '#btn-edit', function (e) {
            try {
                e.preventDefault();
                clearErrors();
                $.ajax({
                    type: "post",
                    url: "/edit-user",
                    data: new FormData($('#upload-image-form_1')[0]),
                     contentType: false,
                     processData: false,
                    beforeSend: function() {
                    },
                    success: function(res){
                        switch (res['status']) {
                            case OK:
                                jMessage(10,function(r){
                                    location.reload();
                                });
                                break;
                            case NG:
                                console.log(res);
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
          
            } catch (e) {
                alert('#login: ' + e.message);
            }
        });
          //event delete


       
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
        url:  '/post-login',
        dataType: 'json',
        data:data,
        success: function (res) {
            console.log(res);
            // switch (res['status']) {
            //     case OK:

            //         // //    jMessage(10,function(r){
            //         // //     location.reload();
            //         // });
                     
            //         break;
            //     case NG:
            //         // setErrors(res['errors']);
            //         break;
            //     case EX:
            //         // jError('Exception','202 Exception');
            //         break;
            //     default:
            //         break;
            // }
        }
    });
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
        url:  '/refer-user',
        dataType: 'json',
        data:data,
        success: function (res) {
            switch (res['status']) {
                case OK:
                    var data = res['data'];
                    $('.option_'+data.user_gender).attr('selected',true);
                    $('#id').val(data.user_id);
                    $('#name').val(data.user_nm);
                    $('#date_birth').val(data.user_birthday);
                    $('#address').val(data.user_address);
                    $('#password').val(data.user_password);
                    $('#phone').val(data.user_phone);
                    $('#email').val(data.user_email);
                    $('#thumbnil').val(data.user_avatar);
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
