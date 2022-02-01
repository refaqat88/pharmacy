$(document).ready(function () {
    demo.initDateTimePicker();
    if ($('.slider').length != 0) {
        demo.initSliders();
    }

    $('#add-kata-btn').click(function (e) {
        $('#kata-modal').modal('show');
        e.preventDefault();
    });

    $('#kata-form').submit(function (e) {

        var $this = $(this);
        var url = $this.attr('action');

        e.preventDefault();

        ajaxSetting();

        var katadata = $('#kata-form').serialize();

        $.ajax({
            url: url,
            method: 'post',
            data: katadata,
            success: function (result) {


                ajaxsuccess(result, 'kata-modal', 'reload');


            }
        });
    });

    $(document).on("blur keyup", ".mobile-number", function (e) {
        e.preventDefault();
        //var $this = $(this);
        var mobile = $('.mobile-number').val();
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
                var prevoius_remaining_amount = result.remaining_amount !=0?result.remaining_amount:0;
                calculateKata(prevoius_remaining_amount);
            }
        })


    });

    $(document).on("blur keyup", ".calculate", function () {

            calculateKata(prevoius_remaining_amount='');

    });

     function calculateKata(prevoius_remaining_amount){
         prevoius_remaining_amount = prevoius_remaining_amount || 0;

         //alert(prevoius_remaining_amount);
        var total_amount= $("input[name=total_amount]").val() !=''?$("input[name=total_amount]").val():0;

        var paid_amount = $("input[name=paid_amount]").val() !='' ?$("input[name=paid_amount]").val():0;


        //console.log('prevoius_remaining_amount====',prevoius_remaining_amount);
        var remaining_amount = (total_amount - paid_amount)+prevoius_remaining_amount;
         var total_remaining =0;
       /* if (prevoius_remaining_amount!=''){
             total_remaining = parseInt(remaining_amount + prevoius_remaining_amount);
            $("input[name=remaining_amount]").val(total_remaining);
        }else {*/
            total_remaining = parseInt(remaining_amount);
            $("input[name=remaining_amount]").val(total_remaining);
       //


    }

    $(document).on("click", ".show-katas", function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        var url = base_url + "katas/show";
        //var url = $this.attr('href');
        alert(url);

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
        var editkatadata = $('#edit-kata-form').serialize();
        //$('#kata-form').attr('action','katas.update/',);

        ///alert(url);

        $('#edit-kata-modal').modal('show');
        ajaxSetting();
        $.ajax({
            url: base_url + "katas/edit/",
            method: 'get',
            dataType: "json",
            data: {id: id},
            success: function (result) {
                console.log(result);

                $("#id").val(result.id);
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

    $('#edit-kata-form').submit(function (e) {

        var $this = $(this);
        var url = $this.attr('action');

        e.preventDefault();

        ajaxSetting();

        var katadata = $('#edit-kata-form').serialize();

        $.ajax({
            url: url,
            method: 'post',
            data: katadata,
            success: function (result) {


                ajaxsuccess(result, 'edit-kata-modal', 'reload');


            }
        });
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

});