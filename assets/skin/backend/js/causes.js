	$(document).ready(function() {
		var trigger_data=false;
		select_donation_rnr(trigger_data);
		select_volunteer_rnr(trigger_data);
	});	

  function select_donation_rnr(trigger_data)
  { 	  
	var donation_val=$("input[name=causes_is_donation_need]:checked").attr('value');	
	if(donation_val =="yes")
	{
		$('#how_much_donation_need_div').show();
		$('#how_much_donation_need_div').attr('required');	
	}
	else
	{
		$('#causes_how_much_donation_need').removeClass('required');	
		$('#how_much_donation_need_div').hide();	
	}
}
  function select_volunteer_rnr(trigger_data)
  { 	  
	var volunteer_val=$("input[name=causes_is_volunteers_needed]:checked").attr('value');	
	if(volunteer_val =="yes")
	{
		$('#how_much_volunteers_need_div').show();
		$('#how_much_volunteers_need_div').attr('required');	
	}
	else
	{
		$('#causes_how_much_volunteers_need').removeClass('required');	
		$('#how_much_volunteers_need_div').hide();	
	}	
}