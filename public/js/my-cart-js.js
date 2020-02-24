$(document).ready( function () {
    var sum = 0;
    var inputValue;
    var total = _('cart_total_val');
    var myTable = _('cart_table');
    for (i = 0; i < myTable.rows.length; i++) {
        var objCells = myTable.rows.item(i).cells;

        for (j = 0; j < objCells.length; j++){
            var item = objCells.item(2);
        }
        inputValue = item.firstElementChild.lastElementChild.lastElementChild.innerHTML;
        var initVal = Number(inputValue.replace(/,/g,""));

        sum += initVal;
    }
    var finalTotal = sum.toFixed(2);
    total.innerHTML = finalTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

});
$(document).ready( function () {
    $('.qunty-post').on('input', function () {
        var id = $(this).attr('id');
       $(this).addClass('has-changed')
    });
    $('.qnt-holder').on('mouseout', function () {
        var iid = $(this).attr('data-id');
        var inputId = $(this).attr('data-toggle');



        if($('input[id="'+inputId+'"]').hasClass('has-changed')){


            $('#qnty_form1'+iid).submit();
        }
    });

    $('.clear-cart').on('click', function () {
        if (confirm('Are you sure you want to clear cart?') == true) {
            $('#clear_cart_form').submit();
        }else {
            return false;
        }
    });
    $('.qnty-add').on('click', function () {
        var id = $(this).attr('data-input');
        var input = $('#'+id).val();
        var newVal = Number(input) + 1;
        $('#'+id).val(newVal);
        $('#'+id).addClass('has-changed')
    });
    $('.qnty-minus').on('click', function () {
        var id = $(this).attr('data-input');
        var input = $('#'+id).val();
        var newVal = Number(input) -1;
        $('#'+id).val(newVal);
        $('#'+id).addClass('has-changed')
    })

});