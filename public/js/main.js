$( document ).ready(function() {
    // $('.nav-toggle').click(function (e) {
    //     e.preventDefault();
    //     $(".main_wap").toggleClass("openNav");
    //     // $(".nav-toggle").toggleClass("active");
    // });

      // Add row
  var row=1;
  $(document).on("click", "#add-row", function () {
  var new_row = '<tr id="row' + row + '"><td><input name="from_value' + row + '" type="text" class="form-control" /></td><td><input name="to_value' + row + '" type="text" class="form-control" /></td><td><input class="delete-row btn btn-primary" type="button" value="Delete" /></td></tr>';
  var new_row = `
    <tr id="row${row}">
          <td>
              <input name='from_value${row}' value='100' type='text' class='form-control' />
          </td>
          <td>
              <input name='to_value${row}' value='500' type='number' class='form-control input-md' />
          </td>
          <td>
              <input name='to_value${row}' value='500' type='number' class='form-control input-md' />
          </td>
          <td>
              <input name='to_value${row}' value='500' type='text' class='form-control input-md' />
          </td>
          <td>
              <input class='btn-button delete-row' type='button' value='Delete'style="margin-bottom:0" />
          </td>
    tr>
  `
  $('#test-body').append(new_row);
  row++;
  return false;
  });
  // Remove criterion
  $(document).on("click", ".delete-row", function () {
      console.log('ok');
  //  alert("deleting row#"+row);
    if(row>1) {
      $(this).closest('tr').remove();
      row--;
    }
  return false;
  });

    $(document).on("click",".click-list",function(){
        $('.click-list .active').removeClass('active');
        $(this).addClass('active');
    })

    // storage variable json
    var obj = {};
    $(document).on("click",".edit",function(){
        $('.row_data').removeAttr('contenteditable');
        var tbl_row = $(this).closest('tr');
        var id=parseInt(tbl_row.attr('data-id'));
        tbl_row.find('.row_data').attr('contenteditable', 'true');
    })
    $(document).on("keyup",".row_data",function(){
        var tbl_row = $(this).closest('tr');
        var id =parseInt(tbl_row.attr('data-id'));
        tbl_row.find('.row_data').each(function(index, val) 
		{   
            if (obj[id] === undefined) {
                obj[id] = {}
            };
            var col = $(this).attr('data-colum');
            obj[id][col]=$(this).html();
		});
        //add id in object
        $.extend(obj[id], {id:id});
    })
   
    $(document).on("click",".delete",function(){
        console.log(JSON.stringify(Object.values(obj)));
        bootbox.confirm("This is the default confirm!", function(result){ 
            console.log('This was logged in the callback: ' + result); 
        })
    })
    
});