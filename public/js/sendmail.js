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
      
        // change limit
        $(document).on('click','#btn-send', function (e) {
            try {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url:  '/send-mail',
                    dataType: 'json',
                    success: function (res) {
                        console.log(res);
                        switch (res['status']) {
                            case OK:
                                jMessage(12,function(r){
                                    location.reload();
                                });
                                break;
                            default:
                                break;
                        }
                    }
                });

            } catch (e) {
                alert('#btn-send' + e.message);
            }
        });
        
    } catch (e) {
        alert('initEvents: ' + e.message);
    }
}
