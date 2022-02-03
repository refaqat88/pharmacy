$(document).ready(function () {

    demo.initDateTimePicker();
    if ($('.slider').length != 0) {
        demo.initSliders();
    }

    $('#add-kata-btn').click(function (e) {
        $(".form-group .add-div-error").text('');
        $('#kata-modal')
            .find("input,select")
            .val('')
            .end()
            .find("select")
            .prop("selected", "").selectpicker("refresh")
            .end();
        $('.title').text('Add Khata');

        $('#kata-modal form').attr('action',base_url +"katas/create");
        $('#kata-modal').modal('show');
        e.preventDefault();
    });

    $('form#kata-form').submit(function (e) {

        var $this = $(this);
        var url = $this.attr('action');

        e.preventDefault();

        ajaxSetting();

        var katadata = new FormData($('#kata-form')[0]);
        $.ajax({
            url: url,
            enctype: 'multipart/form-data',
            method: 'post',
            contentType: false,
            processData: false,
            data: katadata,
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

    $(document).on("click", ".show-katas", function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        var url = base_url + "katas/show";
        //var url = $this.attr('href');
        //alert(url);

        $('#show-kata-modal').modal('show');
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

                $("#show-name").text(result.name);
                $("#show-mobile").text(result.phone);
                $("#show-invoice").text(result.receipt_no);
                $("#show-current-date").text(result.current_date);
                $("#show-address").text(result.address);
                $("#show-paid-amount").text(result.paid_amount);
                $("#show-paid-date").text(result.paid_date);
                $("#show-total-amount").text(result.total_amount);
                $("#show-remaining-amount").text(result.remaining_amount);
                $("#show-amount-status").text(result.amount_status);
                $("#show-khata-type").text(result.type);
                if (result.image !='' || result.image != undefined){
                  $("#show-image").attr('src', asset_url + '/img/upload/khata/'+ result.image);
                }

            }
        })


    });

    $(document).on("click", ".edit-katas", function (e) {
        e.preventDefault();
        $(".form-group .add-div-error").text('');
        var $this = $(this);
        var id = $this.data('id');
        $('.title').text('Edit Khata');
        $('.add-div-error').text('');
        $('#kata-form').attr('action',base_url +"katas/update");
        $('#kata-modal').modal('show');
        ajaxSetting();
        $.ajax({
            url: base_url + "katas/edit/",
            method: 'get',
            dataType: "json",
            data: {id: id},
            success: function (result) {

                $("#edit-kata-id").val(result.kata_id);
                $("#edit-user_id").val(result.id);
                $("#name").val(result.name);
                $("#mobile").val(result.phone);
                $("#current_date").val(result.current_date);
                $("#page_no").val(result.page);
                $("#address").val(result.address);
                $("#paid_amount").val(result.paid_amount);
                $("#paid_date").val(result.paid_date);
                $("#total_amount").val(result.total_amount);
                $("#remaining_amount").val(result.remaining_amount);
                $("#amount_status").val(result.amount_status).trigger('change');
                $("#khata_type").val(result.type).trigger('change');
                $("div.image").html('');
                var html='';
                if (result.images != '') {

                    $.each(result.images, function (key, value) {
                        console.log(value);
                        if(value!='') {
                            html += `<div class="form-group image col-sm-4">                                  
                                    <img  class="kata_image" id="kata_image" src="${value}" width="100px" height="100Px">
                                   </div>`;
                        }


                    });

                    $('div.image').html(html);


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




    $(document).on('click', ".delete-katas", function(e) {
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
                closeOnCancel: true,

            },
            function(isConfirm) {
                if (isConfirm) {

                    ajaxSetting();

                    $.ajax({
                        url: base_url + 'katas/delete',
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