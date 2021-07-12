function select_coram()
{
	//$("#more_div").hide();
	//var noofmem = $('#noofmem option:selected').attr('value');
	//if(noofmem == 'more'){
		//$("#more_div").show();
		//var noofmem = document.getElementById('more_mem').value;
		//alert(noofmem);
	//}
		//$("#note_div").show();
	    //$("#coram_div").show();

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
				//for(var j = 0; j < noofmem; j++){
					//count = j+1;
					//output += "<label for='judge_code' ><span style='color: red;'>*</span>Select member "+ count +"</label>";
					var count = 1;
					for (var i = 0; i < result.length; i++) {
					//console.log(result['benches'][i].bench_no);
					//console.log(result[i]['judge_type']);
					var type;
					if(result[i]['judge_type'] == 'C'){
						type = "Hon'ble Chairperson";
					}else if(result[i]['judge_type'] == 'J'){
						type = "Hon'ble Judicial Member";
					}else if(result[i]['judge_type'] == 'M'){
						type = "Hon'ble Member";
					}
					output += "<tr><td>"+count+".</td><td><input type='checkbox' name='member_namec[]' id='"+result[i]['judge_name']+"' value='"+result[i]['judge_code']+"'></td><td> "+result[i]['judge_name']+" </td><td> "+type+" </td><td> "+result[i]['nofcases']+" </td></tr>";
					count += 1;
				}
				output += "<tr><td colspan='5'><button type='submit' class='btn btn-success' id='submitbtn'>Save</button></td></tr>";
				$('#members').html(output);
				//}
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