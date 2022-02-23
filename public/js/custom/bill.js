$(document).ready(function () {

    demo.initDateTimePicker();
    if ($('.slider').length != 0) {
        demo.initSliders();
    }


    function htmlApeend(){

        var rowCount = $('#datatable tr').length;


        var removelink = '';
        if(rowCount>1){

            var ReemovePlus = rowCount-1;

            $("#bill-row_"+ReemovePlus+' .add-product-row').remove();


            $("#bill-row_"+ReemovePlus+' .links ').html(`<a class="dropdown-item delete-product-row" data-id="${ReemovePlus}" href="javascript:void(0)"><i class="fa fa-minus btn-danger"></i></a>`);



            removelink =`<a class="dropdown-item delete-product-row" data-id="${rowCount}" href="javascript:void(0)"><i class="fa fa-minus btn-danger"></i></a>`;

        }

        var html = `<tr class="table-row" id="bill-row_${rowCount}">
                        <td class="w-1"><input type="number" class="form-control" placeholder="" min="1" max="1000000" value="${rowCount}"/></td>
                        <td class=""><input type="text" class="form-control" placeholder="" name="product_name[]" value=""/></td>
                        <td class=""><input class="form-control" name="item_quantity" id="item_quantity" type="number" min="1" max="1000000"/></td>
                        <td class=""><input class="form-control" name="packet_per_box" id="packet_per_box" type="number" min="1" max="1000000"/></td>
                        <td class=""><input class="form-control" name="item_price_supplier" id="item_price_supplier" type="number" min="1" max="1000000"/></td>
                        <td class=""><input class="form-control" name="item_unit_price" id="item_unit_price" type="number" min="1" max="1000000"/></td>
                        <td class=""><input class="form-control" name="item_price" id="item_price" type="number" min="1" max="1000000"/></td>
                        </td>

                        <td class="w2 text-center links">
                        
                            <a class="dropdown-item add-product-row" data-id="${rowCount}" href="javascript:void(0)"><i class="fa fa-plus btn-info"></i></a>
                            ${removelink}    

                        </td>
                     </tr>`;

        return html;


    }

    $(document).on('click','.add-product-row', function () {
        var rowCount = $('#datatable tr').length;
        //alert(rowCount);

         var html = htmlApeend()
        $('#datatable tbody').append(html);
    });
$(document).on('click','.delete-product-row', function () {
        var id  = $(this).data('id');
        $("#bill-row_"+id).remove();

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

    $('form#product-form').submit(function (e) {

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


                ajaxsuccess(result, 'kata-modal', 'reload');


            }
        });
    });

    $(document).on("blur keyup", ".mobile-number", function (e) {
        e.preventDefault();
        var $this = $(this);
        var mobile = $("input[name=mobile]").val();
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
                console.log(result);
                $("#form_add #mobileremaining_amount").val(result.remaining_amount!=''? parseInt(result.remaining_amount):0);
                $("#form_add #name").val(result.name!=''? result.name:'');
                $("#form_add #address").val(result.address!=''? result.address:'');
                $("#form_add #page_no").val(result.page_no!=''? result.page_no:'');
                $("#form_add #khata_type").val(result.type).trigger('change');
                if (result.image !='' || result.image != undefined){
                    $("#form_add #kata_image").attr('src', asset_url + '/img/upload/khata/'+ result.image);
                }



                calculate();
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