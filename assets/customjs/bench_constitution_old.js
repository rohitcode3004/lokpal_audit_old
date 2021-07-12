function select_coram_old()
{
	$("#more_div").hide();
	var noofmem = $('#noofmem option:selected').attr('value');
	if(noofmem == 'more'){
		$("#more_div").show();
		var noofmem = document.getElementById('more_mem').value;
		//alert(noofmem);
	}
		$("#note_div").show();
	    $("#coram_div").show();

	jQuery.ajax({
		url : baseURL+'bench/get_members',
		type : 'post',
		data : '',
		dataType : 'JSON',
		beforeSend: function(){
    	// Show image container
    	$("#loader").show();
   		},
		success : function(result){
			console.log(result);
			if (true) {
				//$('#benches-info').html('');
				//console.log(result);
				var output = '';
				for(var j = 0; j < noofmem; j++){
					count = j+1;
					output += "<label for='judge_code' ><span style='color: red;'>*</span>Select member "+ count +"</label>";
					output += "<select type='text' class='form-control' style='width:90%;' class='chosen-single chosen-default' name='member_namec[]' id='judge_code'><option value=''> Select </option>";
				for (var i = 0; i < result.length; i++) {
					//console.log(result['benches'][i].bench_no);
					console.log(i);
					output += "<option value='"+result[i]['judge_code']+"'>"+result[i]['judge_name']+"</option>";
			    	}
			        output += "</select>";
				$('#members').html(output);
				}
			//$('input:checked').removeAttr('checked');
			//if (result[0].val == 'false') {
			//	jQuery('#email-error').html(result[0].error);
				//jQuery('.first-box').hide();
			//}
	}
		},
			complete:function(data){
    		// Hide image container
    		$("#loader").hide();
    		jQuery('#otp-reminder').html('5 digit Otp is successfully sent to your mobile no.');
   			}
	});
}