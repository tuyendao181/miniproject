/**
 * ****************************************************************************
 * 
 * COMMON.JS
 * 
 * 処理概要		:	
 * 作成日		:	
 * 作成者		:	
 *  
 * @package		:	
 * @copyright	:	Copyright (c) ANS-ASIA
 * @version		:	1.0.0
 * ****************************************************************************
 */


 var OK = 200;		  // OK
 var NG = 201;		  // Not good
 var EX = 202;		  // Exception
 var EPT = 203;       // Empty
 var ULF = 405;       // status Upload File False
 var PE  = 999;		  // Not permission
 var obj = {};        // data object json
//  var _text ={};
 jQuery.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
 });
//  listMess();

/*
  * list mess
  * @author    : 
  * @author    :
  * @return    : null
  * @access    : public
  * @see       : init
  */
// function listMess() {
//     try {
//         $.ajax({
//             type: 'get',
//             url:  '/get-mess',
//             dataType: 'json',
//             success: function (res) {
//                 _text = res.data;
//             },
//             async: false
//         });
//     } catch (e) {
//         alert('listMess: ' + e.message);
//     }
// }

 /*
  * setErrors
  * @author    : 
  * @author    :
  * @return    : null
  * @access    : public
  * @see       : init
  */
 function setErrors(error) {
     try {
        //  console.log(error);
        var arrs="";
        var array = [];
        $.each(error, function( index, value ) {
          
            if(value.value1 == '' || value.value1 == 0){
                if(value.error_typ == 1){
                    $('#' +value.item).addClass('boder-error');
                    $('#' +value.item).after( `<div class="tooltip_error">** ${_text[value.message_no].message}</div>` );
                }
                else if(value.error_typ == 2){
                    if($.inArray(value.item,array) == -1){
                        arrs += `<div class="" font-weight: 600">**${value.item} ${_text[value.message_no].message}</style></div>` ;
                        jError('Error',arrs);
                        array.push(value.item);
                    }
                }
            }else{
                var id = value.value1;
                var tr = $('tr[data-id='+id+']');
                if(value.error_typ == 1){
                    tr.find('.'+value.item).addClass('boder-error');
                }
                else if(value.error_typ == 2){
                    tr.find('.'+value.item).addClass('boder-error');
                    if($.inArray(value.item,array) == -1){
                        arrs += `<div class="" font-weight: 600">**${value.item} ${_text[value.message_no].message}</style></div>` ;
                        jError('Error',arrs);
                        array.push(value.item);
                    }
                }
            }
        });
     } catch (e) {
         alert('setError: ' + e.message);
     }
 }

 /*
  * clearErrors
  * @author    : 
  * @author    :
  * @return    : null
  * @access    : public
  * @see       : init
  */
 function clearErrors() {
     try {
         $(".boder-error").removeClass('boder-error');
         $('.tooltip_error').remove();
     } catch (e) {
         alert('setError: ' + e.message);
     }
 }

 

