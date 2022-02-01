demo.initDateTimePicker();
if ($('.slider').length != 0) {
    demo.initSliders();
}
$("#FormTemporaryReport").submit( function(){

    ajaxSetting();

    $(".loader").css("display","block")

    $.ajax({
        url: base_url+'report-temporary-ajax' ,
        method: 'post',
        data:  $(this).serialize(),

        success: function(result){
            $(".loader").css("display","none")
            ajaxsuccess(result,'html');
        }
    });


    return false;
})
$("#FormPermanentReport").submit( function(){

    ajaxSetting();

    $(".loader").css("display","block")

    $.ajax({
        url: base_url+'report-permanent-ajax' ,
        method: 'post',
        data:  $(this).serialize(),

        success: function(result){
            $(".loader").css("display","none")
            ajaxsuccess(result,'html');
        }
    });


    return false;
})

/* Examination section */
$(document).on('change loads','input[name=report_name]',function() {
    var checkboxValue = $('input[name=report_name]:checked').val()
   if (checkboxValue == 0){
        $('.quickrangeDiv').show();
       $('.daterangeDiv').hide();
   }else{
       $('.quickrangeDiv').hide();
       $('.daterangeDiv').show();
   }
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
