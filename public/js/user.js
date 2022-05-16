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
                        $('#name_category').val('');
                        $('#name_category').focus();
                        $('#tl_avatar').val('');
                        $('#thumbnil').attr('src','');
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data){
                        console.log(data);
                        if(data.status == 0){
                          $.each(data.err, function( key, value ) {
                              $('span.'+key+'_error').text(value);
                          });
                        }
                        else{
                          $('#tb_list').html(data);
                          toast({
                            title: "Success!",
                            message: "You have successfully added",
                            type: "success",
                            duration: 5000
                          });
                        }
                    }
                });
          
            } catch (e) {
                alert('#login: ' + e.message);
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

