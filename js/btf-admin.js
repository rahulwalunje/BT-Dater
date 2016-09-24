jQuery(document).ready(function(){
// get system day
var dayToday = new Date();
var weekday = new Array(7);
weekday[0]=  "Sunday";
weekday[1] = "Monday";
weekday[2] = "Tuesday";
weekday[3] = "Wednesday";
weekday[4] = "Thursday";
weekday[5] = "Friday";
weekday[6] = "Saturday";
var Day = weekday[dayToday.getDay()];
jQuery('span.day_today').html(Day);
var statusVal = jQuery('.hidden_status').val();
	if(statusVal==1){
		jQuery('.toggle_msg').show();
	}
	else {
		jQuery('.toggle_msg').hide();
	}
	jQuery('.greet_toggle').click(function(){
	var val = jQuery(this).val();
	if(val==1){
		jQuery('.toggle_msg').show();
	}
	else {
		jQuery('.toggle_msg').hide();
	}

	});
});