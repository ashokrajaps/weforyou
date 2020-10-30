document.write('<link rel="stylesheet" type="text/css" href="'+lod_lib+'bootstrap-datetimepicker/bootstrap-datetimepicker.css" >');
document.write('<script type="text/javascript" src="'+lod_lib+'bootstrap-datetimepicker/moment-with-locales.js" ></script>');
document.write('<script type="text/javascript" src="'+lod_lib+'bootstrap-datetimepicker/bootstrap-datetimepicker.js" ></script>');

            $(function () {
                $('.date_picker').datetimepicker({
                   format: 'DD-MM-YYYY',
                   // minDate:new Date(Date.now()+1*24*60*60*1000),
                });
                $('.time_picker').datetimepicker({
                   format: 'HH:mm',
                }); 
          var trigger_data=false;
          var trigger_data_event=false;
		select_phy_location_yes_no(trigger_data);
		select_registration_rnr(trigger_data_event);
            });
  function select_phy_location_yes_no(trigger_data)
  { 	  
	var event_phy_location_val=$("input[name=event_have_phy_location]:checked").attr('value');	
	if(event_phy_location_val =="yes")
	{
		$('.event_phy_location_div').show();
		$('.epl_cls').attr('required');	
	}
	else
	{
		$('.epl_cls').removeClass('required');	
		$('.event_phy_location_div').hide();	
	}
}            

  function select_registration_rnr(trigger_data)
  { 	  
	var donation_val=$("input[name=event_is_registration_need]:checked").attr('value');	
	if(donation_val =="yes")
	{
		$('.event_is_registration_div').show();
		$('.event_is_registration_div').find('.is_registration_input').attr('required');	
	}
	else
	{
		$('.event_is_registration_div').find('.is_registration_input').removeClass('required');	
		$('.event_is_registration_div').hide();	
	}
}