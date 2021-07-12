function send_otp()
{
	//alert('hr');
	var emailid = jQuery('#emailid').val();
	jQuery.ajax({
		url : baseURL+'user/email_validation',
		type : 'post',
		data : 'email='+emailid,
		dataType : 'JSON',
		beforeSend: function(){
    	// Show image container
    	$("#loader").show();
   		},
		success : function(result){
			console.log(result);
			if (result[0].val == 'true') {
				jQuery('#email-error').html('');
				jQuery('.second-box').show();
				jQuery('.first-box').hide();
			}
			if (result[0].val == 'false') {
				jQuery('#email-error').html(result[0].error);
				//jQuery('.first-box').hide();
			}

		},
			complete:function(data){
    		// Hide image container
    		$("#loader").hide();
    		jQuery('#otp-reminder').html('5 digit Otp is successfully sent to your mobile no.');
   			}
	});
}

function submit_otp()
{
	//alert('kjhjk');
	var otp = jQuery('#otp').val();
	console.log(otp);
	jQuery.ajax({
		url : baseURL+'user/otp_validation',
		type : 'post',
		data : 'otp='+otp,
		dataType : 'JSON',
		success : function(result){
			if (result[0].val == 'true' && result[0].msg == 'success') {
				window.location = baseURL+'admin/dashboard';
				//console.log('SUCCESSFUL LOGIN');
			}
			if (result[0].val == 'true' && result[0].msg == 'fail') {
				//window.location = 'dashboard.php';
				jQuery('#otp-error').html('Invalid Otp Entered!');
				console.log('WRONG OTP');
			}

			if (result[0].val == 'false') {
				jQuery('#otp-error').html(result[0].error);
			}

		}
	});
}