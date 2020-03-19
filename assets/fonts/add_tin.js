$(document).ready(function(){
	$('#add_tin').click(function(){
		if($('#ten').val()==''){
			alert("Vui lòng nhập tiêu đề tin !");
			$('#ten').focus();
			return false;	
		}
	})
})


















