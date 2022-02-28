$(document).ready(function () {

    demo.initDateTimePicker();
    if ($('.slider').length != 0) {
        demo.initSliders();
    }




    var html = htmlApeend();

    $('#datatable tbody').append(html);


    $("#datatable tbody tr").each( function (key,valye) {
        var rowCount = $('#datatable tbody tr').length;

        var $this = $(this);
        var id= key+1;
        $("#"+id+" .serail").html(`<input type="number" class="form-control"  value="${id}">`);
        if(rowCount==id){
            $("#bill-row_"+id+" .links").html(`<a class="dropdown-item add-product-row" data-id="${rowCount}" href="javascript:void(0)"><i class="fa fa-plus btn-info"></i></a>`);
        }else{
            $("#bill-row_"+id+" td.links").html(`<a class="dropdown-item delete-product-row" data-id="${rowCount}" href="javascript:void(0)"><i class="fa fa-minus btn-info"></i></a>`);
        }


    })


    function htmlApeend(){

        var rowCount = $('#datatable tr').length;



        var html = `<tr class="table-row" id="bill-row_${rowCount}">
                        <td class="w-1 serail" >
                            <input type="number" class="form-control" placeholder="" min="1" max="1000000" value="${rowCount}"/>
                         </td>
                        <td class="">
                            <input type="text" class="form-control product_name" data-id="${rowCount}" placeholder="" name="product_name[]" required value=""/> 
                            <input type="hidden" class="form-control product_id"  placeholder="" name="product_id[]" value=""/>
                            <div class="suggesstion-box" id="suggesstion-box${rowCount}">
                            <div class="add-div-error product_name"></div>
</div>
                        </td>
                        <td class=""><input class="form-control item_quantity" name="item_quantity[]" required value="1" type="number" min="1" max="1000000"/></td>
                        <td class=""><input class="form-control packet_per_box" name="packet_per_box[]" required type="number" min="1" max="1000000"/></td>
                        <td class=""><input class="form-control item_per_packet" name="item_per_packet[]" required type="number" min="1" max="1000000"/></td>
                        <td class=""><input class="form-control item_unit_price" name="item_unit_price[]" required type="number" min="1" max="1000000"/></td>
                        <td class=""><input class="form-control item_price" name="item_price[]" required  type="number" min="1" max="1000000"/></td>
                        </td>

                        <td class="w2 text-center links">
                        
                                

                        </td>
                     </tr>`;



        return html;


    }






    $(document).click( function () {
        $(".suggesstion-box").hide();
    })


    $(document).on('click','.suggesstion-box', function (e) {

        e.stopPropagation();




    })


    $(document).on('click','.add-product-row', function () {
        var rowCount = $('#datatable tr').length;
        //alert(rowCount);

         var html = htmlApeend()
        $('#datatable tbody').append(html);

        $("#datatable tbody tr").each( function (key,valye) {
            var rowCount = $('#datatable tbody tr').length;

            var $this = $(this);
            var id= key+1;
            $("#"+id+" .serail").html(`<input type="number" class="form-control"  value="${id}">`);
            if(rowCount==id){
                $("#bill-row_"+id+" .links").html(`<a class="dropdown-item add-product-row" data-id="${rowCount}" href="javascript:void(0)"><i class="fa fa-plus btn-info"></i></a>`);
            }else{
                $("#bill-row_"+id+" td.links").html(`<a class="dropdown-item delete-product-row" data-id="${rowCount}" href="javascript:void(0)"><i class="fa fa-minus btn-warning"></i></a>`);
            }


        })

    });
    $(document).on('keyup','.product_name', function (e) {
        e.preventDefault();
        var $this = $(this);
        var id  = $this.data('id');
        var product = $this.val();

        ajaxSetting();

        $.ajax({
            url: base_url +'bill/search',
            method: 'post',
            data: {name:product},
            success: function (result) {

                //$('#'+tr).closest('.product_name').val(result.prod_name);
                $("#suggesstion-box"+id).show();

                var row = $this.closest('tr').attr('id');

                $("#"+row).find('.product_id').val('');


                if(result.length==1){


                    var product = '';
                    $.each(result, function (key, value) {
                         product = value.id;
                    })
                    $("#"+row).find('.product_id').val(product);

                }





                var html = '';

                if(result.length>0) {
                    html += `<ul data-id="${id}" style="list-style-type:none; padding:15px 10px ">`;
                    $.each(result, function (key, value) {
                        html += `<li><a class="productrow" id="productrow${value.id}"   
                                        data-id="${value.id}"  
                                        data-row="${id}"
                                        data-prod_name="${value.prod_name}" 
                                        data-packet_per_box="${value.packet_per_box}" 
                                        data-item_per_packet="${value.item_per_packet}"
                                        data-item_price_supplier="${value.item_price_supplier}" 
                                        data-item_price_retail="${value.item_price_retail}">${value.prod_name}</a></li>`;
                    });
                    html +='</ul>';

                }else{
                    html +='No product';

                }

                $("#suggesstion-box"+id).html(html);

                //ajaxsuccess(result, 'kata-modal', 'reload');


            }
        });
        //console.log(product);

    });




    $(document).on('change keyup mouseup','.item_unit_price', function () {
        var row = $(this).closest('tr').attr('id');

        var array = row.split('_');

        priceCalculate(array[1]);

    });

    $(document).on('change keyup mouseup','.item_quantity', function () {
        var row = $(this).closest('tr').attr('id');

        var array = row.split('_');

        priceCalculate(array[1]);
    });
    function priceCalculate(row){
        var item_quantity =  $('#bill-row_'+row).find('.item_quantity').val();
        var item_unit_price =  $('#bill-row_'+row).find('.item_unit_price').val();
        var total = item_quantity * item_unit_price;
        $('#bill-row_'+row).find('.item_price').val(total);


            var sum = 0;
    // iterate through each td based on class and add the values
            $(".item_price").each(function() {

                var value = $(this).val();
                // add only if the value is number
                if(!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);
                }
            });
            $('.total_price').val(sum);

    }

    $(document).on('click keyup mouseup','.productrow', function () {
       var $this = $(this);
       var product_name=$this.data('prod_name');
       var product_id=$this.data('id');
       var row = $this.data('row');
       var packet_per_box=$this.data('packet_per_box');
       var item_per_packet=$this.data('item_per_packet');
       var item_price_supplier=$this.data('item_price_supplier');
       var id = $this.data('id');

       $("#bill-row_"+row).find('.product_name').val(product_name);
       $("#bill-row_"+row).find('.product_id').val(product_id);
       var quantity_box = $("#bill-row_"+row).find('.item_quantity').val();
       $("#bill-row_"+row).find('.quantity_box').val(quantity_box);

       $("#bill-row_"+row).find('.packet_per_box').val(packet_per_box);
       $("#bill-row_"+row).find('.item_per_packet').val(item_per_packet);
       var supplier_price = $("#bill-row_"+row).find('.item_unit_price').val(item_price_supplier);
        $("#bill-row_"+row).find('.item_unit_price').val(item_price_supplier);

        priceCalculate(row);
       $("#suggesstion-box"+row).html('');

    });

$(document).on('click','.delete-product-row', function () {
        var id  = $(this).data('id');
        $("#bill-row_"+id).remove();
        $("#datatable tbody tr").each( function (key,valye) {
            var rowCount = $('#datatable tbody tr').length;

            var $this = $(this);
            var id= key+1;
            $("#"+id+" .serail").html(`<input type="number" class="form-control"  value="${id}">`);
            if(rowCount==id){
                $("#bill-row_"+id+" .links").html(`<a class="dropdown-item add-product-row" data-id="${rowCount}" href="javascript:void(0)"><i class="fa fa-plus btn-info"></i></a>`);
            }else{
                $("#bill-row_"+id+" td.links").html(`<a class="dropdown-item delete-product-row" data-id="${rowCount}" href="javascript:void(0)"><i class="fa fa-minus btn-warning"></i></a>`);
            }

            priceCalculate(rowCount)
        })




    });


    $('#add-product-btn').click(function (e) {
        $(".form-group .add-div-error").text('');
        //$('#product-modal form').reset();
        $('#product-modal form')[0].reset();
        //$('form#product-form input:text').filter(function() { return  $(this).val(''); })

        /*$('#product-modal form')
            .find("input:text,select")
            .val('')
            .end()
            .find("select",'checked')
            .prop("selected", "").selectpicker("refresh")
            .prop('checked', false)
            .end();*/
        $('.title').text('Add Product');

        $('#product-modal form').attr('action',base_url +"product/create");
        $('#product-modal').modal('show');
        e.preventDefault();
    });

    $('form#bill-form').submit(function (e) {

        var $this = $(this);
        var url = $this.attr('action');

        e.preventDefault();

        ajaxSetting();

        var productdata = $(this).serialize();
        $.ajax({
            url: url,

            method: 'post',
            data: productdata,
            success: function (result) {

                if (result.errors) {
                    //$('#add-alert-danger').html('');
                    //$('#success-message').html('');
                    $('.add-div-error').text('');
                    //$(".admission-btn-save-exit-submit").prop("disabled", false );
                    $.each(result.errors, function(key, value) {
                        //alert(value);

                        $('#add-div-error').show();

                        $('.add-div-error.' + key).text(value);

                        $('.add-div-error .' + key).show();

                        /*if (value != "") {

                            swal("Oops!", "Nadra B Form Already Exist!", "error");
                        }*/
                        //$('.alert-danger').show();
                    });
                } else {
                   // $('#success-message').html('');
                    $('.add-div-error').text('');
                    //$('#class-section-modal').modal('hide');
                    //$('#success-message').show();
                    //$('#success-message').append('<p>' + result.message + '</p>');
                    //$('#success-alert').show();
                    //$('#success-alert').text('Successfully Added!').fadeIn('slow');
                    //$('#success-message').delay(2000).fadeOut('slow');
                    swal({
                        title: "Added successfully!",
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                    setTimeout(function() { window.location.href = base_url + "bills"; }, 2000);


                }



                }

            //}
        });
    });

    $(document).on("blur keyup", ".mobile-number", function (e) {
        e.preventDefault();
        var $this = $(this);
        var mobile = $("input[name=mobile]").val();
        var url = base_url + "supplier-katas/mobile";
        ajaxSetting();
        $.ajax({
            url: url,
            method: 'post',
            dataType: "json",
            data: {
                mobile: mobile,

            },
            success: function (result) {
                console.log(result);
                //$("#form_add #mobileremaining_amount").val(result.remaining_amount!=''? parseInt(result.remaining_amount):0);
                $("#bill-form #name").val(result.name!=''? result.name:'');
                $("#bill-form #address").val(result.address!=''? result.address:'');
                //$("#form_add #page_no").val(result.page_no!=''? result.page_no:'');
                //$("#form_add #khata_type").val(result.type).trigger('change');
               /* if (result.image !='' || result.image != undefined){
                    $("#form_add #kata_image").attr('src', asset_url + '/img/upload/khata/'+ result.image);
                }*/



                //calculate();
            }
        })


    });

    function calculate(){
        var total_amount= $("input[name=total_amount]").val() !=''?$("input[name=total_amount]").val():0;
        var paid_amount = $("input[name=paid_amount]").val() !='' ?$("input[name=paid_amount]").val():0;
        var mobileremaining_amount = $("input[name=mobileremaining_amount]").val() !='' ?$("input[name=mobileremaining_amount]").val():0;
        var remaining_amount = (parseInt(total_amount)+parseInt(mobileremaining_amount)) - parseInt(paid_amount);


        $("input[name=remaining_amount]").val(remaining_amount);
    }





    $(document).on("blur keyup load", ".calculate", function (e) {
        calculate();
    });




    /*$(document).on("blur keyup", ".calculate1", function (e) {
        e.preventDefault();
        var $this = $(this);
        var mobile = $("input[name=edit_mobile]").val();
        var url = base_url + "katas/mobile";
        ajaxSetting();
        $.ajax({
            url: url,
            method: 'post',
            dataType: "json",
            data: {
                mobile: mobile,

            },
            success: function (result) {
                //console.log(result);
                var total_amount= $("input[name=edit_total_amount]").val() !=''?$("input[name=edit_total_amount]").val():0;

                var paid_amount = $("input[name=edit_paid_amount]").val() !='' ?$("input[name=edit_paid_amount]").val():0;

                var prevoius_remaining_amount = result.remaining_amount !=''?result.remaining_amount:0;
                console.log('prevoius_remaining_amount====',prevoius_remaining_amount);
                var remaining_amount = total_amount - paid_amount;
                var total_remaining = parseInt(remaining_amount) + parseInt(prevoius_remaining_amount);
                $("input[name=edit_remaining_amount]").val(parseInt(total_remaining));
            }
        })


    });*/

    /*$(document).on("blur keyup", ".calculate", function () {



    });*/

    $(document).on("click", ".show-product", function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        var url = base_url + "product/show";
        //var url = $this.attr('href');
        //alert(url);

        $('#show-product-modal').modal('show');
        ajaxSetting();
        $.ajax({
            url: url,
            method: 'get',
            dataType: "json",
            data: {
                id: id,

            },
            success: function (result) {

                console.log(result);

                $("#show-product-name").text(result.prod_name);
                $("#show-packet-per-box").text(result.packet_per_box);
                $("#show-item-per-packet").text(result.item_per_packet);
                $("#show-item-price-supplier").text(result.item_price_supplier);
                $("#show-item-price-retailer").text(result.item_price_retail);
                $("#show-product-status").text(result.prod_status);
                $("#show-product-date").text(result.date);
                /* $("#show-total-amount").text(result.total_amount);
                 $("#show-remaining-amount").text(result.remaining_amount);
                 $("#show-amount-status").text(result.amount_status);
                 $("#show-khata-type").text(result.type);*/
                /*if (result.image !='' || result.image != undefined){
                  $("#show-image").attr('src', asset_url + '/img/upload/khata/'+ result.image);
                }*/

            }
        })


    });

    $(document).on("click", ".edit-product", function (e) {
        e.preventDefault();
        $(".form-group .add-div-error").text('');
        var $this = $(this);
        var id = $this.data('id');
        $('.title').text('Edit Product');
        $('.add-div-error').text('');
        $('#product-form').attr('action',base_url +"product/update");
        $('#product-modal').modal('show');
        ajaxSetting();
        $.ajax({
            url: base_url + "product/edit/",
            method: 'get',
            dataType: "json",
            data: {id: id},
            success: function (result) {

                $("#edit-product-id").val(result.id);

                $("#product_name").val(result.prod_name);
                $("#packet_per_box").val(result.packet_per_box);
                $("#item_per_packet").val(result.item_per_packet);
                $("#item_price_supplier").val(result.item_price_supplier);
                $("#item_price_retailer").val(result.item_price_retail);
                if (result.prod_status == 'Inactice'){
                    $("#product_status").prop('checked',true);
                }
            }
        })


    });

/*    $('form#edit-kata-form').submit(function (e) {

        var $this = $(this);
        alert($this);
        var url = $this.attr('action');

        e.preventDefault();

        ajaxSetting();

        var katadata = $this.serialize();

        $.ajax({
            url: url,
            method: 'post',
            data: katadata,
            success: function (result) {


                if (result.errors) {
                    $('#edit-kata-modal').modal('show');
                    $(".form-group .edit-div-error").remove();

                    $.each(result.errors, function (key, value) {

                        $(".form-group." + key).append('<div class="edit-div-error">' + value + '</div>');

                    });
                } else {
                    $(".form-group .edit-div-error").remove();

                    $('#edit-kata-modal').modal('hide');

                    swal({
                        title: result.message,
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000,
                    });


                    location.reload();


                 }
                }
            });
    });*/




    $(document).on('click', ".delete-product", function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        swal({
                title: "Are you sure?",
                text: "You want delete it!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                cancelButtonClass: "btn-choice",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                input: false,
                closeOnCancel: true,

            },

            function(isConfirm) {
                if (isConfirm) {

                    ajaxSetting();

                    $.ajax({
                        url: base_url + 'product/delete',
                        method: 'get',
                        dataType: "json",
                        data: {
                            id: id,
                        },
                        success: function(result) {
                            swal({
                                icon: 'warning',
                                title: "Deleted successfully!",
                                showCancelButton: false,
                                showConfirmButton: false,
                                type: "success",
                                timer: 1000
                            });
                             location.reload();

                        }


                    })

                }
            });
    });

    $(document).on('click', ".export", function() {

        generatePDF('Invoice');


    });




    /*var doc = new jsPDF();
    doc.addHTML($('#'+tableid)[0], 15, 15, {
    'background': '#fffff',
    }, function() {
    doc.save(tableid+'.pdf');
    });*/

    function generatePDF(tableId) {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById(tableId);
        // Choose the element and save the PDF for our user.
        html2pdf().from(element).save();
    }







});