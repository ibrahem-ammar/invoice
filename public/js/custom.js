$(document).ready(function(){

    $('.pickadate').pickadate({
        format : 'yyyy-mm-dd',
        selectMonth : true ,
        seletYear : true ,
        clear : 'Clear' ,
        closeOnSelect : true
    });

    $('#invoice_details').on('keyup blur','.quantity',function(){
        let $row = $(this).closest('tr');
        let quantity = $row.find('.quantity').val() || 0;
        let unit_price = $row.find('.unit_price').val() || 0;

        $row.find('.row_sub_total').val((quantity * unit_price).toFixed(2));
        $('#sub_total').val(sumTotalVal('.row_sub_total'));
        $('#vat_value').val(vatValue());
        $('#total_due').val(sum_due_total());
    });
    $('#invoice_details').on('keyup blur','.unit_price',function(){
        let $row = $(this).closest('tr');
        let quantity = $row.find('.quantity').val() || 0;
        let unit_price = $row.find('.unit_price').val() || 0;

        $row.find('.row_sub_total').val((quantity * unit_price).toFixed(2))
        $('#sub_total').val(sumTotalVal('.row_sub_total'));

        $('#vat_value').val(vatValue());
        $('#total_due').val(sum_due_total());
    });
    $('#invoice_details').on('keyup blur','.discount_type',function(){
        $('#vat_value').val(vatValue());
        $('#total_due').val(sum_due_total());
    });
    $('#invoice_details').on('keyup blur','.discount_value',function(){
        $('#vat_value').val(vatValue());
        $('#total_due').val(sum_due_total());
    });
    $('#invoice_details').on('keyup blur','.shipping',function(){
        $('#vat_value').val(vatValue());
        $('#total_due').val(sum_due_total());
    });


    let sumTotalVal = function($selector){
        let sum = 0;
        $($selector).each(function(){
            let selectorVal = $(this).val() || 0 ;
            sum += parseFloat(selectorVal);
        });
        return sum.toFixed(2);
    };


    let vatValue = function(){
        let sub_total = $('.sub_total').val() || 0 ;
        let discount_type = $('.discount_type').val();
        let discount_value = parseFloat($('.discount_value').val()) || 0;

        let discountVal = discount_value !=0 ? discount_type == 'percentage' ? sub_total * (discount_value / 100) : discount_value : 0 ;

        let vat_value = (sub_total - discountVal) * 0.05;
        return  vat_value.toFixed(2) ;

    };


    let sum_due_total = function(){
        let sum = 0;
        let sub_total = $('.sub_total').val() || 0;
        let discount_type = $('.discount_type').val();
        let discount_value = parseFloat($('.discount_value').val()) || 0;

        let discountVal = discount_value !=0 ? discount_type == 'percentage' ? sub_total * (discount_value / 100) : discount_value : 0 ;

        let vat_value = parseFloat($('.vat_value').val()) || 0;
        let shipping = parseFloat($('.shipping').val()) || 0;

        sum += sub_total ;
        sum -= discountVal;
        sum += vat_value;
        sum += shipping;


        return sum.toFixed(2);

    };

    $(document).on('click','.btn_add' ,function(){
        let trCount = $('#invoice_details').find('tr.cloning_row:last').length;
        let numberIncr = trCount > 0 ? parseInt($('#invoice_details').find('tr.cloning_row:last').attr('id')) + 1 : 0 ;

        $('#invoice_details').find('tbody').append($(''+
            "<tr class='cloning_row' id="+ numberIncr +"><td>"+
            "<button type='button' class='btn btn-danger btn-sm btn_delete'>"+
            "<i class='fa fa-minus'></i></button></td><td>" +
            "<input type='text' name='product_name["+ numberIncr +"]' id='product_name' class='product_name form-control'>" +
            "@error('product_name') <span class='help-block text-danger'>{{ $massage }}</span> @enderror</td>" +
            "<td>" +
            "<select name='unit["+ numberIncr +"]' id='unit' class='unit form-control'>" +
            "<option></option><option value='piece'>piece</option>" +
            "<option value='g'>gram</option><option value='kg'>kilo gram</option>" +
            "</select>@error('unit') <span class='help-block text-danger'>{{ $massage }}</span> @enderror" +
            "</td><td>" +
            "<input type='text' name='quantity["+ numberIncr +"]' id='quantity' class='quantity form-control'>" +
            "@error('quantity') <span class='help-block text-danger'>{{ $massage }}</span> @enderror" +
            "</td><td>" +
            "<input type='text' name='unit_price["+ numberIncr +"]' id='unit_price' class='unit_price form-control'>" +
            "@error('unit_price') <span class='help-block text-danger'>{{ $massage }}</span> @enderror" +
            "</td><td>" +
            "<input type='text' name='row_sub_total["+ numberIncr +"]' id='row_sub_total' readonly class='row_sub_total form-control'>" +
            "@error('row_sub_total') <span class='help-block text-danger'>{{ $massage }}</span> @enderror" +
            "</td></tr>"
            ));
    });

    $(document).on('click','.btn_delete',function(e){
        $(this).closest('tr').remove();
        $('#sub_total').val(sumTotalVal('.row_sub_total'));
        $('#vat_value').val(vatValue());
        $('#total_due').val(sum_due_total());
    });

    $('form').on('submit',function(e){
        $('input.product_name').each(function(){$(this).rules("add",{required:true});});
        $('select.unit').each(function(){$(this).rules("add",{required:true});});
        $('input.quantity').each(function(){$(this).rules("add",{required:true,digits:true});});
        $('input.unit_price').each(function(){$(this).rules("add",{required:true,digits:true});});
        // $('input.row_sub_total').each(function(){$(this).rules("add",{digits:true});});
        e.preventDefault;
    });

    $('form').validate({
        rules:{
            'customer_name' : {required:true},
            'customer_email' : {required:true,email:true},
            'customer_mobile' : {required:true,digits:true,minlength:10,maxlength:14},
            'company_name' : {required:true},
            'invoice_number' : {required:true,digits:true},
            'invoice_date' : {required:true},
            'discount_value' : {digits:true},
            'shipping' : {digits:true},
        },
        submitHandler:function(form){
            form.submit();
        }
    });

});
