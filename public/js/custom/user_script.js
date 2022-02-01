// Wait for the DOM to be ready
$(document).ready(function(){
    //alert('hello');
/*    $('#show-user-btn').click(function(e){
        $('#user-form')[0].reset();
        $('#user-form').attr('action', base_url +'add-user');
        $('#modal-title').html("Add New User");
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: base_url + "add-user",
            method: 'post',
            data:  $(this).serialize(),
            success: function(result){
                if(result.errors)
                {
                    $('.alert-danger').html('');

                    $.each(result.errors, function(key, value){
                        //console.log(result.errors);

                        $('#user-modal').modal('show');
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>'+value+'</li>');
                    });
                }
                else
                {
                    $('.alert-danger').hide();
                    //$('#open').hide();
                    $('#user-modal').modal('hide');
                }
            }});
    });*/

    $('#show-user-btn').click(function(e){
        $('.add-div-error').text('');
        $('#user-modal')
            .find("input,textarea,select,file")
            .val('')
            .end()
            .find("select")
            .prop("selected", "").selectpicker("refresh")
            .end();
        $('#user-modal').modal('show');
        e.preventDefault();
    });

    $('#save-btn').click(function(e){
        e.preventDefault();
        // alert('hello');
        //$('#ClassForm')[0].reset();
        //$('#add-new-class-form').attr('action', base_url +'add-class');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var classdata =  $('#user-form').serialize();
        $.ajax({
            url: base_url + 'add-user',
            method: 'post',
            data:  classdata,
            success: function(result){
                console.log(result);
                $('.add-div-error').text('');
                if(result.errors)
                {

                    //$('#add-alert-danger').html('');

                    $.each(result.errors, function(key, value){

                        $('#user-modal').modal('show');

                        $('.add-div-error.'+key).text(value);

                        $('.add-div-error .'+key).show();
                        //$('.alert-danger').show();


                    });
                }
                else
                {
                    // $('#success-message').html('');
                    // $('.add-div-error').hide();
                    //
                    // $('#newclass').modal('hide');
                    // $('#success-message').show();
                    // $('#success-message').append('<p>'+result.message+'</p>');
                    // //$('#success-alert').show();
                    // //$('#success-alert').text('Successfully Added!').fadeIn('slow');
                    // swal("Good job!", "Your Class Added Successfully!", "success");
                    // $('#success-message').delay(2000).fadeOut('slow');
                    swal({
                        title: "User added successfully!",
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    location.reload();

                }
            }});
    });
    $('#edit-save-btn').click(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var editclassdata =  $('#edit-user-form').serialize();
        $.ajax({
            url: base_url + 'update-user',
            method: 'post',
            data:  editclassdata,
            success: function(result){
                console.log(result);
                $('.edit-div-error').text('');
                if(result.errors)
                {

                    $.each(result.errors, function(key, value){

                        $('#edit-user-modal').modal('show');

                        $('.edit-div-error.'+key).text(value);

                        $('.edit-div-error .'+key).show();
                        //$('.alert-danger').show();


                    });
                }
                else
                {
                    // $('#success-message').html('');
                    // $('.add-div-error').hide();
                    //
                    // $('#newclass').modal('hide');
                    // $('#success-message').show();
                    // $('#success-message').append('<p>'+result.message+'</p>');
                    // //$('#success-alert').show();
                    // //$('#success-alert').text('Successfully Added!').fadeIn('slow');
                    // swal("Good job!", "Your Class Added Successfully!", "success");
                    // $('#success-message').delay(2000).fadeOut('slow');
                    swal({
                        title: "User Updated successfully!",
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    location.reload();

                }
            }});
    });
    $('.reset-password-user').click(function(e){

        var id = $(this).data('id');
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        //var editclassdata =  $('#edit-user-form').serialize();
        $.ajax({
            url: base_url + 'reset-user-password',
            method: 'post',
            data:  {id:id},
            success: function(result){
                if(result)
                {
                    swal({
                        title: "User Updated successfully!",
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    location.reload();

                }
            }});
    });

    $('#save-parent-btn').click(function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        //var editparentdata =  $('#edit-parent-form').serialize();
        var formData = new FormData($('#edit-parent-form')[0]);//$('#add-guardian-form').serialize();
        $.ajax({
            url: base_url + 'update-parent',
            enctype: 'multipart/form-data',
            method: 'post',
            contentType: false,
            processData: false,
            data: formData,
            success: function(result){
                console.log(result);
                $('.edit-div-error').text('');
                if(result.errors)
                {

                    $.each(result.errors, function(key, value){

                        $('#edit-parent-modal').modal('show');

                        $('.edit-div-error.'+key).text(value);

                        $('.edit-div-error .'+key).show();
                        //$('.alert-danger').show();


                    });
                }
                else
                {
                    // $('#success-message').html('');
                    // $('.add-div-error').hide();
                    //
                    // $('#newclass').modal('hide');
                    // $('#success-message').show();
                    // $('#success-message').append('<p>'+result.message+'</p>');
                    // //$('#success-alert').show();
                    // //$('#success-alert').text('Successfully Added!').fadeIn('slow');
                    //swal("Good job!", "Your Class Added Successfully!", "success");
                    //$('#success-message').delay(2000).fadeOut('slow');
                    /*swal({
                        title: "User Updated successfully!",
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    location.reload();*/

                }
            }});
    });


});

/*$("#user-form").validate({
    rules:
        {
            user_type: {
                required: true
            },
            given_name: {
                required: true,
                minlength: 3,
                maxlength: 50,
                lettersonly: true
            },
            username: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            password: {
                required: true,
                minlength: 5
            },

            password_confirmation: {
                required: true,
                minlength: 5,
                equalTo: "#userPassword"
            }
         },
    messages:
        {
            user_type: "please select user type",
            given_name:{
                required: "please enter given name"
            },
            username: "please enter username",
            password:{
                required: "please enter password"
            },
            password_confirmation:{
                required: "Password does not match,Please enter valid Password"
            }
        },
            submitHandler: function (form) {
                form.submit();
            }
});
$("#edit-user-form").validate({
    rules:
        {
            user_type: {
                required: true,
            },
            given_name: {
                required: true,
                minlength: 3,
                maxlength: 50,
                lettersonly: true
            },
            user_name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            password: {

            },

            password_confirmation: {
                required: true,
                minlength: 5,
                equalTo: "#userPassword"
            },
         },
    messages:
        {
            user_type: "please select user type",
            given_name:{
                required: "please enter given name",
            },
            user_name: "please enter username",
            password:{
                required: "Please enter Password",
            },
            password_confirmation:{
                required: "Password does not match,Please enter correct password",
            }
        },
            submitHandler: function (form) {
                form.submit();
            }
});*/
/*jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only alphabetical characters");*/

$('body').on('click', '#edit-user', function () {
    var user_id = $(this).data('id');
    $.get('edit-user/'+user_id, function (data) {
        console.log(data);
        $('#modal-title').html("Edit User Detail");
        //$('#Save-Btn').val("Update");
        //$('#Save-Btn').prop('disabled',false);
        $('#edit-user-form').attr('action', base_url +'update-user/'+user_id);
        $('#edit-user-modal').modal('show');
        $('#edit-user-id').val(data.id);
        /*$('[id=edit-user-type] option').filter(function() {
            return ($(this).text() == data.user_type); //To select Green
        }).attr('selected', 'selected');*/
        
        $('#edit-user-type').val(data.user_type).trigger('change');

        $('#edit-name').val(data.name);
        $('#edit-username').val(data.username);
        //$("input[name='status'][data.status='Active']").attr('checked','checked');
        if(data.status == 'Active'){
            $('#edit-status').val(data.status == 'Active').attr('checked', true);
        }else if(data.status == 'Inactive'){
            $('#edit-status').val(data.status == 'Inactive').attr('checked', false);
        }


        //$('#edit-status').val(data.staus);
    })
});


$('body').on('click', '#show-user', function () {
    var user_id = $(this).data('id');
    $.get('show-user/'+user_id, function (data) {
        console.log(data);
        $('#modal-title').html("VIEW USER DETAIL");
        $('#show-save-btn').hide();
        //$('#Save-Btn').prop('disabled',false);
        $('#show-user-modal').modal('show');
        $('#show-user-type').html(data.type);
        $('#show-name').html(data.name);
        $('#show-username').html(data.username);
        $('#show-status').html(data.status);

    })


});

$(document).on('click', '.show-parent', function () {
    var user_id = $(this).data('id');
    $.get('show-parent/'+user_id, function (data) {
        console.log(asset_url);

        $('#show-parent-modal').modal('show');
         if(data.user_image){
             $('#show-parent-picture').attr('src', asset_url  +'/upload/user/'+data.user_image);
         }else{
             $('#show-parent-picture').attr('src', asset_url  +'/adminassets/img/default-avatar.png');
         }
        $('#show-full-name').html(data.name);
        $('#show-cnic').html(data.username);
        $('#show-gender').html(data.genderName);
        $('#show-occupation').html(data.occupationName);
        $('#show-designation').html(data.designationName);
        $('#show-relation').html(data.relationshipName);
        $('#show-employer').html(data.employerName);

        $('#show-marital_status').text(data.pnt_marital_Status);


    })


});

$(document).on('click', '.edit-parent', function () {
    var user_id = $(this).data('id');
    $.get('edit-parent/'+user_id, function (data) {
        console.log(data);
        //$('#modal-title').html("Edit User Detail");
        //$('#Save-Btn').val("Update");
        //$('#Save-Btn').prop('disabled',false);

        if(data.user_image){
            $('#father-picture-preview').attr('src', asset_url  +'/upload/user/'+data.user_image);
        }else{
            $('#father-picture-preview').attr('src', asset_url  +'/adminassets/img/default-avatar.png');
        }

        $('#edit-parent-form').attr('action', base_url +'update-parent/'+user_id);
        $('#edit-parent-modal').modal('show');
        $('#edit-parent-id').val(data.id);
        $('#edit-parent-gender').val(data.gnd_Id).trigger('change');
        $('#edit-parent-relation').val(data.fk_relat_Id).trigger('change');
        $('#edit-parent-occupation').val(data.occup_Id).trigger('change');
        $('#edit-parent-designation').val(data.desig_Id).trigger('change');
        $('#pnt_marital_Status').val(data.pnt_marital_Status).trigger('change');

        $('#edit-parent-fullname').val(data.name);
        $('#edit-parent-cnic').val(data.username);
        $('#edit-parent-cnic').val(data.username);
        $('#edit-parent-employer').val(data.employer);

        if(data.status == 'Active'){
            $('#edit-parent-status').val(data.status == 'Active').attr('checked', true);
        }else if(data.status == 'Inactive'){
            $('#edit-parent-status').val(data.status == 'Inactive').attr('checked', false);
        }


        //$('#edit-status').val(data.staus);
    })
});


    window.setTimeout(function () {
        $("#success-alert").alert('close');
    }, 2000);
