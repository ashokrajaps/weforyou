/*validate numbers*/
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
        /*show  alert message*/
function show_success_error(msgstatus,message)
{ 
            $("#custom_msg").html('');
            $("#custom_msg").removeClass('success_msg');
            $("#custom_msg").removeClass('error_msg');
            if(msgstatus == "success")
                $("#custom_msg").addClass('success_msg');
            else
                $("#custom_msg").addClass('error_msg');

            $("#custom_msg").html(message);
            $("#custom_msg").show();   
            $('#custom_msg').delay(5000).slideUp(function(){$(this).hide();});
}   
function show_success_error_stay(msgstatus,message)
{ 
            $("#custom_msg").html('');
            $("#custom_msg").removeClass('success_msg');
            $("#custom_msg").removeClass('error_msg');
            if(msgstatus == "success")
                $("#custom_msg").addClass('success_msg');
            else
                $("#custom_msg").addClass('error_msg');

            $("#custom_msg").html(message);
            $("#custom_msg").show();   
            // $('#custom_msg').delay(3000).slideUp(function(){$(this).hide();});
}