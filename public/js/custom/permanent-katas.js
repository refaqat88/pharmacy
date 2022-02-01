$(document).ready(function () {
    /*demo.initDateTimePicker();
    if ($('.slider').length != 0) {
        demo.initSliders();
    }*/

    $('#add-kata-btn').click(function (e) {
        $(".form-group .add-div-error").text('');
        $('#permanent-kata-modal')
            .find("input,select")
            .val('')
            .end()
            .find("select")
            .prop("selected", "").selectpicker("refresh")
            .end();
        $('.title').text('Add Permanent Khata');
        $('#kata-modal form').attr('action',base_url +"permanent-katas/create");
        $('#permanent-kata-modal').modal('show');
        e.preventDefault();
    });

    $('#permanent-kata-form').submit(function (e) {

        var $this = $(this);
        var url = $this.attr('action');

        e.preventDefault();

        ajaxSetting();

        var katadata = $('#permanent-kata-form').serialize();

        $.ajax({
            url: url,
            method: 'post',
            data: katadata,
            success: function (result) {


                ajaxsuccess(result, 'permanent-kata-modal', 'reload');


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
                $("#form_add #mobileremaining_amount").val(result.remaining_amount!=''? parseInt(result.remaining_amount):0);
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


    /*$(document).on("blur keyup", ".calculate", function () {



    });*/

    $(document).on("click", ".show-katas", function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        var url = base_url + "permanent-katas/show";
        //var url = $this.attr('href');
        alert(url);

        $('#show-permanent-kata-modal').modal('show');
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
                $("#show-Invoice").text(result.receipt_no);
                $("#show-current-date").text(result.current_date);
                $("#show-address").text(result.address);
                $("#show-paid-amount").text(result.paid_amount);
                $("#show-paid-date").text(result.paid_date);
                $("#show-total-amount").text(result.total_amount);
                $("#show-remaining-amount").text(result.remaining_amount);
                $("#show-amount-status").text(result.amount_status);



            }
        })


    });

    $(document).on("click", ".edit-katas", function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        //var url = base_url +"katas/update";
        $('.title').text('Edit Permanent Khata');
        $('#permanent-kata-form').attr('action','permanent-katas/update',);

        ///alert(url);

        $('#permanent-kata-modal').modal('show');
        ajaxSetting();
        $.ajax({
            url: base_url + "permanent-katas/edit/",
            method: 'get',
            dataType: "json",
            data: {id: id},
            success: function (result) {
                console.log(result);

                $("#edit-permanent-kata-id").val(result.permanent_kata_id);
                $("#edit-user_id").val(result.id);
                $("#name").val(result.name);
                $("#mobile").val(result.phone);
                $("#current_date").val(result.current_date);
                $("#address").val(result.address);
                $("#paid_amount").val(result.paid_amount);
                $("#paid_date").val(result.paid_date);
                $("#total_amount").val(result.total_amount);
                $("#remaining_amount").val(result.remaining_amount);
                $("#amount_status").val(result.amount_status).trigger('change');

            }
        })


    });






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
                        url: base_url + 'permanent-katas/delete',
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