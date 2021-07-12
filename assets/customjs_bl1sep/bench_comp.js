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
					output += "<tr class='info'><td><b>Composition date: "+result['benches'][i].from_list_date+"</b></td><td><b>Nature: "+result['benches'][i].bench_nature+"</b></td><td><b>court no:"+result['benches'][i].court_no+"</b></td></tr>";
					output += "<tr class='error'><td colspan='3'><b><u>CORAM</u>:</b></td></tr>";
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
					output += "<tr class='error'><td colspan='3'><b><u>CORAM</u>:</b></td></tr>";
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