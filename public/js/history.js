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
        //search
        $(document).on( "keyup","#tl-search", function(e) {
            e.preventDefault();
            $val=$('#tl-search').val();
            var data={};
            data.keyword=$val;
            ajaxPagination(data);
        });
          // add event click number page pagination 
        $(document).on('click', '.num_page', function (e) {
            try {
                e.preventDefault();
                let data={};
                $val=$('#tl-search').val();
                data.keyword=$val;
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
                $val=$('#tl-search').val();
                data.keyword=$val;
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
                $val=$('#tl-search').val();
                data.keyword=$val;
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
        url:  '/history-deatal',
        dataType: 'json',
        data:data,
        success: function (res) {
            switch (res['status']) {
                case OK:
                    let data = res['data'];
                    $('#text-service').text(data.service_nm);
                    $('#text-doctor').text(data.doctor_nm);
                    $('#text-remark').text(data.remark);
                    $('#money-total').text(data.total);
                    
                    $.each(res['medicines'],function(item,value){
                        $('.tbody-table').append(`
                        <tr>
                            <td class="row_data">${value.medicines_nm}</td>
                            <td class="row_data">${value.quantity}</td>
                            <td class="row_data">${value.medicines_price}</td>
                            <td class="row_data">${value.use_medicine}</td>
                        </tr>
                        `);
                    })
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
 * function paginate
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
        url: '/paginate-history',
        data:data,
        beforeSend: function() {
        },
        success: function (res) {
            console.log(res);
            $('.tl-table').html(res);
        }
    });
}

