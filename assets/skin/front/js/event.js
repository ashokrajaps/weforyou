document.write('<link rel="stylesheet" type="text/css" href="'+lod_lib+'bootstrap-datetimepicker/bootstrap-datetimepicker.css" >');
document.write('<script type="text/javascript" src="'+lod_lib+'bootstrap-datetimepicker/moment-with-locales.js" ></script>');
document.write('<script type="text/javascript" src="'+lod_lib+'bootstrap-datetimepicker/bootstrap-datetimepicker.js" ></script>');

            $(function () {
                $('.date_picker').datetimepicker({
                   format: 'DD-MM-YYYY',
                   minDate:new Date(),
                });
                $('.time_picker').datetimepicker({
                   format: 'HH:mm',
                });                
            });