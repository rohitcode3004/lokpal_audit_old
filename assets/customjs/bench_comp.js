function benches_all_existing()
{
	jQuery.ajax({
		url : baseURL+'bench/get_benches_listdate',
		type : 'post',
		//data : 'list_date='+list_date,
		dataType : 'JSON',
		beforeSend: function(){
    	// Show image container
    	$("#loader").show();
   		},
		success : function(result){
			console.log(result);
			if (result['count'] != 0) {
				$('#benches-info').html('');
				console.log(result);
				var output = '';
				var count_benches = Object. keys(result['benches']). length;
				//console.log(count_benches);
				for (var i = 0; i < count_benches; i++) {
					//console.log(result['benches'][i].bench_no);
					var bench_no_display;
					if(result['benches'][i].bench_no == 0){
						bench_no_display = 'Full Bench';
					}else{
						bench_no_display = result['benches'][i].bench_no;
					}

					output += "<tr class='info'><td colspan='4'><input type='radio' name='newbench' id='newbench' value='old/"+result['benches'][i].id+"/"+result['benches'][i].bench_no+"' checked=''><font color='#C70039'><b>Bench : "+bench_no_display+"</b></font></td></tr>";
					output += "<tr class='info'><td><b>Order date: "+result['benches'][i].order_date+"</b></td><td><!--<b>Total no. of pending cases: "+result['benches'][i].total_cases+"</b>--></td><td><!--<b>court no:"+result['benches'][i].court_no+"</b>--></td></tr>";
					//output += "<tr class='error'><td colspan='3'><b><u>CORAM</u>:</b></td></tr>";
					var count_judges = Object. keys(result['judges']). length;
					console.log(result['judges']);
					var sn = 1;
					for (var j = 0; j < count_judges; j++) {
						//console.log(result['judges'][i].from_list_date)
						if(result['benches'][i].id == result['judges'][j].bench_id){
						output +="<tr class='error'><td colspan=''><input style='opacity:0; position:absolute;' type='checkbox' checked true name='member_namec"+result['benches'][i].id+"[]' id='' value='"+result['judges'][j].judge_code+"'></td><td colspan=''><b>"+sn+". </b>"+result['judges'][j].judge_name+"</td><td><b>"+result['judges'][j].judge_desg+"</b></td></tr>";
						sn++;
						}
					}
					output += "<tr border='0'><td colspan='3'></td></tr>"
			    }
			    output += "<tr><td colspan='3'><button type='submit' class='btn btn-success' id='submitbtn'>Save</button></td></tr>";
			$('#benches-info').html(output);
			//$('input:checked').removeAttr('checked');
			//if (result[0].val == 'false') {
			//	jQuery('#email-error').html(result[0].error);
				//jQuery('.first-box').hide();
			//}
}else{
	$('#benches-info').html('');
	output += "<tr class='error' border='0'><td colspan='3'>No bench found. Create a new bench</td></tr>"
	$('#benches-info').html(output);
}
		},
			complete:function(data){
    		// Hide image container
    		$("#loader").hide();
    		jQuery('#otp-reminder').html('5 digit Otp is successfully sent to your mobile no.');
   			}
	});
}

function benche_mod(bn)
{
	jQuery.ajax({
		url : baseURL+'bench/get_bench_details',
		type : 'post',
		data : 'bn='+bn,
		dataType : 'JSON',
		beforeSend: function(){
    	// Show image container
    	$("#loader").show();
   		},
		success : function(result){
			console.log(result);
			if (result['count'] != 0) {
				$('#order_date').val(result['benches'][0].order_date);

				$('#bench_no').val(result['benches'][0].bench_no);
				if(result['benches'][0].bench_no == 0){
					$('#bench_no_display').val('Full Bench');
				}else{
					$('#bench_no_display').val(result['benches'][0].bench_no);
				}
				$('#bench_id').val(result['benches'][0].id);
				var count_judges = Object. keys(result['judges']).length;
				//console.log(count_judges);
				if(count_judges > 8){
					$('#noofmem').val('more');
					$("#more_div").show();
					$('#more_mem').val(count_judges);
				}else{
					$('#noofmem').val(count_judges);
				}
				var noofmem = $('#noofmem option:selected').attr('value');
				if(noofmem == 'more'){
					//$("#more_div").show();
					var noofmem = document.getElementById('more_mem').value;
					//alert(noofmem);
				}
					$("#note_div").show();
	    			$("#coram_div").show();
				
				//$("#more_div").show();
					jQuery.ajax({
		url : baseURL+'bench/get_members',
		type : 'post',
		data : '',
		dataType : 'JSON',
		beforeSend: function(){
    	// Show image container
    	$("#loader").show();
   		},
		success : function(result2){
			//console.log(result);
			if (true) {
				//$('#benches-info').html('');
				//console.log(result);
				var output = '';
				for(var j = 0; j < count_judges; j++){
					count = j+1;
					output += "<label for='judge_code' ><span style='color: red;'>*</span>Select member "+ count +"</label>";
					output += "<select type='text' class='form-control' style='width:90%;' class='chosen-single chosen-default' name='member_namec[]' id='judge_code'><option value=''> Select </option>";
				for (var i = 0; i < result2.length; i++) {
					//console.log(result['benches'][i].bench_no);
					console.log(i);
					if(result2[i]['judge_code'] == result['judges'][j].judge_code){
						roht = 'selected';
					}else{
						roht = '';
					}
					output += "<option value='"+result2[i]['judge_code']+"' "+roht+" >"+result2[i]['judge_name']+"</option>";
			    	}
			        output += "</select>";
			        //console.log(output);
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
}else{
	$('#benches-info').html('');
	output += "<tr class='error' border='0'><td colspan='3'>No bench found. Create a new bench</td></tr>"
	$('#benches-info').html(output);
}
		},
			complete:function(data){
    		// Hide image container
    		$("#loader").hide();
    		jQuery('#otp-reminder').html('5 digit Otp is successfully sent to your mobile no.');
   			}
	});
}


function benches_via_listdate(list_date)
{
	//alert(list_date);
	jQuery.ajax({
		url : baseURL+'bench/get_benches_listdate',
		type : 'post',
		data : 'list_date='+list_date,
		dataType : 'JSON',
		beforeSend: function(){
    	// Show image container
    	$("#loader").show();
   		},
		success : function(result){
			console.log(result);
			if (result['count'] != 0) {
				$('#benches-info').html('');
				console.log(result);
				var output = '';
				var count_benches = Object. keys(result['benches']). length;
				console.log(count_benches);
				for (var i = 0; i < count_benches; i++) {
					//console.log(result['benches'][i].bench_no);
					output += "<tr class='info'><td colspan='4'><input type='radio' name='newbench' id='newbench' value='old/"+result['benches'][i].id+"' checked=''><b>Bench no: "+result['benches'][i].bench_no+"</b></td></tr>";
					output += "<tr class='info'><td><b>Listing date: "+result['benches'][i].from_list_date+"</b></td><td><b>Bench nature: "+result['benches'][i].bench_nature+"</b></td><td><b>court no:"+result['benches'][i].court_no+"</b></td></tr>";
					//output += "<tr class='error'><td colspan='3'><b><u>CORAM</u>:</b></td></tr>";
					var count_judges = Object. keys(result['judges']). length;
					var sn = 1;
					for (var j = 0; j < count_judges; j++) {
						//console.log(result['judges'][i].from_list_date)
						if(result['benches'][i].from_list_date == result['judges'][j].list_date
						 && result['benches'][i].bench_no == result['judges'][j].bench_no){
						output +="<tr class='error'><td colspan='3'><b>"+sn+". </b>"+result['judges'][j].judge_name+"</td></tr>";
						sn++;
						}
					}
					output += "<tr border='0'><td colspan='3'></td></tr>"
			    }
			$('#benches-info').html(output);
			$('input:checked').removeAttr('checked');
			//if (result[0].val == 'false') {
			//	jQuery('#email-error').html(result[0].error);
				//jQuery('.first-box').hide();
			//}
}else{
	$('#benches-info').html('');
	output += "<tr class='error' border='0'><td colspan='3'>No bench found. Create a new bench</td></tr>"
	$('#benches-info').html(output);
}
		},
			complete:function(data){
    		// Hide image container
    		$("#loader").hide();
    		jQuery('#otp-reminder').html('5 digit Otp is successfully sent to your mobile no.');
   			}
	});
}


function benches_via_datebn(ld,bn)
{
		//alert(list_date);
	jQuery.ajax({
		url : baseURL+'bench/get_benches_listdate_bn',
		type : 'post',
		data : {list_date:ld, bench_nature:bn},
		dataType : 'JSON',
		beforeSend: function(){
    	// Show image container
    	$("#loader").show();
   		},
		success : function(result){
			//console.log(result);
			if (result['count'] != 0) {
				console.log('here');
				$('#benches-info').html('');
				console.log(result);
				var output = '';
				var count_benches = Object. keys(result['benches']). length;
				console.log(count_benches);
				for (var i = 0; i < count_benches; i++) {
					//console.log(result['benches'][i].bench_no);
					output += "<tr class='info'><td colspan='4'><input type='radio' name='newbench' id='newbench' value='old/"+result['benches'][i].id+"' checked=''><b>Bench no: "+result['benches'][i].bench_no+"</b></td></tr>";
					output += "<tr class='info'><td><b>Composition date: "+result['benches'][i].from_list_date+"</b></td><td><b>Nature: "+result['benches'][i].bench_nature+"</b></td><td><b>court no:"+result['benches'][i].court_no+"</b></td></tr>";
					//output += "<tr class='error'><td colspan='3'><b><u>CORAM</u>:</b></td></tr>";
					var count_judges = Object. keys(result['judges']). length;
					var sn = 1;
					for (var j = 0; j < count_judges; j++) {
						//console.log(result['judges'][i].from_list_date)
						if(result['benches'][i].from_list_date == result['judges'][j].list_date
						 && result['benches'][i].bench_no == result['judges'][j].bench_no){
						output +="<tr class='error'><td colspan='3'><b>"+sn+". </b>"+result['judges'][j].judge_name+"</td></tr>";
						sn++;
						}
					}
					output += "<tr border='0'><td colspan='3'></td></tr>"
			    }
			$('#benches-info').html(output);
			$('input:checked').removeAttr('checked');
			//if (result[0].val == 'false') {
			//	jQuery('#email-error').html(result[0].error);
				//jQuery('.first-box').hide();
			//}
}else{
	$('#benches-info').html('');
	output += "<tr border='0'><td colspan='3'>No bench found. Create a new bench</td></tr>"
	$('#benches-info').html(output);
}
		},
			complete:function(data){
    		// Hide image container
    		$("#loader").hide();
    		jQuery('#otp-reminder').html('5 digit Otp is successfully sent to your mobile no.');
   			}
	});
}