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
 var _text ={};
 jQuery.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
 });
 listMess();

 

/*
  * list mess
  * @author    : 
  * @author    :
  * @return    : null
  * @access    : public
  * @see       : init
  */
function listMess() {
    try {
        $.ajax({
            type: 'get',
            url:  '/get-mess',
            dataType: 'json',
            success: function (res) {
                _text = res.data;
            },
            async: false
        });
    } catch (e) {
        alert('listMess: ' + e.message);
    }
}


 
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
        $.each(error, function( index, value ) {

            $('#' +index).addClass('boder-error');
            $('#' +index).after( `<div class="text-danger">** ${_text[value].message}</div>` );
        });
     } catch (e) {
         alert('setError: ' + e.message);
     }
 }

 function setErrors2(error) {
    try {
        var val="";
       $.each(error, function( index, value ) {
            val += `<div class="" font-weight: 600">**${index} ${_text[value].message}</style></div>` ;
       });
       jError('Error',val);
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
         $('.text-danger').remove();
     } catch (e) {
         alert('setError: ' + e.message);
     }
 }

 

