$(document).ready( function () {
    var sum = 0;
    var inputValue;
    var total = _('chkout_subtotal');
    var grand_total = _('chkout_grand_total');
    var chargesTable = _('charges_table');
    var myTable = _('checkout_table');
    for (i = 0; i < myTable.rows.length; i++) {
        var objCells = myTable.rows.item(i).cells;

        for (j = 0; j < objCells.length; j++){
            var item = objCells.item(1);
        }

        inputValue = item.firstElementChild.firstElementChild.firstElementChild.lastElementChild.innerHTML;
        var initVal = Number(inputValue.replace(/,/g,""));

        sum += initVal;
    }
    var finalTotal = sum.toFixed(2);
    total.innerHTML = finalTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    var charge = 0;
    for (i = 0; i < chargesTable.rows.length; i++) {
        var objCells = chargesTable.rows.item(i).cells;


        for (j = 0; j < objCells.length; j++){
            var item = objCells.item(1);
        }


        inputValue = item.firstElementChild.firstElementChild.firstElementChild.innerHTML;

        var SuvinitVal = Number(inputValue.replace(/,/g,""));

        charge += SuvinitVal;
    }

    var totlTotal = sum + charge;

    grand_total.innerHTML = (totlTotal.toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");



});

$(document).ready( function () {
    $('#chkout_pay_btn').on('click', function () {
        $('#post_payment_mode_frm').submit();
    })
});